<?php

namespace AppBundle\Controller;

use AppBundle\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class UsersController extends Controller
{
    /**
     * @Route("/users")
     */
    public function indexAction()
    {
        $currentUser = $this->getUser();

        $users = $this->getDoctrine()
            ->getRepository('AppBundle:User')
            ->allExceptUser($currentUser->getId());


        return $this->render('AppBundle:users:index.html.twig', [
            'users' => $users,
            'currentUser' => $currentUser
        ]);
    }

    /**
     * @Route("user/{id}")
     */
    public function showAction($id)
    {
        $user = $this->getDoctrine()
            ->getRepository('AppBundle:User')
            ->find($id);

        return $this->render('AppBundle:users:show.html.twig', compact('user'));
    }

    /**
     * @Route("/following")
     */
    public function followingAction()
    {
        $user = $this->getUser();


        return $this->render('AppBundle:users:following.html.twig', [
            'user' => $user,
        ]);
    }

    /**
     * @Route("/followed")
     */
    public function followedAction()
    {
        $user = $this->getUser();


        return $this->render('AppBundle:users:followed.html.twig', [
            'user' => $user,
        ]);
    }

    /**
     * @Route("/follow")
     * @Method("POST")
     * @param Request $request
     */
    public function followAction(Request $request)
    {
        $user = $this->getUser();
        $following_id = $request->request->get('id');
        $urlBack = $request->headers->get('referer');

        $following_user = $this->getDoctrine()
            ->getRepository('AppBundle:User')
            ->find($following_id);

        $user->addFollowing($following_user);

        $em = $this->getDoctrine()->getManager();


        try {
            $em->persist($user);
            $em->flush();
            return $this->redirect($urlBack);
        }catch (\PDOException $e) {

            return $this->redirect($urlBack);
        }
    }

    /**
     * @Route("/unfollow")
     * @Method("POST")
     * @param Request $request
     */
    public function unFollowAction(Request $request)
    {
        $user = $this->getUser();
        $following_id = $request->request->get('id');
        $urlBack = $request->headers->get('referer');

        $following_user = $this->getDoctrine()
            ->getRepository('AppBundle:User')
            ->find($following_id);

        $user->removeFollowing($following_user);

        $em = $this->getDoctrine()->getManager();


        try {
            $em->persist($user);
            $em->flush();
            return $this->redirect($urlBack);
        }catch (\PDOException $e) {

            return $this->redirect($urlBack);
        }
    }


}
