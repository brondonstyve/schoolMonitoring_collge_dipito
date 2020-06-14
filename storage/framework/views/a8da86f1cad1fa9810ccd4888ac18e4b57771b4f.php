<?php if($utilisateur->type=='enseignant'): ?>

<?php if(!$createEpreuve): ?>
   <!--mes salles de classe-->

  <div class="card">
        <div class="card-body bg-info">
            <h4 class="text-white card-title uppercase">Mes salles de classe</h4>
            <h6 class="card-subtitle text-white m-b-0 op-5">Liste des salles où je dispense cours</h6>
        </div>
        <div class="card-body">
            <div class="message-box contact-box">
                    <h2 class="add-ct-btn">
                            <img src="images/icones/add-green.png" class="btn btn-circle btn-lg btn-success waves-effect waves-dark"
                                data-toggle="modal" data-target="#add-contact">
                        </h2>

                        <!-- tout supprimer les epreuves -->
                        <?php if(sizeOf($epreuve)>0): ?>
                       <a href="" class=" btn-sm btn-danger" data-toggle="modal" data-target="#supp-tout-ep">Tout supprimer</a>
                        <?php endif; ?>

                            <div class="table-responsive ">
                                    <div id="supp-tout-ep" class="modal fade in " tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                                        style="display: none;" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content col-xs-9">
                                                <div class="modal-header ">
                                                <h4 class="modal-title" id="myModalLabel">Voulez vous vraiment supprimer toutes les épreuves?</h4>
                                            </div>
                                            <div class="modal-title">

                                                    <div class="form-group" style="text-align: center;">
                                                        <div class="col-md-12 m-b-20 carousel-inner">
                                                            <div class="fileupload bouton btn-danger btn-rounded waves-effect carousel-inner" >
                                                                <span >
                                                                        <a href="<?php echo e(route('supprimer_tout_epreuve_path')); ?>">Confirmer</a>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>

                <?php for($i =0 ; $i <sizeOf($classe_a_evaluer) ; $i++): ?>
                <?php $compteur=0 ?>
                <div class="message-widget contact-widget" style="background-color: white" title="">


                    <!-- Message -->
                    <a >
                        <div class="user-img"> <img src="images/abc.png" alt="user" class="img-circle">
                            <span class="profile-status online pull-right" style="color: black"></span>
                        </div>
                        <div class="mail-contnet">
                            <h5 style="text-transform: uppercase"><?php echo e($classe_a_evaluer[$i]->classe); ?></h5>
                            <span class="mail-desc"> Cliquer sur le boutton vert pour ajouter une epreuve à la <?php echo e($classe_a_evaluer[$i]->classe); ?></span>

                        </div>
                    </a>
                    <!-- sous menu -->
                    <?php for($u =0 ; $u <sizeOf($epreuve) ; $u++): ?>
                    <?php if($epreuve[$u]->classe==$classe_a_evaluer[$i]->classe): ?>
                    <?php $compteur=$compteur+1 ?>

                            <div class=" contact-box" style="top: -0px; background-color: white;max-width: 90%; relative;right: -10%;" >

                        <!--eenvoi-->

                        <span class="mail-desc" data-toggle="modal" data-target="#add-envoi<?php echo e($u); ?>" style="display: inline-block;max-width: 20px;right: -10%;">
                                    <img src="images/icones/share.png" alt="" title="envoyer" >
                        </span>

                        <span class="mail-desc" style="display: inline-block;max-width: 20px">
                                <div class="table-responsive ">
                                        <div id="add-envoi<?php echo e($u); ?>" class="modal fade in " tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                                            style="display: none;" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content col-xs-9">
                                                    <div class="centre uppercase">
                                                    <h4 class="" >Envoyer l'épreuve</h4>
                                                </div>
                                                <div class="modal-title">

                                                    <form action="<?php echo e(route('Envoyer_epreuve_path')); ?>" method="post" class="centre">
                                                        <?php echo e(csrf_field()); ?>

                                                        <input type="hidden" name="idEpreuve" value="<?php echo e($epreuve[$u]->id); ?>">
                                                        <input type="hidden" name="nomEpreuve" value="<?php echo e($epreuve[$u]->epreuve); ?>">
                                                        <table >
                                                            <tr>
                                                                <td>Choisissez un enseignant</td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <select name="path_prof">
                                                                        <?php for($nb =0 ; $nb <sizeOf($prof) ; $nb++): ?>
                                                                        <option value="<?php echo e($prof[$nb]->id.'-'.$prof[$nb]->nom.' '.$prof[$nb]->prenom); ?>">
                                                                                <?php echo e($prof[$nb]->nom.' '.$prof[$nb]->prenom); ?>

                                                                        </option>
                                                                        <?php endfor; ?>
                                                                    </select>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                        <input type="submit" value="Envoyer" class="btn btn-success centre">
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                        </a>
                    </span>
            <!--fin envoi-->

                        <!--supprimer-->
                        <span class="mail-desc" style="display: inline-block;max-width: 20px">
                                <img src="images/icones/del-red.png" alt="" title="supprimer" data-toggle="modal" data-target="#add-sup<?php echo e($u); ?>">
                        </span>

                        <span class="mail-desc" style="display: inline-block;max-width: 20px">
                                                <div id="add-sup<?php echo e($u); ?>" class="modal fade in " tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                                                    style="display: none;" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content col-xs-9">
                                                            <div class="modal-header ">
                                                            <h4 class="modal-title" id="myModalLabel">Voulez vous vraiment supprimer ce ficher?</h4>
                                                        </div>
                                                        <div class="modal-title">

                                                                <div class="form-group" style="text-align: center;">
                                                                    <div class="col-md-12 m-b-20 carousel-inner">
                                                                        <div class="fileupload bouton btn-danger btn-rounded waves-effect carousel-inner" >
                                                                            <span >
                                                                                    <a href="<?php echo e(route('supprimer_epreuve_path')); ?>?path_directori=<?php echo e($epreuve[$u]->id); ?>">Suprimer</a>
                                                                            </span>
                                                                        </div>
                                                                        <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Annuler</button>
                                                                    </div>
                                                                </div>
                                                        </div>
                                                    </div>
                                            </div>

                                        </div>
                            </span>

                 <!--fin suppression-->

                 <!--modifier-->
                 <span class="mail-desc" style="display: inline-block;max-width: 20px">
                        <img src="images/icones/mis_a_jour.png" data-toggle="modal" data-target="#mod-rep<?php echo e($u); ?>">
                </span>

                <span class="mail-desc" style="display: inline-block;max-width: 20px">
                        <div id="mod-rep<?php echo e($u); ?>" class="modal fade in " tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                            style="display: none;" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content col-xs-10">
                                        <div class="card-box">
                                            <h4 class="m-t-0 header-title"><b>Modifier les reponses</b></h4>
                                            <p class="text-muted font-14 m-b-20 btn-sm">
                                                 épreuve de<code><?php echo e(explode('.',$epreuve[$u]->matiere)[1]); ?>.</code>   <?php echo e($nbr_reponse=sizeOf(explode('.',$epreuve[$u]->reponse))-1); ?> questions
                                            </p>

                                            <div class="table-responsive">
                                                <form action="<?php echo e(route('modifier_reponses_path')); ?>" method="post">
                                                    <?php echo e(csrf_field()); ?>


                                                    <table class="table m-0 table-colored-bordered table-bordered-inverse">
                                                            <thead>
                                                            <tr class="btn-sm">
                                                                <th>question</th>
                                                                <th>reponses</th>
                                                                <th>question</th>
                                                                <th>réponse</th>
                                                            </tr>
                                                            </thead>
                                                            <tbody>
                                                                    <tr>
                                                                            <?php for($r = 0; $r < $nbr_reponse; $r++): ?>
                                                                            <tr class="">
                                                                                <td><?php echo e($r+1); ?></td>

                                                                                <td>
                                                                                    <select name="reponse<?php echo e($r); ?>" id="">
                                                                                      <option style="background-color: brown" value="<?php echo e(explode('.',$epreuve[$u]->reponse)[$r]); ?>"><?php echo e(explode('.',$epreuve[$u]->reponse)[$r]); ?></option>
                                                                                        <?php for($rep = 0; $rep < 4; $rep++): ?>
                                                                                           <?php if(explode('.',$epreuve[$u]->reponse)[$r]!=$reponse[$rep]): ?>
                                                                                             <Option value="<?php echo e($reponse[$rep]); ?>"><?php echo e($reponse[$rep]); ?></option>
                                                                                           <?php endif; ?>
                                                                                        <?php endfor; ?>
                                                                                    </select>

                                                                                </td>
                                                                                <?php $r=$r+2 ?>
                                                                                <td><?php echo e($r); ?></td>
                                                                                <?php $r-- ?>

                                                                                <td>
                                                                                    <select name="reponse<?php echo e($r); ?>" id="">
                                                                                      <option style="background-color: brown " value="<?php echo e(explode('.',$epreuve[$u]->reponse)[$r]); ?>"><?php echo e(explode('.',$epreuve[$u]->reponse)[$r]); ?></option>
                                                                                        <?php for($rep = 0; $rep < 4; $rep++): ?>
                                                                                           <?php if(explode('.',$epreuve[$u]->reponse)[$r]!=$reponse[$rep]): ?>
                                                                                             <Option value="<?php echo e($reponse[$rep]); ?>"><?php echo e($reponse[$rep]); ?></option>
                                                                                           <?php endif; ?>
                                                                                        <?php endfor; ?>
                                                                                    </select>
                                                                                </td>

                                                                        </tr>

                                                                        <?php endfor; ?>
                                                                            <tr>
                                                                                <td colspan="2">Matiere et Classe</td>
                                                                                <td colspan="2">
                                                                                        <select name="matiere" required style="min-width: 100%;text-transform: uppercase">
                                                                                                <?php for($y =0 ; $y <sizeOf($classe_mat) ; $y++): ?>
                                                                                                <option value="<?php echo e($classe_mat[$y]->id.'.'.$classe_mat[$y]->nom.'->'.$classe_mat[$y]->classe); ?>">
                                                                                                    <?php echo e($classe_mat[$y]->nom.'->'.$classe_mat[$y]->classe); ?>

                                                                                                </option>
                                                                                               <?php endfor; ?>
                                                                                            </select>
                                                                                </td>
                                                                            </tr>
                                                                        <tr>
                                                                            <td colspan="4" align="center">
                                                                                <input type="hidden" name="nbre" value="<?php echo e(sizeOf(explode('.',$epreuve[$u]->reponse))-1); ?>">
                                                                                <input type="hidden" name="id_epreuve" value="<?php echo e($epreuve[$u]->id); ?>">
                                                                                <input type="submit" value="Modifier" class="btn btn-sm btn-info">
                                                                            </td>
                                                                        </tr>
                                                            </tbody>
                                                        </table>
                                                </form>

                                            </div>
                                        </div>
                            </div>
                    </div>

                </div>
    </span>



                <!--fin modification-->




                        </div>



                        <div class=" contact-box" style="top: -0px; background-color: #57bec5;max-width: 90%; relative;right: -10%;" >
                            <a href="<?php echo e(route('evaluer_classe_path')); ?>?path_directori=<?php echo e($epreuve[$u]->id); ?>&path_directoric=<?php echo e($epreuve[$u]->matiere); ?>&path_dir=<?php echo e($epreuve[$u]->classe); ?>" title="Cliquer pour créer une évaluation">
                                <div class="user-img"> <img src="images/courrs.png" alt="user" class="img-circle">
                                    <span class="profile-status online pull-right" style="color: black"></span>
                                </div>

                                <div class="mail-contnet">
                                        <h5 style="text-transform: uppercase">épreuves de <?php echo e(explode('.',$epreuve[$u]->matiere)[1]); ?></h5>
                                        <span class="mail-desc">édité le <?php echo e($epreuve[$u]->created_at); ?> par moi pour la <?php echo e($epreuve[$u]->classe); ?></span>


                                    </div>

                                    <span class="btn-sm"
                                        style="text-transform: uppercase;color:brown"> pour <?php if($epreuve[$u]->libelle=='sn'): ?> la <?php else: ?> le <?php endif; ?> <?php echo e($epreuve[$u]->libelle); ?></span>
                            </a>


                    </div>

                    <?php endif; ?>

                   <?php endfor; ?>
                   <?php if($compteur==0): ?>

                   <div class=" contact-box" style="top: -0px; background-color: #f96a74;max-width: 90%; relative;right: -10%;" >
                            <a >
                                <div class="user-img"> <img src="images/bloc.png" alt="user" class="img-circle">
                                    <span class="profile-status online pull-right" style="color: black"></span>
                                </div>

                                <div class="mail-contnet" >
                                        <h5 style="text-transform: uppercase">pas d'épreuves</h5>
                                        <span class="mail-desc" style="color: black">vous n'avez pas envore crée d'épreuve pour cette classe. crére en une!</span>


                                    </div>
                            </a>


                    </div>

                   <?php endif; ?>


                </div>

            <?php endfor; ?>

    <!-- autres -->
           <?php $compteur=0 ?>
            <a href="">
                    <div class="message-widget contact-widget" style="background-color: white"
                    title="">
                    <a >
                        <div class="user-img"> <img src="images/abc.png" alt="user" class="img-circle">
                            <span class="profile-status online pull-right" style="color: black"></span>
                        </div>
                        <div class="mail-contnet">
                                <h5 style="text-transform: uppercase">Autres</h5>
                                <span class="mail-desc"> Les épreuves recus des autres professeurs</span>
                        </div>
                    </a>

                    <?php for($z =0 ; $z <sizeOf($epreuve) ; $z++): ?>
                    <?php if($epreuve[$z]->classe==''): ?>
                    <?php $compteur=$compteur+1 ?>
                    <div class=" contact-box" style="top: -0px; background-color: white;max-width: 90%; relative;right: -10%;" >


                        <!--eenvoi-->
                        <span class="mail-desc" data-toggle="modal" data-target="#add-envoi<?php echo e($z); ?>" style="display: inline-block;max-width: 20px;right: -10%;">
                                    <img src="images/icones/share.png" alt="" title="envoyer" >
                        </span>

                        <span class="mail-desc" style="display: inline-block;max-width: 20px">
                                <div class="table-responsive ">
                                        <div id="add-envoi<?php echo e($z); ?>" class="modal fade in " tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                                            style="display: none;" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content col-xs-9">
                                                    <div class="centre uppercase">
                                                    <h4 class="" >Envoyer l'épreuve</h4>
                                                </div>
                                                <div class="modal-title">

                                                    <form action="<?php echo e(route('Envoyer_epreuve_path')); ?>" method="post" class="centre">
                                                        <?php echo e(csrf_field()); ?>

                                                        <input type="hidden" name="idEpreuve" value="<?php echo e($epreuve[$z]->id); ?>">
                                                        <input type="hidden" name="nomEpreuve" value="<?php echo e($epreuve[$z]->epreuve); ?>">
                                                        <table >
                                                            <tr>
                                                                <td>Choisissez un enseignant</td>
                                                            </tr>
                                                            <tr>
                                                                <td>
                                                                    <select name="path_prof">
                                                                        <?php for($nb =0 ; $nb <sizeOf($prof) ; $nb++): ?>
                                                                        <option value="<?php echo e($prof[$nb]->id.'-'.$prof[$nb]->nom.' '.$prof[$nb]->prenom); ?>">
                                                                                <?php echo e($prof[$nb]->nom.' '.$prof[$nb]->prenom); ?>

                                                                        </option>
                                                                        <?php endfor; ?>
                                                                    </select>
                                                                </td>
                                                            </tr>
                                                        </table>
                                                        <input type="submit" value="Envoyer" class="btn btn-success centre">
                                                    </form>
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                </div>

                        </a>
                    </span>
            <!--fin envoi-->

                    <!--supprimer-->
                    <span class="mail-desc" style="display: inline-block;max-width: 20px">
                            <img src="images/icones/del-red.png" alt="" title="supprimer" data-toggle="modal" data-target="#add-sup<?php echo e($z); ?>">
                    </span>

                    <span class="mail-desc" style="display: inline-block;max-width: 20px">
                                            <div id="add-sup<?php echo e($z); ?>" class="modal fade in " tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                                                style="display: none;" aria-hidden="true">
                                                <div class="modal-dialog">
                                                    <div class="modal-content col-xs-9">
                                                        <div class="modal-header ">
                                                        <h4 class="modal-title" id="myModalLabel">Voulez vous vraiment supprimer ce ficher?</h4>
                                                    </div>
                                                    <div class="modal-title">

                                                            <div class="form-group" style="text-align: center;">
                                                                <div class="col-md-12 m-b-20 carousel-inner">
                                                                    <div class="fileupload bouton btn-danger btn-rounded waves-effect carousel-inner" >
                                                                        <span >
                                                                                <a href="<?php echo e(route('supprimer_epreuve_path')); ?>?path_directori=<?php echo e($epreuve[$z]->id); ?>">Suprimer</a>
                                                                                <button type="button" class="btn btn-default pull-right" data-dismiss="modal">Annuler</button>
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                    </div>
                                                </div>
                                        </div>

                                    </div>
                        </span>


             <!--fin suppression-->

                          <!--modifier-->
                          <span class="mail-desc" style="display: inline-block;max-width: 20px">
                                <img src="images/icones/mis_a_jour.png" data-toggle="modal" data-target="#mod-rep<?php echo e($z); ?>">
                        </span>

                        <span class="mail-desc" style="display: inline-block;max-width: 20px">
                                <div id="mod-rep<?php echo e($z); ?>" class="modal fade in " tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                                    style="display: none;" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content col-xs-10">
                                                <div class="card-box">
                                                    <h4 class="m-t-0 header-title"><b>Modifier les reponses</b></h4>
                                                    <p class="text-muted font-14 m-b-20 btn-sm">
                                                         épreuve de<code><?php echo e(explode('.',$epreuve[$z]->matiere)[1]); ?>.</code>   <?php echo e($nbr_reponse=sizeOf(explode('.',$epreuve[$z]->reponse))-1); ?> questions
                                                    </p>

                                                    <div class="table-responsive">
                                                        <form action="<?php echo e(route('modifier_reponses_path')); ?>" method="post">
                                                            <?php echo e(csrf_field()); ?>


                                                            <table class="table m-0 table-colored-bordered table-bordered-inverse">
                                                                    <thead>
                                                                    <tr class="btn-sm">
                                                                        <th>question</th>
                                                                        <th>reponses</th>
                                                                        <th>question</th>
                                                                        <th>réponse</th>
                                                                    </tr>
                                                                    </thead>
                                                                    <tbody>
                                                                            <tr>
                                                                                    <?php for($r = 0; $r < $nbr_reponse; $r++): ?>
                                                                                    <tr class="">
                                                                                        <td><?php echo e($r+1); ?></td>

                                                                                        <td>
                                                                                            <select name="reponse<?php echo e($r); ?>" id="">
                                                                                              <option style="background-color: brown" value="<?php echo e(explode('.',$epreuve[$z]->reponse)[$r]); ?>"><?php echo e(explode('.',$epreuve[$z]->reponse)[$r]); ?></option>
                                                                                                <?php for($rep = 0; $rep < 4; $rep++): ?>
                                                                                                   <?php if(explode('.',$epreuve[$z]->reponse)[$r]!=$reponse[$rep]): ?>
                                                                                                     <Option value="<?php echo e($reponse[$rep]); ?>"><?php echo e($reponse[$rep]); ?></option>
                                                                                                   <?php endif; ?>
                                                                                                <?php endfor; ?>
                                                                                            </select>

                                                                                        </td>
                                                                                        <?php $r=$r+2 ?>
                                                                                        <td><?php echo e($r); ?></td>
                                                                                        <?php $r-- ?>

                                                                                        <td>
                                                                                            <select name="reponse<?php echo e($r); ?>" id="">
                                                                                              <option style="background-color: brown " value="<?php echo e(explode('.',$epreuve[$z]->reponse)[$r]); ?>"><?php echo e(explode('.',$epreuve[$z]->reponse)[$r]); ?></option>
                                                                                                <?php for($rep = 0; $rep < 4; $rep++): ?>
                                                                                                   <?php if(explode('.',$epreuve[$z]->reponse)[$r]!=$reponse[$rep]): ?>
                                                                                                     <Option value="<?php echo e($reponse[$rep]); ?>"><?php echo e($reponse[$rep]); ?></option>
                                                                                                   <?php endif; ?>
                                                                                                <?php endfor; ?>
                                                                                            </select>
                                                                                        </td>

                                                                                </tr>
                                                                                <?php endfor; ?>
                                                                                    <tr>
                                                                                <td colspan="2">Matiere et classe</td>
                                                                                <td colspan="2">
                                                                                        <select name="matiere" required style="min-width: 100%;text-transform: uppercase">
                                                                                                <?php for($y =0 ; $y <sizeOf($classe_mat) ; $y++): ?>
                                                                                                <option value="<?php echo e($classe_mat[$y]->id.'.'.$classe_mat[$y]->nom.'->'.$classe_mat[$y]->classe); ?>">
                                                                                                    <?php echo e($classe_mat[$y]->nom.'->'.$classe_mat[$y]->classe); ?>

                                                                                                </option>
                                                                                               <?php endfor; ?>
                                                                                            </select>
                                                                                </td>
                                                                            </tr>
                                                                                <tr>
                                                                                    <td colspan="4" align="center">
                                                                                        <input type="hidden" name="nbre" value="<?php echo e(sizeOf(explode('.',$epreuve[$z]->reponse))-1); ?>">
                                                                                        <input type="hidden" name="id_epreuve" value="<?php echo e($epreuve[$z]->id); ?>">
                                                                                        <input type="submit" value="Modifier" class="btn btn-sm btn-info">
                                                                                    </td>
                                                                                </tr>
                                                                    </tbody>
                                                                </table>
                                                        </form>

                                                    </div>
                                                </div>
                                    </div>
                            </div>

                        </div>
                    </div>
            </span>



                        <!--fin modification-->



                        <div class=" contact-box" style="background-color: #57bec5;max-width: 90%; relative;right: -10%" >
                            <a href="#" onclick="alert('attribuer l\'épreuve à une salle de classe avant pouvoir créer une évaluation')">
                                <div class="user-img"> <img src="images/courrs.png" alt="user" class="img-circle">
                                    <span class="profile-status online pull-right" style="color: black"></span>
                                </div>
                                <div class="mail-contnet">
                                    <h5 style="text-transform: uppercase">épreuve de <?php echo e(explode('.',$epreuve[$z]->matiere)[1]); ?></h5>
                                    <span class="mail-desc"> édité par <?php echo e($epreuve[$z]->editeur); ?></span>

                                </div>
                            </a>
                    </div>


                    <?php endif; ?>

                   <?php endfor; ?>

                   <?php if($compteur==0): ?>

                   <div class=" contact-box" style="top: -0px; background-color: #f96a74;max-width: 90%; relative;right: -10%;" >
                            <a >
                                <div class="user-img"> <img src="images/bloc.png" alt="user" class="img-circle">
                                    <span class="profile-status online pull-right" style="color: black"></span>
                                </div>

                                <div class="mail-contnet" >
                                        <h5 style="text-transform: uppercase">pas d'épreuves</h5>
                                        <span class="mail-desc" style="color: black">vous n'avez pas envore crée d'épreuve pour cette classe. crére en une!</span>


                                    </div>
                            </a>


                    </div>

                   <?php endif; ?>

    </div>



