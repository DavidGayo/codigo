<?php

namespace Mesa\ClientesBundle\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

use Mesa\ClientesBundle\Entity\Contactos;
use Mesa\ClientesBundle\Form\ContactosType;

/**
 * Contactos controller.
 *
 */
class ContactosController extends Controller
{

    /**
     * Lists all Contactos entities.
     *
     */
    public function indexAction()
    {
        $em = $this->getDoctrine()->getManager();

        $entities = $em->getRepository('ClientesBundle:Contactos')->findAll();

        return $this->render('ClientesBundle:Contactos:index.html.twig', array(
            'entities' => $entities,
        ));
    }
    /**
     * Creates a new Contactos entity.
     *
     */
    public function createAction(Request $request)
    {
        $entity = new Contactos();
        $form = $this->createCreateForm($entity);
        $form->handleRequest($request);
        $password ="Warriors";
        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $randon = $this->generaPass();
            $password.=$randon;
            $entity -> setContrasena($password);
            $em->persist($entity);
            $em->flush();

            return $this->redirect($this->generateUrl('contactos_show', array('id' => $entity->getId())));
        }

        return $this->render('ClientesBundle:Contactos:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    /**
     * Creates a form to create a Contactos entity.
     *
     * @param Contactos $entity The entity
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createCreateForm(Contactos $entity)
    {
        $form = $this->createForm(new ContactosType(), $entity, array(
            'action' => $this->generateUrl('contactos_create'),
            'method' => 'POST',
        ));

        $form->add('submit', 'submit', array('label' => 'Create'));

        return $form;
    }

    /**
     * Displays a form to create a new Contactos entity.
     *
     */
    public function newAction()
    {
        $entity = new Contactos();
        $form   = $this->createCreateForm($entity);

        return $this->render('ClientesBundle:Contactos:new.html.twig', array(
            'entity' => $entity,
            'form'   => $form->createView(),
        ));
    }

    public function generaPass(){
        
        $cadena = "ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz1234567890";
        $longitudCadena=strlen($cadena);
        $pass = "";
        
        $longitudPass=4;
         
        
        for($i=1 ; $i<=$longitudPass ; $i++){
            $pos=rand(0,$longitudCadena-1);
            $pass .= substr($cadena,$pos,1);
        }
        return $pass;
    }

    public function nuevoPassAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ClientesBundle:Contactos')->find($id);

            $password ="Warriors";
            $randon = $this->generaPass();  
            $password.=$randon;
            $entity -> setContrasena($password);
            $em->flush();

            $deleteForm = $this->createDeleteForm($id);
            
            return $this->redirect($this->generateUrl('contactos_show', array('id' => $entity->getId())));
    }

    /**
     * Finds and displays a Contactos entity.
     *
     */
    public function showAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ClientesBundle:Contactos')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Contactos entity.');
        }

        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ClientesBundle:Contactos:show.html.twig', array(
            'entity'      => $entity,
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
     * Displays a form to edit an existing Contactos entity.
     *
     */
    public function editAction($id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ClientesBundle:Contactos')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Contactos entity.');
        }

        $editForm = $this->createEditForm($entity);
        $deleteForm = $this->createDeleteForm($id);

        return $this->render('ClientesBundle:Contactos:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }

    /**
    * Creates a form to edit a Contactos entity.
    *
    * @param Contactos $entity The entity
    *
    * @return \Symfony\Component\Form\Form The form
    */
    private function createEditForm(Contactos $entity)
    {
        $form = $this->createForm(new ContactosType(), $entity, array(
            'action' => $this->generateUrl('contactos_update', array('id' => $entity->getId())),
            'method' => 'PUT',
        ));

        $form->add('submit', 'submit', array('label' => 'Update'));

        return $form;
    }
    /**
     * Edits an existing Contactos entity.
     *
     */
    public function updateAction(Request $request, $id)
    {
        $em = $this->getDoctrine()->getManager();

        $entity = $em->getRepository('ClientesBundle:Contactos')->find($id);

        if (!$entity) {
            throw $this->createNotFoundException('Unable to find Contactos entity.');
        }

        $deleteForm = $this->createDeleteForm($id);
        $editForm = $this->createEditForm($entity);
        $editForm->handleRequest($request);

        if ($editForm->isValid()) {
            $em->flush();

            return $this->redirect($this->generateUrl('contactos_edit', array('id' => $id)));
        }

        return $this->render('ClientesBundle:Contactos:edit.html.twig', array(
            'entity'      => $entity,
            'edit_form'   => $editForm->createView(),
            'delete_form' => $deleteForm->createView(),
        ));
    }
    /**
     * Deletes a Contactos entity.
     *
     */
    public function deleteAction(Request $request, $id)
    {
        $form = $this->createDeleteForm($id);
        $form->handleRequest($request);

        if ($form->isValid()) {
            $em = $this->getDoctrine()->getManager();
            $entity = $em->getRepository('ClientesBundle:Contactos')->find($id);

            if (!$entity) {
                throw $this->createNotFoundException('Unable to find Contactos entity.');
            }

            $em->remove($entity);
            $em->flush();
        }

        return $this->redirect($this->generateUrl('contactos'));
    }

    /**
     * Creates a form to delete a Contactos entity by id.
     *
     * @param mixed $id The entity id
     *
     * @return \Symfony\Component\Form\Form The form
     */
    private function createDeleteForm($id)
    {
        return $this->createFormBuilder()
            ->setAction($this->generateUrl('contactos_delete', array('id' => $id)))
            ->setMethod('DELETE')
            ->add('submit', 'submit', array('label' => 'Eliminar','attr' => array('class' => 'btn btn-danger')))
            ->getForm()
        ;
    }
}
