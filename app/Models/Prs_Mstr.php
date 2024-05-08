<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Prs_Mstr extends Model
{
    // Sesuaikan dengan nama tabel yang sesuai
    protected $table = 'prs_mstr';

    // Jika kolom `prs_nbr` bukan auto increment, Anda perlu menonaktifkan inkremen pada model
    public $incrementing = false;

    // Kolom-kolom yang dapat diisi
    protected $fillable = [
        'prs_nbr',
        'prs_name',
        'prs_role',
        'prs_active',
        'prs_added',
    ];

  
    protected $primaryKey = 'prs_nbr';

    
    public $timestamps = false;

   
}
