let logo_y = 0, logo_up = true;

$(document).ready(function(){
    $('.sidenav').sidenav();
    setInterval(diaOfLogo, 80);
    loadHomePage();
});

/**
 * Support functions
 */

function diaOfLogo() {
    if (logo_up) {
        ++logo_y;
        if (logo_y >= 292) { logo_up = false; }
    } else {
        --logo_y;
        if (logo_y <= 0) { logo_up = true; }
    }
    $('#logo-dia').css('backgroundPosition', '0px ' + (logo_y * -125) + 'px');
}

function showLoader() {
    $('div.overlay').show();
}

function hideLoader() {
    $('div.overlay').hide();
}

function addPagination(pager, callback) {
    let html = '    <ul class="pagination">\n';
    if (pager.previous > 0) {
        html +=
            '        <li>' +
            '            <a href="javascript:' + callback + '(' + pager.previous + ');"><i class="material-icons">chevron_left</i></a>' +
            '        </li>\n';
    } else {
        html +=
            '        <li class="disabled">' +
            '            <a href="javascript:void(0);"><i class="material-icons">chevron_left</i></a>' +
            '        </li>\n';
    }
    for (let i = 4; i > 0; i--) {
        let previousIndex = pager.current - i;
        if (previousIndex > 0) {
            html +=
                '        <li>' +
                '            <a href="javascript:' + callback + '(' + previousIndex + ');">' + previousIndex + '</a>' +
                '        </li>\n';
        }
    }
    html +=
        '        <li class="active">' +
        '            <a href="javascript:' + callback + '(' + pager.current + ');">' + pager.current + '</a>' +
        '        </li>\n';
    for (let i = 1; i < 5; i++) {
        let nextIndex = pager.current + i;
        if (nextIndex <= pager.count) {
            html +=
                '        <li>' +
                '            <a href="javascript:' + callback + '(' + nextIndex + ');">' + nextIndex + '</a>' +
                '        </li>\n';
        }
    }
    if (pager.next > 0) {
        html +=
            '        <li>' +
            '            <a href="javascript:' + callback + '(' + pager.next + ');"><i class="material-icons">chevron_right</i></a>' +
            '        </li>\n';
    } else {
        html +=
            '        <li class="disabled">' +
            '            <a href="javascript:void(0);"><i class="material-icons">chevron_right</i></a>' +
            '        </li>\n';
    }
    html += '    </ul>';

    return html;
}

function showDeleteModal(id, name, callback) {
    let modal = $('<div/>', {'id': 'modal-delete', 'class': 'modal'})
        .append(
            $('<div/>', {'class': 'modal-content'})
                .append($('<h4/>').text('Delete ' + name))
                .append($('<p/>').text('Are you sure?'))
        )
        .append(
            $('<div/>', {'class': 'modal-footer'})
                .append($('<a/>', {'class': 'modal-close btn-flat'}).text('No'))
                .append($('<a/>', {'onclick': callback + '(' + id + ');', 'class': 'modal-close btn-flat'}).text('Yes'))
        )
        .appendTo('body')
        .modal(
            {
                'dismissible': false,
                'preventScrolling': false,
                'onCloseEnd': function() {
                    this.destroy();
                    $('div#' + this.id).remove();
                }
            }
        );
    let modalInstance = M.Modal.getInstance(modal);
    modalInstance.open();
}

/**
 * Support pages
 */

function loadErrorPage(jqXHR) {
    let response, message, IS_JSON = true;

    try {
        response = $.parseJSON(jqXHR.responseText);
    } catch(err) {
        IS_JSON = false;
    }

    if(IS_JSON) {
        if(
            typeof response.class !== "undefined"
            && typeof response.detail !== "undefined"
        ) {
            message = response.class + ': ' + response.detail;
        } else if(Array.isArray(response)) {
            message = '<ul>';
            for (let i = 0; i < response.length; i++) {
                message += "<li>" + response[i].message + "</li>";
            }
            message += '</ul>';
        } else {
            message = '';
        }
    } else {
        message = jqXHR.status + ': ' + jqXHR.statusText;
    }

    $('div#content').html(
        '    <h3 class="header">Error</h3>\n' +
        '    <div class="card error red lighten-2">\n' +
        '        <div class="card-content white-text valign-wrapper">\n' +
        '            <i class="medium material-icons">error</i>\n' +
        '            <p>' + message + '</p>\n' +
        '        </div>\n' +
        '    </div>\n'
    );

    $('#slide-out').sidenav('close');
}

function loadInformationPage(message) {
    $('div#content').html(
        '    <h3 class="header">Information</h3>\n' +
        '    <div class="card error yellow darken-2">\n' +
        '        <div class="card-content white-text valign-wrapper">\n' +
        '            <i class="medium material-icons">info</i>\n' +
        '            <p>' + message + '</p>\n' +
        '        </div>\n' +
        '    </div>\n'
    );

    $('#slide-out').sidenav('close');
}

function loadUnderConstructionPage(title) {
    $('div#content').html(
        '    <h3 class="header">' + title + '</h3>\n' +
        '    <div class="card error blue-grey darken-2">\n' +
        '        <div class="card-content white-text valign-wrapper">\n' +
        '            <i class="medium material-icons">construction</i>\n' +
        '            <p>Under construction</p>\n' +
        '        </div>\n' +
        '    </div>\n'
    );

    $('#slide-out').sidenav('close');
}

function loadHomePage() {
    $.ajax({
        url: '/api/v1/housingstocks',
        type: 'GET',
        dataType: 'json',
        accepts: {
            json: 'application/json'
        },
        beforeSend: function() {
            showLoader();
            $('#slide-out').sidenav('close');
        },
        success: function(data) {
            let select2Html = '            <select id="active_housingstock_select" style="width: 100%;">\n' +
                '                <option></option>\n';
            $(data.data).each(function (index, element) {
                if (parseInt(localStorage.getItem('activeHousingstockId')) === parseInt(element.id)) {
                    select2Html += '                <option value="' + element.id + '" selected="selected">' + element.code + ' ' + element.name + '</option>\n';
                } else {
                    select2Html += '                <option value="' + element.id + '">' + element.code + ' ' + element.name + '</option>\n';
                }
            });
            select2Html += '</select>\n';

            $('div#activeHousingstockSelector').html(select2Html);

            $('div#content').html('<h3 class="header">Building Examinator</h3>\n' +
                '<p>This is the testing application for our app the Building Examinator.</p>\n'
            );

            $('select#active_housingstock_select').select2({
                maximumInputLength: 20,
                placeholder: "Select active housingstock",
                allowClear: true
            }).change(function () {
                let selectedActiveHousingstock = $(this).select2('data').shift();
                if (typeof selectedActiveHousingstock === 'undefined') {
                    localStorage.removeItem('activeHousingstockId');
                } else {
                    localStorage.setItem('activeHousingstockId', selectedActiveHousingstock.id);
                }
            });
        },
        error: function(jqXHR) {
            loadErrorPage(jqXHR);
        },
        complete: function() {
            hideLoader();
        },
    });
}

function loadTestPage() {
    $('div#content').html(
        '    <h3 class="header">Test page</h3>\n' +
        '    <h4 class="header">Make image and upload</h4>\n' +
        '    <div class="row">\n' +
        '        <div class="col s12">\n' +
        '            <form id="test">\n' +
        '                <div class="row">\n' +
        '                    <div class="input-field col s12">\n' +
        '                        <label class="custom-file-upload">\n' +
        '                            <input id="imageUpload" type="file" accept="image/*" capture="environment" />\n' +
        '                            Custom Upload\n' +
        '                        </label>\n' +
        '                    </div>\n' +
        '                </div>\n' +
        '            </form>\n' +
        '        </div>\n' +
        '    </div>\n' +
        '    <div class="row">\n' +
        '        <div class="col s12">\n' +
        '            <img width="200px" id="imagePreview" src="#" alt="Image preview" />\n' +
        '        </div>\n' +
        '    </div>\n'
    );

    $('img#imagePreview').materialbox();

    imageUpload.onchange = evt => {
        const [file] = imageUpload.files
        if (file) {
            imagePreview.src = URL.createObjectURL(file)
        }
    }
}

/**
 * Owners
 */

function loadOwnersPage(page = 1) {
    $.ajax({
        url: '/api/v1/owners',
        type: 'GET',
        data: {
            page: page
        },
        dataType: 'json',
        accepts: {
            json: 'application/json'
        },
        beforeSend: function() {
            showLoader();
            $('#slide-out').sidenav('close');
        },
        success: function(data) {
            let rows = '';
            $(data.data).each(function (index, element) {
                rows +=
                    '            <tr>\n' +
                    '                <td class="hide-on-small-only"><i class="material-icons prefix">owner</i></td>\n' +
                    '                <td>' + (element.lnumber ?? '') + '</td>\n' +
                    '                <td>' + (element.name ?? '') + '</td>\n' +
                    '                <td class="actions">\n' +
                    '                    <button class="btn" name="edit" onclick="loadOwnerEditPage(' + element.id + ');">\n' +
                    '                        <i class="material-icons">edit</i><span class="button-content hide-on-small-only">Edit</span>\n' +
                    '                    </button>\n' +
                    '                    <button class="btn" name="delete" onclick="showDeleteModal(' + element.id + ' , \'' + element.name + '\', \'deleteOwner\');">\n' +
                    '                        <i class="material-icons">delete</i><span class="button-content hide-on-small-only">Delete</span>\n' +
                    '                    </button>\n' +
                    '                </td>\n' +
                    '            </tr>\n';
            });

            let html =
                '    <h3 class="header">Owners</h3>\n' +
                '    <div class="row">\n' +
                '        <div class="input-field col s10">\n' +
                '            Test search\n' +
                '        </div>\n' +
                '        <div class="input-field col s2">\n' +
                '            <button class="btn right" name="new" onclick="loadOwnerNewPage();">\n' +
                '                <i class="material-icons">add_owner</i><span class="button-content hide-on-small-only">New</span>\n' +
                '            </button>\n' +
                '        </div>\n' +
                '    </div>\n' +
                '    <table>\n' +
                '        <thead>\n' +
                '            <tr>\n' +
                '                <th class="hide-on-small-only"></th>\n' +
                '                <th>L no</th>\n' +
                '                <th>Name</th>\n' +
                '                <th class="actions">Actions</th>\n' +
                '            </tr>\n' +
                '        </thead>\n' +
                '        <tbody>\n' +
                rows +
                '        </tbody>\n' +
                '    </table>\n';

            html += addPagination(data.pager, 'loadOwnersPage');

            $('div#content').html(html);
        },
        error: function(jqXHR) {
            loadErrorPage(jqXHR);
        },
        complete: function() {
            hideLoader();
        },
    });
}

