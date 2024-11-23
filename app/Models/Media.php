<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Media extends Model
{
    use HasFactory, SoftDeletes;

    // all stock convert to be inventory data
    protected $table = 'medias';

    public $incrementing = false;

    protected $casts = ['id' => 'string'];

    protected $fillable = [
        'id',
        'file_name',
        'file_path',
        'file_url',
        'extension',
        'alt',
        'caption',
        'type',
        'partials',
        'meta',
    ];

    protected $hidden = [
        'deleted_at',
    ];
}
