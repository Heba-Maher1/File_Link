<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class FilesController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        return view('uploads.home');
    }

        public function upload(Request $request)
        {
            $request->validate([
                'uploaded_file' => 'required|file|mimes:jpeg,png,pdf,docx,txt',
                'size' => 'nullable|string|max:255',
                'title' => 'nullable|string|max:255',
                'message' => 'nullable|string|max:255',
            ]);
        
            $uploadedFile = $request->file('uploaded_file');
        
            $filePath = $uploadedFile->store('uploads', [
                'disk' => File::$disk,
            ]);
        
            $file = new File();
            $file->user_id = Auth::id();
            $file->uploaded_file = $filePath;
            $file->name = $uploadedFile->getClientOriginalName();
            $file->size = $request->input('size');
            $file->message = $request->input('message');
            $file->shared_link = Str::uuid()->toString();
            
            $file->save();
            
            return redirect()->route('show' , [
                'id' => $file->id,
            ]);
        }


        public function show($id)
        {
            $file = File::findOrFail($id);

            if(!$file)
            {
                abort(404);
            }

            $link = URL::signedRoute('downloadView', [
                'link' => $file->shared_link,
            ]);

            return view('uploads.show', [
                'file' => $file,
                'link' => $link,
            ]);
        }

        public function downloadView($link)
        {
            $files = File::orderBy('created_at' , 'DESC')->where('user_id' ,'=' ,Auth::id())->get();
            $file = File::where('shared_link', $link)->firstOrFail();

            return view('uploads.downloadView', compact('files' , 'file'));
        }

        public function download($link)
        {
            $file = File::where('shared_link', $link)->firstOrFail();
            $filePath = storage_path('app/' . $file->uploaded_file); //app/public/uploads/image
            return response()->download($filePath, $file->name);
        }

        public function destroy(File $file)
        {
            $file->delete();
            $path = $file->uploaded_file;
            if($path){
                Storage::disk(File::$disk)->delete($path);
            }
            return redirect()->route('index' , compact('file'));
        }
}