function loadOwnerNewPage() {
    showLoader();
    $('#slide-out').sidenav('close');

    $('div#content').html(
        '    <h3 class="header">New owner</h3>\n' +
        '    <form id="newowner">\n' +
        '        <div class="row">\n' +
        '            <div class="input-field col s12">\n' +
        '                <i class="material-icons prefix">short_text</i>\n' +
        '                <input id="name" name="name" type="text" class="validate">\n' +
        '                <label for="name">Name</label>\n' +
        '            </div>\n' +
        '        </div>\n' +
        '        <div class="row">\n' +
        '            <div class="input-field col s12">\n' +
        '                <i class="material-icons prefix">kvk</i>\n' +
        '                <input id="kvk" name="kvk" type="text" class="validate">\n' +
        '                <label for="kvk">KVK</label>\n' +
        '            </div>\n' +
        '        </div>\n' +
        '        <div class="row">\n' +
        '            <div class="input-field col s12">\n' +
        '                <i class="material-icons prefix">belastingdienst</i>\n' +
        '                <input id="btw" name="btw" type="text" class="validate">\n' +
        '                <label for="btw">BTW</label>\n' +
        '            </div>\n' +
        '        </div>\n' +
        '        <div class="row">\n' +
        '            <div class="input-field col s12">\n' +
        '                <i class="material-icons prefix">aedes</i>\n' +
        '                <input id="lnumber" name="lnumber" type="text" class="validate">\n' +
        '                <label for="lnumber">L number</label>\n' +
        '            </div>\n' +
        '        </div>\n' +
        '        <div class="row">\n' +
        '            <div class="input-field col s12">\n' +
        '                <i class="material-icons prefix">http</i>\n' +
        '                <input id="website" name="website" type="text" class="validate">\n' +
        '                <label for="website">Website</label>\n' +
        '            </div>\n' +
        '        </div>\n' +
        '        <div class="row">\n' +
        '            <div class="col s12">\n' +
        '                <button type="submit" class="btn" name="create">\n' +
        '                    <i class="material-icons left">add_owner</i>Create\n' +
        '                </button>\n' +
        '            </div>\n' +
        '        </div>\n' +
        '    </form>\n'
    );

    hideLoader();

    $('form#newowner').submit(function(event) {
        event.preventDefault();
        $.ajax({
            url: '/api/v1/owners',
            type: 'POST',
            dataType: 'json',
            contentType: 'application/json; charset=UTF-8',
            accepts: {
                json: 'application/json'
            },
            data: JSON.stringify(
                {
                    'name': $('input#name').val(),
                    'kvk': $('input#kvk').val(),
                    'btw': $('input#btw').val(),
                    'lnumber': $('input#lnumber').val(),
                    'website': $('input#website').val(),
                }
            ),
            beforeSend: function() {
                showLoader();
                $('#slide-out').sidenav('close');
            },
            success: function() {
                loadOwnersPage();
            },
            error: function(jqXHR) {
                loadErrorPage(jqXHR);
            },
            complete: function() {
                hideLoader();
            },
        });
    });
}

function loadOwnerEditPage(id) {
    $.ajax({
        url: '/api/v1/owners/' + id,
        type: 'GET',
        dataType: 'json',
        accepts: {
            json: 'application/json'
        },
        beforeSend: function() {
            showLoader();
            $('#slide-out').sidenav('close');
        },
        success: function(data) {
            $('div#content').html(
                '    <h3 class="header">Edit owner</h3>\n' +
                '    <form id="editowner">\n' +
                '        <div class="row">\n' +
                '            <div class="input-field col s12">\n' +
                '                <i class="material-icons prefix disabled">numbers</i>\n' +
                '                <input disabled id="id" name="id" type="text" value="' + data.data.id + '">\n' +
                '                <label for="id" class="active">Id</label>\n' +
                '            </div>\n' +
                '        </div>\n' +
                '        <div class="row">\n' +
                '            <div class="input-field col s12">\n' +
                '                <i class="material-icons prefix">short_text</i>\n' +
                '                <input id="name" name="name" type="text" class="validate" value="' + data.data.name + '">\n' +
                '                <label for="name" class="active">Name</label>\n' +
                '            </div>\n' +
                '        </div>\n' +
                '        <div class="row">\n' +
                '            <div class="input-field col s12">\n' +
                '                <i class="material-icons prefix">kvk</i>\n' +
                '                <input id="kvk" name="kvk" type="text" class="validate" value="' + (data.data.kvk ?? '') + '">\n' +
                '                <label for="kvk" class="active">KVK</label>\n' +
                '            </div>\n' +
                '        </div>\n' +
                '        <div class="row">\n' +
                '            <div class="input-field col s12">\n' +
                '                <i class="material-icons prefix">belastingdienst</i>\n' +
                '                <input id="btw" name="btw" type="text" class="validate" value="' + (data.data.btw ?? '') + '">\n' +
                '                <label for="btw" class="active">BTW</label>\n' +
                '            </div>\n' +
                '        </div>\n' +
                '        <div class="row">\n' +
                '            <div class="input-field col s12">\n' +
                '                <i class="material-icons prefix">aedes</i>\n' +
                '                <input id="lnumber" name="lnumber" type="text" class="validate" value="' + (data.data.lnumber ?? '') + '">\n' +
                '                <label for="lnumber" class="active">L number</label>\n' +
                '            </div>\n' +
                '        </div>\n' +
                '        <div class="row">\n' +
                '            <div class="input-field col s12">\n' +
                '                <i class="material-icons prefix">http</i>\n' +
                '                <input id="website" name="website" type="text" class="validate" value="' + (data.data.website ?? '') + '">\n' +
                '                <label for="website" class="active">Website</label>\n' +
                '            </div>\n' +
                '        </div>\n' +
                '        <div class="row">\n' +
                '            <div class="col s12">\n' +
                '                <button type="submit" class="btn" name="save">\n' +
                '                    <i class="material-icons left">save</i>Save\n' +
                '                </button>\n' +
                '            </div>\n' +
                '        </div>\n' +
                '    </form>\n'
            );

            $('form#editowner').submit(function(event) {
                event.preventDefault();
                $.ajax({
                    url: '/api/v1/owners/' + $('input#id').val(),
                    type: 'PUT',
                    dataType: 'json',
                    contentType: 'application/json; charset=UTF-8',
                    accepts: {
                        json: 'application/json'
                    },
                    data: JSON.stringify(
                        {
                            'name': $('input#name').val(),
                            'kvk': $('input#kvk').val(),
                            'btw': $('input#btw').val(),
                            'lnumber': $('input#lnumber').val(),
                            'website': $('input#website').val(),
                        }
                    ),
                    beforeSend: function() {
                        showLoader();
                        $('#slide-out').sidenav('close');
                    },
                    success: function() {
                        loadOwnersPage();
                    },
                    error: function(jqXHR) {
                        loadErrorPage(jqXHR);
                    },
                    complete: function() {
                        hideLoader();
                    },
                });
            });
        },
        error: function (jqXHR) {
            loadErrorPage(jqXHR)
        },
        complete: function() {
            hideLoader();
        },
    });
}

function deleteOwner(id) {
    $.ajax({
        url: '/api/v1/owners/' + id,
        type: 'DELETE',
        beforeSend: function() {
            showLoader();
            $('#slide-out').sidenav('close');
        },
        success: function() {
            loadOwnersPage();
        },
        error: function(jqXHR) {
            loadErrorPage(jqXHR);
            hideLoader();
        },
    });
}

/**
 * Housingstocks
 */

