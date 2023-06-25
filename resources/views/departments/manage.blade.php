<x-layout>
    @include('partials._search', [
        'placeholderText' => 'Rechercher un département...',
    ])
    <div class="mx-4">
        <div class="bg-gray-50 border border-gray-200 p-10 rounded">
            <header>
                <h1 class="text-3xl text-center font-bold my-6 uppercase">
                    Gestion de d&eacute;partements
                </h1>
                <form action="/departments" method="POST">
                    @csrf
                    <div class="relative border-2 border-gray-100 m-4 rounded-lg">
                        <div class="absolute top-4 left-3">
                            <i class="fa fa-plus text-gray-400 z-20 hover:text-gray-500"></i>
                        </div>
                        <input type="text" name="name"
                            class="h-14 w-full pl-10 pr-20 rounded-lg z-0 focus:shadow focus:outline-none"
                            placeholder="Nom du d&eacute;partement" value="{{ $_GET['search'] ?? '' }}" />
                        <div class="absolute top-2 right-2">
                            <button type="submit"
                                class="h-10 px-3 text-white rounded-lg bg-blue-500 hover:bg-blue-600">
                                Ajouter un d&eacute;partement
                            </button>
                        </div>

                        @error('name')
                            <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                        @enderror
                    </div>
                </form>
            </header>

            @unless (count($departments) == 0)
                <table class="w-full table-auto rounded-sm">
                    <tbody>
                        @foreach ($departments as $dpt)
                            @unless ($dpt->name == 'blank')
                                <tr class="border-gray-300">
                                    <td class="px-4 py-8 border-t border-b border-gray-300 text-xl text-center">
                                        <a href="/departments/{{ $dpt->id }}">
                                            {{ strlen($dpt->name) > 35 ? substr($dpt->name, 0, 35) . '...' : $dpt->name }}
                                        </a>
                                    </td>
                                    <td class="px-4 py-8 border-t border-b border-gray-300 text-xl text-center">
                                        <form action="/departments/{{ $dpt->id }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="text-red-600">
                                                <i class="fa-solid fa-trash-can mr-1"></i>
                                                Supprimer
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endunless
                        @endforeach
                    </tbody>
                </table>
            @else
            @endunless
        </div>
    </div>
    <div class="mt-6 p-4">
        {{ $departments->appends($_GET)->links() }}
    </div>
</x-layout>
