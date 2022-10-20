<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Hash;
use Laravel\Sanctum\HasApiTokens;
use App\Models\Department;
class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $table = 'wb_users';

    protected $primaryKey = 'idUSR';

    public $timestamps = false;

    protected $fillable = [
        'LoginUSR',
        'PassUSR',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'PassUSR' ,
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'DateCr' => 'datetime:Y-m-d H:i:s',
        'DateUp' => 'datetime:Y-m-d H:i:s'
    ];


    /**
     * Get the password for the user.
     *
     * @return string
     */
    public function getAuthPassword()
    {
        return $this->PassUSR;
    }

    public function department(){

      return  $this->belongsTo(App\Models\Department::class );

    }

    public function visite(){

        return  $this->belongsTo(App\Models\Visite::class, 'idUSR' );

      }

}
