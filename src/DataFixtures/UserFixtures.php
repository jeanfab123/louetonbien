<?php

namespace App\DataFixtures;

use Faker;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\OrderedFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\User;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class UserFixtures extends Fixture implements OrderedFixtureInterface
{

    public function __construct(UserPasswordEncoderInterface $encoder)
    {
        $this->encoder = $encoder;
    }

    public function load(ObjectManager $manager)
    {

        $faker = Faker\Factory::create('fr_FR');

        for ($cpt = 0; $cpt <= mt_rand(0, 200); $cpt++) {
            $user = new User();
            $user
                ->setUsername($faker->userName)
                ->setEmail($faker->email)
                ->setLastname($faker->lastName)
                ->setFirstname($faker->firstName)
                ->setAddress($faker->streetAddress)
                ->setZipcode((int) substr($faker->postcode, 0, 5))
                ->setCity($faker->city)
                ->setCountry($faker->country)
                ->setPassword($this->encoder->encodePassword($user, 'demo'));
            $manager->persist($user);
            $manager->flush();
        }
    }

    public function getOrder()
    {
        return 1;
    }
}
