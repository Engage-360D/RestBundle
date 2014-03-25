<?php

/**
 * This file is part of the Engage360d package bundles.
 *
 */

namespace Engage360d\Bundle\RestBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Form;

/**
 * Базовый Rest controller.
 *
 * @author Andrey Linko <AndreyLinko@gmail.com>
 */
class RestController extends Controller
{
    protected function getErrorMessages(Form $form)
    {
        $errors = array();
    
        foreach ($form->getErrors() as $key => $error) {
                $errors[] = $error->getMessage();
        }
    
        foreach ($form->all() as $child) {
            if (!$child->isValid()) {
                $errors[$child->getName()] = $this->getErrorMessages($child);
            }
        }
    
        return $errors;
    }
}
