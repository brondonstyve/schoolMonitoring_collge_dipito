
<div class="row">
    <div class="col-sm-12">
        <div class="card-box">



@if (!$passe)
@if (sizeOf($classe)==0)
<h4 class="card-title">Pas encor d'étudiants dans les salles de classes</h4>
@else


            <h4 class="m-t-0 header-title" id="statutclasse"><b>Gerer Les emploi de temps</b></h4>


            <div class="table-responsive">
                <table class="table table-striped m-b-10 centre" style="cursor: pointer;" id="tableEDT">
                    <thead>
                        <tr >
                            <th>Numéro</th>
                            <th>Classe</th>
                            <th>Manipulations</th>
                        </tr>
                    </thead>
                    <tbody id="Edt">
                        @for ($i =0 ; $i <sizeOf($classe) ; $i++)
                        <tr id="">
                            <td tabindex="1">{{ $i+1 }}</td>
                            <td tabindex="1">{{ $classe[$i]->classe }}</td>

                        <td>

                                <a href="#">
                                    <form action="{{ route('remplir_emploi_path') }}" method="post" class="inline">
                                        {{ csrf_field() }}
                                        <input type="hidden" name="classe" value="{{ $classe[$i]->classe }}">
                                        <button type="submit" class="badge badge-success">Voir / Modifier</button>
                                    </form>
                                </a>

                                <a href="#" id="sup-edt" data-classe="{{ $classe[$i]->classe }}">
                                    <code class="badge badge-danger">supprimer </code>
                                </a>
                            </td>
                            </tr>
                            @endfor

                    </tbody>
                    <tfoot>
                        <tr>
                            <th></th>
                            <th></th>
                            <th></th>
                            <td class="right">{{ $classe->links() }}</td>
                        </tr>
                    </tfoot>
                </table>

            </div>


@endif
@else


@php
$jour = array('LUNDI','MARDI','MERCREDI','JEUDI','VENDREDI','SAMEDI' );
@endphp
@if ($passe)
<div class="table-responsive m-t-20" style="margin-top: -20px;">
 <form action="{{ route('sauvegarder_edt_path') }}" method="post">

    {{ csrf_field() }}
    @if (sizeOf($matiere)<=0)
      <h3 class="card-title">Aucune Matiere enregistrer pour cette classe</h3>
      <h3 class="card-title centre "><a href='{{ route('emploi_admin_path') }}'> Retour</a></h3>
    @else
<!-- si aucun enseignant dispo-->
    @if(sizeOf($disponibilite)==0)

    <h3 class="card-title">Aucun enseignant disponible</h3>
    @else
