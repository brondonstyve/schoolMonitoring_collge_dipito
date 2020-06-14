@include('administration/layout/entete_menu_bar' )

@php
$fil=$reponse[0]->nom;
@endphp
@include('administration/layout/dash',['stat'=>"Liste des paiements des $fil.s"])
@include('administration/layout/corpsListeTranche')
<script src="//code.jquery.com/jquery.min.js"></script>
   @include('flashy::message')
@include('administration/layout/footer')
@include('administration/layout/script')

