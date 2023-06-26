<x-layout>
    <div class="mx-4">
        <div class="bg-gray-50 border border-gray-200 p-10 rounded max-w-lg mx-auto mt-24 mb-24">
            <header class="text-center">
                <h2 class="text-2xl font-bold uppercase mb-1">
                    Cr&eacute;er un compte
                </h2>
                <p class="mb-4">Votre demande sera tranf&eacute;r&eacute;e &agrave; un administrateur</p>
            </header>

            <form action="/users" method="POST">
                @csrf
                <div class="mb-6">
                    <label for="name" class="inline-block text-lg mb-2">
                        Nom et pr&eacute;nom
                    </label>
                    <input type="text" class="border border-gray-200 rounded p-2 w-full" name="name" value="{{ old('name') }}" />
                    @error('name')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="email" class="inline-block text-lg mb-2">Email</label>
                    <input type="email" class="border border-gray-200 rounded p-2 w-full" name="email" value="{{ old('email') }}" />
                    @error('email')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="password" class="inline-block text-lg mb-2">
                        Mot de passe
                    </label>
                    <input type="password" class="border border-gray-200 rounded p-2 w-full" name="password" />
                    @error('password')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="password_confirmation" class="inline-block text-lg mb-2">
                        Confirmer le mot de passe
                    </label>
                    <input type="password" class="border border-gray-200 rounded p-2 w-full"
                        name="password_confirmation" />
                    @error('password_confirmation')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6">
                    <label for="role">Selectionnez un r&ocirc;le:</label>
                    <select name="role" id="role" class="border border-gray-200 rounded p-2 w-full" required">
                        <option value="" selected disabled hidden>Selectionnez un r&ocirc;le</option>
                        <option value="RespoCommunication">Responsable de communication</option>
                        <option value="admin">Administrateur</option>
                        <option value="chefDep">Chef de d&eacute;partement</option>
                        <option value="employeDep">Employ&eacute;</option>
                    </select>
                    @error('role')
                        <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                    @enderror
                </div>

                <div class="mb-6" id="departmentWrapper" style="display: none;">
                    <label for="department_id">Selectionnez un d&eacute;partement:</label>
                    <select name="department_id" id="department" class="border border-gray-200 rounded p-2 w-full"
                        required">
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

                <div class="mb-6">
                    <button type="submit" class="bg-laravel text-white rounded py-2 px-4 hover:bg-black">
                        Créer une demande
                    </button>
                </div>

                <div class="mt-8">
                    <p>
                        Vous avez d&eacute;j&agrave; un compte?
                        <a href="/login" class="text-laravel">Se connecter</a>
                    </p>
                </div>
            </form>
        </div>
    </div>
    <script>
        const roleSelect = document.getElementById('role');
        const departmentWrapper = document.getElementById('departmentWrapper');
        const departmentSelect = document.getElementById('department');

        roleSelect.addEventListener('change', function() {
            const selectedRole = roleSelect.value;

            if (selectedRole === 'RespoCommunication' || selectedRole === 'admin') {
                departmentSelect.setAttribute("disabled", "disabled");
                departmentWrapper.style.display = 'none';
            } else {
                console.log('hello');
                departmentSelect.removeAttribute("disabled");
                departmentWrapper.style.display = 'block';
            }
        });
    </script>
</x-layout>
