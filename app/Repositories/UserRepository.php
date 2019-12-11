<?php

namespace ApiVue\Repositories;

use Prettus\Repository\Contracts\RepositoryInterface;

/**
 * Interface UserRepository.
 *
 * @package namespace ApiVue\Repositories;
 */
interface UserRepository extends RepositoryInterface
{
    public function paginate($limit = null, $page = null, $columns = ['*'], $method = "paginate");
}
