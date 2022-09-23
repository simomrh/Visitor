<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RendezVous extends Model
{
    use HasFactory;

    protected $table = 'wb_rendezvous';

    protected $fillable = ['DateRDV',  'UserCr', 'DateCr'];


    protected $dateFormat = 'datetime:d-m-Y H:i:s';


    protected $dates = [
        'DateRDV'  => 'datetime:d-m-Y H:i:s' ,
    ];
    protected $casts = [

        'DateRDV' => 'datetime:d-m-Y H:i:s',
        'DateCr' => 'datetime:d-m-Y H:i:s',
        'DateUp' => 'datetime:d-m-Y H:i:s',

    ];

    public $timestamps = false;
    protected $primaryKey = 'IdRD';


}
