<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Rechercher une information</title>
	<!-- core:css -->
	<link rel="stylesheet" href="/assets/vendors/core/core.css">
	<!-- endinject -->
	<!-- plugin css for this page -->
	<link rel="stylesheet" href="/assets/vendors/prismjs/themes/prism.css">
	<!-- end plugin css for this page -->
	<!-- inject:css -->
	<link rel="stylesheet" href="/assets/fonts/feather-font/css/iconfont.css">
	<link rel="stylesheet" href="/assets/vendors/flag-icon-css/css/flag-icon.min.css">
	<!-- endinject -->
  <!-- Layout styles -->  
	<link rel="stylesheet" href="/assets/css/demo_5/style.css">
  <!-- End layout styles -->
  <link rel="shortcut icon" href="/assets/images/favicon.png" />
</head>
<body>
	<div class="main-wrapper">

		<!-- partial:partials/_navbar.html -->
		<div class="horizontal-menu">
			<nav class="navbar top-navbar">
				<div class="container">
					<div class="navbar-content">
						<a href="{{ url('/Home') }}" class="navbar-brand">
							Mada<span>News</span>
						</a>
						<ul class="navbar-nav">
							<li class="nav-item dropdown nav-profile">
								<a class="nav-link dropdown-toggle" href="#" id="profileDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
									Profile		
								</a>
								<div class="dropdown-menu" aria-labelledby="profileDropdown">
									<div class="dropdown-body">
										<ul class="profile-nav p-0 pt-3">
											<li class="nav-item">
												<a href="{{ url('/Logout') }}" class="nav-link">
													<i data-feather="log-out"></i>
													<span>Déconnexion</span>
												</a>
											</li>
										</ul>
									</div>
								</div>
							</li>
						</ul>
						<button class="navbar-toggler navbar-toggler-right d-lg-none align-self-center" type="button" data-toggle="horizontal-menu-toggle">
							<i data-feather="menu"></i>					
						</button>
					</div>
				</div>
			</nav>
			<nav class="bottom-navbar">
				<div class="container">
					<ul class="nav page-navigation">
						<li class="nav-item">
							<a class="nav-link" href="{{ url('/Home') }}">
								<i class="link-icon" data-feather="box"></i>
								<span class="menu-title">Accueil</span>
							</a>
						</li>
						<li class="nav-item">
							<a href="{{ url('/ToSearch') }}" class="nav-link">
								<i class="link-icon" data-feather="search"></i>
								<span class="menu-title">Rechercher</span>
							</a>
						</li>
					</ul>
				</div>
			</nav>
		</div>
		<!-- partial -->
	
		<div class="page-wrapper">

			<div class="page-content">
				<div class="row">
					<div class="col-xl-10 main-content pl-xl-4 pr-xl-5">
						<div class="card mb-3">
                            <div class="row no-gutters">
                                <div class="col-md-12">
                                    <div class="card-body">
                                      <h3 class="page-title text-muted">RECHERCHE</h3>
                                      <p class="card-text">Recherchez un article, un éditorial, une chronique, une vidéo ou une archive parmi l’ensemble des publications du journal. Nos pages archives sont également disponibles pour une consultation par date.</p>
                                      <hr style="border: 2px solid #6c757d;"/>
                                      <h4 class="page-title">Saisissez votre recherche</h4><br>
									  <form action="/Search" method="POST" class="forms-sample">
                                    {{ csrf_field() }}
									<div class="form-group">
										<label for="exampleInputUsername1">Catégorie</label>
										<input type="text" name="categorie" class="form-control" id="exampleInputUsername1" autocomplete="off" placeholder="Catégorie">
									</div>
									<div class="form-group">
										<label for="exampleInputEmail1">Un texte</label>
										<textarea class="form-control" name="texte" rows="6"></textarea>
									</div>
                                    <h5 class="card-text text-muted">Chercher à partir de dates</h5><br>
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="control-label">Instant 1</label>
                                                <input type="datetime-local" name="publish_at_1" class="form-control">
                                            </div>
                                        </div><!-- Col -->
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label class="control-label">Instant 2</label>
                                                <input type="datetime-local" name="publish_at_2" class="form-control">
                                            </div>
                                        </div><!-- Col -->
                                    </div><!-- Row -->
									<button type="submit" class="btn btn-primary mr-2">Rechercher</button>
								</form>
                                    </div>

                                </div>
                            </div>
                            @if(!empty($liste_article))
                            <div class="row no-gutters">
                                <div class="col-md-12">
                                    <div class="card-body">
                                    <hr/>
                                    <h4 class="page-title text-muted">Résultats</h4>
                                    <hr style="border: 2px solid #6c757d;"/><br>
                                    @foreach($liste_article as $article)
                                          <!-- <h6 class="card-subtitle mb-2 text-muted">Enquete</h6> -->
                                          <h5 class="card-title">{{ $article->titre }}</h5>
                                          <p class="card-text">{{ $article->resume }}</p>
                                          <p class="card-text"> <small class="text-muted">Publié le : {{ $article->getPublication()->publish_at}}     Modifié le : {{ $article->getPublication()->update_at }}</small>       <small>Laurent Lefevre</small></p>
                                          <a class="btn btn-outline-primary btn-icon-text mb-2 mb-md-0" href="{{ url('/Details') }}/{{ $article->getSlugtitle() }}_{{ $article->id }}.html" role="button">détails</a>
                                          <hr/>
                                    @endforeach
								
									<br>{!! $links !!}
                                    </div>

                                </div>
                            </div>
                            @endif
                          </div>
                    </div>
                </div>
				</div>
				</div>
			</div>

			<!-- partial:partials/_footer.html -->
			<footer class="footer d-flex flex-column flex-md-row align-items-center justify-content-between">
				<p class="text-muted text-center text-md-left">Copyright © 2020 <a href="https://www.nobleui.com" target="_blank">NobleUI</a>. All rights reserved</p>
				<p class="text-muted text-center text-md-left mb-0 d-none d-md-block">Handcrafted With <i class="mb-1 text-primary ml-1 icon-small" data-feather="heart"></i></p>
			</footer>
			<!-- partial -->
	
		</div>
	</div>

	<!-- core:js -->
	<script src="/assets/vendors/core/core.js"></script>
	<!-- endinject -->
	<!-- plugin js for this page -->
	<script src="/assets/vendors/prismjs/prism.js"></script>
	<script src="/assets/vendors/clipboard/clipboard.min.js"></script>
	<!-- end plugin js for this page -->
	<!-- inject:js -->
	<script src="/assets/vendors/feather-icons/feather.min.js"></script>
	<script src="/assets/js/template.js"></script>
	<!-- endinject -->
	<!-- custom js for this page -->
	<!-- end custom js for this page -->
</body>
</html>