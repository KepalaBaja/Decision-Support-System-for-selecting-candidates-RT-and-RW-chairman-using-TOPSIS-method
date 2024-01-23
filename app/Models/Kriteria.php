<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Kriteria extends Model
{
    use HasFactory;

    protected $fillable = ['kode_kriteria', 'nama_kriteria', 'bobot', 'jenis_kriteria'];

    protected $table = 'kriterias';
    protected $primaryKey = 'kriteria_id';

    public function dataPenilaian()
    {
        return $this->hasMany(DataPenilaian::class, 'id_kriteria' ,'kriteria_id');
    }
}