<x-app-layout>
    <div class="flex-1 p-8">
        <h1 class="text-3xl font-bold mb-8">Dashboard</h1>

        <!-- Stats Cards -->
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
            <!-- Total Teams -->
            <div class="bg-white p-6 rounded-lg shadow-md">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500">Total Teams</p>
                        <p class="text-2xl font-bold">{{ $totalTeams }}</p>
                    </div>
                    <i class="fas fa-users text-purple-500 text-3xl"></i>
                </div>
            </div>

            <!-- Total Players -->
            <div class="bg-white p-6 rounded-lg shadow-md">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500">Total Players</p>
                        <p class="text-2xl font-bold">{{ $totalPlayers }}</p>
                    </div>
                    <i class="fas fa-user-friends text-purple-500 text-3xl"></i>
                </div>
            </div>

            <!-- Upcoming Matches -->
            <div class="bg-white p-6 rounded-lg shadow-md">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500">Upcoming Matches</p>
                        <p class="text-2xl font-bold">{{ $upcomingMatches }}</p>
                    </div>
                    <i class="fas fa-calendar-alt text-purple-500 text-3xl"></i>
                </div>
            </div>

            <!-- Total Sports -->
            <div class="bg-white p-6 rounded-lg shadow-md">
                <div class="flex items-center justify-between">
                    <div>
                        <p class="text-gray-500">Total Sports</p>
                        <p class="text-2xl font-bold">{{ $totalSports }}</p>
                    </div>
                    <i class="fas fa-football-ball text-purple-500 text-3xl"></i>
                </div>
            </div>
        </div>

        <!-- Quick Actions -->
        <div class="mb-8">
            <h2 class="text-xl font-bold mb-4">Quick Actions</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6">
                <a href="#" class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow">
                    <i class="fas fa-plus text-purple-500 text-2xl mb-2"></i>
                    <p class="font-semibold">Add New Team</p>
                </a>
                <a href="#" class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow">
                    <i class="fas fa-user-plus text-purple-500 text-2xl mb-2"></i>
                    <p class="font-semibold">Add New Player</p>
                </a>
                <a href="#" class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow">
                    <i class="fas fa-calendar-plus text-purple-500 text-2xl mb-2"></i>
                    <p class="font-semibold">Schedule Match</p>
                </a>
                <a href="#" class="bg-white p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow">
                    <i class="fas fa-trophy text-purple-500 text-2xl mb-2"></i>
                    <p class="font-semibold">Update Rankings</p>
                </a>
            </div>
        </div>

        <!-- Recent Matches -->
        <div class="bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-xl font-bold mb-4">Recent Matches</h2>
            <table class="w-full text-left">
                <thead>
                    <tr class="border-b">
                        <th class="py-2">Match</th>
                        <th class="py-2">Date</th>
                        <th class="py-2">Result</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- @foreach($recentMatches as $match)
                        <tr class="border-b">
                            <td class="py-2">{{ $match->Equipe1->nom }} vs {{ $match->Equipe2->nom }}</td>
                            <td class="py-2">{{ $match->date_match }}</td>
                            <td class="py-2">
                                @if($match->Resultat)
                                    {{ $match->Resultat->score_equipe1 }} - {{ $match->Resultat->score_equipe2 }}
                                @else
                                    N/A
                                @endif
                            </td>
                        </tr> --}}
                    {{-- @endforeach --}}
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>