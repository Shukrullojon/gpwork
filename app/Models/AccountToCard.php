<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccountToCard extends Model
{
    use HasFactory;

    protected $table = 'account_to_cards';

    protected $guarded = [];
}
