<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Pesanan extends Model
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $fillable = [
        'nama',
        'jenisPesanan',
        'rincian',
    ];
}