</div>

</div>
</div>
    <?php endif; ?>






<!--creation des données d'epreuve-->







<!-- creation d'épreuves -->

<?php if($createForm): ?>
<!-- liste de mes evaluations -->

        <div class="card-body bg-info">
                <?php if(sizeOf($evaluation)==0): ?>
                <h4 class="text-white card-title uppercase">aucune évaluation crée pour le moment</h4>
                <h6 class="card-subtitle text-white m-b-0 op-5">Créer des evaluations a partir de vos épreuves</h6>
                <?php else: ?>
                <h4 class="text-white card-title uppercase">Mes evaluations</h4>
                <h6 class="card-subtitle text-white m-b-0 op-5">Liste de mes évaluations</h6>
            </div>

            <!-- tout supprimer evaluation -->

            <a href="" class="btn-sm btn-danger" data-toggle="modal" data-target="#supp-tout">Tout supprimer</a>

            <span class="mail-desc" style="display: inline-block;max-width: 20px">
                    <a href="">
                            <div class="table-responsive ">
                                    <div id="supp-tout" class="modal fade in " tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                                        style="display: none;" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content col-xs-9">
                                                <div class="modal-header ">
                                                <h4 class="modal-title" id="myModalLabel">Voulez vous vraiment supprimer toutes les évaluations?</h4>
                                            </div>
                                            <div class="modal-title">

                                                    <div class="form-group" style="text-align: center;">
                                                        <div class="col-md-12 m-b-20 carousel-inner">
                                                            <div class="fileupload bouton btn-danger btn-rounded waves-effect carousel-inner" >
                                                                <span >
                                                                        <a href="<?php echo e(route('supprimer_tout_evaluation_path')); ?>">Confirmer</a>
                                                                </span>
                                                            </div>
                                                        </div>
                                                    </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>

                    </a>
                </span>





            <div class="card-body">

                <div class="message-box contact-box">

                    <?php for($i =0 ; $i <sizeOf($evaluation) ; $i++): ?>

                    <div class="message-widget contact-widget" style="background-color: antiquewhite"
                        title="">


                        <!-- Message -->
                        <a href="storage\epreuve\<?php echo e($evaluation[$i]->epreuve); ?>">
                            <div class="user-img"> <img src="images/abc.png" alt="user" class="img-circle">
                                <span class="profile-status online pull-right" style="color: black"></span>
                            </div>
                            <div class="mail-contnet">
                                <h5 style="text-transform: uppercase">évaluation de <?php echo e($evaluation[$i]->nom); ?> en <?php echo e($evaluation[$i]->class_mat); ?> pour: <?php echo e($evaluation[$i]->libelle); ?></h5>
                                <span class="mail-desc"> En attente de validation par l'administration...</span>

                            </div>

                            <span class="btn-sm"
                                style="text-transform: uppercase;color:brown">durée::<?php echo e($evaluation[$i]->dure); ?> minutes</span>

                        </a>
                    </div>

                <!--voir evaluation-->
                    <span class="mail-desc" style="display: inline-block;max-width: 20px">
                                <a href="<?php echo e(route('modifier_evaluation_path')); ?>?path_directrieRetry=<?php echo e($evaluation[$i]->id); ?>">
                                    <img src="images/icones/oeil.png" alt="supprimer" title="supprimer">
                                </a>
                            </span>
                <!--Supprimer eva-->
                    <span class="mail-desc" style="display: inline-block;max-width: 20px">
                            <a data-toggle="modal" data-target="#add-sup-eva<?php echo e($i); ?>">
                                <img src="images/icones/del-red.png" alt="supprimer" title="supprimer">
                            </a>
                        </span>

                        <span class="mail-desc" style="display: inline-block;max-width: 20px">
                                <a href="">
                                        <div class="table-responsive ">
                                                <div id="add-sup-eva<?php echo e($i); ?>" class="modal fade in " tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                                                    style="display: none;" aria-hidden="true">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content col-xs-9">
                                                            <div class="modal-header ">
                                                            <h4 class="modal-title" id="myModalLabel">Voulez vous vraiment supprimer cet évaluation?</h4>
                                                        </div>
                                                        <div class="modal-title">

                                                                <div class="form-group" style="text-align: center;">
                                                                    <div class="col-md-12 m-b-20 carousel-inner">
                                                                        <div class="fileupload bouton btn-danger btn-rounded waves-effect carousel-inner" >
                                                                            <span >
                                                                                    <a href="<?php echo e(route('supprimer_evaluation_path')); ?>?path_direc=<?php echo e($evaluation[$i]->id); ?>">Suprimer</a>
                                                                            </span>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>

                                        </div>

                                </a>
                            </span>




                        <?php endfor; ?>




                </div>
                <?php endif; ?>



        </div>
    </div>




