<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Response extends Model
{
    use HasFactory;

    protected $table = 'responses';

    protected $fillable = [
        'concern_id',
        'response',
        'user_id',
    ];

    protected $hidden = [

    ];

    public function concern_report()
    {
        return $this->hasOne(Concern_report::class, 'id', 'id');
    }

    public function proses()
    {
        return $this->hasMany(Concern_report::class, 'status_id', 'status');
    }

    public function country()
    {
        return $this->hasOne(Concern_report::class);
    }
}