function loadHousingstocksPage(page = 1) {
    $.ajax({
        url: '/api/v1/housingstocks',
        type: 'GET',
        data: {
            page: page
        },
        dataType: 'json',
        accepts: {
            json: 'application/json'
        },
        beforeSend: function() {
            showLoader();
            $('#slide-out').sidenav('close');
        },
        success: function(data) {
            let rows = '';
            $(data.data).each(function (index, element) {
                rows +=
                    '            <tr class="tooltipped" data-position="bottom" data-tooltip="' + (element.description ?? '') + '">\n' +
                    '                <td class="hide-on-small-only"><i class="material-icons prefix">domain</i></td>\n' +
                    '                <td>' + (element.code ?? '') + '</td>\n' +
                    '                <td>' + (element.name ?? '') + '</td>\n' +
                    '                <td class="actions">\n' +
                    '                    <button class="btn" name="edit" onclick="loadHousingstockEditPage(' + element.id + ');">\n' +
                    '                        <i class="material-icons">edit</i><span class="button-content hide-on-small-only">Edit</span>\n' +
                    '                    </button>\n' +
                    '                    <button class="btn" name="delete" onclick="showDeleteModal(' + element.id + ' , \'' + element.name + '\', \'deleteHousingstock\');">\n' +
                    '                        <i class="material-icons">delete</i><span class="button-content hide-on-small-only">Delete</span>\n' +
                    '                    </button>\n' +
                    '                </td>\n' +
                    '            </tr>\n';
            });

            let html =
                '    <h3 class="header">Housingstocks</h3>\n' +
                '    <div class="row">\n' +
                '        <div class="input-field col s12">\n' +
                '            <button class="btn" name="new" onclick="loadHousingstockNewPage();">\n' +
                '                <i class="material-icons">domain_add</i><span class="button-content hide-on-small-only">New</span>\n' +
                '            </button>\n' +
                '        </div>\n' +
                '    </div>\n' +
                '    <table>\n' +
                '        <thead>\n' +
                '            <tr>\n' +
                '                <th class="hide-on-small-only"></th>\n' +
                '                <th>Code</th>\n' +
                '                <th>Name</th>\n' +
                '                <th class="actions">Actions</th>\n' +
                '            </tr>\n' +
                '        </thead>\n' +
                '        <tbody>\n' +
                rows +
                '        </tbody>\n' +
                '    </table>\n';

            html += addPagination(data.pager, 'loadHousingstocksPage');

            $('div#content').html(html);
        },
        error: function(jqXHR) {
            loadErrorPage(jqXHR);
        },
        complete: function() {
            $('.tooltipped').tooltip({'enterDelay': 1000, 'outDuration': 0,});
            hideLoader();
        },
    });
}

function loadHousingstockNewPage() {
    $.ajax({
        url: '/api/v1/owners',
        type: 'GET',
        dataType: 'json',
        accepts: {
            json: 'application/json'
        },
        beforeSend: function() {
            showLoader();
            $('#slide-out').sidenav('close');
        },
        success: function(data) {
            let ownerSelectHtml =
                '        <div class="row">\n' +
                '            <div class="input-field col s12">\n' +
                '                <i class="material-icons prefix">person</i>\n' +
                '                <select id="owner" name="owner">\n' +
                '                    <option disabled selected>Choose an owner</option>\n';
            $(data.data).each(function (index, element) {
                ownerSelectHtml += '                    <option value="' + element.id + '">' + element.name + '</option>\n';
            });
            ownerSelectHtml +=
                '                </select>\n' +
                '                <label>Owner</label>\n' +
                '            </div>\n' +
                '        </div>\n';

            $('div#content').html(
                '    <h3 class="header">New housingstock</h3>\n' +
                '    <form id="newhousingstock">\n' +
                ownerSelectHtml +
                '        <div class="row">\n' +
                '            <div class="input-field col s12">\n' +
                '                <i class="material-icons prefix">qr_code_2</i>\n' +
                '                <input id="code" name="code" type="text" class="validate">\n' +
                '                <label for="code">Code</label>\n' +
                '            </div>\n' +
                '        </div>\n' +
                '        <div class="row">\n' +
                '            <div class="input-field col s12">\n' +
                '                <i class="material-icons prefix">short_text</i>\n' +
                '                <input id="name" name="name" type="text" class="validate">\n' +
                '                <label for="name">Name</label>\n' +
                '            </div>\n' +
                '        </div>\n' +
                '        <div class="row">\n' +
                '            <div class="input-field col s12">\n' +
                '                <i class="material-icons prefix">description</i>\n' +
                '                <textarea id="description" name="description" class="materialize-textarea"></textarea>\n' +
                '                <label for="description">Description</label>\n' +
                '            </div>\n' +
                '        </div>\n' +
                '        <div class="row">\n' +
                '            <div class="col s12">\n' +
                '                <button type="submit" class="btn" name="create">\n' +
                '                    <i class="material-icons left">domain_add</i>Create\n' +
                '                </button>\n' +
                '            </div>\n' +
                '        </div>\n' +
                '    </form>\n'
            );

            $('form#newhousingstock').submit(function(event) {
                event.preventDefault();
                $.ajax({
                    url: '/api/v1/housingstocks',
                    type: 'POST',
                    dataType: 'json',
                    contentType: 'application/json; charset=UTF-8',
                    accepts: {
                        json: 'application/json'
                    },
                    data: JSON.stringify(
                        {
                            'owner': $('select#owner').val(),
                            'code': $('input#code').val(),
                            'name': $('input#name').val(),
                            'description': $('textarea#description').val(),
                        }
                    ),
                    beforeSend: function() {
                        showLoader();
                        $('#slide-out').sidenav('close');
                    },
                    success: function() {
                        loadHousingstocksPage();
                    },
                    error: function(jqXHR) {
                        loadErrorPage(jqXHR);
                    },
                    complete: function() {
                        hideLoader();
                    },
                });
            });
        },
        error: function(jqXHR) {
            loadErrorPage(jqXHR);
        },
        complete: function() {
            hideLoader();

            $('select').formSelect();
        },
    });
}

function loadHousingstockEditPage(id) {
    $.ajax({
        url: '/api/v1/owners',
        type: 'GET',
        dataType: 'json',
        accepts: {
            json: 'application/json'
        },
        beforeSend: function() {
            showLoader();
            $('#slide-out').sidenav('close');
        },
        success: function(dataOwners) {
            $.ajax({
                url: '/api/v1/housingstocks/' + id,
                type: 'GET',
                dataType: 'json',
                accepts: {
                    json: 'application/json'
                },
                success: function(data) {
                    let ownerSelectHtml =
                        '        <div class="row">\n' +
                        '            <div class="input-field col s12">\n' +
                        '                <i class="material-icons prefix">person</i>\n' +
                        '                <select id="owner" name="owner">\n';
                    $(dataOwners.data).each(function (index, element) {
                        if (element.id === data.data.owner.id) {
                            ownerSelectHtml += '                    <option value="' + element.id + '" selected>' + element.name + '</option>\n';
                        } else {
                            ownerSelectHtml += '                    <option value="' + element.id + '">' + element.name + '</option>\n';
                        }
                    });
                    ownerSelectHtml +=
                        '                </select>\n' +
                        '                <label>Owner</label>\n' +
                        '            </div>\n' +
                        '        </div>\n';

                    $('div#content').html(
                        '    <h3 class="header">Edit housingstock</h3>\n' +
                        '    <form id="edithousingstock">\n' +
                        '        <div class="row">\n' +
                        '            <div class="input-field col s12">\n' +
                        '                <i class="material-icons prefix disabled">numbers</i>\n' +
                        '                <input disabled id="id" name="id" type="text" value="' + data.data.id + '">\n' +
                        '                <label for="id" class="active">Id</label>\n' +
                        '            </div>\n' +
                        '        </div>\n' +
                        ownerSelectHtml +
                        '        <div class="row">\n' +
                        '            <div class="input-field col s12">\n' +
                        '                <i class="material-icons prefix">qr_code_2</i>\n' +
                        '                <input id="code" name="code" type="text" class="validate" value="' + (data.data.code ?? '') + '">\n' +
                        '                <label for="code" class="active">Code</label>\n' +
                        '            </div>\n' +
                        '        </div>\n' +
                        '        <div class="row">\n' +
                        '            <div class="input-field col s12">\n' +
                        '                <i class="material-icons prefix">short_text</i>\n' +
                        '                <input id="name" name="name" type="text" class="validate" value="' + (data.data.name ?? '') + '">\n' +
                        '                <label for="name" class="active">Name</label>\n' +
                        '            </div>\n' +
                        '        </div>\n' +
                        '        <div class="row">\n' +
                        '            <div class="input-field col s12">\n' +
                        '                <i class="material-icons prefix">description</i>\n' +
                        '                <textarea id="description" name="description" class="materialize-textarea">' + (data.data.description ?? '') + '</textarea>\n' +
                        '                <label for="description" class="active">Description</label>\n' +
                        '            </div>\n' +
                        '        </div>\n' +
                        '        <div class="row">\n' +
                        '            <div class="input-field col s12">\n' +
                        '                <i class="material-icons prefix disabled">schedule</i>\n' +
                        '                <input disabled id="created" name="created" type="text" value="' + moment.unix(parseInt(data.data.creationTime.timestamp)).locale('en_US').format('LLL') + '">\n' +
                        '                <label for="created" class="active">Created</label>\n' +
                        '            </div>\n' +
                        '        </div>\n' +
                        '        <div class="row">\n' +
                        '            <div class="input-field col s12">\n' +
                        '                <i class="material-icons prefix disabled">update</i>\n' +
                        '                <input disabled id="lastchange" name="lastchange" type="text" value="' + moment.unix(parseInt(data.data.lastChangeTime.timestamp)).locale('en_US').format('LLL') + '">\n' +
                        '                <label for="lastchange" class="active">Last change</label>\n' +
                        '            </div>\n' +
                        '        </div>\n' +
                        '        <div class="row">\n' +
                        '            <div class="col s12">\n' +
                        '                <button type="submit" class="btn" name="save">\n' +
                        '                    <i class="material-icons left">save</i>Save\n' +
                        '                </button>\n' +
                        '            </div>\n' +
                        '        </div>\n' +
                        '    </form>\n'
                    );

                    $('form#edithousingstock').submit(function(event) {
                        event.preventDefault();
                        $.ajax({
                            url: '/api/v1/housingstocks/' + $('input#id').val(),
                            type: 'PUT',
                            dataType: 'json',
                            contentType: 'application/json; charset=UTF-8',
                            accepts: {
                                json: 'application/json'
                            },
                            data: JSON.stringify(
                                {
                                    'owner': $('select#owner').val(),
                                    'code': $('input#code').val(),
                                    'name': $('input#name').val(),
                                    'description': $('textarea#description').val(),
                                }
                            ),
                            beforeSend: function() {
                                showLoader();
                                $('#slide-out').sidenav('close');
                            },
                            success: function() {
                                loadHousingstocksPage();
                            },
                            error: function(jqXHR) {
                                loadErrorPage(jqXHR);
                            },
                            complete: function() {
                                hideLoader();
                            },
                        });
                    });
                },
                error: function (jqXHR) {
                    loadErrorPage(jqXHR)
                },
                complete: function () {
                    hideLoader();
                },
            });
        },
        error: function(jqXHR) {
            loadErrorPage(jqXHR);
        },
        complete: function() {
            hideLoader();
        },
    });
}

