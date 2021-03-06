<?php
namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
/**
 * Description of SecurityController
 *
 * @author mdurand
 */
class SecurityController extends Controller{
    
    /**
     * @Route("/login", name="login")
     * @Method("GET|POST")
     */
    public function loginAction()
    {
        $authenticationUtils = $this->get('security.authentication_utils');
        
        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();
        
        return $this->render('security/login.html.twig',[
                'last_username' => $lastUsername,
                'error'         => $error,
            ]);
                
            
        
    }
    
}
