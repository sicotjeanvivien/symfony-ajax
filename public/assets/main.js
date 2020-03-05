    console.log('start sccript');

    //--SHOW--
    //listerner Load page 
    window.addEventListener('load',  () => {
        let url = document.querySelector('#urlShow').value

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                let response = JSON.parse(this.responseText);
                document.getElementById("error").innerHTML = response.error;
                document.querySelector("#tbody").innerHTML = response.view
            }
        };
        xhttp.open("GET", url, true);
        xhttp.send();
    }, false);


    //CREATE 
    document.querySelector('#createModalSend').addEventListener("click", () => {

        let url = document.querySelector('#urlCreate').value;
        // document.getElementById('createModal').classList.toggle('show');
        let data = {
            'title': document.querySelector('#titleCreate').value,
            'content': document.querySelector('#contentCreate').value,
            'author': document.querySelector('#authorCreate').value,
            'datePublished': document.querySelector('#dateCreate').value,
        };

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                let response = JSON.parse(this.responseText);
                document.getElementById("error").innerHTML = response.error;
                document.querySelector("#tbody").innerHTML = response.view
            }
        };
        xhttp.open("POST", url, true);
        xhttp.send(JSON.stringify(data));
    }, false);


    //DELETE    
    function deleteModalId(elem) {
        let id = elem.dataset.id;
        console.log(id)
        document.getElementById('deleteModalSend').value = id;
    }

    document.querySelector('#deleteModalSend').addEventListener("click", function (e) {
        console.log(e.target)
        let url = document.querySelector('#urlDelete').value
        let data = {
            'id': e.target.value
        };

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                let response = JSON.parse(this.responseText);
                document.getElementById("error").innerHTML = response.error;
                document.querySelector("#tbody").innerHTML = response.view
            }
        };
        xhttp.open("POST", url, true);
        xhttp.send(JSON.stringify(data));
    }, false);


    //UPDATE
    const  updateGetData = (e)=> {
        let url = document.querySelector('#urlUpdateGetData').value;
        //Bug
        document.getElementById('createModalSend').classList.toggle('d-none');
        document.getElementById('updateModalSend').classList.toggle('d-none');
        console.log(e.value)

        document.getElementById('updateModalSend').value = e.dataset.id;

        let data = {
            'id': e.dataset.id,
        };

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                let response = JSON.parse(this.responseText);
                document.getElementById("error").innerHTML = response.error;
                document.querySelector("#createModalContent").innerHTML = response.view
            }
        };
        xhttp.open("POST", url, true);
        xhttp.send(JSON.stringify(data));
    }

    document.querySelector('#updateModalSend').addEventListener("click", function (e) {
        console.log(e.target)
        let url = document.querySelector('#urlUpdateDataSend').value;
        // document.getElementById('createModal').classList.toggle('show');
        let data = {
            'id': e.target.value,
            'title': document.querySelector('#titleCreate').value,
            'content': document.querySelector('#contentCreate').value,
            'author': document.querySelector('#authorCreate').value,
            'datePublished': document.querySelector('#dateCreate').value,
        };

        console.log(data)

        var xhttp = new XMLHttpRequest();
        xhttp.onreadystatechange = function () {
            if (this.readyState == 4 && this.status == 200) {
                let response = JSON.parse(this.responseText);
                document.getElementById("error").innerHTML = response.error;
                document.querySelector("#tbody").innerHTML = response.view;

                document.getElementById('createModalSend').classList.toggle('d-none');
                document.getElementById('updateModalSend').classList.toggle('d-none');
            }
        };
        xhttp.open("POST", url, true);
        xhttp.send(JSON.stringify(data));
    }, false);



