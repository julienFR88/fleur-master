<?php

namespace App\DataFixtures;

use Faker;
use App\Entity\User;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\Fixture;

class UserFixtures extends Fixture
{
  public function load(ObjectManager $manager): void
  {
    $faker = Faker\Factory::create();

    for ($i = 0; $i <= 20; $i++) {
      $user = new User();
    }

    $manager->flush();
  }
}
