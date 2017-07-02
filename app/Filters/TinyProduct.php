<?php

namespace app\Filters;

use Intervention\Image\Image;
use Intervention\Image\Filters\FilterInterface;

class TinyProduct implements  FilterInterface
{

    public function applyFilter(Image $image)
    {
        return $image->fit(75, 75);
    }
}