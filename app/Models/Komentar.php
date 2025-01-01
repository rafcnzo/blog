<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Komentar extends Model
{
    use HasFactory;

    protected $table = 'komentar';
    protected $primaryKey = 'id_komentar';

    public $timestamps = false;

    protected $fillable = [
        'id_berita',
        'user_id',
        'tanggal',
        'suggestion',
    ];

    // Konversi tanggal ke Carbon
    protected $dates = ['tanggal'];

    // Mutator untuk tanggal
    public function setTanggalAttribute($value)
    {
        $this->attributes['tanggal'] = is_string($value) ? 
            Carbon::parse($value) : 
            $value;
    }

    // Accessor untuk tanggal
    public function getTanggalAttribute($value)
    {
        return Carbon::parse($value);
    }

    public function berita()
    {
        return $this->belongsTo(Berita::class, 'id_berita', 'id_berita');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'user_id');
    }
}