<?php
/**
 * Created by PhpStorm.
 * User: ulrich
 * Date: 06/11/2018
 * Time: 14:52
 */

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends Controller
{
    /**
     * @Route("/", name="home")
     *
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function indexAction()
    {
        return $this->render('views/home.html.twig');
    }
}
