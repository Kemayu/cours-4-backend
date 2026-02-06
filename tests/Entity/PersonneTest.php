<?php

namespace App\Tests\Entity;

use App\Entity\Personne;
use PHPUnit\Framework\TestCase;

class PersonneTest extends TestCase
{
    public function testGetterAndSetter(): void
    {
        $personne = new Personne();

        $personne->setNom('Doe');
        $personne->setPrenom('John');
        $personne->setAge(30);

        $this->assertEquals('Doe', $personne->getNom());
        $this->assertEquals('John', $personne->getPrenom());
        $this->assertEquals(30, $personne->getAge());
    }
}
