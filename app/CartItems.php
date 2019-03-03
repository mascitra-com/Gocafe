<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class CartItems extends Model
{
    protected $table = 'cart_items';

    protected $fillable = ['cart_id', 'cafe_id', 'item_id', 'amount'];

    public function menu()
    {
        return $this->belongsTo(Menu::class, 'item_id', 'id');
    }
}
