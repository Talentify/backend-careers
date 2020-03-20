"use strict";

const URL_BASE = '/api';

function request_get(url, action) {
    request_ajax({ method: "GET", url }, action);
}

function request_post(url, action, data = 0) {
    request_ajax({ method: "POST", url, data }, action);
}

function request_update(url, action, data = 0) {
    request_ajax({ method: "PUT", url, data }, action);
}

function request_delete(url, action) {
    $.ajax({ method: "DELETE", url }, action)
        .done((msg) => { action(msg); })
        .fail((e) => { console.log(e); });
}

async function getUserDataWithPromise(url) {
    var xhr = new XMLHttpRequest();
    return new Promise(function(resolve, reject) {
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4) {
                if (xhr.status >= 300) {
                    reject("Error, status code = " + xhr.status)
                } else {
                    resolve(xhr.responseText);
                }
            }
        }
        xhr.open('get', url, true)
        xhr.send();
    });
}

function request_ajax(option, action) {
    load_waiting();
    $.ajax(option)
        .done((msg) => {
            action(msg);
            setTimeout(() => {
                $('#modalWaiting').modal('hide');
            }, 500);
        })
        .fail((e) => { console.log(e); });
}

function load_waiting() {
    if (!$('#modalWaiting').length) {
        let modalWaiting = `<div class="modal fade" id="modalWaiting" tabindex="-1" role="dialog" aria-labelledby="modalWaiting" aria-hidden="true">
                                <div class="modal-dialog" role="document">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title">Enviando requisição</h5>
                                        </div>
                                        <div class="modal-body">
                                            <div class="d-flex justify-content-center">
                                                <div class="spinner-border" role="status">
                                                    <span class="sr-only">Loading...</span>
                                                </div>
                                            </div>
                                            <p class="text-center">Aguarde enquanto o sistema esta trabalhando...</p>
                                        </div>
                                    </div>
                                </div>
                            </div>`;
        $("body").append(modalWaiting);
    }
    $('#modalWaiting').modal('show');
}

function load_toast(cor, title, description) {
    if (!$('.toast').length) {
        let toast = `<div style="position: absolute; top: 0; right: 0; z-index: 999;">
                        <div class="toast" style="background: #${cor};" data-delay="9000" role="alert" aria-live="assertive" aria-atomic="true">
                            <div class="toast-header">
                                <img src="https://via.placeholder.com/20/${cor}/808080/?text=+" class="rounded mr-2" id="imgtoast"
                                    alt="">
                                <strong class="mr-auto">&nbsp;${title}!&nbsp;</strong>
                                <small class="text-muted">&nbsp;agora&nbsp;</small>
                                <button type="button" class="ml-2 mb-1 close" data-dismiss="toast" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="toast-body">${description}</div>
                        </div>
                    </div>`;
        $("body").append(toast);
    }
    $('.toast').toast('show');
    $([document.documentElement, document.body]).animate({
        scrollTop: $("body").offset().top
    }, 500);
}

function validatedForm() {
    let form = document.getElementsByClassName('needs-validation')[0];
    if (form.checkValidity() === false) {
        event.preventDefault();
        event.stopPropagation();
        form.classList.add('was-validated');
        $('.alert').show();
    } else {
        event.preventDefault();
        event.stopPropagation();
        sendData();
    }
}

function pageSee(action) {
    // Active tooltip
    $('[data-toggle="tooltip"]').tooltip();
    let id = window.location.search.substr(1);
    if ($.isNumeric(id)) {
        request_get(`${URL}/${id}`, action);
    }
    $("a[href*='edit']").attr("href", `/${window.location.pathname.split("/")[1]}/edit?${id}`);
}

function pageForm(action) {
    // Active tooltip
    $('[data-toggle="tooltip"]').tooltip();
    let id = window.location.search.substr(1);
    if ($.isNumeric(id)) {
        request_get(`${URL}/${id}`, action);
    }
    document.getElementById("submit").addEventListener("click", validatedForm);
}

function pageRead(action) {
    request_get(URL, action);
    // Active tooltip
    $('[data-toggle="tooltip"]').tooltip();

    // Active modal and edit description
    $("tbody").on("click", "a[href*=ModalRemove]", function() {
        $('#idDrop').val($(this).data('id'));
        $('#descriptionDrop').text($(this).data('description'));
    });

    // Action of the remove with effect
    $("button[name*='btnDrop']").on('click', function() {
        remove($(this));
    });
}

function sendData() {
    let data = $('form').serializeArray();
    let id = window.location.search.substr(1);
    if ($.isNumeric(id)) {
        request_update(`${URL}/${id}`, function() {
            load_toast('FFC107', 'Edição concluída', 'Registro editado com succeso.');
        }, data);
    } else {
        request_post(URL, function() {
            load_toast('28A745', 'Cadastrado concluído', 'Registro adicionado com succeso.');
        }, data);
    }
}

function remove(elem) {
    elem.attr("disabled", true);
    elem.text('');
    elem.append(`<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                    Removendo...`);
    let id = $("#idDrop").val();
    request_delete(`${URL}/${id}`, (data) => {
        $("tbody").find("[data-id='" + id + "']").parent().parent().remove();
        $('.modal-header>button').click();
        elem.attr("disabled", false);
        elem.text('Remover');
        load_toast('FF0000', 'Remoção concluída', 'Registro excluido com sucesso.');
    });
}