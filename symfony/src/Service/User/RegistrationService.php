<?php
/**
 * Created by PhpStorm.
 * User: marcinworwa
 * Date: 15/10/2018
 * Time: 17:35
 */

namespace App\Service\User;


use App\Factory\User\UserFactory;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Validator\Validator\ValidatorInterface;

class RegistrationService
{
    private $userFactory;
    private $entityManager;
    private $validator;

    public function __construct(UserFactory $userFactory, EntityManagerInterface $entityManager, ValidatorInterface $validator)
    {
        $this->userFactory = $userFactory;
        $this->entityManager = $entityManager;
        $this->validator = $validator;
    }

    public function register(string $json)
    {
        $user = $this->userFactory->createUser($json);
        try {
            $this->entityManager->persist($user);
            $this->entityManager->flush();
        } catch (\Exception $exception) {
            return $exception->getMessage();
        }

        return $user;
    }
}