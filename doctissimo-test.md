# Doctissimo : Test technique

## Introduction

Le but de ce test technique est de mettre en place un affichage simple de listing et de fiche détaillée de contenus types "article", à la manière d'un blog.
Une partie d'API rest vous sera également demandée.

Le modèle d'un article contiendra, à minima, les champs suivantes :
```
id
title
description
```

!! Le projet devra être réalisé en Symfony 3.4 / PHP 7.
!! Vous utiliserez Mysql pour le stockage des données.
!!! Ne pas utiliser Doctrine, ni aucun ORM


## Listing et fiche détaillée d'article

Les pages suivantes devront être réalisées (affichage simple) : 

* une page de listing, qui liste tous les articles 

exemple d'url : /blog/articles

* une page permettant d'afficher le contenu d'un article, avec un lien permettant de retourner sur la page de listing

exemple d'url : /blog/article/[id]

[id] étant l'identifiant unique de l'article.


## API rest

Vous devrez être capable d'exposer vos données via une API rest.
Cette API devra supporter les cas d'utilisation suivants :

* retourner la liste de tous les articles

```
{
	"data" : [
		{
			"id": 1,
			"title": "Article 1"
			....
		},
		{
			"id": 2,
			"title": "Article 2"
		},
		....
	]
}
```

* afficher les informations d'un article

```
{
	"data" : {
		"id": 1,
		"title": "Article 1",
		...
	}
}
```

* Créer un article


## Bonus

Utilisez Docker pour faire tourner votre projet.


## Note importante

Vous devrez nous fournir le code source (ou un lien vers GitHub par exemple), ainsi que les instructions pour utiliser et faire tourner votre projet.
