<?php

namespace ApiVue\Repositories;

use ApiVue\Presenters\ClientPresenter;
use ApiVue\Presenters\OrderPresenter;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use ApiVue\Repositories\OrderRepository;
use ApiVue\Models\Order;
use ApiVue\Validators\OrderValidator;

/**
 * Class OrderRepositoryEloquent.
 *
 * @package namespace ApiVue\Repositories;
 */
class OrderRepositoryEloquent extends BaseRepository implements OrderRepository
{
    protected $fieldSearchable = [
        'id' => '=',
        'status' => '=',
        'product.price' => 'like'
    ];

    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return Order::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return OrderValidator::class;
    }

    public function onlyTrashed()
    {
        $this->model = $this->model->onlyTrashed();
        return $this;
    }

    public function restore($id)
    {
        return $this->model->onlyTrashed()->find($id)->restore();
    }

    /**
     * Boot up the repository, pushing criteria
     */
    public function boot()
    {
        $this->pushCriteria(app(RequestCriteria::class));
    }

    public function presenter()
    {
        return new OrderPresenter();
    }
    
}
