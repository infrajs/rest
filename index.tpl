{html:}
<html>
	<head>
		<title>REST сервис infrajs/catalog</title>
		<!-- Последняя компиляция и сжатый CSS -->

		<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
		<!-- Последняя компиляция и сжатый JavaScript -->  
		<link rel="stylesheet" href="/-collect/?css"> 
		
		<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8=" crossorigin="anonymous"></script>
		<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
		<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
		
	</head>
	<body>
	<div class="container" style="margin-top:50px">
		<ul class="breadcrumb">
			{crumbs::li}
		</ul>
		{li:}{active?:liactive?:lijust}
		{lijust:}<li class="breadcrumb-item"><a href="/{href}">{title}</a></li>
		{liactive:}<li class="breadcrumb-item active">{title}</li>
{/html:}
	</div></body></html>
{page:}
	{:html}
	<div id="page"></div>
	{:/html}