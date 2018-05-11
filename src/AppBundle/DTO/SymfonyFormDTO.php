<?php
/**
 * Created by PhpStorm.
 * User: ianas
 * Date: 09.05.2018
 * Time: 16:39
 */

namespace AppBundle\DTO;


interface SymfonyFormDTO extends \JSONSerializable
{
    public function getDataClass();
}