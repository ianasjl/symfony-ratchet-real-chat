<?php
/**
 * Created by PhpStorm.
 * User: ianas
 * Date: 09.05.2018
 * Time: 16:40
 */

namespace AppBundle\DTO;


/**
 * Interface DTOUpdatableInterface
 * @package AppBundle\DTO
 */
interface DTOUpdatableInterface
{
    /**
     * @param $object
     * @return mixed
     */
    public function updateFromDTO($object);
}