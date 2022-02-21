<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Assignment extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'description',
        'linkfile',	
        'created_by',	
        'due',
        'id'
    ];

    public function accounts()
    {
        return $this->belongsToMany(Account::class, 'account_asses');
    }

    
}
