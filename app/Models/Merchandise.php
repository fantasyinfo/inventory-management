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
        'sku',
        'item_image'
    ];


    public function issueMerchandise()
    {
        return $this->hasMany(IssueMerchandise::class, 'merchandise_id');
    }

    public static function getTotalItemCount($item)
    {
        return self::where('item_name', $item)->sum('qty');
    }

    public static function getTotalItemValue()
    {
        return self::sum(\DB::raw('qty * cost_per_item'));
    }

    public static function getAlertForLessThen20Stocks()
    {
        return self::where('qty', '<', 20)
            ->get(['id', 'item_name', 'qty', 'plant_location', 'store_number']);
    }

}
