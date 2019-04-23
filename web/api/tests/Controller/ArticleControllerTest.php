<?php

namespace App\Tests\Controller;

use App\Controller\ArticleController;
use PHPUnit\Framework\TestCase;


class ArticleControllerTest extends TestCase
{
	/**
	 * @test
	 */
	public function testPost() {
		$articleController = new ArticleController;
		$request = [
			"title" => "unit test ",
			"content" => "test contet",
			"description" => "test desc",
			"mail" => "maildssd@mail.com"
		];

		$request = file_get_contents('../MockData/mock-data.json');

		
		$result = $articleController->post($request);

		$this->assertEquals('200, Post Adding Successfully', $result);
	}

		
}