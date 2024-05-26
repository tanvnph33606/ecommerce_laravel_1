<?php
// Trong Laravel, Repository Pattern thường được sử dụng để tạo các lớp repository, giúp tách biệt logic của ứng dụng khỏi cơ sở dữ liệu.
namespace App\Repositories;

use App\Models\ProductVariant;
use App\Repositories\Interfaces\ProductVariantRepositoryInterface;

class ProductVariantRepository extends BaseRepository implements ProductVariantRepositoryInterface
{
    protected $model;
    public function __construct(
        ProductVariant $model
    ) {
        $this->model = $model;
    }

    public function findVariant($code, $productId)
    {
        return $this->model
            ->select('album', 'code', 'barcode', 'price', 'quantity', 'product_id', 'sku', 'id', 'file_name', 'file_url', 'uuid')
            ->where('code', $code)
            ->where('product_id', $productId)
            ->with('languages', function ($query) {
                $query->where('language_id', session('currentLanguage', 1));
            })
            ->first();
    }
}
