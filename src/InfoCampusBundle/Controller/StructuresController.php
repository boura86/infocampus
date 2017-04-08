<?php

namespace InfoCampusBundle\Controller;

use InfoCampusBundle\Entity\Structures;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Structure controller.
 *
 * @Route("structures")
 */
class StructuresController extends Controller
{
    /**
     * Lists all structure entities.
     *
     * @Route("/", name="structures_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $structures = $em->getRepository('InfoCampusBundle:Structures')->findAll();

        return $this->render('structures/index.html.twig', array(
            'structures' => $structures,
        ));
    }

    /**
     * Creates a new structure entity.
     *
     * @Route("/new", name="structures_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $structure = new Structures();
        $form = $this->createForm('InfoCampusBundle\Form\StructuresType', $structure);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($structure);
            $em->flush();

            return $this->redirectToRoute('structures_show', array('id' => $structure->getId()));
        }

        return $this->render('structures/new.html.twig', array(
            'structure' => $structure,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a structure entity.
     *
     * @Route("/{id}", name="structures_show")
     * @Method("GET")
     */
    public function showAction(Structures $structure)
    {
        $deleteForm = $this->createDeleteForm($structure);

        return $this->render('structures/show.html.twig', array(
            'structure' => $structure,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing structure entity.
     *
     * @Route("/{id}/edit", name="structures_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Structures $structure)
    {
        $deleteForm = $this->createDeleteForm($structure);
        $editForm = $this->createForm('InfoCampusBundle\Form\StructuresType', $structure);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('structures_index');
        }

        return $this->render('structures/edit.html.twig', array(
            'structure' => $structure,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a structure entity.
     *
     * @Route("/{id}", name="structures_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Structures $structure)
    {
        $form = $this->createDeleteForm($structure);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($structure);
            $em->flush();
        }

        return $this->redirectToRoute('structures_index');
    }

    /**
     * Creates a form to delete a structure entity.
     *
     * @param Structures $structure The structure entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Structures $structure)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('structures_delete', array('id' => $structure->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
