<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="/js/ckeditor/ckeditor.js" type="text/javascript" charset="utf-8" ></script>
    <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.3.14/angular.min.js"></script>
    <script src="/js/angularjs/controller.js"></script>
    <link rel="stylesheet" href="http://jqueryui.com/resources/demos/style.css">
    <link href="/css/app.css" rel="stylesheet">
    <link href="/css/main.css" rel="stylesheet">
    <link rel="shortcut icon" href="/images/favicon.ico" type="image/x-icon">
</head>
<body>
    <div class="row">
        @include('menu-left-admin')
        <div class="col-md-10 col-md-offset-1">
            <div class="panel panel-default">

                @yield('content')

            </div>
        </div>
    </div>
    <script type="text/javascript">
        var element=document.getElementById('content');
        if(element){CKEDITOR.replace( 'content' );}
    </script>
</body>
</html>
