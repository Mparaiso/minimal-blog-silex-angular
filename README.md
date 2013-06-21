Combining Silex and AngularJS
============================

author: Mparaiso mparaiso@online.fr

Adaptation of the following (great) tutorial :

http://net.tutsplus.com/tutorials/javascript-ajax/combining-laravel-4-and-backbone/

I used Silex instead of Laravel , AngularJS instead of Backbone ,Doctrine DBAL/PDO instead of Eloquent , and Twig instead of mustache.

## INSTALLATION

Requirements:

+ PHP >= 5.3
+ A database (sqlite,mysql,...)
+ An apache server or php built-in server
+ A command line interface (to create the database , generate default datas , etc...)
+ COMPOSER
+ GIT
+ 20 mins to get the app running

Server variables:

Define the following variables on the ***SYSTEM*** level (with set/setx on Windows or export in Linux) :

+ NETTUTS_LARAVEL_BACKBONE_HOST: localhost ( optional )
+ NETTUTS_LARAVEL_BACKBONE_DBNAME: database name
+ NETTUTS_LARAVEL_BACKBONE_USER: db username
+ NETTUTS_LARAVEL_BACKBONE_PASSWORD: db password
+ NETTUTS_LARAVEL_BACKBONE_DRIVER: pdo driver ( ex  : pdo_mysql, pdo_sqlite, ...)
+ NETTUTS_LARAVEL_BACKBONE_PORT: optional
+ NETTUTS_LARAVEL_BACKBONE_ENV: development or production

Web root:

The web root is the /web/ folder.

Chmod:

/temp/ must be writable

COMPOSER :

install packages : <code>composer install</code> in the root folder

Command Line:

with a cli ,in the root folder ,generate the database: <code>php console.php p:d:g</code>

Fire the built-in server ( PHP >= 5.4 ):

in the web folder : <code>php -S 127.0.0.1:3000 index.php</code>

And you are <del>outta here</del> good to go !

License : LGPL

## TODO

+ write doc
+ write php tests
+ write js tests



