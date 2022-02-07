window.housingstocks = {};
window.housingstocksToId = {};
window.activeHousingstockInput = null;

$(document).ready(function(){
    let activeHousingstockInput = $('input#active-stock-input').autocomplete({
        data: window.housingstocks,
        onAutocomplete: function() {
            console.log(this);
        },
    });
    window.activeHousingstockInput = M.Autocomplete.getInstance(activeHousingstockInput);
    $('.sidenav').sidenav();
    updateActiveHousingstockInput();
    diaOfLogo();

    localStorage.setItem('activeHousingstock', '1');
});

function sleep(ms) {
    return new Promise(resolve => setTimeout(resolve, ms));
}

async function diaOfLogo() {
    let logo_dia = $('#logo-dia');
    let y_cor = 0;
    for (let i = 0; i < 293;) {
        y_cor = i * -125;
        logo_dia.css('backgroundPosition', '0px ' + y_cor + 'px');
        await sleep(60);
        i++;
    }
}

function updateActiveHousingstockInput() {
    $.ajax({
        url: '/api/buildingexaminator/v1/housingstocks',
        type: 'GET',
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
    $('div.overlay').show();
}

function hideLoader() {
    $('div.overlay').hide();
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

function loadHomePage() {
    showLoader();
    $('#slide-out').sidenav('close');
    location.reload();
}

function loadHousingstocksPage() {
    $.ajax({
        url: '/api/buildingexaminator/v1/housingstocks',
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
            let rows = '';
            $(data).each(function (index, element) {
                rows +=
                    '            <tr class="tooltipped" data-position="bottom" data-tooltip="' + element.description + '">\n' +
                    '                <td><i class="material-icons prefix">domain</i></td>\n' +
                    '                <td>' + element.code + '</td>\n' +
                    '                <td>' + element.name + '</td>\n' +
                    '                <td>\n' +
                    '                    <button class="btn" name="edit" onclick="loadHousingstockEditPage(' + element.id + ');">\n' +
                    '                        <i class="material-icons left">edit</i>Edit\n' +
                    '                    </button>\n' +
                    '                    <button class="btn" name="delete" onclick="showDeleteHousingstockModal(' + element.id + ' , \'' + element.name + '\');">\n' +
                    '                        <i class="material-icons left">delete</i>Delete\n' +
                    '                    </button>\n' +
                    '                </td>\n' +
                    '            </tr>\n';
            });

            $('div#content').html(
                '    <h3 class="header">Housingstocks</h3>\n' +
                '    <div class="row">\n' +
                '        <div class="input-field col s12">\n' +
                '            <button class="btn" name="new" onclick="loadHousingstockNewPage();">\n' +
                '                <i class="material-icons left">domain_add</i>New\n' +
                '            </button>\n' +
                '        </div>\n' +
                '    </div>\n' +
                '    <table>\n' +
                '        <thead>\n' +
                '            <tr>\n' +
                '                <th></th>\n' +
                '                <th>Code</th>\n' +
                '                <th>Name</th>\n' +
                '                <th class="actions">Actions</th>\n' +
                '            </tr>\n' +
                '        </thead>\n' +
                '        <tbody>\n' +
                rows +
                '        </tbody>\n' +
                '    </table>\n' +
                '    <ul class="pagination">\n' +
                '        <li class="disabled">' +
                '            <a href="javascript:void(0);"><i class="material-icons">chevron_left</i></a>' +
                '        </li>\n' +
                '        <li class=""><a href="javascript:void(0);">1</a></li>\n' +
                '        <!-- <li class="waves-effect"><a href="javascript:void(0);">2</a></li> -->\n' +
                '        <!-- <li class="waves-effect"><a href="javascript:void(0);">3</a></li> -->\n' +
                '        <!-- <li class="waves-effect"><a href="javascript:void(0);">4</a></li> -->\n' +
                '        <!-- <li class="waves-effect"><a href="javascript:void(0);">5</a></li> -->\n' +
                '        <li class="disabled">' +
                '            <a href="javascript:void(0);"><i class="material-icons">chevron_right</i></a>' +
                '        </li>\n' +
                '    </ul>'
            );
            updateActiveHousingstockInput();
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

    hideLoader();

    $('form#newhousingstock').submit(function(event) {
        event.preventDefault();
        $.ajax({
            url: '/api/buildingexaminator/v1/housingstocks',
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
        url: '/api/buildingexaminator/v1/housingstocks/' + id,
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
                '    <h3 class="header">Edit housingstock</h3>\n' +
                '    <form id="edithousingstock">\n' +
                '        <div class="row">\n' +
                '            <div class="input-field col s12">\n' +
                '                <i class="material-icons prefix disabled">numbers</i>\n' +
                '                <input disabled id="id" name="id" type="text" value="' + data.id + '">\n' +
                '                <label for="id" class="active">Id</label>\n' +
                '            </div>\n' +
                '        </div>\n' +
                '        <div class="row">\n' +
                '            <div class="input-field col s12">\n' +
                '                <i class="material-icons prefix">qr_code_2</i>\n' +
                '                <input id="code" name="code" type="text" class="validate" value="' + data.code + '">\n' +
                '                <label for="code" class="active">Code</label>\n' +
                '            </div>\n' +
                '        </div>\n' +
                '        <div class="row">\n' +
                '            <div class="input-field col s12">\n' +
                '                <i class="material-icons prefix">short_text</i>\n' +
                '                <input id="name" name="name" type="text" class="validate" value="' + data.name + '">\n' +
                '                <label for="name" class="active">Name</label>\n' +
                '            </div>\n' +
                '        </div>\n' +
                '        <div class="row">\n' +
                '            <div class="input-field col s12">\n' +
                '                <i class="material-icons prefix">description</i>\n' +
                '                <textarea id="description" name="description" class="materialize-textarea">' + data.description + '</textarea>\n' +
                '                <label for="description" class="active">Description</label>\n' +
                '            </div>\n' +
                '        </div>\n' +
                '        <div class="row">\n' +
                '            <div class="input-field col s12">\n' +
                '                <i class="material-icons prefix disabled">schedule</i>\n' +
                '                <input disabled id="created" name="created" type="text" value="' + moment.unix(parseInt(data.creationTime.timestamp)).locale('en_US').format('LLL') + '">\n' +
                '                <label for="created" class="active">Created</label>\n' +
                '            </div>\n' +
                '        </div>\n' +
                '        <div class="row">\n' +
                '            <div class="input-field col s12">\n' +
                '                <i class="material-icons prefix disabled">update</i>\n' +
                '                <input disabled id="lastchange" name="lastchange" type="text" value="' + moment.unix(parseInt(data.lastChangeTime.timestamp)).locale('en_US').format('LLL') + '">\n' +
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
                    url: '/api/buildingexaminator/v1/housingstocks/' + $('input#id').val(),
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
        url: '/api/buildingexaminator/v1/housingstocks/' + id,
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

function loadBuildingaddressesPage() {
    if(localStorage.getItem('activeHousingstock')) {
        $.ajax({
            url: '/api/buildingexaminator/v1/housingstocks/' + localStorage.getItem('activeHousingstock') + '/addresses',
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
                let rows = '';
                $(data).each(function (index, element) {
                    rows +=
                        '            <tr class="tooltipped" data-position="bottom" data-tooltip="' + element.id + '<br />' + element.streetName + ' ' + element.houseNumber + ' ' + element.addition + '<br />' + element.zipcode + ' ' + element.city + '">\n' +
                        '                <td><i class="material-icons prefix">home</i></td>\n' +
                        '                <td>' + element.rentalUnitNumber + '</td>\n' +
                        '                <td>' + element.streetName + '</td>\n' +
                        '                <td>' + element.houseNumber + '</td>\n' +
                        '                <td>' + element.addition + '</td>\n' +
                        '                <td>\n' +
                        '                    <button class="btn" name="edit" onclick="loadBuildingaddressEditPage(' + element.id + ');">\n' +
                        '                        <i class="material-icons left">edit</i>Edit\n' +
                        '                    </button>\n' +
                        '                    <button class="btn" name="delete" onclick="showDeleteBuildingaddressModal(' + element.id + ' , \'' + element.name + '\');">\n' +
                        '                        <i class="material-icons left">delete</i>Delete\n' +
                        '                    </button>\n' +
                        '                </td>\n' +
                        '            </tr>\n';
                });

                $('div#content').html(
                    '    <h3 class="header">Buildingaddresses</h3>\n' +
                    '    <div class="row">\n' +
                    '        <div class="input-field col s12">\n' +
                    '            <button class="btn" name="new" onclick="loadBuildingaddressNewPage();">\n' +
                    '                <i class="material-icons left">house_add</i>New\n' +
                    '            </button>\n' +
                    '        </div>\n' +
                    '    </div>\n' +
                    '    <table>\n' +
                    '        <thead>\n' +
                    '            <tr>\n' +
                    '                <th></th>\n' +
                    '                <th>Rental unit number</th>\n' +
                    '                <th>Street name</th>\n' +
                    '                <th>House number</th>\n' +
                    '                <th>Addition</th>\n' +
                    '                <th class="actions">Actions</th>\n' +
                    '            </tr>\n' +
                    '        </thead>\n' +
                    '        <tbody>\n' +
                    rows +
                    '        </tbody>\n' +
                    '    </table>\n' +
                    '    <ul class="pagination">\n' +
                    '        <li class="disabled">' +
                    '            <a href="javascript:void(0);"><i class="material-icons">chevron_left</i></a>' +
                    '        </li>\n' +
                    '        <li class=""><a href="javascript:void(0);">1</a></li>\n' +
                    '        <!-- <li class="waves-effect"><a href="javascript:void(0);">2</a></li> -->\n' +
                    '        <!-- <li class="waves-effect"><a href="javascript:void(0);">3</a></li> -->\n' +
                    '        <!-- <li class="waves-effect"><a href="javascript:void(0);">4</a></li> -->\n' +
                    '        <!-- <li class="waves-effect"><a href="javascript:void(0);">5</a></li> -->\n' +
                    '        <li class="disabled">' +
                    '            <a href="javascript:void(0);"><i class="material-icons">chevron_right</i></a>' +
                    '        </li>\n' +
                    '    </ul>'
                );
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

function loadBuildingaddressNewPage() {
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
        '                <select name="constructionyear">\n' +
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
        '                <button type="submit" class="btn" name="create">Create</button>\n' +
        '            </div>\n' +
        '        </div>\n' +
        '    </form>\n'
    );
    $('select').formSelect();
}