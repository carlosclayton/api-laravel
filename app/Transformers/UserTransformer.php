<?php

namespace ApiVue\Transformers;

use Carbon\Carbon;
use League\Fractal\TransformerAbstract;
use ApiVue\Models\User;

/**
 * Class UserTransformer.
 *
 * @package namespace ApiVue\Transformers;
 */
class UserTransformer extends TransformerAbstract
{

    protected $availableIncludes = ['client', 'orders'];
    /**
     * Transform the User entity.
     *
     * @param \ApiVue\Models\User $model
     *
     * @return array
     */
    public function transform(User $model)
    {

        return [
            'id'         => (int) $model->id,
            'name' =>  $model->name,
            'email' =>  $model->email,
            'email_verified_at' => $model->email_verified_at,
            'role' => ($model->role == 1) ? 'ADMIN' : 'CLIENT',
            'created_at' => Carbon::parse($model->created_at)->format('d/m/Y H:i:s'),
            'updated_at' => Carbon::parse($model->updated_at)->format('d/m/Y H:i:s'),
            'deleted_at' => ($model->deleted_at == null) ? null : Carbon::parse($model->deleted_at)->format('d/m/Y H:i:s'),
            'deleted_at' => ($model->deleted_at == null) ? null : Carbon::parse($model->deleted_at)->format('d/m/Y H:i:s')
        ];
    }

    public function includeClient(User $model)
    {
        return $this->item($model->client, new ClientTransformer());
    }

    public function includeOrders(User $model)
    {
        return $this->collection($model->orders, new OrderTransformer());
    }
}
