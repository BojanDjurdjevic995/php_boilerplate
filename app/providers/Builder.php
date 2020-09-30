<?php


namespace App\Providers;

use App\Traits\BuildsQueries;
use Illuminate\Database\Eloquent\Builder as MainBuilder;
use Illuminate\Database\Query\Builder as QueryBuilder;
use Illuminate\Http\Request;

class Builder extends MainBuilder
{
    use BuildsQueries;
    public function __construct(QueryBuilder $query)
    {
        parent::__construct($query);
    }

    /**
     * Paginate the given query.
     *
     * @param  int  $perPage
     * @param  array  $columns
     * @param  string  $pageName
     * @param  int|null  $page
     * @return \Illuminate\Contracts\Pagination\LengthAwarePaginator
     *
     * @throws \InvalidArgumentException
     */
    public function paginate($perPage = null, $columns = ['*'], $pageName = 'page', $page = null)
    {
        $request = \request();
        $page = $page ?: $request->get($pageName, 1);

        $perPage = $perPage ?: $this->model->getPerPage();

        $results = ($total = $this->toBase()->getCountForPagination())
            ? $this->forPage($page, $perPage)->get($columns)
            : $this->model->newCollection();

        return $this->paginator($results, $total, $perPage, $page, [
            'path' => $request->url(),
            'pageName' => $pageName,
        ]);
    }
}