document.addEventListener("DOMContentLoaded", function () {
  const apiKey = "216e02695fd914c41334334f40b06080";
  let apiUrl =
      "https://api.openweathermap.org/data/2.5/weather?q=yourcity&appid=" +
      apiKey;

  function updateForecast(city = "yourcity") {
      apiUrl = `https://api.openweathermap.org/data/2.5/weather?q=${city}&appid=${apiKey}&lang=ru`;

      fetch(apiUrl)
          .then((response) => response.json())
          .then((data) => {
              if (data.main && data.main.temp) {
                  const temperatureElement = document.getElementById("temperature");
                  const windSpeedElement = document.getElementById("wind-speed");
                  const humidityElement = document.getElementById("humidity");
                  const weatherDescriptionElement = document.getElementById("weather-description");
          
                  const temperature = Math.round(data.main.temp - 273.15);
                  const windSpeed = data.wind.speed;
                  const humidity = data.main.humidity;
                  const weatherDescription = data.weather[0].description;
          
                  temperatureElement.textContent = "Температура: " + temperature + "°C";
                  windSpeedElement.textContent = "Скорость ветра: " + windSpeed + " км/ч";
                  humidityElement.textContent = "Влажность: " + humidity + "%";
                  weatherDescriptionElement.textContent = "Погодные условия: " + weatherDescription;
          
                  if (data.coord && data.coord.lat && data.coord.lon) {
                      updateMap(data.coord.lat, data.coord.lon);
                  } else {
                      console.error("Ошибка: Невозможно получить координаты из данных");
                  }
              } else {
                  console.error("Ошибка: Невозможно получить данные о погоде");
              }
          })
          .catch((error) => console.error("Ошибка при получении данных:", error));
          
  }

  const refreshButton = document.getElementById("refresh-button");
  refreshButton.addEventListener("click", function () {
      const cityInput = document.getElementById("city-input");
      const city = cityInput.value.trim();
      if (city !== "") {
          updateForecast(city);
      } else {
          alert("Пожалуйста, введите город.");
      }
  });

  updateForecast(); // Вызываем функцию для получения погоды при загрузке страницы
  initMap(56.109693, 47.262652); // Пример координат для initMap
});


  
let map;

function initMap(latitude, longitude) {
    const center = [latitude, longitude];

    if (!map) {
        // Создаем карту только если ее нет
        map = L.map("map").setView(center, 12);

        L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
            attribution: "© OpenStreetMap contributors",
            maxZoom: 18,
        }).addTo(map);
    } else {
        // Если карта уже создана, просто обновим ее центр
        map.setView(center);
    }

    // Добавляем маркер на карту
    L.marker(center)
        .addTo(map)
        .bindPopup("Выбранный город")
        .openPopup();
}

function updateMap(latitude, longitude) {
    initMap(latitude, longitude);
}

  
  
  
  document.addEventListener("DOMContentLoaded", function () {
    function initMap() {
      // Координаты центра карты (например, Москва)
      const center = [56.109693, 47.262652];
  
      // Создание карты
      const map = L.map("map").setView(center, 12);
  
      // Добавление слоя с картой OpenStreetMap
      L.tileLayer("https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png", {
        attribution: "© OpenStreetMap contributors",
        maxZoom: 18,
      }).addTo(map);
  
      // Создание маркера на карте
      L.marker(center).addTo(map).bindPopup("Наш офис").openPopup();
    }
  
    // Инициализация карты после загрузки страницы
    initMap();
  });
  
  let currentSlide = 0;
  const slides = document.querySelectorAll(".slide");
  
  function showSlide(index) {
    slides.forEach((slide) => {
      slide.classList.remove("active");
    });
  
    if (index >= slides.length) {
      currentSlide = 0;
    } else if (index < 0) {
      currentSlide = slides.length - 1;
    } else {
      currentSlide = index;
    }
  
    slides[currentSlide].classList.add("active");
  }
  
  function nextSlide() {
    showSlide(currentSlide + 1);
  }
  
  function prevSlide() {
    showSlide(currentSlide - 1);
  }
  
  // Инициализация слайдера
  showSlide(currentSlide);
  
  function toggleNav() {
    const mainNav = document.getElementById("mainNav");
    mainNav.classList.toggle("show");
  }

  function showPopup(title, content) {
    document.getElementById("popup-title").textContent = title;
    document.getElementById("popup-content").textContent = content;
    document.getElementById("popup").style.display = "block";
    document.body.style.overflow = "hidden"; // Disable scrolling
  }
  
  function closePopup() {
    document.getElementById("popup").style.display = "none";
    document.body.style.overflow = "auto"; // Enable scrolling
  }

  
  
