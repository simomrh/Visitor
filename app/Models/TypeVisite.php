<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeVisite extends Model
{
    use HasFactory;

    protected $table = 'wb_type_visite';

    protected $fillable = ['NomTP',  'UserCr' 	,'DateCr'];

    protected $casts = [

        'DateCr' => 'datetime:Y-m-d H:i:s',
        'DateUp' => 'datetime:Y-m-d H:i:s'
    ];

    protected $primaryKey = 'IdTP';
    public $timestamps = false;

    public function Visiteur(){

        return  $this->belongsToMany(App\Models\Visiteur::class , 'IdTP');

      }
}
