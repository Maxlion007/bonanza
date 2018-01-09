<?php
/**
 * Created by PhpStorm.
 * User: User
 * Date: 02.11.2017
 * Time: 12:59
 */

namespace core\services\geolocation;


class Zipcode
{

    private $zipcode;
    private $state;
    private $name;
    private $boundaries;

    public function __construct($zipcode, $name, $state, $boundaries)
    {
        $this->zipcode=$zipcode;
        $this->name=$name;
        $this->state=$state;
        $this->boundaries=$boundaries;
    }
    public function getZipcode()
    {
        return $this->zipcode;
    }

    public function getState()
    {
        return $this->state;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getBoundaries()
    {
        return $this->boundaries;
    }

}