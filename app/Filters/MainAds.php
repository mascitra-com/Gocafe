<?php

namespace App\Filters;

use Intervention\Image\Image;
use Intervention\Image\Filters\FilterInterface;

class MainAds implements FilterInterface
{

    public function applyFilter(Image $image)
    {
        return $image->fit(700, 235)->encode('jpg', 75);
    }
}