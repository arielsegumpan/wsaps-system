<?php

use Illuminate\Support\Facades\Password;
use Livewire\Attributes\Layout;
use Livewire\Volt\Component;

new #[Layout('layouts.guest')] class extends Component
{
    public string $email = '';

    /**
     * Send a password reset link to the provided email address.
     */
    public function sendPasswordResetLink(): void
    {
        $this->validate([
            'email' => ['required', 'string', 'email'],
        ]);

        // We will send the password reset link to this user. Once we have attempted
        // to send the link, we will examine the response then see the message we
        // need to show to the user. Finally, we'll send out a proper response.
        $status = Password::sendResetLink(
            $this->only('email')
        );

        if ($status != Password::RESET_LINK_SENT) {
            $this->addError('email', __($status));

            return;
        }

        $this->reset('email');

        session()->flash('status', __($status));
    }
}; ?>

<div>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="bg-white border border-gray-200 shadow-sm mt-7 rounded-xl dark:bg-neutral-900 dark:border-neutral-700">
        <div class="p-4 sm:p-7">
          <div class="text-center">
            <h1 class="block text-2xl font-bold text-gray-800 dark:text-white">{{ __('Forgot your password?') }}</h1>
            <p class="mt-2 text-sm text-gray-600 dark:text-neutral-400">
                {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
            </p>

            <p class="mt-2 text-sm text-gray-600 dark:text-neutral-400">
              {{ __('Remember your password?')}}
              <a class="font-medium text-red-600 decoration-2 hover:underline focus:outline-none focus:underline dark:text-red-500" href="{{ route('login') }}">
                {{ __('Sign in here')}}
              </a>
            </p>

          </div>

          <div class="mt-5">
            <!-- Form -->
            <form wire:submit="sendPasswordResetLink">
              <div class="grid gap-y-4">
                <!-- Form Group -->
                <div>
                  <x-input-label for="email" :value="__('Email Address')" />
                  <div class="relative">

                    <x-text-input wire:model="email" id="email" class="block w-full mt-1" type="email" name="email" required autofocus />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />

                    <div class="absolute inset-y-0 hidden pointer-events-none end-0 pe-3">
                      <svg class="text-red-500 size-5" width="16" height="16" fill="currentColor" viewBox="0 0 16 16" aria-hidden="true">
                        <path d="M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zM8 4a.905.905 0 0 0-.9.995l.35 3.507a.552.552 0 0 0 1.1 0l.35-3.507A.905.905 0 0 0 8 4zm.002 6a1 1 0 1 0 0 2 1 1 0 0 0 0-2z"/>
                      </svg>
                    </div>
                  </div>
                  <p class="hidden mt-2 text-xs text-red-600" id="email-error">Please include a valid email address so we can get back to you</p>
                </div>
                <!-- End Form Group -->

                <x-primary-button class="inline-flex items-center justify-center w-full px-4 py-3 text-sm font-medium text-white bg-red-600 border border-transparent rounded-lg gap-x-2 hover:bg-red-700 focus:outline-none focus:bg-red-700 disabled:opacity-50 disabled:pointer-events-none">
                    {{ __('Email Password Reset Link') }}
                </x-primary-button>

              </div>
            </form>
            <!-- End Form -->
          </div>
        </div>
    </div>
</div>
