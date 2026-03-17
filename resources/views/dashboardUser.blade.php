<x-app-layout>

    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-800">
            {{ __(Auth::user()->name) }}
        </h2>
    </x-slot>

    <div class="max-w-7xl mx-auto p-6 space-y-10">

        <div class="bg-white shadow-xl rounded-2xl p-8">

            <h3 class="text-xl font-semibold mb-6">
                Créer une annonce
            </h3>

            <form action="{{ route('ads.store') }}" method="POST" enctype="multipart/form-data" class="space-y-6">

                @csrf

                <div>

                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Titre
                    </label>

                    <input type="text" name="title" placeholder="Titre"
                        class="w-full border rounded-lg p-2 focus:ring focus:ring-blue-200">

                </div>


                <div>

                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Description
                    </label>

                    <textarea name="description" rows="4" placeholder="Description"
                        class="w-full border rounded-lg p-2 focus:ring focus:ring-blue-200"></textarea>

                </div>


                <div class="grid md:grid-cols-2 gap-6">

                    <div>

                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Prix
                        </label>

                        <input type="number" name="price" placeholder="Prix"
                            class="w-full border rounded-lg p-2 focus:ring focus:ring-blue-200">

                    </div>


                    <div>

                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Localisation
                        </label>

                        <input type="text" name="location" placeholder="Localisation"
                            class="w-full border rounded-lg p-2 focus:ring focus:ring-blue-200">

                    </div>

                </div>


                <div>

                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Catégorie
                    </label>

                    <select name="category_id" class="w-full border rounded-lg p-2 focus:ring focus:ring-blue-200">

                        <option value="">Sélectionnez une catégorie</option>

                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">
                                {{ $category->name }}
                            </option>
                        @endforeach

                    </select>

                </div>


                <div>

                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Photo
                    </label>

                    <input type="file" name="photo" class="w-full border rounded-lg p-2">

                </div>


                <button class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition shadow">

                    Créer l'annonce

                </button>

            </form>

        </div>

        <div class="bg-white shadow-xl rounded-2xl p-8">

            <h3 class="text-xl font-semibold mb-6">
                Mes annonces
            </h3>

            @if (blank($ads))

                <div class="text-gray-500">
                    Vous n'avez aucune annonce disponible.
                </div>
            @else
                <div class="overflow-x-auto">
                    <h3 class="text-xl font-semibold mb-6">
                        Mes annonces
                    </h3>

                    @if (blank($ads))

                        <p class="text-gray-500">
                            Vous n'avez aucune annonce disponible.
                        </p>
                    @else
                        <div class="grid gap-6 sm:grid-cols-2 lg:grid-cols-3">

                            @foreach ($ads as $ad)
                                <div class="bg-white rounded-xl shadow hover:shadow-lg transition overflow-hidden">

                                    {{-- IMAGE --}}

                                    <div class="h-48 bg-gray-100">

                                        @if ($ad->photo)
                                            <img src="{{ asset('storage/' . $ad->photo) }}"
                                                class="w-full h-full object-cover">
                                        @else
                                            <div class="flex items-center justify-center h-full text-gray-400">
                                                Pas d'image
                                            </div>
                                        @endif

                                    </div>

                                    <div class="p-4 space-y-2">

                                        <h4 class="font-semibold text-lg">
                                            {{ $ad->title }}
                                        </h4>

                                        <p class="text-gray-600 text-sm">
                                            {{ Str::limit($ad->description, 80) }}
                                        </p>

                                        <div class="flex justify-between text-sm text-gray-500">

                                            <span>
                                                {{ $ad->category->name }}
                                            </span>

                                            <span>
                                                📍 {{ $ad->location }}
                                            </span>

                                        </div>


                                        <div class="text-blue-600 font-bold text-lg">
                                            {{ $ad->price }} FCFA
                                        </div>
                                        <div class="flex gap-2 pt-3">

                                            <a href="{{ route('ads.edit', $ad->id) }}"
                                                class="flex-1 text-center bg-green-500 text-white py-1 rounded hover:bg-green-600 text-sm">

                                                Modifier
                                            </a>

                                            <form action="{{ route('ads.destroy', $ad->id) }}" method="POST"
                                                class="flex-1">

                                                @csrf
                                                @method('DELETE')

                                                <button
                                                    class="w-full bg-red-500 text-white py-1 rounded hover:bg-red-600 text-sm">

                                                    Supprimer

                                                </button>

                                            </form>

                                        </div>

                                    </div>

                                </div>
                            @endforeach

                        </div>

                    @endif

                </div>

            @endif

        </div>

    </div>

</x-app-layout>
