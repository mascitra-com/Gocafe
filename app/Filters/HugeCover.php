<?php

namespace app\Filters;

use Intervention\Image\Image;
use Intervention\Image\Filters\FilterInterface;

class HugeCover implements FilterInterface
{

    public function applyFilter(Image $image)
    {
        return $image->fit(1125, 325)->encode('jpg');
    }
}