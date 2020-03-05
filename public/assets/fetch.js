let fetchGet = () => {
    console.log('start fetch Get');
    let url = document.getElementById('urlFetchGet').value;
    fetch(url)
        .then(function (response) {
            console.log(response)
            return response.json();
        })
        .then(function (response) {
            console.log('response Get Json')
            document.querySelector('#getResponseFetch').innerText = response;
        });
}

let fetchPost = () => {
    console.log('start fetch Post');
    let url = document.querySelector('#urlFetchPost').value;
    let data = document.querySelector('#fetchPostRequest').value;
    console.log('data: ' + data);

    fetch(url, {
        method: 'POST', 
        headers: {
            'Content-Type': 'application/json',
        },
        body: JSON.stringify(data),
    })
        .then((response) => response.json())
        .then((response) => {
            console.log('Success: '+ response);
            document.querySelector('#postResponseFetch').innerText = response;
        })

}