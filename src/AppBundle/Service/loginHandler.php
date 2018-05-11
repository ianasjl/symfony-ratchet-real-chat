<?php
/**
 * Created by PhpStorm.
 * User: ianas
 * Date: 09.05.2018
 * Time: 16:27
 */

namespace AppBundle\Service;


use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Session\Session;
use Symfony\Component\Security\Core\Authentication\Token\TokenInterface;
use Symfony\Component\Security\Http\Authentication\AuthenticationSuccessHandlerInterface;
use Symfony\Component\Routing\RouterInterface;
use Doctrine\ORM\EntityManager;


/**
 * @property  session
 */
class loginHandler implements AuthenticationSuccessHandlerInterface {

    private $router;
    private $container;
    private static $key;

    public function __construct(RouterInterface $router, EntityManager $em, $container) {

        self::$key = '_security.secured_area.target_path';

        $this->router = $router;
        $this->em = $em;
        $this->session = $container->get('session');

    }

    public function onAuthenticationSuccess( Request $request, TokenInterface $token ) {

        $user_entity = $token->getUser();

        if( !$user_entity->getChangePassword() ) {

            $route = $this->router->generate('messenger/index');

        } else {

            $this->session->getFlashBag()->add('error', 'Your password must be changed now');

            $route = $this->router->generate('messenger/index');

        }

        //check if the referer session key has been set
        if ($this->session->has( self::$key )) {

            //set the url based on the link they were trying to access before being authenticated
            $route = $this->session->get( self::$key );

            //remove the session key
            $this->session->remove( self::$key );
            //if the referer key was never set, redirect to a default route

        } else{

            $url = $this->generateUrl('messenger/index');

            return new RedirectResponse($route);

        }

        return new RedirectResponse($route);

    }
}