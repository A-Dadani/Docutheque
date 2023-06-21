<x-layout>
    @include('partials._search', [
        'placeholderText' => 'Rechercher un message...',
    ])
    <div class="mx-4">
        <div class="bg-gray-50 border border-gray-200 p-10 rounded">
            <header>
                <h1 class="text-3xl text-center font-bold my-6 uppercase">
                    Messagerie
                </h1>
            </header>

            @unless (count($messages) == 0)
                <table class="w-full table-auto rounded-sm">
                    <tbody>
                        @foreach ($messages as $msg)
                            <tr class="border-gray-300">
                                <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                                    <a href="/messages/{{ $msg->id }}">
                                        {{ strlen($msg->objet) > 35 
                                            ? substr($msg->objet, 0, 35) . '...' 
                                            : $msg->objet }}
                                    </a>
                                </td>
                                <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                                    {{ $msg->full_name }}
                                </td>
                                <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                                    {{ $msg->created_at }}
                                </td>
                                <td class="px-4 py-8 border-t border-b border-gray-300 text-lg">
                                    <form action="/messages/{{ $msg->id }}" method="POST">
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
        {{ $messages->appends($_GET)->links() }}
    </div>
</x-layout>
