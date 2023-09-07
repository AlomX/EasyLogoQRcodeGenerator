<!DOCTYPE html>
<html>
	<head>
		<meta charset="utf-8" />
		<meta name="viewport" content="initial-scale=1, maximum-scale=1">
		<title>Générer un QR code</title>
		<meta name="description" content="Générateur de QR code en ligne.">
		<meta name="author" content="Riparia Studio">
		<meta name="robots" content="index, follow">
		<meta name="googlebot" content="index, follow">
		<script src="./dist/easy.qrcode.min.js" type="text/javascript" charset="utf-8"></script>
		<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
	</head>

	<body>
		<div class="container">
			<div class="row justify-content-center">
				<div class="col-10 col-md-6 col-lg-4">
					<?php
					if (isset($_GET['url']) && $_GET['url'] != '') { ?>
						<div class="card mx-auto mt-4">
							<div class="card-img-top" id="qrcode"></div>
							<div class="card-body">
								<div class="d-grid gap-2">
								  	<a id="download" class="btn btn-primary" type="button" target="_blank">Télécharger</a>
								</div>
							</div>
						</div>
					<?php }else{ ?>
						<div class="card mx-auto mt-4">
							<div class="card-body">
								<div class="d-grid gap-2">
									<h5>Générateur de QR Code</h5>
									<form action="" method="get">
										<div class="input-group">
											<input type="text" class="form-control" placeholder="Votre URL" name="url">
											<button type="submit" class="btn btn-outline-secondary">Générer</button>
										</div>
										<!-- the logo switch -->
										<div class="form-check form-switch mt-2">
											<input class="form-check-input" type="checkbox" id="flexSwitchCheckDefault" name="logo" value="true" checked>
											<label class="form-check-label" for="flexSwitchCheckDefault">Ajouter le logo</label>
										</div>
									</form>
								</div>
							</div>
						</div>
						<div class="card mx-auto mt-4">
							<div class="card-body">
								<div class="d-grid gap-2">
									<b> Mettre en favoris </b>
								  	<div class="input-group">
									  <input type="text" class="form-control" value='javascript:void(location.href="http://qr.riparia-studio.com/?url="+encodeURIComponent(location.href));' readonly>
									  <button class="btn btn-outline-secondary" onclick="navigator.clipboard.writeText('javascript:void(location.href=\'http://qr.riparia-studio.com/?url=\'+encodeURIComponent(location.href));');alert('Le lien a été copié !')">Copier</button>
									</div>
									<p> À droite de la barre d'adresse, appuyez sur Menu&nbsp;<img src="//lh3.googleusercontent.com/oLoRPrHJd7m46sWijX6zBWnEnfslP62AxJSwt5Nj0bNbpaYHz2pyscExleiofsH2kQ=w36-h36" width="18" height="18" alt="Plus" title="Plus" data-mime-type="image/png" data-alt-src="//lh3.googleusercontent.com/oLoRPrHJd7m46sWijX6zBWnEnfslP62AxJSwt5Nj0bNbpaYHz2pyscExleiofsH2kQ">&nbsp;<img src="//lh3.googleusercontent.com/3_l97rr0GvhSP2XV5OoCkV2ZDTIisAOczrSdzNCBxhIKWrjXjHucxNwocghoUa39gw=w36-h36" width="18" height="18" alt="puis" title="puis" data-mime-type="image/png" data-alt-src="//lh3.googleusercontent.com/3_l97rr0GvhSP2XV5OoCkV2ZDTIisAOczrSdzNCBxhIKWrjXjHucxNwocghoUa39gw"> Ajouter cet onglet aux favoris&nbsp;<img src="//lh3.googleusercontent.com/sy4TrACPnJ7D6yByRl1M2xVliQ5nn2DFD9cVPA3w9iPH1WC8pKbtgDZLPbO-mpNDEBg=w36-h36" width="18" height="18" alt="Étoile" title="Étoile" data-mime-type="image/png" data-alt-src="//lh3.googleusercontent.com/sy4TrACPnJ7D6yByRl1M2xVliQ5nn2DFD9cVPA3w9iPH1WC8pKbtgDZLPbO-mpNDEBg">.
									</p>
									<a href="javascript:void(location.href=%22http://qr.riparia-studio.com/?url=%22+encodeURIComponent(location.href));" class="btn btn-primary color-white"><i class="fa fa-link" aria-hidden="true"></i> Générer un QR code</a>
									<p class="mb-0">
										Sur Ordinateur, faites glisser ce bouton sur la barre d'outils de votre navigateur. Un simple clic lors de la visite d'un site vous permettra de générer son QR code.
									</p>
								</div>
							</div>
						</div>
						<div class="mt-3 mx-3" style="text-align: justify;">
							<small>Compatible avec la plupart des navigateurs tant que vos favoris permettent le JavaScript. La barre d'outils des liens peut ne pas être visible dans la plupart des navigateurs, vous pouvez l'activer dans le menu <i>Favoris</i> → <i>Afficher la barre de favoris</i>. Ou en appuyant sur Ctrl + Maj + B .</small>
						</div>
					<?php } ?>
				</div>
			</div>
		</div>

		<?php if (isset($_GET['url']) && $_GET['url'] != '') { ?>
		<script type="text/javascript">
			// Url PHP to JS
			var url = "<?=$_GET['url'];?>";

			// QRcode option
			var config = {

				text: url, // Content

				width: 240, // Widht
				height: 240, // Height
				quietZone: 0,
				colorDark: "#000000", // Dark color
				colorLight: "#ffffff", // Light color

				<?php 
				$handle = curl_init("https://t2.gstatic.com/faviconV2?client=SOCIAL&type=FAVICON&fallback_opts=TYPE,SIZE,URL&url=".$_GET['url']."&size=128");
				curl_setopt($handle,  CURLOPT_RETURNTRANSFER, TRUE);

				/* Get the HTML or whatever is linked in $url. */
				$response = curl_exec($handle);

				/* Check for 404 (file not found). */
				$httpCode = curl_getinfo($handle, CURLINFO_HTTP_CODE);
				if($httpCode != 404) { ?>
					// === Logo
					<?php if (isset($_GET['logo']) && $_GET['logo'] == 'true') { ?>
						logo: "data:image/png;base64,<?=base64_encode(file_get_contents("https://t2.gstatic.com/faviconV2?client=SOCIAL&type=FAVICON&fallback_opts=TYPE,SIZE,URL&url=".$_GET['url']."&size=128"));?>", // LOGO
						logoWidth:80, 
						logoHeight:80,
						logoBackgroundColor: '#ffffff', // Logo backgroud color, Invalid when `logBgTransparent` is true; default is '#ffffff'
						logoBackgroundTransparent: false, // Whether use transparent image, default is false
					<?php } else { ?>
						logo: null, // No logo
					<?php } ?>
				<?php  
				}

				curl_close($handle);
				?>

				//crossOrigin: 'anonymous', // Add this if you have CORS "Access-Control-Allow-Origin" problems
				correctLevel: QRCode.CorrectLevel.H // L, M, Q, H

			};

			// Generate QRcode
			var t=new QRCode(document.getElementById("qrcode"), config);

			// Take name from url
			if(url.split("/")[url.split("/").length-1] == ''){
				var name = url.split("/")[url.split("/").length-2]
			}else{
				var name = url.substring(url.lastIndexOf("/") + 1);
			}

			// Get QRcode
			const canvas = document.getElementById('qrcode').children[0];

			// Add Class to canvas
			canvas.classList.add("position-relative","start-50","translate-middle-x");

			// You need a onclick event to take the last canvas generated with the inner logo
			document.getElementById('download').onclick = function(){
				// Link download button
				document.getElementById('download').setAttribute('href', canvas.toDataURL("image/png").replace("image/png", "image/octet-stream"))
				document.getElementById('download').setAttribute('download', 'QR_' + name + '.png');
			}
		</script>
		<?php } ?>

	</body>
</html>
