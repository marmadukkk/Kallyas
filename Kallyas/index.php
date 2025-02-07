<?php
session_start();
$host = 'localhost';
$db = 'test_db';
$user = 'root';
$pass = '123321';

$conn = new mysqli($host, $user, $pass, $db);
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$conn->query("CREATE TABLE IF NOT EXISTS users (id INT AUTO_INCREMENT PRIMARY KEY, username VARCHAR(20), email VARCHAR(90), message VARCHAR(350), passro)");

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['sent'])) {
        $username = htmlspecialchars(trim($_POST['username']));
        $email = htmlspecialchars(trim($_POST['email']));
        $message = htmlspecialchars(trim($_POST['message']));
        $stmt = $conn->prepare("INSERT INTO users (username, email, message) VALUES (?, ?, ?)");
        $stmt->bind_param("sss", $username, $email, $message);
        if ($stmt->execute()) {

            echo'success'; 
        } else {
            echo'failed';
        }
    }
}

?>

<html>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="style.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100..900;1,100..900&display=swap" rel="stylesheet">
    <title>Kallyas - Our Time, Your Future</title>
    <script src="jquery/jquery-3.7.1.min.js"></script>
</head>
<body>
    <header>
        <div class="container_header">
            <a href="#" class="logo">
                <img src="images/logo.png" alt="Kallyas">
            </a>
            <div class="hamburger">
                <span></span>
                <span></span>
                <span></span>
            </div>
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
        <div class="slogan_container">
            <p class="slogan_up">Комплексное продвижение<br>бизнеса в интернете</p>
            <p class="slogan_down">Ваш удаленный маркетинговый отдел "под ключ"</p>
            <a href="#" class="application" id="openModal">Оставить отзыв</a>
        </div>
    </header>
    
    <main class="main">
        <div class="services-container">
            <div class="service-card">
                <img src="images/features1.png" alt="MarketStrategy" class="service-icon">
                <h3 class="service-title">Маркетинговая стратегия</h3>
                <div class="separator"></div>
                <p class="service-description">Разрабатываем маркетинговые стратегии, которые позволяют бизнесу устойчиво развиваться.</p>
            </div>
            <div class="service-card">
                <img src="images/features2.png" alt="SiteDevelopment" class="service-icon">
                <h3 class="service-title">Разработка сайта</h3>
                <div class="separator"></div>
                <p class="service-description">Разработаем удобный для пользователя сайт, который решит задачи бизнеса и принесет прибыль.</p>
            </div>
            <div class="service-card">
                <img src="images/features3.png" alt="SEO" class="service-icon">
                <h3 class="service-title">SEO продвижение</h3>
                <div class="separator"></div>
                <p class="service-description">Оптимизацию проводим для сайтов с услугами, интернет-магазинов любого возраста и тематики.</p>
            </div>
        </div>

        <div class="text-section">
            <div class="text-container">
                <h2>Лучшие услуги для <span style="color: #fb414e;">быстрого роста</span></h2>
                <p>Полное погружение в проект и подбор оптимального набора услуг и инструментов индивидуально для вас</p>
            </div>
        </div>

        <div class="features-section">
            <div class="features-container">
                <div class="feature-block">
                    <img src="images/icon1.png" alt="Strategy">
                    <h3>Стратегия</h3>
                    <p>Разрабатываем коммуникационные стратегии, которые позволяют бизнесу устойчиво развиваться.</p>
                </div>
                <div class="feature-block">
                    <img src="images/icon2.png" alt="Marketing">
                    <h3>Маркетинг</h3>
                    <p>Разрабатываем нестандартные решения для бизнеса, которые обязательно решают клиентскую задачу.</p>
                </div>
                <div class="feature-block">
                    <img src="images/icon3.png" alt="Tech">
                    <h3>Технологии</h3>
                    <p>Внедряем передовые, проверенные и работающие технологии, которые реально работают.</p>
                </div>
                <div class="feature-block">
                    <img src="images/icon4.png" alt="Sales">
                    <h3>Продажи</h3>
                    <p>Создаем и настраиваем отдел продаж, который приносит прибыль и не требует ежедневного контроля</p>
                </div>
                <div class="feature-block">
                    <img src="images/icon5.png" alt="Brand">
                    <h3>Бренд</h3>
                    <p>Мы разрабатываем бренд стратегии, которые позволяют бизнесу устойчиво развиваться.</p>
                </div>
                <div class="feature-block">
                    <img src="images/icon6.png" alt="SEO">
                    <h3>SEO</h3>
                    <p>Аудит, семантика, оптимизация HTML, написание контента, покупка ссылок, написание ТЗ программистам.</p>
                </div>
            </div>
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

    <div class="overlay" id="overlay"></div>
    <div class="modal" id="modal">
        <h2>Введите свои данные</h2>
        <input type="text" id="name" maxlength="20" placeholder="Ваше имя">
        <input type="email" id="email" maxlength="30" placeholder="Ваш email">
        <textarea id="message" maxlength="350" placeholder="Ваше сообщение"></textarea>
        <button id="submitBtn">Отправить</button>
    </div>
    <script src="js/script.js"></script>
</body>
</html>