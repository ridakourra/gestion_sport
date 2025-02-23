<!-- filepath: /c:/Users/Rida/3D Objects/Projects/Laravel/Gestion de Sport/gestion_project/resources/views/sports/show.blade.php -->
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

            <!-- Classement -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg mb-6">
                <div class="p-6">
                    <h3 class="text-xl font-bold mb-4">Classement</h3>
                    <div class="overflow-x-auto">
                        <table class="min-w-full divide-y divide-gray-200">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Position</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Équipe</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Points</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">V</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">N</th>
                                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">D</th>
                                </tr>
                            </thead>
                            <tbody class="bg-white divide-y divide-gray-200">
                                @foreach($classements as $key => $classement)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-6 py-4 whitespace-nowrap text-sm">
                                            <span class="font-semibold">{{ $key + 1 }}</span>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap">
                                            <div class="flex items-center">
                                                @if($classement->equipe->logo)
                                                    <img src="{{ Storage::url($classement->equipe->logo) }}" alt="{{ $classement->equipe->nom }}" class="w-8 h-8 rounded-full mr-3">
                                                @endif
                                                <span class="text-sm font-medium text-gray-900">{{ $classement->equipe->nom }}</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm font-semibold">
                                            {{ $classement->points }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $classement->vics }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $classement->nuls }}
                                        </td>
                                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                                            {{ $classement->los }}
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>

            <!-- Matches Récents -->
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6">
                    <div class="flex justify-between items-center mb-4">
                        <h3 class="text-xl font-bold">{{ __('Matches Récents') }}</h3>
                        <a href="{{ route('matches.index') }}" class="text-indigo-600 hover:text-indigo-900">{{ __('Voir tout') }}</a>
                    </div>
                    <div class="space-y-4">
                        @foreach($matches as $match)
                            <div class="flex items-center justify-between p-4 bg-gray-50 rounded-lg">
                                <div class="flex items-center space-x-4">
                                    <div class="text-sm text-gray-500">{{ $match->date_matche->format('d/m/Y H:i') }}</div>
                                    <div class="flex items-center space-x-3">
                                        <span class="font-medium">{{ $match->equipe1->nom }}</span>
                                        @if($match->resultat)
                                            <span class="px-3 py-1 bg-gray-100 rounded-lg font-semibold">
                                                {{ $match->resultat->score_equipe1 }} - {{ $match->resultat->score_equipe2 }}
                                            </span>
                                        @endif
                                        <span class="font-medium">{{ $match->equipe2->nom }}</span>
                                    </div>
                                </div>
                                <span class="px-3 py-1 text-sm rounded-full {{ 
                                    $match->statut === 'completed' ? 'bg-green-100 text-green-800' : 
                                    ($match->statut === 'in_progress' ? 'bg-blue-100 text-blue-800' : 'bg-yellow-100 text-yellow-800') 
                                }}">
                                    {{ $match->statut === 'completed' ? 'Terminé' : 
                                       ($match->statut === 'in_progress' ? 'En cours' : 'À venir') }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>