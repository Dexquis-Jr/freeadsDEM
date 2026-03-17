<x-app-layout>

    <x-slot name="header">

    </x-slot>
<br>

<a href="{{ url()->previous() }}" class="px-4 py-2 rounded-lg bg-gray-200 hover:bg-gray-300 transition">

    Retour

</a>

<body>
    <div class="min-h-screen flex justify-center items-center  w-full">
        <form class="w-full  space-y-8 max-w-md mx-auto p-4" action="{{ route('category.store') }}" method="POST">
            @csrf

            <h1 class=" text-center text-xl font-semibold">Créer une nouvelle categorie</h1>
            <div class="flex flex-col ">

                <input type="text" placeholder="Entrer la categorie" name="name"
                    class="px-2 py-2 w-full border-b border-gray-300 focus:border-slate-900 outline-none text-sm bg-white" />
            </div>

            <button type="submit"
                class="!mt-12 px-6 py-2 w-full bg-slate-800 hover:bg-slate-900 text-sm font-medium text-white mx-auto block cursor-pointer">Créer</button>
        </form>

    </div>
</body>

</x-app-layout>
