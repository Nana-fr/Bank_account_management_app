// ###### HOMEPAGE ######

// ### GENERAL VARIABLES ###
let sumRegex= /^[1-9]\d+$/g;
let nameRegex= /^[\p{Letter}]{3,20}$|^[\p{Letter}]+[-][\p{Letter}]+$/gui;
let articles = document.getElementsByTagName("article");
let btnsBloc = document.getElementsByClassName("btnsBloc");

// ### LAYER ###
displayLayer();
function displayLayer() {
    let httpRequest = new XMLHttpRequest();
    httpRequest.onreadystatechange = function() {
        if (httpRequest.readyState === XMLHttpRequest.DONE) {
            if (httpRequest.status === 200) {
                let p = document.getElementById("message");
                p.innerHTML = httpRequest.responseText;
            }
        }
    };
    httpRequest.open('GET', 'data/security_rules.txt');
    httpRequest.send();
};

// Close warning window
function closeLayer() {
    document.getElementById("warning").classList.add("d-none");
}

// ### DELETE ACCOUNT ###
// function deleteAccount(clicked_id) {
//     let n= clicked_id;
//     articles[n].classList.add("d-none");
// }

// function Validate Input for all forms
function validateInput(validation, element, smallHelp, helpText) {
    if(validation) {
      element.classList.add("border", "border-success");
      element.classList.remove("border-danger");
      smallHelp.innerText = "";
    }
    else {
      element.classList.add("border", "border-danger");
      element.classList.remove("border-success");
      smallHelp.innerText = helpText;
    }
  }

// ### DEPOSIT & WITHDRAWAL ###

// Display form & hide buttons
function deployedForm(clicked_name) {
    let x = clicked_name;
    console.log(x);
    btnsBloc[0].classList.add("d-none");
    let article = document.querySelector("article");
    let form = article.querySelector(".form")
    form.classList.remove("d-none");
    // Determine deposit or withdrawal form
    if (x==="deposit") {
        form.querySelector("label").innerText = "+ Cash deposit (min 50€):";
        form.querySelector("input").name = "Deposit";
    } else {
        form.querySelector("label").innerText = "- Cash withdrawal (min 50€):";
        form.querySelector("input").name = "Withdrawal";
    }
    // Check input and calculate new balance
    // let result = 0;
    // let help = form.querySelector(".help");
    // checkInput();
    // function checkInput() {
    //     form.querySelector("button").addEventListener("click", function() {
    //         // check sum input
    //         let sum = form.querySelector("input");
    //         let validation = sum.value.match(sumRegex) && sum.value > 49;
    //         validateInput(validation, sum, help, "The minimal amount of money should be 50€");
    //         // Calculate new balance
    //         if (validation) {
    //             let balance = articles[a].querySelector("span");
    //             let lastTransaction = articles[a].querySelector(".lastTransaction");
    //             if (x==="deposit") {
    //                 result = parseInt(balance.innerText) + parseInt(sum.value);
    //                 lastTransaction.classList.add("text-success");
    //                 lastTransaction.classList.remove("text-danger");
    //                 lastTransaction.innerHTML = `+${sum.value}€ --- Deposit`;
    //             } else {
    //                 result = parseInt(balance.innerText) - parseInt(sum.value);
    //                 lastTransaction.classList.add("text-danger");
    //                 lastTransaction.classList.remove("text-success");
    //                 lastTransaction.innerHTML = `-${sum.value}€ --- Withdrawal`;
    //             }
    //             form.classList.add("d-none");
    //             btnsBloc[a].classList.remove("d-none");
    //             return balance.innerText = result; 
    //         } else {
    //             checkInput();
    //         }
    //     }, {once: true}); // To clear eventlistener memory
    // }
}


// ### CREATE ACCOUNT & TRANSFER MONEY ###

// Display form
function addForm(clicked_name) {
    document.getElementsByName(clicked_name)[0].classList.add("d-none");
    document.getElementById(clicked_name).classList.remove("d-none");
}

// ### Create new account ###
// function createAccount() {
//     let newAccount = document.getElementById("newAccount");
//     document.getElementsByName("createAccount")[0].classList.remove("d-none");
//     document.getElementById("createAccount").classList.add("d-none")
//     newAccount.innerHTML += `<article class="card col-11 col-sm-7 col-md-5 col-xl-4 mx-3 mx-lg-4 mx-xl-5 mb-5 mt-lg-5 p-0">
//                                 <h5 class="card-header bg-Kobi text-white text-center">${accountType.value} n°$$$</h5>
//                                 <div class="card-body px-0 pb-0">
//                                     <h5 class="card-title text-center fw-bold mb-3">Owner: ${firstName.value.toLowerCase()[0].toUpperCase()}${firstName.value.toLowerCase().slice(1)} ${lastName.value.toUpperCase()}</h5>
//                                     <p class="card-text">Balance: <span class="fw-bold">${deposit.value}</span>€</p>
//                                     <p class="card-text">Last transaction: <span class="lastTransaction text-success fw-bold">+${deposit.value}€ --- Deposit new account</span></p>
//                                     <ul class="px-0 pt-4 d-flex justify-content-around btnsBloc">
//                                         <li>
//                                             <a href="account.php?id=${articles.length}" class="btn btn-transaction rounded m-1">See<span class="d-none d-lg-block">more</span></a>
//                                         </li>
//                                         <li>
//                                             <a href="#" name="${articles.length}" type="deposit" class="btn btn-transaction rounded text-success m-1" onClick="deployedForm(this.name, this.type)">
//                                             <i class="fas fa-coins"></i><i class="fas fa-plus fa-xs ps-1"></i>
//                                             <span class="d-none d-lg-block">Deposit</span></a>
//                                         </li>
//                                         <li>
//                                             <a href="#" name="${articles.length}" type="withdrawal" class="btn btn-transaction rounded text-danger m-1" onClick="deployedForm(this.name, this.type)">
//                                             <i class="fas fa-coins"></i><i class="fas fa-minus fa-xs ps-1"></i>
//                                             <span class="d-none d-lg-block">Withdrawal</span></a>
//                                         </li>
//                                         <li>
//                                             <a href="#" id="${articles.length}" class="btn btn-transaction rounded m-1" onClick="deleteAccount(this.id)">
//                                             <i class="fas fa-trash-alt"></i><span class="d-none d-lg-block">Delete</span></a>
//                                         </li>
//                                     </ul>
//                                 </div>
//                                 <div class="d-none form m-3">
//                                     <form action="" method="" class="text-center pt-3">
//                                         <i class="fas fa-coins"></i><label class="mt-2" for="sum"></label>
//                                         <input type="number" class="form-control my-2" name="sum" placeholder="Ex: 70" min="50">
//                                         <small class="form-text help"></small>
//                                     </form>
//                                     <div class="d-flex justify-content-center">
//                                         <button class="btn btn-transaction my-2" type="submit" value="Confirm">Confirm</button>
//                                     </div>
//                                 </div></article>`;
// }

