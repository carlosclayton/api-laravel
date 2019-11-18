<?php

namespace ApiVue\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Order.
 *
 * @package namespace ApiVue\Models;
 */
class Order extends Model implements Transformable
{
    use TransformableTrait;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['status', 'user_id', 'product_id'];
    protected $dates = ['deleted_at'];

    function user(){
        return $this->belongsToMany(User::class, 'orders', 'id', 'user_id');
    }

    function product(){
        return $this->belongsToMany(Product::class, 'orders', 'id', 'product_id');
    }

}
