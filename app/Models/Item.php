<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    protected $is_on_sale = 0;
    protected $sale_price = 0;

    protected $appends = ['is_on_sale', 'sale_price'];

    public function animal() {
        return $this->belongsTo(Animal::class);
    }

    public function tags() {
        return $this->belongsToMany(Tag::class);
    }

    public function getIsOnSaleAttribute()
    {
        $this->is_on_sale =  $this->tags()->where('tag_id', 10)->count();
        return $this->is_on_sale;
    }

    public function getSalePriceAttribute()
    {
        $sale_price = $this->price;

        if ( $this->is_on_sale == 1 ) {
            $sale_price *= .8; 
        }

        return $sale_price;
    }
}
