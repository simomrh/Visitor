<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RendezVous extends Model
{
    use HasFactory;

    protected $table = 'wb_rendezvous';

    protected $fillable = ['DateRD', 'ConfirmerRD' ,'AnnulerRD' , 'UserCr', 'DateCr'];


    protected $dateFormat = 'datetime:Y-m-d H:i:s';


    protected $dates = [
        'DateRDV'  => 'datetime:Y-m-d H:i:s' ,
    ];
    protected $casts = [

        'DateRDV' => 'datetime:Y-m-d H:i:s',
        'DateCr' => 'datetime:Y-m-d H:i:s',
        'DateUp' => 'datetime:Y-m-d H:i:s',

    ];

    public $timestamps = false;
    protected $primaryKey = 'IdRD';


    public function visite(){

        return  $this->belongsTo(App\Models\Visite::class, 'IdRD' );

      }

}
