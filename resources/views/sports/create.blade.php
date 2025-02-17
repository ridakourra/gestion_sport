<x-app-layout>
    <div class="p-3 w-full">
        <h2 class="text-2xl font-bold mb-6">Add New Sport</h2>
        <form method="POST" action="{{route('sports.store')}}">
            @csrf
            <div class="mb-4">
                <label for="sport-name" class="block text-sm font-medium text-gray-700">Name @error('nom') <em class="text-red-500 text-sm">{{$message}}</em> @enderror </label>
                <input
                    type="text"
                    id="nom"
                    name="nom"
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500"
                    required
                />
            </div>
            <div class="mb-4">
                <label for="sport-description" class="block text-sm font-medium text-gray-700">Description</label>
                <textarea
                    id="sport-description"
                    name="description"
                    rows="3"
                    class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500"
                ></textarea>
            </div>
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