<?php
/**
 * Created by PhpStorm.
 * User: ulrich
 * Date: 14/11/2018
 * Time: 09:56
 */

namespace App\Controller;


use App\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class CategoryController extends Controller
{
    /**
     * @Route("/projects/{name}", name="projects-by-cat")
     */
    public function showAction(Category $category)
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
