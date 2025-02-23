<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Modifier l\'Équipe') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <form method="POST" action="{{ route('equipes.update', $equipe) }}" class="space-y-6" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <!-- Nom de l'équipe -->
                        <div>
                            <label for="nom" class="block font-medium text-sm text-gray-700">{{ __('Nom de l\'équipe') }}</label>
                            <input id="nom" 
                                   class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" 
                                   type="text" 
                                   name="nom" 
                                   value="{{ old('nom', $equipe->nom) }}" 
                                   required 
                                   autofocus />
                            @error('nom')
                                <span class="text-sm text-red-600 mt-2">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Sport -->
                        <div>
                            <label for="sport_id" class="block font-medium text-sm text-gray-700">{{ __('Sport') }}</label>
                            <select id="sport_id" 
                                    name="sport_id" 
                                    class="block mt-1 w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                @foreach($sports as $sport)
                                    <option value="{{ $sport->id }}" {{ old('sport_id', $equipe->sport_id) == $sport->id ? 'selected' : '' }}>
                                        {{ $sport->nom }}
                                    </option>
                                @endforeach
                            </select>
                            @error('sport_id')
                                <span class="text-sm text-red-600 mt-2">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Logo -->
                        <div>
                            <label for="logo" class="block font-medium text-sm text-gray-700">{{ __('Logo de l\'équipe') }}</label>
                            <div class="mt-2">
                                @if($equipe->logo)
                                    <div class="mb-3">
                                        <img src="{{ Storage::url($equipe->logo) }}" 
                                             alt="{{ $equipe->nom }}" 
                                             class="w-32 h-32 object-cover rounded">
                                    </div>
                                @endif
                                <input type="file" 
                                       id="logo" 
                                       name="logo" 
                                       accept="image/*" 
                                       class="block w-full text-sm text-gray-500 file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-violet-50 file:text-violet-700 hover:file:bg-violet-100"/>
                            </div>
                            @error('logo')
                                <span class="text-sm text-red-600 mt-2">{{ $message }}</span>
                            @enderror
                        </div>

                        <!-- Buttons -->
                        <div class="flex items-center justify-end mt-4">
                            <a href="{{ route('equipes.index') }}" 
                               class="mr-3 inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                                {{ __('Annuler') }}
                            </a>
                            <button type="submit" 
                                    class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700">
                                {{ __('Mettre à jour') }}
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>