function deleteHousingstock(id) {
    $.ajax({
        url: '/api/v1/housingstocks/' + id,
        type: 'DELETE',
        beforeSend: function() {
            showLoader();
            $('#slide-out').sidenav('close');
        },
        success: function() {
            loadHousingstocksPage();
        },
        error: function(jqXHR) {
            loadErrorPage(jqXHR);
            hideLoader();
        },
    });
}

/**
 * ResidentialAreas
 */

function loadResidentialAreasPage(page = 1) {
    if(localStorage.getItem('activeHousingstockId')) {
        $.ajax({
            url: '/api/v1/housingstocks/' + localStorage.getItem('activeHousingstockId') + '/residentialareas',
            type: 'GET',
            data: {
                page: page
            },
            dataType: 'json',
            accepts: {
                json: 'application/json'
            },
            beforeSend: function() {
                showLoader();
                $('#slide-out').sidenav('close');
            },
            success: function(data) {
                let rows = '';
                $(data.data).each(function (index, element) {
                    rows +=
                        '            <tr class="tooltipped" data-position="bottom" data-tooltip="' + (element.description ?? '') + '">\n' +
                        '                <td class="hide-on-small-only"><i class="material-icons prefix">view_quilt</i></td>\n' +
                        '                <td>' + (element.code ?? '') + '</td>\n' +
                        '                <td>' + (element.name ?? '') + '</td>\n' +
                        '                <td class="actions">\n' +
                        '                    <button class="btn" name="edit" onclick="loadResidentialAreaEditPage(' + element.id + ');">\n' +
                        '                        <i class="material-icons">edit</i><span class="button-content hide-on-small-only">Edit</span>\n' +
                        '                    </button>\n' +
                        '                    <button class="btn" name="delete" onclick="showDeleteModal(' + element.id + ' , \'' + element.name + '\', \'deleteResidentialArea\');">\n' +
                        '                        <i class="material-icons">delete</i><span class="button-content hide-on-small-only">Delete</span>\n' +
                        '                    </button>\n' +
                        '                </td>\n' +
                        '            </tr>\n';
                });

                let html =
                    '    <h3 class="header">Residential areas</h3>\n' +
                    '    <div class="row">\n' +
                    '        <div class="input-field col s12">\n' +
                    '            <button class="btn" name="new" onclick="loadResidentialAreaNewPage();">\n' +
                    '                <i class="material-icons">add_view_quilt</i><span class="button-content hide-on-small-only">New</span>\n' +
                    '            </button>\n' +
                    '        </div>\n' +
                    '    </div>\n' +
                    '    <table>\n' +
                    '        <thead>\n' +
                    '            <tr>\n' +
                    '                <th class="hide-on-small-only"></th>\n' +
                    '                <th>Code</th>\n' +
                    '                <th>Name</th>\n' +
                    '                <th class="actions">Actions</th>\n' +
                    '            </tr>\n' +
                    '        </thead>\n' +
                    '        <tbody>\n' +
                    rows +
                    '        </tbody>\n' +
                    '    </table>\n';

                html += addPagination(data.pager, 'loadResidentialAreasPage');

                $('div#content').html(html);
            },
            error: function(jqXHR) {
                loadErrorPage(jqXHR);
            },
            complete: function() {
                $('.tooltipped').tooltip({'enterDelay': 1000, 'outDuration': 0,});
                hideLoader();
            },
        });
    } else {
        loadInformationPage('You need to first choose an active housingstock');
    }
}

function loadResidentialAreaNewPage() {
    if(localStorage.getItem('activeHousingstockId')) {
        $('div#content').html(
            '    <h3 class="header">New residential area</h3>\n' +
            '    <form id="newresidentialarea">\n' +
            '        <div class="row">\n' +
            '            <div class="input-field col s12">\n' +
            '                <i class="material-icons prefix">qr_code_2</i>\n' +
            '                <input id="code" name="code" type="text" class="validate">\n' +
            '                <label for="code">Code</label>\n' +
            '            </div>\n' +
            '        </div>\n' +
            '        <div class="row">\n' +
            '            <div class="input-field col s12">\n' +
            '                <i class="material-icons prefix">short_text</i>\n' +
            '                <input id="name" name="name" type="text" class="validate">\n' +
            '                <label for="name">Name</label>\n' +
            '            </div>\n' +
            '        </div>\n' +
            '        <div class="row">\n' +
            '            <div class="input-field col s12">\n' +
            '                <i class="material-icons prefix">description</i>\n' +
            '                <textarea id="description" name="description" class="materialize-textarea"></textarea>\n' +
            '                <label for="description">Description</label>\n' +
            '            </div>\n' +
            '        </div>\n' +
            '        <div class="row">\n' +
            '            <div class="col s12">\n' +
            '                <button type="submit" class="btn" name="create">\n' +
            '                    <i class="material-icons left">add_view_quilt</i>Create\n' +
            '                </button>\n' +
            '            </div>\n' +
            '        </div>\n' +
            '    </form>\n'
        );

        $('form#newresidentialarea').submit(function (event) {
            event.preventDefault();
            $.ajax({
                url: '/api/v1/housingstocks/' + localStorage.getItem('activeHousingstockId') + '/residentialareas',
                type: 'POST',
                dataType: 'json',
                contentType: 'application/json; charset=UTF-8',
                accepts: {
                    json: 'application/json'
                },
                data: JSON.stringify(
                    {
                        'code': $('input#code').val(),
                        'name': $('input#name').val(),
                        'description': $('textarea#description').val(),
                    }
                ),
                beforeSend: function () {
                    showLoader();
                    $('#slide-out').sidenav('close');
                },
                success: function () {
                    loadResidentialAreasPage();
                },
                error: function (jqXHR) {
                    loadErrorPage(jqXHR);
                },
                complete: function () {
                    hideLoader();
                },
            });
        });
    } else {
        loadInformationPage('You need to first choose an active housingstock');
    }
}

function loadResidentialAreaEditPage(id) {
    if(localStorage.getItem('activeHousingstockId')) {
        $.ajax({
            url: '/api/v1/housingstocks/' +localStorage.getItem('activeHousingstockId') + '/residentialareas/' + id,
            type: 'GET',
            dataType: 'json',
            accepts: {
                json: 'application/json'
            },
            beforeSend: function() {
                showLoader();
                $('#slide-out').sidenav('close');
            },
            success: function(data) {
                $('div#content').html(
                    '    <h3 class="header">Edit residential area</h3>\n' +
                    '    <form id="editresidentialarea">\n' +
                    '        <div class="row">\n' +
                    '            <div class="input-field col s12">\n' +
                    '                <i class="material-icons prefix disabled">numbers</i>\n' +
                    '                <input disabled id="id" name="id" type="text" value="' + data.data.id + '">\n' +
                    '                <label for="id" class="active">Id</label>\n' +
                    '            </div>\n' +
                    '        </div>\n' +
                    '        <div class="row">\n' +
                    '            <div class="input-field col s12">\n' +
                    '                <i class="material-icons prefix">qr_code_2</i>\n' +
                    '                <input id="code" name="code" type="text" class="validate" value="' + (data.data.code ?? '') + '">\n' +
                    '                <label for="code" class="active">Code</label>\n' +
                    '            </div>\n' +
                    '        </div>\n' +
                    '        <div class="row">\n' +
                    '            <div class="input-field col s12">\n' +
                    '                <i class="material-icons prefix">short_text</i>\n' +
                    '                <input id="name" name="name" type="text" class="validate" value="' + (data.data.name ?? '') + '">\n' +
                    '                <label for="name" class="active">Name</label>\n' +
                    '            </div>\n' +
                    '        </div>\n' +
                    '        <div class="row">\n' +
                    '            <div class="input-field col s12">\n' +
                    '                <i class="material-icons prefix">description</i>\n' +
                    '                <textarea id="description" name="description" class="materialize-textarea">' + (data.data.description ?? '') + '</textarea>\n' +
                    '                <label for="description" class="active">Description</label>\n' +
                    '            </div>\n' +
                    '        </div>\n' +
                    '        <div class="row">\n' +
                    '            <div class="col s12">\n' +
                    '                <button type="submit" class="btn" name="save">\n' +
                    '                    <i class="material-icons left">save</i>Save\n' +
                    '                </button>\n' +
                    '            </div>\n' +
                    '        </div>\n' +
                    '    </form>\n'
                );

                $('form#editresidentialarea').submit(function(event) {
                    event.preventDefault();
                    $.ajax({
                        url: '/api/v1/housingstocks/' +localStorage.getItem('activeHousingstockId') + '/residentialareas/' + id,
                        type: 'PUT',
                        dataType: 'json',
                        contentType: 'application/json; charset=UTF-8',
                        accepts: {
                            json: 'application/json'
                        },
                        data: JSON.stringify(
                            {
                                'code': $('input#code').val(),
                                'name': $('input#name').val(),
                                'description': $('textarea#description').val(),
                            }
                        ),
                        beforeSend: function() {
                            showLoader();
                            $('#slide-out').sidenav('close');
                        },
                        success: function() {
                            loadResidentialAreasPage();
                        },
                        error: function(jqXHR) {
                            loadErrorPage(jqXHR);
                        },
                        complete: function() {
                            hideLoader();
                        },
                    });
                });
            },
            error: function (jqXHR) {
                loadErrorPage(jqXHR)
            },
            complete: function() {
                hideLoader();
            },
        });
    } else {
        loadInformationPage('You need to first choose an active housingstock');
    }
}

