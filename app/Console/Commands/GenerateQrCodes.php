<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\admin\QrCodeController;
class GenerateQrCodes extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:generate-qr-codes';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $qrController = QrCodeController::generate_qr();
        $this->info('qr create successfully');
       
    }
}