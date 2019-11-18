<?php

namespace ApiVue\Criteria;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class OrderByCriteria.
 *
 * @package namespace ApiVue\Criteria;
 */
class OrderByCriteria implements CriteriaInterface
{

    private $field;
    private $order;

    public function __construct($field, $order)
    {
        $this->field = $field;
        $this->order = $order;
    }

    /**
     * Apply criteria in query repository
     *
     * @param string              $model
     * @param RepositoryInterface $repository
     *
     * @return mixed
     */


    public function apply($model, RepositoryInterface $repository)
    {
        return $model->orderBy($this->field, $this->order);
    }
}
