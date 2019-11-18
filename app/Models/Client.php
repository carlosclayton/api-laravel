<?php

namespace ApiVue\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Client.
 *
 * @package namespace ApiVue\Models;
 */
class Client extends Model implements Transformable
{
    use TransformableTrait;
    use SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['type', 'address', 'city', 'state', 'zipcode', 'phone', 'email', 'website', 'status', 'user_id'];
    protected $dates = ['deleted_at'];

    function user(){
        return $this->belongsTo(User::class);
    }

}
