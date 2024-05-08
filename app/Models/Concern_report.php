<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Concern_report extends Model
{
    use SoftDeletes;
    use HasFactory;

    protected $table = 'concern_reports';

    protected $fillable = [
        'user_id', 'description', 'image', 'status'
    ];

    protected $hidden = [

    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function details()
    {
        return $this->hasMany(Concern_report::class, 'id', 'id');
    }

    public function phones()
    {
        return $this->belongsTo(User::class);
    }

    public function responses()
    {
        return $this->belongsTo(Concern_report::class, 'id', 'id');
    }

    public function response()
    {
        return $this->hasOne(Concern_report::class);
    }

    public function status()
    {
        return $this->belongsTo(Concern_report::class, 'status_id','status');
    }
}
