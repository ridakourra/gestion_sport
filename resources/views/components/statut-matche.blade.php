@if($match->statut === 'completed' && $match->resultat)
    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-green-100 text-green-800">
        {{ $match->resultat->score_equipe1 }} - {{ $match->resultat->score_equipe2 }}
    </span>
@elseif($match->statut === 'in progress')
    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-blue-100 text-blue-800">
        En cours
    </span>
@else
    <span class="px-2 py-1 text-xs font-semibold rounded-full bg-yellow-100 text-yellow-800">
        En attente
    </span>
@endif