// ##### Statistics page #####

fetch('data/statistics.json')
.then(function(data) {
    if(data.ok) {
        data.json().then(function(data){
            let table = document.getElementById("table");
            for (let value in data) {
                table.innerHTML += `<td>${value}</td><td>${data[value]}</td>`;   
            }
        })
    }
});