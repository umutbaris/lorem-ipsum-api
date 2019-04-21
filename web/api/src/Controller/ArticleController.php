<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\Article;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\JsonResponse;

class ArticleController extends AbstractController
{
	public function index()
	{
		$manager = $this->getDoctrine()->getManager();
		$articles = $manager->getRepository('App:Article')->findAll();
		$arrayCollection = [];

		foreach($articles as $item) {
			$arrayCollection[] = [
				'id' => $item->getId(),
				'title' => $item->getTitle(),
				'content' => $item->getContent(),
				'description' => $item->getDescription(),
				'mail' => $item->getEmail()
			];
		}

		return new JsonResponse($arrayCollection);
	}


}