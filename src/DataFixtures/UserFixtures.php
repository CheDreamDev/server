<?php
/**
 * Created by PhpStorm.
 * User: jack
 * Date: 02.04.18
 * Time: 21:53
 */

namespace App\DataFixtures;

use App\Entity\User\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

/**
 * Class UserFixtures
 */
class UserFixtures extends Fixture
{
    /**
     * @param ObjectManager $manager
     */
    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setUsername('user')
             ->setPassword('123456')
             ->setEmail('user@example.com')
             ->setFacebookId('1234567890')
             ->setFirstName('John')
             ->setLastName('Doe')
             ->setAbout('about text')
             ->setBirthday(new \DateTime('1990-02-02'));

        $manager->persist($user);
        $manager->flush();
    }
}
