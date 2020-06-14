<div id="main-content" class="main-page clearfix">
    <main id="main" class="site-main" role="main">
        <section class="kc-elm kc-css-503470 kc_row">
            <div class="kc-row-container  kc-container">
                <div class="kc-wrap-columns">
                    <div class="kc-elm kc-css-476060 kc_col-sm-12 kc_column kc_col-sm-12">
                        <div class="kc-col-container">
                            <div class="woocommerce" >
                                <div class="row" id="customer_login" >


                                    <div class="col-md-sty woocommerce">
                                        <h2 class="title-login">Créer un compte</h2>
                                        <form action="{{ route('compte_store_path') }}" method="post" class="register widget" role="form"  >
                                                {{ csrf_field() }}
                                                <p class="form-group form-row form-row-wide">
                                                        <input class="input-text" type="text" name="nom" id="password" placeholder="Nom" required>
                                                        {!! $errors->first('nom','<p class="error">:message</p>') !!}
                                                    </p>

                                            <p class="form-group form-row form-row-wide">
                                                <input type="email" class="input-text" name="email" id="reg_email" placeholder="Adresse Email" required>
                                                {!! $errors->first('email','<p class="error">:message</p>') !!}
                                            </p>
                                            <p class="form-group form-row form-row-wide">
                                                <input type="password" class="input-text" name="mdp" id="reg_password" placeholder="mot de passe" required>
                                                {!! $errors->first('mdp','<p class="error">:message</p>') !!}
                                            </p>
                                             <p>
                                                <input type="password" class="input-text" name="mdpconf" id="reg_password" required placeholder="confirmer le Mot de passe">
                                                {!! $errors->first('mdpconf','<p class="error">:message</p>') !!}
                                            </p>

                                            <p class="form-group form-row">
                                                <input type="submit" class="button-btn" name="register" value="créer Compte">
                                            </p>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
</div>
</div>
</section>
</div>
