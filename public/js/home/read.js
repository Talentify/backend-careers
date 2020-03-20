/**
 * For new module change const MODULE and function makeTable
 */
"use strict";

const MODULE = 'vacancies';
const URL = `${URL_BASE}/${MODULE}`;
$(document).ready(main);

function main() {
    pageRead(makeTable);
}

function makeTable(data) {
    // Mount table
    data.data.forEach((value, index) => {
        let newRow = $("<tr>"),
            cols = "";
        cols += `<td> ${value.title} </td>`;
        cols += `<td> ${value.description} </td>`;
        cols += `<td> R$ ${Number(value.salary).toFixed(2).split('.')} </td>`;
        newRow.append(cols);

        $(".table").append(newRow);
    });
    // Active datatable in pt-br
    $('.table').DataTable({
        "aLengthMenu": [
            [5, 10, 25, -1],
            [5, 10, 25, "All"]
        ],
        "iDisplayLength": 5,
        "language": {
            "url": "//cdn.datatables.net/plug-ins/1.10.19/i18n/Portuguese-Brasil.json"
        }
    });
    // Active tooltip
    $('[data-toggle="tooltip"]').tooltip();
}
