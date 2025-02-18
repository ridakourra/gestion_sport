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
 
                <!-- Search Input -->
        <div class="relative w-full mb-4">
            <input 
                type="text" 
                id="searchInput" 
                class="w-full border rounded-lg focus:ring-2 focus:ring-purple-500 focus:outline-none" 
                placeholder="Search..."
            >
            <svg class="absolute right-3 top-2.5 text-gray-400 w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M16 10a6 6 0 11-12 0 6 6 0 0112 0z"/>
            </svg>
        </div>   
        <!-- Classement Table -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <table class="min-w-full" 
            id="sportsTable">
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
     <!-- JavaScript for Search -->
    <script>
        document.getElementById('searchInput').addEventListener('input', function() {
            const searchValue = this.value.toLowerCase(); // الحصول على القيمة المدخلة وتحويلها إلى أحرف صغيرة
            const rows = document.querySelectorAll('#sportsTable tbody tr'); // الحصول على جميع الصفوف

            rows.forEach(row => {
                const cells = row.querySelectorAll('td'); // الحصول على جميع الخلايا في الصف
                let match = false;

                cells.forEach(cell => {
                    if (cell.textContent.toLowerCase().includes(searchValue)) {
                        match = true; // إذا تطابقت القيمة مع أي خلية
                    }
                });

                // إظهار أو إخفاء الصف بناءً على النتيجة
                if (match) {
                    row.style.display = '';
                } else {
                    row.style.display = 'none';
                }
            });
        });
    </script>
</x-app-layout>