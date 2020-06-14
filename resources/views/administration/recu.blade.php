<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <title>Reçu de paiement</title>
    <link rel="stylesheet" href="css/recu.css" media="all" />
  </head>
  <body>
    <header class="clearfix">

      <h1>RECU DE PAIEMENT</h1>
      <div id="company" class="clearfix">
        <div>INSTITUT DIPITO</div>
        <div>Travail-persévérance-réussite</div>
        <div>(+237) 690 322 179</div>
        <div>Awae-escalier</div>
      </div>
      <div id="project">
        <div><span>NOMS</span>{{ $nom }}</div>
        <div><span>PRENOMS</span>{{ $prenom }}</div>
        <div><span>ANNEE SCOLAIRE {{ $date.'-'.$dates }}</div>
        <div><span>CLASSE</span> {{ $reponse[0]->nom.' '.$reponse[0]->code_classe }} ({{ $classe }})</div>
        <div><span>DATE</span> {{ date('Y-m-d') }}</div>
      </div>

      <div id="logo">
        <img src="images/logo_tech.png">
      </div>
    </header>
    <main>
      <table>
        <thead>
          <tr>
            <th class="service">LIBELLE</th>
            <th class="desc">DESCRIPTION</th>
            <th>MONTANT</th>

          </tr>
        </thead>
        <tbody>
            @foreach ($tab_recu as $item)
            @php
                $tab=explode('+',$item)
            @endphp
            <tr>
                <td class="service">Scolarité</td>
                <td class="desc">@if ($tab[0]=='tranche1')
                    INSCRIPTION
                @else
                @php
                    $tab1=explode('e',$item)[1]
                @endphp
                TRANCHE {{ intval($tab1) - 1 }}
                @endif</td>
                <td class="unit">{{ $tab[1] }}</td>
              </tr>
            @endforeach

        </tbody>
      </table>
      <div id="notices">
        <div>NOTICE:</div>
        <div class="notice">Aucun argent encaissé n'est remboursable.</div>
      </div>
    </main>
    <footer style="padding-bottom:500px;">
      <div>Matricule : {{ $matricule }}</div>
      Producted by HIGH-TECH SOLUTION SARL.
      <br>
      <a href="{{ route('accueil_index_path') }}" style="float: left ;color: white;" class="btn btn-success btn-sm" >OK</a>
    <button style="float: right;color: white;" class="btn btn-success btn-sm" onclick="window.print()" >Imprimer</button>
</footer>
  </body>
</html>
