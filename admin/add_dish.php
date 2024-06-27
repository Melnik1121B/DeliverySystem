<?php
// Подключение к базе данных
include '../includes/db.php';

// Проверка авторизации администратора
session_start();
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header("Location: ../login.php");
    exit;
}

$message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name_dish = $_POST['name_dish'];
    $overview = $_POST['overview'];
    $dish_price = $_POST['dish_price'];

    // Предполагается, что у нас есть функция для добавления блюда в базу данных
    if (addDish($name_dish, $overview, $dish_price)) {
        $message = "Блюдо успешно добавлено.";
    } else {
        $message = "Ошибка при добавлении блюда.";
    }
}

include('../includes/cart.php');

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $dish_id = $_POST['dish_id'];
    $quantity = $_POST['quantity'];
    
    // Добавление товара в корзину
    addToCart($dish_id, $quantity);
    

}

?>

<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <title>Добавить блюдо</title>
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>

<div class="container">
    <h2>Добавить блюдо</h2>

    <?php if ($message): ?>
        <p class="message"><?php echo $message; ?></p>
    <?php endif; ?>

    <form method="post">
        <div class="form-group">
            <label for="name_dish">Название блюда:</label>
            <input type="text" id="name_dish" name="name_dish" required>
        </div>
        <div class="form-group">
            <label for="overview">Описание:</label>
            <textarea id="overview" name="overview" rows="3" required></textarea>
        </div>
        <div class="form-group">
            <label for="dish_price">Цена:</label>
            <input type="number" id="dish_price" name="dish_price" min="0" step="any" required>
        </div>
        <button type="submit" class="btn">Добавить</button>
    </form>

    <a href="index.php" class="btn">Назад</a>
</div>

</body>
</html>
