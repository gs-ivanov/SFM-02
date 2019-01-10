<?php

namespace ScpmBundle\Controller;


use ScpmBundle\Entity\Ship;
use ScpmBundle\Form\ShipType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class ShipsController extends Controller
{
    /**
     * @Route("/ships", name="show_ships")
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function showShipAction(Request $request)
    {
        $userId = $this->getUser()->getId();
        $DutyId=$this->getUser()->getDutyId();
        if (1===$DutyId){
            $ships = $this
                ->getDoctrine()
                ->getRepository(Ship::class)
                ->findAll();
        }else{
            $ships = $this
                ->getDoctrine()
                ->getRepository(Ship::class)
                ->findBy(['dutyId' => $DutyId]);
        }
//        var_dump($ships);exit();
        return $this->render("default/showships.html.twig",
            ['ships' => $ships]);
    }

    /**
     * @Route("/newship", name="add_new_ship")
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function newShipAction(Request $request)
    {
        $ship=new Ship();
        $form=$this->createForm(ShipType::class,$ship);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()){
            $em  =$this->getDoctrine()->getManager();
            $em->persist($ship);
            $em->flush();
            return $this->redirectToRoute('user_profile');
        }
        return $this->render('default/addfleet.html.twig',
            ['form'=>$form->createView()]);
    }

}