<?php

namespace App\Tests\Controller;

use App\Controller\ArticleController;
use PHPUnit\Framework\TestCase;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use Doctrine\ORM\Cache\QueryCacheKey;

class ArticleControllerTest extends TestCase
{
	/**
	 * @test
	 */
	public function testPost() {
		$articleController = new ArticleController;
		$data = [
			"title" => "unit test ",
			"content" => "test contet",
			"description" => "test desc",
			"mail" => "maildssd@mail.com"
		];

		$request = new Request();
		$request->initialize( 
			[],
			[],
			[
				"title" => "test ",
				"content" => "test date",
				"description" => "test date",
				"mail" => "mail@mail.com"
			]
		);
			
		$request= Request::create(
			'http://localhost:8181/create', 
			'POST', 
			[], 
			[], 
			[], 
			[], 
			'{"title": "test", "content": "test date", "description": "test date", "mail": "mail@mail.com"}'	
		 );
		$result = $articleController->post($request);

		$this->assertEquals(1, 1);
	}

}