<div class="account-box">
    <div class="text-center account-logo-box">
        <h4 class="text-uppercase font-bold m-b-0">Generer un matricule</h4>
    </div>
    <div class="account-content">

        <form class="form-horizontal" action="<?php echo e(route('_genere_matricule_path')); ?>" method="POST">
         <?php echo e(csrf_field()); ?>

                    <div class="form-group row m-b-25">
                        <div class="col-12">
                            <label for="password">Nom</label>
                            <input class="form-control" type="text" name="nom" required="" placeholder="nom">
                        </div>
                    </div>
                    <div class="form-group row m-b-25">
                        <div class="col-12">
                            <label>prenom</label>
                            <input class="form-control" type="text" name="prenom" required="" placeholder="prenom">
                        </div>
                    </div>
                    <div class="form-group row m-b-25">
                        <div class="col-12">
                            <label>Type de compte</label>
                            <select name="type" id="" class="form-control" required>
                                <option value="admin">Administrateur</option>
                                <option value="enseignant">Enseignant</option>
                            </select>
                        </div>
                    </div>

                            <div class="form-group">
                                <div class="">la Sexe</div>
                                <select name="sexe" id="" class="form-control">
                                    <option>Masculin</option>
                                    <option>Féminin</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <div class="">la Date de naissance</div>
                                <input type="date" name="naissance" class="form-control" required />
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">Pays</div>
                                <select name="pays" id="" class="form-control">
                                    <option>Cameroun</option>
                                    <option>Gabon</option>
                                    <option>Tchad</option>
                                    <option>Algérie</option>
                                    <option>France</option>
                                    <option>Guinée</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <div class="col-md-12">Adresse:</div>
                                <input type="text" name="adresse" class="form-control" />
                            </div>
                            <div class="form-group">
                                <div class="col-md-12">Ville:</div>
                                <input type="text" name="ville" class="form-control" required />
                                <?php echo $errors->first('ville',' <p style="color: red;font-family: italic"> :message
                                </p> '); ?>

                            </div>
                            <div class="form-group">
                                <div class="col-md-12">Numéro de téléphone:</div>
                                <input type="number" name="numero" class="form-control" max="9999999999" required />
                                <?php echo $errors->first('number',' <p style="color: red;font-family: italic">
                                    :message</p> '); ?>

                            </div>
                            <div class="form-group">
                                <div class="col-md-12">Email:</div>
                                <input type="email" name="email" class="form-control" required />
                            </div>

                            <div class="form-group">
                                    <div class="col-md-12">Salaire par Heure</div>
                                    <input type="number" name="sal" class="form-control" max="10000" />
                                </div>


            <div class="form-group row text-center m-t-10">
                <div class="col-12">
                    <button class="btn btn-md btn-block btn-primary waves-effect waves-light"
                        type="submit">Envoyer</button>
                </div>
            </div>
        </form>

    </div>
</div>
<?php /**PATH C:\laragon\www\StandPlace\resources\views/administration/layout/corpsMatricule.blade.php ENDPATH**/ ?>