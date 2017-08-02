<?php

namespace AppBundle\Controller;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use AppBundle\Entity\Users;

class HomeController extends Controller
{
    /**
     * @Route("/home", name="homepage")
     */
    public function indexAction(Request $request)
    {
        $user= $this->getDoctrine()->getRepository('AppBundle:Users')->findAll();
        
        return $this->render('mine/index.html.twig',['user'=>$user]);
    }

    /**
     * @Route("/about/number", name="about")
     */
    public function aboutAction(Request $request)
    {
        $number= 14;
        return $this->render('mine/about.html.twig',['number'=>$number]);
    }

    /**
     * @Route("/register", name="register")
     */
    public function registerAction(Request $request)
    {
        $user = new Users();
        $user->setFirstName('John Bull');
        $user->setLastName('Last name');
        $user->setEmail('ben@ben.com');
        $user->setRegDate(new \DateTime('tomorrow'));

        $form = $this->createFormBuilder($user)
        ->add('userId', TextType::class)
            ->add('firstName', TextType::class)
            ->add('lastName', TextType::class)
            ->add('userName', TextType::class)
            ->add('password', TextType::class)
            ->add('email', TextType::class)
            ->add('regDate', DateType::class)
            ->add('save', SubmitType::class, array('label' => 'Register'))
            ->getForm();

            $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $ui = $form['userId']->getData();
            $fn = $form['firstName']->getData();
            $ln = $form['lastName']->getData();
            $un = $form['userName']->getData();
            $email = $form['email']->getData();
            $pass = $form['password']->getData();
            $regDate = $form['regDate']->getData();

$user->setUserId($ui);
            $user->setFirstName($fn);
            $user->setLastName($ln);
            $user->setEmail($email);
            $user->setUserName($un);
            $user->setPassword($pass);
            $user->setRegDate($regDate);

            $em = $this->getDoctrine()->getManager();
            $em->persist($user);
            $em->flush();

        //return $this->redirectToRoute('task_success');
    }

    
        return $this->render('mine/register.html.twig',['form'=>$form->createView()]);
    }
}
