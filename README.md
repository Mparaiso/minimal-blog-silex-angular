Combining Silex and AngularJS
============================

author: Mparaiso mparaiso@oneline.fr ( a problem , a suggestion, a job offer ? contact me ;) )

Adaptation of the following (great) tutorial :

http://net.tutsplus.com/tutorials/javascript-ajax/combining-laravel-4-and-backbone/

I used Silex instead of Laravel , AngularJS instead of Backbone , and Twig instead of mustache.

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

Define the following variables on the ***SYSTEM*** level :

NETTUTS_LARAVEL_BACKBONE_DBNAME: database name
NETTUTS_LARAVEL_BACKBONE_USER: db username
NETTUTS_LARAVEL_BACKBONE_PASSWORD: db password
NETTUTS_LARAVEL_BACKBONE_DRIVER: pdo driver ( ex  : pdo_mysql, pdo_sqlite, ...)
NETTUTS_LARAVEL_BACKBONE_PORT: optional
NETTUTS_LARAVEL_BACKBONE_ENV: development or production

Web root:

The web root is the /web/ folder.

Chmod:

/temp/ must be writable

License : LGPL



