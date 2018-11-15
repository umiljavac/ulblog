<?php
/**
 * Created by PhpStorm.
 * User: ulrich
 * Date: 14/11/2018
 * Time: 10:46
 */

namespace App\Service\EntityManager;

use Doctrine\ORM\EntityManagerInterface;

class CategoryManager
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }
}
