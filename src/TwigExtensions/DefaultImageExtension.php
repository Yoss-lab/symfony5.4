<?php

namespace App\TwigExtensions;
use Twig\Extension\AbstractExtension;
use App\Controller\Request;
use Twig\TwigFilter;

class DefaultImageExtension extends AbstractExtension {
    public function getFilters(){
        return[ new TwigFilter('defaultImage' , [$this , 'defaultImage']) ];
    }

    public function defaultImage(string $path) : string{
        if(strlen (trim($path)) == 0){
            return  'imagevide.png';
        }
        return $path;
    }
}