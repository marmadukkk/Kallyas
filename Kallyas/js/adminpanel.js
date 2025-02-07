function login() {
  const username = document.getElementById("username").value;
  const password = document.getElementById("password").value;

  fetch("adminpanel.php", {
    method: "POST",
    headers: {
      "Content-Type": "application/x-www-form-urlencoded",
    },
    body: `username=${encodeURIComponent(
      username
    )}&password=${encodeURIComponent(password)}`,
  })
    .then((response) => response.text())
    .then((data) => {
      if (data.includes("success")) {
        location.reload();
      } else {
        alert("Login failed!");
      }
    });
}

function logout() {
  fetch("logout.php").then(() => {
    location.reload();
  });
}
