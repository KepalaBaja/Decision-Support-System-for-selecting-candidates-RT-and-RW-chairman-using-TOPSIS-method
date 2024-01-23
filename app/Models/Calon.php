<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Calon extends Model
{
    use HasFactory;
    protected $fillable = ['nama_calon','status'];

    protected $table = 'calons';

    protected $primaryKey = 'calon_id';

    public function dataPenilaian()
    {
        return $this->hasMany(DataPenilaian::class, 'id_calon', 'calon_id');
    }

    public function validasiCalon()
    {
        return $this->hasOne(Pendaftaran::class, 'id_calon','calon_id');
    }
}