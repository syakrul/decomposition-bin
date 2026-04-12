setInterval(function(){

  fetch("API/influx_get.php")
    .then(res => res.json())
    .then(data => {

      console.log(data);

      document.getElementById("soil").innerText = data.soil_percent + "%";
      document.getElementById("bin").innerText = data.bin_percent + "%";
      document.getElementById("gas").innerText = data.gas_percent;
      document.getElementById("methane").innerText = data.methane_ppm;

    });

}, 3000);