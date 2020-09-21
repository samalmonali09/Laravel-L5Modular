<?php

namespace App\Modules\Admin\Models;

use Illuminate\Database\Eloquent\Model;

class Tutorial extends Model {

    protected $table = 'tutorial';
    protected $primaryKey = 'id';
    public $timestamps = false;
    protected $fillable = [
        'title',
        'link',
        'thumbnail',
        'description'
    ];

}