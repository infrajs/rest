{html:}
<html>
	<head>
		<title>REST сервис infrajs/catalog</title>
		<!-- Последняя компиляция и сжатый CSS -->  
		<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
		<!-- Последняя компиляция и сжатый JavaScript -->  
		<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
		<script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha256-hwg4gsxgFZhOsEEamdOYGBf13FyQuiTwlAQgxVSNgt4=" crossorigin="anonymous"></script>
	</head>
	<body>
	<div class="container" style="margin-top:50px">
		<ul class="breadcrumb">
			{crumbs::li}
		</ul>
		{li:}{active?:liactive?:lijust}
		{lijust:}<li><a href="/{href}">{title}</a></li>
		{liactive:}<li class="active">{title}</li>
{/html:}
	</div></body></html>
{page:}
	{:html}
	<div id="page"></div>
	{:/html}