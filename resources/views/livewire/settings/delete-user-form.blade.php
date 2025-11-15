<?php

use App\Livewire\Actions\Logout;
use Illuminate\Support\Facades\Auth;
use Livewire\Volt\Component;

new class extends Component {
    public string $password = '';
    public bool $showSuccessMessage = false;

    /**
     * Delete the currently authenticated user.
     */
    public function deleteUser(Logout $logout): void
    {
        $this->validate([
            'password' => ['required', 'string', 'current_password'],
        ]);

        $user = Auth::user();

        if (!$user->hasVerifiedEmail()) {
            $this->addError('password', __('Debes verificar tu email antes de eliminar tu cuenta.'));
            return;
        }
        tap($user, $logout(...))->delete();

        $this->redirect('/', navigate: true);
    }

    /**
     * Resend the email verification notification.
     */
    public function resendVerificationNotification(): void
    {
        Auth::user()->sendEmailVerificationNotification();
        $this->showSuccessMessage = true;


        $this->dispatch('hideSuccessMessage');
    }

    #[On('hideSuccessMessage')]
    public function hideSuccessMessage(): void
    {
        $this->showSuccessMessage = false;
    }
}; ?>

<section class="mt-10 space-y-6">
    <div class="relative mb-5">
        <flux:heading>{{ __('Eliminar Cuenta') }}</flux:heading>
        <flux:subheading>{{ __('Elimina tu cuenta y todos tus recursos.') }}</flux:subheading>
    </div>

    <flux:modal.trigger name="confirm-user-deletion">
        <flux:button variant="danger" x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')" data-test="delete-user-button" class="cursor-pointer">
            {{ __('Eliminar Cuenta') }}
        </flux:button>
    </flux:modal.trigger>

    <flux:modal name="confirm-user-deletion" :show="$errors->isNotEmpty()" focusable class="max-w-lg">
        <form method="POST" wire:submit="deleteUser" class="space-y-6">
            <div>
                <flux:heading size="lg">{{ __('¿Estás seguro de que quieres eliminar tu cuenta?') }}</flux:heading>

                <flux:subheading>
                    {{ __('Una vez que se elimine tu cuenta, todos sus recursos y datos se eliminarán de forma permanente. Introduce tu contraseña para confirmar que deseas eliminar tu cuenta de forma permanente.') }}
                </flux:subheading>
            </div>


            @if (!Auth::user()->hasVerifiedEmail())
                <div class="p-4 bg-yellow-50 border border-yellow-200 rounded">
                    <p class="text-sm text-yellow-800">
                        {{ __('⚠️ Debes verificar tu email antes de poder eliminar tu cuenta.') }}
                    </p>
                </div>
            @endif

            @if (!Auth::user()->hasVerifiedEmail())
                <flux:button variant="danger" wire:click="resendVerificationNotification" class="cursor-pointer">
                    {{ __('Enviar verificación') }}
                </flux:button>

                <!-- Mensaje de éxito -->
                @if ($showSuccessMessage)
                    <div class="p-3 bg-green-50 border border-green-200 rounded animate-pulse">
                        <p class="text-sm text-green-800">
                            {{ __('✓ Se ha enviado un nuevo enlace de verificación a tu correo.') }}
                        </p>
                    </div>
                @endif
            @else
                <flux:input wire:model="password" :label="__('Contraseña')" type="password" />
            @endif

            <div class="flex justify-end space-x-2 rtl:space-x-reverse">
                <flux:modal.close>
                    <flux:button variant="filled">{{ __('Cancelar') }}</flux:button>
                </flux:modal.close>

                <flux:button
                    variant="danger"
                    type="submit"
                    data-test="confirm-delete-user-button"
                    :disabled="!Auth::user()->hasVerifiedEmail()"
                >
                    {{ __('Eliminar Cuenta') }}
                </flux:button>
            </div>
        </form>
    </flux:modal>
</section>
