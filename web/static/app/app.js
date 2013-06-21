/**
 * @copyright mparaiso mparaiso@online.fr
 */
var app = angular.module("App", ["ngResource"]);
/**
 * VIEW MODELS : hold data displayed by the view<br>
 * $scope expose variables to the view
 */
function MainCtrl($scope) {
}

function IndexCtrl(PostService) {
    PostService.findAll({order_by: "created_at", order_order: "DESC"}, function (result) {
        PostService.posts = result.posts;
    });
}

function PostReadCtrl($scope, PostService, $routeParams, CommentService) {
    $scope.comment = {};
    $scope.postService = PostService;
    $scope.commentService = CommentService;
    $scope.submit = function (comment, id) {
        comment.post_id = id;
        CommentService.create(comment, function (result) {
            $scope.comment.author_name = null;
            $scope.comment.content = null;
            CommentService.findBy(
                {post_id: id, order_by: 'created_at', order_order: 'DESC'},
                function (result) {
                    CommentService.comments = result.comments;
                });
        });
    };
    PostService.find($routeParams.postId, null, function (result) {
        $scope.post = result.post;
        CommentService.findBy({post_id: $scope.post.id}, function (result) {
            CommentService.comments = result.comments;
        });
    });
};

function PostListCtrl($scope, PostService) {
    $scope.postService = PostService;
};

function PostCreateCtrl($scope, PostService, $location) {
    $scope.submit = function (post) {
        PostService.create(post, function () {
            $location.path("/");
            PostService.findAll({order_by: "created_at", order_order: "DESC"}, function (r) {
                PostService.posts = r.posts;
            });
        });
    }
};
/**
 * SERVICES : hold the application global datas
 */
app.factory("CommentService", function (Comment) {
    var CommentService = {
        comments: [],
        findBy: function (params, callback) {
            Comment.get(params, callback);
        },
        create: function (comment, callback) {
            Comment.save(comment, callback);
        }
    };
    return CommentService;
});

app.factory("PostService", function (Post) {
    var PostService;
    PostService = {
        posts: [],
        findAll: function (params, callback) {
            return Post.get(params, callback);
        },
        find: function (id, params, callback) {
            params = angular.extend({}, params, {id: id});
            return Post.get(params, callback);
        },
        create: function (post, callback) {
            return Post.save(post, callback);
        }
    }
    return PostService;
});


/**
 * RESOURCES : manage communication between the server and the client
 */
app.factory("Post", function ($resource) {
    return $resource("/api/1/post/:id", {"id": "@id"});
});

app.factory("Comment", function ($resource) {
    return $resource("/api/1/comment/:id", {"id": "@id"});
});

/**
 * ROUTES : application routes
 */
app.config(function ($routeProvider) {
    $routeProvider.when("/blog", {templateUrl: "index.html", controller: "IndexCtrl"})
    $routeProvider.when("/blog/create", {templateUrl: "post-create.html", controller: "PostCreateCtrl"})
    $routeProvider.when("/blog/:postId", {templateUrl: "post-read.html", controller: "PostReadCtrl"})
    $routeProvider.otherwise({redirectTo: "/blog"});
});

