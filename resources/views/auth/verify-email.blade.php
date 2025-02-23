<x-guest-layout>
        <div class="bg-white p-8 rounded-lg shadow-lg w-full max-w-md text-center">
            <p class="mb-4 text-gray-700">Thanks for signing up! Before getting started, please verify your email by clicking the link sent to you. If you didn't receive it, we can send another.</p>

            @if (session('status') == 'verification-link-sent')
                <p class="mb-4 text-green-600">A new verification link has been sent to your email.</p>
            @endif

            <form method="POST" action="{{ route('verification.send') }}" class="mb-4">
                @csrf
                <button type="submit" class="bg-purple-600 text-white px-4 py-2 rounded-md hover:bg-purple-700 focus:outline-none focus:ring-2 focus:ring-purple-500 focus:ring-opacity-50">Resend Verification Email</button>
            </form>

            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button type="submit" class="bg-gray-600 text-white px-4 py-2 rounded-md hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-gray-500 focus:ring-opacity-50">Log Out</button>
            </form>
        </div>
</x-guest-layout>