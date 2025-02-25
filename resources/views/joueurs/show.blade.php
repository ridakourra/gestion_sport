<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $joueur->name }}
            </h2>
            <div class="flex space-x-4">
                <a href="{{ route('joueurs.edit', $joueur) }}" 
                   class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-500">
                    <i class="fas fa-edit mr-2"></i>{{ __('Modifier') }}
                </a>
                <form action="{{ route('joueurs.destroy', $joueur) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500"
                            onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce joueur?')">
                        <i class="fas fa-trash mr-2"></i>{{ __('Supprimer') }}
                    </button>
                </form>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Informations du Joueur -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex items-start space-x-6">
                        <div class="flex-shrink-0">
                            <img class="w-32 h-32 object-cover rounded-lg" 
                                 src="{{ $joueur->image ? Storage::url($joueur->image) : asset('images/default-player.png') }}" 
                                 alt="{{ $joueur->name }}">
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold text-gray-900">{{ $joueur->name }}</h3>
                            <div class="mt-2 space-y-2">
                                <p class="text-gray-600">
                                    <span class="font-semibold">Date de naissance:</span> 
                                    {{ \Carbon\Carbon::parse($joueur->birthday)->format('d/m/Y') }}
                                    ({{ \Carbon\Carbon::parse($joueur->birthday)->age }} ans)
                                </p>
                                <p class="text-gray-600">
                                    <span class="font-semibold">Sport:</span>
                                    <span class="px-2 py-1 text-sm font-semibold rounded-full bg-indigo-100 text-indigo-800">
                                        {{ $joueur->sport->nom }}
                                    </span>
                                </p>
                                <p class="text-gray-600">
                                    <span class="font-semibold">Équipe:</span>
                                    <a href="{{ route('equipes.show', $joueur->equipe) }}" 
                                       class="text-indigo-600 hover:text-indigo-900">
                                        {{ $joueur->equipe->nom }}
                                    </a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Statistiques -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <h3 class="text-lg font-semibold mb-4">{{ __('Statistiques') }}</h3>
                        <div class="grid grid-cols-2 gap-4">
                            <div class="bg-gray-50 rounded-lg p-4 text-center">
                                <div class="text-2xl font-bold text-indigo-600">
                                    {{ $joueur->matches_count ?? 0 }}
                                </div>
                                <div class="text-sm text-gray-500">Matches joués</div>
                            </div>
                            <div class="bg-gray-50 rounded-lg p-4 text-center">
                                <div class="text-2xl font-bold text-indigo-600">
                                    {{ $joueur->buts_count ?? 0 }}
                                </div>
                                <div class="text-sm text-gray-500">Buts marqués</div>
                            </div>
                        </div>
                    </div>
                </div>

                <!-- Derniers Matches -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <h3 class="text-lg font-semibold mb-4">{{ __('Derniers Matches') }}</h3>
                        <div class="space-y-4">
                            @forelse($derniers_matches as $match)
                            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                                <div class="flex items-center space-x-4">
                                    <div class="text-sm text-gray-500">
                                        {{ $match->date_matche->format('d/m/Y H:i') }}
                                    </div>
                                    <div>
                                        {{ $match->equipe1->nom }} vs {{ $match->equipe2->nom }}
                                    </div>
                                </div>
                                <div>
                                    @if($match->resultat)
                                        @if($match->statut === 'completed')
                                            <span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-sm">
                                                {{ $match->resultat->score_equipe1 }} - {{ $match->resultat->score_equipe2 }}
                                            </span>
                                        @else
                                            <span class="px-2 py-1 bg-yellow-100 text-yellow-800 rounded-full text-sm">
                                                {{ $match->statut === 'pending' ? 'En attente' : 'En cours'  }}
                                            </span>
                                        @endif
                                    @endif
                                </div>
                            </div>
                            @empty
                            <p class="text-gray-500 text-center">Aucun match récent</p>
                            @endforelse
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>