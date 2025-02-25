<x-app-layout>
    <div class="container mx-auto max-w-[1300px] mt-8">

        <!-- Header with Create Button -->
        <div class="flex justify-between items-center mb-6">
            <h2 class="text-2xl font-semibold text-gray-800">Liste des Sports</h2>
            <a href="{{ route('sports.create') }}" 
               class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded inline-flex items-center">
                <i class="fas fa-plus mr-2"></i> Nouvelle Sport
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            @foreach($sports as $sport)
                <div class="relative max-w-sm cursor-pointer rounded overflow-hidden shadow-lg transform transition duration-500 hover:scale-105 hover:shadow-2xl">
                    <img class="w-full h-48 object-cover" src="{{ asset('storage/' . $sport->image) }}" alt="{{ $sport->nom }}">
                    <div class="px-6 py-4">
                        <div class="font-bold text-xl text-center">{{ $sport->nom }}</div>
                    </div>
                    <div class="absolute inset-0 flex items-center justify-center bg-black bg-opacity-50 opacity-0 hover:opacity-100 transition-opacity duration-300">
                        <a href="{{ route('sports.show', $sport->id) }}" class="text-white mx-2 bg-green-500 hover:bg-green-700 font-bold py-2 px-4 rounded">
                            <i class="fas fa-eye"></i> Voir
                        </a>
                        <a href="{{ route('sports.edit', $sport->id) }}" class="text-white mx-2 bg-blue-500 hover:bg-blue-700 font-bold py-2 px-4 rounded">
                            <i class="fas fa-edit"></i> Modifier
                        </a>
                        <form action="{{ route('sports.destroy', $sport->id) }}" method="POST" class="inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="text-white mx-2 bg-red-500 hover:bg-red-700 font-bold py-2 px-4 rounded">
                                <i class="fas fa-trash"></i> Supprimer
                            </button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</x-app-layout>