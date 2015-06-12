<?php

namespace eDemy\CustomerBundle\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */
class NIF extends Constraint
{
    public $message = 'NIF o CIF incorrecto';
    
    public function validatedBy()
    {
        return get_class($this).'Validator';
    }
}