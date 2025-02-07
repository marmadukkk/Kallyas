document.addEventListener("DOMContentLoaded", function () {
  const hamburger = document.querySelector(".hamburger");
  const menu = document.querySelector(".menu");
  const overlay = document.getElementById("overlay");
  const modal = document.getElementById("modal");
  const openModalBtn = document.getElementById("openModal");
  const submitBtn = document.getElementById("submitBtn");
  const menuList = document.querySelector(".menu_list");
  const applicationButton = document.querySelector(".application");

  //переключение меню при клике на гамбургер
  hamburger.addEventListener("click", function (e) {
    e.stopPropagation();
    menu.classList.toggle("menu_active");
    this.classList.toggle("hamburger_active");
    menuList.classList.toggle("menu_active");
  });

  //закрытие меню при клике вне его
  document.addEventListener("click", function (e) {
    if (!menu.contains(e.target) && !hamburger.contains(e.target)) {
      menu.classList.remove("menu_active");
      hamburger.classList.remove("hamburger_active");
      menuList.classList.remove("menu_active");
    }
  });

  //открытие модального окна
  function openModal() {
    overlay.style.display = "block";
    modal.style.display = "block";
  }

  //закрытие модального окна
  function closeModal() {
    overlay.style.display = "none";
    modal.style.display = "none";
  }

  openModalBtn.addEventListener("click", function (e) {
    e.preventDefault();
    openModal();
  });

  applicationButton.addEventListener("click", function (e) {
    e.preventDefault();
    openModal();
  });

  overlay.addEventListener("click", closeModal);

  //отправка формы
  submitBtn.addEventListener("click", function () {
    const name = document.getElementById("name").value.trim();
    const email = document.getElementById("email").value.trim();
    const message = document.getElementById("message").value.trim();

    if (!name || !email || !message) {
      alert("Пожалуйста, заполните все поля.");
      return;
    }

    if (!validateEmail(email)) {
      alert("Некорректный email.");
      return;
    }

    //отключение submitBtn, чтобы предотвратить множественные отправки
    submitBtn.disabled = true;

    fetch("/Kallyas/", {
      method: "POST",
      headers: {
        "Content-Type": "application/x-www-form-urlencoded",
      },
      body: `sent=&username=${encodeURIComponent(
        name
      )}&email=${encodeURIComponent(email)}&message=${encodeURIComponent(
        message
      )}`,
    })
      .then((response) => {
        if (!response.ok) {
          throw new Error(`HTTP error! status: ${response.status}`);
        }
        return response.text();
      })
      .then((body) => {
        if (body.includes("success")) {
          alert("Успешная отправка отзыва");
        } else {
          alert("Ошибка отправки отзыва");
        }
        console.log(body);
      })
      .catch((error) => {
        console.error("Ошибка:", error);
        alert("Ошибка отправки отзыва");
      })
      .finally(() => {
        //включение кнопки отправки снова
        submitBtn.disabled = false;

        //очистка полей формы и закрытие модального окна
        document.getElementById("name").value = "";
        document.getElementById("email").value = "";
        document.getElementById("message").value = "";
        closeModal();
      });
  });

  //валидация почты
  function validateEmail(email) {
    const re = /\S+@\S+\.\S+/;
    return re.test(email);
  }
});
