<?php
/**
 * Created by PhpStorm.
 * User: ulrich
 * Date: 13/11/2018
 * Time: 17:24
 */

namespace App\Controller;


use App\Entity\Category;
use App\Entity\Project;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Service\EntityManager\ProjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class ProjectController extends Controller
{
    /**
     * @Route("/projects", name="projects")
     *
     * @param ProjectManager $projectManager
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function listAction(ProjectManager $projectManager)
    {
        return $this->render('views/home.html.twig',
            [
                'allProjects' => $projectManager->listProject()
            ]
        );
    }

    /**
     * @Route("/projects/{id}", name="project-show")
     *
     * @param Project $project
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showAction(Project $project)
    {
        if($project) {
            return $this->render('views/project_details.html.twig',
                [
                    'project' => $project
                ]
            );
        }
    }
}