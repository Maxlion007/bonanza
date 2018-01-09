<?php
namespace core\services\geolocation;

interface MapServiceInterface
{
    public function getCoordinates($address);
}