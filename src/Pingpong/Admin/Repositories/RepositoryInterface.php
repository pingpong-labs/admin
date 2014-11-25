<?php namespace Pingpong\Admin\Repositories;

interface RepositoryInterface {

    /**
     * Get all resources.
     *
     * @return mixed
     */
    public function all();

    /**
     * Get all resources or search resources by given $search.
     *
     * @param string|null $search
     * @return mixed
     */
    public function allOrSearch($search = null);

    /**
     * @param null $search
     * @param int $perPage
     * @return mixed
     */
    public function searchOrAllPaginated($search = null, $perPage = 10);

    /**
     * Get all resources and paginate the result by given $perPage.
     *
     * @param int $perPage
     * @return mixed
     */
    public function allPaginated($perPage = 10);

    /**
     * Get the specified resource by given $id.
     *
     * @param $id
     * @return mixed
     */
    public function find($id);

    /**
     * Search resources by given $search.
     *
     * @param string $search
     * @param int $perPage
     * @return mixed
     */
    public function search($search, $perPage = 10);

}