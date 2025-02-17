<x-app-layout>
    <div class="container mx-auto p-8">
        <!-- Page Title -->
        <h1 class="text-3xl font-bold mb-8">Classement Management</h1>

        <div class="flex space-x-4 mb-6">
            <!-- All Classements Link -->
            <a href="{{ route('classements.index') }}" class="bg-purple-600 text-white px-4 py-2 rounded-md hover:bg-purple-700">
                All Classements
            </a>
        
            <!-- Football Link -->
            <a href="{{ route('classements.index', ['sport' => 'football']) }}" class="bg-blue-600 text-white px-4 py-2 rounded-md hover:bg-blue-700">
                Football
            </a>
        
            <!-- Basketball Link -->
            <a href="{{ route('classements.index', ['sport' => 'basketball']) }}" class="bg-green-600 text-white px-4 py-2 rounded-md hover:bg-green-700">
                Basketball
            </a>
        </div>

        <!-- Classement Table -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <table class="min-w-full">
                <thead class="bg-purple-600 text-white">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-medium uppercase">ID</th>
                        <th class="px-6 py-3 text-left text-sm font-medium uppercase">Sport</th>
                        <th class="px-6 py-3 text-left text-sm font-medium uppercase">Team</th>
                        <th class="px-6 py-3 text-left text-sm font-medium uppercase">Points</th>
                        <th class="px-6 py-3 text-left text-sm font-medium uppercase">Rank</th>
                        <th class="px-6 py-3 text-left text-sm font-medium uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <!-- Example Rows -->
                    @if(count($classements) === 0)
                        <tr class="hover:bg-gray-50">
                            <td colspan="6" class="p-2 text-gray-600 text-center">No classement found</td>
                        </tr>
                    @else
                        @foreach($classements as $classement)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4">{{ $classement->id }}</td>
                                <td class="px-6 py-4">{{ $classement->sport->nom }}</td> <!-- Assuming a relationship -->
                                <td class="px-6 py-4">{{ $classement->equipe->nom }}</td> <!-- Assuming a relationship -->
                                <td class="px-6 py-4">{{ $classement->points }}</td>
                                <td class="px-6 py-4">{{ $classement->rang }}</td>
                                <td class="px-6 py-4">
                                    <a href="{{ route('classements.edit', $classement->id) }}" class="text-purple-600 hover:text-purple-900 mr-2">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form action="{{ route('classements.destroy', $classement->id) }}" method="POST" class="inline">
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