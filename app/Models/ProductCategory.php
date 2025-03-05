<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductCategory extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function types()
    {
        return $this->morphToMany(ProductType::class, 'type_assignments', 'type_assignments', 'type_assignments_id', 'type_id')
            ->withPivot(['my_bonus_field']);
    }

}
