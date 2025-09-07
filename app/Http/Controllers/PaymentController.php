<?php

namespace App\Http\Controllers;

use App\Models\Wakif;
use Illuminate\Http\Request;
use App\Services\XenditService;
use Carbon\Carbon;
use Illuminate\Http\JsonResponse;

class PaymentController extends Controller
{
    protected $xendit;

    public function __construct(XenditService $xendit)
    {
        $this->xendit = $xendit;
    }

    public function createInvoice(Request $request): JsonResponse
    {
        $request->validate([
            'nominal' => 'required|numeric|min:1000',
            'email' => 'required|email',
        ]);


        try {

            $wakif = new Wakif();
            $wakif->nama = $request->nama;
            $wakif->no_hp = $request->no_hp;
            $wakif->email = $request->email;
            $wakif->nominal = $request->nominal;
            $wakif->deskripsi = $request->deskripsi;
            $wakif->hide_name = $request->hide_name;
            $wakif->save();

            $invoice = $this->xendit->createInvoice([
                'amount' => $request->nominal,
                'email' => $request->email,
                'description' => $request->deskripsi,
                'success_url' => env('FRONTEND_URL') . '/campaign/1',
                'failed_url' => env('FRONTEND_URL') . '/campaign/1',
            ]);

            $wakif->reference_id = $invoice->getId();
            $wakif->save();

            return response()->json([
                'success' => true,
                'data' => $invoice,
                'message' => 'Berhasil Membuat Pembayaran'
            ]);
        } catch (\Exception $e) {
            return response()->json([
                'success' => false,
                'message' => $e->getMessage(),
            ], 500);
        }
    }

    public function callback(Request $request)
    {
        $wakif = Wakif::where('reference_id', $request->id)->first();
        if ($wakif) {
            $wakif->status = $request->status;
            if ($request->status == 'PAID') {
                $wakif->paid_at = Carbon::parse($request->paid_at)->toDateTimeString();;
            }
            $wakif->save();
            return response()->json($wakif);
        } else {
            return response()->json('Transaction Not Found');
        }
    }
}
