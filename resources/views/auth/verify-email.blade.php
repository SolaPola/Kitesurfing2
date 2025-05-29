<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        {{ __('Thank you for signing up with KitesurfingVS! Before getting started, please check your email for an activation link. The activation email contains a link where you can complete your registration by providing your personal information and setting your password. If you didn\'t receive the email, we will gladly send you another.') }}
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ __('A new activation link has been sent to the email address you provided.') }}
        </div>
    @endif

    <div class="mt-4 flex items-center justify-between">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <div>
                <x-primary-button>
                    {{ __('Resend Activation Email') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-guest-layout>
