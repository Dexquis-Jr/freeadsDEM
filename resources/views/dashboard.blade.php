<x-app-layout>

    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-800">
             {{ __(Auth::user()->name) }}
        </h2>
    </x-slot><br>
    <hr><br>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-10">

        <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
            <p class="text-gray-500 text-sm">Utilisateurs</p>
            <h2 class="text-3xl font-bold text-blue-600">
                {{ $totalUsers }}
            </h2>
        </div>

        <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
            <p class="text-gray-500 text-sm">Annonces</p>
            <h2 class="text-3xl font-bold text-green-600">
                {{ $totalAds }}
            </h2>
        </div>

        <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
            <p class="text-gray-500 text-sm">Catégories</p>
            <h2 class="text-3xl font-bold text-purple-600">
                {{ $totalCategories }}
            </h2>
        </div>

        <div class="bg-white p-6 rounded-xl shadow hover:shadow-lg transition">
            <p class="text-gray-500 text-sm">Annonces aujourd'hui</p>
            <h2 class="text-3xl font-bold text-red-500">
                {{ $adsToday }}
            </h2>
        </div>

    </div>

    <div class="max-w-7xl mx-auto p-6 space-y-10">

        <div class="bg-white rounded-xl shadow-md p-6">

            <h3 class="text-lg font-semibold mb-6 text-gray-700">
                Liste des utilisateurs
            </h3>

            <div class="overflow-x-auto">

                <table class="min-w-full divide-y divide-gray-200">

                    <thead class="bg-gray-100">

                        <tr class="text-gray-700 text-sm uppercase tracking-wider">

                            <th class="px-4 py-3 text-center">Image</th>
                            <th class="px-4 py-3 text-center">Nom</th>
                            <th class="px-4 py-3 text-center">Email</th>
                            <th class="px-4 py-3 text-center">Téléphone</th>
                            <th class="px-4 py-3 text-center">Role</th>
                            <th class="px-4 py-3 text-center">Actions</th>

                        </tr>

                    </thead>

                    <tbody class="divide-y divide-gray-100">

                        @foreach ($users as $user)
                            <tr class="hover:bg-gray-50 text-center">

                                <td class="py-3">
                                    <img src="{{ asset('storage/' . $user->image) }}"
                                        class="w-10 h-10 rounded-full mx-auto object-cover">
                                </td>

                                <td class="font-medium text-gray-800">{{ $user->name }}</td>

                                <td class="text-gray-600">{{ $user->email }}</td>

                                <td>{{ $user->telephone }}</td>

                                <td>
                                    <span
                                        class="px-3 py-1 rounded-full text-xs font-semibold
{{ $user->role == 'admin' ? 'bg-purple-100 text-purple-700' : 'bg-blue-100 text-blue-700' }}">
                                        {{ $user->role }}
                                    </span>
                                </td>

                                <td class="space-x-2">

                                    <a href="{{ route('users.edit', $user->id) }}"
                                        class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-lg text-sm">
                                        Modifier
                                    </a> |

                                    <form action="{{ route('users.destroy', $user->id) }}" method="POST"
                                        class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button
                                            class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg text-sm">
                                            Supprimer
                                        </button>
                                    </form> |

                                    <a href="{{ route('users.show', $user->id) }}"
                                        class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded-lg text-sm">
                                        Détail
                                    </a>

                                </td>

                            </tr>
                        @endforeach

                    </tbody>

                </table>

            </div>

        </div>

        <div class="bg-white rounded-xl shadow-md p-6">

            <h3 class="text-lg font-semibold mb-6 text-gray-700">
                Liste des annonces
            </h3>

            @if ($ads->isEmpty())

                <p class="text-gray-500">Aucune annonce disponible</p>
            @else
                <div class="overflow-x-auto">

                    <table class="min-w-full divide-y divide-gray-200">

                        <thead class="bg-gray-100">

                            <tr class="text-gray-700 text-sm uppercase tracking-wider text-center">

                                <th class="px-4 py-3">Image</th>
                                <th class="px-4 py-3">Titre</th>
                                <th class="px-4 py-3">Description</th>
                                <th class="px-4 py-3">Catégorie</th>
                                <th class="px-4 py-3">Auteur</th>
                                <th class="px-4 py-3">Localisation</th>
                                <th class="px-4 py-3">Actions</th>

                            </tr>

                        </thead>

                        <tbody class="divide-y divide-gray-100">

                            @foreach ($ads as $ad)
                                <tr class="hover:bg-gray-50 text-center">

                                    <td class="py-3">
                                        <img src="{{ asset('storage/' . $ad->photo) }}"
                                            class="w-10 h-10 rounded object-cover mx-auto">
                                    </td>

                                    <td class="font-medium">{{ $ad->title }}</td>

                                    <td class="text-gray-600">{{ Str::limit($ad->description, 50) }}</td>

                                    <td>
                                        <span class="bg-green-100 text-green-700 text-xs px-3 py-1 rounded-full">
                                            {{ $ad->category->name }}
                                        </span>
                                    </td>

                                    <td>{{ $ad->user->name }}</td>

                                    <td class="text-gray-600">{{ $ad->location }}</td>

                                    <td class="space-x-2">

                                        <a href="{{ route('ads.edit', $ad->id) }}"
                                            class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-lg text-sm">
                                            Modifier
                                        </a> |

                                        <form action="{{ route('ads.destroy', $ad->id) }}" method="POST"
                                            class="inline">
                                            @csrf
                                            @method('DELETE')
                                            <button
                                                class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg text-sm">
                                                Supprimer
                                            </button>
                                        </form>

                                        <a href="{{ route('ads.show', $ad->id) }}"
                                            class="bg-green-500 hover:bg-green-600 text-white px-3 py-1 rounded-lg text-sm">
                                            Détail
                                        </a>

                                    </td>

                                </tr>
                            @endforeach

                        </tbody>

                    </table>

                </div>

            @endif

        </div>

        <div class="bg-white rounded-xl shadow-md p-6">

            <div class="flex justify-between items-center mb-6">

                <h3 class="text-lg font-semibold text-gray-700">
                    Liste des catégories
                </h3>

                <a href="{{ route('category.create') }}"
                    class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 py-2 rounded-lg shadow">
                    Ajouter une catégorie
                </a>

            </div>

            <div class="overflow-x-auto">

                <table class="min-w-full divide-y divide-gray-200">

                    <thead class="bg-gray-100">

                        <tr class="text-gray-700 text-sm uppercase tracking-wider text-center">

                            <th class="px-4 py-3">Nom</th>
                            <th class="px-4 py-3">Actions</th>

                        </tr>

                    </thead>

                    <tbody class="divide-y divide-gray-100">

                        @foreach ($categories as $category)
                            <tr class="hover:bg-gray-50 text-center">

                                <td class="py-3 font-medium text-gray-800">
                                    {{ $category->name }}
                                </td>

                                <td class="space-x-2">

                                    <a href="{{ route('category.edit', $category->id) }}"
                                        class="bg-blue-500 hover:bg-blue-600 text-white px-3 py-1 rounded-lg text-sm">
                                        Modifier
                                    </a>

                                    <form action="{{ route('category.destroy', $category->id) }}" method="POST"
                                        class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button
                                            class="bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded-lg text-sm">
                                            Supprimer
                                        </button>
                                    </form>

                                </td>

                            </tr>
                        @endforeach

                    </tbody>

                </table>

            </div>

        </div>

    </div>

</x-app-layout>
