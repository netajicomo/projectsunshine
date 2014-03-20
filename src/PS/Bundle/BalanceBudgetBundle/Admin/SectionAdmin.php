<?php

namespace PS\Bundle\BalanceBudgetBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class SectionAdmin extends Admin
{
    /**
     * @param DatagridMapper $datagridMapper
     */
//    protected function configureDatagridFilters(DatagridMapper $datagridMapper)
//    {
//        $datagridMapper
//            ->add('id')
//            ->add('name')
//            ->add('title')
//            ->add('lead')
//            ->add('description')
//            ->add('media')
//            ->add('is_active')
//            ->add('created_at')
//        ;
//    }

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
          //  ->add('id')
           
            ->add('name')
            ->add('title')
            //->add('lead')
           // ->add('description')
            ->add('media')
           // ->add('is_active')
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
           // ->add('id')
            ->add('category','entity',array('attr' => array('class' => 'for_display'),'class' => 'PSBalanceBudgetBundle:Category','property' => 'name'))            
            ->add('name')
            ->add('title')
            ->add('lead')
            ->add('description')
           // ->add('media')
           // ->add('is_active')
            //->add('created_at')
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            //->add('id')
            ->add('category')    
            ->add('name')
            ->add('title')
            ->add('lead')
            ->add('description')
           // ->add('media')
           // ->add('is_active')
            ->add('created_at')
        ;
    }
}
