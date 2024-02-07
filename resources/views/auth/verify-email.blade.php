<x-guest-layout>
    <div class="mb-4 text-sm text-gray-600">
        <p>
            {{ __('Terimakash sudah mendaftar! Sebelum memulai, silakan memverifikasi alamat email anda dengan mengklik tautan yang baru saja kami kirimkan melalui email kepada anda. Jika anda tidak menerima email, silakan tekan tombol dibawah ini.') }}
        </p>
        <p class="mt-2 text-yellow-500">
            {{ __('Aplikasi ini dibuat untuk portofolio, email hanya digunakan untuk verifikasi saja.') }}
        </p>
    </div>

    @if (session('status') == 'verification-link-sent')
        <div class="mb-4 font-medium text-sm text-green-600">
            {{ __('Link verifikasi baru telah dikirim ke alamat email yang anda berikan saat pendaftaran.') }}
        </div>
    @endif

    <div class="mt-4 flex items-center justify-between">
        <form method="POST" action="{{ route('verification.send') }}">
            @csrf

            <div>
                <x-primary-button>
                    {{ __('Kirim Ulang email verifikasi') }}
                </x-primary-button>
            </div>
        </form>

        <form method="POST" action="{{ route('logout') }}">
            @csrf

            <button type="submit" class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                {{ __('Keluar') }}
            </button>
        </form>
    </div>
</x-guest-layout>
