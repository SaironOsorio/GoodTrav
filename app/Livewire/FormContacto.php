<?php

namespace App\Livewire;

use Livewire\Component;
use Illuminate\Support\Facades\Mail;

class FormContacto extends Component
{
    public $name = '';
    public $email = '';
    public $telefono = '';
    public $message = '';
    public $acepta_politica = false;
    public $enviado = false;
    public $error = '';

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
        $this->validate();

        try {
            // Aquí puedes agregar la lógica para enviar el email
            // Mail::to('info@goodtrav.com')->send(new ContactFormMail($this->name, $this->email, $this->telefono, $this->message));
            
            // O guardar en base de datos si tienes una tabla de contactos
            
            $this->enviado = true;
            $this->reset(['name', 'email', 'telefono', 'message', 'acepta_politica']);
            
            session()->flash('success', 'Mensaje enviado correctamente. Te responderemos pronto.');
        } catch (\Exception $e) {
            $this->error = 'Error al enviar el mensaje. Por favor, inténtalo de nuevo.';
        }
    }

    public function render()
    {
        $this->dispatch('scroll-to-top');

        return view('livewire.form-contacto');
    }
}
