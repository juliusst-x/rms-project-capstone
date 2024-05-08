<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    use HasFactory;

    protected $table = 'groups'; // Sesuaikan nama tabel dengan migrasi Anda

    protected $fillable = ['user_Cat']; // Tentukan kolom yang dapat diisi secara massal

    protected $primaryKey = 'id'; // Tentukan kunci primer

    public $timestamps = true; // Aktifkan atau nonaktifkan timestamps
}

