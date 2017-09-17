<?php

namespace AppBundle\Controller;

use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use AppBundle\Entity\RedditPost;

class RedditController extends Controller
{
    /**
     * @Route("/", name="list")
     */
    public function indexAction()
    {
        $posts = $this->getDoctrine()
            ->getRepository('AppBundle:RedditPost')
            ->findAll();
        dump($posts);
        // replace this example code with whatever you need
        return $this->render('reddit/index.html.twig', [
            'posts' => $posts
        ]);
    }

    /**
     * @Route("/create/{text}", name="create")
     * @param $text
     */
    public function createAction($text)
    {
        $post = new RedditPost();
        $post->setTitle('Hello ' . $text);

        $em = $this->getDoctrine()->getManager();
        $em->persist($post);
        $em->flush();

        return $this->redirectToRoute('list');
    }

    /**
     * @Route("/update/{id}/{text}", name="update")
     */
    public function updateAction($id, $text)
    {
        $em = $this->getDoctrine()->getManager();

        $post = $em->getRepository('AppBundle:RedditPost')->find($id);

        if (!$post) {
            throw $this->createNotFoundException('record not found');
        }

        /** @var $post RedditPost */
        $post->setTitle($text);

        $em->flush();

        return $this->redirectToRoute('list');
    }

    /**
     * @Route("/delete/{id}", name="delete")
     */
    public function deleteAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $post = $em->getRepository('AppBundle:RedditPost')->find($id);

        if (!$post) {
            throw $this->createNotFoundException('record not found');
        }

        $em->remove($post);
        $em->flush();

        return $this->redirectToRoute('list');
    }

    /**
     * @Route("/scrape", name="scrape")
     */
    public function scrapeAction()
    {
        /** @var \AppBundle\Service\RedditScraper $s */
        $s = $this->get('reddit_scraper');
        $s->scrape();

        return $this->redirectToRoute('list');
    }
}
