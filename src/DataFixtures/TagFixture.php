<?php

namespace App\DataFixtures;

use App\Entity\Tag;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Mni\FrontYAML\Parser;

class TagFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $tags = array();
        $parser = new Parser();
        $dojoPath = getcwd() . '/data/markdown/dojos';
        $files = scandir($dojoPath);
        for ($i = 2; $i < count($files); $i++) {
            $file = file_get_contents($dojoPath . '/' . $files[$i], true);
            $document = $parser->parse($file, false);
            $yaml = $document->getYAML();
            foreach ($yaml['tags'] as $tag) {
                $tags[] = $tag;
            }
        }

        $talkPath = getcwd() . '/data/markdown/talks';
        $files = scandir($talkPath);
        for ($i = 2; $i < count($files); $i++) {
            $file = file_get_contents($talkPath . '/' . $files[$i], true);
            $document = $parser->parse($file, false);
            $yaml = $document->getYAML();
            foreach ($yaml['tags'] as $tag) {
                $tags[] = $tag;
            }
        }

        $lightningPath = getcwd() . '/data/markdown/lightnings';
        $files = scandir($lightningPath);
        for ($i = 2; $i < count($files); $i++) {
            $file = file_get_contents($lightningPath . '/' . $files[$i], true);
            $document = $parser->parse($file, false);
            $yaml = $document->getYAML();
            foreach ($yaml['tags'] as $tag) {
                $tags[] = $tag;
            }
        }

        $lightningPath = getcwd() . '/data/markdown/lightnings';
        $files = scandir($lightningPath);
        for ($i = 2; $i < count($files); $i++) {
            $file = file_get_contents($lightningPath . '/' . $files[$i], true);
            $document = $parser->parse($file, false);
            $yaml = $document->getYAML();
            foreach ($yaml['tags'] as $tag) {
                $tags[] = $tag;
            }
        }

        $sanitizedTags = array_unique($tags);
        sort($sanitizedTags);

        foreach ($sanitizedTags as $stag) {
            $cctag = new Tag();
            $cctag->setLabel($stag);
            $manager->persist($cctag);
        }

        $manager->flush();
    }
}
