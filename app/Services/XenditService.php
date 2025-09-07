<?php

namespace App\Services;

use Xendit\Configuration;
use Xendit\Invoice\CreateInvoiceRequest;
use Xendit\Invoice\InvoiceApi;

class XenditService
{
    protected $apiInstance;

    public function __construct()
    {
        // set API key
        Configuration::setXenditKey(env('XENDIT_SECRET_KEY'));

        // buat instance API
        $this->apiInstance = new InvoiceApi();
    }

    public function createInvoice($data)
    {
        $invoice = new CreateInvoiceRequest([
            'external_id' => 'invoice-' . time(),
            'amount' => $data['amount'],
            'payer_email' => $data['email'],
            'description' => $data['description'],
            'success_redirect_url' => $data['success_url'],
            'failure_redirect_url' => $data['failed_url'],
        ]);

        return $this->apiInstance->createInvoice($invoice);
    }
}
