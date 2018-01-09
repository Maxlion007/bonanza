<?php

namespace core\validators;

use yii\validators\RegularExpressionValidator;

class PhoneValidator extends RegularExpressionValidator
{
//    public $pattern = '/^\+[0-9]{2}\([0-9]{3}\) [0-9]{3}-[0-9]{2}-[0-9]{2}$/';
    public $pattern = '/^[\+]{0,1}[0-9]{0,2}[\(]{0,1}[0-9]{3}[\)]{0,1}[ -]{0,1}[0-9]{3}[ -]{0,1}[0-9]{2}[ -]{0,1}[0-9]{2}$/';
//    public $pattern = '/^[0-9\-\)\(\+]+$/';
    public $message = 'Only [a-z0-9_-] symbols are allowed.';
}