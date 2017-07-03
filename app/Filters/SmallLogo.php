<?php

namespace app\Filters;

use Intervention\Image\Image;
use Intervention\Image\Filters\FilterInterface;

class SmallLogo implements  FilterInterface
{

    public function applyFilter(Image $image)
    {
        return $image->fit(150, 150)->encode('jpg', 70);
    }
}