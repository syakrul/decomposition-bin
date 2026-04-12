<!DOCTYPE html>
<html>
<head>

<meta charset="UTF-8">
<title>Compost Monitoring Dashboard</title>

<link href="https://fonts.googleapis.com/css2?family=Poppins:wght@300;400;600&display=swap" rel="stylesheet">
<script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

<style>

*{
margin:0;
padding:0;
box-sizing:border-box;
font-family:Poppins;
}

body{
background:url("CSS&JS/IMG/GREEN4.jpg");
background-size:cover;
background-position:center;
background-attachment:fixed;
color:white;
}

.menu-btn{
position:fixed;
top:20px;
left:20px;
font-size:30px;
cursor:pointer;
z-index:1000;
color:black;
}

.sidebar{
position:fixed;
left:-250px;
top:0;
width:250px;
height:100%;
background:rgba(0,0,0,0.5);
backdrop-filter:blur(10px);
padding-top:80px;
transition:0.4s;
}

.sidebar a{
display:block;
padding:15px 30px;
color:white;
text-decoration:none;
font-size:18px;
}

.sidebar a:hover{
background:rgba(255,255,255,0.2);
}

.sidebar.active{
left:0;
}

.main{
text-align:center;
padding-top:40px;
}

.title{
font-size:28px;
font-weight:600;
margin-bottom:10px;
}

.lastUpdate{
font-size:14px;
color:#ddd;
margin-bottom:30px;
}

.cards{
display:flex;
justify-content:center;
gap:40px;
margin-bottom:60px;
flex-wrap:wrap;
}

.card{
width:180px;
padding:30px;
background:rgba(0,0,0,0.6);
backdrop-filter:blur(10px);
border-radius:15px;
}

.card h3{
margin-bottom:10px;
}

.card h1{
font-size:40px;
}

.graphs{
display:grid;
grid-template-columns: repeat(2, 1fr);
gap:40px;
width:800px;
margin:auto;
}

.graph{
background:rgba(0,0,0,0.6);
padding:20px;
border-radius:15px;
}

</style>

</head>

<body>

<div class="menu-btn" onclick="toggleMenu()">☰</div>

<div class="sidebar" id="sidebar">
<a href="Dashboard.php">Dashboard</a>
<a href="record.php">Record</a>
<a href="history.php">History</a>
<a href="#" onclick="logout()">Logout</a>
</div>

<div class="main">

<div class="title">
Compost Monitoring Dashboard
</div>

<div class="lastUpdate" id="lastUpdate">
Last Update: --
</div>

<div class="cards">

<div class="card">
<h3>Soil Moisture</h3>
<h1 id="soil">0%</h1>
</div>

<div class="card">
<h3>Bin Level</h3>
<h1 id="bin">0%</h1>
</div>

<div class="card">
<h3>Gas Level</h3>
<h1 id="gas">0</h1>
</div>

<div class="card">
<h3>Temperature</h3>
<h1 id="temp">0°C</h1>
</div>

</div>

<div class="graphs">

<div class="graph">
<canvas id="soilChart"></canvas>
</div>

<div class="graph">
<canvas id="binChart"></canvas>
</div>

<div class="graph">
<canvas id="gasChart"></canvas>
</div>

<div class="graph">
<canvas id="tempChart"></canvas>
</div>

</div>

</div>

<script>
function toggleMenu(){
document.getElementById("sidebar").classList.toggle("active");
}
</script>

<!-- 🔥 FIREBASE + REALTIME -->
<script type="module">

import { initializeApp } from "https://www.gstatic.com/firebasejs/10.7.1/firebase-app.js";
import { getDatabase, ref, onValue } from "https://www.gstatic.com/firebasejs/10.7.1/firebase-database.js";
import { getAuth, onAuthStateChanged, signOut } from "https://www.gstatic.com/firebasejs/10.7.1/firebase-auth.js";

/* FIREBASE CONFIG */
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
const db = getDatabase(app);
const auth = getAuth(app);

/* AUTH CHECK */
onAuthStateChanged(auth, (user) => {
  if (!user) {
    window.location.href = "login.php";
  }
});

/* LOGOUT */
window.logout = function(){
  signOut(auth).then(()=>{
    alert("Logout Success 👋");
    window.location.href="login.php";
  });
}

/* DATA */
let soilData=[], binData=[], gasData=[], tempData=[], labels=[];

/* CHART */
const createChart=(id,label,dataArr)=>{
return new Chart(document.getElementById(id),{
type:"line",
data:{
labels:labels,
datasets:[{
label:label,
data:dataArr,
borderColor:"white",
backgroundColor:"rgba(255,255,255,0.2)",
tension:0.4
}]
},
options:{
plugins:{legend:{labels:{color:"white"}}},
scales:{
x:{ticks:{color:"white"},grid:{color:"rgba(255,255,255,0.2)"}},
y:{ticks:{color:"white"},grid:{color:"rgba(255,255,255,0.2)"}}
}
}
});
}

const soilChart=createChart("soilChart","Soil %",soilData);
const binChart=createChart("binChart","Bin %",binData);
const gasChart=createChart("gasChart","Gas %",gasData);
const tempChart=createChart("tempChart","Temp °C",tempData);

/* REALTIME DATA */
const sensorRef = ref(db, "sensorData");

onValue(sensorRef, (snapshot) => {

  const data = snapshot.val();
  if(!data) return;

  document.getElementById("soil").innerText = data.soil_percent + "%";
  document.getElementById("bin").innerText = data.bin_percent + "%";
  document.getElementById("gas").innerText = data.gas_percent;
  document.getElementById("temp").innerHTML = data.temperature + "°C";

  document.getElementById("lastUpdate").innerText =
  "Last Update: " + new Date().toLocaleString();

  let time = new Date().toLocaleTimeString();

  labels.push(time);
  soilData.push(data.soil_percent);
  binData.push(data.bin_percent);
  gasData.push(data.gas_percent);
  tempData.push(data.methane_ppm);

  if(labels.length>10){
    labels.shift();
    soilData.shift();
    binData.shift();
    gasData.shift();
    tempData.shift();
  }

  soilChart.update();
  binChart.update();
  gasChart.update();
  tempChart.update();

});

</script>

</body>
</html>