<x-app-layout>

    <x-slot name="header">
        <h2 class="text-2xl font-bold text-gray-800">
            Détails de l'utilisateur
        </h2>
    </x-slot>

    <div class="max-w-6xl mx-auto p-6 space-y-8">

        <div class="bg-white shadow rounded-xl p-6">

            <div class="flex flex-col md:flex-row items-center md:items-start gap-6">

                <img src="{{ asset('storage/' . $user->image) }}" class="w-28 h-28 rounded-full object-cover border">

                <div class="space-y-2 text-center md:text-left">

                    <h3 class="text-xl font-semibold text-gray-800">
                        {{ $user->name }}
                    </h3>

                    <p class="text-gray-500">
                        {{ $user->email }}
                    </p>

                    <p class="text-gray-500">
                        📞 {{ $user->telephone }}
                    </p>

                    <span
                        class="inline-block px-3 py-1 text-sm rounded-full
{{ $user->role == 'admin' ? 'bg-purple-100 text-purple-700' : 'bg-blue-100 text-blue-700' }}">
                        {{ $user->role }}
                    </span>

                </div>

            </div>

        </div>


        <div class="grid grid-cols-1 md:grid-cols-3 gap-6">

            <div class="bg-white p-6 rounded-xl shadow">

                <p class="text-gray-500 text-sm">
                    Total annonces
                </p>

                <h3 class="text-3xl font-bold text-blue-600">
                    {{ $user->ads->count() }}
                </h3>

            </div>

            <div class="bg-white p-6 rounded-xl shadow">

                <p class="text-gray-500 text-sm">
                    Date d'inscription
                </p>

                <h3 class="text-xl font-semibold text-gray-700">
                    {{ $user->created_at->format('d M Y') }}
                </h3>

            </div>

            <div class="bg-white p-6 rounded-xl shadow">

                <p class="text-gray-500 text-sm">
                    Role
                </p>

                <h3 class="text-xl font-semibold text-gray-700">
                    {{ ucfirst($user->role) }}
                </h3>

            </div>

        </div>


        <div class="bg-white rounded-xl shadow p-6">

            <h3 class="text-lg font-semibold text-gray-700 mb-6">
                Annonces publiées
            </h3>

            @if ($user->ads->isEmpty())

                <p class="text-gray-500">
                    Aucune annonce publiée
                </p>
            @else
                <div class="overflow-x-auto">

                    <table class="min-w-full divide-y divide-gray-200">

                        <thead class="bg-gray-100">

                            <tr class="text-sm uppercase text-gray-600 text-center">

                                <th class="py-3 px-4">Image</th>
                                <th class="py-3 px-4">Titre</th>
                                <th class="py-3 px-4">Catégorie</th>
                                <th class="py-3 px-4">Prix</th>
                                <th class="py-3 px-4">Localisation</th>

                            </tr>

                        </thead>

                        <tbody class="divide-y divide-gray-100">

                            @foreach ($user->ads as $ad)
                                <tr class="hover:bg-gray-50 text-center">

                                    <td class="py-3">
                                        <img src="{{ asset('storage/' . $ad->photo) }}"
                                            class="w-10 h-10 object-cover rounded mx-auto">
                                    </td>

                                    <td class="font-medium">
                                        {{ $ad->title }}
                                    </td>

                                    <td>
                                        {{ $ad->category->name }}
                                    </td>

                                    <td class="text-green-600 font-semibold">
                                        {{ $ad->price }} FCFA
                                    </td>

                                    <td class="text-gray-600">
                                        {{ $ad->location }}
                                    </td>

                                </tr>
                            @endforeach

                        </tbody>

                    </table>

                </div>

            @endif

        </div>

    </div>

</x-app-layout>