function deleteResidentialArea(id) {
    if(localStorage.getItem('activeHousingstockId')) {
        $.ajax({
            url: '/api/v1/housingstocks/' + localStorage.getItem('activeHousingstockId') + '/residentialareas/' + id,
            type: 'DELETE',
            beforeSend: function() {
                showLoader();
                $('#slide-out').sidenav('close');
            },
            success: function() {
                loadResidentialAreasPage();
            },
            error: function(jqXHR) {
                loadErrorPage(jqXHR);
                hideLoader();
            },
        });
    } else {
        loadInformationPage('You need to first choose an active housingstock');
    }
}

/**
 * Blocks
 */

function loadBlocksPage(page = 1) {
    if(localStorage.getItem('activeHousingstockId')) {
        $.ajax({
            url: '/api/v1/housingstocks/' + localStorage.getItem('activeHousingstockId') + '/blocks',
            type: 'GET',
            data: {
                page: page
            },
            dataType: 'json',
            accepts: {
                json: 'application/json'
            },
            beforeSend: function() {
                showLoader();
                $('#slide-out').sidenav('close');
            },
            success: function(data) {
                let rows = '';
                $(data.data).each(function (index, element) {
                    rows +=
                        '            <tr class="tooltipped" data-position="bottom" data-tooltip="' + (element.description ?? '') + '">\n' +
                        '                <td class="hide-on-small-only"><i class="material-icons prefix">view_module</i></td>\n' +
                        '                <td>' + (element.code ?? '') + '</td>\n' +
                        '                <td>' + (element.name ?? '') + '</td>\n' +
                        '                <td class="actions">\n' +
                        '                    <button class="btn" name="edit" onclick="loadBlockEditPage(' + element.id + ');">\n' +
                        '                        <i class="material-icons">edit</i><span class="button-content hide-on-small-only">Edit</span>\n' +
                        '                    </button>\n' +
                        '                    <button class="btn" name="delete" onclick="showDeleteModal(' + element.id + ' , \'' + element.name + '\', \'deleteBlock\');">\n' +
                        '                        <i class="material-icons">delete</i><span class="button-content hide-on-small-only">Delete</span>\n' +
                        '                    </button>\n' +
                        '                </td>\n' +
                        '            </tr>\n';
                });

                let html =
                    '    <h3 class="header">Blocks</h3>\n' +
                    '    <div class="row">\n' +
                    '        <div class="input-field col s12">\n' +
                    '            <button class="btn" name="new" onclick="loadBlockNewPage();">\n' +
                    '                <i class="material-icons">add_view_module</i><span class="button-content hide-on-small-only">New</span>\n' +
                    '            </button>\n' +
                    '        </div>\n' +
                    '    </div>\n' +
                    '    <table>\n' +
                    '        <thead>\n' +
                    '            <tr>\n' +
                    '                <th class="hide-on-small-only"></th>\n' +
                    '                <th>Code</th>\n' +
                    '                <th>Name</th>\n' +
                    '                <th class="actions">Actions</th>\n' +
                    '            </tr>\n' +
                    '        </thead>\n' +
                    '        <tbody>\n' +
                    rows +
                    '        </tbody>\n' +
                    '    </table>\n';

                html += addPagination(data.pager, 'loadBlocksPage');

                $('div#content').html(html);
            },
            error: function(jqXHR) {
                loadErrorPage(jqXHR);
            },
            complete: function() {
                $('.tooltipped').tooltip({'enterDelay': 1000, 'outDuration': 0,});
                hideLoader();
            },
        });
    } else {
        loadInformationPage('You need to first choose an active housingstock');
    }
}

function loadBlockNewPage() {
    if(localStorage.getItem('activeHousingstockId')) {
        $('div#content').html(
            '    <h3 class="header">New block</h3>\n' +
            '    <form id="newblock">\n' +
            '        <div class="row">\n' +
            '            <div class="input-field col s12">\n' +
            '                <i class="material-icons prefix">qr_code_2</i>\n' +
            '                <input id="code" name="code" type="text" class="validate">\n' +
            '                <label for="code">Code</label>\n' +
            '            </div>\n' +
            '        </div>\n' +
            '        <div class="row">\n' +
            '            <div class="input-field col s12">\n' +
            '                <i class="material-icons prefix">short_text</i>\n' +
            '                <input id="name" name="name" type="text" class="validate">\n' +
            '                <label for="name">Name</label>\n' +
            '            </div>\n' +
            '        </div>\n' +
            '        <div class="row">\n' +
            '            <div class="input-field col s12">\n' +
            '                <i class="material-icons prefix">euro_symbol</i>\n' +
            '                <input id="financialNumber" name="financialNumber" type="text" class="validate">\n' +
            '                <label for="financialNumber">Financial number</label>\n' +
            '            </div>\n' +
            '        </div>\n' +
            '        <div class="row">\n' +
            '            <div class="input-field col s12">\n' +
            '                <i class="material-icons prefix">description</i>\n' +
            '                <textarea id="description" name="description" class="materialize-textarea"></textarea>\n' +
            '                <label for="description">Description</label>\n' +
            '            </div>\n' +
            '        </div>\n' +
            '        <div class="row">\n' +
            '            <div class="col s12">\n' +
            '                <button type="submit" class="btn" name="create">\n' +
            '                    <i class="material-icons left">add_view_quilt</i>Create\n' +
            '                </button>\n' +
            '            </div>\n' +
            '        </div>\n' +
            '    </form>\n'
        );

        $('form#newblock').submit(function (event) {
            event.preventDefault();
            $.ajax({
                url: '/api/v1/housingstocks/' + localStorage.getItem('activeHousingstockId') + '/blocks',
                type: 'POST',
                dataType: 'json',
                contentType: 'application/json; charset=UTF-8',
                accepts: {
                    json: 'application/json'
                },
                data: JSON.stringify(
                    {
                        'code': $('input#code').val(),
                        'name': $('input#name').val(),
                        'financialNumber': $('input#financialNumber').val(),
                        'description': $('textarea#description').val(),
                    }
                ),
                beforeSend: function () {
                    showLoader();
                    $('#slide-out').sidenav('close');
                },
                success: function () {
                    loadBlocksPage();
                },
                error: function (jqXHR) {
                    loadErrorPage(jqXHR);
                },
                complete: function () {
                    hideLoader();
                },
            });
        });
    } else {
        loadInformationPage('You need to first choose an active housingstock');
    }
}

function loadBlockEditPage(id) {
    if(localStorage.getItem('activeHousingstockId')) {
        $.ajax({
            url: '/api/v1/housingstocks/' +localStorage.getItem('activeHousingstockId') + '/blocks/' + id,
            type: 'GET',
            dataType: 'json',
            accepts: {
                json: 'application/json'
            },
            beforeSend: function() {
                showLoader();
                $('#slide-out').sidenav('close');
            },
            success: function(data) {
                $('div#content').html(
                    '    <h3 class="header">Edit block</h3>\n' +
                    '    <form id="editblock">\n' +
                    '        <div class="row">\n' +
                    '            <div class="input-field col s12">\n' +
                    '                <i class="material-icons prefix disabled">numbers</i>\n' +
                    '                <input disabled id="id" name="id" type="text" value="' + data.data.id + '">\n' +
                    '                <label for="id" class="active">Id</label>\n' +
                    '            </div>\n' +
                    '        </div>\n' +
                    '        <div class="row">\n' +
                    '            <div class="input-field col s12">\n' +
                    '                <i class="material-icons prefix">qr_code_2</i>\n' +
                    '                <input id="code" name="code" type="text" class="validate" value="' + (data.data.code ?? '') + '">\n' +
                    '                <label for="code" class="active">Code</label>\n' +
                    '            </div>\n' +
                    '        </div>\n' +
                    '        <div class="row">\n' +
                    '            <div class="input-field col s12">\n' +
                    '                <i class="material-icons prefix">short_text</i>\n' +
                    '                <input id="name" name="name" type="text" class="validate" value="' + (data.data.name ?? '') + '">\n' +
                    '                <label for="name" class="active">Name</label>\n' +
                    '            </div>\n' +
                    '        </div>\n' +
                    '        <div class="row">\n' +
                    '            <div class="input-field col s12">\n' +
                    '                <i class="material-icons prefix">euro_symbol</i>\n' +
                    '                <input id="financialNumber" name="financialNumber" type="text" class="validate" value="' + (data.data.financialNumber ?? '') + '">\n' +
                    '                <label for="financialNumber" class="active">Financial number</label>\n' +
                    '            </div>\n' +
                    '        </div>\n' +
                    '        <div class="row">\n' +
                    '            <div class="input-field col s12">\n' +
                    '                <i class="material-icons prefix">description</i>\n' +
                    '                <textarea id="description" name="description" class="materialize-textarea">' + (data.data.description ?? '') + '</textarea>\n' +
                    '                <label for="description" class="active">Description</label>\n' +
                    '            </div>\n' +
                    '        </div>\n' +
                    '        <div class="row">\n' +
                    '            <div class="col s12">\n' +
                    '                <button type="submit" class="btn" name="save">\n' +
                    '                    <i class="material-icons left">save</i>Save\n' +
                    '                </button>\n' +
                    '            </div>\n' +
                    '        </div>\n' +
                    '    </form>\n'
                );

                $('form#editblock').submit(function(event) {
                    event.preventDefault();
                    $.ajax({
                        url: '/api/v1/housingstocks/' +localStorage.getItem('activeHousingstockId') + '/blocks/' + id,
                        type: 'PUT',
                        dataType: 'json',
                        contentType: 'application/json; charset=UTF-8',
                        accepts: {
                            json: 'application/json'
                        },
                        data: JSON.stringify(
                            {
                                'code': $('input#code').val(),
                                'name': $('input#name').val(),
                                'financialNumber': $('input#financialNumber').val(),
                                'description': $('textarea#description').val(),
                            }
                        ),
                        beforeSend: function() {
                            showLoader();
                            $('#slide-out').sidenav('close');
                        },
                        success: function() {
                            loadBlocksPage();
                        },
                        error: function(jqXHR) {
                            loadErrorPage(jqXHR);
                        },
                        complete: function() {
                            hideLoader();
                        },
                    });
                });
            },
            error: function (jqXHR) {
                loadErrorPage(jqXHR)
            },
            complete: function() {
                hideLoader();
            },
        });
    } else {
        loadInformationPage('You need to first choose an active housingstock');
    }
}

