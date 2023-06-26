<x-layout>
    <div class="mx-4">
        <div class="bg-gray-50 border border-gray-200 p-10 rounded">
            <div class="flex flex-col items-center justify-center text-center">
                <div>
                    <h3 class="text-3xl font-bold mb-4">
                        {{ $message->objet }}
                    </h3>
                    <div class="text-lg space-y-6">
                        <p>
                            {{ $message->message }}
                        </p>
                    </div>
                </div>
            </div>
            <div class="border border-gray-200 w-full mb-6 mt-6"></div>
            <div>
                <div>
                    <span class="font-weight-bold text-lg">Nom et Pr&eacute;nom: </span><span
                        class="text-lg">{{ $message->full_name }}</span>
                </div>
                <div>
                    <span class="font-weight-bold text-lg">Email: </span> <span
                        class="text-lg">{{ $message->email }}</span>
                </div>
                <div>
                    <span class="font-weight-bold text-lg">Date et heure d&apos;envoi: </span><span
                        class="text-lg">{{ Carbon\Carbon::parse($message->created_at)->format('d-m-Y H:i') }}</span>
                </div>
                <a href="mailto:{{ $message->email }}"
                    class="h-12 my-3 border-2 border-gray-800 px-3 text-white rounded-lg bg-gray-800 text-lg hover:bg-gray-900 w-full flex justify-content-center align-items-center">
                    <i class="fa-solid fa-envelope mr-2"></i>
                    R&eacute;pondre par mail
                </a>
                <form action="/messages/{{ $message->id }}" method="POST">
                    @csrf
                    @method('DELETE')
                    <button type="submit"
                        class="h-12 my-3 border-2 border-red-500 px-3 text-white rounded-lg bg-red-500 text-lg hover:bg-red-600 w-full flex justify-content-center align-items-center">
                        <i class="fa-solid fa-trash-can mr-2"></i>
                        Supprimer
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-layout>
