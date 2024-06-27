<!DOCTYPE html>
<html lang="ru">
<?php
include("includes/db.php");
error_reporting(0);
session_start();
?>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <meta name="description" content="">
    <meta name="author" content="">
    <link rel="icon" href="#">
    <title>Начальный шаблон для Bootstrap</title>
    <!-- Bootstrap core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <link href="css/font-awesome.min.css" rel="stylesheet">
    <link href="css/animsition.min.css" rel="stylesheet">
    <link href="css/animate.css" rel="stylesheet">
    <!-- Пользовательские стили для этого шаблона -->
    <link href="css/style.css" rel="stylesheet"> </head>

<body>
           <!--начало шапки-->
        <header id="header" class="header-scroll top-header headrom">
            <!-- .navbar -->
            <nav class="navbar navbar-dark">
                <div class="container">
                    <button class="navbar-toggler hidden-lg-up" type="button" data-toggle="collapse" data-target="#mainNavbarCollapse">&#9776;</button>
                    <a class="navbar-brand" href="index.php"> <img class="img-rounded" src="images/food-picky-logo.png" alt=""> </a>
                    <div class="collapse navbar-toggleable-md  float-lg-right" id="mainNavbarCollapse">
                        <ul class="nav navbar-nav">
                            <li class="nav-item"> <a class="nav-link active" href="index.php">Главная <span class="sr-only">(текущая)</span></a> </li>
                            <li class="nav-item"> <a class="nav-link active" href="restaurants.php">Рестораны <span class="sr-only"></span></a> </li>
                            
							<?php
						if(empty($_SESSION["user_id"]))
							{
								echo '<li class="nav-item"><a href="login.php" class="nav-link active">войти</a> </li>
							  <li class="nav-item"><a href="registration.php" class="nav-link active">регистрация</a> </li>';
							}
						else
							{
									
									
										echo  '<li class="nav-item"><a href="your_orders.php" class="nav-link active">ваши заказы</a> </li>';
									echo  '<li class="nav-item"><a href="logout.php" class="nav-link active">выйти</a> </li>';
							}

						?>
							 
                        </ul>
                    </div>
                </div>
            </nav>
            <!-- /.navbar -->
        </header>
        <div class="page-wrapper">
            <!-- верхние ссылки -->
            <div class="top-links">
                <div class="container">
                    <ul class="row links">
                       
                        <li class="col-xs-12 col-sm-4 link-item active"><span>1</span><a href="restaurants.php">Выберите ресторан</a></li>
                        <li class="col-xs-12 col-sm-4 link-item"><span>2</span><a href="#">Выберите любимую еду</a></li>
                        <li class="col-xs-12 col-sm-4 link-item"><span>3</span><a href="#">Закажите и оплатите онлайн</a></li>
                    </ul>
                </div>
            </div>
            <!-- end:Top links -->
            <!-- начало: Внутренний герой страницы -->
            <div class="inner-page-hero bg-image" data-image-src="images/img/res.jpeg">
                <div class="container"> </div>
                <!-- end:Container -->
            </div>
            <div class="result-show">
                <div class="container">
                    <div class="row">
                       
                       
                    </div>
                </div>
            </div>
            <!-- //результаты показа -->
            <section class="restaurants-page">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12 col-sm-5 col-md-5 col-lg-3">
                          
                          
                            <div class="widget clearfix">
                                <!-- /widget heading -->
                                <div class="widget-heading">
                                    <h3 class="widget-title text-dark">
                                 Популярные теги
                              </h3>
                                    <div class="clearfix"></div>
                                </div>
                                <div class="widget-body">
                                    <ul class="tags">
                                        <li> <a href="#" class="tag">
                                    Пицца
                                    </a> </li>
                                        <li> <a href="#" class="tag">
                                    Сэндвич
                                    </a> </li>
                                        <li> <a href="#" class="tag">
                                    Сэндвич
                                    </a> </li>
                                        <li> <a href="#" class="tag">
                                    Рыба 
                                    </a> </li>
                                        <li> <a href="#" class="tag">
                                    Десерт
                                    </a> </li>
                                        <li> <a href="#" class="tag">
                                    Салат
                                    </a> </li>
                                    </ul>
                                </div>
                            </div>
                            <!-- end:Widget -->
                        </div>
                        <div class="col-xs-12 col-sm-7 col-md-7 col-lg-9">
                            <div class="bg-gray restaurant-entry">
                                <div class="row">
								<?php $ress= mysqli_query($db,"select * from restaurant");
									      while($rows=mysqli_fetch_array($ress))
										  {
													
						
													 echo' <div class="col-sm-12 col-md-12 col-lg-8 text-xs-center text-sm-left">
															<div class="entry-logo">
																<a class="img-fluid" href="dishes.php?res_id='.$rows['rs_id'].'" > <img src="admin/Res_img/'.$rows['image'].'" alt="Логотип еды"></a>
															</div>
															<!-- end:Логотип -->
															<div class="entry-dscr">
																<h5><a href="dishes.php?res_id='.$rows['rs_id'].'" >'.$rows['title'].'</a></h5> <span>'.$rows['address'].' <a href="#">...</a></span>
																<ul class="list-inline">
																	<li class="list-inline-item"><i class="fa fa-check"></i> Мин. $ 10,00</li>
																	<li class="list-inline-item"><i class="fa fa-motorcycle"></i> 30 мин</li>
																</ul>
															</div>
															<!-- end:Описание записи -->
														</div>
														
														 <div class="col-sm-12 col-md-12 col-lg-4 text-xs-center">
																<div class="right-content bg-white">
																	<div class="right-review">
																		<div class="rating-block"> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star"></i> <i class="fa fa-star-o"></i> </div>
																		<p> 245 отзывов</p> <a href="dishes.php?res_id='.$rows['rs_id'].'" class="btn theme-btn-dash">Просмотреть меню</a> </div>
																</div>
																<!-- end:right info -->
															</div>';
										  }
						
						
						?>
                                    
                                </div>
                                <!--end:row -->
                            </div>
                         
                            
                                
                            </div>
                          
                          
                           
                        </div>
                    </div>
                </div>
            </section>
            <section class="app-section">
                <div class="app-wrap">
                    <div class="container">
                        <div class="row text-img-block text-xs-left">
                            <div class="container">
                                <div class="col-xs-12 col-sm-6 hidden-xs-down right-image text-center">
                                    <figure> <img src="images/app.png" alt="Правая картинка"> </figure>
                                </div>
                                <div class="col-xs-12 col-sm-6 left-text">
                                    <h3>Лучшее приложение для доставки еды</h3>
                                    <p>Теперь вы можете заказать еду практически откуда угодно благодаря бесплатному и простому в использовании приложению для доставки еды и заказа на вынос.</p>
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
            <!-- начало: ФУТЕР -->
            <footer class="footer">
                <div class="container">
                    <!-- верхний футер -->
                    <div class="row top-footer">
                        <div class="col-xs-12 col-sm-3 footer-logo-block color-gray">
                            <a href="#"> <img src="images/food-picky-logo.png" alt="Логотип в футере"> </a> <span>Заказ доставки и заказ на вынос </span> </div>
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
                                <li><a href="#">Введите ваше местоположение</a> </li>
                                <li><a href="#">Выберите ресторан</a> </li>
                                <li><a href="#">Выберите блюдо</a> </li>
                                <li><a href="#">Оплатите кредитной картой</a> </li>
                                <li><a href="#">Дождитесь доставки</a> </li>
                            </ul>
                        </div>
                        <div class="col-xs-12 col-sm-2 pages color-gray">
                            <h5>Страницы</h5>
                            <ul>
                                <li><a href="#">Страница результатов поиска</a> </li>
                                <li><a href="#">Страница регистрации пользователя</a> </li>
                                <li><a href="#">Ценовая страница</a> </li>
                                <li><a href="#">Сделать заказ</a> </li>
                                <li><a href="#">Добавить в корзину</a> </li>
                            </ul>
                        </div>
                        <div class="col-xs-12 col-sm-3 popular-locations color-gray">
                            <h5>Популярные местоположения</h5>
                            <ul>
                                <li><a href="#">Сараево</a> </li>
                                <li><a href="#">Сплит</a> </li>
                                <li><a href="#">Тузла</a> </li>
                                <li><a href="#">Шибеник</a> </li>
                                <li><a href="#">Загреб</a> </li>
                                <li><a href="#">Брчко</a> </li>
                                <li><a href="#">Белград</a> </li>
                                <li><a href="#">Нью-Йорк</a> </li>
                                <li><a href="#">Градачац</a> </li>
                                <li><a href="#">Лос-Анджелес</a> </li>
                            </ul>
                        </div>
                    </div>
                    <!-- верхний футер заканчивается -->
                    <!-- нижний футер -->
                    <div class="row bottom-footer">
                        <div class="container">
                            <div class="row">
                                <div class="col-xs-12 col-sm-3 payment-options color-gray">
                                    <h5>Варианты оплаты</h5>
                                    <ul>
                                        <li>
                                            <a href="#"> <img src="images/paypal.png" alt="Paypal"> </a>
                                        </li>
                                        <li>
                                            <a href="#"> <img src="images/mastercard.png" alt="Mastercard"> </a>
                                        </li>
                                        <li>
                                            <a href="#"> <img src="images/maestro.png" alt="Maestro"> </a>
                                        </li>
                                        <li>
                                            <a href="#"> <img src="images/stripe.png" alt="Stripe"> </a>
                                        </li>
                                        <li>
                                            <a href="#"> <img src="images/bitcoin.png" alt="Bitcoin"> </a>
                                        </li>
                                    </ul>
                                </div>
                                <div class="col-xs-12 col-sm-4 address color-gray">
                                    <h5>Адрес</h5>
                                    <p>Концепция дизайна онлайн-заказа еды и доставки, задуманная как каталог ресторанов</p>
                                    <h5>Телефон: <a href="tel:+080000012222">080 000012 222</a></h5> </div>
                                <div class="col-xs-12 col-sm-5 additional-info color-gray">
                                    <h5>Дополнительная информация</h5>
                                    <p>Присоединяйтесь к тысячам других ресторанов, которые получают выгоду от наличия своих меню на TakeOff</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- нижний футер заканчивается -->
                </div>
            </footer>
            <!-- конец: Футер -->
        </div>
  
    
    <!-- Bootstrap core JavaScript
    ================================================== -->
    <script src="js/jquery.min.js"></script>
    <script src="js/tether.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/animsition.min.js"></script>
    <script src="js/bootstrap-slider.min.js"></script>
    <script src="js/jquery.isotope.min.js"></script>
    <script src="js/headroom.js"></script>
    <script src="js/foodpicky.min.js"></script>
</body>

</html>
