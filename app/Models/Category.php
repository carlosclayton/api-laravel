<?php

namespace ApiVue\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;

/**
 * Class Category.
 *
 * @package namespace ApiVue\Models;
 * @property int $id
 * @property string $name
 * @property string|null $description
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\ApiVue\Models\Category newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\ApiVue\Models\Category newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\ApiVue\Models\Category query()
 * @method static \Illuminate\Database\Eloquent\Builder|\ApiVue\Models\Category whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\ApiVue\Models\Category whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\ApiVue\Models\Category whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\ApiVue\Models\Category whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\ApiVue\Models\Category whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\ApiVue\Models\Category whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Category extends Model implements Transformable
{
    use TransformableTrait;
    use SoftDeletes;

    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = ['name', 'description'];

    function products(){
        return $this->hasMany(Product::class);
    }


}
