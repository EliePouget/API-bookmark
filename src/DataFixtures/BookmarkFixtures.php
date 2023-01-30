<?php

namespace App\DataFixtures;

use App\Factory\BookmarkFactory;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class BookmarkFixtures extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $jsonBookmarks = json_decode(file_get_contents(__DIR__.'/data/bookmarks.json'), true);
        foreach ($jsonBookmarks as $bookmark) {
            BookmarkFactory::createOne($bookmark);
        }
    }
}
