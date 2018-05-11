<?php
/**
 * Created by PhpStorm.
 * User: ianas
 * Date: 09.05.2018
 * Time: 16:41
 */

namespace AppBundle\DTO;

/**
 * Interface DTOConvertableInterface
 * @package AppBundle\DTO
 */
interface DTOConvertableInterface
{
    /**
     * @return DTOInterface
     */
    public function convertToDTO();
}