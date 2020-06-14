
<div >
    <!-- Column -->


@if ($utilisateur->type==null)

@include('compte/sousCompte/notesEtudiant')

@else


@if ($utilisateur->type=="enseignant")
@include('compte/sousCompte/notesProfesseur')
@endif
@endif


    <!-- Column -->
</div>
