<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Trash extends Model
{
   use HasFactory;

   /**
    * The attributes that are mass assignable.
    *
    * @var array
    */

   protected $table = 'trashes';
   protected $primayKey = 'id';
   protected $fillable = [
      'trash_level',
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
