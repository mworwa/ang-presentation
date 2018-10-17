<?php
/**
 * Created by PhpStorm.
 * User: marcinworwa
 * Date: 16/10/2018
 * Time: 18:33
 */

namespace App\Controller;


use App\Entity\Beer;
use App\Repository\BeerRepository;
use FOS\RestBundle\Controller\Annotations as Rest;
use FOS\RestBundle\Controller\FOSRestController;
use FOS\RestBundle\View\View;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class BeerController extends FOSRestController
{
    /**
     * @Rest\Post("/api/beers")
     */
    public function addBeer(Request $request)
    {
        $beer = new Beer();
        $beer->setName($request->get('name'));
        $beer->setCity($request->get('city'));
        $beer->setPrice($request->get('price'));

        $em = $this->getDoctrine()->getManager();
        $em->persist($beer);
        $em->flush();

        return new View($beer, 201);
    }

    /**
     * @Rest\Put("/api/beers/{id}")
     * @param Request $request
     * @param BeerRepository $repository
     * @param int $id
     * @return View
     */
    public function updateBeer(Request $request, BeerRepository $repository, int $id)
    {
        $beer = $repository->find($id);
        if (!$beer) {
            return new View('Beer with id ' . $id . ' not found', 404);
        }
        $beer->setName($request->get('name'));
        $beer->setCity($request->get('city'));
        $beer->setPrice($request->get('price'));

        $em = $this->getDoctrine()->getManager();
        $em->persist($beer);
        $em->flush();

        return new View($beer);
    }

    /**
     * @Rest\Get("/api/beers/{id}")
     * @param BeerRepository $repository
     * @param int $id
     * @return View
     */
    public function getBeer(BeerRepository $repository, int $id)
    {
        $beer = $repository->find($id);
        if (!$beer) {
            return new View('Beer with id ' . $id . ' not found', 404);
        }
        return new View($beer);
    }

    /**
     * @Rest\Get("/api/beers")
     * @param BeerRepository $repository
     * @return View
     */
    public function getBeers(BeerRepository $repository)
    {
        $beers = $repository->findAll();
        return new View($beers);
    }
}