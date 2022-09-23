<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Event;
class Departement extends Model
{
    use HasFactory;


    protected $table = 'wb_departement';

    protected $fillable = ['NomDEP' ,	'UserCr' 	,'DateCr'];

    public $timestamps = false;

    protected $primaryKey = 'IdDEP';

    protected $casts = [
        'DateCr' => 'datetime:Y-m-d H:i:s',
        'DateUp' => 'datetime:Y-m-d H:i:s',

    ];

    public function users()
    {
        return $this->hasMany(App\Models\User::class , 'IdDEP');
    }

    public function BlockedTimes()
    {
        return $this->hasMany(App\Models\BlockedTimes::class , 'IdDEP');
    }
}
