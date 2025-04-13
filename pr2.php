<?php

#[Attribute]
class OnlyAdults {
    public function __construct() {
        echo "<p><strong>Лог:</strong> Виклик функції фільтрації дорослих користувачів</p>";
    }
}

$users = [
    ['name' => 'Івпатій', 'age' => 14, 'email' => 'ivpatiy@gmail.com'],
    ['name' => 'Ендрю', 'age' => 88, 'email' => 'endrew@gmail.com'],
    ['name' => 'Василь', 'age' => 24, 'email' => 'vasiliy@gmail.com'],
    ['name' => 'Йосип', 'age' => 20, 'email' => 'yosip@gmail.com'],
    ['name' => 'Петро', 'age' => 15, 'email' => 'petro@gmail.com'],
    ['name' => 'Іврасій', 'age' => 19, 'email' => 'ivrasiy@gmail.com'],
    ['name' => 'Бажена', 'age' => 22, 'email' => 'bashena@gmail.com'],
    ['name' => 'Абдурахмат', 'age' => 18, 'email' => 'abdurahmat@gmail.com'],
    ['name' => 'Попоукалова', 'age' => 28, 'email' => 'popoukalova@gmail.com'],
    ['name' => 'Інокентій', 'age' => 16, 'email' => 'inokentiy@gmail.com']
];

#[OnlyAdults]
function filterAdults($users) {
    return array_filter($users, fn($user) => $user['age'] >= 18);
}

$refFunc = new ReflectionFunction('filterAdults');
foreach ($refFunc->getAttributes(OnlyAdults::class) as $attr) {
    $attr->newInstance(); 
}

$filteredUsers = filterAdults($users);

function compareByNameLength($a, $b) {
    return strlen($a['name']) <=> strlen($b['name']);
}

usort($filteredUsers, 'compareByNameLength');

echo "<table border='1' cellpadding='5'>";
echo "<tr><th>Ім’я</th><th>Вік</th><th>Email</th></tr>";
foreach ($filteredUsers as $user) {
    echo "<tr>";
    echo "<td>{$user['name']}</td>";
    echo "<td>{$user['age']}</td>";
    echo "<td>{$user['email']}</td>";
    echo "</tr>";
}
echo "</table>";

?>
