<x-app-layout>

    <x-slot name="header">

        <div class="flex items-center justify-between">

            <h2 class="font-semibold text-xl text-gray-800">
                Bonjour {{ Auth::user()->name }}
            </h2>

            <!-- Barre de recherche -->
            <div class="hidden lg:flex flex-1 justify-center mx-4">
                <div class="relative flex items-center w-full max-w-md">

                    <span class="absolute left-3 text-gray-400">
                        🔍
                    </span>

                    <input type="text" placeholder="Rechercher une annonce..."
                        class="w-full py-2 pl-10 pr-4 text-sm bg-gray-100 rounded-full focus:bg-white focus:ring-2 focus:ring-blue-500 outline-none transition">

                </div>
            </div>

        </div>

    </x-slot>


    <div class="max-w-7xl mx-auto p-6">
        <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach ($ads as $ad)
                <div class="bg-white shadow-md rounded-xl overflow-hidden hover:shadow-xl transition">
                    @if ($ad->photo)
                        <img src="{{ asset('storage/' . $ad->photo) }}" class="w-full h-48 object-cover">
                    @endif
                    <div class="p-4">
                        <h2 class="text-lg font-semibold text-gray-800 mb-1">
                            {{ $ad->title }}
                        </h2>
                        <p class="text-gray-600 text-sm line-clamp-2">
                            {{ $ad->description }}
                        </p>
                        <p class="text-green-600 font-bold text-lg mt-2">
                            {{ number_format($ad->price) }} FCFA
                        </p>
                        <p class="text-sm text-gray-500 mt-1">
                            📍 {{ $ad->location }}
                        </p>
                        <p class="text-xs text-gray-400 mt-2">
                            Il y'a {{ $ad->created_at->diffForHumans() }}
                        </p>
                        <hr class="my-3">
                        <div class="flex items-center gap-3">
                            <img src="{{ asset('storage/' . $ad->user->image) }}"
                                class="w-10 h-10 rounded-full object-cover">
                            <div class="text-sm">
                                <p class="font-semibold text-gray-700">
                                    {{ $ad->user->name }}
                                </p>
                                <p class="text-gray-500">
                                    📞 {{ $ad->user->telephone }}
                                </p>
                            </div>
                        </div>
                        <a href="{{ route('ads.show', $ad->id) }}"
                            class="block mt-4 text-center bg-blue-500 hover:bg-blue-600 text-white py-2 rounded-lg text-sm font-medium transition">
                            Voir l'annonce
                        </a>

                    </div>

                </div>
            @endforeach

        </div>

    </div>


    <footer class="text-center text-gray-500 text-sm py-6">
        © {{ date('Y') }} FreeAds - Tous droits réservés
    </footer>

</x-app-layout>
