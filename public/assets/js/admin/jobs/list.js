let job = {};

job.remove = async (elm) => {
    if (confirm('Tem certeza que deseja remover esta vaga? Essa ação é irreversível')) {
        const rawResponse = await fetch(elm.getAttribute('href'), {
            method: 'DELETE',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
                'Accept': 'application/json',
                'Content-Type': 'application/json'
            }
        });
        const content = await rawResponse.json();

        job.handleResponse(content);
    }
}

job.handleResponse = response => {
    if (response.status == 'fail') {
        alert(response.message);
    } else if (response.status == 'ok') {
        window.location.reload();
    }
}

window.onload = function () {
    const btns = document.getElementsByClassName('job-delete');
    console.log(btns);

    [].forEach.call(btns, (elm) => {
        elm.addEventListener('click', (evt) => {
            evt.preventDefault();
            job.remove(elm);
        });
    });
}