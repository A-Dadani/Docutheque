<x-layout>
    <form action="{{ url()->current() }}">
        <div class="m-4 flex">
            <div class="relative border-2 border-gray-100 rounded-lg w-full mr-2 h-14">
                <div class="absolute top-4 left-3">
                    <i class="fa fa-search text-gray-400 z-20 hover:text-gray-500"></i>
                </div>
                <input type="text" name="" id="search-field" name=""
                    class="h-14 w-full pl-10 pr-20 rounded-lg z-0 focus:shadow focus:outline-none"
                    placeholder="Chercher..." />
            </div>
            <select id="lookup-method" class="mx-2 border border-gray-200 rounded p-2 w-full" required">
                <option value="" selected disabled hidden>Selectionner un filtre</option>
                <option value="sender">D&eacute;stinateur</option>
                <option value="receiver">D&eacute;stinataire</option>
                <option value="objet">Objet</option>
                <option value="keywords">Mots cl&eacute;s</option>
                <option value="department">D&eacute;partement</option>
            </select>
            <button type="submit"
                class="border-2 border-red-500 px-3 text-white rounded-lg bg-red-500 hover:bg-red-600 ml-2">
                Rechercher
            </button>
        </div>
    </form>

    <a href="/" class="m-4 flex h-14">
        <div
            class="border-2 border-blue-500 px-3 text-white rounded-lg bg-blue-500 text-lg hover:bg-blue-600 w-full flex justify-content-center align-items-center">
            <i class="fa-solid fa-plus mr-1"></i>
            <div class="ml-1">Ajouter un document</div>
        </div>
    </a>

    <div class="mx-4">
        <div class="bg-gray-50 border border-gray-200 p-10 rounded">
            <header>
                <h1 class="text-3xl text-center font-bold my-6 uppercase">
                    Documents
                </h1>
            </header>

            @unless (count($documents) == 0)
                <table class="w-full table-auto rounded-sm">
                    <tbody>
                        <tr class="border-gray-300">
                            <td class="px-4 py-8 border-t border-b border-gray-300 text-lg font-weight-bold">
                                OBJET
                            </td>
                            <td class="px-4 py-8 border-t border-b border-gray-300 text-lg font-weight-bold text-center">
                                D&Eacute;STINATEUR
                            </td>
                            <td class="px-4 py-8 border-t border-b border-gray-300 text-lg font-weight-bold text-center">
                                D&Eacute;STINATAIRE
                            </td>
                            <td class="px-4 py-8 border-t border-b border-gray-300 text-lg font-weight-bold text-center">
                                D&Eacute;PARTEMENT
                            </td>
                            <td class="px-4 py-8 border-t border-b border-gray-300 text-lg font-weight-bold text-center">
                                DATE
                            </td>
                            @unless (!Illuminate\Support\Facades\Gate::allows('delete-documents'))
                                <td class="px-4 py-8 border-t border-b border-gray-300 text-lg font-weight-bold text-center">
                                </td>
                            @endunless
                        </tr>
                        @foreach ($documents as $docu)
                            <tr class="border-gray-300">
                                <td class="px-4 py-8 border-t border-b border-gray-300 text-md">
                                    <a href="/documents/{{ $docu->id }}">
                                        {{ strlen($docu->objet) > 36 ? substr($docu->objet, 0, 36) . '...' : $docu->objet }}
                                    </a>
                                </td>
                                <td class="px-4 py-8 border-t border-b border-gray-300 text-md text-center">
                                    {{ $docu->sender }}
                                </td>
                                <td class="px-4 py-8 border-t border-b border-gray-300 text-md text-center">
                                    {{ $docu->receiver }}
                                </td>
                                <td class="px-4 py-8 border-t border-b border-gray-300 text-md text-center">
                                    {{ $docu->department->name }}
                                </td>
                                <td class="px-4 py-8 border-t border-b border-gray-300 text-md text-center">
                                    {{ Carbon\Carbon::parse($docu->date_transmission)->format('d-m-Y') }}
                                </td>
                                @unless (!Illuminate\Support\Facades\Gate::allows('delete-documents'))
                                    <td class="px-4 py-8 border-t border-b border-gray-300 text-md text-center">
                                        <form action="/documents/{{ $docu->id }}" method="POST">
                                            @csrf
                                            @method('DELETE')
                                            <button class="text-red-600">
                                                <i class="fa-solid fa-trash-can mr-1"></i>
                                                Supprimer
                                            </button>
                                        </form>
                                    </td>
                                @endunless
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
            @endunless
        </div>
    </div>
    <div class="mt-6 p-4">
        {{ $documents->appends($_GET)->links() }}
    </div>

    <script>
        const fieldDOM = document.getElementById('search-field');
        const lookupMethodSelect = document.getElementById('lookup-method');

        lookupMethodSelect.addEventListener('change', function() {
            fieldDOM.setAttribute('name', lookupMethodSelect.value);

            const selectedOptionDOM = lookupMethodSelect.options[lookupMethodSelect.selectedIndex];
            fieldDOM.setAttribute('placeholder', 'Chercher par ' + selectedOptionDOM.innerHTML.toLowerCase() +
                '...');
        });
    </script>
</x-layout>
