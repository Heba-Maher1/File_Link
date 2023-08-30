<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DownloadedFile extends Model
{
    use HasFactory;

    protected $fillable = [
        'file_id' , 'user_agent' , 'ip_address' , 'created_at' , 'country'
    ];

    public function getUpdatedAtColumn()
    {
    }

    public function file()
    {
        return $this->belongsTo(File::class);
    }

}
