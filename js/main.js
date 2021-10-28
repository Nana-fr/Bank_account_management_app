// layer
getLayer();
function getLayer() {
    let httpRequest = new XMLHttpRequest();
    httpRequest.onreadystatechange = function() {
        if (httpRequest.readyState === XMLHttpRequest.DONE) {
            if (httpRequest.status === 200) {
                let p = document.getElementById("message");
                p.innerText = httpRequest.responseText;
            } else {
                console.log("une erreur est survenue");
            }
        } else {
            console.log("chargement en cours");
        }
    };
    httpRequest.open('GET', 'data/security_rules.txt');
    httpRequest.send();
}

// close warning window
function closeLayer() {
    document.getElementById("warning").classList.add("Done");
}

// delete account
let articles = document.getElementsByTagName("article");
console.log(articles)
function deleteAccount(clicked_id) {
    let n= clicked_id;
    articles[n].classList.add("Done");
}

// create account
function createAccount() {
let accountType = document.getElementById("accountType").value;
let firstName = document.getElementById("firstName").value;
let lastName = document.getElementById("lastName").value;
let deposit = document.getElementById("deposit").value;
let newAccount = document.getElementById("newAccount");
newAccount.innerHTML = `<h5 class="card-header">${accountType} n°$$$$$$$</h5>
                        <div class="card-body">
                        <h5 class="card-title">Owner: ${firstName} ${lastName}</h5>
                        <p class="card-text">Balance: ${deposit}€</p>
                        <a href="#" class="btn btn-primary m-1">See</a>
                        <a href="#" class="btn btn-success m-1">Deposit</a>
                        <a href="#" class="btn btn-dark m-1">Withdrawal</a>
                        <a href="#" id="2" class="btn btn-danger m-1" onClick="deleteAccount(this.id)">Delete</a>
                        </div>`
} 

// statistics page
getRate()
function getRate() {
    httpRequest = new XMLHttpRequest();
    httpRequest.onreadystatechange = function() {
        if (httpRequest.readyState === XMLHttpRequest.DONE) {
            if (httpRequest.status === 200) {
                let data = JSON.parse(httpRequest.responseText);
                let table = document.getElementById("table");
                for (let value in data) {
                    table.innerHTML += `<td>${value}</td><td>$</td><td>${data[value]}</td>`;   
                }
            } else {
                console.log("une erreur est survenue");
            }
            } else {
                console.log("chargement en cours");
            }
        };
    httpRequest.open('GET', 'data/statistics.json');
    httpRequest.send();
}

// blog page
getArticles();
function getArticles() {
        let httpRequest = new XMLHttpRequest();
        httpRequest.onreadystatechange = function() {
            if (httpRequest.readyState === XMLHttpRequest.DONE) {
                if (httpRequest.status === 200) {
                    let response = JSON.parse(httpRequest.responseText);
                    let blog = document.getElementById("blog");
                    let blog1 = document.getElementById("blog1");
                    let blog2 = document.getElementById("blog2");
                        for (let key in response[0]) {
                            blog.innerHTML += `<p>${key} : ${response[0][key]}</p>`;
                        }
                        blog.innerHTML += `<button class="btn btn-primary m-1">See</button>`;
                        for (let key in response[1]) {
                            blog1.innerHTML += `<p>${key} : ${response[1][key]}</p>`;
                        }
                        blog1.innerHTML += `<button class="btn btn-primary m-1">See</button>`;
                        for (let key in response[2]) {
                            blog2.innerHTML += `<p>${key} : ${response[2][key]}</p>`;
                        }
                        blog2.innerHTML += `<button class="btn btn-primary m-1">See</button>`;
                } else {
                    console.log("une erreur est survenue");
                    }
                };
            }
    httpRequest.open('GET', 'https://oc-jswebsrv.herokuapp.com/api/articles');
    httpRequest.send();
}