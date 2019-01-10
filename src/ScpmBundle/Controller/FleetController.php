<?php
namespace ScpmBundle\Controller;

use ScpmBundle\Entity\Fleet;
use ScpmBundle\Form\FleetType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FleetController extends Controller
{

    /**
     * @Route("/depr", name="nohomepage")
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function homeAction(Request $request)
    {
//        $userId = $this->getUser()->getId();
//        $DutyId=$this->getUser()->getDutyId();
//        if (1===$DutyId){
//            $fleets = $this
//                ->getDoctrine()
//                ->getRepository(Fleet::class)
//                ->findAll();
//        }else{
//            $fleets = $this
//                ->getDoctrine()
//                ->getRepository(Fleet::class)
//                ->findOneBy(['dutyId' => $DutyId]);
//        }
////        var_dump($fleets);exit;
//        return $this->render("default/showfleet.html.twig",
//            ['fleets' => $fleets]);
        return new Response('<html><h1>Home</h1></html>');
    }

    /**
     * @Route("/newfleet", name="add_new_fleet")
     * @Security("is_granted('IS_AUTHENTICATED_FULLY')")
     */
    public function newFleetAction(Request $request)
    {
        $fleet=new Fleet();
        $form=$this->createForm(FleetType::class,$fleet);

        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()){
            $em  =$this->getDoctrine()->getManager();
            $em->persist($fleet);
            $em->flush();
            return $this->redirectToRoute('user_profile');
        }
        return $this->render('default/addfleet.html.twig',
            ['form'=>$form->createView()]);
    }

    /**
     *
     * @Route("/editfleet/{id}", name="edit_fleet")
     * @param Response $response
     * @param int $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function editFleet(Request $request,int $id){
        $fleet=$this->getDoctrine()->getRepository(Fleet::class)->find($id);
        $form = $this->createForm(FleetType::class, $fleet);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($fleet);
            $em->flush();
            return $this->redirectToRoute('user_profile');
        }

        return $this->render('default/addfleet.html.twig',['form'=>$form->createView()]);
    }

    /**
     *
     * @Route("/deletefleet/{id}", name="delete_fleet")
     * @param Response $response
     * @param int $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function deleteFleet(Request $request,int $id){
        $repository=$this->getDoctrine()
            ->getRepository('ScpmBundle:Fleet');
//        $product=$repository->findDescriptionText($id);
        $fleet=$repository->find($id);
//        dump($product);exit;

        return $this->render('default/confirm.html.twig',[
            'fleet' => $fleet,]);
    }
    /**
     * @Route("/confirmdelete/{id}",name="confirmdelete")
     * @param $product
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function executeAction($id)
    {
        $repository=$this->getDoctrine()
            ->getRepository('ScpmBundle:Fleet');
        $fleet=$repository->find($id);
        if (!$fleet){
            throw $this->createNotFoundException('No product found for id '.$id);
        }
        $em=$this->getDoctrine()->getManager();
        $em->remove($fleet);
        $em->flush();

        return $this->redirectToRoute('user_profile');
    }
}