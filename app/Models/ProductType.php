<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'api_unique_number'];

    public function categories()
    {
        return $this->morphedByMany(ProductCategory::class, 'type_assignments', 'type_assignments', 'type_assignments_id', 'type_id')
            ->withPivot(['my_bonus_field']);
    }


    public function products()
    {
        return $this->morphedByMany(Product::class, 'type_assignments');
    }
}
