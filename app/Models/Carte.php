<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;



class Carte extends Model
{
    use HasFactory;

    /**
     * 
     * Les champs qui peuvent être remplis en masse
     */
    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'email',
        'adress',
        'phone',
        'title',
        'company',
        'website',
        'facebook',
        'linkdin',
        'whatsapp',
        'logo',
        'photo',
        'background_image',
        'qr_code'
    ];

    // Conversion automatique des champs JSON en tableaux PHP
    // protected $casts = [
    //     'social_links' => 'array',
    // ];

    // Relation avec le modèle User
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
