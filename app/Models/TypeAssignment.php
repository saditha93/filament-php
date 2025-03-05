<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeAssignment extends Model
{
    use HasFactory;

    protected $table = 'type_assignments';

    protected $fillable = ['type_assignments_type', 'type_assignments_id', 'type_id', 'my_bonus_field'];

    public function type()
    {
        return $this->belongsTo(ProductType::class, 'type_id');
    }
}
