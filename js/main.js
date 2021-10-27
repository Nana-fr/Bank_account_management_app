let httpRequest = new XMLHttpRequest();

getLayer();

function getLayer() {
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

function closeLayer() {
    document.getElementById("warning").classList.add("Done");
}