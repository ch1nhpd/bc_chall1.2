<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Challenge extends Model
{
    use HasFactory;

    protected $fillable = [
        'id',
        'description',
        'hint',
        'account_id',
    ];

    public function accounts()
    {
        return $this->belongsToMany(Account::class, 'account_asses');
    }
}
