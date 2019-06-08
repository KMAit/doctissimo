Doctissimo : Test technique
========================

Description :
-------------

Test doctissimo d'un affichage simple de listing et fiche d'article.

Prérequis :
-----------

* Serveur local de type WAMP

* IDE de votre choix pour php

* php 7 et composer sur votre machine


Installation :
---------------
Afin de faire tourner ce projet il faut dans un premier temps le télécharger dans le dossier www d'un serveur local de type WAMP via : 

``` 
git clone https://github.com/KMAit/doctissimo.git
```

une fois que cela est fait il faut lancer la commande : 

``` 
composer install
```

Outils utiles ?
---------------

Afin de visualiser simplement les données de l'API, il est possible d'installer un logiciel de type postman


Utilisation :
-------------

Il est possible de visualiser la liste des articles, les details d'un article, et de créer un article directement via l'api.

* URL d'affichage de la liste des articles dans postman : 

```
http://localhost/doctissimo/web/app_dev.php/api/blog/articles
```

* URL d'affichage des détails d'un article dans postman : 

```
http://localhost/doctissimo/web/app_dev.php/api/blog/article/1
```

* URL de création d'un article dans postman : 

```
http://localhost/doctissimo/web/app_dev.php/api/blog/create/article?title=creation d'un article&description=article créé via postman
```


Il est possible également d'effectuer ces tâches dans un navigateur web via une interface simple en accédant aux url suivantes :


* URL d'affichage de la liste des articles : 

```
http://localhost/doctissimo/web/app_dev.php/blog/articles
```

* URL d'affichage des détails d'un article : 

```
http://localhost/doctissimo/web/app_dev.php/blog/article/1
```

* URL de création d'un article : 

```
http://localhost/doctissimo/web/app_dev.php/blog/create/article
```

Auteur :
--------

* Kamel Aït Ahmed - Développeur web chez LGDW - [KMAIT]([1] "lien Github")


[1]:  https://github.com/KMAit