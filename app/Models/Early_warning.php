<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Early_warning extends Model
{
    use HasFactory;

    protected $table = "early_warnings";

    protected $fillable = [
        'water_level', 
        'area_id', 
        'status', 
        'Created_at', 
        'Updated_at'
    ];

    public function user()
   {
      return $this->belongsTo(User::class);
   }

   public function  area()
   {
      return $this->belongsTo(Area::class, 'area_id', 'id');
   }

   public function getRouteKeyName()
   {
      return 'id';
   }
}
