# Backend Caen.Camp

![Tests](https://github.com/CaenCamp/api-caencamp/workflows/phpunit/badge.svg?branch=main) ![Top language](https://img.shields.io/github/languages/top/CaenCamp/api-caencamp.svg) ![Contributors](https://img.shields.io/github/contributors/CaenCamp/api-caencamp.svg) ![License](https://img.shields.io/github/license/CaenCamp/api-caencamp.svg) ![PRs Welcome](https://img.shields.io/badge/PRs-welcome-brightgreen.svg)

L'objectif des Caen.Camp.s est de créer un réseau de développeurs maillé au travers de rencontres (meetup, coding dojos, ...) organisées sur Caen.

Ce projet `Backend` regroupe les outils *non-visible* permettant la gestion de ce réseau (organisation des talks, présentations/annonces des prochaines rencontres, archives des rencontres passées, etc..).

Il s'agira dans un premier temps d'une **API Rest** exposant les talks (à venir et passé), les speakers, les lieux ayant hébergé les rencontres ainsi que les sponsors. Cette API servira 2 types de représentation :

1. JSON
2. JSON-LD

Nous envisageons également une version **GraphQL** de l'API.

Ce backend reposera principalement sur la brique technique [API Plateform](https://api-platform.com/)

<img src="https://pngimg.com/uploads/php/php_PNG3.png" width="100" /> <img src="https://www.nilobstat.com/media/1020/logo-symfony.png?width=100" width="100" /> <img src="https://pbs.twimg.com/profile_images/610895782170882048/9jNpgyfh_400x400.png" width="100" />

## Démarrage rapide

Le [guide du contributeur](./docs/CONTRIBUTING.md##lenvironnement-de-développement) détaille les pré-requis et les différents mode d’installation du projet. Mais en partant du postulat que `php 7.4` et `composer` sont installés sur votre environnement, vous pouvez lancer l’installation du projet avec la commande

```bash
make install
```

et lancer le backend avec :

```bash
make start
```

Le backend est alors disponible sur <http://localhost:8000>

## Participer au projet

Vous souhaitez participer ? Merci à vous :+1:

Et c’est très simple :

-   Si vous ne savez pas par où commencer, vous pouvez jeter un coup d’œil aux [**issues**](https://github.com/CaenCamp/api-caencamp/issues).
-   Voir les cartes des fonctionnalités à développer sur [**tableau Kanban**](https://github.com/orgs/CaenCamp/projects/2) du projet.
-   Une fois que vous savez quoi faire, vous pouvez consulter le [**guide du contributeur**](./docs/CONTRIBUTING.md) pour vous lancer.

Et si vous ne trouvez toujours pas quoi faire dans les issues existantes et/ou que vous avez d’autres idées, n’hésitez pas à créer une nouvelle issue.

## Trouver de la documentation

Certes, le [code et ses tests sont la meilleur documentation](https://martinfowler.com/bliki/CodeAsDocumentation.html).

Pour autant, le code ne fait pas tous le projet. Vous trouverez donc, en plus de code, des informations sur le projet dans :

- [le guide du contributeur](./docs/CONTRIBUTING.md)
- [le wiki du projet](https://github.com/CaenCamp/api-caencamp/wiki)
- [les ADR.s (notes sur les décisions d'architecture)](./docs/adr/README.md)

Si vous ne savez pas trop comment participer à un projet open-source, vous pouvez aussi jeter un oeil sur notre ["Petit guide de participation aux projets des CaenCamp.s pour ceux qui ne saurait pas trop par où commencer."](https://github.com/CaenCamp/coding-caen-camp)

## License

Les projets des Coding Caen.Camp.s sont sous license [GNU GPLv3](LICENSE)