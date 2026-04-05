<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FotoAspirasi extends Model
{
    protected $table = 'foto_aspirasi';
    protected $primaryKey = 'id_foto';
    public $timestamps = false;
    
    protected $fillable = [
        'id_aspirasi',
        'path_foto'
    ];

    // Relasi
    public function aspirasi()
    {
        return $this->belongsTo(Aspirasi::class, 'id_aspirasi', 'id_aspirasi');
    }
}