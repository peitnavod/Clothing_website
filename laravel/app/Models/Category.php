<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
    protected $table = 'categories';
    protected $fillable = ['name','parent_id','slug'];// dc phep them du lieu
    public $timestamps = false;
    use SoftDeletes;
}
