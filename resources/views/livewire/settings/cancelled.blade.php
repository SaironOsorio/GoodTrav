<?php
use App\Livewire\Actions\Logout;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Volt\Component;

new class extends Component {
    public string $password = '';
    public bool $showSuccessMessage = false;
    public bool $showVerificationMessage = false;

    /**
     * Cancel the user's subscription.
     */
    public function deleteUser(): void
    {
        $this->validate([
            'password' => ['required', 'string', 'current_password'],
        ]);

        $user = Auth::user();

        if (!$user->hasVerifiedEmail()) {
            $this->addError('password', __('Debes verificar tu email antes de cancelar tu membresía.'));
            return;
        }

        // Verificar si tiene suscripción
        $subscription = $user->subscription('default');

        if (!$subscription) {
            $this->addError('password', __('No tienes una membresía activa.'));
            return;
        }

        // Verificar si ya está cancelada
        if ($subscription->canceled()) {
            $this->addError('password', __('Tu membresía ya está cancelada.'));
            return;
        }

        // Cancelar la suscripción
        if ($user->subscribed()) {
            $subscription->cancel();
            $this->showSuccessMessage = true;

            $this->dispatch('subscription-cancelled');
        }
    }
    /**
     * Resend the email verification notification.
     */
    public function resendVerificationNotification(): void
    {
        Auth::user()->sendEmailVerificationNotification();
        $this->showVerificationMessage = true;
    }

    #[On('hideVerificationMessage')]
    public function hideVerificationMessage(): void
    {
        $this->showVerificationMessage = false;
    }

    /**
     * Reset verification message after successful send.
     */
    public function resetVerificationMessage(): void
    {
        $this->showVerificationMessage = false;
    }
}; ?>

<section class="mt-10 space-y-6">
    <div class="relative mb-5">
        <flux:heading>{{ __('Cancelar Membresía') }}</flux:heading>
        <flux:subheading>{{ __('Cancele tu membresía inmediatamente.') }}</flux:subheading>
    </div>

    <flux:modal.trigger name="confirm-user-deletion">
        <flux:button variant="danger" x-data="" x-on:click.prevent="$dispatch('open-modal', 'confirm-user-deletion')" data-test="delete-user-button" class="cursor-pointer">
            {{ __('Cancelar Membresía') }}
        </flux:button>
    </flux:modal.trigger>

    <flux:modal name="confirm-user-deletion" :show="$errors->isNotEmpty()" focusable class="max-w-lg">
        <form method="POST" wire:submit="deleteUser" class="space-y-6"
              x-data
              @subscription-cancelled.window="setTimeout(() => window.location.href = '/', 2000)">
            <div>
                <flux:heading size="lg">{{ __('¿Estás seguro de que quieres cancelar tu membresía?') }}</flux:heading>

                <flux:subheading>
                    {{ __('Tu membresía se cancelará inmediatamente. Introduce tu contraseña para confirmar.') }}
                </flux:subheading>
            </div>

            @if (!Auth::user()->hasVerifiedEmail())
                <div class="p-4 bg-yellow-50 border border-yellow-200 rounded">
                    <p class="text-sm text-yellow-800">
                        {{ __('⚠️ Debes verificar tu email antes de cancelar tu membresía.') }}
                    </p>
                </div>

                <flux:button variant="danger" wire:click="resendVerificationNotification" class="cursor-pointer w-full">
                    {{ __('Enviar verificación') }}
                </flux:button>

                <!-- Mensaje de verificación enviada -->
                @if ($showVerificationMessage)
                    <div class="p-3 bg-green-50 border border-green-200 rounded animate-pulse"
                         x-data="{ show: true }"
                         x-show="show"
                         x-init="setTimeout(() => show = false, 5000)">
                        <p class="text-sm text-green-800">
                            {{ __('✓ Se ha enviado un nuevo enlace de verificación a tu correo.') }}
                        </p>
                    </div>
                @endif
            @else
                <flux:input wire:model="password" :label="__('Contraseña')" type="password" />
            @endif

            <!-- Mensaje de cancelación exitosa -->
            @if ($showSuccessMessage)
                <div class="p-3 bg-green-50 border border-green-200 rounded animate-pulse">
                    <p class="text-sm text-green-800">
                        {{ __('✓ Tu membresía ha sido cancelada exitosamente. Redirigiendo...') }}
                    </p>
                </div>
            @endif

            <div class="flex justify-end space-x-2 rtl:space-x-reverse">
                <flux:modal.close>
                    <flux:button variant="filled">{{ __('Cerrar') }}</flux:button>
                </flux:modal.close>

                <flux:button
                    variant="danger"
                    type="submit"
                    data-test="confirm-delete-user-button"
                    :disabled="!Auth::user()->hasVerifiedEmail()"
                >
                    {{ __('Cancelar Membresía') }}
                </flux:button>
            </div>
        </form>
    </flux:modal>
</section>
