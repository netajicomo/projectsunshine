<?php

namespace PS\Bundle\BalanceBudgetBundle\Form;

use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolverInterface;

class PlannerUserType extends AbstractType
{
        /**
     * @param FormBuilderInterface $builder
     * @param array $options
     */
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('firstname')
            ->add('lastname')
            ->add('email','email')
            ->add('confirmemail','email')
            ->add('mobilenumber','text',array('required' => false))
            ->add('phonenumber','text',array('required' => false))
            ->add('agreestatus','checkbox',array('required' => false))
            ->add('sessionid','hidden')    
        ;
    }
    
    /**
     * @param OptionsResolverInterface $resolver
     */
    public function setDefaultOptions(OptionsResolverInterface $resolver)
    {
        $resolver->setDefaults(array(
            'data_class' => 'PS\Bundle\BalanceBudgetBundle\Entity\PlannerUser'
        ));
    }

    /**
     * @return string
     */
    public function getName()
    {
        return 'ps_bundle_balancebudgetbundle_planner_user';
    }
}
