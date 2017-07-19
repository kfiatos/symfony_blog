<?php

namespace AppBundle\Controller;

use Facebook\Exceptions\FacebookResponseException;
use Facebook\Exceptions\FacebookSDKException;
use Facebook\Facebook;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Config\Definition\Exception\Exception;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class FacebookOauthController extends Controller
{
    /**
     * @Route("/facebook/connect", name="facebook_connect")
     */
    public function connectAction(Request $request)
    {

        $fb = $this->getFacebook();
        $helper = $fb->getRedirectLoginHelper();


        $callbackUrl = $this->generateUrl('facebook_connect_check', [], UrlGeneratorInterface::ABSOLUTE_URL);

        $permissions = ['email', 'public_profile']; // Optional permissions
        $loginUrl = $helper->getLoginUrl($callbackUrl, $permissions);

        return $this->redirect($loginUrl);
    }

    /**
     * @Route("/facebook/login_check", name="facebook_connect_check")
     */
    public function checkAction(Request $request)
    {
        $fb = $this->getFacebook();
        $helper = $fb->getRedirectLoginHelper();
        if (!$accessToken = $helper->getAccessToken()) {
            //Unauthorized
            if ($helper->getError()) {
                //process this error
            }else {
                throw New \Exception("Błąd servera");
            }
        }
        if(!$accessToken->isLongLived()) {
            $oAuth2Client = $fb->getOAuth2Client();
            try {
                $accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
            } catch(FacebookSDKException $e) {
                throw new Exception($e->getMessage());
            }
        }

        $session = $this->container->get('session');
        $session->set('fb_access_token', (string) $accessToken);


        try {
            // Returns a `Facebook\FacebookResponse` object
            $response = $fb->get('/me?fields=id,name,email', $accessToken);
        } catch(FacebookResponseException $e) {
            throw new Exception($e->getMessage());
        } catch(FacebookSDKException $e) {
            throw new Exception($e->getMessage());
        }

        $user = $response->getGraphUser();
        ddd($user);
    }

    /**
     * @return Facebook
     */
    public function getFacebook()
    {
        $fb = new Facebook([
            'app_id' => '680077758842837',
            'app_secret' => 'c2d1cc0b03fa9eb7c286cda44b1224f9',
            'default_graph_version' => 'v2.8',
        ]);
        return $fb;
    }
}
