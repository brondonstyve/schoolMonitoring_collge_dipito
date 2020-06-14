<section id="main-container" class="container-fluid inner" >

    <div class="row">
    <div id="main-content" class="main-page clearfix">
    <main id="main" class="site-main" role="main">
    <section class="kc-elm kc-css-314887 kc_row"><div class="kc-row-container  kc-container"><div class="kc-wrap-columns"><div class="kc-elm kc-css-697197 kc_col-sm-12 kc_column kc_col-sm-12"><div class="kc-col-container"><div class="widget-heading-title center_color">
    <h3 class="title">
    Nous contacter 	</h3>
    </div><div class="kc-elm kc-css-227239 kc_row kc_row_inner"><div class="kc-elm kc-css-857585 kc_col-sm-4 kc_column_inner kc_col-sm-4"><div class="kc_wrapper kc-col-inner-container"> <div class="contact-info">
    <div class="icon">
            <img src="images/message.png" class="mn-icon-258"> </img>
    </div>
    <div class="media-body">
    <h3 class="title">Email</h3>
    <div class="content">
            <?php echo e($r=(sizeOf($adresse)>0)? $adresse[0]->email :'contact@schoolmonitoring.com'); ?>

    </div>
    </div>
    </div>
    </div></div><div class="kc-elm kc-css-134475 kc_col-sm-4 kc_column_inner kc_col-sm-4"><div class="kc_wrapper kc-col-inner-container"> <div class="contact-info">
    <div class="icon">
    <img src="images/appel.png" class="mn-icon-258"> </img>
    </div>
    <div class="media-body">
    <h3 class="title">Numéro de téléphone</h3>
    <div class="content">
       <?php echo e($r=(sizeOf($adresse)>0)? $adresse[0]->numero :'(237) 6 97 32 09 74 / 690 322 179'); ?>

    </div>
    </div>
    </div>
    </div></div><div class="kc-elm kc-css-477534 kc_col-sm-4 kc_column_inner kc_col-sm-4"><div class="kc_wrapper kc-col-inner-container"> <div class="contact-info">
    <div class="icon">
            <img src="images/localisation.png" class="mn-icon-258"> </img>
    </div>
    <div class="media-body">
    <h3 class="title">Adresse</h3>
    <div class="content">
            <?php echo e($r=(sizeOf($adresse)>0)? $adresse[0]->adresse :'Non définie'); ?>

    </div>
    </div>
    </div>
    </div>
    <br><br><br>
    </div>
    </div>
    </div>
    </div>
    </div>
    </div>
    </section>



    <section class="kc-elm kc-css-76104 kc_row"  id="border"><div class="kc-row-container  kc-container">
        <div class="kc-wrap-columns">
     <div class="kc-elm kc-css-348174 kc_col-sm-12 kc_column kc_col-sm-12">
      <div class="kc-col-container"><div class="widget-heading-title center_color">
    <h3 class="title">
    Envoyez-nous un message	</h3>
    <div class="desc">Envoyez-nous vos commentaires</div>
    </div>
    <div class="kc-elm kc-css-729834 kc_row kc_row_inner"><div class="kc-elm kc-css-868853 kc_col-sm-12 kc_column_inner kc_col-sm-12"><div class="kc_wrapper kc-col-inner-container"><div class="kc-elm kc-css-467829 kc_text_block"><div role="form" class="wpcf7" id="wpcf7-f4-p129-o1" dir="ltr" lang="fr-fr">
    <div class="screen-reader-response"></div>



    <form action="<?php echo e(route('contacter_path')); ?>" method="POST" class="wpcf7-form">
       <?php echo e(csrf_field()); ?>


    <div class="row">
            <div class="col-md-4 col-xs-12">
                <span class="wpcf7-form-control-wrap name">
                    <input id="arrondie" type="text" name="nom" size="40" class="wpcf7-form-control wpcf7-text wpcf7-validates-as-required form-control" placeholder="Nom *" required="required">
                </span>
                <?php echo $errors->first('nom',' <span class="alert"> :message </span>'); ?>

            </div>
    <div class="col-md-4 col-xs-12">
        <span class="wpcf7-form-control-wrap email-523">

        </span>
    </div>

    <div class="col-md-4 col-xs-12">
        <span class="wpcf7-form-control-wrap phone">
           <input id="arrondie" type="email" name="email" size="40" class="wpcf7-form-control wpcf7-text wpcf7-email wpcf7-validates-as-required wpcf7-validates-as-email form-control" placeholder="Mon@Email.com" required="required">
        </span>
        <?php echo $errors->first('email',' <span class="alert"> :message </span>'); ?>

    </div>
    </div>

    <p>
        <span class="wpcf7-form-control-wrap textarea-783">

            <textarea id="arrondie" name="text" cols="40" rows="10" class="wpcf7-form-control wpcf7-textarea wpcf7-validates-as-required form-control" placeholder="Vrotre Message*"  required="required"></textarea>
        </span>
        <?php echo $errors->first('text',' <span class="alert"> :message </span>'); ?>

        <input type="submit" id="arrondie" value="envoyer message" class="wpcf7-form-control wpcf7-submit btn btn-block btn-theme">

        </p>

    </form>
    </div>
    </div></div></div></div></div></div></div></div></section>

    </main>
    </div>
    </div>
    </section>
<style>
 #arrondie {
    -moz-border-radius:7px;
    -webkit-border-radius:7px;
    border-radius:7px;
}
</style>
<?php /**PATH C:\laragon\www\StandPlace secondaire\resources\views/layout/contact.blade.php ENDPATH**/ ?>