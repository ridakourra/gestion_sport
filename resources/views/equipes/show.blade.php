<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ $equipe->nom }}
            </h2>
            <div class="flex space-x-4">
                <a href="{{ route('equipes.edit', $equipe) }}" 
                   class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-500">
                    <i class="fas fa-edit mr-2"></i>{{ __('Modifier') }}
                </a>
                <form action="{{ route('equipes.destroy', $equipe) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500"
                            onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette équipe?')">
                        <i class="fas fa-trash mr-2"></i>{{ __('Supprimer') }}
                    </button>
                </form>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Informations de l'Équipe -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6 bg-white border-b border-gray-200">
                    <div class="flex items-start space-x-6">
                        <div class="flex-shrink-0">
                            <img class="w-32 h-32 object-cover rounded-lg" 
                                 src="{{ $equipe->logo ? Storage::url($equipe->logo) : asset('images/default-team.png') }}" 
                                 alt="{{ $equipe->nom }}">
                        </div>
                        <div>
                            <h3 class="text-2xl font-bold text-gray-900">{{ $equipe->nom }}</h3>
                            <div class="mt-2">
                                <span class="px-2 py-1 text-sm font-semibold rounded-full bg-indigo-100 text-indigo-800">
                                    {{ $equipe->sport->nom }}
                                </span>
                            </div>
                            @if($classement)
                            <div class="mt-4 grid grid-cols-4 gap-4 text-center">
                                <div class="bg-gray-50 rounded-lg p-3">
                                    <div class="text-xl font-bold text-indigo-600">{{ $classement->rang }}</div>
                                    <div class="text-sm text-gray-500">Rang</div>
                                </div>
                                <div class="bg-gray-50 rounded-lg p-3">
                                    <div class="text-xl font-bold text-indigo-600">{{ $classement->points }}</div>
                                    <div class="text-sm text-gray-500">Points</div>
                                </div>
                                <div class="bg-gray-50 rounded-lg p-3">
                                    <div class="text-xl font-bold text-indigo-600">{{ $classement->vics }}</div>
                                    <div class="text-sm text-gray-500">Victoires</div>
                                </div>
                                <div class="bg-gray-50 rounded-lg p-3">
                                    <div class="text-xl font-bold text-indigo-600">{{ $classement->los }}</div>
                                    <div class="text-sm text-gray-500">Défaites</div>
                                </div>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Joueurs -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-semibold">{{ __('Joueurs') }}</h3>
                            <a href="{{ route('joueurs.index', ['equipe' => $equipe->id]) }}" 
                               class="text-indigo-600 hover:text-indigo-900">{{ __('Voir tout') }}</a>
                        </div>
                        <div class="space-y-4">
                            @foreach($joueurs as $joueur)
                            <div class="flex items-center space-x-4 p-3 hover:bg-gray-50 rounded-lg">
                                <img class="w-10 h-10 rounded-full object-cover" 
                                     src="{{ $joueur->image ? Storage::url($joueur->image) : asset('images/default-player.png') }}" 
                                     alt="{{ $joueur->name }}">
                                <div>
                                    <div class="font-medium text-gray-900">{{ $joueur->name }}</div>
                                    <div class="text-sm text-gray-500">{{ $joueur->birthday }}</div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>

                <!-- Matches Récents -->
                <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 bg-white border-b border-gray-200">
                        <div class="flex justify-between items-center mb-4">
                            <h3 class="text-lg font-semibold">{{ __('Matches Récents') }}</h3>
                            <a href="{{ route('matches.index', ['equipe' => $equipe->id]) }}" 
                               class="text-indigo-600 hover:text-indigo-900">{{ __('Voir tout') }}</a>
                        </div>
                        <div class="space-y-4">
                            @foreach($matches as $match)
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
                                        <span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-sm">
                                            {{ $match->resultat->score_equipe1 }} - {{ $match->resultat->score_equipe2 }}
                                        </span>
                                        <span class="px-2 py-1 bg-green-100 text-green-800 rounded-full text-sm">
                                            {{ $match->statut }}
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
    </div>
</x-app-layout>