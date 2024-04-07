<?php
// Trong Laravel, Repository Pattern thường được sử dụng để tạo các lớp repository, giúp tách biệt logic của ứng dụng khỏi cơ sở dữ liệu.
namespace App\Repositories;


use App\Repositories\Interfaces\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

class BaseRepository implements BaseRepositoryInterface
{
    protected $model;

    public function __construct(
        Model $model
    ) {
        $this->model = $model;
    }

    public function all($relation = [])
    {
        if (!empty($relation)) {
            return $this->model->relation($relation)->get();
        }
        return $this->model->all();
    }
    public function findById($modelId, $column = ['*'], $relation = [])
    {
        return $this->model->select($column)->with($relation)->findOrFail($modelId);
    }

    public function findByWhere($conditions = [], $column = ['*'], $relation = [], $all = false)
    {
        $query = $this->model->select($column);
        if (!empty($relation)) {
            $query->customWhere($conditions)->relation($relation);
        } else {
            $query->customWhere($conditions);
        }

        return $all ? $query->get() : $query->first();
    }

    public function create($payload = [])
    {
        $create = $this->model->create($payload);
        return $create->fresh();
    }

    public function createBatch($payload = [])
    {
        return $this->model->insert($payload);
    }

    public function createPivot($model, $payload = [], $relation = '')
    {
        // attach($model->id, $payload) là phương thức được gọi để thêm một bản ghi mới vào bảng pivot.
        return $model->{$relation}()->attach($model->id, $payload);
    }

    public function update($modelId, $payload = [])
    {
        $model = $this->findById($modelId);
        return $model->update($payload);
    }

    // Truyen vao ham updateByWhereIn (Field name, array field name, va mang data can update)
    public function updateByWhereIn($whereInField = '', $whereIn = [], $payload = [])
    {
        return $this->model->whereIn($whereInField, $whereIn)->update($payload);
    }
    public function updateByWhere($conditions = [], $payload = [])
    {
        $query = $this->model->newQuery();
        return  $query->customWhere($conditions)->update($payload);
    }

    public function updateOrInsert($payload = [], $conditions = [])
    {
        $this->model->updateOrInsert($conditions, $payload);
    }

    public function delete($modelId)
    {
        $delete = $this->findById($modelId);
        return $delete->delete();
    }

    public function deleteByWhere($conditions = [])
    {
        $query = $this->model->newQuery();
        return  $query->customWhere($conditions)->delete();
    }


    // Xoá cứng
    public function forceDelete($modelId)
    {
        $delete = $this->findById($modelId);
        return $delete->forceDelete();
    }

    public function forceDeleteByWhere($conditions)
    {
        $query = $this->model->newQuery();
        return  $query->customWhere($conditions)->forceDelete();
    }


    public function pagination(
        $column = ['*'],
        $condition = [],
        $perPage = 1,
        $orderBy = ['id' => 'DESC'],
        $join = [],
        $relations = [],
        $groupBy = [],
        $rawQuery = [],
    ) {
        $query = $this->model->select($column);
        $query->keyword($condition['keyword'] ?? null)
            ->publish($condition['publish'] ?? null)
            ->customWhere($condition['where'] ?? null)
            ->customWhereRaw($rawQuery['whereRaw'] ?? null)
            ->relation($relations ?? null)
            ->relationCount($relations ?? null)
            ->customJoin($join ?? null)
            ->customGroupBy($groupBy ?? null)
            ->customOrderBy($orderBy ?? null);

        //Phương thức withQueryString() trong Laravel được sử dụng để giữ nguyên các tham số truy vấn
        return $query->paginate($perPage)->withQueryString();
    }
}
