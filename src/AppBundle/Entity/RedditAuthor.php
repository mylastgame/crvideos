<?php
/**
 * Created by PhpStorm.
 * User: root
 * Date: 16.09.17
 * Time: 13:15
 */

namespace AppBundle\Entity;


use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Entity
 * @ORM\Table(name="reddit_author", indexes={
 *     @ORM\Index(name="index_author_name", columns={"name"})
 * })
 */
class RedditAuthor
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     * @ORM\Column(type="integer")
     */
    protected $id;
    /**
     * @ORM\Column(type="string", unique=true)
     */
    protected $name;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\RedditPost", mappedBy="author")
     */
    protected $posts;

    function __construct()
    {
        $this->posts = new ArrayCollection();
    }

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
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getPosts()
    {
        return $this->posts;
    }

    /**
     * @param mixed $posts
     */
    public function setPosts($posts)
    {
        $this->posts = $posts;
    }

    /**
     * @param mixed $id
     */
    public function addPost(RedditPost $post)
    {
        if (!$this->posts->contains($post)) {
            $post->setAuthor($this);
            $this->posts->add($post);
        }
    }
}