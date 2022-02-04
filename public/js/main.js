window.housingstocks = {};
window.housingstocksToId = {};
window.activeStockInput = null;

$(document).ready(function(){
    let activeStockInput = $('input#active-stock-input').autocomplete({
        data: window.housingstocks,
        onAutocomplete: function() {
            console.log(this);
        },
    });
    window.activeStockInput = M.Autocomplete.getInstance(activeStockInput);
    $('.sidenav').sidenav();
    updateActiveStock();
});

function updateActiveStock() {
    $.ajax({
        url: "/api/buildingexaminator/v1/housingstocks",
        type: "GET",
        dataType: 'json',
        accepts: {
            json: 'application/json'
        },
        beforeSend: function() {
            for (let variableKey in window.housingstocks){
                if (window.housingstocks.hasOwnProperty(variableKey)){
                    delete window.housingstocks[variableKey];
                }
            }
            for (let variableKey in window.housingstocksToId){
                if (window.housingstocksToId.hasOwnProperty(variableKey)){
                    delete window.housingstocksToId[variableKey];
                }
            }
        },
        success: function(data) {
            $(data).each(function() {
                window.housingstocks[this.name + ' - ' + this.code] = null;
                window.housingstocksToId[this.name + ' - ' + this.code] = this.id;
            });
        },
        error: function(jqXHR) {
            loadErrorPage(jqXHR);
        },
    });
}

function showLoader() {
    $("div.overlay").show();
}

