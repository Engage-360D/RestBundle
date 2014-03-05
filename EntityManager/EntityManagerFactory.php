<?php

/**
 * This file is part of the Engage360d package bundles.
 *
 */

namespace Engage360d\Bundle\RestBundle\EntityManager;

use Symfony\Component\DependencyInjection\Exception\ServiceNotFoundException;

/**
 * Entity managers factory.
 *
 * @author Andrey Linko <AndreyLinko@gmail.com>
 */
class EntityManagerFactory
{
    private $entityManagers = array();

    public function addEntityManager($entityManager, $route)
    {
        $this->entityManagers[$route] = $entityManager;
    }

    public function getEntityManagerByRoute($route)
    {
        if (!array_key_exists($route, $this->entityManagers)) {
            throw new ServiceNotFoundException();
        }

        return $this->entityManagers[$route];
    }
}
