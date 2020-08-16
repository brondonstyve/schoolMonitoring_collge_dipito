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
        <div><span>NOMS</span><?php echo e($nom); ?></div>
        <div><span>PRENOMS</span><?php echo e($prenom); ?></div>
        <div><span>ANNEE SCOLAIRE <?php echo e($date.'-'.$dates); ?></div>
        <div><span>CLASSE</span> <?php echo e($reponse[0]->nom.' '.$reponse[0]->code_classe); ?> (<?php echo e($classe); ?>)</div>
        <div><span>DATE</span> <?php echo e(date('Y-m-d')); ?></div>
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
            <?php $__currentLoopData = $tab_recu; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $item): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
            <?php
                $tab=explode('+',$item)
            ?>
            <tr>
                <td class="service">Scolarité</td>
                <td class="desc"><?php if($tab[0]=='tranche1'): ?>
                    INSCRIPTION
                <?php else: ?>
                <?php
                    $tab1=explode('e',$item)[1]
                ?>
                TRANCHE <?php echo e(intval($tab1) - 1); ?>

                <?php endif; ?></td>
                <td class="unit"><?php echo e($tab[1]); ?></td>
              </tr>
            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>

        </tbody>
      </table>
      <div id="notices">
        <div>NOTICE:</div>
        <div class="notice">Aucun argent encaissé n'est remboursable.</div>
      </div>
    </main>
    <footer style="padding-bottom:500px;">
      <div>Matricule : <?php echo e($matricule); ?></div>
      Producted by HIGH-TECH SOLUTION SARL.
      <br>
      <a href="<?php echo e(route('accueil_index_path')); ?>" style="float: left ;color: white;" class="btn btn-success btn-sm" >OK</a>
    <button style="float: right;color: white;" class="btn btn-success btn-sm" onclick="window.print()" >Imprimer</button>
</footer>
  </body>
</html>
<?php /**PATH C:\laragon\www\StandPlace secondaire_col_dipito\resources\views/administration/recu.blade.php ENDPATH**/ ?>