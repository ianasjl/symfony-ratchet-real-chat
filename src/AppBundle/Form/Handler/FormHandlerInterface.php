<?php
/**
 * Created by PhpStorm.
 * User: ianas
 * Date: 09.05.2018
 * Time: 23:38
 */

namespace AppBundle\Form\Handler;


interface FormHandlerInterface
{
    /**
     * @param mixed     $object
     * @param array     $parameters
     * @param string    $method
     * @param array     $options
     * @return mixed
     */
    public function handle($object, array $parameters, $method, array $options);
}