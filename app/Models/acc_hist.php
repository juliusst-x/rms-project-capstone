<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class acc_hist extends Model
{
    use HasFactory;

    protected $table = 'accs_hist';

    protected $fillable = [
        'accs_date',
        'accs_prsn',
        'accs_added',
    ];



    
    public $timestamps = false;

}
