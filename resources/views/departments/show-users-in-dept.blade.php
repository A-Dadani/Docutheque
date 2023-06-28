<x-layout>
    @include('partials._search', [
        'placeholderText' => 'Rechercher un message...',
        'name' => 'search',
    ])
    <div class="mx-4">
        <div class="bg-gray-50 border border-gray-200 p-10 rounded">
            <header>
                <h1 class="text-3xl text-center font-bold my-6 uppercase">
                    Gestion du d&eacute;partement {{ $department->name }}
                </h1>
            </header>

            <table class="w-full table-auto rounded-sm">
                <tbody>
                    <tr class="border-gray-300">
                        <td class="px-1 py-1 border-b border-gray-300 text-xl font-weight-bold">
                            Chefs du d&eacute;partement
                        </td>
                        <td class="px-1 py-1 border-b border-gray-300 text-xl font-weight-bold"></td>
                        <td class="px-1 py-1 border-b border-gray-300 text-xl font-weight-bold"></td>
                    </tr>
                    @unless (count($chefsDep) == 0)
                        @foreach ($chefsDep as $chef)
                            <tr class="border-gray-300">
                                <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                                    {{ strlen($chef->name) > 35 ? substr($chef->name, 0, 35) . '...' : $chef->name }}
                                </td>
                                <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                                    {{ $chef->email }}
                                </td>
                                <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                                    <form action="/users/{{ $chef->id }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="text-red-600">
                                            <i class="fa-solid fa-trash-can mr-1"></i>
                                            Supprimer
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <div class="text-center text-md">
                            <i class="fa-solid fa-circle-info mr-1"></i>
                            <span>Il n&apos;y a aucun chef pour ce d&eacute;partement</span>
                        </div>
                    @endunless

                    <tr class="border-gray-300">
                        <td class="px-1 pb-1 pt-2 border-b border-gray-300 text-xl font-weight-bold">
                            Employ&eacute;s du d&eacute;partement
                        </td>
                        <td class="px-1 pb-1 pt-2 border-b border-gray-300 text-xl font-weight-bold"></td>
                        <td class="px-1 pb-1 pt-2 border-b border-gray-300 text-xl font-weight-bold"></td>
                    </tr>
                    @unless (count($employeesDep) == 0)
                        @foreach ($employeesDep as $employee)
                            <tr class="border-gray-300">
                                <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                                    {{ strlen($employee->name) > 35 ? substr($employee->name, 0, 35) . '...' : $employee->name }}
                                </td>
                                <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                                    {{ $employee->email }}
                                </td>
                                <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                                    <form action="/users/{{ $employee->id }}" method="POST">
                                        @csrf
                                        @method('DELETE')
                                        <button class="text-red-600">
                                            <i class="fa-solid fa-trash-can mr-1"></i>
                                            Supprimer
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <div class="text-center text-md">
                    <i class="fa-solid fa-circle-info mr-1"></i>
                    <span>Il n&apos;y a aucun chef pour ce d&eacute;partement</span>
                </div>
            @endunless

            </tbody>
            </table>
        </div>
    </div>
</x-layout>
