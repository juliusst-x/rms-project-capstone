<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class img_dataset extends Model
{
    use HasFactory;

    protected $table = 'img_dataset';
    protected $fillable = [
       'img_person',
    ];
    
    protected $primaryKey = 'img_id';

    
    public $timestamps = false;
}
