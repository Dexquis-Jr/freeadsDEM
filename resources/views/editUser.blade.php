<x-app-layout>

    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-800">
            Modifier utilisateur
        </h2>
    </x-slot>

    <div class="max-w-4xl mx-auto p-6">

        <div class="bg-white shadow-xl rounded-2xl p-8">

            <form method="POST" action="{{ route('users.update', $user->id) }}" enctype="multipart/form-data"
                class="space-y-6">

                @csrf
                @method('PATCH')


                <div class="flex items-center gap-6">

                    @if ($user->image)
                        <img src="{{ asset('storage/' . $user->image) }}"
                            class="w-16 h-16 rounded-full object-cover border">
                    @endif

                    <div class="flex-1">

                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Photo de profil
                        </label>

                        <input type="file" name="image"
                            class="w-full border rounded-lg p-2 @error('image') border-red-500 @enderror">

                        @error('image')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror

                    </div>

                </div>


                <div class="grid md:grid-cols-2 gap-6">

                    <div>

                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Nom
                        </label>

                        <input type="text" name="name" value="{{ old('name', $user->name) }}"
                            class="w-full border rounded-lg p-2 focus:ring focus:ring-blue-200 @error('name') border-red-500 @enderror">

                        @error('name')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror

                    </div>

                    <div>

                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Email
                        </label>

                        <input type="email" name="email" value="{{ old('email', $user->email) }}"
                            class="w-full border rounded-lg p-2 focus:ring focus:ring-blue-200 @error('email') border-red-500 @enderror">

                        @error('email')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror

                    </div>

                </div>



                <div class="grid md:grid-cols-2 gap-6">

                    <div>

                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Téléphone
                        </label>

                        <input type="text" name="telephone" value="{{ old('telephone', $user->telephone) }}"
                            class="w-full border rounded-lg p-2 focus:ring focus:ring-blue-200 @error('telephone') border-red-500 @enderror">

                        @error('telephone')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror

                    </div>


                    <div>

                        <label class="block text-sm font-medium text-gray-700 mb-2">
                            Rôle
                        </label>

                        <select name="role"
                            class="w-full border rounded-lg p-2 focus:ring focus:ring-blue-200 @error('role') border-red-500 @enderror">

                            <option value="user" {{ old('role', $user->role) == 'user' ? 'selected' : '' }}>
                                User
                            </option>

                            <option value="admin" {{ old('role', $user->role) == 'admin' ? 'selected' : '' }}>
                                Admin
                            </option>

                        </select>

                        @error('role')
                            <p class="text-red-500 text-sm mt-1">{{ $message }}</p>
                        @enderror

                    </div>

                </div>

                <div class="flex justify-between items-center pt-4 border-t">

                    <a href="{{ url()->previous() }}"
                        class="px-4 py-2 rounded-lg bg-gray-200 hover:bg-gray-300 transition">

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
