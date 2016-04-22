<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title> </title>

	<link href="<% asset('/css/app.css') %>" rel="stylesheet">
    <link href="/css/main.css" rel="stylesheet">
    <link href="/js/fancybox/jquery.fancybox.css" rel="stylesheet">

	<!-- Fonts -->
	<link href='//fonts.googleapis.com/css?family=Roboto:400,300' rel='stylesheet' type='text/css'>
    <link rel="shortcut icon" href="/images/favicon.ico" type="image/x-icon">
	<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
	<!--[if lt IE 9]>
		<script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
		<script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
	<![endif]-->
</head>
<body>
	<header>
		<nav class="navbar navbar-default">
			<div class="container-fluid">
				<div class="navbar-header">
					<button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
						<span class="sr-only">Toggle Navigation</span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<a id="logo-header" href="/"></a>
				</div>
				<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
					<ul class="nav navbar-nav">
						<li><a href="<% url('/') %>">Главная</a></li> 
						<li><a href="<% url('/posts/about-us') %>">О нас</a></li> 
						<li><a href="<% url('/posts/architects-and-designers') %>">Архитекторам и дизайнерам</a></li> 
						<li><a href="<% url('/news') %>">Новости</a></li> 
						<li><a href="<% url('/faqs') %>">Вопрос / Ответ</a></li> 
						<li><a href="<% url('/posts/delivery') %>">Доставка</a></li> 
						<li><a href="<% url('/posts/contacts') %>">Контакты</a></li>
					</ul>				
				</div>
				<div class="header-bottom">
				    {!! Form::open(array('route'=>'search', 'class'=>'search-form')) !!}
				    {!! Form::text('search', NULL, ['class'=>'search', 'placeholder' => 'ключевое слово']) !!}   
				    {!! Form::submit('Поиск', ['class'=>'btn btn-primary']) !!}
				    {!! Form::close() !!}
				    <span class="contacts-header">
				        +7 (978) 080 33 08,
                        +7 (978) 79 222 09,
                        e-mail: atrium-c@yandex.ru				    	
				    </span>					
				</div>
			</div>
		</nav>
	</header>
	<div class="wrapp-stock-info display-none">    
	    <div class="stock-info">
	        <div class="toggle-stock-info close-stock-info"></div>
	        <img src="/images/banner-10-2015_ru.jpg"> 	               
	    </div>
	    <div class="toggle-stock-info popap-stock-info"></div>        
	</div>	
    @yield('content')
    
    <footer class="footer">
        <div class="footer-wrapp">
            <div class="collapse navbar-collapse container-fluid">		    
			    <a id="logo-footer" href="/"></a>				
				<ul class="nav navbar-nav">
					<li><a href="<% url('/') %>">Главная</a></li> 
						<li><a href="<% url('/posts/about-us') %>">О нас</a></li> 
						<li><a href="<% url('/posts/architects-and-designers') %>">Архитекторам и дизайнерам</a></li> 
						<li><a href="<% url('/news') %>">Новости</a></li> 
						<li><a href="<% url('/faqs') %>">Вопрос / Ответ</a></li> 
						<li><a href="<% url('/posts/delivery') %>">Доставка</a></li> 
						<li><a href="<% url('/posts/contacts') %>">Контакты</a></li>
				    </ul>		    
				<div class="copirite">© 2015 Atrium. Все права защищены.</div>				
			</div>
        	
        </div>		
    </footer>
	<!-- Scripts -->
	<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
	<script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
	<script src="/js/fancybox/jquery.fancybox.pack.js"></script>
    <script src="/js/slick.min.js"></script>
    <script src="/js/castom.js"></script>
</body>
</html>