function deleteBlock(id) {
    if(localStorage.getItem('activeHousingstockId')) {
        $.ajax({
            url: '/api/v1/housingstocks/' + localStorage.getItem('activeHousingstockId') + '/blocks/' + id,
            type: 'DELETE',
            beforeSend: function() {
                showLoader();
                $('#slide-out').sidenav('close');
            },
            success: function() {
                loadBlocksPage();
            },
            error: function(jqXHR) {
                loadErrorPage(jqXHR);
                hideLoader();
            },
        });
    } else {
        loadInformationPage('You need to first choose an active housingstock');
    }
}

/**
 * Buildingtypes
 */

function loadBuildingtypesPage(page = 1) {
    if(localStorage.getItem('activeHousingstockId')) {
        $.ajax({
            url: '/api/v1/housingstocks/' + localStorage.getItem('activeHousingstockId') + '/buildingtypes',
            type: 'GET',
            data: {
                page: page
            },
            dataType: 'json',
            accepts: {
                json: 'application/json'
            },
            beforeSend: function() {
                showLoader();
                $('#slide-out').sidenav('close');
            },
            success: function(data) {
                let rows = '';
                $(data.data).each(function (index, element) {
                    rows +=
                        '            <tr class="tooltipped" data-position="bottom" data-tooltip="' + (element.description ?? '') + '">\n' +
                        '                <td class="hide-on-small-only"><i class="material-icons prefix">home_work</i></td>\n' +
                        '                <td>' + (element.code ?? '') + '</td>\n' +
                        '                <td>' + (element.name ?? '') + '</td>\n' +
                        '                <td class="actions">\n' +
                        '                    <button class="btn" name="edit" onclick="loadBuildingTypeEditPage(' + element.id + ');">\n' +
                        '                        <i class="material-icons">edit</i><span class="button-content hide-on-small-only">Edit</span>\n' +
                        '                    </button>\n' +
                        '                    <button class="btn" name="delete" onclick="showDeleteModal(' + element.id + ' , \'' + element.name + '\', \'deleteBuildingType\');">\n' +
                        '                        <i class="material-icons">delete</i><span class="button-content hide-on-small-only">Delete</span>\n' +
                        '                    </button>\n' +
                        '                </td>\n' +
                        '            </tr>\n';
                });

                let html =
                    '    <h3 class="header">Building types</h3>\n' +
                    '    <div class="row">\n' +
                    '        <div class="input-field col s12">\n' +
                    '            <button class="btn" name="new" onclick="loadBuildingtypeNewPage();">\n' +
                    '                <i class="material-icons">add_home_work</i><span class="button-content hide-on-small-only">New</span>\n' +
                    '            </button>\n' +
                    '        </div>\n' +
                    '    </div>\n' +
                    '    <table>\n' +
                    '        <thead>\n' +
                    '            <tr>\n' +
                    '                <th class="hide-on-small-only"></th>\n' +
                    '                <th>Code</th>\n' +
                    '                <th>Name</th>\n' +
                    '                <th class="actions">Actions</th>\n' +
                    '            </tr>\n' +
                    '        </thead>\n' +
                    '        <tbody>\n' +
                    rows +
                    '        </tbody>\n' +
                    '    </table>\n';

                html += addPagination(data.pager, 'loadBuildingtypesPage');

                $('div#content').html(html);
            },
            error: function(jqXHR) {
                loadErrorPage(jqXHR);
            },
            complete: function() {
                $('.tooltipped').tooltip({'enterDelay': 1000, 'outDuration': 0,});
                hideLoader();
            },
        });
    } else {
        loadInformationPage('You need to first choose an active housingstock');
    }
}

function loadBuildingtypeNewPage() {
    if(localStorage.getItem('activeHousingstockId')) {
        $('div#content').html(
            '    <h3 class="header">New building type</h3>\n' +
            '    <form id="newbuildingtype">\n' +
            '        <div class="row">\n' +
            '            <div class="input-field col s12">\n' +
            '                <i class="material-icons prefix">qr_code_2</i>\n' +
            '                <input id="code" name="code" type="text" class="validate">\n' +
            '                <label for="code">Code</label>\n' +
            '            </div>\n' +
            '        </div>\n' +
            '        <div class="row">\n' +
            '            <div class="input-field col s12">\n' +
            '                <i class="material-icons prefix">short_text</i>\n' +
            '                <input id="name" name="name" type="text" class="validate">\n' +
            '                <label for="name">Name</label>\n' +
            '            </div>\n' +
            '        </div>\n' +
            '        <div class="row">\n' +
            '            <div class="input-field col s12">\n' +
            '                <i class="material-icons prefix">description</i>\n' +
            '                <textarea id="description" name="description" class="materialize-textarea"></textarea>\n' +
            '                <label for="description">Description</label>\n' +
            '            </div>\n' +
            '        </div>\n' +
            '        <div class="row">\n' +
            '            <div class="col s12">\n' +
            '                <button type="submit" class="btn" name="create">\n' +
            '                    <i class="material-icons left">add_home_work</i>Create\n' +
            '                </button>\n' +
            '            </div>\n' +
            '        </div>\n' +
            '    </form>\n'
        );

        $('form#newbuildingtype').submit(function (event) {
            event.preventDefault();
            $.ajax({
                url: '/api/v1/housingstocks/' + localStorage.getItem('activeHousingstockId') + '/buildingtypes',
                type: 'POST',
                dataType: 'json',
                contentType: 'application/json; charset=UTF-8',
                accepts: {
                    json: 'application/json'
                },
                data: JSON.stringify(
                    {
                        'code': $('input#code').val(),
                        'name': $('input#name').val(),
                        'description': $('textarea#description').val(),
                    }
                ),
                beforeSend: function () {
                    showLoader();
                    $('#slide-out').sidenav('close');
                },
                success: function () {
                    loadBuildingtypesPage();
                },
                error: function (jqXHR) {
                    loadErrorPage(jqXHR);
                },
                complete: function () {
                    hideLoader();
                },
            });
        });
    } else {
        loadInformationPage('You need to first choose an active housingstock');
    }
}

