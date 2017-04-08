<?php

namespace InfoCampusBundle\Controller;

use InfoCampusBundle\Entity\Abonnes;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;use Symfony\Component\HttpFoundation\Request;

/**
 * Abonne controller.
 *
 * @Route("abonnes")
 */
class AbonnesController extends Controller
{
    /**
     * Lists all abonne entities.
     *
     * @Route("/", name="abonnes_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $abonnes = $em->getRepository('InfoCampusBundle:Abonnes')->findAll();

        return $this->render('abonnes/index.html.twig', array(
            'abonnes' => $abonnes,
        ));
    }

    /**
     * Creates a new abonne entity.
     *
     * @Route("/new", name="abonnes_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $abonne = new Abonnes();
        $form = $this->createForm('InfoCampusBundle\Form\AbonnesType', $abonne);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $abonne->setPassword("adabacadabra");
            $is_abonne = $em->getRepository('InfoCampusBundle:Abonnes')
                ->findBy(array('numTel' => $abonne->getNumTel()));
            if ($is_abonne)  {
                $this->addFlash('notice', 'Ce numero existe déjà !!!');
                return $this->redirectToRoute('abonnes_new');
            }
            $em->persist($abonne);
            $em->flush();

            return $this->redirectToRoute('abonnes_show', array('id' => $abonne->getId()));
        }

        return $this->render('abonnes/new.html.twig', array(
            'abonne' => $abonne,
            'form' => $form->createView(),
        ));
    }

    /**
     * Finds and displays a abonne entity.
     *
     * @Route("/{id}", name="abonnes_show")
     * @Method("GET")
     */
    public function showAction(Abonnes $abonne)
    {
        $deleteForm = $this->createDeleteForm($abonne);

        return $this->render('abonnes/show.html.twig', array(
            'abonne' => $abonne,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing abonne entity.
     *
     * @Route("/{id}/edit", name="abonnes_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Abonnes $abonne)
    {
        $deleteForm = $this->createDeleteForm($abonne);
        $editForm = $this->createForm('InfoCampusBundle\Form\AbonnesType', $abonne);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('abonnes_index');
        }

        return $this->render('abonnes/edit.html.twig', array(
            'abonne' => $abonne,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a abonne entity.
     *
     * @Route("/{id}", name="abonnes_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Abonnes $abonne)
    {
        $form = $this->createDeleteForm($abonne);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($abonne);
            $em->flush();
        }

        return $this->redirectToRoute('abonnes_index');
    }

    /**
     * Creates a form to delete a abonne entity.
     *
     * @param Abonnes $abonne The abonne entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Abonnes $abonne)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('abonnes_delete', array('id' => $abonne->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
