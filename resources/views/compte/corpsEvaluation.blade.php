@php
$reponse = array('a','b','c','d');
@endphp

@if ($utilisateur->type==null)

@include('compte/sousCompte/eval_etudiant')

@else

@include('compte/sousCompte/eval_enseignant')

@endif

