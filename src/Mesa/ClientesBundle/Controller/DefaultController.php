<?php

namespace Mesa\ClientesBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction($name)
    {
        return $this->render('ClientesBundle:Default:index.html.twig', array('name' => $name));
    }
}
