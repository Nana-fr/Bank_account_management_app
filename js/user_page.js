let enableAll = document.getElementById("enableAll");
let allInput = document.getElementsByTagName("input");
let btnsubmit = document.getElementById("submit");
let editBtns = document.getElementsByClassName("editBtn");
let cancelBtn = document.getElementById("cancel");

function enableAllInput() {
    enableAll.classList.add("d-none");
    Object.values(editBtns).forEach(btn=>btn.classList.add("d-none"));
    Object.values(allInput).forEach(input=>input.disabled=false);
    btnsubmit.classList.remove("d-none");
    cancelBtn.classList.remove("d-none");
}

function enableInput(clicked_id, event) {
    event.preventDefault();
    let editInput = clicked_id;
    document.getElementById(editInput).classList.add("d-none");
    let input = document.getElementById(editInput).previousElementSibling;
    input.disabled=false;
    btnsubmit.classList.remove("d-none");
    cancelBtn.classList.remove("d-none");
}
