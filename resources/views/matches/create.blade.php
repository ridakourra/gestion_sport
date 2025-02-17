<x-app-layout>
    <div class="p-3 w-full">
        <h2 class="text-2xl font-bold mb-6">Add New Match</h2>
        <form method="POST" action="{{ route('matches.store') }}">
            @csrf
            <!-- Sport Selection -->
            <div class="mb-4">
                <label for="sport_id" class="block text-sm font-medium text-gray-700">
                    Sport @error('sport_id') <em class="text-red-500 text-sm">{{ $message }}</em> @enderror
                </label>
                <select
                    id="sport_id"
                    name="sport_id"
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500"
                    required
                >
                    <option value="" disabled selected>Select a Sport</option>
                    @foreach($sports as $sport)
                        <option value="{{ $sport->id }}">{{ $sport->nom }}</option>
                    @endforeach
                </select>
            </div>
    
            <!-- Team 1 Selection -->
            <div class="mb-4">
                <label for="equipe1_id" class="block text-sm font-medium text-gray-700">
                    Team 1 @error('equipe1_id') <em class="text-red-500 text-sm">{{ $message }}</em> @enderror
                </label>
                <select
                    id="equipe1_id"
                    name="equipe1_id"
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500"
                    required
                >
                    <option value="" disabled selected>Select Team 1</option>
                    @foreach($equipes as $equipe)
                        <option value="{{ $equipe->id }}">{{ $equipe->nom }}</option>
                    @endforeach
                </select>
            </div>
    
            <!-- Team 2 Selection -->
            <div class="mb-4">
                <label for="equipe2_id" class="block text-sm font-medium text-gray-700">
                    Team 2 @error('equipe2_id') <em class="text-red-500 text-sm">{{ $message }}</em> @enderror
                </label>
                <select
                    id="equipe2_id"
                    name="equipe2_id"
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500"
                    required
                >
                    <option value="" disabled selected>Select Team 2</option>
                    @foreach($equipes as $equipe)
                        <option value="{{ $equipe->id }}">{{ $equipe->nom }}</option>
                    @endforeach
                </select>
            </div>
    
            <!-- Match Date -->
            <div class="mb-4">
                <label for="date_match" class="block text-sm font-medium text-gray-700">
                    Match Date @error('date_match') <em class="text-red-500 text-sm">{{ $message }}</em> @enderror
                </label>
                <input
                    type="date"
                    id="date_match"
                    name="date_match"
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500"
                    required
                />
            </div>
    
            <!-- Match Location -->
            <div class="mb-4">
                <label for="lieu" class="block text-sm font-medium text-gray-700">
                    Location @error('lieu') <em class="text-red-500 text-sm">{{ $message }}</em> @enderror
                </label>
                <input
                    type="text"
                    id="lieu"
                    name="lieu"
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500"
                    required
                />
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