<?php
session_start();

/*
|--------------------------------------------------------------------------
| OPTIONAL: SIMPAN HISTORY (JIKA SESSION ADA)
|--------------------------------------------------------------------------
| Kita elakkan MySQL error dengan check dulu
|--------------------------------------------------------------------------
*/

if (isset($_SESSION['username'])) {

    $username = $_SESSION['username'];

    // OPTIONAL: kalau nak simpan history, kena pastikan DB hidup
    // Kalau tak nak guna DB langsung, boleh delete block ini

    /*
    require_once "config.php";

    if ($conn) {
        $conn->query("INSERT INTO user_history(username,action)
        VALUES('$username','Logout')");
    }
    */
}

/* DESTROY SESSION (SAFE) */
session_destroy();

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Logout</title>
</head>
<body>

<script type="module">

import { initializeApp } from "https://www.gstatic.com/firebasejs/10.7.1/firebase-app.js";
import { getAuth, signOut } from "https://www.gstatic.com/firebasejs/10.7.1/firebase-auth.js";

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

/* 🔥 LOGOUT FIREBASE */
signOut(auth).then(() => {

    alert("Logout Success 👋");
    window.location.href = "login.php";

}).catch((error) => {

    alert("Error: " + error.message);

});

</script>

</body>
</html>