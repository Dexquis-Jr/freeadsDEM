<x-app-layout>

    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-800">
            Modifier l'annonce
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto p-6">

        <div class="bg-white shadow-xl rounded-2xl p-8">

            <form method="POST" action="{{ route('ads.update', $ad->id) }}" enctype="multipart/form-data"
                class="space-y-6">

                @csrf
                @method('PATCH')

                {{-- PHOTO --}}

                <div class="flex items-center gap-6">

                    @if ($ad->photo)
                        <img src="{{ asset('storage/' . $ad->photo) }}" class="w-20 h-20 rounded-lg object-cover border">
                    @endif

                    <div class="flex-1">

                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Photo
                        </label>

                        <input type="file" name="photo"
                            class="w-full border rounded-lg p-2 @error('photo') border-red-500 @enderror">

                        @error('photo')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror

                    </div>

                </div>

                <div>

                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Titre
                    </label>

                    <input type="text" name="title" value="{{ old('title', $ad->title) }}"
                        class="w-full border rounded-lg p-2 focus:ring focus:ring-blue-200 @error('title') border-red-500 @enderror">

                    @error('title')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror

                </div>
                <div>

                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Description
                    </label>

                    <textarea name="description" rows="4"
                        class="w-full border rounded-lg p-2 focus:ring focus:ring-blue-200 @error('description') border-red-500 @enderror">{{ old('description', $ad->description) }}</textarea>

                    @error('description')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror

                </div>

                <div class="grid md:grid-cols-2 gap-6">

                    <div>

                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Prix
                        </label>

                        <input type="number" name="price" value="{{ old('price', $ad->price) }}"
                            class="w-full border rounded-lg p-2 focus:ring focus:ring-blue-200 @error('price') border-red-500 @enderror">

                        @error('price')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror

                    </div>


                    <div>

                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Localisation
                        </label>

                        <input type="text" name="location" value="{{ old('location', $ad->location) }}"
                            class="w-full border rounded-lg p-2 focus:ring focus:ring-blue-200 @error('location') border-red-500 @enderror">

                        @error('location')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror

                    </div>

                </div>

                <div>

                    <label class="block text-sm font-medium text-gray-700 mb-2">
                        Catégorie
                    </label>

                    <select name="category_id"
                        class="w-full border rounded-lg p-2 focus:ring focus:ring-blue-200 @error('category_id') border-red-500 @enderror">

                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}"
                                {{ old('category_id', $ad->category_id) == $category->id ? 'selected' : '' }}>

                                {{ $category->name }}

                            </option>
                        @endforeach

                    </select>

                    @error('category_id')
                        <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                    @enderror

                </div>

                <div class="flex justify-between items-center pt-4 border-t">

                    <a href="{{ url()->previous() }}"
                        class="px-4 py-2 bg-gray-200 rounded-lg hover:bg-gray-300 transition">

                        Retour

                    </a>

                    <button type="submit"
                        class="px-6 py-2 bg-blue-600 text-white rounded-lg hover:bg-blue-700 transition shadow">

                        Mettre à jour

                    </button>

                </div>

            </form>

        </div>

    </div>

</x-app-layout>
