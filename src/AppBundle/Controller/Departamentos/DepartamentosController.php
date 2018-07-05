<?php
/**
 * Created by PhpStorm.
 * User: ivanm
 * Date: 7/5/2018
 * Time: 9:42 PM
 */

namespace AppBundle\Controller\Departamentos;

use AppBundle\Entity\Departamentos;
use AppBundle\Form\DepartamentosType;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class DepartamentosController extends Controller
{
    /**
     * @Route("/departamentos",name="departamentos")
     */
    public function departamentosAction(Request $request)
    {
        $departamentos=$this->getDoctrine()->getRepository(Departamentos::class)->findAll();

        //Form
        $departamento=new Departamentos();
        $form=$this->createForm(DepartamentosType::class,$departamento);

        return $this->render('@App\Departamentos\lista.html.twig',array(
            'form'=>$form->createView(),
            'departamentos'=>$departamentos
        ));
    }

    /**
     * @Route("/departamentos/insert_departamentos",name="insert_departamentos")
     */
    public function createAction(Request $request)
    {
        $departamento=new Departamentos();
        $form=$this->createForm(DepartamentosType::class,$departamento);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em=$this->getDoctrine()->getManager();
            $em->persist($departamento);
            $em->flush();
        }

        return $this->redirectToRoute('departamentos');
    }

    /**
     * @Route("/departamentos/editar_departamentos/{id}",name="editar_departamentos")
     * @param Request $request
     * @param Departamentos $departamento
     */
    public function editAction(Request $request, Departamentos $departamento)
    {
        $form=$this->createForm(DepartamentosType::class,$departamento);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            $em=$this->getDoctrine()->getManager();
            $em->persist($departamento);
            $em->flush();
            return $this->redirectToRoute('departamentos');
        }

        return $this->render('@App\Departamentos\edit.html.twig',array(
            'form'=>$form->createView(),
            'id'=>$departamento->getId()
        ));
    }

    /**
     * @Route("/departamentos/eliminar_departamentos/{id}",name="eliminar_departamentos")
     * @param Departamentos $departamento
     */
    public function deleteAction(Departamentos $departamentos)
    {
        $em=$this->getDoctrine()->getManager();
        $em->remove($departamentos);
        $em->flush();

        return $this->redirectToRoute('departamentos');
    }

}
