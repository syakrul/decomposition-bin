fetch("API/record_list.php")

.then(res=>res.json())

.then(data=>{

let table=document.getElementById("recordTable");

data.forEach(row=>{

table.innerHTML+=`

<tr>
<td>${row.id}</td>
<td>${row.soil_percent}%</td>
<td>${row.gas_percent}</td>
<td>${row.bin_percent}%</td>
<td>${row.compost_condition}</td>
</tr>

`;

});

});