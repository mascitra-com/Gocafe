<?php

return array(

    /*
    |--------------------------------------------------------------------------
    | Name of route
    |--------------------------------------------------------------------------
    |
    | Enter the routes name to enable dynamic imagecache manipulation.
    | This handle will define the first part of the URI:
    | 
    | {route}/{template}/{filename}
    | 
    | Examples: "images", "img/cache"
    |
    */
   
    'route' => 'img/cache',

    /*
    |--------------------------------------------------------------------------
    | Storage paths
    |--------------------------------------------------------------------------
    |
    | The following paths will be searched for the image filename, submited 
    | by URI. 
    | 
    | Define as many directories as you like.
    |
    */
    
    'paths' => array(
        storage_path('app/public/banner'),
        storage_path('app/public/cover'),
        storage_path('app/public/logo'),
        storage_path('app/public/product'),
        storage_path('app/public/owner'),
    ),

    /*
    |--------------------------------------------------------------------------
    | Manipulation templates
    |--------------------------------------------------------------------------
    |
    | Here you may specify your own manipulation filter templates.
    | The keys of this array will define which templates 
    | are available in the URI:
    |
    | {route}/{template}/{filename}
    |
    | The values of this array will define which filter class
    | will be applied, by its fully qualified name.
    |
    */
   
    'templates' => array(
        'main-ads' => 'App\Filters\MainAds',
        'small-ads' => 'App\Filters\SmallAds',
        'huge-cover' => 'App\Filters\HugeCover',
        'small-avatar' => 'App\Filters\SmallAvatar',
        'small-cover' => 'App\Filters\SmallCover',
        'medium-logo' => 'App\Filters\MediumLogo',
        'small-logo' => 'App\Filters\SmallLogo',
        'tiny-logo' => 'App\Filters\TinyLogo',
        'tiny-product' => 'App\Filters\TinyProduct',
        'medium-product' => 'App\Filters\MediumProduct',
        'small-product' => 'App\Filters\SmallProduct',
        'large-product' => 'App\Filters\LargeProduct',
    ),

    /*
    |--------------------------------------------------------------------------
    | Image Cache Lifetime
    |--------------------------------------------------------------------------
    |
    | Lifetime in minutes of the images handled by the imagecache route.
    |
    */
   
    'lifetime' => 43200,

);
