<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class TweetsController extends Controller
{
    /**
     * @Route("/tweets")
     * @Template()
     */
    public function indexAction()
    {
        $user = $this->getUser();
        return $this->render('AppBundle:Tweets:index.html.twig', [
            'user' => $user
        ]);
    }

}
