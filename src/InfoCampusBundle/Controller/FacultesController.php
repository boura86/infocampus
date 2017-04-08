<?php

namespace InfoCampusBundle\Controller;

use InfoCampusBundle\Entity\Facultes;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Faculte controller.
 *
 * @Route("facultes")
 */
class FacultesController extends Controller
{
    /**
     * Lists all faculte entities.
     *
     * @Route("/", name="facultes_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $facultes = $em->getRepository('InfoCampusBundle:Facultes')->findAll();

        return $this->render('facultes/index.html.twig', array(
            'facultes' => $facultes,
        ));
    }

    /**
     * Creates a new faculte entity.
     *
     * @Route("/new", name="facultes_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $faculte = new Facultes();
        $form = $this->createForm('InfoCampusBundle\Form\FacultesType', $faculte);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($faculte);
            $em->flush();

            return $this->redirectToRoute('facultes_show', array('id' => $faculte->getId()));
        }

        return $this->render('facultes/new.html.twig', array(
            'faculte' => $faculte,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a faculte entity.
     *
     * @Route("/{id}", name="facultes_show")
     * @Method("GET")
     */
    public function showAction(Facultes $faculte)
    {
        $deleteForm = $this->createDeleteForm($faculte);

        return $this->render('facultes/show.html.twig', array(
            'faculte' => $faculte,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing faculte entity.
     *
     * @Route("/{id}/edit", name="facultes_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Facultes $faculte)
    {
        $deleteForm = $this->createDeleteForm($faculte);
        $editForm = $this->createForm('InfoCampusBundle\Form\FacultesType', $faculte);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('facultes_index');
        }

        return $this->render('facultes/edit.html.twig', array(
            'faculte' => $faculte,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a faculte entity.
     *
     * @Route("/{id}", name="facultes_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Facultes $faculte)
    {
        $form = $this->createDeleteForm($faculte);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($faculte);
            $em->flush();
        }

        return $this->redirectToRoute('facultes_index');
    }

    /**
     * Creates a form to delete a faculte entity.
     *
     * @param Facultes $faculte The faculte entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Facultes $faculte)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('facultes_delete', array('id' => $faculte->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
