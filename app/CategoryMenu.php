<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\DB;

class CategoryMenu extends Model
{
	protected $table = 'categories_menus';

    protected $primaryKey = 'id';

    use SoftDeletes;

    public $incrementing = false;

	protected $dates = ['deleted_at'];

    protected $fillable = ['id', 'cafe_id', 'name', 'colour','created_by', 'updated_by', 'deleted_by'];    

    protected $hidden = ['cafe_id', 'created_by', 'updated_by', 'deleted_by'];

    //RELATIONS
    public function menus()
    {
    	return $this->hasMany(Menu::class);
    }
    
    public function cafe()
    {
    	return $this->belongsTo(Cafe::class);
    }

    public static function getCategoryHasMenu($cafe_id)
    {
        return DB::select("select * from `categories_menus` where exists (select * from `menus` where `menus`.`category_id` = `categories_menus`.`id` and `menus`.`deleted_at` is null) and (`cafe_id` = '" . $cafe_id . "') and `categories_menus`.`deleted_at` is null");
    }
}
