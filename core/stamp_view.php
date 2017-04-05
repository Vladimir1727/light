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
    <?php //echo '>'.$_SERVER['DOCUMENT_ROOT'].'<';?>
<script>
  window.fbAsyncInit = function() {
    FB.init({
      appId      : '1309787865753613',
      xfbml      : true,
      version    : 'v2.8'
    });
    FB.AppEvents.logPageView();
    
FB.getLoginStatus(function(response) {
    console.log(response.status);
  if (response.status === 'connected') {
    // the user is logged in and has authenticated your
    // app, and response.authResponse supplies
    // the user's ID, a valid access token, a signed
    // request, and the time the access token 
    // and signed request each expire
    var uid = response.authResponse.userID;
    var accessToken = response.authResponse.accessToken;
  } else if (response.status === 'not_authorized') {
    // the user is logged in to Facebook, 
    // but has not authenticated your app
  } else {
    // the user isn't logged in to Facebook.
  }
 });    
    
    
  };

  (function(d, s, id){
     var js, fjs = d.getElementsByTagName(s)[0];
     if (d.getElementById(id)) {return;}
     js = d.createElement(s); js.id = id;
     js.src = "//connect.facebook.net/en_US/sdk.js";
     fjs.parentNode.insertBefore(js, fjs);
   }(document, 'script', 'facebook-jssdk'));
   

</script>
<script src="/js/jquery-2.0.0.min.js"></script>
<script src="/js/bootstrap.min.js"></script>
<script src="/js/verify.js"></script>
<h1 class="h2 text-center">Форум</h1>
<section class="text-center">
    <?php include 'view/'.$content_view; ?>
</section>
<main class="panel panel-default">
    <div class="panel-body">
        
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