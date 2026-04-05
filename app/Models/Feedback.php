<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Feedback extends Model
{
    protected $table = 'feedback';
    protected $primaryKey = 'id_feedback';
    public $timestamps = false;
    
    protected $fillable = [
        'id_aspirasi',
        'id_admin',
        'pesan',
        'created_at'
    ];

    // Relasi
    public function aspirasi()
    {
        return $this->belongsTo(Aspirasi::class, 'id_aspirasi', 'id_aspirasi');
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'id_admin', 'id_admin');
    }
}