<x-app-layout>
    <div class="p-3 w-full">
        <h2 class="text-2xl font-bold mb-6">Edit Classement</h2>
        <form method="POST" action="{{ route('classements.update', $classement->id) }}">
            @csrf
            @method('PUT')
    
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
                    <option value="" disabled>Select a Sport</option>
                    @foreach($sports as $sport)
                        <option value="{{ $sport->id }}" {{ old('sport_id', $classement->sport_id) == $sport->id ? 'selected' : '' }}>
                            {{ $sport->nom }}
                        </option>
                    @endforeach
                </select>
            </div>
    
            <!-- Team Selection -->
            <div class="mb-4">
                <label for="equipe_id" class="block text-sm font-medium text-gray-700">
                    Team @error('equipe_id') <em class="text-red-500 text-sm">{{ $message }}</em> @enderror
                </label>
                <select
                    id="equipe_id"
                    name="equipe_id"
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500"
                    required
                >
                    <option value="" disabled>Select a Team</option>
                    @foreach($equipes as $equipe)
                        <option value="{{ $equipe->id }}" {{ old('equipe_id', $classement->equipe_id) == $equipe->id ? 'selected' : '' }}>
                            {{ $equipe->nom }}
                        </option>
                    @endforeach
                </select>
            </div>
    
            <!-- Points -->
            <div class="mb-4">
                <label for="points" class="block text-sm font-medium text-gray-700">
                    Points @error('points') <em class="text-red-500 text-sm">{{ $message }}</em> @enderror
                </label>
                <input
                    type="number"
                    id="points"
                    name="points"
                    value="{{ old('points', $classement->points) }}"
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500"
                    required
                />
            </div>
    
            <!-- Rank -->
            <div class="mb-4">
                <label for="rang" class="block text-sm font-medium text-gray-700">
                    Rank @error('rang') <em class="text-red-500 text-sm">{{ $message }}</em> @enderror
                </label>
                <input
                    type="number"
                    id="rang"
                    name="rang"
                    value="{{ old('rang', $classement->rang) }}"
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
                    Update
                </button>
            </div>
        </form>
    </div>
</x-app-layout>