// Check new account form input
function checkNewAccount() {
    // check accountType select
    let accountType = document.getElementById("accountType");
    let accountTypeHelp = document.getElementById("accountTypeHelp");
    let validationAccountType = accountType.value !== "";
    validateInput(validationAccountType, accountType, accountTypeHelp, "Please select a type of account");
    // check firstName input
    let firstName = document.getElementById("firstName");
    let firstNameHelp = document.getElementById("firstNameHelp");
    let validationFirstName = firstName.value.match(nameRegex);
    validateInput(validationFirstName, firstName, firstNameHelp, "Your firstname should be between 3 and 20 characters long");
    // check lastName input
    let lastName = document.getElementById("lastName");
    let lastNameHelp = document.getElementById("lastNameHelp");
    let validationLastName = lastName.value.match(nameRegex);
    validateInput(validationLastName, lastName, lastNameHelp, "Your lastname should be between 3 and 20 characters long");
    // check deposit input
    let deposit = document.getElementById("deposit");
    let depositHelp = document.getElementById("depositHelp");
    let validationDeposit = deposit.value.match(sumRegex) && deposit.value > 49;
    validateInput(validationDeposit, deposit, depositHelp, "The minimal amount of money should be 50€");
    // check all input are valid
    if (validationAccountType && validationFirstName && validationLastName && validationDeposit) {
        createAccount()
    }
}


// ### Transfer money ###
function transferMoney() {
    let balanceDebit = articles[accountDebit.value].querySelector("span");
    let lastTransactionDebit = articles[accountDebit.value].querySelector(".lastTransaction");
    let balanceCredit = articles[accountCredit.value].querySelector("span");
    let lastTransactionCredit = articles[accountCredit.value].querySelector(".lastTransaction");
    // calculate new balance
    let resultDebit = 0;
    let resultCredit = 0;
    resultDebit = parseInt(balanceDebit.innerText) - parseInt(sumTransfer.value);
    resultCredit = parseInt(balanceCredit.innerText) + parseInt(sumTransfer.value);
    // display new balance
    balanceDebit.innerText = resultDebit;
    balanceCredit.innerText = resultCredit;
    //display last operation
    //for debit account
    lastTransactionDebit.innerHTML = `-${sumTransfer.value}€ --- Transfer to ${articles[accountCredit.value].querySelector("h5").innerText}`;
    lastTransactionDebit.classList.add("text-danger");
    lastTransactionDebit.classList.remove("text-success");
    // for credit account
    lastTransactionCredit.innerText = `+${sumTransfer.value}€ --- Transfer from ${articles[accountDebit.value].querySelector("h5").innerText}`;
    lastTransactionCredit.classList.remove("text-danger");
    lastTransactionCredit.classList.add("text-success");
    // hide form & display button
    document.getElementById("transferMoney").classList.add("d-none")
    document.getElementsByName("transferMoney")[0].classList.remove("d-none");
}

// Check transfer money form input
function checkTransferMoney() {
    // check accountDebit select
    let accountDebit = document.getElementById("accountDebit");
    let accountDebitHelp = document.getElementById("accountDebitHelp");
    let validationAccountDebit = accountDebit.value !== "";
    validateInput(validationAccountDebit, accountDebit, accountDebitHelp, "Please select an account");
    // check sumTransfer input
    let sumTransfer = document.getElementById("sumTransfer");
    let sumTransferHelp = document.getElementById("sumTransferHelp");
    let validationSumTransfer = sumTransfer.value.match(sumRegex) && sumTransfer.value > 49;
    validateInput(validationSumTransfer, sumTransfer, sumTransferHelp, "The minimal amount of money should be 50€");
    // check accountCredit select
    let accountCredit = document.getElementById("accountCredit");
    let accountCreditHelp = document.getElementById("accountCreditHelp");
    let validationAccountCredit = accountCredit.value !== "";
    validateInput(validationAccountCredit, accountCredit, accountCreditHelp, "Please select an account");
    // check accountDebit and accountCredit are different
    if (accountDebit.value === accountCredit.value) {
        validationAccountDebit = false;
        validateInput(validationAccountDebit, accountDebit, accountDebitHelp, "You can't select the same account");
        validationAccountCredit = false;
        validateInput(validationAccountCredit, accountCredit, accountCreditHelp, "You can't select the same account");
    }
    // check all input are valid
    if (validationAccountDebit && validationSumTransfer && validationAccountCredit) {
        transferMoney()
    }
}