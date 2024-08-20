<?php

namespace App\Models;

use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class QRCodeInventaris extends Model
{
    use HasFactory;

    protected $primaryKey = 'qrcode_id';
    protected $table = 'qrcode_inventaris';

    protected $fillable = [
        'file_path',
    ];

    static public function createQRCode(Inventaris $inventaris) {
        $qrCode = new QrCode(url('/inventaris-management/kondisi/' . $inventaris->inventaris_id));
        $qrCode->setSize(300);

        $pngWriter = new PngWriter();

        $result = $pngWriter->write($qrCode, null, null, [
            'compression_level' => -1,
        ]);

        $fileName = 'qr_code_inventaris_' . $inventaris->inventaris_id . '.png';
        $filePath = $fileName;

        Storage::put('/public/qrcodes/' . $filePath, $result->getString());

        return self::create([
            'file_path' => $filePath,
        ]);
    }

    // static public function downloadQrCode($filename)
    // {
    //     $filePath = 'public/' . $filename;

    //     if (!Storage::exists($filePath)) {
    //         return abort(404);
    //     }

    //     return Response::download(storage_path('app/' . $filePath));
    // }

    public function Inventaris(): HasOne {
        return $this->hasOne(Inventaris::class, 'qrcode_id');
    }
}
