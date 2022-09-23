<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BlockedTimes extends Model
{
    use HasFactory;

    protected $table = 'wb_blocked_time';

    protected $fillable = ['DateDeb' , 'DateFin'  , 'IdDEP', 'IdVS' , 'UserCr' , 'DateCr'];

    public $timestamps = false;

    protected $primaryKey = 'IdBT';


    protected $dateFormat = 'datetime:Y-m-d H:i:s';


    protected $dates = [
        'DateDeb'  => 'datetime:Y-m-d H:i:s' ,
        'DateFin'  => 'datetime:Y-m-d H:i:s'
    ];
    protected $casts = [
        'DateDeb' => 'datetime:Y-m-d H:i:s',
        'DateFin' => 'datetime:Y-m-d H:i:s'

    ];


    public function department(){

        return  $this->belongsTo(App\Models\Department::class );

      }
}
