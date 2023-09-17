<?php

namespace App\Concerns;

use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

trait FileStorage
{
    public static function storeFile(Request $request)
    {
        $uploadedFile = $request->file('uploaded_file');
        
        $filePath = $uploadedFile->store('uploads', ['disk' => File::$disk]);

        $file = new File([
            'user_id' => Auth::id(),
            'uploaded_file' => $filePath,
            'name' => $uploadedFile->getClientOriginalName(),
            'size' => $request->input('size'),
            'message' => $request->input('message'),
            'shared_link' => Str::uuid()->toString(),
        ]);
        $file->save();
        return $file;
    }
}
