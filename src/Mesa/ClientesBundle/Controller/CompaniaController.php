<?php

namespace Mesa\ClientesBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Mesa\ClientesBundle\Entity\Compania;
use Mesa\ClientesBundle\Form\CompaniaType;

/**
 * Compania controller.
 *
 */
class CompaniaController extends Controller
{

    /**
     * Lists all Compania entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('ClientesBundle:Compania')->findAll();

        return $this->render('ClientesBundle:Compania:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Compania entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Compania();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('compania_show', array('id' => $entity->getId())));
        }

        return $this->render('ClientesBundle:Compania:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Compania entity.
     *
     * @param Compania $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Compania $entity)
    {
        $form = $this->createForm(new CompaniaType(), $entity, array(
            'action' => $this->generateUrl('compania_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Compania entity.
     *
     */
    public function newAction()
    {
        $entity = new Compania();
        $form   = $this->createCreateForm($entity);

        return $this->render('ClientesBundle:Compania:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Finds and displays a Compania entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ClientesBundle:Compania')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Compania entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ClientesBundle:Compania:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Compania entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ClientesBundle:Compania')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Compania entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ClientesBundle:Compania:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Compania entity.
    *
    * @param Compania $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Compania $entity)
    {
        $form = $this->createForm(new CompaniaType(), $entity, array(
            'action' => $this->generateUrl('compania_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Compania entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ClientesBundle:Compania')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Compania entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('compania_edit', array('id' => $id)));
        }

        return $this->render('ClientesBundle:Compania:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Compania entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ClientesBundle:Compania')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Compania entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('compania'));
    }

    /**
     * Creates a form to delete a Compania entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('compania_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Eliminar','attr' => array('class' => 'btn btn-danger')))
            ->getForm()
        ;
    }
}
