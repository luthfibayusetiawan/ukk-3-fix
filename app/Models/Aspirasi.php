<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aspirasi extends Model
{
    protected $table = 'aspirasi';
    protected $primaryKey = 'id_aspirasi';
    public $timestamps = true;
    
    protected $fillable = [
        'nisn',
        'id_kategori',
        'lokasi',
        'keterangan',
        'jenis',
        'status',
        'foto_bukti',
        'created_at'
    ];

    // Relasi
    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'nisn', 'nisn');
    }

    public function kategori()
    {
        return $this->belongsTo(Kategori::class, 'id_kategori', 'id_kategori');
    }

    public function feedback()
    {
        return $this->hasMany(Feedback::class, 'id_aspirasi', 'id_aspirasi');
    }

    public function histori()
    {
        return $this->hasMany(HistoriStatus::class, 'id_aspirasi', 'id_aspirasi');
    }
}