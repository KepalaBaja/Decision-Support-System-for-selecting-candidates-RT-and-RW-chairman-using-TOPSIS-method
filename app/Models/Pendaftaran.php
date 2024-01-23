<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pendaftaran extends Model
{
    use HasFactory;
    protected $fillable = ['nama_lengkap','tempat_lahir', 'tanggal_lahir','jenis_kelamin','telpon','pendidikan','pekerjaan','berkas'];

    protected $table = 'pendaftarans';

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function calon()
    {
        return $this->belongsTo(Calon::class, 'id_calon', 'calon_id');
    }

}