function loadBuildingTypeEditPage(id) {
    if(localStorage.getItem('activeHousingstockId')) {
        $.ajax({
            url: '/api/v1/housingstocks/' +localStorage.getItem('activeHousingstockId') + '/buildingtypes/' + id,
            type: 'GET',
            dataType: 'json',
            accepts: {
                json: 'application/json'
            },
            beforeSend: function() {
                showLoader();
                $('#slide-out').sidenav('close');
            },
            success: function(data) {
                $('div#content').html(
                    '    <h3 class="header">Edit building type</h3>\n' +
                    '    <form id="editbuildingtype">\n' +
                    '        <div class="row">\n' +
                    '            <div class="input-field col s12">\n' +
                    '                <i class="material-icons prefix disabled">numbers</i>\n' +
                    '                <input disabled id="id" name="id" type="text" value="' + data.data.id + '">\n' +
                    '                <label for="id" class="active">Id</label>\n' +
                    '            </div>\n' +
                    '        </div>\n' +
                    '        <div class="row">\n' +
                    '            <div class="input-field col s12">\n' +
                    '                <i class="material-icons prefix">qr_code_2</i>\n' +
                    '                <input id="code" name="code" type="text" class="validate" value="' + (data.data.code ?? '') + '">\n' +
                    '                <label for="code" class="active">Code</label>\n' +
                    '            </div>\n' +
                    '        </div>\n' +
                    '        <div class="row">\n' +
                    '            <div class="input-field col s12">\n' +
                    '                <i class="material-icons prefix">short_text</i>\n' +
                    '                <input id="name" name="name" type="text" class="validate" value="' + (data.data.name ?? '') + '">\n' +
                    '                <label for="name" class="active">Name</label>\n' +
                    '            </div>\n' +
                    '        </div>\n' +
                    '        <div class="row">\n' +
                    '            <div class="input-field col s12">\n' +
                    '                <i class="material-icons prefix">description</i>\n' +
                    '                <textarea id="description" name="description" class="materialize-textarea">' + (data.data.description ?? '') + '</textarea>\n' +
                    '                <label for="description" class="active">Description</label>\n' +
                    '            </div>\n' +
                    '        </div>\n' +
                    '        <div class="row">\n' +
                    '            <div class="col s12">\n' +
                    '                <button type="submit" class="btn" name="save">\n' +
                    '                    <i class="material-icons left">save</i>Save\n' +
                    '                </button>\n' +
                    '            </div>\n' +
                    '        </div>\n' +
                    '    </form>\n'
                );

                $('form#editbuildingtype').submit(function(event) {
                    event.preventDefault();
                    $.ajax({
                        url: '/api/v1/housingstocks/' +localStorage.getItem('activeHousingstockId') + '/buildingtypes/' + id,
                        type: 'PUT',
                        dataType: 'json',
                        contentType: 'application/json; charset=UTF-8',
                        accepts: {
                            json: 'application/json'
                        },
                        data: JSON.stringify(
                            {
                                'code': $('input#code').val(),
                                'name': $('input#name').val(),
                                'description': $('textarea#description').val(),
                            }
                        ),
                        beforeSend: function() {
                            showLoader();
                            $('#slide-out').sidenav('close');
                        },
                        success: function() {
                            loadBuildingtypesPage();
                        },
                        error: function(jqXHR) {
                            loadErrorPage(jqXHR);
                        },
                        complete: function() {
                            hideLoader();
                        },
                    });
                });
            },
            error: function (jqXHR) {
                loadErrorPage(jqXHR)
            },
            complete: function() {
                hideLoader();
            },
        });
    } else {
        loadInformationPage('You need to first choose an active housingstock');
    }
}

function deleteBuildingType(id) {
    if(localStorage.getItem('activeHousingstockId')) {
        $.ajax({
            url: '/api/v1/housingstocks/' + localStorage.getItem('activeHousingstockId') + '/buildingtypes/' + id,
            type: 'DELETE',
            beforeSend: function() {
                showLoader();
                $('#slide-out').sidenav('close');
            },
            success: function() {
                loadBuildingtypesPage();
            },
            error: function(jqXHR) {
                loadErrorPage(jqXHR);
                hideLoader();
            },
        });
    } else {
        loadInformationPage('You need to first choose an active housingstock');
    }
}

/**
 * Livingtypes
 */

function loadLivingtypesPage(page = 1) {
    if(localStorage.getItem('activeHousingstockId')) {
        $.ajax({
            url: '/api/v1/housingstocks/' + localStorage.getItem('activeHousingstockId') + '/livingtypes',
            type: 'GET',
            data: {
                page: page
            },
            dataType: 'json',
            accepts: {
                json: 'application/json'
            },
            beforeSend: function() {
                showLoader();
                $('#slide-out').sidenav('close');
            },
            success: function(data) {
                let rows = '';
                $(data.data).each(function (index, element) {
                    rows +=
                        '            <tr class="tooltipped" data-position="bottom" data-tooltip="' + (element.description ?? '') + '">\n' +
                        '                <td class="hide-on-small-only"><i class="material-icons prefix">villa</i></td>\n' +
                        '                <td>' + (element.code ?? '') + '</td>\n' +
                        '                <td>' + (element.name ?? '') + '</td>\n' +
                        '                <td class="actions">\n' +
                        '                    <button class="btn" name="edit" onclick="loadLivingTypeEditPage(' + element.id + ');">\n' +
                        '                        <i class="material-icons">edit</i><span class="button-content hide-on-small-only">Edit</span>\n' +
                        '                    </button>\n' +
                        '                    <button class="btn" name="delete" onclick="showDeleteModal(' + element.id + ' , \'' + element.name + '\', \'deleteLivingType\');">\n' +
                        '                        <i class="material-icons">delete</i><span class="button-content hide-on-small-only">Delete</span>\n' +
                        '                    </button>\n' +
                        '                </td>\n' +
                        '            </tr>\n';
                });

                let html =
                    '    <h3 class="header">Living types</h3>\n' +
                    '    <div class="row">\n' +
                    '        <div class="input-field col s12">\n' +
                    '            <button class="btn" name="new" onclick="loadLivingTypeNewPage();">\n' +
                    '                <i class="material-icons">add_villa</i><span class="button-content hide-on-small-only">New</span>\n' +
                    '            </button>\n' +
                    '        </div>\n' +
                    '    </div>\n' +
                    '    <table>\n' +
                    '        <thead>\n' +
                    '            <tr>\n' +
                    '                <th class="hide-on-small-only"></th>\n' +
                    '                <th>Code</th>\n' +
                    '                <th>Name</th>\n' +
                    '                <th class="actions">Actions</th>\n' +
                    '            </tr>\n' +
                    '        </thead>\n' +
                    '        <tbody>\n' +
                    rows +
                    '        </tbody>\n' +
                    '    </table>\n';

                html += addPagination(data.pager, 'loadLivingtypesPage');

                $('div#content').html(html);
            },
            error: function(jqXHR) {
                loadErrorPage(jqXHR);
            },
            complete: function() {
                $('.tooltipped').tooltip({'enterDelay': 1000, 'outDuration': 0,});
                hideLoader();
            },
        });
    } else {
        loadInformationPage('You need to first choose an active housingstock');
    }
}

/** ToDo */
function loadLivingTypeNewPage() {
    if(localStorage.getItem('activeHousingstockId')) {
        loadUnderConstructionPage('Show livingtype new page');
    } else {
        loadInformationPage('You need to first choose an active housingstock');
    }
}

/** ToDo */
function loadLivingTypeEditPage(id) {
    if(localStorage.getItem('activeHousingstockId')) {
        loadUnderConstructionPage('Show livingtype edit page');
    } else {
        loadInformationPage('You need to first choose an active housingstock');
    }
}

/** ToDo */
function deleteLivingType(id) {
    if(localStorage.getItem('activeHousingstockId')) {
        loadUnderConstructionPage('Delete livingtype page');
    } else {
        loadInformationPage('You need to first choose an active housingstock');
    }
}

/**
 * Buildingaddresses
 */

function loadBuildingaddressesPage(page = 1) {
    if(localStorage.getItem('activeHousingstockId')) {
        $.ajax({
            url: '/api/v1/housingstocks/' + localStorage.getItem('activeHousingstockId') + '/addresses',
            type: 'GET',
            data: {
                page: page
            },
            dataType: 'json',
            accepts: {
                json: 'application/json'
            },
            beforeSend: function() {
                showLoader();
                $('#slide-out').sidenav('close');
            },
            success: function(data) {
                let rows = '';
                $(data.data).each(function (index, element) {
                    rows +=
                        '            <tr class="tooltipped" data-position="bottom" data-tooltip="' + element.id + ' - ' + (element.rentalUnitNumber ?? '') + '<br />' + element.streetName + ' ' + element.houseNumber + ' ' + element.addition + '<br />' + element.zipcode + ' ' + element.city + '">\n' +
                        '                <td class="hide-on-small-only"><i class="material-icons prefix">home</i></td>\n' +
                        '                <td class="hide-on-small-only">' + (element.rentalUnitNumber ?? '') + '</td>\n' +
                        '                <td class="hide-on-small-only">' + (element.streetName ?? '') + '</td>\n' +
                        '                <td class="hide-on-small-only">' + (element.houseNumber ?? '') + '</td>\n' +
                        '                <td class="hide-on-small-only">' + (element.addition ?? '') + '</td>\n' +
                        '                <td class="hide-on-med-and-up">' +
                        '                    ' + element.rentalUnitNumber + '<br />\n' +
                        '                    ' + element.streetName + ' ' + element.houseNumber + ' ' + element.addition + '<br />\n' +
                        '                    ' + element.zipcode + ' ' + element.city + '\n' +
                        '                </td>\n' +
                        '                <td class="actions">\n' +
                        '                    <button class="btn" name="edit" onclick="loadBuildingaddressEditPage(' + element.id + ');">\n' +
                        '                        <i class="material-icons">edit</i><span class="button-content hide-on-small-only">Edit</span>\n' +
                        '                    </button>\n' +
                        '                    <button class="btn" name="delete" onclick="showDeleteModal(' + element.id + ' , \'' + element.name + '\', \'deleteBuildingaddress\');">\n' +
                        '                        <i class="material-icons">delete</i><span class="button-content hide-on-small-only">Delete</span>\n' +
                        '                    </button>\n' +
                        '                </td>\n' +
                        '            </tr>\n';
                });

                let html =
                    '    <h3 class="header">Buildingaddresses</h3>\n' +
                    '    <div class="row">\n' +
                    '        <div class="input-field col s12">\n' +
                    '            <button class="btn" name="new" onclick="loadBuildingaddressNewPage();">\n' +
                    '                <i class="material-icons">house_add</i><span class="button-content hide-on-small-only">New</span>\n' +
                    '            </button>\n' +
                    '        </div>\n' +
                    '    </div>\n' +
                    '    <table>\n' +
                    '        <thead>\n' +
                    '            <tr>\n' +
                    '                <th class="hide-on-small-only"></th>\n' +
                    '                <th class="hide-on-small-only">Rental unit number</th>\n' +
                    '                <th class="hide-on-small-only">Street name</th>\n' +
                    '                <th class="hide-on-small-only">House number</th>\n' +
                    '                <th class="hide-on-small-only">Addition</th>\n' +
                    '                <th class="hide-on-med-and-up">Address</th>\n' +
                    '                <th class="actions">Actions</th>\n' +
                    '            </tr>\n' +
                    '        </thead>\n' +
                    '        <tbody>\n' +
                    rows +
                    '        </tbody>\n' +
                    '    </table>\n';

                html += addPagination(data.pager, 'loadBuildingaddressesPage');

                $('div#content').html(html);
            },
            error: function(jqXHR) {
                loadErrorPage(jqXHR);
            },
            complete: function() {
                $('.tooltipped').tooltip({'enterDelay': 1000, 'outDuration': 0,});
                hideLoader();
            },
        });
    } else {
        loadInformationPage('You need to first choose an active housingstock');
    }
}

