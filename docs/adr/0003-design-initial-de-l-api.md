# 3. Design initial de l'api

Date: 2020-11-24

- Décideurs: [Alexis Janvier](https://github.com/orgs/CaenCamp/people/alexisjanvier)
- Ticket.s concerné.s: -
- Pull.s Request.s: -

## Statut

<!-- les statuts sont en anglais : proposed/accepted/done/deprecated/superseded -->
2020-11-24 proposed

## Contexte et énoncé du problème

La toute première étape de la migration des contenus depuis l'ancien site en [Gatsby](https://www.gatsbyjs.com/) vers la nouvelle API consiste à trouver une design d'API qui soit sémantiquement valide et globalement reconnu (par exemple en se basant sur schema.org), et de faire correspondre les données portées dans les fichiers markdown du contenu initial avec ce design d'API.

### Rappel du fonctionnement actuel

Chaque objet markdown s'appuie sur un [`front matter`](https://odetocode.com/blogs/scott/archive/2020/01/30/markdown-front-matter-for-metadata.aspx) en `yaml` pour gérer les propriétés.

Les objets principaux sont les `Talks`, identifiés par le numero de l'édition. Le ou les `Speakers` sont rattachés à un talk via leur `slug`.

Dans le cas ou une édition aurait un ou des `Lightnings` talks, on l'associe à une édition via ... le numéro d'édition.

Un talk est associé à une `Place`, mais en vrai les lieux ne sont pas gérés.

Les `Devops` CaenCamp sont presque identiques aux `Talks`, sauf que le front matter porte les talks.

Les sessions de `Codings` CaenCamp sont aussi très proche des `Talks`, à la différence qu'elles ne sont pas associées à un ou des `Speakers`.

## Options envisagées

- **[Option 1]** - Faire un design correspondant aux données existante, puis le faire évoluer vers les descriptions schema.org existantes
- **[Option 2]** - Faire notre propre description sémantique de contenu (RDFa ?) et ne pas utiliser schema.org afin de limiter le mapping avec les données existantes
- **[Option 3]** - Établir le design d'API en se basant sur schema.org, établir un modèle d'objets correspondant à l'existant, et faire un mapping intermédiaire entre nos objets et le schema d'API.

## Résultat de la décision

Option choisie : "[option 1]", parce que [justification. par exemple, seule l'option qui répond au critère de k.o. déterminant la décision | qui résout la force | ... | est la meilleure (voir ci-dessous)].

### Conséquences positives <!-- facultatif -->

* [par exemple, amélioration de la satisfaction des attributs de qualité, décisions de suivi requises, ...]
* …

### Conséquences négatives <!-- facultatif -->

* [par exemple, attribut de qualité compromettant, décisions de suivi requises, ...]
* …

## Avantages et inconvénients des options <!-- facultatif -->

### [option 1] Faire un design correspondant aux données existante, puis le faire évoluer vers les descriptions schema.org existantes



### [option 2]

[exemple | description | pointeur vers plus d'informations | ...] <!-- facultatif -->

* Bien, parce que [argument a]
* Bien, parce que [argument b]
* Mauvais, parce que [argument c]
* ... <!-- le nombre de pour et de contre peut varier -->

### [option 3]

[exemple | description | pointeur vers plus d'informations | ...] <!-- facultatif -->

* Bien, parce que [argument a]
* Bien, parce que [argument b]
* Mauvais, parce que [argument c]
* ... <!-- le nombre de pour et de contre peut varier -->

## Liens <!-- facultatif -->

* [Type de lien] [Lien vers l'ADR] <!-- exemple : Raffiné par [ADR-0005](0005-exemple.md) -->
* ... <!-- le nombre de liens peut varier -->

## Annexes

### Les objets schema.org

#### Events

| Props               | Type                                                        |
| ------------------- | ----------------------------------------------------------- |
| startDate           | DateTime                                                    |
| endDate             | DateTime                                                    |
| duration            | Duration                                                    |
| eventAttendanceMode | EventAttendanceModeEnumeration                              |
| location            | Place or VirtualLocation                                    |
| organizer           | Organization                                                |
| performer           | Person, Supersedes performers.                              |
| recordedIn          | CreativeWork                                                |
| sponsor             | Organization                                                |
| subEvent            | Event, Supersedes subEvents -  Inverse property: superEvent |
| superEvent          | Event                                                       |
| --                  | --                                                          |
| additionalType      | Url                                                         |
| description         | Text                                                        |
| identifier          | Text or Url                                                 |
| image               | ImageObject or Url                                          |
| name                | text                                                        |

#### Place

| Props       | Type               |
| ----------- | ------------------ |
| address     | PostalAddress      |
| --          | --                 |
| description | Text               |
| identifier  | Text or Url        |
| image       | ImageObject or Url |
| name        | text               |

#### PostalAddress

| Props           | Type |
| --------------- | ---- |
| addressCountry  | Text |
| addressLocality | Text |
| postalCode      | Text |
| streetAddress   | Text |

#### Person

| Props          | Type               |
| -------------- | ------------------ |
| givenName      | Text (first name)  |
| additionalName | Text               |
| --             | --                 |
| description    | Text               |
| identifier     | Text or Url        |
| image          | ImageObject or Url |
| name           | text               |

#### Organization

| Props       | Type               |
| ----------- | ------------------ |
| memberOf    | Organization       |
| --          | --                 |
| description | Text               |
| identifier  | Text or Url        |
| image       | ImageObject or Url |
| name        | text               |

#### CreativeWork

| Props      | Type        |
| ---------- | ----------- |
| abstract   | Text        |
| --         | --          |
| url        | Url         |
| identifier | Text or Url |


### Les données markdown

#### Talks et Ligntnings

```markdown
--- //front matter en yaml
edition: le numero de l'edition (integer)
meetupId: l'identifiant de l'annonce sur meetup.com
title: Titre du talk
slug: le slug pour générer l'url - gestion manuelle sur le forme edition-xx-titre-du-talk
date: Date et heure au format 2018-11-27 18:30:00
description: "une courte présentation en texte"
tags:
- tag 1
- tag 2
speakers:
- slug-du-speaker
place: slug-du-lieu
video: url youtube
picture: nom du fichier
published: boolean
---

Le contenu de présentation avec un formatage markdown

```

Remarque: on se base sur `edition` pour associer un talk et un lightning talk à une même session.

#### Devops

```markdown
--- //front matter en yaml
edition: le numero de l'edition (integer)
meetupId: l'identifiant de l'annonce sur meetup.com
title: Titre du talk
slug: le slug pour générer l'url - gestion manuelle sur le forme edition-xx-titre-du-talk
date: Date et heure au format 2018-11-27 18:30:00
description: "une courte présentation en texte"
tags:
- tag 1
- tag 2
talks:
- title: titre première pres
    speakers:
    - slug-speaker 
- title: titre seconde pres
    speakers:
    - slug-speaker
place: slug-du-lieu
video: url youtube
picture: nom du fichier
published: boolean
---

Le contenu de présentation avec un formatage markdown

```

#### Speakers

```markdown
--- //front matter en yaml
firstName: prénom
lastName: nom
slug: : le slug pour générer l'url - gestion manuelle sur le forme prenom-nom
resume: une courte présentation en texte
picture: nom de l'image
links:
-   title: titre du lien - utiliser pour l'affichage de l'icône (twitter, github, ...)
    url: url du lien
---

Le contenu de présentation avec un formatage markdown
```

#### Codings

```markdown
--- //front matter en yaml
edition: le numero de l'edition (integer)
meetupId: l'identifiant de l'annonce sur meetup.com
title: Titre du talk
slug: le slug pour générer l'url - gestion manuelle sur le forme edition-xx-titre-du-talk
date: Date et heure au format 2018-11-27 18:30:00
description: "une courte présentation en texte"
place: slug-du-lieu
image: nom du fichier
published: boolean
---

Le contenu de présentation avec un formatage markdown

```