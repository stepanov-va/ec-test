<?php

namespace App\DataFixtures;

use App\Model\Microservice\Entity\MicroserviceSettings;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class MicroserviceSettingsFixture extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $rest = new MicroserviceSettings(
            'rest',
            [
                'field1' => 'value',
                'field2' => true,
                'field3' => [
                    'field1' => 'value1',
                    'field2' => 'value2',
                ]
            ]
        );

        $grpc = new MicroserviceSettings(
            'grpc',
            [
                'field1' => 'value',
                'field2' => true,
                'field3' => 1
            ]
        );

        $http = new MicroserviceSettings(
            'http',
            [
                'field1' => false,
                'field2' => 5,
                'field3' => [
                    'field1' => 'value',
                    'field2' => 10
                ]
            ]
        );

        $manager->persist($rest);
        $manager->persist($grpc);
        $manager->persist($http);

        $manager->flush();
    }
}