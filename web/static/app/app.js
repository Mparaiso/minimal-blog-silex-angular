var app = angular.module("App", ["ngResource"]);

function MainCtrl($scope) {
}

function CommentCtrl($scope) {
};

function CommentListCtrl($scope) {
};

function CommentFormCtrl($scope) {
};

function PostCtrl($scope, PostService) {
    $scope.postService = PostService;
};

function PostListCtrl($scope, PostService) {
    $scope.postService = PostService;
};

function PostFormCtrl($scope, PostService) {
    $scope.submit = function (post) {
        PostService.create(post);
    }
};
app.factory("CommentService", function () {
});
app.factory("PostService", function (Post) {
    var PostService;
    PostService = {
        setPosts: function (posts) {
            this._posts = posts;
            return this;
        },
        getPosts: function () {
            return this._posts;
        },
        get: function (id) {
            var that = this;
            if (id) {
            } else {
                Post.get(function (result) {
                    that.setPosts(result.posts);
                });
            }
        },
        create: function (post) {
            var that = this;
            Post.save(post, function () {
                that.get();
            });
        }
    }
    return PostService;
});
app.factory("Comment", function ($resource) {
    return $resource("/api/" + Config.api.version + "/comment/:id", {"id": "@id"});
});

app.factory("Post", function ($resource, Config) {
    return $resource("/api/" + Config.api.version + "/post/:id", {"id": "@id"});
});

app.value("Config", {api: {version: 1}});

