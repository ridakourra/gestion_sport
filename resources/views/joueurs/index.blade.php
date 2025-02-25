<x-app-layout>
    <div class="container mx-auto max-w-7xl mt-8 px-4 sm:px-6 lg:px-8">
        <!-- Header with Create Button -->
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-semibold text-gray-800">Liste des Joueurs</h2>
            <a href="{{ route('joueurs.create') }}" 
               class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded inline-flex items-center">
                <i class="fas fa-plus mr-2"></i> Nouveau Joueur
            </a>
        </div>

        <!-- Search and Filters -->
        <div class="mb-6 bg-white rounded-lg shadow-sm p-4">
            <form action="{{ route('joueurs.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-4 gap-4">
                <div class="relative">
                    <input type="text" 
                           name="search" 
                           value="{{ request('search') }}"
                           placeholder="Rechercher un joueur..." 
                           class="w-full rounded-md border-gray-300 shadow-sm focus:border-indigo-300 focus:ring focus:ring-indigo-200 focus:ring-opacity-50">
                </div>

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

                <div class="flex items-center space-x-4">
                    <button type="submit" 
                            class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
                        <i class="fas fa-search mr-2"></i> Filtrer
                    </button>
                    <a href="{{ route('joueurs.index') }}" 
                       class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded">
                        <i class="fas fa-redo mr-2"></i> Réinitialiser
                    </a>
                </div>
            </form>
        </div>

        <!-- Players Table -->
        <div class="bg-white rounded-lg shadow-sm overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Photo</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Nom
                            <a href="{{ route('joueurs.index', array_merge(request()->query(), ['sort' => 'name-asc'])) }}">
                                <i class="fas fa-sort-alpha-up"></i>
                            </a>
                            <a href="{{ route('joueurs.index', array_merge(request()->query(), ['sort' => 'name-desc'])) }}">
                                <i class="fas fa-sort-alpha-up"></i>
                            </a>
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date de naissance
                            <a href="{{ route('joueurs.index', array_merge(request()->query(), ['sort' => 'birthday-asc'])) }}">
                                <i class="fas fa-sort-alpha-up"></i>
                            </a>
                            <a href="{{ route('joueurs.index', array_merge(request()->query(), ['sort' => 'birthday-desc'])) }}">
                                <i class="fas fa-sort-alpha-up"></i>
                            </a>
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sport
                            <a href="{{ route('joueurs.index', array_merge(request()->query(), ['sort' => 'sport-asc'])) }}">
                                <i class="fas fa-sort-alpha-up"></i>
                            </a>
                            <a href="{{ route('joueurs.index', array_merge(request()->query(), ['sort' => 'sport-desc'])) }}">
                                <i class="fas fa-sort-alpha-up"></i>
                            </a>
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Équipe
                            <a href="{{ route('joueurs.index', array_merge(request()->query(), ['sort' => 'equipe-asc'])) }}">
                                <i class="fas fa-sort-alpha-up"></i>
                            </a>
                            <a href="{{ route('joueurs.index', array_merge(request()->query(), ['sort' => 'equipe-desc'])) }}">
                                <i class="fas fa-sort-alpha-up"></i>
                            </a>
                        </th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($joueurs as $joueur)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <img class="h-10 w-10 rounded-full object-cover" 
                                 src="{{ $joueur->image ? Storage::url($joueur->image) : asset('images/default-player.png') }}" 
                                 alt="{{ $joueur->name }}">
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">{{ $joueur->name }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-500">{{ $joueur->birthday }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-indigo-100 text-indigo-800">
                                {{ $joueur->sport->nom }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm text-gray-500">{{ $joueur->equipe->nom }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-right text-sm font-medium">
                            <a href="{{ route('joueurs.show', $joueur) }}" class="text-green-600 hover:text-green-900 mr-3">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('joueurs.edit', $joueur) }}" class="text-blue-600 hover:text-blue-900 mr-3">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('joueurs.destroy', $joueur) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        class="text-red-600 hover:text-red-900"
                                        onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce joueur ?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                            Aucun joueur trouvé
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $joueurs->withQueryString()->links() }}
        </div>
    </div>
</x-app-layout>