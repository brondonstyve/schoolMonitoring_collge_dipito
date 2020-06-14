<!-- Row -->
  <!-- Row -->
  <div class="row">
      <!-- Column -->
      <div class="col-lg-4 col-xlg-3 col-md-5">
          <!-- Column -->
          <div class="card">
                <img class="card-img-top" src="images/profile-bg.jpg" alt="Card image cap">
                <div class="card-body little-profile text-center">
                    <div class="pro-img">
                            <nav class="navbar top-navbar navbar-expand-md navbar-light">



                                    <ul class="navbar-nav mr-auto mt-md-0">

                                        <li class="nav-item dropdown mega-dropdown show">
                            <a href="" class="" data-toggle="dropdown">
                        <img src="images/9.jpg" alt="user">
                    </a>

                    <div class="dropdown-menu scale-up-left">
                            <ul class="mega-dropdown-menu row">
                                <li class="col-lg-9 col-xlg-3 m-b-30">
                                    <h4 class="m-b-20">{{ $utilisateur->nom }}</h4>
                                    <!-- CAROUSEL -->
                                    <div  class="carousel slide" data-ride="carousel">
                                        <div class="carousel-inner">
                                            <div class="carousel-item">
                                                <div class="container"> <img class="d-block img-fluid" src="images/10.jpg" alt="First slide"></div>
                                            </div>
                                            <div class="carousel-item active">
                                                <div class="container"><img class="d-block img-fluid" src="images/10.jpg" alt="Second slide"></div>
                                            </div>
                                            <div class="carousel-item">
                                                <div class="container"><img class="d-block img-fluid" src="images/10.jpg" alt="Third slide"></div>
                                            </div>
                                        </div>

                                        <form action="">
                                            <input type="file" class="image-upload" accept="image/*">
                                        </form>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </li>
                </ul>

            </nav>
                    </div>
                    <h3 class="m-b-0">Brondon Styve</h3>
                    <p>IAI <br> Genie logiciel</p>
                   <div class="row text-center m-t-20">
                        <div class="col-lg-4 col-md-4 m-t-20">
                            <h3 class="text-muted text-success">xx</h3><small>Articles</small>
                        </div>
                        <div class="col-lg-4 col-md-4 m-t-20">
                            <h3 class="text-muted text-success">23</h3><small>Followers</small>
                        </div>
                        <div class="col-lg-4 col-md-4 m-t-20">
                            <h3 class="text-muted text-success">xx</h3><small>Groupes</small>
                        </div>
                    </div>
                </div>
            </div>


          <!-- Column -->
      </div>
      <div class="col-lg-8 col-xlg-9 col-md-7">
          <div class="card">
              <!-- Nav tabs -->
              <ul class="nav nav-tabs profile-tab" role="tablist">

                  <li class="nav-item"> <a class="nav-link active" data-toggle="tab" href="#home" role="tab">Activité</a>
                  </li>

                  <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#profile" role="tab">Profile</a>
                  </li>
                  <li class="nav-item"> <a class="nav-link" data-toggle="tab" href="#settings" role="tab">Paramètres</a>
                  </li>
              </ul>
              <!-- Tab panes -->
              <div class="tab-content">
                  <div class="tab-pane active" id="home" role="tabpanel">
                      <div class="card-body">
                          <div class="profiletimeline">
                              <div class="sl-item">


                              </div>
                              <hr>
                              <div class="sl-item">
                                  <div class="sl-left"> <img src="images/1.jpg" alt="user" class="img-circle">
                                  </div>
                                  <div class="sl-right">
                                      <div> <a href="#" class="link">{{ $utilisateur->nom }}</a> <span class="sl-date"> en ligne </span>
                                          <div class="m-t-20 row">
                                              <div class="col-md-3 col-xs-12"><img src="images/img1.jpg" alt="user" class="img-responsive radius"></div>
                                              <div class="col-md-9 col-xs-12">
                                                  <p> Titr du blog si existant </p>
                                                  <a href="#" class="btn btn-success">
                                                      lire tout l'article</a>
                                              </div>
                                          </div>
                                          <div class="like-comm m-t-20"> <a href="javascript:void(0)" class="link m-r-10">2 commentaires</a>                                                            <a href="javascript:void(0)" class="link m-r-10"><i
                                                      class="fa fa-heart text-danger"></i>
                                                  5 j'aime</a> </div>
                                      </div>
                                  </div>
                              </div>
                              <hr>
                              <div class="sl-item">
                                  <div class="sl-left"> <img src="images/9.jpg" alt="user" class="img-circle">
                                  </div>
                                  <div class="sl-right">
                                      <div><a href="#" class="link">{{ $utilisateur->nom }}</a> <span class="sl-date">il y'a 5 min</span>
                                          <p class="m-t-10"> blablablablablablablablablablablablablablablablablablablablablablablablablablablablablablabla
                                              </p>
                                      </div>
                                  </div>
                                  <hr>
                                  <div class="sl-left"> <img src="images/9.jpg" alt="user" class="img-circle">
                                  </div>
                                  <div class="sl-right">
                                      <div><a href="#" class="link">{{ $utilisateur->nom }}</a> <span class="sl-date">il y'a 5 min</span>
                                          <p class="m-t-10"> blablablablablablablablablablablablablablablablablablablablablablablablablablablablablablabla
                                              </p>
                                      </div>
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
                  <!--second tab-->
                  <div class="tab-pane" id="profile" role="tabpanel">
                      <div class="card-body">
                          <div class="row">
                              <div class="col-md-3 col-xs-6 b-r"> <strong>Nom</strong>
                                  <p class="text-muted">{{ $utilisateur->nom }}</p>
                              </div>
                              <div class="col-md-2 col-xs-6 b-r"> <strong>Numéro</strong>
                                  <p class="text-muted">{{ $utilisateur->téléphone }}</p>
                              </div>
                              <div class="col-md-5 col-xs-6 b-r"> <strong>Email</strong>
                                  <p class="text-muted">{{ $utilisateur->email }}</p>
                              </div>
                              <div class="col-md-2 col-xs-6"> <strong>Vile</strong>
                                  <p class="text-muted">{{ $utilisateur->ville }}</p>
                              </div>
                          </div>
                          <hr>

                          <textarea name="" class="m-t-30" id="" cols="50" rows="10">
                                        jesuisblelelelelelelleleleeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeeblablablablablablablablablablablablablablablablablablablablablablablablablablablablablablablablblablablablablablablablablablablablablablablablablablablablablablablablablablablablablablablablablablabla


                          </textarea>

                      </div>
                  </div>
                  <div class="tab-pane" id="settings" role="tabpanel">
                      <div class="card-body">
                          <form action=" {{ route('compte_editP_path') }} " method="POST" class="form-horizontal form-material">

                            {{ csrf_field() }}
                            <div class="form-group">
                                  <label class="col-md-12">Nom</label>
                                  <div class="col-md-12">
                                      <input type="text" value="{{ $utilisateur->nom }}" name="nom" class="form-control form-control-line">
                                      {!! $errors->first('nom','<p style="color:red;">:message</p>') !!}
                                    </div>
                              </div>
                              <div class="form-group">
                                  <label for="example-email" class="col-md-12">Email</label>
                                  <div class="col-md-12">
                                      <input type="email"value="{{ $utilisateur->email }}" class="form-control form-control-line" name="email" id="example-email">
                                      {{ $errors->first('email','<p style="color:red;">:message</p>') }}
                                    </div>
                              </div>
                              <div class="form-group">
                                  <label class="col-md-12">mot de Passe</label>
                                  <div class="col-md-12">
                                      <input type="password" placeholder="************" class="form-control form-control-line" name="mdp">
                                      {{ $errors->first('mdp','<p style="color:red;">:message</p>') }}
                                    </div>
                              </div>


                              <div class="form-group">
                                  <label class="col-md-12">No téléphone</label>
                                  <div class="col-md-12">
                                      <input type="text"value="{{ $utilisateur->téléphone }}" class="form-control form-control-line" name="numero">
                                  </div>
                              </div>
                              </div>
                              <div class="form-group">
                                  <label class="col-sm-12">Selectioner la ville</label>
                                  <div class="col-sm-12">
                                      <select class="form-control form-control-line" name="ville">
                                        <option selected="selected">{{ $utilisateur->ville }}</option>
                                          <option>Yaoundé</option>
                                          <option>Bafoussam</option>
                                          <option>Douala</option>
                                          <option>Garoua</option>
                                          <option>Gaoundéré</option>
                                      </select>
                                  </div>


                                  <div class="form-group">
                                        <div class="col-sm-12">
                                            <input type="submit" class="btn btn-success" value="Modifier son profil">
                                        </div>
                                    </div>
                              </div>
                            </div>

                          </form>
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

