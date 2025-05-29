<x-guest-layout>
    <div class="mb-6 p-6 bg-green-50 border-l-4 border-green-400 rounded-md">
        <div class="flex">
            <div class="flex-shrink-0">
                <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"
                    fill="currentColor">
                    <path fill-rule="evenodd"
                        d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z"
                        clip-rule="evenodd" />
                </svg>
            </div>
            <div class="ml-3">
                <h3 class="text-sm font-medium text-green-800">Registration Email Sent Successfully</h3>
                <div class="mt-2 text-sm text-green-700">
                    <p>We've sent an activation link to <strong>{{ session('registered_email') }}</strong>.</p>
                </div>
            </div>
        </div>
    </div>

    <div class="mb-4 text-sm text-gray-600">
        <h2 class="text-lg font-semibold mb-2">What happens next?</h2>
        <ol class="list-decimal list-inside space-y-2">
            <li>Check your email inbox for a message from KitesurfingVS.</li>
            <li>Click the activation link in the email.</li>
            <li>Complete your profile by providing your personal details and creating a password.</li>
            <li>Start booking your kitesurfing adventures!</li>
        </ol>
    </div>



    <div class="flex items-center justify-center mt-6">
        <a href="{{ route('home') }}" class="text-accent hover:text-cyan-500 font-medium">
            Return to homepage
        </a>
    </div>
</x-guest-layout>
