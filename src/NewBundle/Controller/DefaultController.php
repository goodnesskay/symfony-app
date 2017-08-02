<?php

namespace NewBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/boy")
     */
    public function indexAction()
    {
        return $this->render('NewBundle:Default:index.html.twig');
    }
}
