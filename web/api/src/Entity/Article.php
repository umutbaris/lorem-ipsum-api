<?php

namespace App\Entity;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints as Assert;

/**
 * @ORM\Entity(repositoryClass="App\Repository\ArticleRepository")
 */
class Article
{
	/**
	 * @ORM\Id()
	 * @ORM\GeneratedValue()
	 * @ORM\Column(type="integer")
	 */
	private $id;

	/**
	 * @ORM\Column(type="string", length=60)
	 */
	private $title;

	/**
	 * @ORM\Column(type="string", length=255)
	 */
	private $Description;

	/**
	 * @ORM\Column(type="text", length=16383)
	 */
	private $content;

	/**
	 * @ORM\Column(type="string", length=300)
	 */
	private $email;

	/**
	 * @ORM\Column(type="string", length=50)
	 */
	private $post_status;

	/**
	 * @ORM\Column(type="string", length=255)
	 */
	private $createdDate;

	public function getId(): ?int
		 	{
		 		return $this->id;
		 	}

	public function getTitle(): ?string
		 	{
		 		return $this->title;
		 	}

	public function setTitle(string $title): self
		 	{
		 		$this->title = $title;
		 
		 		return $this;
		 	}

	public function getDescription(): ?string
		 	{
		 		return $this->Description;
		 	}

	public function setDescription(string $Description): self
		 	{
		 		$this->Description = $Description;
		 
		 		return $this;
		 	}

	public function getContent(): ?string
		 	{
		 		return $this->content;
		 	}

	public function setContent(string $content): self
		 	{
		 		$this->content = $content;
		 
		 		return $this;
		 	}

	public function getEmail(): ?string
		 	{
		 		return $this->email;
		 	}

	public function setEmail(string $email): self
		 	{
		 		$this->email = $email;
		 
		 		return $this;
		 	}

	public function getPostStatus(): ?string
		 	{
		 		return $this->post_status;
		 	}

	public function setPostStatus(string $post_status): self
		 	{
		 		$this->post_status = $post_status;
		 
		 		return $this;
		 	}

	public function getCreatedDate(): ?string
			{
				return $this->createdDate;
			}

	public function setCreatedDate(string $createdDate): self
			{
				$this->createdDate = $createdDate;

				return $this;
			}

	
}
