<?php

namespace InfoCampusBundle\Controller;

use InfoCampusBundle\Entity\Abonnes;
use InfoCampusBundle\Entity\Messages;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Method;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Message controller.
 *
 * @Route("messages")
 */
class MessagesController extends Controller
{
    /**
     * Lists all message entities.
     *
     * @Route("/", name="messages_index")
     * @Method("GET")
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $messages = $em->getRepository('InfoCampusBundle:Messages')->findAll();

        return $this->render('messages/index.html.twig', array(
            'messages' => $messages,
        ));
    }

    /**
     * Creates a new message entity.
     *
     * @Route("/new", name="messages_new")
     * @Method({"GET", "POST"})
     */
    public function newAction(Request $request)
    {
        $message = new Messages();
        $form = $this->createForm('InfoCampusBundle\Form\MessagesType', $message);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $message->setDate(new \DateTime());
            $message->setDateReception(new \DateTime());
            $message->setDateEnvoi(new \DateTime());
            $message->setStatut('envoie');
            $em->persist($message);
            $em->flush();

            $abonnes = $em->getRepository("InfoCampusBundle:Abonnes")->findAll();
            foreach ($abonnes as $abonne) {
                $this->sendSms($abonne->getNumTel(),$message->getLibelle());
            }
            return $this->redirectToRoute('messages_show', array('id' => $message->getId()));
        }

        return $this->render('messages/new.html.twig', array(
            'message' => $message,
            'form' => $form->createView(),
        ));
    }

    /**
     * @Route("/messInfocampusPlus", name="message_infocampusplus" )
     * @param Request $request
     * @return \Symfony\Component\HttpFoundation\RedirectResponse|\Symfony\Component\HttpFoundation\Response
     */
    public function incampusplusAction(Request $request)
    {
        $message = new Messages();
        $form = $this->createForm('InfoCampusBundle\Form\MessagesType', $message);
        $form->add('facultes', EntityType::class, array(
                        'class' => 'InfoCampusBundle\Entity\Facultes',
                        'choice_label' => 'nom',
                        'multiple' => true,
                        'attr' => array('class' => 'form-control')
                    ));
        $form->add('niveau', EntityType::class, array(
            'class' => 'InfoCampusBundle\Entity\Niveau',
            'choice_label' => 'nom',
            'attr' => array('class' => 'form-control')));
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $message->setDate(new \DateTime());
            $message->setDateReception(new \DateTime());
            $message->setDateEnvoi(new \DateTime());
            $message->setStatut('envoie');
            $em->persist($message);
            $em->flush();
            $abonnesElu = array();
            $abonnes = $em->getRepository("InfoCampusBundle:Abonnes")->findAll();

            foreach ($abonnes as $abonne)
            {

                if (($abonne->getNiveau()->getNom() == $message->getNiveau()->getNom()))
                {
                    array_push($abonnesElu,$abonne);
                }
            }


            foreach ($abonnesElu as $elu) {
                $this->sendSms($abonne->getNumTel(),$message->getLibelle());
            }
            return $this->redirectToRoute('messages_show', array('id' => $message->getId()));
        }

        return $this->render('messages/new.html.twig', array(
            'message' => $message,
            'form' => $form->createView(),
        ));
    }

    public function sendSms($numero, $text) {

        $login = "kannel";
        $password = "kannel";
        $url = 'http://localhost:14000/cgi-bin/sendsms?from=8658&username='.$login.'&password='.$password.'&to='.$numero.'&text='.urlencode($text);
        // passthru("php -S http://localhost:14000.$url");
        $results = curl_init();
        curl_setopt($results, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($results,CURLOPT_URL,$url);
        curl_setopt($results, CURLOPT_HEADER, 0);
        $response = curl_exec($results);
        curl_close($results);

    }
    /**
     * Finds and displays a message entity.
     *
     * @Route("/{id}", name="messages_show")
     * @Method("GET")
     */
    public function showAction(Messages $message)
    {
        $deleteForm = $this->createDeleteForm($message);

        return $this->render('messages/show.html.twig', array(
            'message' => $message,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing message entity.
     *
     * @Route("/{id}/edit", name="messages_edit")
     * @Method({"GET", "POST"})
     */
    public function editAction(Request $request, Messages $message)
    {
        $deleteForm = $this->createDeleteForm($message);
        $editForm = $this->createForm('InfoCampusBundle\Form\MessagesType', $message);
        $editForm->handleRequest($request);

        if ($editForm->isSubmitted() && $editForm->isValid()) {
            $this->getDoctrine()->getManager()->flush();

            return $this->redirectToRoute('messages_index');
        }

        return $this->render('messages/edit.html.twig', array(
            'message' => $message,
            'edit_form' => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Deletes a message entity.
     *
     * @Route("/{id}", name="messages_delete")
     * @Method("DELETE")
     */
    public function deleteAction(Request $request, Messages $message)
    {
        $form = $this->createDeleteForm($message);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->remove($message);
            $em->flush();
        }

        return $this->redirectToRoute('messages_index');
    }

    /**
     * Creates a form to delete a message entity.
     *
     * @param Messages $message The message entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm(Messages $message)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('messages_delete', array('id' => $message->getId())))
            ->setMethod('DELETE')
            ->getForm()
        ;
    }
}
