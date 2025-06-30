function togglePassword() {
  const passwordInput = document.getElementById("password");
  const type = passwordInput.getAttribute("type") === "password" ? "text" : "password";
  passwordInput.setAttribute("type", type);
}

document.getElementById("loginForm").addEventListener("submit", function (e) {
  e.preventDefault();
  const username = document.getElementById("username").value;
  const password = document.getElementById("password").value;

  if (username === "admin" && password === "1234") {
    alert("Login successful!");
  } else {
    alert("Invalid credentials!");
  }
});

function togglePassword() {
  const passwordInput = document.getElementById("password");
  const type = passwordInput.type === "password" ? "text" : "password";
  passwordInput.type = type;
}

function openModal(event) {
  event.preventDefault();
  document.getElementById("modal").style.display = "block";
}

function closeModal() {
  document.getElementById("modal").style.display = "none";
}

function submitRecovery() {
  const email = document.getElementById("recoveryEmail").value;
  if (email && email.endsWith("@gmail.com")) {
    alert("Recovery link sent to: " + email);
    closeModal();
  } else {
    alert("Please enter a valid Gmail address.");
  }
}

// Optional: Close modal when clicking outside
window.onclick = function (event) {
  const modal = document.getElementById("modal");
  if (event.target === modal) {
    modal.style.display = "none";
  }
};

