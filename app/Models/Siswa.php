<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    protected $table = 'siswa';
    protected $primaryKey = 'nisn';
    public $incrementing = false;
    protected $keyType = 'string';
    public $timestamps = true;
    
    protected $fillable = [
        'nisn',
        'nama',
        'kelas',
        'password',
        'is_active',
        'created_at'
    ];
    
    protected $hidden = [
        'password'
    ];

    // Relasi with Aspirasi
    public function aspirasi()
    {
        return $this->hasMany(Aspirasi::class, 'nisn', 'nisn');
    }
}