<?php

namespace ApiVue;

use Illuminate\Database\Eloquent\Model;

/**
 * ApiVue\Contact
 *
 * @property int $id
 * @property string $name
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\ApiVue\Contact newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\ApiVue\Contact newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\ApiVue\Contact query()
 * @method static \Illuminate\Database\Eloquent\Builder|\ApiVue\Contact whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\ApiVue\Contact whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\ApiVue\Contact whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\ApiVue\Contact whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class Contact extends Model
{
    protected $fillable = ['name'];
}
