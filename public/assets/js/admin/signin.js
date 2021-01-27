const signin = {};

signin.login = async (evt) => {
    evt.preventDefault();

    let btn = document.querySelector('button.btn-primary');
    if (btn) {
        btn.innerHTML = 'Please wait...';
        btn.disabled = true;
    }

    const email = document.getElementById('inputEmail').value;
    const pass = document.getElementById('inputPassword').value;

    const rawResponse = await fetch(evt.target.getAttribute('action'), {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Accept': 'application/json',
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ email: email, pass: pass })
    });
    const content = await rawResponse.json();

    signin.handleResponse(content);
}

signin.handleResponse = response => {
    if (response.status == 'fail') {
        alert(response.message);

        let btn = document.querySelector('button.btn-primary');
        if (btn) {
            btn.innerHTML = 'Sign In';
            btn.disabled = false;
        }
    } else if (response.status == 'ok') {
        window.location.href = './';
    }
}

window.onload = function () {
    const form = document.getElementById('signin-form');
    form.addEventListener('submit', signin.login);
}