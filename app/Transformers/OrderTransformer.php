<?php

namespace ApiVue\Transformers;

use Carbon\Carbon;
use League\Fractal\TransformerAbstract;
use ApiVue\Models\Order;

/**
 * Class OrderTransformer.
 *
 * @package namespace ApiVue\Transformers;
 */
class OrderTransformer extends TransformerAbstract
{
    protected $availableIncludes = ['user', 'product'];

    /**
     * Transform the Order entity.
     *
     * @param \ApiVue\Models\Order $model
     *
     * @return array
     */
    public function transform(Order $model)
    {
        return [
            'id' => (int)$model->id,
            'status' => $model->status,
            'created_at' => $model->created_at,
            'updated_at' => $model->updated_at,
            'created_at' => Carbon::parse($model->created_at)->format('d/m/Y H:i:s'),
            'updated_at' => Carbon::parse($model->updated_at)->format('d/m/Y H:i:s')
        ];
    }

    public function includeProduct(Order $model)
    {

        return $this->collection($model->product, new ProductTransformer());
    }

    public function includeUser(Order $model)
    {


        return $this->collection($model->user, new UserTransformer());
    }

}

