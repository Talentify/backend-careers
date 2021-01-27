const job = {};

job.save = async (evt) => {
    evt.preventDefault();

    let btn = document.querySelector('button.btn-primary');
    if (btn) {
        btn.innerHTML = 'Aguarde, enviando...';
        btn.disabled = true;
    }

    const data = new FormData(evt.target);
    let body = {};
    data.forEach((value, key) => body[key] = value);
    let json = JSON.stringify(body);

    const rawResponse = await fetch(evt.target.getAttribute('action'), {
        method: evt.target.getAttribute('method'),
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        },
        body: json
    });
    const content = await rawResponse.json();

    job.handleResponse(content);
}

job.handleResponse = response => {
    if (response.status == 'fail') {
        alert(response.message);

        let btn = document.querySelector('button.btn-primary');
        if (btn) {
            btn.innerHTML = 'Sign In';
            btn.disabled = false;
        }
    } else if (response.status == 'ok') {
        window.location.href = '../jobs';
    }
}

window.onload = function () {
    const form = document.getElementById('job-form');
    form.addEventListener('submit', job.save);
}