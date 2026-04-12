<?php
// ❌ No MySQL
?>

<!DOCTYPE html>
<html>
<head>

<meta charset="UTF-8">
<title>Register</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:'Poppins',sans-serif;
}

body{
height:100vh;
display:flex;
align-items:center;
justify-content:center;
background:url("CSS&JS/IMG/GREEN.jpg");
background-size:cover;
background-position:center;
}

.container{
width:360px;
padding:40px;
background:rgba(255,255,255,0.1);
backdrop-filter:blur(15px);
border-radius:20px;
border:1px solid rgba(255,255,255,0.3);
color:white;
}

.container h2{
text-align:center;
margin-bottom:30px;
}

.inputBox{
margin-bottom:20px;
}

.inputBox input{
width:100%;
padding:12px;
background:transparent;
border:none;
border-bottom:2px solid white;
color:white;
font-size:14px;
outline:none;
}

.inputBox input::placeholder{
color:#ddd;
}

button{
width:100%;
padding:12px;
border:none;
border-radius:8px;
background:white;
color:black;
font-weight:600;
cursor:pointer;
}

.login{
text-align:center;
margin-top:15px;
font-size:14px;
}

.login a{
color:white;
text-decoration:underline;
}

</style>

</head>

<body>

<div class="container">

<h2>Register</h2>

<form onsubmit="event.preventDefault(); register();">

<div class="inputBox">
<input type="email" id="email" placeholder="Email" required>
</div>

<div class="inputBox">
<input type="password" id="password" placeholder="Password" required>
</div>

<button type="submit">Register</button>

</form>

<div class="login">
Already have an account? <a href="login.php">Login</a>
</div>

</div>

<script type="module">

import { initializeApp } from "https://www.gstatic.com/firebasejs/10.7.1/firebase-app.js";
import { getAuth, createUserWithEmailAndPassword } from "https://www.gstatic.com/firebasejs/10.7.1/firebase-auth.js";

// 🔥 GANTI CONFIG KAU
const firebaseConfig = {
  apiKey: "AIzaSyDJ_Uav0JB3TlC5DjZDzwpTI_lwRxaxUmI",
  authDomain: "decomposition-bin.firebaseapp.com",
  projectId: "decomposition-bin",
  storageBucket: "decomposition-bin.firebasestorage.app",
  messagingSenderId: "343213480975",
  appId: "1:343213480975:web:ca029d36c457f93582177a"
};

const app = initializeApp(firebaseConfig);
const auth = getAuth(app);

// REGISTER FUNCTION
window.register = function() {

  const email = document.getElementById("email").value;
  const password = document.getElementById("password").value;

  createUserWithEmailAndPassword(auth, email, password)
    .then((userCredential) => {

      alert("Register Success ✅");
      window.location.href = "login.php";

    })
    .catch((error) => {

      alert("Error ❌: " + error.message);

    });

}

</script>

</body>
</html>