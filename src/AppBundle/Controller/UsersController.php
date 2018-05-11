<?php
/**
 * Created by PhpStorm.
 * User: ianas
 * Date: 07.05.2018
 * Time: 17:36
 */

namespace AppBundle\Controller;


use FOS\RestBundle\Controller\Annotations\Get;
use FOS\RestBundle\Controller\Annotations\Post;
use FOS\RestBundle\Controller\Annotations\Route;
use FOS\RestBundle\Controller\FOSRestController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use FOS\RestBundle\View\View;
use AppBundle\Entity\Users;

class UsersController extends FOSRestController
{

    /**
     * @Post("/registerUser")
     * @Route("/api/registerUser", methods={"POST"})
     * @param Request $request
     * @return View
     */
    public function postAction(Request $request)
    {
        $data = new Users;
        $email = $request->get('email');
        $username = $request->get('username');
        $password = $request->get('password');
        $socketId = $request->get('socketId');
        $status = $request->get('status');
        $online = $request->get('online');
        if (empty($email) || empty($username) || empty($password)) {
            return new View("NULL VALUES ARE NOT ALLOWED", Response::HTTP_NOT_ACCEPTABLE);
        }
        $data->setEmail($email);
        $data->setUsername($username);
        $data->setPassword($password);
        $data->setSocketId($socketId);
        $data->setStatus($status);
        $data->setOnline($online);
        $em = $this->getDoctrine()->getManager();
        $em->persist($data);
        $em->flush();
        return new View("User Added Successfully", Response::HTTP_OK);
    }

    /**
     * @Get("/allusers/")
     * @return array|View
     */
    public function idAction()
    {
        $singleresult = $this->getDoctrine()->getRepository('AppBundle:Users')->findAll();
        if ($singleresult === null) {
            return new View("user not found", Response::HTTP_NOT_FOUND);
        }
        return $singleresult;
    }

    /**
     * @Get("/getprofile/{userId}/")
     */
    public function idActionProfile($userId)
    {
        $singleresult = $this->getDoctrine()->getRepository('AppBundle:Users')->find($userId);
        if ($singleresult === null) {
            return new View("user not found", Response::HTTP_NOT_FOUND);
        }
        return $singleresult;
    }


}