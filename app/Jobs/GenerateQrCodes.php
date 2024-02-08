<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Carbon\Carbon;
use Storage;
use App\Models\QrCode as QrModel;
use SimpleSoftwareIO\QrCode\Facades\QrCode;


class GenerateQrCodes implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        //
        $timestamp = Carbon::now()->timestamp;
            $dataToEncode = url("scanqr") . '/' . $timestamp;

            // Generate QR code image in memory
            $qrCodeImage = QrCode::format('png')->size(500)->errorCorrection('H')->generate($dataToEncode);

            // Move the generated QR code image to a storage directory
            $fileName = $timestamp . '_' . uniqid() . '.png'; // Unique file name
            $storagePath = 'uploads/QRcode/' . $fileName;

            Storage::disk('public')->put($storagePath, $qrCodeImage);

            // Optionally, you can also save relevant information to your database
            $res = QrModel::create([
                'encoded_data' => $dataToEncode,
                'path' => $storagePath,
            ]);
    }
}
