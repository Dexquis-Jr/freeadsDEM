<x-app-layout>

    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-800">
            Détails de l'annonce
        </h2>
    </x-slot>

    <div class="max-w-6xl mx-auto p-6">

        <div class="grid md:grid-cols-2 gap-8 bg-white shadow-xl rounded-2xl p-8">

            <div>

                @if ($ad->photo)
                    <img src="{{ asset('storage/' . $ad->photo) }}" class="w-full h-96 object-cover rounded-lg">
                @else
                    <div class="h-96 bg-gray-100 flex items-center justify-center text-gray-400 rounded">
                        Pas d'image
                    </div>
                @endif

            </div>


            <div class="space-y-4">

                <h1 class="text-3xl font-bold text-gray-800">
                    {{ $ad->title }}
                </h1>

                <p class="text-2xl font-semibold text-blue-600">
                    {{ number_format($ad->price, 0, ',', ' ') }} FCFA
                </p>

                <div class="text-gray-600">
                    📍 {{ $ad->location }}
                </div>

                <div class="text-gray-600">
                    🏷 Catégorie : {{ $ad->category->name }}
                </div>

                <hr>

                <div>
                    <h3 class="font-semibold text-lg mb-2">
                        Description
                    </h3>

                    <p class="text-gray-700">
                        {{ $ad->description }}
                    </p>
                </div>

                <hr>
                <div class="flex items-center gap-4">

                    <img src="{{ asset('storage/' . $ad->user->image) }}" class="w-12 h-12 rounded-full object-cover">

                    <div>

                        <p class="font-semibold">
                            {{ $ad->user->name }}
                        </p>

                        <p class="text-gray-500 text-sm">
                            📞 {{ $ad->user->telephone }}
                        </p>

                    </div>

                </div>
                @if (Auth::user()->role === 'admin')


                <div class="flex gap-4 pt-4">

                    <a href="{{ route('ads.edit', $ad->id) }}"
                        class="px-4 py-2 bg-green-500 text-white rounded hover:bg-green-600">

                        Modifier

                    </a>

                    <form action="{{ route('ads.destroy', $ad->id) }}" method="POST">

                        @csrf
                        @method('DELETE')

                        <button class="px-4 py-2 bg-red-500 text-white rounded hover:bg-red-600">
                            Supprimer
                        </button>
                    </form>

                </div>

                @endif

            </div>

        </div>

    </div>

</x-app-layout>
