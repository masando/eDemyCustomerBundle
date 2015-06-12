<?php

namespace eDemy\CustomerBundle\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class NIFValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {
        if (
            (!preg_match('/^[0-9]{8}[TRWAGMYFPDXBNJZSQVHLCKET]{1}$/i', $value, $matches)) &&
            (!preg_match('/^[a-zA-Z]{1}\\d{7}[a-jA-J0-9]{1}$/', $value, $matches))
            ) {
                $this->context->buildViolation($constraint->message)
                    //->setParameter('%string%', $value)
                    ->addViolation();
            }
    }
}