<?php

namespace app\Filters;

use Intervention\Image\Image;
use Intervention\Image\Filters\FilterInterface;

class MediumProduct implements  FilterInterface
{

    public function applyFilter(Image $image)
    {
        return $image->fit(300, 300);
    }
}