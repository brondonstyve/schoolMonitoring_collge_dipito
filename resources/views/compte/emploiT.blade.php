@php
$jour = array('LUNDI','MARDI','MERCREDI','JEUDI','VENDREDI','SAMEDI' );
@endphp

@if ($utilisateur->type==null)


    <div class="">
        <div id="add-con" class="modal fade in" role="dialog" style="">
            <div class="modal-dialog">
                <div class="modal-content col-xs-5">
                    <div class="modal-body ">
                        <ul class="nav nav-tabs profile-tab">
                             </ul> </div> </div> </div>
                                        </div>
                                    </div> <!-- M.Debut page -->
                                        <h3 style="margin-top: -30px;"> Emploi de temps </h3>
                                        <div class="row">
                                            <div class="col-lg-8 ">
                                                <div class="card">
                                                    <!-- M.Nav tabs -->

                                                    <!-- M.emploi1 -->

                                                    <div class="tab-content">
                                                            @include('compte/layout_emploi')
                                                    </div>



                                                </div>

                                            </div>


                                            <div class="col-lg-4 col-md-6">
                                                    <div class="card card-size color-md1">
                                                        <div class="card-body">
                                                            <h3 class="card-title">Programme des évaluations</h3>
                                                            <div id="visitor" style="height: 267px; width: 100%; max-height: 290px; position: relative;" class="c3">

                                                                    <div class="table-responsive m-t-20">

                                                                        <table class="table stylish-table">
                                                                                <tbody>
                                                                             <tr class="">

                                                                             </tr>
                                                                                </tbody>
                                                                         </table>

                                                            </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>




                                        </div>




                                        @else

                                        @if ($utilisateur->type=="enseignant")
                                        <!--Jours libres-->
                                        @if($test)
                                        <div class="card-box">
                                            <div class="table-responsive">

                                                <form action="{{ route('disponibilite_edt_path') }}" method="post" class="col-lg-12 col-md-6">
                                                    {{ csrf_field() }}
                                                    <table class=""   style="background-color: azure">
                                                            <div class="col-md-6">
                                                                    <div class="card-box">
                                                                        <h4 class="m-t-0 header-title uppercase"><b>Mes jours de cours</b></h4>
                                                                        <p class="text-muted font-14 m-b-20">
                                                                             <code>mettre a jour sa disponibilité</code>
                                                                        </p>

                                                                        <div class="table-responsive">
                                                                            <table class="table m-0 table-colored-full table-full-inverse table-hover btn-sm" style="color: white">
                                                                                <thead>
                                                                                <tr>
                                                                                    <th>Jour</th>
                                                                                    @for ($i = 0; $i < sizeOf($configedt); $i++)
                                                                                    <th>
                                                                                        {{ $configedt[$i]->tranche }}<br>
                                                                                        {{ $configedt[$i]->hd .' à '.$configedt[$i]->hf }}
                                                                                    </th>
                                                                                    @endfor

                                                                                </tr>
                                                                                </thead>
                                                                                <tbody>
                                                                                    @for ($dispo =0 ; $dispo <sizeOf($jour) ; $dispo++)

                                                                                    <tr>
                                                                                            <th scope="row">{{ $jour[$dispo] }}</th>
                                                                                            @for ($check =1 ; $check <=sizeOf($configedt) ; $check++)
                                                                                            @if ($configedt[($check-1)]->libelle!=='pause')
                                                                                            <td>
                                                                                                    <input type="hidden" name="nom_jour{{ $dispo }}" value="{{ $jour[$dispo] }}">
                                                                                                    <input type="checkbox" name="{{ $jour[$dispo].'tranche'.$check }}" value="{{ $check }}"
                                                                                                    @for ($checked=0 ;  $checked<sizeOf($jour_dispo) ; $checked++)
                                                                                                      @if($jour[$dispo]==$jour_dispo[$checked]->jour && $check==$jour_dispo[$checked]->tranche) checked  @else @endif
                                                                                                    @endfor
                                                                                                    >{{ $check }}
                                                                                                    <!--Notificateur-->
                                                                                                    @for ($c=0 ;  $c<sizeOf($jour_dispo) ; $c++)
                                                                                                      @if($jour[$dispo]==$jour_dispo[$c]->jour && $check==$jour_dispo[$c]->tranche)
                                                                                                      <span class="notif"> <span class="heartbit"></span> <span class="point"></span> </span>
                                                                                                      @else @endif
                                                                                                    @endfor


                                                                                                 </td>
                                                                                                 @else
                                                                                                 <td>
                                                                                                 <input type="button" value="pause" class="btn btn-sm btn-info">
                                                                                                 </td>
                                                                                            @endif


                                                                                            @endfor
                                                                                        </tr>

                                                                                    @endfor
                                                                                </tbody>
                                                                                <tr>
                                                                                    <td colspan="{{ (sizeOf($configedt) +5)}}" align="center">
                                                                                        <input type="hidden" name="taille" value="{{ sizeOf($configedt) }}">
                                                                                            <input type="submit" value="confirmer" class="btn btn-info" id="confirmeur">
                                                                                    </td>
                                                                                </tr>
                                                                            </table>
                                                                        </div>
                                                                    </div>

                                                                </div>

                                                </form>




                                        @endif

                                        <br>
                                <h3 style="margin-top: -30px;"> </h3>

                                            <div class="col-lg-8 ">
                                                <div class="card">

                                                    <!-- M.emploi1 -->

                                                    <div class="tab-content">
                                                            @include('compte/layout_emploi_prof')
                                                    </div>



                                                </div>

                                            </div>

                                            <div class="col-lg-4 col-md-6">
                                                <div class="card card-size color-md1">
                                                    <div class="card-body">
                                                        <h3 class="card-title">Programme des évaluations</h3>
                                                        <div id="visitor" style="height: 267px; width: 100%; max-height: 290px; position: relative;" class="c3">

                                                                <div class="table-responsive m-t-20">

                                                                    <table class="table stylish-table">
                                                                            <tbody>
                                                                         <tr class="">

                                                                         </tr>
                                                                            </tbody>
                                                                     </table>

                                                        </div>

                                                        </div>
                                                    </div>
                                                </div>
                                            </div>





                                             @endif
                                            @endif



                                        </form>

                                    </div>
                </div>
            </div>
        </div>





                </body>

                </html>

