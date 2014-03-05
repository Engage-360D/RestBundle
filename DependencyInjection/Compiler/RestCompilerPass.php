<?php

/**
 * This file is part of the Engage360d package bundles.
 *
 */

namespace Engage360d\Bundle\RestBundle\DependencyInjection\Compiler;

use Symfony\Component\DependencyInjection\Reference;
use Symfony\Component\DependencyInjection\ContainerBuilder;
use Symfony\Component\DependencyInjection\Compiler\CompilerPassInterface;

/**
 * This pass rest factories.
 *
 * @author Andrey Linko <AndreyLinko@gmail.com>
 */
class RestCompilerPass implements CompilerPassInterface
{
    public function process(ContainerBuilder $container)
    {
        $this->processEntityManagers($container);
        $this->processForms($container);
    }

    public function processEntityManagers(ContainerBuilder $container)
    {
        $taggedServices = $container->findTaggedServiceIds('rest.entity_manager');
        $managerFactory = $container->getDefinition('engage360d_rest.entity_manager.factory');
        
        foreach ($taggedServices as $id => $tagAttributes) {
            foreach ($tagAttributes as $attributes) {
                if (array_key_exists('route', $attributes)) {
                    $managerFactory->addMethodCall(
                        'addEntityManager',
                        array(new Reference($id), $attributes['route'])
                    );
                }
            }
        }
    }

    public function processForms(ContainerBuilder $container)
    {
        $taggedServices = $container->findTaggedServiceIds('rest.form');
        $formFactory = $container->getDefinition('engage360d_rest.form.factory');
        
        foreach ($taggedServices as $id => $tagAttributes) {
            foreach ($tagAttributes as $attributes) {
                if (array_key_exists('route', $attributes)) {
                    $formFactory->addMethodCall(
                        'addForm',
                        array(new Reference($id), $attributes['route'])
                    );
                }
            }
        }
    }
}
