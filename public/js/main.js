$(document).ready(function(){
    $('.sidenav').sidenav();
});

function showLoader() {
    $( "div.overlay" ).show();
}

function hideLoader() {
    $( "div.overlay" ).hide();
}

function loadHomePage() {
    showLoader();
    $('#slide-out').sidenav('close');
    location.reload();
}

function loadHousingstocksPage() {
    $.ajax({
        url: "/api/buildingexaminator/v1/housingstocks",
        type: "GET",
        dataType: 'json',
        accepts: {
            json: 'application/json'
        },
        beforeSend: function () {
            showLoader();
            $('#slide-out').sidenav('close');
        },
        success: function (data) {
            let rows = '';
            $(data).each(function (index, element) {
                rows += '            <tr>\n' +
                    '                <td>' + element.code + '</td>\n' +
                    '                <td>' + element.name + '</td>\n' +
                    '                <td>\n' +
                    '                    <button class="btn" name="edit" onclick="loadHousingstockEditPage(' + element.id + ');">Edit</button>\n' +
                    '                    <button class="btn" name="delete" onclick="showDeleteHousingstockModal(' + element.id + ' , \'' + element.name + '\');">Delete</button>\n' +
                    '                </td>\n' +
                    '            </tr>\n';
            });

            $('div#content').html(
                '    <h3 class="header">Housingstocks</h3>\n' +
                '    <div class="row">\n' +
                '        <div class="input-field col s6">\n' +
                '            <button class="btn" name="new" onclick="loadHousingstockNewPage();">New</button>\n' +
                '        </div>\n' +
                '    </div>\n' +
                '    <table>\n' +
                '        <thead>\n' +
                '            <tr>\n' +
                '                <th>Code</th>\n' +
                '                <th>Name</th>\n' +
                '                <th>Action</th>\n' +
                '            </tr>\n' +
                '        </thead>\n' +
                '        <tbody>\n' +
                rows +
                '        </tbody>\n' +
                '    </table>\n'
            );
        },
        error: function (jqXHR) {
            loadErrorPage(jqXHR)
        },
        complete: function () {
            hideLoader();
        },
    });
}

function loadHousingstockNewPage() {
    showLoader();
    $('#slide-out').sidenav('close');

    $('div#content').html(
        '    <h3 class="header">New housingstock</h3>\n' +
        '    <form id="newhousingstock">\n' +
        '        <div class="row">\n' +
        '            <div class="input-field col s6">\n' +
        '                <input id="code" type="text" class="validate">\n' +
        '                <label for="code">Code</label>\n' +
        '            </div>\n' +
        '        </div>\n' +
        '        <div class="row">\n' +
        '            <div class="input-field col s6">\n' +
        '                <input id="name" type="text" class="validate">\n' +
        '                <label for="name">Name</label>\n' +
        '            </div>\n' +
        '        </div>\n' +
        '        <div class="row">\n' +
        '            <div class="input-field col s6">\n' +
        '                <textarea id="description" class="materialize-textarea"></textarea>\n' +
        '                <label for="description">Description</label>\n' +
        '            </div>\n' +
        '        </div>\n' +
        '        <div class="row">\n' +
        '            <div class="col s6">\n' +
        '                <button type="submit" class="btn" name="create">Create</button>\n' +
        '            </div>\n' +
        '        </div>\n' +
        '    </form>\n'
    );

    hideLoader();

    $('form#newhousingstock').submit(function(event) {
        event.preventDefault();
        $.ajax({
            url: "/api/buildingexaminator/v1/housingstocks",
            type: "POST",
            dataType: 'json',
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
            success: function () {
                loadHousingstocksPage();
            },
            error: function (jqXHR) {
                loadErrorPage(jqXHR)
            },
            complete: function () {
                hideLoader();
            },
        });
    });
}

function loadHousingstockEditPage(id) {
    console.log('Edit button pressed for housingstock ' + id + '.');
}

function showDeleteHousingstockModal(id, name) {
    let modal = $('<div/>', {'id': 'modal-delete', 'class': 'modal'})
        .append(
            $('<div/>', {'class': 'modal-content'})
                .append($('<h4/>').text('Delete ' + name))
                .append($('<p/>').text('Are you sure?'))
        )
        .append(
            $('<div/>', {'class': 'modal-footer'})
                .append($('<a/>', {'class': 'modal-close btn-flat'}).text('No'))
                .append($('<a/>', {'onclick': 'deleteHousingstock(' + id + ');', 'class': 'modal-close btn-flat'}).text('Yes'))
        )
        .appendTo('body')
        .modal(
            {
                'dismissible': false,
                'onCloseEnd': function () {
                    $('div#' + this.id).remove();
                    this.destroy();
                }
            }
        );
    let modalInstance = M.Modal.getInstance(modal);
    modalInstance.open();
}

function deleteHousingstock(id) {
    console.log('Delete button pressed and confirmed for housingstock ' + id + '.');
}

function loadErrorPage(jqXHR) {
    console.log(jqXHR);

    let response, message, IS_JSON = true;

    try {
        response = $.parseJSON(jqXHR.responseText);
    } catch(err) {
        IS_JSON = false;
    }

    if(IS_JSON) {
        message = response.class + ': ' + response.detail;
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
}