<?php

namespace PS\Bundle\BalanceBudgetBundle\Admin;

use Sonata\AdminBundle\Admin\Admin;
use Sonata\AdminBundle\Datagrid\DatagridMapper;
use Sonata\AdminBundle\Datagrid\ListMapper;
use Sonata\AdminBundle\Form\FormMapper;
use Sonata\AdminBundle\Show\ShowMapper;

class HeaderMenuAdmin extends Admin
{

    /**
     * @param ListMapper $listMapper
     */
    protected function configureListFields(ListMapper $listMapper)
    {
        $listMapper
            //->add('id')
            ->add('title')
            ->add('url_type')

           // ->add('lead')
          //  ->add('description')
            ->add('url',null, array('label' => 'URL'))
            ->add('target')
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
            ->add('title')
//            ->add('url_type','choice',array('required' => true,'label' => 'URL type','choices' => array('main' => 'Main','internal' => 'Internal','external' => 'External')))
            ->add('url')
            ->add('target',null,array('required' => false))
            ->add('parent','entity',array('class' => 'PSBalanceBudgetBundle:HeaderMenu','property' => 'name', 'empty_value' => 'Select an Parent', 'required' =>false))
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
            ->add('title')
            ->add('url_type')
            ->add('url')
            ->add('target')
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
