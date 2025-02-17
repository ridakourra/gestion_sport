<x-app-layout>
        <div class="w-full p-3">
            <h2 class="text-2xl font-bold mb-6">Edit Sport</h2>
            <form method="POST" action="{{route('sports.update', ['sport' => $sport])}}">
                @csrf
                @method('PATCH')
                <div class="mb-4">
                    <label for="edit-sport-name" class="block text-sm font-medium text-gray-700">Name @error('nom') <em class="text-red-500 text-sm">{{$message}}</em> @enderror </label>
                    <input
                        type="text"
                        id="edit-sport-name"
                        name="nom"
                        value="{{old('nom',$sport->nom)}}"
                        class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500"
                        required
                    />
                </div>
                <div class="mb-4">
                    <label for="edit-sport-description" class="block text-sm font-medium text-gray-700">Description</label>
                    <textarea
                        id="edit-sport-description"
                        name="description"
                        rows="3"
                        class="mt-1 block w-full px-4 py-2 border border-gray-300 rounded-md shadow-sm focus:ring-purple-500 focus:border-purple-500"
                    >{{old('description',$sport->description)}}</textarea>
                </div>
                <div class="flex justify-end">
                    <a
                        href="{{route('sports.index')}}"
                        class="mr-2 px-4 py-2 bg-gray-300 text-gray-700 rounded-md hover:bg-gray-400"
                    >
                    Cancel
                    </a>
                    <button
                        class="px-4 py-2 bg-purple-600 text-white rounded-md hover:bg-purple-700"
                    >
                        Save Changes
                    </button>
                    
                </div>
            </form>
        </div>
    </div>
</x-app-layout>