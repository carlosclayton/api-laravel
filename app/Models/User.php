<?php

namespace ApiVue\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Prettus\Repository\Contracts\Transformable;
use Prettus\Repository\Traits\TransformableTrait;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

/**
 * ApiVue\Models\User
 *
 * @property int $id
 * @property string $name
 * @property string $email
 * @property \Illuminate\Support\Carbon|null $email_verified_at
 * @property string $password
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $role
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @method static \Illuminate\Database\Eloquent\Builder|\ApiVue\Models\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\ApiVue\Models\User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\ApiVue\Models\User query()
 * @method static \Illuminate\Database\Eloquent\Builder|\ApiVue\Models\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\ApiVue\Models\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\ApiVue\Models\User whereEmailVerifiedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\ApiVue\Models\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\ApiVue\Models\User whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\ApiVue\Models\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\ApiVue\Models\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\ApiVue\Models\User whereRole($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\ApiVue\Models\User whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Query\Builder|\ApiVue\Models\User onlyTrashed()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\ApiVue\Models\User whereDeletedAt($value)
 * @method static \Illuminate\Database\Query\Builder|\ApiVue\Models\User withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\ApiVue\Models\User withoutTrashed()
 */

class User extends Authenticatable implements Transformable, JWTSubject
{
    use TransformableTrait;
    use Notifiable;
    use SoftDeletes;

    const ROLE_ADMIN = 1;
    const ROLE_CLIENT = 2;

    protected $dates = ['deleted_at'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','role'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];




    public function getJWTIdentifier()
    {
        return $this->id;
    }

    public function getJWTCustomClaims()
    {
        return [
            'user' => [
                "id" => $this->id,
                "name" => $this->name,
                "email" => $this->email
            ]
        ];
    }

    public function client(){
        return $this->hasOne(Client::class);
    }

    public function orders(){
        return $this->hasMany(Order::class);
    }


}
