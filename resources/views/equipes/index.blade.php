<x-app-layout>
    <div class="container mx-auto max-w-7xl mt-8 px-4 sm:px-6 lg:px-8">
        <!-- Header with Create Button -->
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-semibold text-gray-800">Liste des Équipes</h2>
            <a href="{{ route('equipes.create') }}" 
               class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded inline-flex items-center">
                <i class="fas fa-plus mr-2"></i> Nouvelle Équipe
            </a>
        </div>

        <!-- Search and Filters -->
        <div class="mb-6 bg-white rounded-lg shadow-sm p-4">
            <form action="{{ route('equipes.index') }}" method="GET" class="grid grid-cols-1 md:grid-cols-3 gap-4">
                <div class="relative">
                    <input type="text" 
                           name="search" 
                           value="{{ request('search') }}"
                           placeholder="Rechercher une équipe..." 
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

                <div class="flex items-center space-x-4">
                    <button type="submit" 
                            class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded">
                        <i class="fas fa-search mr-2"></i> Filtrer
                    </button>
                    <a href="{{ route('equipes.index') }}" 
                       class="bg-gray-500 hover:bg-gray-600 text-white font-bold py-2 px-4 rounded">
                        <i class="fas fa-redo mr-2"></i> Réinitialiser
                    </a>
                </div>
            </form>
        </div>

        <!-- Teams Table -->
        <div class="bg-white rounded-lg shadow-sm overflow-hidden">
            <table class="min-w-full divide-y divide-gray-200">
                <thead class="bg-gray-50">
                    <tr>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Logo</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Équipe</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Sport</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Joueurs</th>
                        <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                    </tr>
                </thead>
                <tbody class="bg-white divide-y divide-gray-200">
                    @forelse($equipes as $equipe)
                    <tr class="hover:bg-gray-50">
                        <td class="px-6 py-4 whitespace-nowrap">
                            <img class="h-10 w-10 rounded-full object-cover" 
                                 src="{{ $equipe->logo ? Storage::url($equipe->logo) : asset('images/default-team.png') }}" 
                                 alt="{{ $equipe->nom }}">
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <div class="text-sm font-medium text-gray-900">{{ $equipe->nom }}</div>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap">
                            <span class="px-2 inline-flex text-xs leading-5 font-semibold rounded-full bg-indigo-100 text-indigo-800">
                                {{ $equipe->sport->nom }}
                            </span>
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-sm text-gray-500">
                            {{ $equipe->joueurs_count }}
                        </td>
                        <td class="px-6 py-4 whitespace-nowrap text-left text-sm font-medium space-x-2">
                            <a href="{{ route('equipes.show', $equipe) }}" 
                               class="text-green-600 hover:text-green-900">
                                <i class="fas fa-eye"></i>
                            </a>
                            <a href="{{ route('equipes.edit', $equipe) }}" 
                               class="text-blue-600 hover:text-blue-900">
                                <i class="fas fa-edit"></i>
                            </a>
                            <form action="{{ route('equipes.destroy', $equipe) }}" method="POST" class="inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        onclick="return confirm('Êtes-vous sûr de vouloir supprimer cette équipe ?')"
                                        class="text-red-600 hover:text-red-900">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="px-6 py-4 text-center text-gray-500">
                            Aucune équipe trouvée
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        <!-- Pagination -->
        <div class="mt-4">
            {{ $equipes->withQueryString()->links() }}
        </div>
    </div>
</x-app-layout>