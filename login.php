<?php
// Firebase handle authentication
?>

<!DOCTYPE html>
<html>
<head>

<meta charset="UTF-8">
<title>Login</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

<!-- 🔒 BLOCK CACHE (ANTI BACK BUTTON) -->
<meta http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate">
<meta http-equiv="Pragma" content="no-cache">
<meta http-equiv="Expires" content="0">

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

/* 🔒 HIDE PAGE UNTIL AUTH CHECK */
body{
display:none;
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

.options{

display:flex;
justify-content:space-between;
font-size:13px;
margin-bottom:20px;

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

.register{

text-align:center;
margin-top:15px;
font-size:14px;

}

.register a{

color:white;
text-decoration:underline;

}

</style>

</head>

<body>

<div class="container">

<h2>Login</h2>

<form onsubmit="event.preventDefault(); login();">

<div class="inputBox">
<input type="email" id="email" placeholder="Email" required>
</div>

<div class="inputBox">
<input type="password" id="password" placeholder="Password" required>
</div>

<div class="options">
<label>
<input type="checkbox"> Remember me
</label>
<span>Forgot Password?</span>
</div>

<button type="submit">Login</button>

</form>

<div class="register">
Don't have an account? <a href="register.php">Register</a>
</div>

</div>

<script type="module">

import { initializeApp } from "https://www.gstatic.com/firebasejs/10.7.1/firebase-app.js";
import { getAuth, signInWithEmailAndPassword, onAuthStateChanged } from "https://www.gstatic.com/firebasejs/10.7.1/firebase-auth.js";

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

/* 🔥 AUTO REDIRECT JIKA DAH LOGIN */
onAuthStateChanged(auth, (user) => {
  if (user) {
    window.location.href = "Dashboard.php";
  } else {
    // ✅ baru tunjuk page login
    document.body.style.display = "flex";
  }
});

/* LOGIN FUNCTION */
window.login = function() {

  const email = document.getElementById("email").value;
  const password = document.getElementById("password").value;

  signInWithEmailAndPassword(auth, email, password)
    .then((userCredential) => {

      alert("Login Success ✅");
      window.location.href = "Dashboard.php";

    })
    .catch((error) => {

      alert("Login Failed ❌: " + error.message);

    });

}

</script>

</body>
</html>