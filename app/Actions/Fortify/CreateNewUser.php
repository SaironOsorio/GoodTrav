<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\CreatesNewUsers;

class CreateNewUser implements CreatesNewUsers
{
    use PasswordValidationRules;

    public $terms = false;
    public $audio = false;
    public $autor = false;

    /**
     * Validate and create a newly registered user.
     *
     * @param  array<string, string>  $input
     */
    public function create(array $input): User
    {
        Validator::make($input, [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', Rule::unique(User::class)],
            'password' => $this->passwordRules(),
            'student_name' => ['required', 'string', 'max:255'],
            'date_of_birth' => ['required', 'date', 'before:today'],
            'nationality' => ['required', 'integer', 'exists:countries,id'],
            'country_code' => ['required', 'string', 'max:10'],
            'phone' => ['required', 'string', 'regex:/^\+?[0-9]{7,20}$/'],
            'terms' => ['required', 'accepted'],
            'audio' => ['required', 'accepted'],
            'autor' => ['required', 'accepted'],
        ],
        [
            'name.required' => 'El nombre es obligatorio.',
            'name.string' => 'El nombre debe ser una cadena de texto.',
            'name.max' => 'El nombre no puede tener más de 255 caracteres.',
            'terms.required' => 'Debes aceptar los términos y condiciones.',
            'terms.accepted' => 'Debes aceptar los términos y condiciones.',
            'autor.required' => 'Debes aceptar la autorización.',
            'autor.accepted' => 'Debes aceptar la autorización.',
            'audio.required' => 'Debes aceptar el uso de audio.',
            'audio.accepted' => 'Debes aceptar el uso de audio.',
            'student_name.required' => 'El nombre del estudiante es obligatorio.',
            'student_name.string' => 'El nombre del estudiante debe ser una cadena de texto.',
            'student_name.max' => 'El nombre del estudiante no puede tener más de 255 caracteres.',
            'date_of_birth.required' => 'La fecha de nacimiento es obligatoria.',
            'date_of_birth.date' => 'La fecha de nacimiento debe ser una fecha válida.',
            'date_of_birth.before' => 'La fecha de nacimiento debe ser anterior a hoy.',
            'nationality.required' => 'La nacionalidad es obligatoria.',
            'nationality.integer' => 'La nacionalidad debe ser un número entero.',
            'nationality.exists' => 'La nacionalidad seleccionada no es válida.',
            'country_code.required' => 'El código de país es obligatorio.',
            'country_code.string' => 'El código de país debe ser una cadena de texto.',
            'country_code.max' => 'El código de país no puede tener más de 10 caracteres.',
            'phone.required' => 'El número de teléfono es obligatorio.',
            'phone.string' => 'El número de teléfono debe ser una cadena de texto.',
            'phone.max' => 'El número de teléfono no puede tener más de 20 caracteres.',
            'phone.regex' => 'El número de teléfono debe tener un formato válido.',
            'address.string' => 'La dirección debe ser una cadena de texto.',
            'address.max' => 'La dirección no puede tener más de 255 caracteres.',
            'email.required' => 'El correo electrónico es obligatorio.',
            'email.string' => 'El correo electrónico debe ser una cadena de texto.',
            'email.email' => 'El correo electrónico debe ser una dirección válida.',
            'email.max' => 'El correo electrónico no puede tener más de 255 caracteres.',
            'email.unique' => 'El correo electrónico ya está registrado.',
            'password.required' => 'La contraseña es obligatoria.',
        ])->validate();

        return User::create([
            'name' => $input['name'],
            'email' => $input['email'],
            'password' => $input['password'],
            'country_id' => $input['nationality'],
            'country_code' => $input['country_code'],
            'phone' => $input['phone'],
            'date_of_birth' => $input['date_of_birth'],
            'address' => $input['address'],
            'student_name' => $input['student_name'],
            'terms' => $input['terms'],
            'audio' => $input['audio'],
            'autor' => $input['autor'],
        ]);
    }
}
