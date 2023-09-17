<?php

namespace App\Http\Controllers;

use App\Events\FileDownloaded;
use App\Http\Requests\UploadFileRequest;
use App\Mail\SendLinkEmail;
use App\Models\File;
use App\Concerns\FileStorage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;

class FilesController extends Controller
{
    use FileStorage;

    public function index()
    {
        return view('uploads.home', [
            'file' => new File(),
        ]);
    }

    public function upload(UploadFileRequest $request)
    {
        $validated = $request->validated();

        $validated['user_id'] = Auth::id();

        $file = $this->storeFile($request);
        
        return redirect()->route('show', ['id' => $file->id]);
    }

    public function show($id)
    {
        $file = File::findOrFail($id);
        if (!$file) {
            abort(404);
        }
        $link = URL::signedRoute('downloadView', ['link' => $file->shared_link]);
        return view('uploads.show', [
            'file' => $file,
            'link' => $link,
        ]);
    }

    public function downloadView($link)
    {
        $files = File::where('user_id' , '=' , Auth::id())->get();
        $file = File::where('shared_link', $link)->firstOrFail();
        return view('uploads.downloadView', compact('files', 'file'));
    }

    public function download(Request $request, $link)
    {
        $file = File::where('shared_link', $link)->firstOrFail();
        $filePath = storage_path('app/' . $file->uploaded_file);
        event(new FileDownloaded($file, $request->userAgent(), $request->ip(), 'Gaza'));
        return response()->download($filePath, $file->name);
    }

    public function destroy(File $file)
    {
        $file->delete();
        $path = $file->uploaded_file;
        if ($path) {
            Storage::disk(File::$disk)->delete($path);
        }
        return back()->with('success', 'File Deleted Successfully!');
    }

   
}
