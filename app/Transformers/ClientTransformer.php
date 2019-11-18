<?php

namespace ApiVue\Transformers;

use Carbon\Carbon;
use League\Fractal\TransformerAbstract;
use ApiVue\Models\Client;

/**
 * Class ClientTransformer.
 *
 * @package namespace ApiVue\Transformers;
 */
class ClientTransformer extends TransformerAbstract
{
    protected $availableIncludes = ['user'];
    /**
     * Transform the Client entity.
     *
     * @param \ApiVue\Models\Client $model
     *
     * @return array
     */
    public function transform(Client $model)
    {
        return [
            'id'         => (int) $model->id,
            'type' => $model->type == 'PF' ? 'Pessoa física' : 'Pessoa jurídica',
            'address' => $model->address,
            'city' => $model->city,
            'state' => $model->state,
            'zipcode' => $model->zipcode,
            'phone' => $model->phone,
            'email' => $model->email,
            'website' => $model->website,
            'status' => $model->status == 'ON' ? 'Habilitado' : 'Desabilitado',
            'created_at' => Carbon::parse($model->created_at)->format('d/m/Y H:i:s'),
            'updated_at' => Carbon::parse($model->updated_at)->format('d/m/Y H:i:s'),
            'deleted_at' => ($model->deleted_at == null) ? null : Carbon::parse($model->deleted_at)->format('d/m/Y H:i:s'),
        ];
    }

    public function includeUser(Client $model)
    {
        return $this->item($model->user, new UserTransformer());
    }
}
