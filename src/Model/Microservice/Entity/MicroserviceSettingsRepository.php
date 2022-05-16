<?php

namespace App\Model\Microservice\Entity;

use App\Model\EntityNotFoundException;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class MicroserviceSettingsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, MicroserviceSettings::class);
    }

    public function getByName(string $name): MicroserviceSettings
    {
        $settings = $this->findOneBy(['name' => $name]);

        if (!$settings) {
            throw new EntityNotFoundException('Settings are not found');
        }

        return $settings;
    }

    public function add(MicroserviceSettings $settings): void
    {
        $this->_em->persist($settings);
    }

    public function update(MicroserviceSettings $settings): void
    {
        $this->_em->persist($settings);
        $this->_em->flush();
    }

    public function flush(): void
    {
        $this->_em->flush();
    }
}