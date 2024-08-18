<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Hotel extends Model
{
    use HasFactory, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'company_name',
        'fantasy_name',
        'cnpj',
        'phone',
    ];

    /**
     * Get the users for the hotel.
     */
    public function users()
    {
        return $this->hasMany(User::class, 'id_hotel');
    }
}
