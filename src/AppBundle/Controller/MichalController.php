<?php

namespace AppBundle\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class MichalController extends Controller
{
    /**
     * @Route("/michal", name="michal")
     */
    public function indexAction()
    {
        return new Response(
            'hello world'
        );
    }
}