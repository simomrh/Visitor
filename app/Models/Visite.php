<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Visite extends Model
{
    use HasFactory;

    protected $table = 'wb_visites';

    protected $fillable = ['IdVS' ,	'IdRD' ,'IdDEP' ,'LoginUSR' , 'Valide' , 'Annule' , 'Rate' ];

    protected $primaryKey = 'IdVis';

    protected $casts = [
      	'Check_In' =>  'datetime:Y-m-d H:i:s',
        'Check_Out' =>'datetime:Y-m-d H:i:s',
        'DateCr' => 'datetime:Y-m-d H:i:s',
        'DateUp' => 'datetime:Y-m-d H:i:s'
    ];

    public $timestamps = false;

    public function user(){

        return  $this->belongsTo(App\Models\User::class );

      }
}
