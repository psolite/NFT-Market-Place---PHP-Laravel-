<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserDashs extends Model
{
    use HasFactory;

    public function depositHistory()
    {
        return $this->hasMany(DepositHistory::class);
    }
}
