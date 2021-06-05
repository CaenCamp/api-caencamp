<?php

namespace App\DataFixtures;

use App\Entity\Speaker;
use App\Entity\WebSite;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Mni\FrontYAML\Parser;
use Html2Text\Html2Text;

class SpeakerFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $parser = new Parser();
        $speakerPath = getcwd() . '/data/markdown/speakers';
        $files = scandir($speakerPath);
        for ($i = 2; $i < count($files); $i++) {
            $file = file_get_contents($speakerPath . '/' . $files[$i], true);
            $document = $parser->parse($file, false);
            $documentHtml = $parser->parse($file);
            $yaml = $document->getYAML();
            $markdown = $document->getContent();
            $html = $documentHtml->getContent();
            $html2TextConverter = new Html2Text($html);
            $bio = $html2TextConverter->getText();
            /* dump($yaml); */
            $speaker = new Speaker();
            $speaker->setName(trim($yaml['firstName'] . ' ' . $yaml['lastName']));
            $speaker->setSlug($yaml['slug']);
            $speaker->setShortBiography($yaml['resume']);
            $speaker->setBiography($bio);
            $speaker->setBiographyHtml($html);
            $speaker->setBiographyMarkdown($markdown);
            $websites = $yaml['links'];
            if (is_array($websites)) {
                for ($j = 0; $j < count($websites); $j++) {
                    $site = new WebSite();
                    switch ($websites[$j]['title']) {
                    case 'github':
                        $site->setType($this->getReference(AppFixtures::WS_GITHUB));
                        break;
                    case 'linkedin':
                        $site->setType($this->getReference(AppFixtures::WS_LINKEDIN));
                        break;
                    case 'twitter':
                        $site->setType($this->getReference(AppFixtures::WS_TWITTER));
                        break;
                    default:
                        $site->setType($this->getReference(AppFixtures::WS_PERSO));
                    }
                    $site->setUrl($websites[$j]['url']);
                    $manager->persist($site);
                    $speaker->addWebSite($site);
                }
            }
            $manager->persist($speaker);
        }

        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            AppFixtures::class,
        );
    }
}
