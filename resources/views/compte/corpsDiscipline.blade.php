
<div class="row">
    <!-- Column -->
    <div class="col-lg-4 col-xlg-3 col-md-5">
        <div class="card blog-widget card-size1 color-md1">
            <div class="card-body">
                <div class="blog-image"><img src="images/img1.jpg" alt="img" class="img-responsive"></div>
                <h3>Statut Disciplinaire</h3>
                <span style="color: black">ABSENCES :
                    <span style="color: @if($remplisseur<=10) green @else @if($remplisseur<=30) Blue @else red @endif @endif">
                        @if($remplisseur<=10) bonne @else @if($remplisseur<=30) Attention @else Mauvaise @endif @endif
                    </span>
                </span>
<br><br>
                <span style="color: black">CONSEIL DE DISCIPLINE :{{ sizeOf($discipline) }}
                        <span> </span>
                </span>

            </div>
        </div>
    </div>
    <div class="col-lg-8 col-xlg-9 col-md-7">
        <div class="card card-size2 color-md3">
            <div class="card-body">
                <div class="d-flex flex-wrap">
                    <div>
                        <h3 class="card-title">heures d'absence</h3>
                        <h6 class="card-subtitle">Vue détaillé de vos heures d'absence</h6>
                    </div>
                    <div class="ml-auto align-self-center">
                        <ul class="list-inline m-b-0">
                            <li>
                                <h6 class="text-muted text-info"><a href="">Total</a>
                                </h6>
                            </li>
                            <li>
                                <h6 class="text-muted text-info"><a href="">{{ $remplisseur }} @if($remplisseur==0) heure @else heures @endif</a>
                                </h6>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="campaign ct-charts">

                        <div class="card">
                                <div class="card-body">
                                    <div class="table-responsive m-t-20">
                                        @if (sizeOf($liste)==0)
                                        <h3 class="card-title">pas d'absence pour le moment</h3>
                                        <h5 class="card-title">bonne conduite.</h5>
                                        @else
                                        <table class="table stylish-table">
                                                <thead>
                                                    <tr>
                                                        <th>Date</th>
                                                        <th>nom matière</th>
                                                        <th>nom professeur</th>
                                                        <th>absence</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    @for ($i = 0; $i < sizeOf($liste); $i++)
                                                    <tr class="">
                                                            <td>{{ $liste[$i]->created_at }}</td>
                                                            <td> {{ $liste[$i]->nom }}</td>
                                                            <td> {{ $liste[$i]->nom_prof }} </td>
                                                            <td> {{ $liste[$i]->absence }}</td>
                                                        </tr>
                                                    @endfor


                                                </tbody>
                                            </table>

                                        @endif

                                    </div>
                                </div>
                            </div>
                 <span style="font-size: 10px">{{ $liste->links() }}</span>
                </div>
                <div class="row text-center" style="float: right">
                    <div class="col-lg-4 col-md-4 m-t-20">
                        <br><br><br><br><br><br>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>





</div>
</div>


</body>

</html>
