<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $sport->nom }}
            </h2>
            <div class="flex space-x-4">
                <a href="{{ route('sports.edit', $sport) }}" class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-500">
                    {{ __('Modifier') }}
                </a>
                <form action="{{ route('sports.destroy', $sport) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce sport?')">
                        {{ __('Supprimer') }}
                    </button>
                </form>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Informations du Sport -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex items-start space-x-6">
                        @if($sport->image)
                            <img src="{{ Storage::url($sport->image) }}" alt="{{ $sport->nom }}" class="w-48 h-48 object-cover rounded-lg">
                        @endif
                        <div>
                            <h3 class="text-2xl font-bold text-gray-900">{{ $sport->nom }}</h3>
                            <p class="mt-2 text-gray-600">{{ $sport->description }}</p>
                        </div>
                    </div>
                </div>
            </div>

            <!-- Top 5 Équipes (Classement) -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 bg-white border-b border-gray-200">
                    <h3 class="text-lg font-semibold mb-4">{{ __('Top 5 Équipes') }}</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Rang</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Équipe</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">Points</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase">V/N/D</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($topEquipes as $classement)
                                    <tr>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $classement->rang }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                @if($classement->equipe->logo)
                                                    <img src="{{ Storage::url($classement->equipe->logo) }}" alt="{{ $classement->equipe->nom }}" class="w-8 h-8 rounded-full mr-2">
                                                @endif
                                                {{ $classement->equipe->nom }}
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">{{ $classement->points }}</td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            {{ $classement->vics }}/{{ $classement->nuls }}/{{ $classement->los }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Équipes -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-semibold">{{ __('Équipes') }}</h3>
                            <a href="{{ route('equipes.index') }}" class="text-indigo-600 hover:text-indigo-900">{{ __('Voir tout') }}</a>
                        </div>
                        <div class="space-y-4">
                            @foreach($equipes as $equipe)
                                <div class="flex items-center space-x-4">
                                    @if($equipe->logo)
                                        <img src="{{ Storage::url($equipe->logo) }}" alt="{{ $equipe->nom }}" class="w-10 h-10 rounded-full">
                                    @endif
                                    <span>{{ $equipe->nom }}</span>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Joueurs -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-semibold">{{ __('Joueurs') }}</h3>
                            <a href="{{ route('joueurs.index') }}" class="text-indigo-600 hover:text-indigo-900">{{ __('Voir tout') }}</a>
                        </div>
                        <div class="space-y-4">
                            @foreach($joueurs as $joueur)
                                <div class="flex items-center space-x-4">
                                    @if($joueur->image)
                                        <img src="{{ Storage::url($joueur->image) }}" alt="{{ $joueur->name }}" class="w-10 h-10 rounded-full">
                                    @endif
                                    <div>
                                        <div>{{ $joueur->name }}</div>
                                        <div class="text-sm text-gray-500">{{ $joueur->equipe->nom }}</div>
                                    </div>
                                </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <!-- Matches Récents -->
            <div class="mt-6 bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-lg font-semibold">{{ __('Matches Récents') }}</h3>
                        <a href="{{ route('matches.index') }}" class="text-indigo-600 hover:text-indigo-900">{{ __('Voir tout') }}</a>
                    </div>
                    <div class="space-y-4">
                        @foreach($matches as $match)
                            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                                <div class="flex items-center space-x-4">
                                    <div class="text-sm text-gray-500">{{ $match->date_matche->format('d/m/Y H:i') }}</div>
                                    <div>{{ $match->equipe1->nom }} vs {{ $match->equipe2->nom }}</div>
                                </div>
                                <div>
                                    @if($match->resultat)
                                        <span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-sm">
                                            {{ $match->resultat->score_equipe1 }} - {{ $match->resultat->score_equipe2 }}
                                        </span>
                                    @else
                                        <span class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded-full text-sm">
                                            {{ $match->statut }}
                                        </span>
                                    @endif
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>