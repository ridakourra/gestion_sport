<x-app-layout>
    <div class="container mx-auto p-8">
        <!-- Page Title -->
        <h1 class="text-3xl font-bold mb-8">Matches Management</h1>

        <!-- Add New Match Button -->
        <div class="mb-6">
            <a href="{{ route('matches.create') }}" class="bg-purple-600 text-white px-4 py-2 rounded-md hover:bg-purple-700">
                <i class="fas fa-plus mr-2"></i>Add New Match
            </a>
        </div>

        <!-- Matches Table -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <table class="min-w-full">
                <thead class="bg-purple-600 text-white">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-medium uppercase">ID</th>
                        <th class="px-6 py-3 text-left text-sm font-medium uppercase">Sport</th>
                        <th class="px-6 py-3 text-left text-sm font-medium uppercase">Team 1</th>
                        <th class="px-6 py-3 text-left text-sm font-medium uppercase">Team 2</th>
                        <th class="px-6 py-3 text-left text-sm font-medium uppercase">Date</th>
                        <th class="px-6 py-3 text-left text-sm font-medium uppercase">Location</th>
                        <th class="px-6 py-3 text-left text-sm font-medium uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <!-- Example Rows -->
                    @if(count($matches) === 0)
                        <tr class="hover:bg-gray-50">
                            <td colspan="7" class="p-2 text-gray-600 text-center">No matches found</td>
                        </tr>
                    @else
                        @foreach($matches as $match)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4">{{ $match->id }}</td>
                                <td class="px-6 py-4">{{ $match->sport->nom }}</td> <!-- Assuming a relationship -->
                                <td class="px-6 py-4">{{ $match->equipe1->nom }}</td> <!-- Assuming a relationship -->
                                <td class="px-6 py-4">{{ $match->equipe2->nom }}</td> <!-- Assuming a relationship -->
                                <td class="px-6 py-4">{{ $match->date_match }}</td>
                                <td class="px-6 py-4">{{ $match->lieu }}</td>
                                <td class="px-6 py-4">
                                    <a href="{{ route('matches.edit', $match->id) }}" class="text-purple-600 hover:text-purple-900 mr-2">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form action="{{ route('matches.destroy', $match->id) }}" method="POST" class="inline">
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