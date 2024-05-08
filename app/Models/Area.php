<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Area extends Model
{
    use HasFactory;
    protected $table = "areas";
    protected $primaryKey = 'id';
    protected $fillable = [
        'area_name',
        'description'
    ];

    public function trash()
    {
        return $this->hasMany(Trash::class, 'id');
    }
}
