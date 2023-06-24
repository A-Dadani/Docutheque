<x-layout>
    @include('partials._search', [
        'placeholderText' => 'Rechercher une demande...',
    ])

    <div class="mx-4">
        <div class="bg-gray-50 border border-gray-200 p-10 rounded">
            <header>
                <h1 class="text-3xl text-center font-bold my-6 uppercase">
                    Demandes d&apos;inscription
                </h1>
            </header>

            @unless (count($requests) == 0)
                <table class="w-full table-auto rounded-sm">
                    <tbody>
                        @foreach ($requests as $req)
                            <tr class="border-gray-300">
                                <td class="px-4 py-8 border-t border-b border-gray-300 text-md">
                                    {{ strlen($req->name) > 35 ? substr($req->name, 0, 35) . '...' : $req->name }}
                                </td>
                                <td class="px-4 py-8 border-t border-b border-gray-300 text-md">
                                    {{ $req->email }}
                                </td>
                                <td class="px-4 py-8 border-t border-b border-gray-300 text-md">
                                    <?php
                                        switch ($req->role) {
                                            case 'RespoCommunication':
                                                echo 'Responsable de communication';
                                                break;
                                            case 'admin':
                                                echo 'Administrateur';
                                                break;
                                            case 'chefDep':
                                                echo 'Chef de d&eacute;partement';
                                                break;
                                            case 'employeDep':
                                                echo 'Employ&eacute;';
                                                break;
                                            default:
                                                echo 'Autre';
                                                break;
                                        }
                                    ?>
                                </td>
                                <td class="px-4 py-8 border-t border-b border-gray-300 text-md">
                                    {{ ($req->department->name != 'blank')
                                            ? $req->department->name
                                            : '' }}
                                </td>
                                <td class="px-4 py-8 border-t border-b border-gray-300 text-md">
                                    <form action="/users/requests/{{ $req->id }}" method="POST">
                                        @csrf
                                        @method('PATCH')
                                        <button class="text-blue-600">
                                            <i class="fa-solid fa-user-check mr-1"></i>
                                            Approuver
                                        </button>
                                    </form>
                                </td>
                                <td class="px-4 py-8 border-t border-b border-gray-300 text-md">
                                    <form action="/users/requests/{{ $req->id }}" method="POST">
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
            @endunless
        </div>
    </div>
    <div class="mt-6 p-4">
        {{ $requests->appends($_GET)->links() }}
    </div>
</x-layout>
