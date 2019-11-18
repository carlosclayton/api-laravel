<?php

namespace ApiVue\Criteria;

use Prettus\Repository\Contracts\CriteriaInterface;
use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Class OnlyTrashedCriteria.
 *
 * @package namespace ApiVue\Criteria;
 */
class OnlyTrashedCriteria implements CriteriaInterface
{


    public function apply($model, RepositoryInterface $repository)
    {
        return $model->onlyTrashed();
    }

}
