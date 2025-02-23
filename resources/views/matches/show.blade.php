<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Détails du Match
            </h2>
            <div class="flex space-x-4">
                <a href="{{ route('matches.edit', $match) }}" 
                   class="inline-flex items-center px-4 py-2 bg-indigo-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-indigo-500">
                    <i class="fas fa-edit mr-2"></i>{{ __('Modifier') }}
                </a>
                <form action="{{ route('matches.destroy', $match) }}" method="POST" class="inline">
                    @csrf
                    @method('DELETE')
                    <button type="submit" 
                            class="inline-flex items-center px-4 py-2 bg-red-600 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-red-500"
                            onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce match?')">
                        <i class="fas fa-trash mr-2"></i>{{ __('Supprimer') }}
                    </button>
                </form>
            </div>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">
                    <!-- Match Header -->
                    <div class="text-center mb-8">
                        <div class="text-sm text-gray-500 mb-2">
                            {{ $match->sport->nom }} - {{ $match->lieu }}
                        </div>
                        <div class="text-xl font-bold mb-4">
                            {{ Carbon\Carbon::parse($match->date_matche)->format('d/m/Y H:i') }}
                        </div>
                        
                        <!-- Teams and Score -->
                        <div class="flex items-center justify-center space-x-8">
                            <div class="text-center">
                                <img src="{{ $match->equipe1->logo ? Storage::url($match->equipe1->logo) : asset('images/default-team.png') }}" 
                                     alt="{{ $match->equipe1->nom }}"
                                     class="w-20 h-20 mx-auto rounded-full object-cover mb-2">
                                <div class="font-semibold">{{ $match->equipe1->nom }}</div>
                            </div>
                            
                            <div class="flex flex-col gap-3">
                                @if($match->resultat)
                                    <div class="text-3xl font-bold">
                                        {{ $match->resultat->score_equipe1 }} - {{ $match->resultat->score_equipe2 }}
                                    </div>
                                @else
                                    <div class="px-4 py-2 rounded-full bg-yellow-100 text-yellow-800 text-sm font-semibold">
                                        Match à venir
                                    </div>
                                @endif
                                <div class="">
                                    @if($match->statut === 'completed')
                                        Terminee
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                            En cours
                                        </span>
                                    @elseif($match->statut === 'in progress')
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
                                            En cours
                                        </span>
                                    @else
                                        <span class="px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
                                            En attente
                                        </span>
                                    @endif
                                </div>
                            </div>

                            <div class="text-center">
                                <img src="{{ $match->equipe2->logo ? Storage::url($match->equipe2->logo) : asset('images/default-team.png') }}" 
                                     alt="{{ $match->equipe2->nom }}"
                                     class="w-20 h-20 mx-auto rounded-full object-cover mb-2">
                                <div class="font-semibold">{{ $match->equipe2->nom }}</div>
                            </div>
                        </div>
                    </div>

                    <!-- Match Details -->
                    <div class="mt-8 grid grid-cols-2 gap-4 text-center">
                        <div class="bg-gray-50 rounded-lg p-4">
                            <div class="text-sm text-gray-500">Sport</div>
                            <div class="font-semibold">{{ $match->sport->nom }}</div>
                        </div>
                        <div class="bg-gray-50 rounded-lg p-4">
                            <div class="text-sm text-gray-500">Lieu</div>
                            <div class="font-semibold">{{ $match->lieu }}</div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>