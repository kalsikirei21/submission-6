<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Validator;

class PeminjamanT extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';

    protected $table = 'peminjaman_t';
    protected $fillable = [
        'id',
        'no_peminjaman',
        'books_id',
        'pengunjung_id',
        'pegawai_id',
        'status',
        'is_deleted',
        'created_by',
        'updated_by',
        'created_at',
        'updated_at',
    ];

    protected $rules = [
        'no_peminjaman' => 'required',
        'books_id' => 'required',
        'pengunjung_id' => 'required',
        'pegawai_id' => 'required',
    ];

    public function validate(){
        Validator::make($this->toArray(), $this->rules)->validate();
        return $this;
    }
}
