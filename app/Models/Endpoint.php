<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Endpoint extends Model
{
    use HasFactory;

    protected $fillable = [
        'location',
        'frequency'
    ];

    public $dates = [
        'nest_check'
    ];

    public function site()
    {
        return $this->belongsTo(Site::class);
    }
}
