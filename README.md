A web front end to LAERTES/KnowledgeBase, written in (https://phalconphp.com/ "Phalcon").

You will need to install Phalcon and PHP and configure your web application to use the Phalcon plugin. Requires installation of curl and curl for PHP (typically the package is called php<version>-curl eg php5-curl). Tested so far with apache2 on ubuntu 14.04.

Rewrite will need to be enabled.

The URL for the readaheads will have to be changed per implementation. The URL is currently hardcoded three times at the bottom of app/views/index/index.volt. When deploying this application, change that URL to the one on which your implementation is hosted.

For development/code help, contact github user blm14
