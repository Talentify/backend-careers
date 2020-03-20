/**
 * For new module change const MODULE and function makeForm
 */
"use strict";

const MODULE = 'vacancies';
const URL = `${URL_BASE}/${MODULE}`;
$(document).ready(main);

function main() {
    pageForm(makeForm);
}

function makeForm(data) {
    $("#id").val(data.data.id);
    $("#title").val(data.data.title);
    $("#description").val(data.data.description);
    $("#status").val(data.data.status);
    $("#workplace").val(data.data.workplace);
    $("#salary").val(data.data.salary);
}
