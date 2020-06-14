<div id="main-content" class="main-page clearfix">
    <main id="main" class="site-main" role="main">
        <section class="kc-elm kc-css-503470 kc_row">
            <div class="kc-row-container  kc-container">
                <div class="kc-wrap-columns">
                    <div class="kc-elm kc-css-476060 kc_col-sm-12 kc_column kc_col-sm-12">
                        <div class="kc-col-container">
                            <div class="woocommerce" >
                                <div class="row" id="customer_login" >
                                    <div class="col-md-sty ">
                                            <h2 class="">Connexion</h2>

                                        <form action="{{ route('connex_show') }}" method="POST" class="login" role="form" >

                                                {{ csrf_field() }}
                                            <p class="form-group form-row form-row-wide">
                                                <input type="email" class="input-text" name="email" id="username" placeholder="Adresse Email" required>

                                            </p>
                                            <p class="form-group form-row form-row-wide">
                                                <input class="input-text" type="password" name="mdp" placeholder="Mot de passe" id="password" required>

                                            </p>


                                            <div class="clearfix">
                                                <p for="rememberme" class="pull-left">
                                                    <input name="rememberme" type="checkbox" id="rememberme" value="forever">  se rapeller </p>

                                            </div>
                                            <br><br>
                                                <input type="submit" class="button-btn" name="login" value="Se connecter" >
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
