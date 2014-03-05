<?php

/**
 * This file is part of the Engage360d package bundles.
 *
 */

namespace Engage360d\Bundle\RestBundle\Form;

/**
 * Forms factory.
 *
 * @author Andrey Linko <AndreyLinko@gmail.com>
 */
class FormFactory
{
    private $forms = array();

    public function addForm($form, $route)
    {
        $this->forms[$route] = $form;
    }

    public function createFormByRoute($route)
    {
        if (!array_key_exists($route, $this->forms)) {
            throw new ServiceNotFoundException();
        }

        return $this->forms[$route];
    }
}
