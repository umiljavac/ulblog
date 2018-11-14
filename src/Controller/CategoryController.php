<?php
/**
 * Created by PhpStorm.
 * User: ulrich
 * Date: 14/11/2018
 * Time: 09:56
 */

namespace App\Controller;


use App\Entity\Category;
use App\Service\EntityManager\CategoryManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends Controller
{
    /**
     * @Route("/blog/{name}", name="projects-by-cat")
     */
    public function showAction(Category $category, CategoryManager $categoryManager)
    {
        if($category) {
            return $this->render('views/'. $category->getName(). '.html.twig',
                [
                    'category' => $category
                ]
            );
        }
    }
}