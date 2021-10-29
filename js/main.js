// ##### Homepage #####

// layer
window.addEventListener("load", function() {
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
});

// close warning window
function closeLayer() {
    document.getElementById("warning").classList.add("Done");
}


let articles = document.getElementsByTagName("article");

// deposit & withdrawal
let btnsBloc = document.getElementsByClassName("btnsBloc");
function deployedForm(clicked_name, clicked_type) {
    let a = clicked_name;
    let x = clicked_type;
    btnsBloc[a].classList.add("d-none");
    let form = articles[a].querySelector(".form")
    form.classList.remove("d-none");
    if (x==="deposit") {
        form.querySelector("label").innerText = "+ Cash deposit:";
    } else {
        form.querySelector("label").innerText = "- Cash withdrawal:";
    }
    let result = 0;
    form.querySelector("button").addEventListener("click", function() {
        let sum = form.querySelector("input").value;
        let balance = articles[a].querySelector("span");
        if (x==="deposit") {
            result = parseInt(balance.innerText) + parseInt(sum); 
        } else {
            result = parseInt(balance.innerText) - parseInt(sum);
        }
        form.classList.add("d-none");
        btnsBloc[a].classList.remove("d-none");
        return balance.innerText = result;
    }, {once: true});

}


// delete account
function deleteAccount(clicked_id) {
    let n= clicked_id;
    articles[n].classList.add("Done");
}

// create account
// 1. add form
function addForm() {
    document.getElementById("createbtn").classList.add("Done");
    document.getElementById("form").classList.remove("Done");
}
// 2. create account
function createAccount() {
let accountType = document.getElementById("accountType").value;
let firstName = document.getElementById("firstName").value;
let lastName = document.getElementById("lastName").value.toUpperCase();
let deposit = document.getElementById("deposit").value;
let newAccount = document.getElementById("newAccount");
newAccount.classList.remove("Done");
document.getElementById("form").classList.add("Done")
newAccount.innerHTML = `<h5 class="card-header bg-Kobi color2 text-center">${accountType} n°$$$</h5>
                        <div class="card-body px-0 pb-0 text-center">
                            <h5 class="card-title">Owner: ${firstName[0].toUpperCase()}${firstName.slice(1)} ${lastName}</h5>
                            <p class="card-text mb-2">Balance: <span>${deposit}</span>€</p>
                            <ul class="px-0 pt-4 d-flex justify-content-around btnsBloc">
                                <a href="#" class="btn btn-transaction rounded m-1">See<span class="d-none d-lg-block">more</span></a>
                                <a href="#" name="3" type="deposit" class="btn btn-transaction rounded text-success m-1" onClick="deployedForm(this.name, this.type)"><i class="fas fa-coins"></i><i class="fas fa-plus fa-xs ps-1"></i><span class="d-none d-lg-block">Deposit</span></a>
                                <a href="#" name="3" type="withdrawal" class="btn btn-transaction rounded text-danger m-1" onClick="deployedForm(this.name, this.type)"><i class="fas fa-coins"></i><i class="fas fa-minus fa-xs ps-1"></i><span class="d-none d-lg-block">Withdrawal</span></a>
                                <a href="#" id="3" class="btn btn-transaction rounded m-1" onClick="deleteAccount(this.id)"><i class="fas fa-trash-alt"></i><span class="d-none d-lg-block">Delete</span></a>
                            </ul>
                        </div>
                        <div class="d-none form m-3">
                            <form action="" method="" class="text-center pt-3">
                                <i class="fas fa-coins"></i><label class="mt-2" for="sum"></label>
                                <input type="number" class="form-control my-2" name="sum" placeholder="Ex: 70" min="50">
                            </form>
                            <div class="d-flex justify-content-center">
                                <button class="btn btn-transaction my-2" type="submit" value="Confirm">Confirm</button>
                            </div>
                        </div>`;
} 

// ##### Statistics page #####
getRate()
function getRate() {
    httpRequest = new XMLHttpRequest();
    httpRequest.onreadystatechange = function() {
        if (httpRequest.readyState === XMLHttpRequest.DONE) {
            if (httpRequest.status === 200) {
                let data = JSON.parse(httpRequest.responseText);
                let table = document.getElementById("table");
                for (let value in data) {
                    table.innerHTML += `<td>${value}</td><td>${data[value]}</td>`;   
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

// ##### blog page #####
getArticles();
function getArticles() {
    let httpRequest = new XMLHttpRequest();
    httpRequest.onreadystatechange = function() {
        if (httpRequest.readyState === XMLHttpRequest.DONE) {
            if (httpRequest.status === 200) {
                let response = JSON.parse(httpRequest.responseText);
                let blog = document.getElementById("blog");
                for (let i=0; i<response.length; i++) {
                    blog.innerHTML += `<article class="card col-10 col-sm-7 col-md-5 col-lg-4 col-xl-3 mb-5 mt-md-5 mx-2 mx-md-4 p-0">
                                        <h5 class="card-header">${response[i].titre} n°${response[i].id}</h5>
                                        <p class="card-body">${response[i].contenu}</p>
                                        <div class="d-flex justify-content-center pb-2">
                                        <button class="btn btn-transaction m-1">See</button>
                                        </div></article>`;
                    }       
            } else {
                console.log("une erreur est survenue");
            }
        };
    }
httpRequest.open('GET', 'https://oc-jswebsrv.herokuapp.com/api/articles');
httpRequest.send();
}