/** ToDo */
function loadBuildingaddressNewPage() {
    if(localStorage.getItem('activeHousingstockId')) {
        showLoader();
        $('#slide-out').sidenav('close');

        let yearNow = moment().year();
        let yearSelectValues = Array(100).fill(0).map((element, index) => index + yearNow - 98);
        let yearHtmlOptions = '                    <option disabled selected>Choose a year</option>\n';
        yearSelectValues.forEach(function(item) {
            yearHtmlOptions += '                    <option value="' + item + '">' + item + '</option>\n';
        });

        $('div#content').html(
            '    <h3 class="header">New buildingaddress</h3>\n' +
            '    <form id="newbuildingaddress">\n' +
            '        <div class="row">\n' +
            '            <div class="input-field col s12">\n' +
            '                <i class="material-icons prefix disabled">view_quilt</i>\n' +
            '                <input disabled id="residentialarea" name="residentialarea" type="text" value="">\n' +
            '                <label for="residentialarea" class="active">Residential area</label>\n' +
            '            </div>\n' +
            '        </div>\n' +
            '        <div class="row">\n' +
            '            <div class="input-field col s12">\n' +
            '                <i class="material-icons prefix disabled">view_module</i>\n' +
            '                <input disabled id="block" name="block" type="text" value="">\n' +
            '                <label for="block" class="active">Block</label>\n' +
            '            </div>\n' +
            '        </div>\n' +
            '        <div class="row">\n' +
            '            <div class="input-field col s12">\n' +
            '                <i class="material-icons prefix disabled">home_work</i>\n' +
            '                <input disabled id="buildingtype" name="buildingtype" type="text" value="">\n' +
            '                <label for="buildingtype" class="active">Building type</label>\n' +
            '            </div>\n' +
            '        </div>\n' +
            '        <div class="row">\n' +
            '            <div class="input-field col s12">\n' +
            '                <i class="material-icons prefix disabled">villa</i>\n' +
            '                <input disabled id="livingtype" name="livingtype" type="text" value="">\n' +
            '                <label for="livingtype" class="active">Living type</label>\n' +
            '            </div>\n' +
            '        </div>\n' +
            '        <div class="row">\n' +
            '            <div class="input-field col s12">\n' +
            '                <i class="material-icons prefix">qr_code_2</i>\n' +
            '                <input id="rentalunitnumber" name="rentalunitnumber" type="text" class="validate">\n' +
            '                <label for="rentalunitnumber">Rental unit number</label>\n' +
            '            </div>\n' +
            '        </div>\n' +
            '        <div class="row">\n' +
            '            <div class="input-field col s12">\n' +
            '                <i class="material-icons prefix">road</i>\n' +
            '                <input id="streetname" name="streetname" type="text" class="validate">\n' +
            '                <label for="streetname">Street name</label>\n' +
            '            </div>\n' +
            '        </div>\n' +
            '        <div class="row">\n' +
            '            <div class="input-field col s12">\n' +
            '                <i class="material-icons prefix">123</i>\n' +
            '                <input id="housenumber" name="housenumber" type="text" class="validate">\n' +
            '                <label for="housenumber">House number</label>\n' +
            '            </div>\n' +
            '        </div>\n' +
            '        <div class="row">\n' +
            '            <div class="input-field col s12">\n' +
            '                <i class="material-icons prefix">abc</i>\n' +
            '                <input id="addition" name="addition" type="text" class="validate">\n' +
            '                <label for="addition">Addition</label>\n' +
            '            </div>\n' +
            '        </div>\n' +
            '        <div class="row">\n' +
            '            <div class="input-field col s12">\n' +
            '                <i class="material-icons prefix">zipcode</i>\n' +
            '                <input id="zipcode" name="zipcode" type="text" class="validate">\n' +
            '                <label for="zipcode">Zipcode</label>\n' +
            '            </div>\n' +
            '        </div>\n' +
            '        <div class="row">\n' +
            '            <div class="input-field col s12">\n' +
            '                <i class="material-icons prefix">location_city</i>\n' +
            '                <input id="city" name="city" type="text" class="validate">\n' +
            '                <label for="city">City</label>\n' +
            '            </div>\n' +
            '        </div>\n' +
            '        <div class="row">\n' +
            '            <div class="input-field col s12">\n' +
            '                <i class="material-icons prefix">qr_code_2</i>\n' +
            '                <input id="bagid" name="bagid" type="text" class="validate">\n' +
            '                <label for="bagid">BAG id</label>\n' +
            '            </div>\n' +
            '        </div>\n' +
            '        <div class="row">\n' +
            '            <div class="input-field col s12">\n' +
            '                <i class="material-icons prefix">calendar_today</i>\n' +
            '                <select name="constructionyear">\n' +
            yearHtmlOptions +
            '                </select>\n' +
            '                <label>Construction year</label>\n' +
            '            </div>\n' +
            '        </div>\n' +
            '        <div class="row">\n' +
            '            <div class="input-field col s12">\n' +
            '                <i class="material-icons prefix">calendar_today</i>\n' +
            '                <select name="renovationyear">\n' +
            yearHtmlOptions +
            '                </select>\n' +
            '                <label>Renovation year</label>\n' +
            '            </div>\n' +
            '        </div>\n' +
            '        <div class="row">\n' +
            '            <div class="input-field col s12">\n' +
            '                <i class="material-icons prefix">explore</i>\n' +
            '                <select name="orientation">\n' +
            '                    <option disabled selected>Choose a direction</option>\n' +
            '                    <option value="n" data-icon="/images/directions/n.png">Noord</option>\n' +
            '                    <option value="nne" data-icon="/images/directions/nne.png">Noord Noord Oost</option>\n' +
            '                    <option value="ne" data-icon="/images/directions/ne.png">Noord Oost</option>\n' +
            '                    <option value="nee" data-icon="/images/directions/nee.png">Noord Oost Oost</option>\n' +
            '                    <option value="e" data-icon="/images/directions/e.png">Oost</option>\n' +
            '                    <option value="see" data-icon="/images/directions/see.png">Zuid Oost Oost</option>\n' +
            '                    <option value="se" data-icon="/images/directions/se.png">Zuid Oost</option>\n' +
            '                    <option value="sse" data-icon="/images/directions/sse.png">Zuid Zuid Oost</option>\n' +
            '                    <option value="s" data-icon="/images/directions/s.png">Zuid</option>\n' +
            '                    <option value="ssw" data-icon="/images/directions/ssw.png">Zuid Zuid West</option>\n' +
            '                    <option value="sw" data-icon="/images/directions/sw.png">Zuid West</option>\n' +
            '                    <option value="sww" data-icon="/images/directions/sww.png">Zuid West West</option>\n' +
            '                    <option value="w" data-icon="/images/directions/w.png">West</option>\n' +
            '                    <option value="nww" data-icon="/images/directions/nww.png">Noord West West</option>\n' +
            '                    <option value="nw" data-icon="/images/directions/nw.png">Noord West</option>\n' +
            '                    <option value="nnw" data-icon="/images/directions/nnw.png">Noord Noord West</option>\n' +
            '                </select>\n' +
            '                <label>Orientation façade</label>\n' +
            '            </div>\n' +
            '        </div>\n' +
            '        <div class="row">\n' +
            '            <div class="input-field col s12">\n' +
            '                <p>\n' +
            '                    <i class="material-icons prefix">house_money</i>\n' +
            '                    <label>\n' +
            '                        <input type="checkbox">\n' +
            '                        <span>Deab</span>\n' +
            '                    </label>\n' +
            '                </p>\n' +
            '            </div>\n' +
            '        </div>\n' +
            '        <div class="row">\n' +
            '            <div class="col s12">\n' +
            '                <button type="submit" class="btn" name="create">\n' +
            '                    <i class="material-icons left">house_add</i>Create\n' +
            '                </button>\n' +
            '            </div>\n' +
            '        </div>\n' +
            '    </form>\n'
        );

        $('div#content select').formSelect();

        hideLoader();
    } else {
        loadInformationPage('You need to first choose an active housingstock');
    }
}

/** ToDo */
function loadBuildingaddressEditPage(id) {
    if(localStorage.getItem('activeHousingstockId')) {
        loadUnderConstructionPage('Edit buildingaddress');
    } else {
        loadInformationPage('You need to first choose an active housingstock');
    }
}

/** ToDo */
function deleteBuildingaddress(id) {
    if(localStorage.getItem('activeHousingstockId')) {
        loadUnderConstructionPage('Delete buildingaddress');
    } else {
        loadInformationPage('You need to first choose an active housingstock');
    }
}