<!-- si non-->
  <div style="max-width: 90%;display: inline-block;margin-left: 8%">

        <h3 class="card-title"> Programmer la {{ $matiere[0]->classe }}</h3>
        <table class="table m-0 table-colored-full table-full-inverse table-hover">
                <thead class="btn-info">
                    <th>JOUR</th>
                    @for ($v =1 ; $v <= sizeOf($configedt) ; $v++)
                    <th>
                    Période {{ $v }}<br>
                    {{ $configedt[$v-1]->hd .' à '.$configedt[$v-1]->hf }}

                        </th>

                    @endfor
                </thead>


                    @for ($i = 0; $i < sizeOf($jour); $i++)
                    <tr>
                         <td>
                           {{ $jour[$i] }}
                         </td>
                         @php
                             $c=0;
                         @endphp

                        @for ($v =1 ; $v <= sizeOf($configedt) ; $v++)
                        @if ($configedt[$v-1]->libelle=='pause')
                           <td>
                               <input type="button" value="Pause" class="btn btn-sm btn-info">
                           </td>
                            @else
                            <td>
                                    <select name="{{ $jour[$i] }}matiere{{ $c++ }}" id="" style="width: 200px">
                                        <option value=""></option>
                                         <!--liste des matieres de la classe choisie-->
                                           @for ($a=0; $a<sizeOf($matiere); $a++)
                                                @for($x=0; $x<sizeOf($disponibilite); $x++)
                                                <!--affichage en fonction des disponiblites des enseignants-->
                                                @if(($jour[$i]==$disponibilite[$x]->jour) && ($matiere[$a]->compte==$disponibilite[$x]->compte))
                                                     @if (sizeOf($testeurEmpl)<=0)
                                                     <!--disponibilités des tranches-->
                                                       @if($v==$disponibilite[$x]->tranche)
                                                       @if ($matiere[$a]->nombre_heure<=0)
                                                        <option disabled style="color: red" >{{ $matiere[$a]->nom.' Cours terminé '}}
                                                           @else
                                                        <option value="{{ $disponibilite[$x]->tranche.'.'.$disponibilite[$x]->id.'.'.$matiere[$a]->compte.'.'.$matiere[$a]->nom}}" >{{ $matiere[$a]->nom.' ( '.$matiere[$a]->nom_prof.' )'}}
                                                       @endif
                                                       @endif
                                                     @else
                                                     @for ($u = 0; $u < sizeOf($testeurEmpl); $u++)
                                                     @php $test=false;$testeur=''; @endphp
                                                     <!--test de disponibilité--jour -->
                                                      @if($testeurEmpl[$u]->jour==$disponibilite[$x]->jour)
                                                      <!--test de disponibilité--compte -->
                                                               @if($testeurEmpl[$u]->compte==$disponibilite[$x]->compte)
                                                               <!--test de disponibilité--tranche horaire-->
                                                               @if($v==$disponibilite[$x]->tranche)

                                                               @if ($matiere[$a]->nombre_heure<=0)
                                                                  <option disabled style="color: red" value="{{ $disponibilite[$x]->tranche.'.'.$disponibilite[$x]->id.'.'.$matiere[$a]->compte.'.'.$matiere[$a]->nom}}">{{ $matiere[$a]->nom.' ( '.$testeurEmpl[$u]->nom_professeur.' ) Cours terminé '}}
                                                                  @php $test=true; $testeur=$matiere[$a]->compte.'.'.$matiere[$a]->nom; break; @endphp
                                                               @endif

                                                                    @if($testeurEmpl[$u]->tranche==$v)
                                                                          <option disabled style="color: red" value="{{ $disponibilite[$x]->tranche.'.'.$disponibilite[$x]->id.'.'.$matiere[$a]->compte.'.'.$matiere[$a]->nom}}">{{ $matiere[$a]->nom.' ( '.$testeurEmpl[$u]->nom_professeur.' ) Occupé en '.$testeurEmpl[$u]->classe}}
                                                                          @php $test=true; $testeur=$matiere[$a]->compte.'.'.$matiere[$a]->nom; break; @endphp
                                                                      @else
                                                                          @php $test=false; @endphp
                                                                     @endif
                                                               @endif
                                                                 @else
                                                                     @php $test=false;  @endphp

                                                               @endif
                                                      @endif

                                                      @endfor
                                                    @if($v==$disponibilite[$x]->tranche)

                                                      @if ($test==false && $testeur!=$matiere[$a]->compte.'.'.$matiere[$a]->nom )
                                                      @if ($matiere[$a]->nombre_heure<=0)
                                                                  <option disabled style="color: red" >{{ $matiere[$a]->nom.' Cours terminé '}}
                                                                  @else
                                                                  <option value="{{ $disponibilite[$x]->tranche.'.'.$disponibilite[$x]->id.'.'.$matiere[$a]->compte.'.'.$matiere[$a]->nom}}">{{ $matiere[$a]->nom.' ( '.$matiere[$a]->nom_prof.' )'}}
                                                               @endif
                                                         @php $testeur=''; @endphp
                                                      @endif
                                                     @endif

                                                     @endif
                                                @endif
                                                @endfor
                                           @endfor
                                    </select>
                                    <input type="hidden" name="tranche_horaire" value="{{ $c }}">
                                 </td>
                        @endif

                        @endfor

                     </tr>
               @endfor
                    <tr>
                        <td colspan="{{ sizeOf($configedt)+1 }}">
                                <div class="centre">
                                        <input type="hidden" name="classe" value="{{ $matiere[0]->classe }}">
                                        <input type="submit" value="Confirmer" class="btn btn-info" >
                                    </div>
                        </td>
                    </tr>

            </table>
</div>

<h3 class="card-title centre "><a href='{{ route('emploi_admin_path') }}'> Retour</a></h3>
     @endif
    @endif



</form>

</div>
@endif
<h3 class="card-title ">Dernier emploi de temps</a></h3>
@include('compte/layout_emploi')

@endif

</div>
</div>
</div>
