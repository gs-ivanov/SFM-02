<?php

namespace ScpmBundle\Controller;


use ScpmBundle\Entity\Fleet;
use ScpmBundle\Entity\User;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends Controller
{
    /**
     * @Route("/", name="fleet_index")
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function indexAction()
    {
        $userId = $this->getUser()->getId();
        $DutyId=$this->getUser()->getDutyId();
        if (1===$DutyId){
            $user = $this
                ->getDoctrine()
                ->getRepository(User::class)
                ->findAll();
        }else{
            $user = $this
                ->getDoctrine()
                ->getRepository(User::class)
                ->find($userId);
        }
        return $this->render("user/profile.html.twig",
            ['user' => $user]);
    }
}