<?php

namespace InfoCampusBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="acceuil")
     */
    public function indexAction()
    {
        return $this->render('InfoCampusBundle:Default:index.html.twig');
    }
}
