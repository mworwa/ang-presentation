<?php
/**
 * Created by PhpStorm.
 * User: marcinworwa
 * Date: 15/10/2018
 * Time: 17:13
 */

namespace App\Factory\User;


use App\Entity\User;
use JMS\Serializer\SerializerBuilder;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class SecuredPasswordUserFactory implements UserFactory
{
    private $passwordEncoder;

    public function __construct(UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->passwordEncoder = $passwordEncoder;
    }

    public function createUser(string $jsonData)
    {
        $serializer = SerializerBuilder::create()->build();
        $user = $serializer->deserialize($jsonData, User::class, 'json');
        $password = $this->passwordEncoder->encodePassword($user, $user->getPlainPassword());
        $user->setPassword($password);
        return $user;
    }

}