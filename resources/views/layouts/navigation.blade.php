<nav x-data="{ open: false }" class="bg-white border-b border-gray-100 p-2 flex justify-between items-center">
    <x-logo></x-logo>
    <div class="flex gap-3">
        @auth
            <x-nav-link href="{{route('admin.dashboard')}}">Dashboard</x-nav-link>
            <x-nav-link href="{{route('sports.index')}}">Sports</x-nav-link>
            <x-nav-link href="{{route('equipes.index')}}">Equipes</x-nav-link>
            <x-nav-link href="{{route('joueurs.index')}}">Joueurs</x-nav-link>
            <x-nav-link href="{{route('matches.index')}}">Matches</x-nav-link>
            <x-nav-link href="{{route('profile.edit')}}">Profile</x-nav-link>            
            <form action="{{route('logout')}}" method="POST">
                @csrf
                <x-button-nav-link>Logout</x-button-nav-link>
            </form>
        @else
            <x-nav-link href="{{route('login')}}">Login</x-nav-link>
            <x-nav-link href="{{route('register')}}">Register</x-nav-link>
        @endauth
    </div>
</nav>
