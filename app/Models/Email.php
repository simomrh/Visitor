<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Mail;

class Email extends Model
{
    use HasFactory;
    public $fillable = ['Email_Emetteur', 'Nom_Emetteur', 'Objet', 'subject', 'Corp' , 'Pieds'];



    /**

     * Write code on Method

     *

     * @return response()

     */

    public static function boot() {



        parent::boot();



        static::created(function ($item) {



            $adminEmail = "marhoummohammed3@gmail.com";

            Mail::to($adminEmail)->send(new ContactMail($item));

        });


}
}
