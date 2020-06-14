<div class="card">
    <div class="card-body bg-info">
        <h4 class="text-white card-title uppercase">Mes cours</h4>
        <h6 class="card-subtitle text-white m-b-0 op-5">Liste des cours</h6>
    </div>
    <div class="card-body">
        <div class="message-box contact-box">





    @for ($i = 0; $i < sizeOf($cour); $i++)
    @php
        $compt=1;
    @endphp
        <div class="message-widget contact-widget" style="background-color: white" title="">


                <!-- Message -->
                <a data-toggle="collapse" data-target="#demo{{ $i }}">
                    <div class="user-img"> <img src="images/abc.png" alt="user" class="img-circle">
                        <span class="profile-status online pull-right" style="color: black"></span>
                    </div>
                    <div class="mail-contnet">
                        <h5 style="text-transform: uppercase"> {{ $cour[$i]->nom }} </h5>
                        <span class="mail-desc"> Cliquer pour dérouler et voir les cours de {{ $cour[$i]->nom }} </span>
                    </div>

                </a>
                <!-- sous menu -->

                  <div class="collapse contact-box" style="top: -0px; background-color: white;max-width: 90%; right: -10%;" id="demo{{ $i }}">


                    </div>
                    @php
                        $compte=true;
                    @endphp
                    @for ($c = 0; $c < sizeOf($course); $c++)

                    @if ($course[$c]->classe==$cour[$i]->nom)
                    <div class="collapse contact-box" id="demo{{ $i }}" style="top: -0px; background-color: #57bec5;max-width: 90%; relative;right: -10%;">

                        <span style="float: right;color: green;font-size: 10px" class=" uppercase">
                            <a href="{{ route('telechargement_path',$course[$c]->id_cours) }}">télécharger</a>
                        </span>
                        <a href="{{ route('coursDetail_path') }}?cour={{ encrypt($course[$c]->id_cours) }}&&mat={{ encrypt($course[$c]->matiere) }}" title="Cliquer pour voir" >
                            <div class="user-img"> <img src="images/courrs.png" alt="user" class="img-circle">
                                <span class="profile-status online pull-right" style="color: black"></span>
                            </div>

                            <div class="mail-contnet">
                                    <h5 style="text-transform: uppercase">cours {{ $compt }} </h5>
                                    <span class="mail-desc">libellé: {{ $course[$c]->libelle }} ({{ number_format(((fileSize('storage/cours/'.$course[$c]->fichier))/1048576),'2',',','') }} Mo)
                                        <span style="float: right">Crée le {{ $course[$c]->created_at }}</span>

                                    </span>
                                    <h5 class="mail-desc">
                                        {{ $course[$c]->commentaire }}
                                    </h5>
                                </div>
                        </a>

                        @php
                         $compt++
                        @endphp
                    </div>
                    @php
                        $compte=false;
                    @endphp
                    @endif

                    @endfor

                    @if ($compte)
                    <div class="collapse contact-box" id="demo{{ $i }}" style="top: -0px; background-color: #f96a74;max-width: 90%; relative;right: -10%;">
                        <a>
                            <div class="user-img"> <img src="images/bloc.png" alt="user" class="img-circle">
                                <span class="profile-status online pull-right" style="color: black"></span>
                            </div>

                            <div class="mail-contnet">
                                    <h5 style="text-transform: uppercase">Aucun cour</h5>
                                    <span class="mail-desc" style="color: black">vous n'avez pas envore crée de cours pour cette classe. crére en un!</span>
                                </div>
                        </a>


                </div>
                    @endif





    </div>


    @endfor



</div>



</div>

</div>
</div>




