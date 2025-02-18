<x-app-layout>
    <div class="container mx-auto p-3">
        <h1 class="text-3xl font-bold mb-8">Sports Management</h1>        

        <!-- Add New Sport Button -->
        <div class="mb-6">
            <a href="{{route('sports.create')}}" class="bg-purple-600 text-white px-4 py-2 rounded-md hover:bg-purple-700">
                <i class="fas fa-plus mr-2"></i>Add New Sport
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
        
        <!-- Sports Table -->
        <div class="bg-white rounded-lg shadow-md overflow-hidden">
            <table class="min-w-full" id="sportsTable">
                <thead class="bg-purple-600 text-white">
                    <tr>
                        <th class="px-6 py-3 text-left text-sm font-medium uppercase">ID</th>
                        <th class="px-6 py-3 text-left text-sm font-medium uppercase">Name</th>
                        <th class="px-6 py-3 text-left text-sm font-medium uppercase">Description</th>
                        <th class="px-6 py-3 text-left text-sm font-medium uppercase">Actions</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-gray-200">
                    <!-- Example Rows -->
                    @if(count($sports) > 0)
                        @foreach($sports as $key => $sport)
                            <tr class="hover:bg-gray-50">
                                <td class="px-6 py-4">{{ $sport->id }}</td>
                                <td class="px-6 py-4">{{ $sport->nom }}</td>
                                <td class="px-6 py-4">{{ $sport->description }}</td>
                                <td class="px-6 py-4 flex">
                                    <a href="{{route('sports.edit', ['sport' => $sport])}}" class="text-purple-600 hover:text-purple-900 mr-2">
                                        <i class="fas fa-edit"></i> Edit
                                    </a>
                                    <form method="POST" action="{{route('sports.destroy', ['sport' => $sport])}}">
                                        @csrf
                                        @method('DELETE')
                                        <button class="text-red-600 hover:text-red-900"><i class="fas fa-trash"></i> Delete</button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    @else
                        <tr class="hover:bg-gray-50">
                            <td colspan="4" class="p-2 text-gray-600 text-center">No sports found</td>
                        </tr>
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