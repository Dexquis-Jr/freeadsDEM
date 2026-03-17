<section class="max-w-3xl mx-auto bg-white shadow-md rounded-xl p-6">

    <header class="mb-6">
        <h2 class="text-xl font-semibold text-gray-800">
            Informations du profil
        </h2>

        <p class="text-sm text-gray-500 mt-1">
            Modifiez les informations de votre compte.
        </p>
    </header>

    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post"
          action="{{ route('profile.update') }}"
          class="space-y-5"
          enctype="multipart/form-data">

        @csrf
        @method('patch')
        <div class="flex items-center gap-4">

            <img
                src="{{ asset('storage/'.$user->image) }}"
                class="w-16 h-16 rounded-full object-cover border">

            <div>
                <x-input-label for="image" :value="'Changer la photo'" />
                <input
                    type="file"
                    name="image"
                    class="mt-1 block w-full text-sm border border-gray-300 rounded-lg cursor-pointer bg-gray-50">
                <x-input-error class="mt-2" :messages="$errors->get('image')" />
            </div>

        </div>

        <div>
            <x-input-label for="name" :value="'Nom'" />

            <x-text-input
                id="name"
                name="name"
                type="text"
                class="mt-1 block w-full rounded-md border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                :value="old('name', $user->name)"
                required />

            <x-input-error class="mt-2" :messages="$errors->get('name')" />
        </div>


        <!-- Email -->
        <div>
            <x-input-label for="email" :value="'Email'" />

            <x-text-input
                id="email"
                name="email"
                type="email"
                class="mt-1 block w-full rounded-md border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                :value="old('email', $user->email)"
                required />

            <x-input-error class="mt-2" :messages="$errors->get('email')" />


            @if ($user instanceof \Illuminate\Contracts\Auth\MustVerifyEmail && !$user->hasVerifiedEmail())

                <p class="text-sm mt-2 text-gray-600">
                    Votre email n'est pas vérifié.

                    <button form="send-verification"
                        class="text-blue-600 hover:underline ml-1">
                        Renvoyer le mail de vérification
                    </button>
                </p>

                @if (session('status') === 'verification-link-sent')
                    <p class="text-green-600 text-sm mt-2">
                        Un nouveau lien de vérification a été envoyé.
                    </p>
                @endif

            @endif

        </div>

        <div>
            <x-input-label for="telephone" :value="'Téléphone'" />

            <x-text-input
                id="telephone"
                name="telephone"
                type="text"
                class="mt-1 block w-full rounded-md border-gray-300 focus:ring-blue-500 focus:border-blue-500"
                :value="old('telephone', $user->telephone)"
                required />

            <x-input-error class="mt-2" :messages="$errors->get('telephone')" />
        </div>

        <div class="flex items-center gap-4 pt-2">

            <button
                type="submit"
                class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-2 rounded-lg font-medium transition">
                Enregistrer
            </button>

            @if (session('status') === 'profile-updated')

                <p
                    x-data="{ show: true }"
                    x-show="show"
                    x-transition
                    x-init="setTimeout(() => show = false, 2000)"
                    class="text-green-600 text-sm">

                    Profil mis à jour

                </p>

            @endif

        </div>

    </form>

</section>