<!--creation des données d'epreuve-->



    <div class="table-responsive ">
            <div id="add-contact" class="modal fade in " tabindex="-1" role="dialog" aria-labelledby="myModalLabel"
                style="display: none;" aria-hidden="true">
                <div class="modal-dialog" style="min-width: 90%">

                    <div class="col-md-4 modal-content" style="">

                        <div class="card-box">
                            <h4 class="m-t-0 header-title"><b>Détails de l'évaluation</b></h4>
                            <div class="table-responsive">
                                    <form action="<?php echo e(route('generer_epreuve_path')); ?>" method="post">
                                            <?php echo e(csrf_field()); ?>


                                            <div class="form-group">
                                                        <div class="col-md-7"><strong>Matièere:</strong></div>
                                                            <select name="matiere" required class="form-control" style="text-transform: uppercase">
                                                                <?php for($i =0 ; $i <sizeOf($classe_mat) ; $i++): ?> <option
                                                                    value="<?php echo e($classe_mat[$i]->id.'.'.$classe_mat[$i]->nom.'->'.$classe_mat[$i]->classe); ?>">
                                                                    <?php echo e($classe_mat[$i]->nom.'->'.$classe_mat[$i]->classe); ?></option>
                                                                    <?php endfor; ?>
                                                            </select>
                                                        </div>

                                                        <div class="form-group">
                                                                <div class="col-md-7"><strong>Libelle:</strong></div>

                                                            <select name="libelle" id="" class="form-control"
                                                                style="text-transform: uppercase">
                                                                <option value="CC">CC</option>
                                                                <option value="SN">SN</option>
                                                                <option value="tp">tp</option>
                                                            </select>
                                                        </div>
                                                            <div class="form-group">
                                                                    <div class="col-md-7"><strong>nombre de questions :</strong></div>

                                                            <select name="nbre_kuestion" id="" class="form-control">
                                                                <option value="10">10</option>
                                                                <option value="20">20</option>
                                                                <option value="30">30</option>
                                                                <option value="40">40</option>
                                                            </select>
                                                        </div>
                                            <input type="submit" class=" btn-sm btn-info pull-left" value="Valider">
                                            <button type="button" class="btn-sm btn-default pull-right" data-dismiss="modal">Annuler</button>
                                        </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>

        </div>




