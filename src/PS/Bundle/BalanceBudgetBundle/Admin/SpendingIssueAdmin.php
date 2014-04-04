<?php

namespace PS\Bundle\BalanceBudgetBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class SpendingIssueAdmin extends Admin
{

    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
         //   ->add('id')
            ->add('name')
            ->add('section')
            ->add('created_at')
            ->add('_action', 'actions', array(
                'actions' => array(
                    'show' => array(),
                    'edit' => array(),
                    'delete' => array(),
                )
            ))
        ;
    }

    /**
     * @param FormMapper $formMapper
     */
    protected function configureFormFields(FormMapper $formMapper)
    {
        $formMapper
            ->add('section','choice',array(
                'choices'=> array(
                    'ECONOMIC INFRASTRUCTURE' => 'ECONOMIC INFRASTRUCTURE',
                    'SOCIAL INFRASTRUCTURE' => 'SOCIAL INFRASTRUCTURE'
                )
            ))
            ->add('category','choice', array(
                'choices' => array(
                    array('ECONOMIC INFRASTRUCTURE' => array(
                        'Transport' => 'Transport',
                        'Supporting Growth' => 'Supporting Growth'
                    )),
                    array('SOCIAL INFRASTRUCTURE' => array(
                        'Education and Training' => 'Education and Training',
                        'Health' => 'Health',
                        'Community Support' => 'Community Support',
                        'Sport, Recreation and the Environment' => 'Sport, Recreation and the Environment'
                    ))
                )
            ))
            ->add('name')
            ->add('option_values')
            ->add('controltype')
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            //->add('id')
            ->add('name')
            ->add('title')
            ->add('description')
            //->add('is_active')
            ->add('created_at')
        ;
    }
}
