<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    use HasUuids ;
    protected $fillable = [
        'seriale',
        'balance',
        'status',
        'user_id'
    ];
    public function user()
    {
        return $this->BelongsTo(User::class);
    }
    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
}
