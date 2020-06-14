
<div class="row">
    <div class="col-sm-12">
        <div class="card-box">

            <h4 class="m-t-0 header-title" id="statutclasse"><b>Gerer tous les sujets</b></h4>
            <a href="#" data-toggle="modal" class="btn btn-success right ">
                    <code  data-toggle="modal" data-target="#Ajout-sujet">Ajouter un sujet</code>
                </a>


            <div class="table-responsive">
            <h4 class="m-t-0 header-title" id="statutclasse"><b>Nouveaux sujets recus</b></h4>

                <table  class="table table-striped m-b-10 centre" style="cursor: pointer;" id="tableclasse">
                    <tbody>
                        <tr>
                                <th>Numéro</th>
                                <th>Déclarant</th>
                                <th>Sujet</th>
                                <th>Description</th>
                                <th>Actions</th>
                        </tr>


                        @for ($i = 0; $i < sizeOf($reponse); $i++)
                            @if ($reponse[$i]->statut==false)
                            <tr>
                                    <td>{{ $reponse[$i]->id }}</td>
                                    <td>Utilisateur</td>
                                    <td>{{ $reponse[$i]->titre }}</td>
                                    <td>{{ $reponse[$i]->description }}</td>
                                    <td>
                                            <a href="{{ route('valider_Blog_path') }}?di={{ $reponse[$i]->id }}"
                                            title="" class="entry-image"><button class="badge badge-success" >Valider</button></a>
                                            <button class="badge badge-danger" id="supp-sujet" data-id="{{ $reponse[$i]->id }}">Supprimer</button>
                                    </td>
                            </tr>

                            @endif
                        @endfor
                    </tbody>
                    <tfoot>
                        <tr>
                            <th><strong>Total de sujet</strong></th>
                            <th><input type="button" id="nbsujet" value="{{ sizeOf($reponse) }}" size="3"> Sujet</th>
                            <th></th>
                        </tr>
                    </tfoot>
                </table>

            </div>
        </div>
    </div>
</div>
</div>

<!-- ajouteur de classe -->
<div id="Ajout-sujet" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- contenu-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Ajouter un sujet</h4>
      </div>
      <form action="{{ route('ajouterBlog_path') }}" method="post" id="blog">

      <div class="modal-body">
            <table class="">
                  <div class="col-md-12">
                      <div class="form-group">
                            <label for="">Titre</label>
                            <input type="text" name="titre" class="form-control" required>
                      </div>

                  </div>
                    <div class="col-md-12">
                        <div class="form-group">
                              <label for="">Description</label>
                              <textarea name="desc" id="" cols="30" rows="10" class="form-control"></textarea>
                              </select>
                        </div>

                    </div>
              </table>
      </div>

      <div class="modal-footer">
        <input type="submit"  class="btn btn-success left" value="Envoyer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Fermer</button>
      </div>
    </form>
    </div>

  </div>
</div>


<section id="main-container" class="main-content container inner">
<div class="row">
        @for ($i = 0; $i < sizeOf($reponse); $i++)
        @if ($reponse[$i]->statut==true)
        <div class="col-lg-4 col-md-4">
            <div class="card card-size3">
                <img class="" src="images/weatherbg.jpg" alt="Card image cap">
                <div class="card-img-overlay" style="height:110px;">
                    <h3 class="card-title text-white m-b-0 dl">{{ $reponse[$i]->titre }} </h3>
                    <small class="right" style="color: white">Crée le {{ $reponse[$i]->created_at }}</small>
                </div>
                <div class="card-body weather-small">
                    <div class="row ">
                        <div class="col-8 b-r align-self-center">
                            <div class="d-flex">
                                <div class="display-6 text-info"><i class="wi wi-day-rain-wind"></i></div>
                                <div class="m-l-20">
                                    <br>
                                    <button class="badge badge-danger" id="supp-sujet" data-id="{{ $reponse[$i]->id }}">Supprimer ce sujet</button>
                                    <a href="{{ route('blog_detail_path') }}?di={{ $reponse[$i]->id }}"
                                            title="" class="entry-image"><button class="badge badge-success" >voir</button></a>
                                </div>

                            </div>
                        </div>
                        @php
                           $compteur=0;
                        @endphp
                        <div class="col-4 text-center">

                             @for ($j = 0; $j < sizeOf($rep); $j++)
                                 @if ($rep[$j]->id == $reponse[$i]->id)
                                    @php
                                      $compteur=$compteur+1;
                                    @endphp
                                 @endif
                             @endfor
                             <h1 class="font-light m-b-0">{{ $compteur }}</h1> <small>commentaires</small>

                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
        @endfor

        {{ $reponse->links() }}
</div>



    </section>

