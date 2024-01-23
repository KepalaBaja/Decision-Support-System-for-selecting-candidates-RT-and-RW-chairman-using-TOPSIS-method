<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataPenilaian extends Model
{
    use HasFactory;
    protected $fillable = ['id_calon','id_kriteria','penilai_id','nilai'];

    protected $primaryKey = 'nilai_id';

    protected $table = 'data_penilaians';

    protected $casts = [
        'nilai' => 'integer'
    ];
    
    public function calon()
    {
        return $this->belongsTo(Calon::class, 'id_calon', 'calon_id');
    }

    public function kriteria()
    {
        return $this->belongsTo(Kriteria::class, 'id_kriteria','kriteria_id');
    }
    
    public function penilai()
    {
        return $this->belongsTo(Penilai::class, 'penilai_id','id');
    }
    


}