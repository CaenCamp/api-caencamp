# 2. Pourquoi choisir API Plateform

Date: 2020-11-15

-   Décideurs: [Alexis Janvier](https://github.com/orgs/CaenCamp/people/alexisjanvier)
-   Ticket.s concerné.s: -
-   Pull.s Request.s: -

## Statut

<!-- proposed/accepted/done/deprecated/superseded -->
2020-11-15 accepted

## Contexte et énoncé du problème

En ce moment de lancement de la saison 3 des Coding Caen.Camp.s, tous les contenus du site sont encore sous la forme de fichiers mardown, et le site est généré via un générateur de site statique : [Gatsby](https://www.gatsbyjs.com/).

Hors, l'objectif de cette 3ème saison est de fournir des outils de gestion du réseau des Caen.Camp, et la gestion des contenus via des fichiers marckdown risque de ne plus suffir (annuaires, offres d'emploi, fédération de meetup ...). 

Il faut donc mettre en place une API permettant de consulter, mais aussi de gérer (CRUD) ces contenus.

## Moteurs de décision

* L'API devra être de type Rest et respecter une spécification HATEOAS reconnue (JSON-API, Hydra, ... à choisir mais une spec)
* L'API devra être documentée via un contrat OpenAPI
* L'API devra servir des documents au format JSON mais aussi JSON-LD (pour avoir du contenu facilitant l'interopérabilité)
* Idéalement, l'API pourrait avoir un version GraphQL

## Options envisagées

1. Repartir de la stack node/express utilisée lors de la *saison 2* (projet [jobBoard](https://github.com/CaenCamp/jobs-caen-camp))
2. Partir sur une stack [API Plateform](https://api-platform.com/)
3. Rechercher une stack répondant au critère dans une démarche d'exploration ([rweb](https://github.com/kdy1/rweb) en Rust par exemple)

## Résultat de la décision

Option choisie : **[2] - API Platform**, parce que ce framework répond à toutes les spécifications (Hydra, OpenAPI, JSON-LD, GraphQL) et offre beaucoups d'outils permettant d'accélérer le développement (console, ORM, migration, déploiement, tests fonctionnels, ...).

### Conséquences positives

* Acceleration du développement
* Respect des standards
* Participation des développeurs Php facilitée
* Base solide pour se lancer dans la décentratlisation (Bundle [API Platform ActivityPub](https://github.com/api-platform/activity-pub))

### Conséquences négatives

* On ne pourra pas reprendre directement les développement déjà réalisés sur le jobBoard
* L'approche "full-stack" sera plus compliqué, en entroduisant un nouveau language dans la stack.
* L'approche configuration-first de Symfony :trollface:

## Avantages et inconvénients des autres autres options

### [1] - Stack JS du JobBoard

Le jobBoard a été codé avec une approche "full JS". Le partie back a été développé en Koa, avec une dba PostgreSQL (avec le query builder Knex). Si cette approche a été riche en découvertes (approche assez bas niveau du développement avec la mise en place manuelle des middlewares, l'absence d'ORM, ...), cela a fortement ralenti le développement. Pour cette troisième saison, où nous visons d'abord la finalisation des outils avant l'approche d'apprentissage (même si cela ne l'exlue pas), cette stack JS manque encore d'outils pour accélérer le developpement.

### [3] - Découverte d'une nouvelle stack sur une nouvelle techno, type Rust, Clojure ou Go

La découverte et l'apprentissage restent le moteur principal des CCC. Mais cette facette devra être temporairement mise de côté sur la partie language / outils, pour se focaliser sur les protocoles, les standards. Du coup, une fois les outils développés et les standards et protocoles maitrisés et/ou établis (par exemple avec une onthologie de nos contenus, un contrat OpenAPI rédigé), rien ne nous empêchera de les implémenter sur d'autres technologies. Ce sera même plus facile de se concentrer sur cette technologie, d'en peser les avantages ou les inconvénients !

