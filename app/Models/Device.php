<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    use HasFactory;

    protected $fillable = ['device_id', 'name', 'type'];

    //Query Scope
    public function scopeFilter($query, $filters)
    {
        $query->when($filters['search'] ?? null, function ($query, $search) {
            $query->where('device_id', 'LIKE', "%" . $search . "%")
                ->orWhere('name', 'LIKE', "%" . $search . "%")
                ->orWhere('type', 'LIKE', "%" . $search . "%");
        });
    }
}
