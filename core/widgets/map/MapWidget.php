<?php
namespace core\widgets\map;

use core\managers\Patient\PatientLocationService;
use Yii;
use dosamigos\google\maps\LatLng;
use dosamigos\google\maps\overlays\PolygonOptions;
use dosamigos\google\maps\overlays\InfoWindow;
use dosamigos\google\maps\overlays\Marker;
use dosamigos\google\maps\Map;
use dosamigos\google\maps\overlays\Polygon;
use yii\base\Widget;
class MapWidget extends Widget
{

    public $data;
    public $locationService;

    public function __construct(PatientLocationService $locationService,$config=[])
    {
        parent::__construct($config);
        $this->locationService=$locationService;
    }

    private function getStates()
    {

        $states=[];
        foreach($this->data as $data)
        {
            $states[]=$data['patient']->administrative_entity;
        }
        return $states;
    }

    private function colorCoaster()
    {
        $colors=['#FFAA00','#ff0800','#ffbf00','#fff200','#99ff00','#00fff2','#0087ff','#0004ff','#9d00ff','#ff00fa'];
        return $colors[rand(0, count($colors)-1)];
    }


    public function run()
    {
        if(empty($this->data))
        {
            throw new \DomainException('Location data is empty or corrupted;');
        }

        $boundaries=$this->locationService->mapService->getZipcodeBoundaries($this->getStates());

        $map = new Map([
            'center' =>new LatLng(['lat'=>$this->data[0]['location']['latitude'],'lng'=>$this->data[0]['location']['longitude']]),
            'zoom' => 14,
        ]);

        foreach($this->data as $coordinate)
        {
            $title=$coordinate['patient']->getFullName().", ".$coordinate['location']->address;
            $content=$coordinate['patient']->getFullName().", ".$coordinate['location']->address;

            if(isset($coordinate['time']))
            {
                foreach($coordinate['time'] as $time)
                {
                    $content.=", ".$time->time_from."-".$time->time_to;
                }

            }
            // Lets add a marker now
            $marker = new Marker([
                'position' => new LatLng(['lat'=>$coordinate['location']['latitude'],'lng'=>$coordinate['location']['longitude']]),
                'title' => $title,
            ]);

// Provide a shared InfoWindow to the marker
            $marker->attachInfoWindow(
                new InfoWindow([
                    'content' => "<p>$content</p>"
                ])
            );

// Add marker to the map
            $map->addOverlay($marker);
        }

// Now lets write a polygon
                foreach($boundaries as $polygon)
        {
            $polygon_coords=[];
            foreach($polygon->getBoundaries() as $coord)
            {
                $polygon_coords[]=new LatLng(['lat'=>$coord['latitude'],'lng'=>$coord['longitude']]);
            }
            $new=new Polygon(['paths'=>$polygon_coords]);

            $polygonOptions = new PolygonOptions([
                'fillColor' => $this->colorCoaster(),
                'fillOpacity' => '0.2'
            ]);
            $new->setOptions($polygonOptions);

            $new->attachInfoWindow(new InfoWindow([
            'content' => "<p>{$polygon->getZipcode()}, {$polygon->getName()}</p>"
        ]));
                        $map->addOverlay($new);
        }

// Display the map -finally :)
        echo $map->display();
    }

}