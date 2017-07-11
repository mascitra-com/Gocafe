<?php

namespace app\Filters;

use Intervention\Image\Image;
use Intervention\Image\Filters\FilterInterface;

class SmallAds implements  FilterInterface
{

    public function applyFilter(Image $image)
    {
        return $image->fit(405, 110)->encode('jpg', 75);
    }
}