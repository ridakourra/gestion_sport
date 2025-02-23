<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Modifier le Match') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-xl sm:rounded-lg">
                <form method="POST" action="{{ route('matches.update', $match) }}" class="p-6">
                    @csrf
                    @method('PUT')
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <!-- Sport -->
                        <div>
                            <label for="sport_id" class="block text-sm font-medium text-gray-700">Sport</label>
                            <select id="sport_id" name="sport_id" required 
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <option value="">Sélectionner un sport</option>
                                @foreach($sports as $sport)
                                    <option value="{{ $sport->id }}" {{ (old('sport_id', $match->sport_id) == $sport->id) ? 'selected' : '' }}>
                                        {{ $sport->nom }}
                                    </option>
                                @endforeach
                            </select>
                            @error('sport_id')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Date et Heure -->
                        <div>
                            <label for="date_matche" class="block text-sm font-medium text-gray-700">Date et Heure</label>
                            <input type="datetime-local" id="date_matche" name="date_matche" 
                                value="{{ old('date_matche', $match->date_matche->format('Y-m-d\TH:i')) }}" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            @error('date_matche')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Équipe 1 -->
                        <div>
                            <label for="equipe1_id" class="block text-sm font-medium text-gray-700">Équipe 1</label>
                            <select id="equipe1_id" name="equipe1_id" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <option value="">Sélectionner l'équipe 1</option>
                                @foreach($equipes as $equipe)
                                    <option value="{{ $equipe->id }}" {{ (old('equipe1_id', $match->equipe1_id) == $equipe->id) ? 'selected' : '' }}>
                                        {{ $equipe->nom }}
                                    </option>
                                @endforeach
                            </select>
                            @error('equipe1_id')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Équipe 2 -->
                        <div>
                            <label for="equipe2_id" class="block text-sm font-medium text-gray-700">Équipe 2</label>
                            <select id="equipe2_id" name="equipe2_id" required
                                    class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                <option value="">Sélectionner l'équipe 2</option>
                                @foreach($equipes as $equipe)
                                    <option value="{{ $equipe->id }}" {{ (old('equipe2_id', $match->equipe2_id) == $equipe->id) ? 'selected' : '' }}>
                                        {{ $equipe->nom }}
                                    </option>
                                @endforeach
                            </select>
                            @error('equipe2_id')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Lieu -->
                        <div>
                            <label for="lieu" class="block text-sm font-medium text-gray-700">Lieu</label>
                            <input type="text" id="lieu" name="lieu" value="{{ old('lieu', $match->lieu) }}" required
                                class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                            @error('lieu')
                                <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                            @enderror
                        </div>

                        <!-- Score -->
                        <div class="col-span-2">
                            <h3 class="text-lg font-medium text-gray-900 mb-4">Score</h3>
                            <div class="grid grid-cols-2 gap-4">
                                <div>
                                    <label for="score_equipe1" class="block text-sm font-medium text-gray-700">Score Équipe 1</label>
                                    <input type="number" id="score_equipe1" name="score_equipe1" min="0"
                                           value="{{ old('score_equipe1', optional($match->resultat)->score_equipe1) }}"
                                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                </div>
                                <div>
                                    <label for="score_equipe2" class="block text-sm font-medium text-gray-700">Score Équipe 2</label>
                                    <input type="number" id="score_equipe2" name="score_equipe2" min="0"
                                           value="{{ old('score_equipe2', optional($match->resultat)->score_equipe2) }}"
                                           class="mt-1 block w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="flex justify-end mt-6 space-x-4">
                        <a href="{{ route('matches.index') }}" 
                           class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700">
                            Annuler
                        </a>
                        <button type="submit"
                                class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-700">
                            Mettre à jour
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>