<?php

namespace BcBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class UsuarioController extends Controller
{
    public function indexAction()
    {
        return $this->render('BcBundle:Default:index.html.twig');
    }
    
    public function loginAction(Request $request){
        $authenticationUtils = $this->get("security.authentication_utils");
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();
        
        return $this->render("BcBundle:Usuario:login.html.twig",array(
           "error" => $error,
           "last_username" => $lastUsername
        ));
        
    }
}
