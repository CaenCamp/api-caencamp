<?php

namespace App\DataFixtures;

use App\Entity\Internal\Speaker;
use App\Entity\Internal\WebSite;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Mni\FrontYAML\Parser;
use Html2Text\Html2Text;

class DojoFixture extends Fixture
{
    public function load(ObjectManager $manager)
    {
        /* $parser = new Parser(); */
        /* $dojoPath = getcwd() . '/data/markdown/dojos'; */
        /* $files = scandir($dojoPath); */
        /* for ($i = 2; $i < count($files); $i++) { */
        /*     $file = file_get_contents($dojoPath . '/' . $files[$i], true); */
        /*     $document = $parser->parse($file, false); */
        /*     $documentHtml = $parser->parse($file); */
        /*     $yaml = $document->getYAML(); */
        /*     $markdown = $document->getContent(); */
        /*     $html = $documentHtml->getContent(); */
        /*     $html2TextConverter = new Html2Text($html); */
        /*     $description = $html2TextConverter->getText(); */
        /*     dump($yaml); */
        /* } */
        $manager->flush();
    }

    public function getDependencies()
    {
        return array(
            AppFixtures::class,
            SpeakerFixtures::class,
        );
    }
}
