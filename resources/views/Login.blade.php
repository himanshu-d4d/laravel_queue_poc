<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Document</title>
</head>
<body style = "text-align:center; margin-top:100px">
<form method="post" action="index.html">
<div><h1>Login</h1></div>
<input type="email" name="email" value="email" onFocus="field_focus(this, 'email');" onblur="field_blur(this, 'email');" class="email" />
<input type="password" name="email" value="email" onFocus="field_focus(this, 'email');" onblur="field_blur(this, 'email');" class="email" /><br><br />
  
<a href="#" class="btn btn-info">Login</a> <!-- End Btn -->
<a href="ragister" class="btn btn-primary" >Ragister</a> <!-- End Btn2 -->
  
</form>
<br>
<h3>Login With Social link</h3>
<!-- <a href="fbsub" value = 'facebook' class = "btn btn-primary">Facebook</a>
<a href="linkSub" name = 'linkedin' class = "btn btn-info">linkedin</a>
<a href="googlesub" name = 'google' class = "btn btn-warning">Google</a> -->
<a href="fbsub"><img src ="{{url('social_image/Facebook.png')}}"  style = "height:40px"></a>
<a href="googlesub"><img src ="{{url('social_image/Google-plus-icon.png')}}"  style = "height:40px"></a>
<a href="linkSub"><img src ="{{url('social_image/linkedin_icon.jpg')}}"  style = "height:45px"></a>
<a href="instaSubmit"><img src ="{{url('social_image/instagram.png')}}"  style = "height:40px"></a>






</body>
</html>