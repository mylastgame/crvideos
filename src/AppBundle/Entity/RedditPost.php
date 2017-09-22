<?php

/**
 * Created by PhpStorm.
 * User: root
 * Date: 16.09.17
 * Time: 11:20
 */
namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * Class RedditPost
 * @package AppBundle\Entity
 * @ORM\Entity(repositoryClass="AppBundle\Entity\Repository\RedditPostRepository")
 * @ORM\Table(name="reddit_posts")
 */
class RedditPost
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", length=555)
     */
    protected $title;

    /**
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\RedditAuthor", inversedBy="posts")
     * @ORM\JoinColumn(name="author_id", referencedColumnName="id")
     */
    protected $author;

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }


    /**
     * @return mixed
     */
    public function getTitle()
    {
        return $this->title;
    }

    /**
     * @param mixed $title
     */
    public function setTitle($title)
    {
        $this->title = $title;
    }

    /**
     * @return mixed
     */
    public function getAuthor()
    {
        return $this->author;
    }

    /**
     * @param mixed $author
     */
    public function setAuthor($author)
    {
        $this->author = $author;
    }


}