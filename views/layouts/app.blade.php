<!DOCTYPE html>
<html>
<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<meta name="description" content="Este portal permite a los usuarios obtener acceso por sí solos a los mejores servicios de TI.">
	<meta name="og:title" property="og:title" content="Service management IT">
	<title>Service management</title>

	<!-- FRAMEWORK CSS -->
	<link rel="stylesheet" href='@asset("css/uikit.min.css")' />
    <script src='@asset("js/uikit.min.js")'></script>
    <script src='@asset("js/uikit-icons.min.js")'></script>

    <!-- FUENTE -->
    <style type="text/css">
	@font-face {
	  font-family: "Bebas";
	  src: src('@asset("font/Bebas-Regular.ttf")');
	}
	* { font-family: "Bebas" !important;  }
	.text-white { color: white; }
    </style>
    <!-- FAVICON -->
    <link rel="shorcut icon" href='@asset("img/favicon.ico")' type="image/x-icon">
</head>
<body>
	<main class="uk-section">
		@yield('main')
	</main>
	<footer>
		@yield('footer')
	</footer>
</body>