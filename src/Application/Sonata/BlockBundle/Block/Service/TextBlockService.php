<?php
/**
 * Created by PhpStorm.
 * User: pushparaj
 * Date: 31/3/14
 * Time: 6:31 PM
 */

namespace Application\Sonata\BlockBundle\Block\Service;

use Sonata\BlockBundle\Block\BlockContextInterface;
use Sonata\BlockBundle\Block\Service\TextBlockService as BaseTextBlockService;
use Symfony\Component\HttpFoundation\Response;

class TextBlockService extends BaseTextBlockService
{
    public function execute(BlockContextInterface $blockContext, Response $response = null)
    {
        $template = 'ApplicationSonataBlockBundle:Block:block_core_text.html.twig';
        return $this->renderResponse($template, array(
            'block'     => $blockContext->getBlock(),
            'settings'  => $blockContext->getSettings()
        ), $response);
    }


} 