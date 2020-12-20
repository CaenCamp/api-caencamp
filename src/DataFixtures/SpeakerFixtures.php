<?php

namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Mni\FrontYAML\Parser;

class SpeakerFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        // $product = new Product();
        // $manager->persist($product);
        /* $parser = new Parser(); */
        /* $talksPath = getcwd() . '/data/markdown/talks'; */
        /* $files = scandir($talksPath); */
        /* for ($i = 3; $i < count($files); $i++) { */
        /*     print $files[$i]."\n"; */
        /*     $file = file_get_contents($talksPath . '/' . $files[$i], true); */
        /*     $document = $parser->parse($file, false); */
        /*     $yaml = $document->getYAML(); */
        /*     $html = $document->getContent(); */
        /*     dump($yaml); */
        /*     dump($html); */
        /* } */

        $manager->flush();
    }
}
