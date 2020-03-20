/**
 * For new module change const MODULE and function makeSee
 */
"use strict";

const MODULE = 'vacancies';
const URL = `${URL_BASE}/${MODULE}`;
$(document).ready(main);

function main() {
    pageSee(makeSee);
}

async function makeSee(data) {
    let my_data = JSON.parse(await getUserDataWithPromise('/js/vacancies/data.json'));
    // Mount See
    for (let prop in data.data) {
        switch (prop) {
            case 'deleted_at':
                continue;
        }
        let div = `<div class="form-group row">
                        <strong class="col-sm-2">${my_data[prop]}:</strong>
                        <div class="col-sm-10">
                            <em>${data.data[prop]}</em>
                        </div>
                    </div>`;

        $(".card-body").append(div);
    }
}
