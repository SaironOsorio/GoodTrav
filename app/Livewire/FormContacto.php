<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Mail;
use App\Mail\ContactFormMail;
use Illuminate\Support\Facades\Log;
use App\Models\Socialmedia;

class FormContacto extends Component
{
    public $name = '';
    public $email = '';
    public $telefono = '';
    public $message = '';
    public $acepta_politica = false;
    public $enviado = false;
    public $error = '';
    public $successMessage = '';

    protected $rules = [
        'name' => 'required|string|min:3|max:255',
        'email' => 'required|email|max:255',
        'telefono' => 'required|string|min:9|max:20',
        'message' => 'required|string|min:10|max:1000',
        'acepta_politica' => 'accepted',
    ];

    protected $messages = [
        'name.required' => 'El nombre es obligatorio.',
        'name.min' => 'El nombre debe tener al menos 3 caracteres.',
        'email.required' => 'El correo electrónico es obligatorio.',
        'email.email' => 'Debe ser un correo electrónico válido.',
        'telefono.required' => 'El teléfono es obligatorio.',
        'telefono.min' => 'El teléfono debe tener al menos 9 caracteres.',
        'message.required' => 'El mensaje es obligatorio.',
        'message.min' => 'El mensaje debe tener al menos 10 caracteres.',
        'acepta_politica.accepted' => 'Debes aceptar la política de privacidad.',
    ];

    public function submit()
    {
        Log::info('Intentando enviar formulario de contacto: ' . $this->email);
        

        try {
            $socialMedia = Socialmedia::first();
            $recipientEmail = $socialMedia ? $socialMedia->email : 'info@goodtrav.com';

            Log::info('Enviando formulario de contacto a: ' . $recipientEmail);
            Mail::to($recipientEmail)->send(new ContactFormMail(
                $this->name,
                $this->email,
                $this->telefono,
                $this->message
            ));
            Log::info('Formulario de contacto enviado: ' . $this->email);

            // Mostrar mensaje de éxito
            $this->successMessage = '✓ Mensaje enviado correctamente. Te responderemos pronto.';
            $this->enviado = true;

            // Limpiar campos después de 2 segundos
            $this->dispatch('form-submitted');

            // Resetear campos
            $this->reset(['name', 'email', 'telefono', 'message', 'acepta_politica']);

            // Limpiar mensaje después de 5 segundos
            $this->dispatch('clear-success-message');

        } catch (\Exception $e) {
            $this->error = 'Error al enviar el mensaje. Por favor, inténtalo de nuevo.';
            Log::error('Error al enviar el formulario de contacto: ' . $e->getMessage());
        }
    }

    public function render()
    {
        $this->dispatch('scroll-to-top');
        return view('livewire.form-contacto');
    }
}
