<x-app-layout>
    <div class="p-3 w-full">
        <h2 class="text-2xl font-bold mb-6">Add New Team</h2>
        <form method="POST" action="{{ route('equipes.store') }}">
            @csrf
            <!-- Team Name -->
            <div class="mb-4">
                <label for="team-name" class="block text-sm font-medium text-gray-700">
                    Team Name @error('nom') <em class="text-red-500 text-sm">{{ $message }}</em> @enderror
                </label>
                <input
                    type="text"
                    id="nom"
                    name="nom"
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500"
                    required
                />
            </div>
    
            <!-- Sport Selection -->
            <div class="mb-4">
                <label for="sport-id" class="block text-sm font-medium text-gray-700">
                    Sport @error('sport_id') <em class="text-red-500 text-sm">{{ $message }}</em> @enderror
                </label>
                <select
                    id="sport_id"
                    name="sport_id"
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500"
                    required
                >
                    <option value="" disabled selected>Select a Sport</option>
                    <!-- Example Sports (Replace with dynamic data from your database) -->
                    @foreach($sports as $sport)
                        <option value="{{$sport->id}}">{{$sport->nom}}</option>
                    @endforeach
                </select>
            </div>
    
            <!-- Submit Button -->
            <div class="flex justify-end">
                <button
                    type="submit"
                    class="px-4 py-2 bg-purple-600 text-white rounded-md hover:bg-purple-700"
                >
                    Save
                </button>
            </div>
        </form>
    </div>
</x-app-layout>