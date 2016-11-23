<?php

namespace Mesa\UsuarioBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class UsuarioType extends AbstractType
{
    /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('userName')
            ->add('nombre')
            ->add('apePat')
            ->add('password', 'repeated', array(
                    'type' => 'password',
                    'invalid_message' => 'Las contraseñas no coinciden.',
                    'options' => array('attr' => array('class' => 'input-xlarge','minlength'=>8)),
                    'required' => false,
                    'first_options'  => array('label' => 'Contraseña'),
                    'second_options' => array('label' => 'Repite contraseña')))
            ->add('rol', 'choice', array(
                'choices' => array(
                    'ROLE_ADMIN' => 'Administrador', 
                    'ROLE_USER' => 'Usuario', 
                    )
                ))
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'Mesa\UsuarioBundle\Entity\Usuario'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'usuariobundle_usuario';
    }
}
