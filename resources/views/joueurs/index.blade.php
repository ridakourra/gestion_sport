<x-app-layout>
    <div class="container mx-auto p-8">
        <!-- Page Title -->
        <h1 class="text-3xl font-bold mb-8">Players Management</h1>

        <!-- Add New Player Button -->
        <div class="mb-6">
            <a href="{{ route('joueurs.create') }}" class="bg-purple-600 text-white px-4 py-2 rounded-md hover:bg-purple-700">
                <i class="fas fa-plus mr-2"></i>Add New Player
            </a>
        </div>

        <!-- Players Table -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <table class="min-w-full">
                <thead class="bg-purple-600 text-white">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-medium uppercase">ID</th>
                        <th class="px-6 py-3 text-left text-sm font-medium uppercase">Name</th>
                        <th class="px-6 py-3 text-left text-sm font-medium uppercase">Age</th>
                        <th class="px-6 py-3 text-left text-sm font-medium uppercase">Sport</th>
                        <th class="px-6 py-3 text-left text-sm font-medium uppercase">Team</th>
                        <th class="px-6 py-3 text-left text-sm font-medium uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <!-- Example Rows -->
                    @if(count($joueurs) === 0)
                        <tr class="hover:bg-gray-50">
                            <td colspan="6" class="p-2 text-gray-600 text-center">No joueurs found</td>
                        </tr>
                    @else
                        @foreach($joueurs as $joueur)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4">{{ $joueur->id }}</td>
                                <td class="px-6 py-4">{{ $joueur->nom }}</td>
                                <td class="px-6 py-4">{{ $joueur->age }}</td>
                                <td class="px-6 py-4">{{ $joueur->sport->nom }}</td>
                                <td class="px-6 py-4">{{ $joueur->equipe->nom }}</td>
                                <td class="px-6 py-4">
                                    <a href="{{ route('joueurs.edit', $joueur->id) }}" class="text-purple-600 hover:text-purple-900 mr-2">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form action="{{ route('joueurs.destroy', $joueur->id) }}" method="POST" class="inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:text-red-900">
                                            <i class="fas fa-trash"></i> Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>