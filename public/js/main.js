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
                rows += '            <tr class="tooltipped" data-position="bottom" data-tooltip="' + element.description + '">\n' +
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
            $('.tooltipped').tooltip({'enterDelay': 1000, 'outDuration': 0,});
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
    $.ajax({
        url: "/api/buildingexaminator/v1/housingstocks/" + id,
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
            $('div#content').html(
                '    <h3 class="header">Edit housingstock</h3>\n' +
                '    <form id="edithousingstock">\n' +
                '        <div class="row">\n' +
                '            <div class="input-field col s6">\n' +
                '                <input disabled id="id" type="text" value="' + data.id + '">\n' +
                '                <label for="id" class="active">Id</label>\n' +
                '            </div>\n' +
                '        </div>\n' +
                '        <div class="row">\n' +
                '            <div class="input-field col s6">\n' +
                '                <input id="code" type="text" class="validate" value="' + data.code + '">\n' +
                '                <label for="code" class="active">Code</label>\n' +
                '            </div>\n' +
                '        </div>\n' +
                '        <div class="row">\n' +
                '            <div class="input-field col s6">\n' +
                '                <input id="name" type="text" class="validate" value="' + data.name + '">\n' +
                '                <label for="name" class="active">Name</label>\n' +
                '            </div>\n' +
                '        </div>\n' +
                '        <div class="row">\n' +
                '            <div class="input-field col s6">\n' +
                '                <textarea id="description" class="materialize-textarea">' + data.description + '</textarea>\n' +
                '                <label for="description" class="active">Description</label>\n' +
                '            </div>\n' +
                '        </div>\n' +
                '        <div class="row">\n' +
                '            <div class="input-field col s6">\n' +
                '                <input disabled id="created" type="text" value="' + moment.unix(parseInt(data.creationTime.timestamp)).locale('en_US').format('LLL') + '">\n' +
                '                <label for="created" class="active">Created</label>\n' +
                '            </div>\n' +
                '        </div>\n' +
                '        <div class="row">\n' +
                '            <div class="input-field col s6">\n' +
                '                <input disabled id="lastchange" type="text" value="' + moment.unix(parseInt(data.lastChangeTime.timestamp)).locale('en_US').format('LLL') + '">\n' +
                '                <label for="lastchange" class="active">Last change</label>\n' +
                '            </div>\n' +
                '        </div>\n' +
                '        <div class="row">\n' +
                '            <div class="col s6">\n' +
                '                <button type="submit" class="btn" name="save">Save</button>\n' +
                '            </div>\n' +
                '        </div>\n' +
                '    </form>\n'
            );

            $('form#edithousingstock').submit(function(event) {
                event.preventDefault();
                $.ajax({
                    url: "/api/buildingexaminator/v1/housingstocks/" + $('input#id').val(),
                    type: "PUT",
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
        },
        error: function (jqXHR) {
            loadErrorPage(jqXHR)
        },
        complete: function () {
            hideLoader();
        },
    });
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
                'preventScrolling': false,
                'onCloseEnd': function () {
                    this.destroy();
                    $('div#' + this.id).remove();
                }
            }
        );
    let modalInstance = M.Modal.getInstance(modal);
    modalInstance.open();
}

function deleteHousingstock(id) {
    $.ajax({
        url: "/api/buildingexaminator/v1/housingstocks/" + id,
        type: "DELETE",
        beforeSend: function() {
            showLoader();
            $('#slide-out').sidenav('close');
        },
        success: function () {
            loadHousingstocksPage();
        },
        error: function (jqXHR) {
            loadErrorPage(jqXHR)
            hideLoader();
        },
    });
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