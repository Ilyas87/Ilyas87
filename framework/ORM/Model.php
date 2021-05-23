<?php


namespace Framework\ORM;

use Doctrine\ORM\EntityManager;
use Framework\Providers\DatabaseProvider;
use Framework\Providers\ViewProvider;

class Model {
    static function query() {
        /** @var EntityManager $manager */
        $manager = app(DatabaseProvider::class)->manager();
        return $manager->getRepository(static::class);
    }

    function save() {
        /** @var EntityManager $manager */
        $manager = app(DatabaseProvider::class)->manager();

        $manager->persist($this);
        $manager->flush();
    }

    function delete() {
        /** @var EntityManager $manager */
        $manager = app(DatabaseProvider::class)->manager();

        $manager->remove($this);
        $manager->flush();
    }
}