<?php
/**
 * Created by PhpStorm.
 * User: marcinworwa
 * Date: 10.10.2018
 * Time: 17:40
 */

namespace App\Controller;

use App\Repository\UserRepository;
use App\Service\User\RegistrationService;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Request;


class UserController extends FOSRestController
{
    /**
     * @Rest\Post("/api/user")
     */
    public function create(Request $request, RegistrationService $registrationService)
    {
        $user = $registrationService->register($request->getContent());
        return View::create($user);

    }

    /**
     * @Rest\Get("/api/user/{id}")
     */
    public function getSingleUser(UserRepository $repository, int $id)
    {
        $user = $repository->find($id);
        return View::create($user);
    }

}