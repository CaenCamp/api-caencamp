<?php

namespace App\DataFixtures;

use App\Entity\Edition;
use App\Entity\Talk;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Mni\FrontYAML\Parser;
use Html2Text\Html2Text;
use App\DataFixtures\TagFixture;
use App\DataFixtures\AppFixtures;
use App\DataFixtures\SpeakerFixtures;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;

class DojoFixture extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $parser = new Parser();

        // LES CODING DOJOS
        $dojoPath = getcwd() . '/data/markdown/dojos';
        $files = scandir($dojoPath);
        for ($i = 2; $i < count($files); $i++) {
            $file = file_get_contents($dojoPath . '/' . $files[$i], true);
            $document = $parser->parse($file, false);
            $yaml = $document->getYAML();
            $documentHtml = $parser->parse($file);
            $markdown = $document->getContent();
            $html = $documentHtml->getContent();
            $html2TextConverter = new Html2Text($html);
            $description = $html2TextConverter->getText();

            $edition = new Edition();
            $edition->setNumber($yaml['edition']);
            $edition->setTitle($yaml['title']);
            $edition->setPublished(true);
            $edition->setDescription($description);
            $edition->setDescriptionHtml($html);
            $edition->setDescriptionMarkdown($markdown);
            $edition->setStartDateTime(new \DateTime($yaml['date']));
            $edition->setShortDescription($yaml['description']);
            $edition->setOrganizer($this->getReference(AppFixtures::ORGA_CC));
            $edition->setSponsor(null);
            $edition->setCategory($this->getReference(AppFixtures::EDITION_CATEGORY_DOJO));
            $edition->setPlace($this->getReference(AppFixtures::PLACE_FORUM));
            $edition->setMode($this->getReference(AppFixtures::EDITION_MODE_OFFLINE));

            $talk = new Talk();
            $talk->setShortDescription($yaml['description']);
            $talk->setDescription($description);
            $talk->setDescriptionHtml($html);
            $talk->setDescriptionMarkdown($markdown);
            $talk->setTitle($yaml['title']);
            $talk->setType($this->getReference(AppFixtures::TT_CODING));
            foreach ($yaml['tags'] as $tag) {
                $dbTag = $manager->getRepository('App\Entity\Tag')->findOneByLabel($tag);
                if (!!$dbTag) {
                    $talk->addTag($dbTag);
                }
            }
            foreach ($yaml['craftsmen'] as $slug) {
                $speaker= $manager->getRepository('App\Entity\Speaker')->findOneBySlug($slug);
                if (!!$speaker) {
                    $talk->addSpeaker($speaker);
                }
            }
            $manager->persist($talk);

            $edition->addTalk($talk);

            $manager->persist($edition);
        }

        // LES CODING CaenCamp
        $cccPath = getcwd() . '/data/markdown/ccc';
        $files = scandir($cccPath);
        for ($i = 2; $i < count($files); $i++) {
            $file = file_get_contents($cccPath . '/' . $files[$i], true);
            $document = $parser->parse($file, false);
            $yaml = $document->getYAML();
            $documentHtml = $parser->parse($file);
            $markdown = $document->getContent();
            $html = $documentHtml->getContent();
            $html2TextConverter = new Html2Text($html);
            $description = $html2TextConverter->getText();

            $edition = new Edition();
            $edition->setNumber($yaml['edition']);
            $edition->setTitle($yaml['title']);
            $edition->setPublished(true);
            $edition->setDescription($description);
            $edition->setDescriptionHtml($html);
            $edition->setDescriptionMarkdown($markdown);
            $edition->setStartDateTime(new \DateTime($yaml['date']));
            $edition->setShortDescription($yaml['description']);
            $edition->setOrganizer($this->getReference(AppFixtures::ORGA_CC));
            $edition->setSponsor(null);
            $edition->setCategory($this->getReference(AppFixtures::EDITION_CATEGORY_CCC));
            if ($yaml['place'] === 'dome') {
                $place = $this->getReference(AppFixtures::PLACE_DOME);
            } else {
                $place = $this->getReference(AppFixtures::PLACE_HEY);
            }
            $edition->setPlace($place);
            $edition->setMode($this->getReference(AppFixtures::EDITION_MODE_OFFLINE));
            if (!!$yaml['meetupId']) {
                $edition->setMeetupId($yaml['meetupId']);
            }

            $talk = new Talk();
            $talk->setShortDescription($yaml['description']);
            $talk->setDescription($description);
            $talk->setDescriptionHtml($html);
            $talk->setDescriptionMarkdown($markdown);
            $talk->setTitle($yaml['title']);
            $talk->setType($this->getReference(AppFixtures::TT_CODING));
            $manager->persist($talk);

            $edition->addTalk($talk);

            $manager->persist($edition);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            AppFixtures::class,
            SpeakerFixtures::class,
            TagFixture::class,
        );
    }
}
