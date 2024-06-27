<!DOCTYPE html>
<html lang="en">
<?php

session_start(); // временная сессия
error_reporting(0); // скрыть неопределенный индекс
include("includes/db.php");
if(isset($_POST['submit'] )) // если нажата кнопка отправки
{
     if(empty($_POST['firstname']) ||  // получаем и проверяем, пустые ли они
   	    empty($_POST['lastname'])|| 
		empty($_POST['email']) ||  
		empty($_POST['phone'])||
		empty($_POST['password'])||
		empty($_POST['cpassword']) ||
		empty($_POST['cpassword']))
		{
			$message = "Все поля обязательны для заполнения!";
		}
	else
	{
		// проверка на существующие имя пользователя и электронную почту
	$check_username= mysqli_query($db, "SELECT username FROM users where username = '".$_POST['username']."' ");
	$check_email = mysqli_query($db, "SELECT email FROM users where email = '".$_POST['email']."' ");
		

	
	if($_POST['password'] != $_POST['cpassword']){  // сравниваем пароли
       	$message = "Пароль не совпадает";
    }
	elseif(strlen($_POST['password']) < 6)  // проверка длины пароля
	{
		$message = "Пароль должен быть >=6";
	}
	elseif(strlen($_POST['phone']) < 10)  // проверка длины номера телефона
	{
		$message = "Недопустимый номер телефона!";
	}

    elseif (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) // проверка электронной почты
    {
       	$message = "Недопустимый адрес электронной почты, введите действительный адрес!";
    }
	elseif(mysqli_num_rows($check_username) > 0)  // проверка имени пользователя
     {
    	$message = 'Имя пользователя уже существует!';
     }
	elseif(mysqli_num_rows($check_email) > 0) // проверка электронной почты
     {
    	$message = 'Электронная почта уже существует!';
     }
	else{
       
	 // вставка значений в базу данных
	$mql = "INSERT INTO users(username,f_name,l_name,email,phone,password,address) VALUES('".$_POST['username']."','".$_POST['firstname']."','".$_POST['lastname']."','".$_POST['email']."','".$_POST['phone']."','".md5($_POST['password'])."','".$_POST['address']."')";
	mysqli_query($db, $mql);
		$success = "Аккаунт успешно создан! <p>Вы будете перенаправлены через <span id='counter'>5</span> секунд(ы).</p>
														<script type='text/javascript'>
														function countdown() {
															var i = document.getElementById('counter');
															if (parseInt(i.innerHTML)<=0) {
																location.href = 'login.php';
															}
															i.innerHTML = parseInt(i.innerHTML)-1;
														}
														setInterval(function(){ countdown(); },1000);
														</script>'";
		
		
		
		
		 header("refresh:5;url=login.php"); // перенаправление после успешной вставки
    }
	}

}


?>


<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="#">
    <title>Шаблон для Bootstrap</title>
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animsition.min.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <!-- Custom styles for this template -->
    <link href="css/style.css" rel="stylesheet"> </head>
