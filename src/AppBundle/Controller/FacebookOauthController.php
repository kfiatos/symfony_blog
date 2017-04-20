<?php

namespace AppBundle\Controller;

use Facebook\Facebook;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class FacebookOauthController extends Controller
{
    /**
     * @Route("/facebook/connect", name="facebook_connect")
     */
    public function connectAction(Request $request)
    {

        $fb = new Facebook([
            'app_id' => '680077758842837',
            'app_secret' => 'c2d1cc0b03fa9eb7c286cda44b1224f9',
            'default_graph_version' => 'v2.8',
        ]);



        $helper = $fb->getRedirectLoginHelper();
        $callbackUrl = $this->generateUrl('facebook_connect_check', [], UrlGeneratorInterface::ABSOLUTE_URL);

        $permissions = ['email', 'public_profile']; // Optional permissions
        $loginUrl = $helper->getLoginUrl($callbackUrl, $permissions);

        return $this->redirect($loginUrl);


//        ddd($loginUrl);
//        die('connect action');


//        echo '<a href="' . htmlspecialchars($loginUrl) . '">Log in with Facebook!</a>';
//
//        // replace this example code with whatever you need
//        return $this->render('default/index.html.twig', [
//            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..'),
//        ]);
    }

    /**
     * @Route("/facebook/login_check", name="facebook_connect_check")
     */
    public function checkAction(Request $request)
    {

        ddd($request);

        /** @var \GuzzleHttp\Client $client */
        $client   = $this->get('guzzle.client.api_crm');
        $response = $client->get();
        ddd();
        ddd(json_decode($response->getBody()));
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.root_dir').'/..'),
        ]);
    }
}