<!--creation des données d'epreuve-->


<?php endif; ?>


<!--creation epreuve-->
<?php if($createEpreuve): ?>

<div class="card">
        <div class="card-body btn-info centre">
            <h4 class="text-white card-title">Fiche d'épreuve</h4>
        </div>
        <div class="card-body">
            <div class="message-box contact-box">
                <h2 class="add-ct-btn">
                    <a href="<?php echo e(route('evaluation_path')); ?>">
                    <button type="" class="btn btn-circle btn-lg btn-danger waves-effect waves-dark">
                        X
                    </button>
                </a>
                </h2>
<div class="col-md-12" style="background-color: azure;">

    <div class="card-box">
        <div class="table-responsive">
            <form action="<?php echo e(route('enregistrer_epreuve_path')); ?>" method="post" enctype="multipart/form-data">
                <?php echo e(csrf_field()); ?>

                <table class="table-colored-full table-full-inverse table-hover" style="font-size: 15px;color: white">
                    <thead>
                        <tr style="color: white">
                            <th colspan="4" class="centre"> Epreuve de <?php echo e(explode('.',$matiere_classe[0])[1]); ?> de la
                                <?php echo e($matiere_classe[1]); ?></th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td colspan="4">
                                <div class="col-md-13 m-b-20 carousel-inner">
                                    <div class="fileupload  bouton  btn-info btn-rounded waves-effect carousel-inner"><span
                                            style="font-size: 20px;text-transform: uppercase">AJOUTER UN
                                            FICHIER</span>
                                        <input type="file" id="imgInp" accept="image/jpg,image/jpeg,application/pdf"
                                            name="fichier" class=" btn-sm " style="width: 100%" required>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <td colspan="4">
                            <div class="col-md-13 m-b-20 carousel-inner">
                                <div class="fileupload bouton  btn-info btn-rounded waves-effect carousel-inner"><span
                                        style="font-size: 20px;text-transform: uppercase">Inserer les
                                        reponses</span>

                                </div>
                            </div>
                        </td>
                        </tr>

                        <?php for($i = 0; $i < $nbre_k; $i++): ?> <tr class="">
                            <td class="centre"><?php echo e($i+1); ?></td>

                            <td class="centre">
                                <select name="kcm<?php echo e($i); ?>" id="">
                                    <?php for($rep = 0; $rep < 4; $rep++): ?> <Option value="<?php echo e($reponse[$rep]); ?>">
                                        <?php echo e($reponse[$rep]); ?> </option>
                                        <?php endfor; ?>
                                </select>
                            </td>
                            <?php $i=$i+2 ?>
                            <td class="centre"><?php echo e($i); ?></td>
                            <?php $i-- ?>

                            <td class="centre">
                                <select name="kcm<?php echo e($i); ?>" id="">
                                    <?php for($rep = 0; $rep < 4; $rep++): ?> <Option value="<?php echo e($reponse[$rep]); ?>">
                                        <?php echo e($reponse[$rep]); ?> </option>
                                        <?php endfor; ?>
                                </select>
                            </td>

                            </tr>
                            <?php endfor; ?>

                            <tr>
                                <td colspan="4">
                                    <div class="col-md-13 m-b-20 carousel-inner">
                                        <div class="fileupload bouton  btn-info btn-rounded waves-effect carousel-inner"
                                            style="text-transform: uppercase"><span
                                                style="font-size: 20px">confirmation du lbellé et la durée</span>

                                        </div>
                                    </div>
                                </td>
                            </tr>
                            <tr>

                                <th style="text-transform: uppercase;float: right">libellé</th>
                                <td style="width: 25%">
                                    <select name="libelle" id="" style="min-width: 100%;text-transform: uppercase">
                                        <option value="<?php echo e($libelle); ?>"><?php echo e($libelle); ?></option>
                                        <option value="CC">CC</option>
                                        <option value="SN">SN</option>
                                        <option value="tp">tp</option>
                                    </select>
                                </td>
                            </tr>

                            <tr>

                                <th style="text-transform: uppercase;float: right">classe</th>
                                <td style="width: 25%"><?php echo e($matiere_classe[1]); ?></td>
                                <th style="text-transform: uppercase;float: right">matière</th>
                                <td style="width: 25%"><?php echo e(explode('.',$matiere_classe[0])[1]); ?></td>
                            </tr>
                    </tbody>


                    <thead>

                        <tr>
                            <td colspan="4" align="center">
                                <input type="hidden" name="classe" value="<?php echo e($matiere_classe[1]); ?>">
                                <input type="hidden" name="matiere" value="<?php echo e($matiere_classe[0]); ?>">
                                <input type="hidden" name="nbre" value="<?php echo e($nbre_k); ?>">
                                <input type="submit" class="btn btn-info" value="Valider"
                                    style="font-size: 15px;"></span>

                            </td>
                        </tr>
                    </thead>

                </table>

            </form>
        </div>
    </div>

</div>
</div></div></div>

<?php endif; ?>

<?php else: ?>

<?php endif; ?>
<?php /**PATH C:\laragon\www\StandPlace primaire\resources\views/compte/sousCompte/eval_enseignant.blade.php ENDPATH**/ ?>