<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Merchandise extends Model
{

    protected $table = 'merchandise';
    protected $fillable = [
        'item_name',
        'date_of_purchase',
        'supplier_name',
        'brand_make',
        'qty',
        'cost_per_item',
        'plant_location',
        'store_number',
    ];


    public function issueMerchandise(){
        return $this->hasMany(IssueMerchandise::class,'merchandise_id');
    }

}
