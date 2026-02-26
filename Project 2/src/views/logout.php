<?php
// Проверяем, запущена ли сессия, и только потом вызываем session_start()
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

// Разрушаем текущую сессию, если она была запущена
if (session_status() === PHP_SESSION_ACTIVE) {
    session_destroy();
}

// Перенаправляем пользователя на главную страницу или иную страницу по вашему выбору
header('Location: /index');
exit;
?>
