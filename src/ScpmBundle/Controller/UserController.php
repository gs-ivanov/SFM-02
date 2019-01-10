<?php

namespace ScpmBundle\Controller;

use ScpmBundle\Entity\Role;
use ScpmBundle\Entity\User;
use ScpmBundle\Form\UserType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends Controller
{
    /**
     * @Route("/register", name="user_register")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function registerAction(Request $request)
    {
        $users = $this
            ->getDoctrine()
            ->getRepository(User::class)
            ->findAll();
        if(0< count($users)){
            $this->addFlash('info', "Only Manager can register this way?!!");
            return $this->render('home/error.html.twig');
        }

        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $emailForm = $form->getData()->getUsername();

            $userForm = $this
                ->getDoctrine()
                ->getRepository(User::class)
                ->findOneBy(['username' => $emailForm]);

            if(null !== $userForm){
                $this->addFlash('info', "Username with email " . $emailForm . " already taken!");
                return $this->render('user/register.html.twig',
                    ['form'=>$form->createView(),'err'=>'up']);
            }

            $password = $this->get('security.password_encoder')
                ->encodePassword($user, $user->getPassword());

            $role = $this
                ->getDoctrine()
                ->getRepository(Role::class)
                ->findOneBy(['name' => 'ROLE_USER']);

            /** @var TYPE_NAME $role */
//            $user->addRole($role);

            $user->setPassword($password);

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute("security_login");
        }

        return $this->render('user/register.html.twig',['form'=>$form->createView()]);
    }

    /**
     * @Route("/registernew", name="new_user_register")
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function registerUserAction(Request $request)
    {
        $user = new User();
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $emailForm = $form->getData()->getUsername();

            $userForm = $this
                ->getDoctrine()
                ->getRepository(User::class)
                ->findOneBy(['username' => $emailForm]);

            if(null !== $userForm){
                $this->addFlash('info', "Username with email " . $emailForm . " already taken!");
                return $this->render('user/register.html.twig',
                    ['form'=>$form->createView(),'err'=>'up']);
            }

            $password = $this->get('security.password_encoder')
                ->encodePassword($user, $user->getPassword());

            $role = $this
                ->getDoctrine()
                ->getRepository(Role::class)
                ->findOneBy(['name' => 'ROLE_USER']);

            /** @var TYPE_NAME $role */
//            $user->addRole($role);

            $user->setPassword($password);

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

            return $this->redirectToRoute("user_profile");
        }

        return $this->render('user/register.html.twig',['form'=>$form->createView()]);
    }



    /**
     * @Route("/profile", name="user_profile")
     */
    public function profile(){
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



    /**
     *
     * @Route("/delete/{id}", name="delete_profile")
     * @param Response $response
     * @param int $id
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|Response
     */
    public function deleteProfile(Request $request,int $id){
            $userForm = $this
                ->getDoctrine()
                ->getRepository(User::class)
                ->findOneBy(['dutyId' => $id]);

            if(null == $userForm){
                throw $this->createNotFoundException('No user found for id '.$id);
            }

            $em = $this->getDoctrine()->getManager();
            $em->remove($userForm);
            $em->flush();
            return $this->redirectToRoute('user_profile');
    }

}
