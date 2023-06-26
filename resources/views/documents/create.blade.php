<x-layout>
    <div class="bg-gray-50 border border-gray-200 rounded p-10 max-w-xl mx-auto mt-24">
        <header class="text-center">
            <h2 class="text-2xl font-bold uppercase mb-3">
                Ajouter un document
            </h2>
        </header>

        <form action="/documents" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="mb-6">
                <label for="objet" class="inline-block text-lg mb-2">Objet</label>
                <input type="text" class="border border-gray-200 rounded p-2 w-full" name="objet"
                    value="{{ old('objet') }}" />

                @error('objet')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="sender" class="inline-block text-lg mb-2">Destinateur</label>
                <input type="text" class="border border-gray-200 rounded p-2 w-full" name="sender"
                    value="{{ old('sender') }}" />

                @error('sender')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="receiver" class="inline-block text-lg mb-2">Destinataire</label>
                <input type="text" class="border border-gray-200 rounded p-2 w-full" name="receiver"
                    value="{{ old('receiver') }}" />

                @error('receiver')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="date_transmission" class="inline-block text-lg mb-2">Date de transmission</label>
                <input type="date" class="border border-gray-200 rounded p-2 w-full" name="date_transmission"
                    value="{{ old('date_transmission') }}" />

                @error('date_transmission')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            @if (auth()->user()->role == 'admin')
                <div class="mb-6" id="departmentWrapper">
                    <label for="department_id">D&eacute;partement concerné</label>
                    <select name="department_id" id="department" class="border border-gray-200 rounded p-2 w-full"
                        required>
                        <option value="" selected disabled hidden>Selectionnez un d&eacute;partement</option>
                        @foreach ($departments as $department)
                            @unless ($department->name == 'blank')
                                <option value="{{ $department->id }}">{{ $department->name }}</option>
                            @endunless
                        @endforeach
                    </select>
                    @error('department_id')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>
            @endif

            <div class="mb-6">
                <label for="doc" class="inline-block text-lg mb-2">
                    Le document (PDF)
                </label>
                <input type="file" class="border border-gray-200 rounded p-2 w-full" name="doc" />

                @error('doc')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <label for="keywords" class="inline-block text-lg mb-2">
                    Mots cl&eacute;s s&eacute;par&eacute;s par des virgules
                </label>
                <textarea class="border border-gray-200 rounded p-2 w-full" name="keywords" rows="10"
                    placeholder="Exemple: Agriculture, &Eacute;nergie renouvelable, Province de K&eacute;nitra ...">{{ old('keywords') }}</textarea>

                @error('keywords')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-6">
                <button class="bg-laravel text-white rounded py-2 px-4 hover:bg-black">
                    Ajouter un document
                </button>

                <a href="/documents" class="text-black ml-4"> Retour à la liste de documents </a>
            </div>
        </form>
    </div>
</x-layout>
