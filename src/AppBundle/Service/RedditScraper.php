<?php

namespace AppBundle\Service;

use AppBundle\Entity\RedditAuthor;
use AppBundle\Entity\RedditPost;
use Doctrine\ORM\EntityManagerInterface;

class RedditScraper
{
    /**
     * @var EntityManagerInterface
     */
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function scrape()
    {
        $client = new \GuzzleHttp\Client([
            'headers' => [
                'User-Agent' => 'Mozilla/5.0 (Windows NT 10.0; Win64; x64)'
            ]
        ]);

        $after = null;
        for($i=0; $i<5; $i++) {
            $response = $client->request('GET', 'https://api.reddit.com/r/php.json?limit=25&after='.$after);
            $contents[$i] = json_decode($response->getBody()->getContents(), true);
            $after = $contents[$i]['data']['after'];
        }

        foreach($contents as $content) {
            foreach ($content['data']['children'] as $child) {

                $redditPost = new RedditPost();
                $redditPost->setTitle($child['data']['title']);

                $authorName = $child['data']['author'];

                $redditAuthor = $this->em->getRepository('AppBundle:RedditAuthor')->findOneBy([
                    'name' => $authorName
                ]);

                if (!$redditAuthor) {
                    $redditAuthor = new RedditAuthor();
                    $redditAuthor->setName($authorName);
                    $this->em->persist($redditAuthor);
                    $this->em->flush();
                }

//            $redditPost->setAuthor($redditAuthor);
                $redditAuthor->addPost($redditPost);
                $this->em->persist($redditPost);

            }
        }


        $this->em->flush();
    }
}