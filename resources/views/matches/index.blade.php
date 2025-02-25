<x-app-layout>
    <div class="container mx-auto max-w-7xl mt-8 px-4 sm:px-6 lg:px-8">
        <!-- Header with Create Button -->
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-semibold text-gray-800">Liste des Matches</h2>
            <a href="{{ route('matches.create') }}" 
               class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded inline-flex items-center">
                <i class="fas fa-plus mr-2"></i> Nouveau Match
            </a>
        </div>

        <!-- Search and Filters -->
        <div class="mb-6 bg-white rounded-lg shadow-sm p-4">
            <form action="{{ route('matches.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-4 gap-4">
                <!-- Date Begin Filter -->
                <div class="col-span-1 md:col-span-1 lg:col-span-2">
                    <label for="date_begin" class="block text-sm font-medium text-gray-700">Date de début</label>
                    <input type="date" name="date_begin" id="date_begin" 
                           class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" 
                           value="{{ request('date_begin') }}">
                </div>

                <!-- Date End Filter -->
                <div class="col-span-1 md:col-span-1 lg:col-span-2">
                    <label for="date_end" class="block text-sm font-medium text-gray-700">Date de fin</label>
                    <input type="date" name="date_end" id="date_end" 
                           class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50" 
                           value="{{ request('date_end') }}">
                </div>

                <!-- Status Filter -->
                <div>
                    <select name="statut" 
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <option value="">Tous les statuts</option>
                        <option value="pending" {{ request('statut') == 'pending' ? 'selected' : '' }}>En attente</option>
                        <option value="in progress" {{ request('statut') == 'in progress' ? 'selected' : '' }}>En cours</option>
                        <option value="completed" {{ request('statut') == 'completed' ? 'selected' : '' }}>Terminé</option>
                    </select>
                </div>

                <!-- Team Filter -->
                <div>
                    <select name="equipe" 
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <option value="">Toutes les équipes</option>
                        @foreach($equipes as $equipe)
                            <option value="{{ $equipe->id }}" {{ request('equipe') == $equipe->id ? 'selected' : '' }}>
                                {{ $equipe->nom }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- Sport Filter -->
                <div>
                    <select name="sport" 
                            class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                        <option value="">Tous les sports</option>
                        @foreach($sports as $sport)
                            <option value="{{ $sport->id }}" {{ request('sport') == $sport->id ? 'selected' : '' }}>
                                {{ $sport->nom }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="flex items-center space-x-4">
                    <button type="submit" 
                            class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
                        <i class="fas fa-search mr-2"></i> Filtrer
                    </button>
                    <a href="{{ route('matches.index') }}" 
                       class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded">
                        <i class="fas fa-redo mr-2"></i> Réinitialiser
                    </a>
                </div>
            </form>
        </div>

        <!-- Matches Table -->
        <div class="bg-white rounded-lg shadow-sm overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date
                            <a href="{{ route('matches.index', array_merge(request()->query(), ['sort' => 'date_matche-asc'])) }}">
                                <i class="fas fa-sort-alpha-down"></i>
                            </a>
                            <a href="{{ route('matches.index', array_merge(request()->query(), ['sort' => 'date_matche-desc'])) }}">
                                <i class="fas fa-sort-alpha-up"></i>
                            </a>
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sport
                            <a href="{{ route('matches.index', array_merge(request()->query(), ['sort' => 'sport-asc'])) }}">
                                <i class="fas fa-sort-alpha-down"></i>
                            </a>
                            <a href="{{ route('matches.index', array_merge(request()->query(), ['sort' => 'sport-desc'])) }}">
                                <i class="fas fa-sort-alpha-up"></i>
                            </a>
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Équipes</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Lieu
                            <a href="{{ route('matches.index', array_merge(request()->query(), ['sort' => 'lieu-asc'])) }}">
                                <i class="fas fa-sort-alpha-down"></i>
                            </a>
                            <a href="{{ route('matches.index', array_merge(request()->query(), ['sort' => 'lieu-desc'])) }}">
                                <i class="fas fa-sort-alpha-up"></i>
                            </a>
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Statut/Score</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($matches as $match)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ Carbon\Carbon::parse($match->date_matche)->format('d/m/Y H:i') }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-indigo-100 text-indigo-800">
                                {{ $match->sport->nom }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm font-medium text-gray-900">
                            {{ $match->equipe1->nom }} vs {{ $match->equipe2->nom }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $match->lieu }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            @if($match->statut === 'completed' && $match->resultat)
                                <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
                                    {{ $match->resultat->score_equipe1 }} - {{ $match->resultat->score_equipe2 }}
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
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium space-x-2">
                            <a href="{{ route('matches.show', $match) }}" class="text-green-600 hover:text-green-900">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('matches.edit', $match) }}" class="text-blue-600 hover:text-blue-900">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('matches.destroy', $match) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="text-red-600 hover:text-red-900"
                                        onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce match ?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                            Aucun match trouvé
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $matches->withQueryString()->links() }}
        </div>
    </div>
</x-app-layout>