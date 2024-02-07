<section>
    <header>
        <h2 class="text-lg font-medium text-gray-900">
            {{ __('Informasi Toko') }}
        </h2>

        <p class="mt-1 text-sm text-gray-600">
            {{ __("Perbarui informasi toko anda.") }}
        </p>
    </header>

    <form method="post" action="/store/update/{{ $user->store->id }}" class="mt-6 space-y-6">
        @csrf
        @method('patch')

        <div>
            <x-input-label for="store_name" :value="__('Nama Toko')" />
            <x-text-input id="store_name" name="store_name" type="text" class="mt-1 block w-full" :value="old('store_name', $user->store->store_name)" required autofocus autocomplete="store_name" />
            <x-input-error class="mt-2" :messages="$errors->get('store_name')" />
        </div>

        <div>
            <x-input-label for="address" :value="__('Alamat Toko')" />
            <x-text-input id="address" name="address" type="text" class="mt-1 block w-full" :value="old('address', $user->store->address)" required autofocus autocomplete="address" />
            <x-input-error class="mt-2" :messages="$errors->get('address')" />
        </div>

        <div>
            <x-input-label for="phone_number" :value="__('Nomor Telepon')" />
            <x-text-input id="phone_number" name="phone_number" type="tel" class="mt-1 block w-full" :value="old('phone_number', $user->store->phone_number)" required autofocus autocomplete="phone_number" />
            <x-input-error class="mt-2" :messages="$errors->get('phone_number')" />
        </div>

        <div class="flex items-center gap-4">
            <x-primary-button>{{ __('Simpan') }}</x-primary-button>

            @if (session('status') === 'store-updated')
                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-sm text-gray-600"
                >{{ __('Tersimpan.') }}</p>
            @endif
        </div>
    </form>
</section>