function hideLoader() {
    $("div.overlay").hide();
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
        beforeSend: function() {
            showLoader();
            $('#slide-out').sidenav('close');
        },
        success: function(data) {
            let rows = '';
            $(data).each(function (index, element) {
                rows += '            <tr class="tooltipped" data-position="bottom" data-tooltip="' + element.description + '">\n' +
                    '                <td><i class="material-icons prefix">corporate_fare</i></td>\n' +
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
                '        <div class="input-field col s12">\n' +
                '            <button class="btn" name="new" onclick="loadHousingstockNewPage();">New</button>\n' +
                '        </div>\n' +
                '    </div>\n' +
                '    <table>\n' +
                '        <thead>\n' +
                '            <tr>\n' +
                '                <th></th>\n' +
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
            updateActiveStock();
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
    showLoader();
    $('#slide-out').sidenav('close');

    $('div#content').html(
        '    <h3 class="header">New housingstock</h3>\n' +
        '    <form id="newhousingstock">\n' +
        '        <div class="row">\n' +
        '            <div class="input-field col s12">\n' +
        '                <i class="material-icons prefix">code</i>\n' +
        '                <input id="code" type="text" class="validate">\n' +
        '                <label for="code">Code</label>\n' +
        '            </div>\n' +
        '        </div>\n' +
        '        <div class="row">\n' +
        '            <div class="input-field col s12">\n' +
        '                <i class="material-icons prefix">short_text</i>\n' +
        '                <input id="name" type="text" class="validate">\n' +
        '                <label for="name">Name</label>\n' +
        '            </div>\n' +
        '        </div>\n' +
        '        <div class="row">\n' +
        '            <div class="input-field col s12">\n' +
        '                <i class="material-icons prefix">subject</i>\n' +
        '                <textarea id="description" class="materialize-textarea"></textarea>\n' +
        '                <label for="description">Description</label>\n' +
        '            </div>\n' +
        '        </div>\n' +
        '        <div class="row">\n' +
        '            <div class="col s12">\n' +
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
}

function loadHousingstockEditPage(id) {
    $.ajax({
        url: "/api/buildingexaminator/v1/housingstocks/" + id,
        type: "GET",
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
                '    <h3 class="header">Edit housingstock</h3>\n' +
                '    <form id="edithousingstock">\n' +
                '        <div class="row">\n' +
                '            <div class="input-field col s12">\n' +
                '                <i class="material-icons prefix">hotel_class</i>\n' +
                '                <input disabled id="id" type="text" value="' + data.id + '">\n' +
                '                <label for="id" class="active">Id</label>\n' +
                '            </div>\n' +
                '        </div>\n' +
                '        <div class="row">\n' +
                '            <div class="input-field col s12">\n' +
                '                <i class="material-icons prefix">code</i>\n' +
                '                <input id="code" type="text" class="validate" value="' + data.code + '">\n' +
                '                <label for="code" class="active">Code</label>\n' +
                '            </div>\n' +
                '        </div>\n' +
                '        <div class="row">\n' +
                '            <div class="input-field col s12">\n' +
                '                <i class="material-icons prefix">short_text</i>\n' +
                '                <input id="name" type="text" class="validate" value="' + data.name + '">\n' +
                '                <label for="name" class="active">Name</label>\n' +
                '            </div>\n' +
                '        </div>\n' +
                '        <div class="row">\n' +
                '            <div class="input-field col s12">\n' +
                '                <i class="material-icons prefix">subject</i>\n' +
                '                <textarea id="description" class="materialize-textarea">' + data.description + '</textarea>\n' +
                '                <label for="description" class="active">Description</label>\n' +
                '            </div>\n' +
                '        </div>\n' +
                '        <div class="row">\n' +
                '            <div class="input-field col s12">\n' +
                '                <i class="material-icons prefix">date_range</i>\n' +
                '                <input disabled id="created" type="text" value="' + moment.unix(parseInt(data.creationTime.timestamp)).locale('en_US').format('LLL') + '">\n' +
                '                <label for="created" class="active">Created</label>\n' +
                '            </div>\n' +
                '        </div>\n' +
                '        <div class="row">\n' +
                '            <div class="input-field col s12">\n' +
                '                <i class="material-icons prefix">date_range</i>\n' +
                '                <input disabled id="lastchange" type="text" value="' + moment.unix(parseInt(data.lastChangeTime.timestamp)).locale('en_US').format('LLL') + '">\n' +
                '                <label for="lastchange" class="active">Last change</label>\n' +
                '            </div>\n' +
                '        </div>\n' +
                '        <div class="row">\n' +
                '            <div class="col s12">\n' +
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
                'onCloseEnd': function() {
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
        success: function() {
            loadHousingstocksPage();
        },
        error: function(jqXHR) {
            loadErrorPage(jqXHR);
            hideLoader();
        },
    });
}

function loadBuildingaddressesPage() {
    if(localStorage.getItem('activeHousingstock')) {
        $('div#content').html(
            '    <h3 class="header">Buildingaddresses</h3>\n' +
            '    <div class="row">\n' +
            '        <div class="input-field col s12">\n' +
            '            <button class="btn" name="new" onclick="loadBuildingaddressNewPage();">New</button>\n' +
            '        </div>\n' +
            '    </div>\n'
        );
    } else {
        loadInformationPage('You need to first choose an active housingstock');
    }
}

function loadBuildingaddressNewPage() {
    $('div#content').html(
        '    <h3 class="header">New buildingaddress</h3>\n' +
        '    <form id="newbuildingaddress">\n' +
        '        <div class="row">\n' +
        '            <div class="input-field col s12">\n' +
        '                <i class="material-icons prefix">explore</i>\n' +
        '                <select>\n' +
        '                    <option value="" disabled selected>Choose your option</option>\n' +
        '                    <option value="n">Noord</option>\n' +
        '                    <option value="nno">Noord Noord Oost</option>\n' +
        '                    <option value="no">Noord Oost</option>\n' +
        '                    <option value="noo">Noord Oost Oost</option>\n' +
        '                    <option value="o"> Oost</option>\n' +
        '                    <option value="zoo">Zuid Oost Oost</option>\n' +
        '                    <option value="zo">Zuid Oost</option>\n' +
        '                    <option value="zzo">Zuid Zuid Oost</option>\n' +
        '                    <option value="z">Zuid</option>\n' +
        '                    <option value="zzw">Zuid Zuid West</option>\n' +
        '                    <option value="zw">Zuid West</option>\n' +
        '                    <option value="zww">Zuid West West</option>\n' +
        '                    <option value="w">West</option>\n' +
        '                    <option value="nww">Noord West West</option>\n' +
        '                    <option value="nw">Noord West</option>\n' +
        '                    <option value="nnw">Noord Noord West</option>\n' +
        '                </select>\n' +
        '                <label>Orientation façade</label>\n' +
        '            </div>\n' +
        '        </div>\n' +
        '        <div class="row">\n' +
        '            <div class="col s12">\n' +
        '                <button type="submit" class="btn" name="create">Create</button>\n' +
        '            </div>\n' +
        '        </div>\n' +
        '    </form>\n'
    );
    $('select').formSelect();
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
}