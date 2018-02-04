<?php
/**
 * Created by PhpStorm.
 * User: jack
 * Date: 04.02.18
 * Time: 17:17
 */

namespace App\DataFixtures\ORM;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;
use App\Entity\User;


class UserFixture extends Fixture
{
    private  $users = [[
        'username' => 'admin',
        'email' => 'example@gmail.com',
        'password' => '$2y$13$N.3SoU0.otDcWlDOGT3WXu7aVx.Yp4BoEk0trGQEEXaHw.ALSdwXy',
        'isActive' => '1',
    ]];

    public function load(ObjectManager $manager)
    {
        foreach ($this->users as $user) {
            $userTest = new User();

            $userTest->setUsername($user['username']);
            $userTest->setEmail($user['email']);

            $userTest->setPassword($user['password']);

//            $encoder = $this->container->get('security.password_encoder');
//            $password = $encoder->encodePassword($userTest, $userTest->getPassword());
//            $userTest->setPassword($password);

            $userTest->setUsername($user['username']);
            $userTest->setIsActive($user['isActive']);

            $manager->persist($userTest);
        }
        $manager->flush();
    }
}
