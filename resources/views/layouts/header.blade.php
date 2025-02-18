<header class="w-full bg-white p-2 flex justify-around items-center">

    <p class="text-2xl font-bold"><a href="">PANEL ADMIN</a></p>

    {{-- search --}}
    <div class="relative w-1/3">
        <input type="text" class="w-full border rounded-lg focus:ring-2 focus:ring-purple-500 focus:outline-none" placeholder="Search...">
        <svg class="absolute right-3 top-2.5 text-gray-400 w-5 h-5" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M16 10a6 6 0 11-12 0 6 6 0 0112 0z"/>
        </svg>
    </div>


    {{-- links --}}
    <div class="relative inline-block">
        <button onclick="toggleDropdown()" class="flex items-center rounded-lg">
            <img src="https://static1.srcdn.com/wordpress/wp-content/uploads/2021/12/Yato-Noragami.jpeg" class="w-10 h-10 rounded-full object-cover border-2 border-purple-500" alt="User">
        </button>
    
        <!-- Dropdown Menu -->
        <div id="dropdownMenu" class="absolute right-0 mt-2 w-48 bg-white rounded-lg shadow-lg hidden">
            <a href="{{route('profile.edit')}}" class="block px-3 py-2 text-gray-700 hover:bg-purple-100">Profile</a>
            <form action="{{route('logout')}}" class="block px-3 py-2 text-gray-700 hover:bg-purple-100" method="POST">
                @csrf
                <button >
                    <i class="fas fa-sign-out-alt"></i>
                    Logout
                </button>
           </form>
        </div>
    </div>
    
    <script>
        function toggleDropdown() {
            document.getElementById("dropdownMenu").classList.toggle("hidden");
        }
    </script>
    

</header>