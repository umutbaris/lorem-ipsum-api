<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Entity\Article;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Serializer;
use App\Form\Type\Articles;
use Mailgun\Mailgun;



class ArticleController extends AbstractController
{
	
	/**
	 * Listing
	 *
	 * @return void
	 */
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
				'mail' => $item->getEmail(),
				'post_status' => $item->getPostStatus(),
				'created_date' => $item->getCreatedDate()
			];
		}
	
		$this->checkCreatedDate();
		return new JsonResponse($arrayCollection);


	}

	/**
	 * post
	 *
	 * @param Request $request
	 * @return void
	 */
	public function post (Request $request)
	{

		if ( !empty($request->get('title') ) && !empty($request->get('content') )
		&& !empty($request->get('description') ) && !empty($request->get('mail') )
		) {
			$article = new Article;
			$article->setTitle($request->get('title'));
			$article->setContent($request->get('content'));
			$article->setDescription($request->get('description'));
			$article->setEmail($request->get('mail'));
			$article->setPostStatus('pending');
			$article->setCreatedDate(date('Y-m-d h:i:s', time()));

			$em = $this->getDoctrine()->getManager();
			$em->persist($article);
			$em->flush();
			return new JsonResponse('200, Post Adding Successfully');
		} else {
			return new JsonResponse('401, You should enter all required fields');
			
		}
	}


	/**
	 * put
	 *
	 * @param Request $request
	 * @return void
	 */
	public function put (Request $request)
	{
		if ( !empty($request->get('id') ) && !empty($request->get('post_status') ) ) {
			$em = $this->getDoctrine()->getManager();
			$id = $request->get('id');
			$article = $em->getRepository('App:Article')->find($id);
			$article->setPostStatus($request->get('post_status'));
			$em->flush();

			if ( $request->get('post_status') == 'approved' ) {
				$mg = Mailgun::create('75e8af8778877658427b9950ca3985cc-acb0b40c-d0e0beaf');
				$mg->messages()->send('example.com', [
					'from'    => 'bob@example.com',
					'to'      => 'umutbariskarasar@outlook.com',
					'subject' => 'Hello',
					'text'    => 'Your post is published !'
				]);

				return new JsonResponse('200, Post Status updated Successfully');
			} else {
				return new JsonResponse('500, Mail Error');
			}
		} else {
			return new JsonResponse('401, Post Status Can not updated Successfully');
			
		}
	}


	/**
	 * delete
	 *
	 * @param Request $request
	 * @return void
	 */
	public function delete (Request $request)
	{
		if ( !empty($request->get('id') ) ) {
			$em = $this->getDoctrine()->getManager();
			$id = $request->get('id');
			$article = $em->getRepository('App:Article')->find($id);
			$em->remove($article);
			$em->flush();
			return new JsonResponse('200, Post deleted Successfully');
		} else {
			return new JsonResponse('401, Post Status Can not updated Successfully');
		}
	}

	public function checkCreatedDate( ) {
		$em = $this->getDoctrine()->getManager();
		$articles = $em->getRepository('App:Article')->findAll();
		foreach($articles as $article) {
			$current_time = date('Y-m-d h:i:s', time());
			$date_difference = abs(strtotime($current_time) - strtotime($article->getCreatedDate()));
			if ( $date_difference > 300 &&  $article->getPostStatus() == 'pending'){
				$article->setPostStatus('AutoRejected');
				$em->flush();
			}
		}
	}



}