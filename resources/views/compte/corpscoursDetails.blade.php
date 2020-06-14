<section id="main-container" class="main-content container inner">
    <div class="row">
        <div id="main-content" class="col-xs-12 col-md-9 col-sm-12 col-xs-12">
            <div id="primary" class="content-area">
                <div id="content" class="site-content detail-post" role="main">


                    <div id="comments" class="comments-area" style="margin-top: -60px">
                        <span>libellé: {{ $course[0]->libelle }}</span>
                        <span style="float: right">Matière: {{ $course[0]->nom }}</span>

                            <iframe src="storage/cours/{{ $course[0]->fichier }}" frameborder="0" width="100%" height="400px">
                                alt: <a href="storage/cours/{{ $course[0]->fichier }}">Cliquer ici pour voir l'épreuve</a>
                            </iframe>
                            <a href="{{ route('telechargement_path',$course[0]->id_cours) }}">
                                <h3 class="widget-title uppercase btn btn-success"><span>telecharger</span></h3>
                            </a>




                        <h3 class=" dropdown-user btn-sm"><input type="button" id="text" value="{{ sizeOf($reponse) }}"> question(s)</h3>

                         @for ($i = 0; $i < sizeOf($reponse); $i++)
                                <div id="{{ $i }}">
                                    <div id="rep{{ $i }}">
                                        <div class="d-flex flex-row comment-row p-3" >
                                            <div class="p-2"><span class="round text-white d-inline-block text-center rounded-circle bg-info">
                                                <img src="storage/avatar/{{ $utilisateur->photo }}" alt="user" width="50"></span></div>
                                            <div class="comment-text w-100 p-3">
                                                <h5>{{ $reponse[$i]->nom.' '.$reponse[$i]->prenom }}</h5>
                                                <p class="mb-1 overflow-hidden">
                                                    {{ $reponse[$i]->message }}
                                                </p>
                                                <div class="comment-footer">
                                                    @php
                                                        $date=new Date($reponse[$i]->created_at);
                                                    @endphp
                                                    <span class="text-muted pull-right">{{ $date->format('d M Y') }}</span>
                                                    <a href="#" class="badge badge-info" data-toggle="modal" id="reponse" data-id="{{ $i }}" data-kuestion="{{ $reponse[$i]->id }}">Répondre</a>
                                                    <a href="#" class="badge badge-primary" data-toggle="modal" id="repon" data-id="rep{{ $i }}" data-id_fermer="{{ $i }}" data-repo="{{ $i }}" data-kuestion="{{ $reponse[$i]->id }}">Réponses</a>
                                                    @if ($utilisateur->type=='enseignant')
                                                    <a href="#" data-toggle="modal">
                                                        <img src="images/icones/del-red.png" alt="" title="supprimer" data-toggle="modal" data-id="{{ $reponse[$i]->id }}" data-supp="rep{{ $i }}" width="20px" id="kuestion_supp">
                                                    </a>
                                                    @endif

                                                </div>
                                            </div>
                                        </div>
                                    </div>



                                 </div>
                        @endfor

                        <br>
                        <div class="commentform row reset-button-default">
                            <div class="col-sm-12">
                                <div id="respond" class="comment-respond">
                                    <form action="{{ route('kuestion_path') }}" method="post" id="kuestion_form" class="comment-form">
                                        <br>
                                        <div class="form-group h-info"><code>Ajouter une question</code></div>
                                        <div class="form-group">
                                            <textarea rows="8" placeholder="ma question" id="comment"
                                                class="form-control" name="comment" aria-required="true" required></textarea>
                                        </div>

                                        <p class="form-submit">
                                            <input type="hidden" name="cour" value="{{ $course[0]->id_cours }}">
                                            <input name="submit" type="submit" id="submit" class="btn btn-dark btn-sm " value="Envoyer">
                                        </p>
                                    </form>
                                </div><!-- #respond -->
                            </div>
                        </div>
                    </div><!-- .comments-area -->
                </div><!-- #content -->
            </div><!-- #primary -->
        </div>
        <div class="col-md-3 col-sm-12 col-xs-12 pull-right">
            <aside class="sidebar sidebar-right" itemscope="itemscope" >

                <aside id="apus_recent_post-2" class="widget widget_apus_recent_post">
                    <h2 class="widget-title"><span>Les cours de {{ $cours[0]->classe }}</span></h2>
                    <div class="post-widget media-post-layout widget-content">
                        <ul class="posts-list">
                            @for ($i = 0; $i < sizeOf($cours); $i++)
                            <li>
                                    <article class="post post-list">
                                        <div class="entry-content media">

                                            <h6>{{ $i+1 }}</h6>
                                            <div class="media-left">
                                                <figure class="entry-thumb effect-v6">
                                                    <a href="{{ route('coursDetail_path') }}?cour={{ encrypt($cours[$i]->id_cours) }}&&mat={{ encrypt($cours[$i]->matiere) }}" title="" class="entry-image">
                                                        <img src="images/courrs.png"
                                                            class="attachment-widget size-widget wp-post-image" alt=""
                                                            width="700" height="579"> </a>
                                                </figure>
                                            </div>
                                            <div class="media-body">
                                                <h4 class="entry-title">
                                                    <a
                                                        href="{{ route('coursDetail_path') }}?cour={{ encrypt($cours[$i]->id_cours) }}&&mat={{ encrypt($cours[$i]->matiere) }}">{{ $cours[$i]->libelle }}</a>
                                                </h4>
                                                <div class="entry-content-inner clearfix">
                            <a href="{{ route('coursDetail_path') }}?cour={{ encrypt($cours[$i]->id_cours) }}&&mat={{ encrypt($cours[$i]->matiere) }}" title="" class="entry-image">

                                                    <div class="entry-meta">
                                                        <div class="entry-create">
                                                            <span class="entry-date">{{ $cours[$i]->created_at }}</span>
                                                        </div>
                                                    </div>
                                </a>

                                                </div>
                                            </div>
                                        </div>
                                    </article>
                             </li>

                            @endfor


                        </ul>
                    </div>
                </aside>
            </aside>
        </div>
    </div>
</section>
