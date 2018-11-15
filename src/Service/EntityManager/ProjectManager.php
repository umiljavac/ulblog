<?php
/**
 * Created by PhpStorm.
 * User: ulrich
 * Date: 13/11/2018
 * Time: 17:26
 */

namespace App\Service\EntityManager;

use App\Entity\Project;
use Doctrine\ORM\EntityManagerInterface;

class ProjectManager
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function listProject()
    {
        return $this->em->getRepository(Project::class)->findAll();
    }
}
