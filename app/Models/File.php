<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class File extends Model
{
    use HasFactory;

    public static string $disk = 'local';

    protected $fillable = [ 'uploaded_file' , 'name', 'message', 'size' , 'shared_link' ];

 
}
