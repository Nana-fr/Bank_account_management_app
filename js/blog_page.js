// ##### Blog page #####

fetch('https://oc-jswebsrv.herokuapp.com/api/articles')
.then(function(response) {
    if (response.ok) {
        response.json().then(function(response) {
            let blog = document.getElementById("blog");
                for (let i=0; i<response.length; i++) {
                    // create new article with the information gotten
                    blog.innerHTML += `<article class="card col-10 col-sm-7 col-md-5 col-lg-4 col-xl-3 mb-5 mt-md-5 mx-2 mx-md-4 p-0">
                                            <h5 class="card-header bg-Kobi text-white">${response[i].titre} n°${response[i].id}</h5>
                                            <p class="card-body">${response[i].contenu}</p>
                                            <div class="d-flex justify-content-center pb-2">
                                                <button class="btn btn-transaction m-1">See</button>
                                            </div>
                                        </article>`;
                }
        })
    }
});