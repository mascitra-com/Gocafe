<?php

namespace app\Filters;

use Intervention\Image\Image;
use Intervention\Image\Filters\FilterInterface;

class SmallCover implements FilterInterface
{

    public function applyFilter(Image $image)
    {
        return $image->fit(400, 150);
    }
}