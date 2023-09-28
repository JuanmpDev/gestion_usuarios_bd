<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Kyslik\ColumnSortable\Sortable;


class Rol extends Model
{
    use HasFactory;
    use Sortable;

    protected $table = 'rols';
    protected $fillable = ['name'];


    protected $sortable = [
        'id',
        'name',
    ];

    public function users(){

        return $this -> hasMany(User::class, 'rol_id','id');
    }
}
