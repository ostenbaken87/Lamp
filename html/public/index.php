<?php
// Проверка переменных окружения (для отладки)
echo "<pre>";
echo "MYSQL_DATABASE: " . ($_ENV['MYSQL_DATABASE'] ?? 'не задано') . "\n";
echo "MYSQL_USER: " . ($_ENV['MYSQL_USER'] ?? 'не задано') . "\n";
echo "MYSQL_PASSWORD: " . ($_ENV['MYSQL_PASSWORD'] ?? 'не задано') . "\n";
echo "</pre>";

// Проверка подключения к MySQL
try {
    $db = new PDO(
        "mysql:host=mysql;dbname=" . $_ENV['MYSQL_DATABASE'],
        $_ENV['MYSQL_USER'],
        $_ENV['MYSQL_PASSWORD']
    );
    echo "✅ Подключение к MySQL успешно!";
} catch (PDOException $e) {
    echo "❌ Ошибка подключения к MySQL: " . $e->getMessage();
}

// Проверка Xdebug
if (extension_loaded('xdebug')) {
    echo "<br>✅ Xdebug активен!";
} else {
    echo "<br>❌ Xdebug не подключён.";
}
?>