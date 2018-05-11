<?php
/**
 * Created by PhpStorm.
 * User: ianas
 * Date: 09.05.2018
 * Time: 23:36
 */

namespace AppBundle\Repository;


/**
 * Interface RepositoryInterface
 * @package AppBundle\Repository
 */
interface RepositoryInterface
{
    /**
     * @param                           $id
     * @return                          mixed|null
     */
    public function findOneById($id);
}