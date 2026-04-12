<?php
// guna Firebase sahaja (auth.php dah dibuang)
?>

<!DOCTYPE html>
<html>
<head>

<meta charset="UTF-8">
<title>User History</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">

<!-- 🔒 BLOCK CACHE -->
<meta http-equiv="Cache-Control" content="no-store, no-cache, must-revalidate">
<meta http-equiv="Pragma" content="no-cache">
<meta http-equiv="Expires" content="0">

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:Poppins;
}

/* 🔒 HIDE PAGE BEFORE AUTH */
body{
display:none;
background:url("CSS&JS/IMG/GREEN3.jpg");
background-size:cover;
background-position:center;
background-attachment:fixed;
color:white;
}

/* MENU BUTTON */

.menu-btn{
position:fixed;
top:20px;
left:20px;
font-size:30px;
cursor:pointer;
z-index:2000;
color:black;
}

/* SIDEBAR */

.sidebar{

position:fixed;
left:-260px;
top:0;

width:260px;
height:100%;

background:rgba(0,0,0,0.35);
backdrop-filter:blur(15px);

padding-top:80px;

transition:0.4s ease;

box-shadow:0 0 20px rgba(0,0,0,0.4);

z-index:1000;

}

.sidebar.active{
left:0;
}

/* SIDEBAR LINKS */

.sidebar a{

display:block;
padding:18px 35px;

color:white;
text-decoration:none;
font-size:18px;

transition:0.3s;

}

.sidebar a:hover{

background:rgba(255,255,255,0.15);
padding-left:45px;

}

/* MAIN CONTENT */

.main{

text-align:center;
padding-top:60px;

}

/* HEADER */

.header{

font-size:32px;
font-weight:600;
margin-bottom:40px;
color:black;

}

/* TABLE */

.table-container{

display:flex;
justify-content:center;
position:relative;
z-index:1;

}

table{

width:80%;
border-collapse:collapse;

background:rgba(0,0,0,0.45);
backdrop-filter:blur(12px);

}

th,td{

padding:15px;
border:1px solid rgba(255,255,255,0.4);
text-align:center;

}

th{

background:rgba(0,0,0,0.6);

}

</style>

</head>

<body>

<div class="menu-btn" id="menuBtn" onclick="toggleMenu()">☰</div>

<div class="sidebar" id="sidebar">

<a href="Dashboard.php">Dashboard</a>
<a href="record.php">Record</a>
<a href="history.php">History</a>
<a href="logout.php">Logout</a>

</div>

<div class="main">

<div class="header">
LIST USER HISTORY
</div>

<div class="table-container">

<table id="historyTable">

<tr>
<th>Time</th>
<th>User</th>
<th>Action</th>
</tr>

</table>

</div>

</div>

<script>

function toggleMenu(){

let sidebar = document.getElementById("sidebar");
let btn = document.getElementById("menuBtn");

sidebar.classList.toggle("active");

if(sidebar.classList.contains("active")){
btn.innerHTML="✕";
}else{
btn.innerHTML="☰";
}

}

/* FETCH USER HISTORY */

fetch("API/history.php")

.then(res=>res.json())

.then(data=>{

let table=document.getElementById("historyTable");

data.forEach(row=>{

table.innerHTML+=`

<tr>
<td>${row.time}</td>
<td>${row.username}</td>
<td>${row.action}</td>
</tr>

`;

});

});

</script>

<!-- 🔥 FIREBASE AUTH CHECK -->
<script type="module">

import { initializeApp } from "https://www.gstatic.com/firebasejs/10.7.1/firebase-app.js";
import { getAuth, onAuthStateChanged } from "https://www.gstatic.com/firebasejs/10.7.1/firebase-auth.js";

const firebaseConfig = {
  apiKey: "AIzaSyDJ_Uav0JB3TlC5DjZDzwpTI_lwRxaxUmI",
  authDomain: "decomposition-bin.firebaseapp.com",
  databaseURL: "https://decomposition-bin-default-rtdb.asia-southeast1.firebasedatabase.app",
  projectId: "decomposition-bin",
  storageBucket: "decomposition-bin.firebasestorage.app",
  messagingSenderId: "343213480975",
  appId: "1:343213480975:web:ca029d36c457f93582177a"
};

const app = initializeApp(firebaseConfig);
const auth = getAuth(app);

onAuthStateChanged(auth, (user) => {
  if (!user) {
    window.location.href = "login.php";
  } else {
    // ✅ baru display page
    document.body.style.display = "block";
  }
});

</script>

</body>
</html>