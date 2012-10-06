<?php

namespace Jat\FrontendBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;

class DefaultController extends Controller
{
    /**
     * @Route(
     *  "/",
     *  name = "jat_frontend_home"
     * )
     * @Template()
     */
    public function homeAction()
    {
        return $this->render('JatFrontendBundle:Default:home.html.twig', array());
    }
}
