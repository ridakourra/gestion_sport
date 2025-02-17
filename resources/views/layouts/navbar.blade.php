<nav class="min-w-[250px] w-[250px] bg-white">
    <ul>
        <li class="mb-2">
        <a href="{{route('dashboard')}}" class="flex items-center p-2 text-gray-900 hover:text-white hover:bg-purple-700 rounded">
                <i class="fas fa-tachometer-alt mr-3"></i>
                Dashboard
            </a>
        </li>
        <li class="mb-2">
            <a href="{{route('sports.index')}}" class="flex items-center p-2 text-gray-900 hover:text-white hover:bg-purple-700 rounded">
                <i class="fas fa-football-ball mr-3"></i>
                Sports
            </a>
        </li>
        <li class="mb-2">
            <a href="{{route('equipes.index')}}" class="flex items-center p-2 text-gray-900 hover:text-white hover:bg-purple-700 rounded">
                <i class="fas fa-users mr-3"></i>
                Equipes
            </a>
        </li>
        <li class="mb-2">
            <a href="{{route('joueurs.index')}}" class="flex items-center p-2 text-gray-900 hover:text-white hover:bg-purple-700 rounded">
                <i class="fas fa-user-friends mr-3"></i>
                Joueurs
            </a>
        </li>
        <li class="mb-2">
            <a href="{{route('matches.index')}}" class="flex items-center p-2 text-gray-900 hover:text-white hover:bg-purple-700 rounded">
                <i class="fas fa-calendar-alt mr-3"></i>
                Matchs
            </a>
        </li>
        <li class="mb-2">
            <a href="{{route('classements.index')}}" class="flex items-center p-2 text-gray-900 hover:text-white hover:bg-purple-700 rounded">
                <i class="fas fa-trophy mr-3"></i>
                Classements
            </a>
        </li>
        <li class="mb-2">
            <a href="{{route('logout')}}" class="flex items-center p-2 text-gray-900 hover:text-white hover:bg-purple-700 rounded">
                <i class="fas fa-sign-out-alt mr-3"></i>
                Logout
            </a>
        </li>
    </ul>
</nav>