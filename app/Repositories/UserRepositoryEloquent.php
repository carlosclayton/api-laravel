<?php

namespace ApiVue\Repositories;

use ApiVue\Presenters\UserPresenter;
use Prettus\Repository\Eloquent\BaseRepository;
use Prettus\Repository\Criteria\RequestCriteria;
use ApiVue\Repositories\UserRepository;
use ApiVue\Models\User;
use ApiVue\Validators\UserValidator;

/**
 * Class UserRepositoryEloquent.
 *
 * @package namespace ApiVue\Repositories;
 */
class UserRepositoryEloquent extends BaseRepository implements UserRepository
{
    protected $fieldSearchable = [
        'id' => '=',
        'name' => 'like',
        'email' => '=',
        'role' => '='
    ];

    public function paginate($limit = null, $page = null, $columns = ['*'], $method = "paginate")
    {
        $this->applyCriteria();
        $this->applyScope();
        $limit = is_null($limit) ? config('repository.pagination.limit', 15) : $limit;
        $results = $this->model->{$method}($limit, $columns, 'page', $page);
        $results->appends(app('request')->query());
        $this->resetModel();

        return $this->parserResult($results);
    }


    /**
     * Specify Model class name
     *
     * @return string
     */
    public function model()
    {
        return User::class;
    }

    /**
    * Specify Validator class name
    *
    * @return mixed
    */
    public function validator()
    {

        return UserValidator::class;
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
        return new UserPresenter();
    }

}
