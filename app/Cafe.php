<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class Cafe extends Model
{
    public $incrementing = FALSE;

    protected $fillable = ['id', 'owner_id', 'name', 'description', 'open_hours', 'close_hours', 'phone', 'facebook', 'twitter', 'instagram'];

    /**
     * Get Cafe ID with Owner ID currently logged in
     *
     * @return Cafe ID|null
     */
    public static function getCafeIdByOwnerIdNowLoggedIn()
    {
        $cafe = DB::table('cafes')->where('owner_id', Owner::getOwnerIdNowLoggedIn())->first();
        if ($cafe) {
            return $cafe->id;
        } else {
            return NULL;
        }
    }

    public function owner()
    {
        return $this->belongsTo(Owner::class);
    }

    public function branches()
    {
        return $this->hasMany(CafeBranch::class);
    }

    public function menus()
    {
        return $this->hasMany(Menu::class);
    }

    public function packages()
    {
        return $this->hasMany(Package::class);
    }

    public function discounts()
    {
        return $this->hasMany(Discount::class);
    }

    public function menuCategories()
    {
        return $this->hasMany(CategoryMenu::class);
    }

    public function staffs()
    {
        return $this->hasManyThrough(Staff::class, CafeBranch::class, 'cafe_id', 'branch_id', 'id');
    }

    public function positions()
    {
        return $this->hasManyThrough(Position::class, CafeBranch::class, 'cafe_id', 'branch_id', 'id');
    }

    /**
     * Add Newly Cafe Branch by Cafe ID given.
     *
     * @param CafeBranch $cafeBranch
     * @param $cafeId
     */
    public function addBranch(CafeBranch $cafeBranch, $cafeId)
    {
        $cafeBranch->id = idWithPrefix(5);
        $cafeBranch->created_by = Auth::user()->id;
        self::find($cafeId)->branches()->save($cafeBranch);
    }

    /**
     * Add New Menu's Category by Cafe ID given.
     *
     * @param CategoryMenu $category
     * @param $cafeId
     */
    public function addMenuCategory(CategoryMenu $category, $cafeId)
    {
        $category->id = idWithPrefix(6);
        $category->created_by = Auth::user()->id;
        self::find($cafeId)->menuCategories()->save($category);
        return $category->id;
    }

    /**
     * Add New Menu's by Cafe ID given.
     *
     * @param Menu $category
     * @param $cafeId
     */
    public function addMenu(Menu $menu, $cafeId)
    {
        $menu->id = idWithPrefix(7);
        $menu->created_by = Auth::user()->id;
        self::find($cafeId)->menus()->save($menu);
    }
}
