<?php

namespace App\DataFixtures;

use App\Entity\EditionCategory;
use App\Entity\EditionMode;
use App\Entity\Organization;
use App\Entity\Place;
use App\Entity\TalkType;
use App\Entity\WebSiteType;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public const EDITION_CATEGORY_CC = 'cc';
    public const EDITION_CATEGORY_CCC = 'ccc';
    public const EDITION_CATEGORY_DCC = 'devops';
    public const EDITION_CATEGORY_DOJO = 'dojo';

    public const EDITION_MODE_ONLINE = 'online';
    public const EDITION_MODE_OFFLINE = 'offline';
    public const EDITION_MODE_MIXED = 'mixed';

    public const ORGA_CC = 'CaenCamp';
    
    public const PLACE_FORUM = 'forum';
    public const PLACE_DOME = 'dome';
    public const PLACE_HEY = 'hey';
    public const PLACE_IMIE = 'imie';
    public const PLACE_INCUBATION = 'incubation';

    public const TT_REGULAR = 'regular';
    public const TT_LIGHTNING = 'lightning';
    public const TT_CODING = 'coding';

    public const WS_TWITTER = 'twitter';
    public const WS_GITHUB = 'github';
    public const WS_LINKEDIN = 'linkedin';
    public const WS_PERSO = 'perso';

    public function load(ObjectManager $manager)
    {
        $twitter = new WebSiteType();
        $twitter->setLabel('twitter');
        $manager->persist($twitter);

        $github = new WebSiteType();
        $github->setLabel('github');
        $manager->persist($github);

        $linkedin = new WebSiteType();
        $linkedin->setLabel('linkedin');
        $manager->persist($linkedin);

        $perso = new WebSiteType();
        $perso->setLabel('github');
        $manager->persist($perso);

        $longTalk = new TalkType();
        $longTalk->setLabel('Regular');
        $longTalk->setDescription('Un talk standard de 45 min');
        $longTalk->setDurationInMinutes(45);
        $manager->persist($longTalk);

        $ligntning = new TalkType();
        $ligntning->setLabel('Lightning');
        $ligntning->setDescription('Un court talk de 5 min');
        $ligntning->setDurationInMinutes(5);
        $manager->persist($ligntning);

        $coding = new TalkType();
        $coding->setLabel('Dojo');
        $coding->setDescription('Une séance de code');
        $coding->setDurationInMinutes(180);
        $manager->persist($coding);

        $forum = new Place();
        $forum->setName('Forum digital');
        $forum->setDescription("Le Forum Digital propose une offre d’hébergement en pépinière ou en hôtellerie pour les entreprises développant des technologies numériques. Cet espace de 1000 m² propose de nombreux services pour créer, se former, s’informer, collaborer, échanger et coworker.");
        $forum->setUrl('https://www.caennormandiedeveloppement.fr/le-forum-digital/');
        $forum->setAddress1("Campus EffiScience | Bâtiment Erable");
        $forum->setAddress2("8 rue Léopold Sedar Senghor");
        $forum->setPostalCode("14460");
        $forum->setCity("Colombelles");
        $forum->setCountry("FR");
        $manager->persist($forum);

        $dome = new Place();
        $dome->setName('Le Dôme');
        $dome->setDescription("Centre de sciences de Caen Normandie, Le Dôme est un espace collaboratif d'innovation ouvert à tous les publics. Il propose des actions de culture scientifique et technique autour de projets réels de recherche et d'innovation.");
        $dome->setUrl('http://ledome.info/index.php');
        $dome->setAddress1("3 Esplanade Stéphane Hessel");
        $dome->setPostalCode("14000");
        $dome->setCity("Caen");
        $dome->setCountry("FR");
        $manager->persist($dome);

        $imie = new Place();
        $imie->setName('IMIE');
        $imie->setDescription("Ecole fermée !");
        $imie->setUrl('http://imie-ecole-informatique.fr/campus/caen.html');
        $imie->setAddress1(" 10 place François Mitterrand");
        $imie->setPostalCode("14200");
        $imie->setCity("Hérouville-Saint-Clair");
        $imie->setCountry("FR");
        $manager->persist($imie);

        $hey = new Place();
        $hey->setName('Hey! Coworking');
        $hey->setDescription("Hey! est le premier espace de coworking en centre-ville de CAEN");
        $hey->setUrl('https://www.imie-coworking.com/');
        $hey->setAddress1("47 quai de juillet");
        $hey->setPostalCode("14000");
        $hey->setCity("Caen");
        $hey->setCountry("FR");
        $manager->persist($hey);

        $incubation = new Place();
        $incubation->setName('Normandie Incubation');
        $incubation->setDescription("Incubateur de projets innovants depuis plus de 20 ans, nous vous accompagnons dans la création de votre startup.");
        $incubation->setUrl('https://www.normandie-incubation.com/');
        $incubation->setAddress1("17 rue Claude Bloch");
        $incubation->setPostalCode("14000");
        $incubation->setCity("Caen");
        $incubation->setCountry("FR");
        $manager->persist($incubation);

        $editionCategoryCC = new EditionCategory();
        $editionCategoryCC->setLabel("CaenCamp");
        $editionCategoryCC->setDescription("Les rendez-vous des CaenCamp.s");
        $manager->persist($editionCategoryCC);

        $editionCategoryCCC = new EditionCategory();
        $editionCategoryCCC->setLabel("Coding CaenCamp");
        $editionCategoryCCC->setDescription("Les rendez-vous des Coding CaenCamp.s");
        $manager->persist($editionCategoryCCC);

        $editionCategoryDCC = new EditionCategory();
        $editionCategoryDCC->setLabel("Devops CaenCamp");
        $editionCategoryDCC->setDescription("Les rendez-vous des Devops CaenCamp.s");
        $manager->persist($editionCategoryDCC);

        $editionCategoryDojo = new EditionCategory();
        $editionCategoryDojo->setLabel("Dojo CaenCamp");
        $editionCategoryDojo->setDescription("Le Coding Dojo des CaenCamp.s");
        $manager->persist($editionCategoryDojo);

        $editionModeOnline = new EditionMode();
        $editionModeOnline->setLabel('online');
        $manager->persist($editionModeOnline);

        $editionModeOffline = new EditionMode();
        $editionModeOffline->setLabel('offline');
        $manager->persist($editionModeOffline);

        $editionModeMixed = new EditionMode();
        $editionModeMixed->setLabel('mixed');
        $manager->persist($editionModeMixed);

        $caencamp = new Organization();
        $caencamp->setName("CaenCamp");
        $caencamp->setDescription("Le meetup des développeurs caennais");
        $caencamp->setUrl("https://caen.camp");
        $caencamp->setLogo("https://www.caen.camp/static/logoFondBlanc-278da657a83902f7d21083ade8e9ce7a.png");
        $manager->persist($caencamp);

        $sii = new Organization();
        $sii->setName("SII");
        $sii->setDescription("Fondé en 1979, le Groupe SII est une Entreprise de Services du Numérique à dimension internationale disposant d’une large couverture géographique avec 88 implantations réparties sur 4 continents.");
        $sii->setUrl("https://sii-group.com/fr-FR");
        $sii->setLogo("https://sii-group.com/themes/custom/sii/logo.svg");
        $manager->persist($sii);

        $imagile = new Organization();
        $imagile->setName("Imagile");
        $imagile->setDescription("Nous pensons et développons des applications web et mobiles qui plaisent à vos utilisateurs");
        $imagile->setUrl("https://www.imagile.fr/");
        $imagile->setLogo("https://hoodspot.fr/uploads/500/927/50092784300028/logo.jpg");
        $manager->persist($imagile);

        $manager->flush();
        $this->addReference(self::EDITION_CATEGORY_CC, $editionCategoryCC);
        $this->addReference(self::EDITION_CATEGORY_CCC, $editionCategoryCCC);
        $this->addReference(self::EDITION_CATEGORY_DCC, $editionCategoryDCC);
        $this->addReference(self::EDITION_CATEGORY_DOJO, $editionCategoryDojo);
        $this->addReference(self::EDITION_MODE_ONLINE, $editionModeOnline);
        $this->addReference(self::EDITION_MODE_OFFLINE, $editionModeOffline);
        $this->addReference(self::EDITION_MODE_MIXED, $editionModeMixed);
        $this->addReference(self::ORGA_CC, $caencamp);
        $this->addReference(self::PLACE_DOME, $dome);
        $this->addReference(self::PLACE_FORUM, $forum);
        $this->addReference(self::PLACE_HEY, $hey);
        $this->addReference(self::PLACE_IMIE, $imie);
        $this->addReference(self::PLACE_INCUBATION, $incubation);
        $this->addReference(self::TT_CODING, $coding);
        $this->addReference(self::TT_LIGHTNING, $ligntning);
        $this->addReference(self::TT_REGULAR, $longTalk);
        $this->addReference(self::WS_GITHUB, $github);
        $this->addReference(self::WS_LINKEDIN, $linkedin);
        $this->addReference(self::WS_PERSO, $perso);
        $this->addReference(self::WS_TWITTER, $twitter);
    }
}
