<?php

namespace App\Http\Controllers;

use App\Http\Requests\UploadFileRequest;
use App\Mail\SendFile;
use App\Mail\SendLinkEmail;
use App\Models\File;
use App\Concerns\FileStorage;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class MailController extends Controller
{

   use FileStorage;


   public function emailForm()
   {
       return view('emails.emailForm', [
           'file' => new File(),
           'success' => session('success'),
       ]);
   }

   public function sendEmailTransfer(Request $laravelrequest,UploadFileRequest $request)
   {
       $to = $laravelrequest->input('to');

       $validated = $request->validated();

        $validated['user_id'] = Auth::id();

       $file = $this->storeFile($request);

       $downloadLink = route('downloadView', ['link' => $file->shared_link]);

       Mail::to($to)->send(new SendLinkEmail($downloadLink));
       
       return redirect()->route('index')->with('success', 'File sent to ' . $to . ' email successfully');
   }
}
