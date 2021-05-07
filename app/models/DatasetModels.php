<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;

class DatasetModels extends Model
{
    protected $table = 'dataset';
    protected $guarded = ['id'];
    public $timestamps = false;
}
