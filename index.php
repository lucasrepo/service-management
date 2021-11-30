<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Este portal permite a los usuarios obtener acceso por sí solos a los mejores servicios de TI.">
	<meta name="og:title" property="og:title" content="Service management IT">
	<title>Service management</title>

	<!-- FRAMEWORK CSS -->
	<link rel="stylesheet" href="css/uikit.min.css" />
    <script src="js/uikit.min.js"></script>
    <script src="js/uikit-icons.min.js"></script>

    <!-- FUENTE -->
    <style type="text/css">
	@font-face {
	  font-family: "Bebas";
	  src: src("font/Bebas-Regular.ttf");
	}
	* { font-family: "Bebas" !important;  }
	.text-white { color: white; }
    </style>
    <!-- FAVICON -->
    <link rel="shorcut icon" href="img/favicon.ico" type="image/x-icon">
</head>
<body>
	<div class="uk-section">
		<div class="uk-container" uk-filter="target: .js-filter; animation: fade">
			<h2 class="uk-h1 uk-text-center">Gestión de servicios</h2>
			<p class="uk-text-center">Este portal permite a los usuarios obtener acceso por sí solos a los mejores servicios de TI.</p>

			<!-- OPCIONES -->
			<div>
				<ul class="uk-subnav uk-subnav-pill">
					<li class="uk-active" uk-filter-control><a href="#">Todo</a></li>
					<?php

					$content = json_decode(file_get_contents('json/content.json'), true);

					foreach ($content as $user) {
						echo '
							<li uk-filter-control=".tag-'.str_replace(" ", "", $user["tag"]).'" style="margin: 2px;"><a href="#">'.$user["tag"].'</a></li>
						';
					}
					?>
			    </ul>
			</div>
			<!-- END OPCIONES -->

			<!-- START FILTER -->
			<div class="uk-child-width-1-3@m uk-child-width-1-2@s uk-grid-match uk-text-center uk-margin-medium-top js-filter" uk-grid>
				<?php
				
				$i=0;

				foreach ($content as $user) {

					echo '
					<div class="tag-'.str_replace(" ", "", $user["tag"]).'">
						<div class="uk-card uk-card-default uk-box-shadow-medium uk-card-hover uk-card-body uk-inline uk-transition-toggle">
							<div class="uk-card-badge uk-label">'.$user["tag"].'</div>
							<div class="uk-flex-last@s uk-card-media-center uk-cover-container">
						        <img src="img/'.$user["tag"].'-dev.jpg" alt="'.$user["tag"].'" uk-cover>
						        <canvas width="600" height="400"></canvas>
						        <div class="uk-transition-slide-bottom uk-position-bottom uk-overlay uk-overlay-default">
					                <div class="uk-margin-remove uk-align-center">
					                <button class="uk-button uk-button-default" uk-toggle="modal-'.$i.'">Ver más</button>
					                </div>

					                <div id="modal-'.$i.'" uk-modal>
									    <div class="uk-modal-dialog uk-modal-body">
									        <button class="uk-modal-close-full uk-close-large" type="button" uk-close></button>
									        <div class="uk-grid-collapse uk-text-center uk-margin uk-flex-center" uk-grid>
									            <div class="uk-padding-large uk-text-emphasis">
									                <h1>'.$user["name"].'</h1>
									                <p>'.$user["description"].'</p>';
												
									            /* COMIENZA LISTADO DE LENGUAJES */
												if(null !== $user["language"])
												{	
													echo '<div>';
													foreach($user["language"] as $lang){
														echo '<span class="uk-label uk-label-success" style="margin-right: 2px">'.$lang.'</span>';
													}

													echo '</div>';
									       		}
									       		/* TERMINA LISTADO DE LENGUAJES */

									        echo '</div><div class="uk-align-center">';

					/* Lista con los links de las redes sociales */
                    $social_media = array("whatsapp" => "https://wa.me/", "telegram" => "https://www.t.me/", "discord" => "https://discordapp.com/channels/@me/", "mail" => "mailto:", "google"=>"https://", "linkedin" => "https://www.linkedin.com/in/", "facebook" => "https://facebook.com/", "github" => "https://github.com/", "instagram" => "https://instagram/", "twitter" => "https://twitter.com/", "youtube" => "https://www.youtube.com/user/", "reddit" => "https://www.reddit.com/user/");

                    /* CONTACTOS */
					foreach ($user["contact"] as $contact => $value) {
						if(strcmp($contact, "telegram") == 0){
							echo '<a href="https://www.t.me/'.$value.'" class="uk-margin-right" target=”_blank” rel="nofollow"><img src="img/telegram-icon.png" width="20" height="20"></img></a>';
						}else if(null !== $contact){
							foreach ($social_media as $app => $link) {
								if(strcmp($contact, $app) == 0){
									echo '<a href="'.$link.$value.'" class="uk-margin-right" uk-icon="icon: '.$app.'" target=”_blank” rel="nofollow"></a>';
								}
							}
						}
					}
					/* FINALIZA CONTACTOS */

					echo '						</div>
									        </div>
									    </div>
									</div>

					            </div>
						    </div>
							<a class="uk-position-cover" uk-toggle="target: #modal-'.$i.'"></a>
							<h3 class="uk-card-title uk-margin">'.$user["name"].'</h3>
							<p>'.substr($user["description"], 0, 120).'...</p>
						</div>

					</div>
					';
					$i++;
				}

				?>
			</div>
			<!-- END FILTER -->
		</div>
	</div>
	<div class="uk-text-center uk-text-muted uk-padding-small"><span>¿Quieres aparecer en la menú?</span> <a class="uk-text-bold uk-link-reset" href="#" rel="nofollow" target=”_blank” uk-tooltip="title: Whatsapp; pos: right; delay: 500">¡Contáctanos!</a></div>
</body>
</html>