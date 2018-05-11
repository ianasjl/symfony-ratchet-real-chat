<?php
/**
 * Created by PhpStorm.
 * User: ianas
 * Date: 19.04.2018
 * Time: 22:20
 */

namespace AppBundle\Controller;


use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;


class MessengerController extends Controller
{
    /**
     * @Route("/messenger/{mesName}")
     */
    public function showAction() {
        return $this->render('messenger/index.html');
    }
}