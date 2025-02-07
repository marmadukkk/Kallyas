<?php
session_start();

$servername = "localhost";
$username = "root";
$password = "123321";
$dbname = "test_db";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$tableContent = "";
if (isset($_SESSION['loggedin']) && $_SESSION['loggedin'] === true) {
    $sql = "SELECT id, username, email, message FROM users";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $tableContent .= "<table border='1'>
                            <tr>
                                <th>id</th>
                                <th>username</th>
                                <th>email</th>
                                <th>message</th>
                            </tr>";
        while ($row = $result->fetch_assoc()) {
            $tableContent .= "<tr>
                                <td>" . $row["id"] . "</td>
                                <td>" . $row["username"] . "</td>
                                <td>" . $row["email"] . "</td>
                                <td>" . $row["message"] . "</td>
                              </tr>";
        }
        $tableContent .= "</table>";
    } else {
        $tableContent = "0 results";
    }
} else {
    $tableContent = "Please log in to view the table.";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $user = $_POST['username'];
    $pass = $_POST['password'];

    $sql = "SELECT id, password FROM users WHERE username = ? AND password = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ss", $user, $pass);
    $stmt->execute();
    $result = $stmt->get_result();
    $row = $result->fetch_assoc();
    echo $pass;
    echo $row['password'];
    if ($row && $pass == $row['password']) {
        $_SESSION['loggedin'] = true;
        echo 'success';
    } else {
        echo 'failure';
    }

    $stmt->close();
}

$conn->close();
?>
<!DOCTYPE html>
<html lang="ru">
<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="style-adminpanel.css">
    <title>Kallyas - Admin Panel</title>
    <script src="jquery/jquery-3.7.1.min.js"></script>
</head>
<style>
    
</style>
<body>
    
<header>
    <div class="container_header">
        <a href="#" class="logo">
            <img src="images/logo.png" alt="Kallyas">
        </a>
        <nav class="menu">
            <ul class="menu_list">
                <li class="menu_item"><a href="index.php" class="menu_link">Главная</a></li>
                <li class="menu_item"><a href="offers.php" class="menu_link">Услуги</a></li>
                <li class="menu_item"><a href="about.php" class="menu_link">О нас</a></li>
                <li class="menu_item"><a href="contacts.php" class="menu_link">Контакты</a></li>
                <li class="menu_item"><a href="adminpanel.php" class="menu_link">Админ панель</a></li>
            </ul>
        </nav>
    </div>
</header>

<main>
    <div class="container">
        <?php if (!isset($_SESSION['loggedin']) || $_SESSION['loggedin'] !== true): ?>
            <div id="loginForm">
                <h2 class='admpanl'>Admin Panel</h2>
                <div class="input-group">
                    <input type="text" placeholder="Username" id="username">
                </div>
                <div class="input-group">
                    <input type="password" placeholder="Password" id="password">
                </div>
                <button onclick="login()">Login</button>
            </div>
        <?php else: ?>
            <div id="adminPanel">
                <div class="header">
                    <h2 class='admpanl'>Admin Panel</h2>
                    <button onclick="logout()">Logout</button>
                </div>
                <?php echo $tableContent; ?>
            </div>
        <?php endif; ?>
    </div>
</main>

<footer>
        <div class="container_footer">
            <a href="#" class="logo">
                <img src="images/logo.png" alt="Kallyas">
            </a>
            <nav class="menu">
                <ul class="menu_list">
                <li class="menu_item"><a href="index.php" class="menu_link">Главная</a></li>
                    <li class="menu_item"><a href="offers.php" class="menu_link">Услуги</a></li>
                    <li class="menu_item"><a href="about.php" class="menu_link">О нас</a></li>
                    <li class="menu_item"><a href="contacts.php" class="menu_link">Контакты</a></li>
                </ul>
            </nav>
        </div>
    </footer>

<script src="js/adminpanel.js"> </script>
</body>
</html>