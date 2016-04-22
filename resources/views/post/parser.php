<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title></title>
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js" type="text/javascript" charset="utf-8" ></script>
    <script src="http://ajax.googleapis.com/ajax/libs/angularjs/1.3.14/angular.min.js"></script>
    <script src="/js/angularjs/controller.js"></script>
    <link rel="stylesheet" href="http://jqueryui.com/resources/demos/style.css">
    <link href="/css/app.css" rel="stylesheet">
    <link href="/css/main.css" rel="stylesheet">
    <link rel="shortcut icon" href="/images/favicon.ico" type="image/x-icon">
</head>
<style>
    #generate-link-selection {
        background: #6abde1;
        color: #fff;
        margin: 5px;
        padding: 4px;
        display: inline-block;
        cursor: pointer;
    }
    .del-button {
        padding: 3px 5px 7px;
        margin: 3px 0;
        border: 1px solid;
        border-radius: 11px;
        float: right;
        color: #6abde1;
        font-size: 24px;
        font-family: Arial, sans-serif;
        line-height: 7px;
        vertical-align: middle;
        cursor: pointer;
    }
    .pages-pagination {
        width: 200px;
    }
</style>
<body>
<div class="row">
    <div class="col-md-10 col-md-offset-1">
        <div class="panel panel-default">
            <form id="form-parser" action="handler.php">
                <p><input id="base-url" type="text" name="base_url" placeholder="базовый url"><Br>
                    <div class="pages-pagination">
                        <input id="first-select" type="text" name="pages_pagination" placeholder="первая страница выборки">
                    </div>
                    <div class="pages-pagination">
                        <input id="last-select" type="text" name="pages_pagination" placeholder="последняя страница выборки">
                    </div>
                    <div class="pages-pagination">
                        <input id="remaining-part" type="text" name="pages_pagination" placeholder="оставшееся часть ссылки">
                    </div>
                    <div id="generate-link-selection">сформировать</div>
                <p><input type="submit"></p>
            </form>
        </div>
    </div>
</div>
<script type="text/javascript">
    (function ($) {
        $(document).ready(function(){
            $( "#generate-link-selection" ).on('click', function() {
                var base_url = document.getElementById("base-url").value;
                var start_loop = document.getElementById("first-select").value;
                var last_loop = document.getElementById("last-select").value;
                var remaining_part = document.getElementById("remaining-part").value;

                for (var i = last_loop; i => start_loop; i--) {
                    $('#first-select').after(function() {
                        return '<div class="pages-pagination"><input id="' + i + '-select" type="text" name="pages_pagination" value="' + i + '"><div class="del-button">-</div></div>'
                    });
                };
            });
            /*$(document).on("click",".del-button",function(){
                $(this).parent().remove();
            });*/
        });
    }(jQuery));
</script>
</body>
</html>