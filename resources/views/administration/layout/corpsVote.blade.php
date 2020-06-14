<div class="row">
    @for ($i =1 ; $i <=sizeOf($tableau) ; $i++)
    <div class="col-xl-3 col-sm-6">
            <div class="card-box widget-user">
                <div>
                    <img src="images/admin/avatar-3.jpg" class="img-responsive img-circle" alt="user">
                    <div class="wid-u-info">
                        <h5 class="m-t-20 m-b-5">{{ $tableau[$i]->nom.' '.$tableau[$i]->prenom }}</h5>
                        <p class="text-muted m-b-0 font-14">{{ $tableau[$i]->email }}</p>
                        <p class="text-muted m-b-0 font-14">{{ $tableau[$i]->classe }}</p>
                        <div class="user-position">
                            <span class="text-warning font-secondary">candidat {{ $i }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endfor

    </div>

    <form action="{{ route('Lancer_vote_etudiant_path') }}" method="post">
        {{ csrf_field() }}
            @for ($i =1 ; $i <=sizeOf($tableau) ; $i++)
            <input type="hidden" name="matricule{{ $i }}" value="{{ $tableau[$i]->id }}">
            @endfor
            <input type="hidden" name="nbre" value="{{ sizeOf($tableau) }}">
            <button type="submit" class="btn btn-success right col-sm-12">Valider</button>
    </form>
