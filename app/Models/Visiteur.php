<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visiteur extends Model
{
    use HasFactory;

    protected $table = 'wb_visiteurs';

    protected  $fillable = ['NomVS','CINVS','GSMVS','EmailVS','IdTP ','SocieteVS', 'UserCr' ,'DateCr'];

    protected $casts = [

        'DateCr' => 'datetime:Y-m-d H:i:s',
        'DateUp' => 'datetime:Y-m-d H:i:s'
    ];

    public $timestamps = false;
    protected $primaryKey = 'IdVS';

    public function TypeVisite(){

        return  $this->hasOne(App\Models\TypeVisite::class );

      }
}

