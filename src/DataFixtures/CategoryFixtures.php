<?php

namespace App\DataFixtures;

use App\Entity\Category;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class CategoryFixtures extends Fixture
{
  public function load(ObjectManager $manager): void
  {
    $category = [
      1 => [
        'nom'         => 'Bouquets',
        'slug'        => 'Bouquets',
        'description' => 'Livraison de bouquet de fleurs en 4h à Paris et 24h en France',
        'hn'          => 'Bouquets de fleurs',
        'titre'       => 'Livraison de fleurs en 4H'
      ],
      2 => [
        'nom'         => 'rose',
        'slug'        => 'rose',
        'description' => 'Livraison de bouquet de rose en 4h à Paris et 24h en France',
        'hn'          => 'Bouquets de rose',
        'titre'       => 'Livraison de rose en 4H'
      ],
      3 => [
        'nom'         => 'Rhododindron',
        'slug'        => 'Rhododindron',
        'description' => 'Livraison de bouquet de Rhododindron en 4h à Paris et 24h en France',
        'hn'          => 'Bouquets de Rhododindron',
        'titre'       => 'Livraison de Rhododindron en 4H'
      ],
      4 => [
        'nom'         => 'Rafflesia',
        'slug'        => 'Rafflesia',
        'description' => 'Livraison de bouquet de Rafflesia en 4h à Paris et 24h en France',
        'hn'          => ' de Rafflesia',
        'titre'       => 'Livraison de Rafflesia en 4H'
      ],
      5 => [
        'nom'         => 'Boustiflor',
        'slug'        => 'Boustiflor',
        'description' => 'Livraison de bouquet de Boustiflor en 4h à Paris et 24h en France',
        'hn'          => 'Boustiflor de fleurs',
        'titre'       => 'Livraison de fleurs en 4H',
      ],
    ];


    foreach ($category as $key => $value) {
      $cat = new Category();
      $cat->setName($value['nom']);
      $cat->setSlug($value['slug']);
      $cat->setMetaDescription($value['description']);
      $cat->setHn($value['hn']);
      $cat->setTitle($value['titre']);
      $manager->persist($cat);

      $this->addReference('category_' .$key, $cat);

    }
    $manager->flush();
  }
}