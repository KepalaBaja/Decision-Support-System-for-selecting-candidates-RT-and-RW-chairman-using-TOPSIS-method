<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class Penilai extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    protected $guard = 'penilaiMiddle';

    protected $table = 'penilais';

    protected $fillable = [
        'id',
        'name',
        'email',
        'password',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $primaryKey = 'id';

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed', 
    ];

    public function dataPenilaian()
    {
        return $this->hasMany(DataPenilaian::class, 'penilai_id', 'id');
    }
}
