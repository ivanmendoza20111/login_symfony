<?php
/**
 * Created by PhpStorm.
 * User: ivanm
 * Date: 7/5/2018
 * Time: 4:25 PM
 */

namespace AppBundle\Controller\Task;

use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class TaskController extends Controller
{
    /**
     * @Route("/menu",name="menu")
     */
    public function adminAction()
    {

        return $this->render('@App\Task\menu.html.twig');
    }
}