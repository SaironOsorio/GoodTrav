<?php

namespace App\Livewire\Settings;

use Livewire\Component;
use Illuminate\Support\Facades\Auth;
use Stripe\StripeClient;
use Illuminate\Support\Facades\Log;
use Livewire\WithPagination;

class BillingFac extends Component
{
    use WithPagination;

    public $invoices = [];
    public $loading = true;
    private $stripe;

    public function mount()
    {
        $this->loadInvoices();
    }

    public function loadInvoices()
    {
        try {
            $this->loading = true;
            $user = Auth::user();

            if (!$user->stripe_id) {
                $this->loading = false;
                return;
            }

            $this->stripe = new StripeClient(config('cashier.secret'));

            $stripeInvoices = $this->stripe->invoices->all([
                'customer' => $user->stripe_id,
                'limit' => 100,
            ]);

            $this->invoices = collect($stripeInvoices->data)->map(function ($invoice) {
                return [
                    'id' => $invoice->id,
                    'number' => $invoice->number,
                    'amount' => $invoice->amount_paid / 100,
                    'currency' => strtoupper($invoice->currency),
                    'status' => $invoice->status,
                    'date' => date('d/m/Y', $invoice->created),
                    'period_start' => date('d/m/Y', $invoice->period_start),
                    'period_end' => date('d/m/Y', $invoice->period_end),
                    'pdf_url' => $invoice->invoice_pdf,
                    'hosted_url' => $invoice->hosted_invoice_url,
                    'paid' => $invoice->paid,
                ];
            })->toArray();

            $this->loading = false;

        } catch (\Exception $e) {
            Log::error('Error loading invoices: ' . $e->getMessage());
            session()->flash('billing-error', 'Error al cargar las facturas: ' . $e->getMessage());
            $this->loading = false;
        }
    }

    public function downloadInvoice($invoiceId)
    {
        try {
            $invoice = collect($this->invoices)->firstWhere('id', $invoiceId);

            if (!$invoice || !$invoice['pdf_url']) {
                session()->flash('billing-error', 'No se pudo encontrar la factura.');
                return;
            }

            // Enviar evento con la URL del PDF
            $this->dispatch('download-invoice', url: $invoice['pdf_url']);

        } catch (\Exception $e) {
            Log::error('Error downloading invoice: ' . $e->getMessage());
            session()->flash('billing-error', 'Error al descargar la factura.');
        }
    }

    public function viewInvoice($invoiceId)
    {
        try {
            $invoice = collect($this->invoices)->firstWhere('id', $invoiceId);

            if (!$invoice || !$invoice['hosted_url']) {
                session()->flash('billing-error', 'No se pudo encontrar la factura.');
                return;
            }

            // Enviar evento con la URL de la factura
            $this->dispatch('open-invoice', url: $invoice['hosted_url']);

        } catch (\Exception $e) {
            Log::error('Error viewing invoice: ' . $e->getMessage());
            session()->flash('billing-error', 'Error al ver la factura.');
        }
    }

    public function render()
    {
        return view('livewire.settings.billing-fac');
    }
}
