<x-app-layout>
    <div class="container mx-auto p-3">
        <h1 class="text-3xl font-bold mb-8">Equipes Management</h1>

        <!-- Add New Sport Button -->
        <div class="mb-6">
            <a href="{{route('equipes.create')}}" class="bg-purple-600 text-white px-4 py-2 rounded-md hover:bg-purple-700">
                <i class="fas fa-plus mr-2"></i>Add New Equipe
            </a>
        </div>

        <!-- Sports Table -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <table class="min-w-full">
                <thead class="bg-purple-600 text-white">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-medium uppercase">ID</th>
                        <th class="px-6 py-3 text-left text-sm font-medium uppercase">Name</th>
                        <th class="px-6 py-3 text-left text-sm font-medium uppercase">Sport</th>
                        <th class="px-6 py-3 text-left text-sm font-medium uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <!-- Example Rows -->
                    @if(count($equipes) > 0)
                        @foreach($equipes as $key => $equipe)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4">{{ $equipe->id }}</td>
                                <td class="px-6 py-4">{{ $equipe->nom }}</td>
                                <td class="px-6 py-4">{{ $equipe->sport->nom }}</td>
                                <td class="px-6 py-4 flex">
                                    <a href="{{route('equipes.edit', ['equipe' => $equipe])}}" class="text-purple-600 hover:text-purple-900 mr-2">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form method="POST" action="{{route('equipes.destroy', ['equipe' => $equipe])}}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="text-red-600 hover:text-red-900"><i class="fas fa-trash"></i> Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr class="hover:bg-gray-50">
                            <td colspan="4" class="p-2 text-gray-600 text-center">No equipes found</td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>