<body>
     
         <!--начало заголовка-->
         <header id="header" class="header-scroll top-header headrom">
            <!-- .navbar -->
            <nav class="navbar navbar-dark">
               <div class="container">
                  <button class="navbar-toggler hidden-lg-up" type="button" data-toggle="collapse" data-target="#mainNavbarCollapse">&#9776;</button>
                  <a class="navbar-brand" href="index.php"> <img class="img-rounded" src="images/food-pick.png" alt=""> </a>
                  <div class="collapse navbar-toggleable-md  float-lg-right" id="mainNavbarCollapse">
                     <ul class="nav navbar-nav">
							<li class="nav-item"> <a class="nav-link active" href="index.php">Главная <span class="sr-only">(текущая)</span></a> </li>
                            <li class="nav-item"> <a class="nav-link active" href="restaurants.php">Рестораны <span class="sr-only"></span></a> </li>
                            
							<?php
						if(empty($_SESSION["user_id"]))
							{
								echo '<li class="nav-item"><a href="login.php" class="nav-link active">Войти</a> </li>
							  <li class="nav-item"><a href="registration.php" class="nav-link active">Регистрация</a> </li>';
							}
						else
							{
									
									
										echo  '<li class="nav-item"><a href="your_orders.php" class="nav-link active">Ваши заказы</a> </li>';
									echo  '<li class="nav-item"><a href="logout.php" class="nav-link active">Выйти</a> </li>';
							}

						?>
							 
                        </ul>
                  </div>
               </div>
            </nav>
            <!-- /.navbar -->
         </header>
         <div class="page-wrapper">
            <div class="breadcrumb">
               <div class="container">
                  <ul>
                     <li><a href="#" class="active">
					  <span style="color:red;"><?php echo $message; ?></span>
					   <span style="color:green;">
								<?php echo $success; ?>
										</span>
					   
					</a></li>
                    
                  </ul>
               </div>
            </div>
            <section class="contact-page inner-page">
               <div class="container">
                  <div class="row">
                     <!-- РЕГИСТРАЦИЯ -->
                     <div class="col-md-8">
                        <div class="widget">
                           <div class="widget-body">
                              
							  <form action="" method="post">
                                 <div class="row">
								  <div class="form-group col-sm-12">
                                       <label for="exampleInputEmail1">Имя пользователя</label>
                                       <input class="form-control" type="text" name="username" id="example-text-input" placeholder="Имя пользователя"> 
                                    </div>
                                    <div class="form-group col-sm-6">
                                       <label for="exampleInputEmail1">Имя</label>
                                       <input class="form-control" type="text" name="firstname" id="example-text-input" placeholder="Имя"> 
                                    </div>
                                    <div class="form-group col-sm-6">
                                       <label for="exampleInputEmail1">Фамилия</label>
                                       <input class="form-control" type="text" name="lastname" id="example-text-input-2" placeholder="Фамилия"> 
                                    </div>
                                    <div class="form-group col-sm-6">
                                       <label for="exampleInputEmail1">Адрес электронной почты</label>
                                       <input type="text" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Введите адрес электронной почты"> <small id="emailHelp" class="form-text text-muted">Мы никогда не передадим вашу электронную почту кому-либо еще.</small> 
                                    </div>
                                    <div class="form-group col-sm-6">
                                       <label for="exampleInputEmail1">Номер телефона</label>
                                       <input class="form-control" type="text" name="phone" id="example-tel-input-3" placeholder="Телефон"> <small class="form-text text-muted">Мы никогда не передадим вашу электронную почту кому-либо еще.</small> 
                                    </div>
                                    <div class="form-group col-sm-6">
                                       <label for="exampleInputPassword1">Пароль</label>
                                       <input type="password" class="form-control" name="password" id="exampleInputPassword1" placeholder="Пароль"> 
                                    </div>
                                    <div class="form-group col-sm-6">
                                       <label for="exampleInputPassword1">Повторите пароль</label>
                                       <input type="password" class="form-control" name="cpassword" id="exampleInputPassword2" placeholder="Пароль"> 
                                    </div>
									 <div class="form-group col-sm-12">
                                       <label for="exampleTextarea">Адрес доставки</label>
                                       <textarea class="form-control" id="exampleTextarea"  name="address" rows="3"></textarea>
                                    </div>
                                   
                                 </div>
                                
                                 <div class="row">
                                    <div class="col-sm-4">
                                       <p> <input type="submit" value="Регистрация" name="submit" class="btn theme-btn"> </p>
                                    </div>
                                 </div>
                              </form>
                           
						   </div>
                           <!-- end: Widget -->
                        </div>
                        <!-- /РЕГИСТРАЦИЯ -->
                     </div>
                     <!-- ПОЧЕМУ? -->
                     <div class="col-md-4">
                        <h4>Регистрация быстрая, простая и бесплатная.</h4>
                        <p>После регистрации вы сможете:</p>
                        <hr>
                        <img src="http://placehold.it/400x300" alt="" class="img-fluid">
                        <p></p>
                        <div class="panel">
                           <div class="panel-heading">
                              <h4 class="panel-title"><a data-parent="#accordion" data-toggle="collapse" class="panel-toggle collapsed" href="#faq1" aria-expanded="false"><i class="ti-info-alt" aria-hidden="true"></i>Могу ли я viverra sit amet quam eget lacinia?</a></h4>
                           </div>
                           <div class="panel-collapse collapse" id="faq1" aria-expanded="false" role="article" style="height: 0px;">
                              <div class="panel-body"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam rutrum ut erat a ultricies. Phasellus non auctor nisi, id aliquet lectus. Vestibulum libero eros, aliquet at tempus ut, scelerisque sit amet nunc. Vivamus id porta neque, in pulvinar ipsum. Vestibulum sit amet quam sem. Pellentesque accumsan consequat venenatis. Pellentesque sit amet justo dictum, interdum odio non, dictum nisi. Fusce sit amet turpis eget nibh elementum sagittis. Nunc consequat lacinia purus, in consequat neque consequat id. </div>
                           </div>
                        </div>
                        <!-- end:panel -->
                        <div class="panel">
                           <div class="panel-heading">
                              <h4 class="panel-title"><a data-parent="#accordion" data-toggle="collapse" class="panel-toggle" href="#faq2" aria-expanded="true"><i class="ti-info-alt" aria-hidden="true"></i>Могу ли я viverra sit amet quam eget lacinia?</a></h4>
                           </div>
                           <div class="panel-collapse collapse" id="faq2" aria-expanded="true" role="article">
                              <div class="panel-body"> Lorem ipsum dolor sit amet, consectetur adipiscing elit. Etiam rutrum ut erat a ultricies. Phasellus non auctor nisi, id aliquet lectus. Vestibulum libero eros, aliquet at tempus ut, scelerisque sit amet nunc. Vivamus id porta neque, in pulvinar ipsum. Vestibulum sit amet quam sem. Pellentesque accumsan consequat venenatis. Pellentesque sit amet justo dictum, interdum odio non, dictum nisi. Fusce sit amet turpis eget nibh elementum sagittis. Nunc consequat lacinia purus, in consequat neque consequat id. </div>
                           </div>
                        </div>
                        <!-- end:Panel -->
                        <h4 class="m-t-20">Свяжитесь с поддержкой клиентов</h4>
                        <p> Если вам нужна дополнительная помощь или у вас есть вопрос, </p>
                        <p> <a href="contact.html" class="btn theme-btn m-t-15">свяжитесь с нами</a> </p>
                     </div>
                     <!-- /ПОЧЕМУ? -->
                  </div>
               </div>
            </section>
            <section class="app-section">
               <div class="app-wrap">
                  <div class="container">
                     <div class="row text-img-block text-xs-left">
                        <div class="container">
                           <div class="col-xs-12 col-sm-6  right-image text-center">
                              <figure> <img src="images/app.png" alt="Right Image"> </figure>
                           </div>
                           <div class="col-xs-12 col-sm-6 left-text">
                              <h3>Лучшее приложение для доставки еды</h3>
                              <p>Теперь вы можете заказать еду практически откуда угодно благодаря бесплатному и простому в использовании приложению для доставки еды.</p>
                              <div class="social-btns">
                                 <a href="#" class="app-btn apple-button clearfix">
                                    <div class="pull-left"><i class="fa fa-apple"></i> </div>
                                    <div class="pull-right"> <span class="text">Доступно в</span> <span class="text-2">App Store</span> </div>
                                 </a>
                                 <a href="#" class="app-btn android-button clearfix">
                                    <div class="pull-left"><i class="fa fa-android"></i> </div>
                                    <div class="pull-right"> <span class="text">Доступно в</span> <span class="text-2">Play Store</span> </div>
                                 </a>
                              </div>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </section>
            <!-- начало: ПОДВАЛ -->
            <footer class="footer">
               <div class="container">
                  <!-- верхний подвал -->
                  <div class="row top-footer">
                     <div class="col-xs-12 col-sm-3 footer-logo-block color-gray">
                        <a href="#"> <img src="images/food-picky-logo.png" alt="Footer logo"> </a> <span>Заказать доставку и забрать </span> 
                     </div>
                     <div class="col-xs-12 col-sm-2 about color-gray">
                        <h5>О нас</h5>
                        <ul>
                           <li><a href="#">О нас</a> </li>
                           <li><a href="#">История</a> </li>
                           <li><a href="#">Наша команда</a> </li>
                           <li><a href="#">Мы нанимаем</a> </li>
                        </ul>
                     </div>
                     <div class="col-xs-12 col-sm-2 how-it-works-links color-gray">
                        <h5>Как это работает</h5>
                        <ul>
                           <li><a href="#">Укажите ваше местоположение</a> </li>
                           <li><a href="#">Выберите ресторан</a> </li>
                           <li><a href="#">Выберите блюдо</a> </li>
                           <li><a href="#">Оплатите кредитной картой</a> </li>
                           <li><a href="#">Ждите доставки</a> </li>
                        </ul>
                     </div>
                     <div class="col-xs-12 col-sm-2 pages color-gray">
                        <h5>Страницы</h5>
                        <ul>
                           <li><a href="#">Страница результатов поиска</a> </li>
                           <li><a href="#">Страница регистрации пользователя</a> </li>
                           <li><a href="#">Страница заказа</a> </li>
                           <li><a href="#">Подтверждение заказа</a> </li>
                           <li><a href="#">Контакты</a> </li>
                        </ul>
                     </div>
                     <div class="col-xs-12 col-sm-3 popular-locations color-gray">
                        <h5>Популярные места</h5>
                        <ul>
                           <li><a href="#">Питер</a> </li>
                           <li><a href="#">Москва</a> </li>
                           <li><a href="#">Ростов-на-Дону</a> </li>
                           <li><a href="#">Екатеринбург</a> </li>
                           <li><a href="#">Краснодар</a> </li>
                           <li><a href="#">Владивосток</a> </li>
                           <li><a href="#">Новосибирск</a> </li>
                           <li><a href="#">Сочи</a> </li>
                        </ul>
                     </div>
                  </div>
                  <!--/ верхний подвал -->
                  <div class="row bottom-footer">
                     <div class="container">
                        <div class="row">
                           <div class="col-xs-12 col-sm-3 payment-options color-gray">
                              <h5>Оплата</h5>
                              <ul>
                                 <li>
                                    <a href="#"><img src="images/paypal.png" alt="Paypal"> </a>
                                 </li>
                                 <li>
                                    <a href="#"><img src="images/mastercard.png" alt="Mastercard"> </a>
                                 </li>
                                 <li>
                                    <a href="#"><img src="images/maestro.png" alt="Maestro"> </a>
                                 </li>
                                 <li>
                                    <a href="#"><img src="images/stripe.png" alt="Stripe"> </a>
                                 </li>
                                 <li>
                                    <a href="#"><img src="images/bitcoin.png" alt="Bitcoin"> </a>
                                 </li>
                              </ul>
                           </div>
                           <div class="col-xs-12 col-sm-4 address color-gray">
                              <h5>Адрес</h5>
                              <p> 1234 Street Name, City Name, United States <br> +91 123-456-7890 <br> <a href="mailto:info@foodpicky.com">info@foodpicky.com</a> </p>
                              <h5>Следите за нами на:</h5>
                              <div class="socials-footer">
                                 <a href="#"><i class="fa fa-facebook" aria-hidden="true"></i></a>
                                 <a href="#"><i class="fa fa-twitter" aria-hidden="true"></i></a>
                                 <a href="#"><i class="fa fa-google-plus" aria-hidden="true"></i></a>
                                 <a href="#"><i class="fa fa-pinterest-p" aria-hidden="true"></i></a>
                              </div>
                           </div>
                           <div class="col-xs-12 col-sm-5 additional-info color-gray">
                              <h5>Дополнительная информация</h5>
                              <p> Доставка еды и напитков 24/7 на дом от лучших ресторанов и заведений в вашем городе. </p>
                           </div>
                        </div>
                     </div>
                  </div>
               </div>
            </footer>
            <!-- конец: ПОДВАЛ -->
         </div>
         <!-- jQuery first, then Tether, then Bootstrap JS. -->
         <script src="js/jquery-min.js"></script>
         <script src="js/tether.min.js"></script>
         <script src="js/bootstrap.min.js"></script>
         <script src="js/animsition.js"></script>
         <script src="js/bootstrap-slider.min.js"></script>
         <script src="js/jquery.isotope.min.js"></script>
         <script src="js/headroom.js"></script>
         <script src="js/foodpicky.min.js"></script>
         <script src="js/jquery.mb.YTPlayer.min.js"></script>
         <script src="js/wow.min.js"></script>
         <!-- слайдер цены -->
         <script type="text/javascript">
            /* Example slider settings */
            var settings = {
                start: [0, 100],
                connect: true,
                step: 1,
                range: {
                    'min': 0,
                    'max': 100
                }
            };
            var slider = document.getElementById('price-slider');
            noUiSlider.create(slider, settings);
         </script>
         <!-- End -->
      </body>
</html>
