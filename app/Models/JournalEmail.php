<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class JournalEmail extends Model
{
    use HasFactory;

    protected $table = 'wb_journal_email';

    protected $fillable = ['IdRD' ,	'IdVS' ,	'ContenuEM' ,	'DateEM' ,	'ErrorsEM' ,	'Confirmer' ,	'Annuler' ,	'Rate' ,	'UserCr' ,	'DateCr'];
}
