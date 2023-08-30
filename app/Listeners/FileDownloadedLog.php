<?php

namespace App\Listeners;

use App\Events\FileDownloaded;
use App\Models\DownloadedFile;
use App\Models\File;
use App\Notifications\FileDownloadNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Http;

class FileDownloadedLog
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(FileDownloaded $event): void
    {

        DownloadedFile::create([
            'file_id' => $event->file->id,
            'user_agent' => $event->userAgent,
            'ip_address' => $event->ipAddress,
            'country' => $this->getCountryFromIpAddress($event->ipAddress),
        ]);

    }

    private function getCountryFromIpAddress($ipAddress)
    {

        $apiKey = '3f3bac2719fc4f6092ab23f921ff71df';

        $response = Http::get("https://api.ipgeolocation.io/ipgeo?apiKey={$apiKey}&ip={$ipAddress}");

        $data = $response->json();

        return isset($data['country_name']) ? $data['country_name'] : null;
    }
}
