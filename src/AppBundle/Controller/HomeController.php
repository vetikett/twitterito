<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Tweet;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class HomeController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {

        $tweet = new Tweet();
        $user = $this->getUser();
        $feedTweets = $this->getDoctrine()
            ->getRepository('AppBundle:Tweet')
            ->findBy([], ['createdAt' => 'DESC']);

        $form = $this->createFormBuilder($tweet)
            ->add('text', 'textarea', ['attr' => ['class' => 'form-control', 'placeholder' => 'Write your tweet'], 'label' => false])
            ->add('tweet', 'submit', ['attr' => ['class' => 'form-control btn-primary']])
            ->getForm();

        $form->handleRequest($request);

        if ($form->isValid()) {
            $tweet->setText($form->getData()->getText());
            $tweet->setUser($user);

            $em = $this->getDoctrine()->getManager();
            $em->persist($tweet);
            $em->flush();

            return $this->redirectToRoute('homepage');

        }


        return $this->render('AppBundle::home.html.twig', [
            'form' => $form->createView(),
            'user' => $user,
            'feedTweets' => $feedTweets
        ]);
    }


    public function profile() {

        $user = $this->getUser();

        return $this->render('AppBundle:home.html.twig', compact('user'));

    }


}