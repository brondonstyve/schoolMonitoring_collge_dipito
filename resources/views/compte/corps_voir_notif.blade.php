<div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="row">
                    <div class="col-xlg-2 col-lg-4 col-md-4">
                        <div class="card-body">
                        </div>
                        @php
                        $compteur=0;
                        @endphp
                        @for ($i = 0; $i < sizeOf($notification); $i++) @if ($notification[$i]->matricule=='public' ||
                            $notification[$i]->matricule==$utilisateur->matricule ||
                            $notification[$i]->classe==$utilisateur->classe || $notification[$i]->compte==$utilisateur->id )
                            @php
                            $compteur=$compteur+1;
                            @endphp
                            @endif
                            @endfor
                            <div class="card-body inbox-panel"><a
                                    class="btn btn-info btn-sm m-b-20 p-10 btn-block waves-effect waves-light"
                                    style="color: white">liste de notification(s)</a>
                                <ul class="list-group list-group-full">
                                    @if ($compteur==0)

                                    @else
                                    @for ($i = 0; $i < sizeOf($notification); $i++) @if ($notification[$i]->
                                        matricule=='public' || $notification[$i]->matricule==$utilisateur->matricule ||
                                        $notification[$i]->classe==$utilisateur->classe || $notification[$i]->compte==$utilisateur->id )
                                        <a href="{{ route('voir_notifications_path') }}?id={{ $notification[$i]->id }}">
                                        <li class="list-group-item @if($notif_a_voir->id==$notification[$i]->id) active @endif" style="border: 1px steelblue solid">
                                                <img src="images/notif2.png" width="20px">
                                                <span style="@if($notif_a_voir->id==$notification[$i]->id) color:black; @endif">
                                                    {{ $notification[$i]->type }}
                                                    <code>
                                                    @php
                                                    $date1=new Date($notification[$i]->created_at);
                                                    $date2=new Date();
                                                    $date=number_format((strtotime($date2)-strtotime($date1))/60);
                                                    $date_h=number_format((strtotime($date2)-strtotime($date1))/3600);
                                                    $date_j=number_format((strtotime($date2)-strtotime($date1))/86400);

                                                @endphp
                                                @if ($date_j>0)
                                                   il y'a {{ $date_j }}  @if ($date_j<=1) Jour @else Jours @endif

                                                  @else
                                                  @if ($date<=60)
                                                     il y'a {{ $date }}  @if ($date<=1) minute @else minutes @endif
                                                 @else
                                                  @if ($date_h<=24)
                                                     il y'a {{ $date_h }}  @if ($date_h<=1) heure @else heures @endif
                                                  @endif
                                                 @endif
                                                @endif
                                            </code>
                                                </span>
                                        </li>
                                    </a>
                                        @endif
                                        @endfor
                                        @endif
                                        @if ($compteur>5)
                                        <a class="text-center" href="{{ route('notifications_path') }}"><small><code>Voir tout</code></small></a>

                                        @endif
                                </ul>
                            </div>
                    </div>

                    <div class="col-xlg-10 col-lg-8 col-md-8">
                        <div class="card-body">
                        </div>
                        <div class="card-body p-t-0">

                                <div class="card b-all shadow-none">
                                    <div class="btn btn-info ">
                                        <h3 class=" btn-sm" style="color: white"> Contenu demandé :
                                            {{ $notif_a_voir->type }}</h3>
                                    </div>
                                    <div>
                                        <hr class="m-t-0">
                                    </div>
                                    <div class="card-body">
                                        <div class="d-flex m-b-30">
                                            <div class="p-l-10">
                                                <h4 class="m-b-0">{{ $utilisateur->nom }}</h4>
                                                <small class="text-muted">{{ $utilisateur->email }}</small>
                                            </div>
                                        </div>
                                        <p class="badge badge-error">contenu</p>
                                        <p><b>{{ $notif_a_voir->message }}</b></p>
                                        <code>
                                            @php
                                            $date1=new Date($notif_a_voir->created_at);
                                            $date2=new Date();
                                            $date=number_format((strtotime($date2)-strtotime($date1))/60);
                                            $date_h=number_format((strtotime($date2)-strtotime($date1))/3600);
                                            $date_j=number_format((strtotime($date2)-strtotime($date1))/86400);

                                        @endphp
                                        @if ($date_j>0)
                                           il y'a {{ $date_j }}  @if ($date_j<=1) Jour @else Jours @endif

                                          @else
                                          @if ($date<=60)
                                             il y'a {{ $date }}  @if ($date<=1) minute @else minutes @endif
                                         @else
                                          @if ($date_h<=24)
                                             il y'a {{ $date_h }}  @if ($date_h<=1) heure @else heures @endif
                                          @endif
                                         @endif
                                        @endif
                                    </code>
                                    </div>
                                </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
