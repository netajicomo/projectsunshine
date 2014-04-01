<?php

namespace PS\Bundle\BalanceBudgetBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class IssueAdmin extends Admin
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
//            ->add('option_values')
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
            //->add('id')
            ->add('name')
            ->add('title')
           // ->add('lead')
          //  ->add('description')
            ->add('sectionissue',null, array('label' => 'Section'))
            ->add('category','entity', array('code'=> 'getCategory'))    
            ->add('controltype',null, array('label' => 'Control Type'))
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
            ->add('sectionissue','entity',array('attr' => array('class' => 'for_display'), 'label' => 'Section','class' => 'PSBalanceBudgetBundle:Section','property' => 'name'))
            ->add('name')
            ->add('title')
            ->add('lead',null, array('required' => false))
            ->add('is_reduceBy',null, array('required' => false, 'label' => 'Is a reduction slider'))       
             ->add('is_parent',null, array('required' => false))    
         
            ->add('parent','entity',array('class' => 'PSBalanceBudgetBundle:Issue','property' => 'name', 'empty_value' => 'Select an Issue', 'required' =>false))        
            ->add('dependency','entity',array('class' => 'PSBalanceBudgetBundle:Dependency','property' => 'name', 'empty_value' => 'Select a Dependency', 'required' =>false))        
                ->add('issuegroup','entity',array('class' => 'PSBalanceBudgetBundle:IssueGroup','property' => 'name', 'empty_value' => 'Select an Issue Group', 'required' =>false))        
                ->add('description')
            ->add('controltype','entity',array('attr' => array('class' => 'for_display'),'class' => 'PSBalanceBudgetBundle:ControlType','property' => 'name'))
            ->add('option_values')
           // ->add('is_active')
           // ->add('created_at')
        ;
    }

    /**
     * @param ShowMapper $showMapper
     */
    protected function configureShowFields(ShowMapper $showMapper)
    {
        $showMapper
            ->add('id')
            ->add('name')
            ->add('title')
            ->add('lead')
            ->add('description')
            ->add('option_values')
            ->add('is_active')
            ->add('created_at')
        ;
    }
    
    public function getTemplate($name)
    {
        switch ($name) {
            case 'edit':
               return 'PSBalanceBudgetBundle:Admin:edit.html.twig';
                break;
            default:
                return parent::getTemplate($name);
                break;
        }
    }
    
    protected function configureRoutes(\Sonata\AdminBundle\Route\RouteCollection $collection) {
      $collection->add('getControlTypeProperties');
    
    }
}
