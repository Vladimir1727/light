<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Тестовое задание</title>
    <link rel="stylesheet" href="/css/bootstrap.min.css">
    <link rel="stylesheet" href="/css/style.css">
</head>
<body>
<script src="/js/jquery-2.0.0.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
<h1 class="h2 text-center">Форум</h1>
<section class="text-center">
    <?php include 'view/'.$content_view; ?>
</section>
<main class="panel panel-default">
    <div class="panel-body" id="desk">
        
    </div>
</main>

<footer>
    <p class="text-center">
        <span class="glyphicon glyphicon-copyright-mark"></span>
        Diamandy production
    </p>
</footer>

<script src="/js/script.js"></script>
</body>
</html>