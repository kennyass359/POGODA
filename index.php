<!DOCTYPE html>
<html lang="ru">

<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <link rel="stylesheet" href="styles.css" />
  <link rel="stylesheet" href="https://unpkg.com/leaflet@1.3.1/dist/leaflet.css" integrity="sha512-Rksm5RenBEKSKFjgI3a41vrjkw4EVPlJ3+OiI65vTjIdo9brlAacEuKOiQ5OFh7cOI1bkDwLqdLw3Zg0cRJAAQ==" crossorigin="" />
  <meta name="robots" content="index, follow">
  <meta name="description" content="Погода в Чебоксарах: актуальный прогноз на сегодня и на неделю. Температура, осадки, влажность. Будь в курсе погоды с ChebWeath.">
  <link rel="canonical" href="https://chebweath.netlify.app">
  <script src="https://unpkg.com/leaflet@1.3.1/dist/leaflet.js" integrity="sha512-/Nsx9X4HebavoBvEBuyp3I7od5tA0UzAxs+j83KgC8PU0kgB4XiK4Lfe4y4cgBtaRJQEIFCW+oC506aPT2L1zw==" crossorigin=""></script>
  <script defer src="app.js"></script>
  <title>Погода в Чебоксарах | ChebWeath</title>

</head>

<body>
  <div id="logo">
    <img src="img/1.jpg" alt="Логотип">
    <h1>Чебоксарская Погода</h1>
  </div>
  <header>
    <button id="toggleNav" onclick="toggleNav()">☰</button>
    <nav id="mainNav">
      <ul>
        <li><a href="#home">Главная</a></li>
        <li><a href="#maps">Карты</a></li>
        <li><a href="#gallery">Галерея</a></li>
        <li><a href="#news">Новости</a></li>
        <li><a href="#about">О нас</a></li>
        <li><a href="#contact">Контакты</a></li>
        <li><a href="#blog">Блог</a></li>
      </ul>
    </nav>
  </header>

  <section id="forecast">
    <h2>Прогноз на сегодня</h2>
    <label for="city-input">Введите ваш город: </label>
    <input type="text" id="city-input" placeholder="Например, Москва" />
    <button id="refresh-button">Обновить прогноз</button>
    <p id="temperature">Температура:</p>
    <p id="wind-speed">Скорость ветра:</p>
    <p id="humidity">Влажность:</p>
    <p id="weather-description">Погодные условия:</p>
  </section>



  <section id="maps">
    <h2>Карты</h2>
    <div id="map" style="height: 400px;"></div>
  </section>
  <section id="gallery">
    <h2>Галерея</h2>
    <!-- Добавим контейнер для слайдера -->
    <div class="slider-container">
      <div class="slider" id="slider">
        <?php
        // Подключение к базе данных
        $servername = "localhost";
        $username = "root";
        $password = "";
        $dbname = "weath";

        $conn = new mysqli($servername, $username, $password, $dbname);

        // Проверка соединения
        if ($conn->connect_error) {
          die("Connection failed: " . $conn->connect_error);
        }

        // Запрос к базе данных для извлечения изображений
        $sql = "SELECT image FROM images";
        $result = $conn->query($sql);

        // Проверка наличия результатов запроса
        if ($result->num_rows > 0) {
          // Вывод изображений в HTML
          while ($row = $result->fetch_assoc()) {
            echo '<div class="slide"><img src="data:image/jpeg;base64,' . base64_encode($row["image"]) . '" alt="Image" /></div>';
          }
        } else {
          echo "0 результатов";
        }
        $conn->close();
        ?>
      </div>
      <button class="slide-btn" id="prevBtn" onclick="prevSlide()">❮</button>
      <button class="slide-btn" id="nextBtn" onclick="nextSlide()">❯</button>
    </div>

  </section>


  <section id="news">
    <h2>Новости</h2>
    <div class="news-container">
      <div class="news-item">
        <img src="img/3.jpg" alt="News 1" />
        <h3>Прогноз на декабрь и январь</h3>
        <p>
          Очень холодно в декабре
        </p>
        <a href="#" class="read-more-link" onclick="showPopup('Аномальное Похолодание в России: Что Нас Ожидает в Декабре 2023', 'В последние дни стало известно, что Россию ждет необычное похолодание. Научный руководитель Гидрометцентра России, Роман Вильфанд, предупредил о наступлении холодной погоды на огромной территории страны, отмечая, что снижение температуры начнется уже сегодня. Согласно прогнозам, аномалии в погоде будут впечатляющими. С 2 по 6 декабря ожидается понижение температуры во всех регионах Северо-Западного федерального округа на 7–14 градусов ниже нормы, а в некоторых местах даже на 15–20 градусов ниже нормы. Научный руководитель Гидрометцентра предупреждает, что морозы в большинстве регионов могут достигать от 16 до 23 градусов, а в некоторых, таких как Архангельская область, Коми и Ненецкий автономный округ, даже до 30 градусов. В Центральном федеральном округе также ожидается понижение температуры. 5 и 6 декабря здесь прогнозируются морозы до -16... -23 градусов, что на 7–12 градусов ниже нормы. Синоптики предвещают сильные морозы в различных регионах. В Пермском крае, Кировской области, Удмуртии и Марий Эл морозы могут достигнуть -23 градусов, в Свердловской, Челябинской, Курганской, Тюменской областях — до -20... -27 градусов, в Томской и Омской областях — до -27... -35 градусов. В Ямало-Ненецком и Ханты-Мансийском автономных округах температура может опускаться до -41 градуса. Необычно холодно будет и в северных районах Красноярского края. В Таймырском и Эвенкийском районах синоптики прогнозируют понижение температуры на 16 градусов ниже нормы. В период с 2 по 6 декабря здесь ожидаются до 42 градусов мороза. Север, в том числе Якутия, Магаданский край и Чукотка, также не останутся в стороне от аномального похолодания. Температура может опускаться до -43... -49 градусов. На юге Хабаровского края ожидаются морозы до -35... -40 градусов. Эти невиданные холода следуют за погодными аномалиями, которые произошли на юге России в прошлые выходные. Мощный циклон, названный штормом века, пронесся по черноморскому побережью, вызвав затопления, разрушения и проблемы с коммуникациями. Тысячи людей оказались без света. Оставайтесь в курсе изменений в погоде и примите необходимые меры для борьбы с холодом. Важно быть готовыми к экстремальным условиям и обеспечить безопасность ваших домов и близких.');">Читать далее</a>

      </div>
      <div class="news-item">
        <img src="img/3.jpg" alt="News 1" />
        <h3>Прогноз на декабрь и январь</h3>
        <p>
          Очень холодно в декабре
        </p>
        <a href="#" class="read-more-link" onclick="showPopup('Аномальное Похолодание в России: Что Нас Ожидает в Декабре 2023', 'В последние дни стало известно, что Россию ждет необычное похолодание. Научный руководитель Гидрометцентра России, Роман Вильфанд, предупредил о наступлении холодной погоды на огромной территории страны, отмечая, что снижение температуры начнется уже сегодня. Согласно прогнозам, аномалии в погоде будут впечатляющими. С 2 по 6 декабря ожидается понижение температуры во всех регионах Северо-Западного федерального округа на 7–14 градусов ниже нормы, а в некоторых местах даже на 15–20 градусов ниже нормы. Научный руководитель Гидрометцентра предупреждает, что морозы в большинстве регионов могут достигать от 16 до 23 градусов, а в некоторых, таких как Архангельская область, Коми и Ненецкий автономный округ, даже до 30 градусов. В Центральном федеральном округе также ожидается понижение температуры. 5 и 6 декабря здесь прогнозируются морозы до -16... -23 градусов, что на 7–12 градусов ниже нормы. Синоптики предвещают сильные морозы в различных регионах. В Пермском крае, Кировской области, Удмуртии и Марий Эл морозы могут достигнуть -23 градусов, в Свердловской, Челябинской, Курганской, Тюменской областях — до -20... -27 градусов, в Томской и Омской областях — до -27... -35 градусов. В Ямало-Ненецком и Ханты-Мансийском автономных округах температура может опускаться до -41 градуса. Необычно холодно будет и в северных районах Красноярского края. В Таймырском и Эвенкийском районах синоптики прогнозируют понижение температуры на 16 градусов ниже нормы. В период с 2 по 6 декабря здесь ожидаются до 42 градусов мороза. Север, в том числе Якутия, Магаданский край и Чукотка, также не останутся в стороне от аномального похолодания. Температура может опускаться до -43... -49 градусов. На юге Хабаровского края ожидаются морозы до -35... -40 градусов. Эти невиданные холода следуют за погодными аномалиями, которые произошли на юге России в прошлые выходные. Мощный циклон, названный штормом века, пронесся по черноморскому побережью, вызвав затопления, разрушения и проблемы с коммуникациями. Тысячи людей оказались без света. Оставайтесь в курсе изменений в погоде и примите необходимые меры для борьбы с холодом. Важно быть готовыми к экстремальным условиям и обеспечить безопасность ваших домов и близких.');">Читать далее</a>

      </div>
      <!-- Добавь больше новостей по аналогии -->
    </div>
  </section>
  <div id="popup" class="popup">
    <div class="popup-content">
      <span class="close" onclick="closePopup()">&times;</span>
      <h2 id="popup-title"></h2>
      <p id="popup-content"></p>
    </div>
  </div>
  <section id="about">
    <h2>О нас</h2>
    <div class="about-content">
      <p>
        Добро пожаловать на наш погодный сайт! Мы предоставляем точные и
        свежие данные о погоде в вашем регионе.
      </p>
      <p>
        Наша команда профессионалов следит за всеми изменениями в атмосфере,
        чтобы вы всегда были в курсе последних прогнозов и событий.
      </p>
      <p>
        Мы стремимся сделать ваш опыт отслеживания погоды удобным и
        интересным. Если у вас есть вопросы или предложения, не стесняйтесь
        связаться с нами.
      </p>
    </div>
  </section>
  <!-- Добавим секцию "Контакты" в секцию с id="contact" -->
  <section id="contact">
    <h2>Контакты</h2>
    <div class="contact-info">
      <p><strong>Адрес:</strong> Ваш город, Улица, Дом</p>
      <p><strong>Телефон:</strong> +7 (XXX) XXX-XX-XX</p>
      <p><strong>Email:</strong> info@example.com</p>
    </div>
    <div class="contact-form">
      <h3>Свяжитесь с нами</h3>
      <form action="handle_contact_form.php" method="post">
        <label for="name">Имя:</label>
        <input type="text" id="name" name="name" required />

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required />

        <label for="message">Сообщение:</label>
        <textarea id="message" name="message" rows="4" required></textarea>

        <button type="submit">Отправить</button>
      </form>
    </div>
  </section>


  <section id="blog">
    <h2>Блог</h2>
    <div class="blog-posts">
      <?php
      // Подключение к базе данных
      $servername = "localhost";
      $username = "root";
      $password = "";
      $dbname = "weath";

      $conn = new mysqli($servername, $username, $password, $dbname);

      // Проверка соединения
      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }

      // Запрос к базе данных для извлечения статей
      $sql = "SELECT title, image, description FROM blog_posts";
      $result = $conn->query($sql);

      // Проверка наличия результатов запроса
      if ($result->num_rows > 0) {
        // Вывод статей в HTML
        while ($row = $result->fetch_assoc()) {
          echo '<div class="blog-post">';
          echo '<img src="data:image/jpeg;base64,' . base64_encode($row["image"]) . '" alt="' . $row["title"] . '" />';
          echo '<h3>' . $row["title"] . '</h3>';
          echo '<p>' . $row["description"] . '</p>';
          echo '<a href="#">Читать далее</a>';
          echo '</div>';
        }
      } else {
        echo "0 результатов";
      }
      $conn->close();
      ?>

      <!-- Добавь больше статей по аналогии -->
    </div>
  </section>
  <section id="additional-info">
    <h2>Дополнительная информация</h2>
    <p>
      Следите за нашим блогом и узнавайте последние новости о погоде в вашем
      регионе!
    </p>
  </section>
  <footer>
    <p>&copy; 2024 ChebWeath</p>
  </footer>
</body>

</html>