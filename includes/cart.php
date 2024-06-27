<?php
// includes/cart.php

session_start();

// Функция для добавления товара в корзину
function addToCart($dish_id, $quantity) {
    $_SESSION['cart'][$dish_id] = $quantity;
}

// Функция для удаления товара из корзины
function removeFromCart($dish_id) {
    unset($_SESSION['cart'][$dish_id]);
}

// Функция для очистки корзины
function clearCart() {
    unset($_SESSION['cart']);
}

// Функция для получения содержимого корзины
function getCartContents() {
    return isset($_SESSION['cart']) ? $_SESSION['cart'] : array();
}
