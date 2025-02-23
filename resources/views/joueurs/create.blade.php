<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Nouveau Joueur') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <form method="POST" action="{{ route('joueurs.store') }}" enctype="multipart/form-data" class="p-6">
                    @csrf
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Nom -->
                        <div>
                            <label for="name" class="block text-sm font-medium text-gray-700">
                                {{ __('Nom') }}
                            </label>
                            <input type="text" 
                                   id="name" 
                                   name="name" 
                                   value="{{ old('name') }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" 
                                   required>
                            @error('name')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Date de naissance -->
                        <div>
                            <label for="birthday" class="block text-sm font-medium text-gray-700">
                                {{ __('Date de naissance') }}
                            </label>
                            <input type="date" 
                                   id="birthday" 
                                   name="birthday" 
                                   value="{{ old('birthday') }}"
                                   class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" 
                                   required>
                            @error('birthday')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Sport -->
                        <div>
                            <label for="sport_id" class="block text-sm font-medium text-gray-700">
                                {{ __('Sport') }}
                            </label>
                            <select id="sport_id" 
                                    name="sport_id" 
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                    required>
                                <option value="">Sélectionner un sport</option>
                                @foreach($sports as $sport)
                                    <option value="{{ $sport->id }}" {{ old('sport_id') == $sport->id ? 'selected' : '' }}>
                                        {{ $sport->nom }}
                                    </option>
                                @endforeach
                            </select>
                            @error('sport_id')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Équipe -->
                        <div>
                            <label for="equipe_id" class="block text-sm font-medium text-gray-700">
                                {{ __('Équipe') }}
                            </label>
                            <select id="equipe_id" 
                                    name="equipe_id" 
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50"
                                    required>
                                <option value="">Sélectionner une équipe</option>
                                @foreach($equipes as $equipe)
                                    <option value="{{ $equipe->id }}" {{ old('equipe_id') == $equipe->id ? 'selected' : '' }}>
                                        {{ $equipe->nom }}
                                    </option>
                                @endforeach
                            </select>
                            @error('equipe_id')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Photo -->
                        <div class="col-span-full">
                            <label for="image" class="block text-sm font-medium text-gray-700">
                                {{ __('Photo') }}
                            </label>
                            <div class="mt-2 flex items-center gap-4">
                                <img id="preview" class="hidden w-32 h-32 object-cover rounded-lg" />
                                <input type="file" 
                                       id="image" 
                                       name="image" 
                                       accept="image/*"
                                       class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-violet-50 file:text-violet-700 hover:file:bg-violet-100"
                                       onchange="previewImage(event)">
                            </div>
                            @error('image')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div class="flex items-center justify-end mt-6 gap-4">
                        <a href="{{ route('joueurs.index') }}" 
                           class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                            {{ __('Annuler') }}
                        </a>
                        <button type="submit" 
                                class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700">
                            {{ __('Créer') }}
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        function previewImage(event) {
            const preview = document.getElementById('preview');
            const file = event.target.files[0];
            const reader = new FileReader();

            reader.onload = function(e) {
                preview.src = e.target.result;
                preview.classList.remove('hidden');
            }

            if (file) {
                reader.readAsDataURL(file);
            }
        }
    </script>
</x-app-layout>