<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function productCategory()
    {
        return $this->belongsTo(ProductCategory::class);
    }

    public function productColor()
    {
        return $this->belongsTo(ProductColor::class);
    }

    public function types()
    {
        return $this->morphToMany(ProductType::class, 'type_assignments', 'type_assignments', 'type_assignments_id', 'type_id')
            ->withPivot(['my_bonus_field']);
    }

}
