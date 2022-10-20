<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Visite extends Model
{
    use HasFactory;

    protected $table = 'wb_visites';

    protected $fillable = ['IdVis',  'IdVS',    'IdRD', 'IdDEP','RaisonVis ', 'idUSR', 'Valide', 'Annule', 'Check_In', 'Check_Out', 'Rate'];

    protected $primaryKey = 'IdVis';

    protected $casts = [
        'Check_In' =>  'datetime:Y-m-d H:i:s',
        'Check_Out' => 'datetime:Y-m-d H:i:s',
        'DateCr' => 'datetime:Y-m-d H:i:s',
        'DateUp' => 'datetime:Y-m-d H:i:s'
    ];

    public $timestamps = false;

    public function user()
    {

        return  $this->hasOne(App\Models\User::class);
    }

    public function rendezVous()
    {

        return  $this->hasOne(App\Models\RendezVous::class);
    }

}
