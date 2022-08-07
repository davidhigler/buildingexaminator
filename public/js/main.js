let logo_y = 0, logo_up = true;

$(document).ready(function(){
    $('.sidenav').sidenav();
    setInterval(diaOfLogo, 80);
    loadHomePage();
});

/**
 * #################################################
 */

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

function addPagination(pager, searchterm, callback) {
    let html = '    <ul class="pagination">\n';
    if (pager.previous > 0) {
        html +=
            '        <li>' +
            '            <a href="javascript:' + callback + '(' + pager.previous + ', \'' + searchterm + '\');"><i class="material-icons">chevron_left</i></a>' +
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
                '            <a href="javascript:' + callback + '(' + previousIndex + ', \'' + searchterm + '\');">' + previousIndex + '</a>' +
                '        </li>\n';
        }
    }
    html +=
        '        <li class="active">' +
        '            <a href="javascript:' + callback + '(' + pager.current + ', \'' + searchterm + '\');">' + pager.current + '</a>' +
        '        </li>\n';
    for (let i = 1; i < 5; i++) {
        let nextIndex = pager.current + i;
        if (nextIndex <= pager.count) {
            html +=
                '        <li>' +
                '            <a href="javascript:' + callback + '(' + nextIndex + ', \'' + searchterm + '\');">' + nextIndex + '</a>' +
                '        </li>\n';
        }
    }
    if (pager.next > 0) {
        html +=
            '        <li>' +
            '            <a href="javascript:' + callback + '(' + pager.next + ', \'' + searchterm + '\');"><i class="material-icons">chevron_right</i></a>' +
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

            $('div#content').html(
                '        <h3 class="header">Building Examinator</h3>\n' +
                '        <p>This is the testing application for our app the Building Examinator.</p>\n' +
                '        <div class="possibleByLogos">\n' +
                '            <a href="https://www.nginx.com" target="_blank" class="possibleByLogo">\n' +
                '                <img alt="NGinX" src="/images/logos/NGinX.png">\n' +
                '            </a>\n' +
                '            <a href="https://www.php.net" target="_blank" class="possibleByLogo">\n' +
                '                <object type="image/svg+xml" data="https://upload.wikimedia.org/wikipedia/commons/2/27/PHP-logo.svg">Your browser does not support SVG</object>\n' +
                '            </a>\n' +
                '            <a href="https://www.mysql.com" target="_blank" class="possibleByLogo">\n' +
                '                <img alt="MySql" src="/images/logos/MySql.png">\n' +
                '            </a>\n' +
                '            <br/>\n' +
                '            <br/>\n' +
                '            <a href="https://symfony.com" target="_blank" class="possibleByLogo">\n' +
                '                <object type="image/svg+xml" data="https://symfony.com/images/logos/header-logo.svg">Your browser does not support SVG</object>\n' +
                '            </a>\n' +
                '            <a href="https://getcomposer.org" target="_blank" class="possibleByLogo">\n' +
                '                <img alt="Composer" src="/images/logos/Composer.png">\n' +
                '            </a>\n' +
                '            <a href="https://thephpleague.com" target="_blank" class="possibleByLogo">\n' +
                '                <img alt="ThePhpLeague" src="/images/logos/ThePhpLeague.png">\n' +
                '            </a>\n' +
                '            <br/>\n' +
                '            <br/>\n' +
                '            <a href="https://materializecss.com" target="_blank" class="possibleByLogo">\n' +
                '                <object type="image/svg+xml" data="https://materializecss.com/res/materialize.svg">Your browser does not support SVG</object>\n' +
                '            </a>\n' +
                '            <a href="https://jquery.com" target="_blank" class="possibleByLogo">\n' +
                '                <img alt="jQuery" src="/images/logos/jQuery.png">\n' +
                '            </a>\n' +
                '            <a href="https://momentjs.com" target="_blank" class="possibleByLogo">\n' +
                '                <img alt="MomentJS" src="/images/logos/MomentJS.png">\n' +
                '            </a>\n' +
                '        </div>\n'
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
    showLoader();
    $('#slide-out').sidenav('close');

    $('div#content').html(
        '    <h3 class="header">Test page</h3>\n' +
        '    <h4 class="header">Make and upload image</h4>\n' +
        '    <div class="row">\n' +
        '        <div class="col s12">\n' +
        '            <div class="file-field input-field">\n' +
        '                <div class="btn">\n' +
        '                    <span><i class="material-icons left">add_a_photo</i>Photo</span>\n' +
        '                    <input id="photoUpload" type="file" accept="image/*" capture="environment" />\n' +
        '                </div>\n' +
        '                <div class="file-path-wrapper">\n' +
        '                    <input class="file-path validate" type="text" />\n' +
        '                </div>\n' +
        '             </div>\n' +
        '        </div>\n' +
        '    </div>\n' +
        '    <div class="row">\n' +
        '        <div class="col s12">\n' +
        '            <img id="photoPreview" src="#" alt="Image preview" style="display: none; width: 100%;" />\n' +
        '        </div>\n' +
        '    </div>\n' +
        '    <h4 class="header">Map with BAG information</h4>\n' +
        '    <div class="row">\n' +
        '        <div class="col s12">\n' +
        '            <div id="viewDiv"></div>\n' +
        '        </div>\n' +
        '    </div>\n'
    );

    $('div#content div#viewDiv').height(700);

    require([
        "esri/config",
        "esri/Map",
        "esri/views/MapView",
        "esri/layers/FeatureLayer",
        "esri/layers/support/LabelClass"
    ], function (esriConfig, Map, MapView, FeatureLayer, LabelClass) {
        esriConfig.apiKey = "AAPK21dd9c351d74488a99225c91443945e8TwS-RdfcjDLG311EoDWT-PdkzjXfwNkr4Q5JMgS0stdN7VwIr8pLamQMhjjALefM";
        const bagPandenLayerLabel = new LabelClass({
            labelExpressionInfo: { expression: "$feature.objectid" },
            allowOverrun: true,
            deconflictionStrategy: "none",
            minScale: 2500,
            symbol: {
                type: "text",
                color: "black",
                font: {
                    family: "Ubuntu Mono",
                    size: 6
                }
            }
        });
        const bagPandenLayer = new FeatureLayer({
            url: "https://basisregistraties.arcgisonline.nl/arcgis/rest/services/BAG/BAGv3/FeatureServer/4",
            definitionExpression:
                "identificatie IN (" +
                    "'0193100000017808', " +
                    "'0193100000004644', " +
                    "'0193100000058461', " +
                    "'0193100000058462', " +
                    "'0193100000018103', " +
                    "'0193100000018102', " +
                    "'0193100000018100', " +
                    "'0193100000018075', " +
                    "'0193100000018074', " +
                    "'0193100000018073', " +
                    "'0193100000018072', " +
                    "'0193100000018071', " +
                    "'0193100000018070'" +
                ")",
            minScale: 25000,
            outFields: ['objectid'],
            labelingInfo: bagPandenLayerLabel
        });
        const map = new Map({
            basemap: "osm-light-gray",
            layers: [
                bagPandenLayer
            ]
        });
        const view = new MapView({
            map: map,
            center: [6.0909033, 52.5129319],
            zoom: 17,
            container: "viewDiv",
            constraints: {
                snapToZoom: false
            }
        });
        bagPandenLayer.when(() => {
            return bagPandenLayer.queryExtent();
        })
        .then((response) => {
            view.goTo(response.extent);
        });
    });

    $('input#photoUpload').change(
        function(event) {
            $('img#photoPreview')
                .attr(
                    'src',
                    URL.createObjectURL(event.target.files[0])
                )
                .show()
                .off('click')
                .click(
                    function(event) {
                        //console.log(event);
                        //console.log('event.offsetX: ' + event.offsetX);
                        //console.log('event.target.clientWidth: ' + event.target.clientWidth);
                        //console.log('event.target.naturalWidth: ' + event.target.naturalWidth);

                        let realX = Math.floor((event.offsetX/event.target.clientWidth)*event.target.naturalWidth);
                        //console.log(realX);

                        //console.log('event.offsetY: ' + event.offsetY);
                        //console.log('event.target.clientHeight: ' + event.target.clientHeight);
                        //console.log('event.target.naturalHeight: ' + event.target.naturalHeight);

                        let realY = Math.floor((event.offsetY/event.target.clientHeight)*event.target.naturalHeight);
                        //console.log(realY);

                        M.toast({html: 'X:' + realX + ' Y:' + realY});
                    }
                );
        }
    );

    hideLoader();
}

/**
 * #################################################
 */

/**
 * Owners
 */

function loadOwnersPage(page = 1, searchterm = '') {
    $.ajax({
        url: '/api/v1/owners',
        type: 'GET',
        data: {
            page: page,
            searchterm: searchterm
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
                '        <div class="input-field col s6">\n' +
                '            <input id="searchterm" type="search" value="' + searchterm + '">\n' +
                '            <label for="searchterm" class="' + ( Boolean(searchterm) ? 'active' : '' ) + '">Search</label>\n' +
                '        </div>\n' +
                '        <div class="input-field col s3">\n' +
                '            <button class="btn" onclick="loadOwnersPage(1, $(\'input#searchterm\').val());">\n' +
                '                <i class="material-icons">search</i><span class="button-content hide-on-small-only">Search</span>\n' +
                '            </button>\n' +
                '        </div>\n' +
                '        <div class="input-field col s3">\n' +
                '            <button class="btn right" onclick="loadOwnerNewPage();">\n' +
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

            html += addPagination(data.pager, searchterm, 'loadOwnersPage');

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
        '                <input id="name" name="name" type="text" class="validate" required aria-required="true" minlength="3" maxlength="128">\n' +
        '                <label for="name">Name</label>\n' +
        '                <span class="helper-text" data-error="Wrong (min 3 and max 128 characters)" data-success="Right"></span>\n' +
        '            </div>\n' +
        '        </div>\n' +
        '        <div class="row">\n' +
        '            <div class="input-field col s12">\n' +
        '                <i class="material-icons prefix">kvk</i>\n' +
        '                <input id="kvk" name="kvk" type="text" class="validate" pattern="[0-9]{8}">\n' +
        '                <label for="kvk">KVK</label>\n' +
        '                <span class="helper-text" data-error="Wrong (must be exactly 8 numbers)" data-success="Right"></span>\n' +
        '            </div>\n' +
        '        </div>\n' +
        '        <div class="row">\n' +
        '            <div class="input-field col s12">\n' +
        '                <i class="material-icons prefix">belastingdienst</i>\n' +
        '                <input id="btw" name="btw" type="text" class="validate" pattern="[0-9a-zA-Z]{14}">\n' +
        '                <label for="btw">BTW</label>\n' +
        '                <span class="helper-text" data-error="Wrong (must be exactly 14 characters)" data-success="Right"></span>\n' +
        '            </div>\n' +
        '        </div>\n' +
        '        <div class="row">\n' +
        '            <div class="input-field col s12">\n' +
        '                <i class="material-icons prefix">aedes</i>\n' +
        '                <input id="lnumber" name="lnumber" type="text" class="validate" pattern="L[0-9]{4}">\n' +
        '                <label for="lnumber">L number</label>\n' +
        '                <span class="helper-text" data-error="Wrong (must be a L with 4 numbers)" data-success="Right"></span>\n' +
        '            </div>\n' +
        '        </div>\n' +
        '        <div class="row">\n' +
        '            <div class="input-field col s12">\n' +
        '                <i class="material-icons prefix">http</i>\n' +
        '                <input id="website" name="website" type="url" class="validate" pattern="https://.*" maxlength="256">\n' +
        '                <label for="website">Website</label>\n' +
        '                <span class="helper-text" data-error="Wrong (must be a valid URL)" data-success="Right"></span>\n' +
        '            </div>\n' +
        '        </div>\n' +
        '        <div class="row">\n' +
        '            <div class="col s6">\n' +
        '                <button class="btn" name="create" type="submit">\n' +
        '                    <i class="material-icons left">add_owner</i>Create\n' +
        '                </button>\n' +
        '            </div>\n' +
        '            <div class="col s6">\n' +
        '                <button class="btn right" name="cancel">\n' +
        '                    <i class="material-icons left">cancel</i>Cancel\n' +
        '                </button>\n' +
        '            </div>\n' +
        '        </div>\n' +
        '    </form>\n'
    );

    hideLoader();

    $("form#newowner button[name='cancel']").click(
        function(event) {
            event.preventDefault();
            loadOwnersPage();
        }
    );

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
                '                <input id="name" name="name" type="text" class="validate" required aria-required="true" minlength="3" maxlength="128" value="' + data.data.name + '">\n' +
                '                <label for="name" class="active">Name</label>\n' +
                '                <span class="helper-text" data-error="Wrong (min 3 and max 128 characters)" data-success="Right"></span>\n' +
                '            </div>\n' +
                '        </div>\n' +
                '        <div class="row">\n' +
                '            <div class="input-field col s12">\n' +
                '                <i class="material-icons prefix">kvk</i>\n' +
                '                <input id="kvk" name="kvk" type="text" class="validate" pattern="[0-9]{8}" value="' + (data.data.kvk ?? '') + '">\n' +
                '                <label for="kvk" class="active">KVK</label>\n' +
                '                <span class="helper-text" data-error="Wrong (must be exactly 8 numbers)" data-success="Right"></span>\n' +
                '            </div>\n' +
                '        </div>\n' +
                '        <div class="row">\n' +
                '            <div class="input-field col s12">\n' +
                '                <i class="material-icons prefix">belastingdienst</i>\n' +
                '                <input id="btw" name="btw" type="text" class="validate" pattern="[0-9a-zA-Z]{14}" value="' + (data.data.btw ?? '') + '">\n' +
                '                <label for="btw" class="active">BTW</label>\n' +
                '                <span class="helper-text" data-error="Wrong (must be exactly 14 characters)" data-success="Right"></span>\n' +
                '            </div>\n' +
                '        </div>\n' +
                '        <div class="row">\n' +
                '            <div class="input-field col s12">\n' +
                '                <i class="material-icons prefix">aedes</i>\n' +
                '                <input id="lnumber" name="lnumber" type="text" class="validate" pattern="L[0-9]{4}" value="' + (data.data.lnumber ?? '') + '">\n' +
                '                <label for="lnumber" class="active">L number</label>\n' +
                '                <span class="helper-text" data-error="Wrong (must be a L with 4 numbers)" data-success="Right"></span>\n' +
                '            </div>\n' +
                '        </div>\n' +
                '        <div class="row">\n' +
                '            <div class="input-field col s12">\n' +
                '                <i class="material-icons prefix">http</i>\n' +
                '                <input id="website" name="website" type="text" class="validate" pattern="https://.*" maxlength="256" value="' + (data.data.website ?? '') + '">\n' +
                '                <label for="website" class="active">Website</label>\n' +
                '                <span class="helper-text" data-error="Wrong (must be a valid URL)" data-success="Right"></span>\n' +
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

function loadHousingstocksPage(page = 1, searchterm = '') {
    $.ajax({
        url: '/api/v1/housingstocks',
        type: 'GET',
        data: {
            page: page,
            searchterm: searchterm
        },
        dataType: 'json',
        accepts: {
            json: 'application/json'
        },
        beforeSend: function() {
            showLoader();
            $('.material-tooltip').remove();
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
                '        <div class="input-field col s6">\n' +
                '            <input id="searchterm" type="search" value="' + searchterm + '">\n' +
                '            <label for="searchterm" class="' + ( Boolean(searchterm) ? 'active' : '' ) + '">Search</label>\n' +
                '        </div>\n' +
                '        <div class="input-field col s3">\n' +
                '            <button class="btn" onclick="loadHousingstocksPage(1, $(\'input#searchterm\').val());">\n' +
                '                <i class="material-icons">search</i><span class="button-content hide-on-small-only">Search</span>\n' +
                '            </button>\n' +
                '        </div>\n' +
                '        <div class="input-field col s3">\n' +
                '            <button class="btn right" onclick="loadHousingstockNewPage();">\n' +
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

            html += addPagination(data.pager, searchterm, 'loadHousingstocksPage');

            $('div#content').html(html);
        },
        error: function(jqXHR) {
            loadErrorPage(jqXHR);
        },
        complete: function() {
            $('.tooltipped').tooltip({'enterDelay': 1000, 'outDuration': 0});
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
                '                <select name="owner">\n' +
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
                '            <div class="col s6">\n' +
                '                <button class="btn" name="create" type="submit">\n' +
                '                    <i class="material-icons left">domain_add</i>Create\n' +
                '                </button>\n' +
                '            </div>\n' +
                '            <div class="col s6">\n' +
                '                <button class="btn right" name="cancel">\n' +
                '                    <i class="material-icons left">cancel</i>Cancel\n' +
                '                </button>\n' +
                '            </div>\n' +
                '        </div>\n' +
                '    </form>\n'
            );

            $('form#newhousingstock select').formSelect();

            $("form#newhousingstock button[name='cancel']").click(
                function(event) {
                    event.preventDefault();
                    loadHousingstocksPage();
                }
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
 * #################################################
 */

/**
 * Municipalities
 */

function loadMunicipalitiesPage(page = 1, searchterm = '') {
    $.ajax({
        url: '/api/v1/municipalities',
        type: 'GET',
        data: {
            page: page,
            searchterm: searchterm
        },
        dataType: 'json',
        accepts: {
            json: 'application/json'
        },
        beforeSend: function() {
            showLoader();
            $('.material-tooltip').remove();
            $('#slide-out').sidenav('close');
        },
        success: function(data) {
            let rows = '';
            $(data.data).each(function (index, element) {
                rows +=
                    '            <tr>\n' +
                    '                <td class="hide-on-small-only"><i class="material-icons prefix">municipality</i></td>\n' +
                    '                <td>' + (element.code ?? '') + '</td>\n' +
                    '                <td>' + (element.name ?? '') + '</td>\n' +
                    '            </tr>\n';
            });

            let html =
                '    <h3 class="header">Municipalities</h3>\n' +
                '    <div class="row">\n' +
                '        <div class="input-field col s9">\n' +
                '            <input id="searchterm" type="search" value="' + searchterm + '">\n' +
                '            <label for="searchterm" class="' + ( Boolean(searchterm) ? 'active' : '' ) + '">Search</label>\n' +
                '        </div>\n' +
                '        <div class="input-field col s3">\n' +
                '            <button class="btn" onclick="loadMunicipalitiesPage(1, $(\'input#searchterm\').val());">\n' +
                '                <i class="material-icons">search</i><span class="button-content hide-on-small-only">Search</span>\n' +
                '            </button>\n' +
                '        </div>\n' +
                '    </div>\n' +
                '    <table>\n' +
                '        <thead>\n' +
                '            <tr>\n' +
                '                <th class="hide-on-small-only"></th>\n' +
                '                <th>Code</th>\n' +
                '                <th>Name</th>\n' +
                '            </tr>\n' +
                '        </thead>\n' +
                '        <tbody>\n' +
                rows +
                '        </tbody>\n' +
                '    </table>\n';

            html += addPagination(data.pager, searchterm, 'loadMunicipalitiesPage');

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

/**
 * Cities
 */

function loadCitiesPage(page = 1, searchterm = '') {
    if(localStorage.getItem('activeHousingstockId')) {
        $.ajax({
            url: '/api/v1/housingstocks/' + localStorage.getItem('activeHousingstockId') + '/cities',
            type: 'GET',
            data: {
                page: page,
                searchterm: searchterm
            },
            dataType: 'json',
            accepts: {
                json: 'application/json'
            },
            beforeSend: function() {
                showLoader();
                $('.material-tooltip').remove();
                $('#slide-out').sidenav('close');
            },
            success: function(data) {
                let rows = '';
                $(data.data).each(function (index, element) {
                    rows +=
                        '            <tr>\n' +
                        '                <td class="hide-on-small-only"><i class="material-icons prefix">city</i></td>\n' +
                        '                <td>' + (element.identification ?? '') + '</td>\n' +
                        '                <td>' + (element.name ?? '') + '</td>\n' +
                        '            </tr>\n';
                });

                let html =
                    '    <h3 class="header">Cities</h3>\n' +
                    '    <div class="row">\n' +
                    '        <div class="input-field col s9">\n' +
                    '            <input id="searchterm" type="search" value="' + searchterm + '">\n' +
                    '            <label for="searchterm" class="' + ( Boolean(searchterm) ? 'active' : '' ) + '">Search</label>\n' +
                    '        </div>\n' +
                    '        <div class="input-field col s3">\n' +
                    '            <button class="btn" onclick="loadCitiesPage(1, $(\'input#searchterm\').val());">\n' +
                    '                <i class="material-icons">search</i><span class="button-content hide-on-small-only">Search</span>\n' +
                    '            </button>\n' +
                    '        </div>\n' +
                    '    </div>\n' +
                    '    <table>\n' +
                    '        <thead>\n' +
                    '            <tr>\n' +
                    '                <th class="hide-on-small-only"></th>\n' +
                    '                <th>Bag code</th>\n' +
                    '                <th>Name</th>\n' +
                    '            </tr>\n' +
                    '        </thead>\n' +
                    '        <tbody>\n' +
                    rows +
                    '        </tbody>\n' +
                    '    </table>\n';

                html += addPagination(data.pager, searchterm, 'loadCitiesPage');

                $('div#content').html(html);
            },
            error: function(jqXHR) {
                loadErrorPage(jqXHR);
            },
            complete: function() {
                hideLoader();
            },
        });
    } else {
        loadInformationPage('You need to first choose an active housingstock');
    }
}

/**
 * ResidentialAreas
 */

function loadResidentialAreasPage(page = 1, searchterm = '') {
    $.ajax({
        url: '/api/v1/residentialareas',
        type: 'GET',
        data: {
            page: page,
            searchterm: searchterm
        },
        dataType: 'json',
        accepts: {
            json: 'application/json'
        },
        beforeSend: function() {
            showLoader();
            $('.material-tooltip').remove();
            $('#slide-out').sidenav('close');
        },
        success: function(data) {
            let rows = '';
            $(data.data).each(function (index, element) {
                rows +=
                    '            <tr>\n' +
                    '                <td class="hide-on-small-only"><i class="material-icons prefix">residentialarea</i></td>\n' +
                    '                <td>' + (element.code ?? '') + '</td>\n' +
                    '                <td>' + (element.name ?? '') + '</td>\n' +
                    '                <td>' + (element.municipality.name ?? '') + '</td>\n' +
                    '            </tr>\n';
            });

            let html =
                '    <h3 class="header">Residential areas</h3>\n' +
                '    <div class="row">\n' +
                '        <div class="input-field col s9">\n' +
                '            <input id="searchterm" type="search" value="' + searchterm + '">\n' +
                '            <label for="searchterm" class="' + ( Boolean(searchterm) ? 'active' : '' ) + '">Search</label>\n' +
                '        </div>\n' +
                '        <div class="input-field col s3">\n' +
                '            <button class="btn" onclick="loadResidentialAreasPage(1, $(\'input#searchterm\').val());">\n' +
                '                <i class="material-icons">search</i><span class="button-content hide-on-small-only">Search</span>\n' +
                '            </button>\n' +
                '        </div>\n' +
                '    </div>\n' +
                '    <table>\n' +
                '        <thead>\n' +
                '            <tr>\n' +
                '                <th class="hide-on-small-only"></th>\n' +
                '                <th>Code</th>\n' +
                '                <th>Name</th>\n' +
                '                <th>Municipality</th>\n' +
                '            </tr>\n' +
                '        </thead>\n' +
                '        <tbody>\n' +
                rows +
                '        </tbody>\n' +
                '    </table>\n';

            html += addPagination(data.pager, searchterm, 'loadResidentialAreasPage');

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

/**
 * Neighbourhoods
 */

function loadNeighbourhoodsPage(page = 1, searchterm = '') {
    $.ajax({
        url: '/api/v1/neighbourhoods',
        type: 'GET',
        data: {
            page: page,
            searchterm: searchterm
        },
        dataType: 'json',
        accepts: {
            json: 'application/json'
        },
        beforeSend: function() {
            showLoader();
            $('.material-tooltip').remove();
            $('#slide-out').sidenav('close');
        },
        success: function(data) {
            let rows = '';
            $(data.data).each(function (index, element) {
                rows +=
                    '            <tr>\n' +
                    '                <td class="hide-on-small-only"><i class="material-icons prefix">neighbourhood</i></td>\n' +
                    '                <td>' + (element.code ?? '') + '</td>\n' +
                    '                <td>' + (element.name ?? '') + '</td>\n' +
                    '                <td>' + (element.residentialArea.name ?? '') + '</td>\n' +
                    '                <td>' + (element.municipality.name ?? '') + '</td>\n' +
                    '            </tr>\n';
            });

            let html =
                '    <h3 class="header">Neighbourhoods</h3>\n' +
                '    <div class="row">\n' +
                '        <div class="input-field col s9">\n' +
                '            <input id="searchterm" type="search" value="' + searchterm + '">\n' +
                '            <label for="searchterm" class="' + ( Boolean(searchterm) ? 'active' : '' ) + '">Search</label>\n' +
                '        </div>\n' +
                '        <div class="input-field col s3">\n' +
                '            <button class="btn" onclick="loadNeighbourhoodsPage(1, $(\'input#searchterm\').val());">\n' +
                '                <i class="material-icons">search</i><span class="button-content hide-on-small-only">Search</span>\n' +
                '            </button>\n' +
                '        </div>\n' +
                '    </div>\n' +
                '    <table>\n' +
                '        <thead>\n' +
                '            <tr>\n' +
                '                <th class="hide-on-small-only"></th>\n' +
                '                <th>Code</th>\n' +
                '                <th>Name</th>\n' +
                '                <th>Residential Area</th>\n' +
                '                <th>Municipality</th>\n' +
                '            </tr>\n' +
                '        </thead>\n' +
                '        <tbody>\n' +
                rows +
                '        </tbody>\n' +
                '    </table>\n';

            html += addPagination(data.pager, searchterm, 'loadNeighbourhoodsPage');

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

/**
 * Vtws
 */

function loadVtws(page = 1, searchterm = '') {
    $.ajax({
        url: '/api/v1/vtws',
        type: 'GET',
        data: {
            page: page,
            searchterm: searchterm
        },
        dataType: 'json',
        accepts: {
            json: 'application/json'
        },
        beforeSend: function() {
            showLoader();
            $('.material-tooltip').remove();
            $('#slide-out').sidenav('close');
        },
        success: function(data) {
            let rows = '';
            $(data.data).each(function (index, element) {
                rows +=
                    '            <tr>\n' +
                    '                <td class="hide-on-small-only"><i class="material-icons prefix">villa</i></td>\n' +
                    '                <td>' + (element.code ?? '') + '</td>\n' +
                    '                <td>' + (element.typeDescription ?? '') + '</td>\n' +
                    '                <td class="hide-on-small-only" style="white-space: nowrap;">' + (element.constructionYearDescription ?? '') + '</td>\n' +
                    '                <td class="hide-on-small-only" style="white-space: nowrap;">' + (element.roofTypeDescription ?? '') + '</td>\n' +
                    '            </tr>\n';
            });

            let html =
                '    <h3 class="header">VTWs</h3>\n' +
                '    <div class="row">\n' +
                '        <div class="input-field col s9">\n' +
                '            <input id="searchterm" type="search" value="' + searchterm + '">\n' +
                '            <label for="searchterm" class="' + ( Boolean(searchterm) ? 'active' : '' ) + '">Search</label>\n' +
                '        </div>\n' +
                '        <div class="input-field col s3">\n' +
                '            <button class="btn" onclick="loadVtws(1, $(\'input#searchterm\').val());">\n' +
                '                <i class="material-icons">search</i><span class="button-content hide-on-small-only">Search</span>\n' +
                '            </button>\n' +
                '        </div>\n' +
                '    </div>\n' +
                '    <table>\n' +
                '        <thead>\n' +
                '            <tr>\n' +
                '                <th class="hide-on-small-only"></th>\n' +
                '                <th>Code</th>\n' +
                '                <th>Description</th>\n' +
                '                <th class="hide-on-small-only">Year</th>\n' +
                '                <th class="hide-on-small-only">Roof</th>\n' +
                '            </tr>\n' +
                '        </thead>\n' +
                '        <tbody>\n' +
                rows +
                '        </tbody>\n' +
                '    </table>\n';

            html += addPagination(data.pager, searchterm, 'loadVtws');

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

/**
 * #################################################
 */

/**
 * Public spaces
 */

function loadPublicSpacesPage(page = 1, searchterm = '') {
    if(localStorage.getItem('activeHousingstockId')) {
        $.ajax({
            url: '/api/v1/housingstocks/' + localStorage.getItem('activeHousingstockId') + '/publicspaces',
            type: 'GET',
            data: {
                page: page,
                searchterm: searchterm
            },
            dataType: 'json',
            accepts: {
                json: 'application/json'
            },
            beforeSend: function() {
                showLoader();
                $('.material-tooltip').remove();
                $('#slide-out').sidenav('close');
            },
            success: function(data) {
                let rows = '';
                $(data.data).each(function (index, element) {
                    rows +=
                        '            <tr>\n' +
                        '                <td class="hide-on-small-only"><i class="material-icons prefix">road</i></td>\n' +
                        '                <td>' + (element.identification ?? '') + '</td>\n' +
                        '                <td>' + (element.name ?? '') + '</td>\n' +
                        '                <td>' + (element.type ?? '') + '</td>\n' +
                        '            </tr>\n';
                });

                let html =
                    '    <h3 class="header">Public spaces</h3>\n' +
                    '    <div class="row">\n' +
                    '        <div class="input-field col s9">\n' +
                    '            <input id="searchterm" type="search" value="' + searchterm + '">\n' +
                    '            <label for="searchterm" class="' + ( Boolean(searchterm) ? 'active' : '' ) + '">Search</label>\n' +
                    '        </div>\n' +
                    '        <div class="input-field col s3">\n' +
                    '            <button class="btn" onclick="loadPublicSpacesPage(1, $(\'input#searchterm\').val());">\n' +
                    '                <i class="material-icons">search</i><span class="button-content hide-on-small-only">Search</span>\n' +
                    '            </button>\n' +
                    '        </div>\n' +
                    '    </div>\n' +
                    '    <table>\n' +
                    '        <thead>\n' +
                    '            <tr>\n' +
                    '                <th class="hide-on-small-only"></th>\n' +
                    '                <th>Bag code</th>\n' +
                    '                <th>Name</th>\n' +
                    '                <th>Type</th>\n' +
                    '            </tr>\n' +
                    '        </thead>\n' +
                    '        <tbody>\n' +
                    rows +
                    '        </tbody>\n' +
                    '    </table>\n';

                html += addPagination(data.pager, searchterm, 'loadPublicSpacesPage');

                $('div#content').html(html);
            },
            error: function(jqXHR) {
                loadErrorPage(jqXHR);
            },
            complete: function() {
                hideLoader();
            },
        });
    } else {
        loadInformationPage('You need to first choose an active housingstock');
    }
}

/**
 * Buildings
 */

function loadBuildingsPage(page = 1, searchterm = '') {
    if(localStorage.getItem('activeHousingstockId')) {
        $.ajax({
            url: '/api/v1/housingstocks/' + localStorage.getItem('activeHousingstockId') + '/buildings',
            type: 'GET',
            data: {
                page: page,
                searchterm: searchterm
            },
            dataType: 'json',
            accepts: {
                json: 'application/json'
            },
            beforeSend: function() {
                showLoader();
                $('.material-tooltip').remove();
                $('#slide-out').sidenav('close');
            },
            success: function(data) {
                let rows = '';
                $(data.data).each(function (index, element) {
                    rows +=
                        '            <tr>\n' +
                        '                <td class="hide-on-small-only"><i class="material-icons prefix">home_filled</i></td>\n' +
                        '                <td>' + (element.identification ?? '') + '</td>\n' +
                        '                <td>' + (element.constructionYear ?? '') + '</td>\n' +
                        '                <td>' + (element.residenceCount ?? '') + '</td>\n' +
                        '                <td>' + (element.surfaceArea ?? '') + '</td>\n' +
                        '            </tr>\n';
                });

                let html =
                    '    <h3 class="header">Buildings</h3>\n' +
                    '    <div class="row">\n' +
                    '        <div class="input-field col s9">\n' +
                    '            <input id="searchterm" type="search" value="' + searchterm + '">\n' +
                    '            <label for="searchterm" class="' + ( Boolean(searchterm) ? 'active' : '' ) + '">Search</label>\n' +
                    '        </div>\n' +
                    '        <div class="input-field col s3">\n' +
                    '            <button class="btn" onclick="loadBuildingsPage(1, $(\'input#searchterm\').val());">\n' +
                    '                <i class="material-icons">search</i><span class="button-content hide-on-small-only">Search</span>\n' +
                    '            </button>\n' +
                    '        </div>\n' +
                    '    </div>\n' +
                    '    <table>\n' +
                    '        <thead>\n' +
                    '            <tr>\n' +
                    '                <th class="hide-on-small-only"></th>\n' +
                    '                <th>Bag code</th>\n' +
                    '                <th>Year</th>\n' +
                    '                <th>Residences</th>\n' +
                    '                <th>Surface</th>\n' +
                    '            </tr>\n' +
                    '        </thead>\n' +
                    '        <tbody>\n' +
                    rows +
                    '        </tbody>\n' +
                    '    </table>\n';

                html += addPagination(data.pager, searchterm, 'loadBuildingsPage');

                $('div#content').html(html);
            },
            error: function(jqXHR) {
                loadErrorPage(jqXHR);
            },
            complete: function() {
                hideLoader();
            },
        });
    } else {
        loadInformationPage('You need to first choose an active housingstock');
    }
}

/**
 * Buildings
 */

function loadResidencesPage(page = 1, searchterm = '') {
    if(localStorage.getItem('activeHousingstockId')) {
        $.ajax({
            url: '/api/v1/housingstocks/' + localStorage.getItem('activeHousingstockId') + '/residences',
            type: 'GET',
            data: {
                page: page,
                searchterm: searchterm
            },
            dataType: 'json',
            accepts: {
                json: 'application/json'
            },
            beforeSend: function() {
                showLoader();
                $('.material-tooltip').remove();
                $('#slide-out').sidenav('close');
            },
            success: function(data) {
                let rows = '';
                $(data.data).each(function (index, element) {
                    rows +=
                        '            <tr>\n' +
                        '                <td class="hide-on-small-only"><i class="material-icons prefix">cottage</i></td>\n' +
                        '                <td>' + (element.identification ?? '') + '</td>\n' +
                        '                <td>' + (element.intendedUse ?? '') + '</td>\n' +
                        '                <td>' + (element.status ?? '') + '</td>\n' +
                        '                <td>' + (element.surfaceArea ?? '') + '</td>\n' +
                        '            </tr>\n';
                });

                let html =
                    '    <h3 class="header">Residences</h3>\n' +
                    '    <div class="row">\n' +
                    '        <div class="input-field col s9">\n' +
                    '            <input id="searchterm" type="search" value="' + searchterm + '">\n' +
                    '            <label for="searchterm" class="' + ( Boolean(searchterm) ? 'active' : '' ) + '">Search</label>\n' +
                    '        </div>\n' +
                    '        <div class="input-field col s3">\n' +
                    '            <button class="btn" onclick="loadResidencesPage(1, $(\'input#searchterm\').val());">\n' +
                    '                <i class="material-icons">search</i><span class="button-content hide-on-small-only">Search</span>\n' +
                    '            </button>\n' +
                    '        </div>\n' +
                    '    </div>\n' +
                    '    <table>\n' +
                    '        <thead>\n' +
                    '            <tr>\n' +
                    '                <th class="hide-on-small-only"></th>\n' +
                    '                <th>Bag code</th>\n' +
                    '                <th>Use</th>\n' +
                    '                <th>Status</th>\n' +
                    '                <th>Surface</th>\n' +
                    '            </tr>\n' +
                    '        </thead>\n' +
                    '        <tbody>\n' +
                    rows +
                    '        </tbody>\n' +
                    '    </table>\n';

                html += addPagination(data.pager, searchterm, 'loadResidencesPage');

                $('div#content').html(html);
            },
            error: function(jqXHR) {
                loadErrorPage(jqXHR);
            },
            complete: function() {
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

function loadBlocksPage(page = 1, searchterm = '') {
    if(localStorage.getItem('activeHousingstockId')) {
        $.ajax({
            url: '/api/v1/housingstocks/' + localStorage.getItem('activeHousingstockId') + '/blocks',
            type: 'GET',
            data: {
                page: page,
                searchterm: searchterm
            },
            dataType: 'json',
            accepts: {
                json: 'application/json'
            },
            beforeSend: function() {
                showLoader();
                $('.material-tooltip').remove();
                $('#slide-out').sidenav('close');
            },
            success: function(data) {
                let rows = '';
                $(data.data).each(function (index, element) {
                    rows +=
                        '            <tr class="tooltipped" data-position="bottom" data-tooltip="' + (element.description ?? '') + '">\n' +
                        '                <td class="hide-on-small-only"><i class="material-icons prefix">view_comfortable</i></td>\n' +
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
                    '        <div class="input-field col s6">\n' +
                    '            <input id="searchterm" type="search" value="' + searchterm + '">\n' +
                    '            <label for="searchterm" class="' + ( Boolean(searchterm) ? 'active' : '' ) + '">Search</label>\n' +
                    '        </div>\n' +
                    '        <div class="input-field col s3">\n' +
                    '            <button class="btn" onclick="loadBlocksPage(1, $(\'input#searchterm\').val());">\n' +
                    '                <i class="material-icons">search</i><span class="button-content hide-on-small-only">Search</span>\n' +
                    '            </button>\n' +
                    '        </div>\n' +
                    '        <div class="input-field col s3">\n' +
                    '            <button class="btn right" onclick="loadBlockNewPage();">\n' +
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

                html += addPagination(data.pager, searchterm, 'loadBlocksPage');

                $('div#content').html(html);
            },
            error: function(jqXHR) {
                loadErrorPage(jqXHR);
            },
            complete: function() {
                $('.tooltipped').tooltip({'enterDelay': 1000, 'outDuration': 0}); // @ToDo Only show if not empty
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
            '            <div class="col s6">\n' +
            '                <button class="btn" name="create" type="submit">\n' +
            '                    <i class="material-icons left">add_view_quilt</i>Create\n' +
            '                </button>\n' +
            '            </div>\n' +
            '            <div class="col s6">\n' +
            '                <button class="btn right" name="cancel">\n' +
            '                    <i class="material-icons left">cancel</i>Cancel\n' +
            '                </button>\n' +
            '            </div>\n' +
            '        </div>\n' +
            '    </form>\n'
        );

        $("form#newblock button[name='cancel']").click(
            function(event) {
                event.preventDefault();
                loadBlocksPage();
            }
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

function loadBuildingtypesPage(page = 1, searchterm = '') {
    if(localStorage.getItem('activeHousingstockId')) {
        $.ajax({
            url: '/api/v1/housingstocks/' + localStorage.getItem('activeHousingstockId') + '/buildingtypes',
            type: 'GET',
            data: {
                page: page,
                searchterm: searchterm
            },
            dataType: 'json',
            accepts: {
                json: 'application/json'
            },
            beforeSend: function() {
                showLoader();
                $('.material-tooltip').remove();
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
                    '        <div class="input-field col s6">\n' +
                    '            <input id="searchterm" type="search" value="' + searchterm + '">\n' +
                    '            <label for="searchterm" class="' + ( Boolean(searchterm) ? 'active' : '' ) + '">Search</label>\n' +
                    '        </div>\n' +
                    '        <div class="input-field col s3">\n' +
                    '            <button class="btn" onclick="loadBuildingtypesPage(1, $(\'input#searchterm\').val());">\n' +
                    '                <i class="material-icons">search</i><span class="button-content hide-on-small-only">Search</span>\n' +
                    '            </button>\n' +
                    '        </div>\n' +
                    '        <div class="input-field col s3">\n' +
                    '            <button class="btn right" onclick="loadBuildingtypeNewPage();">\n' +
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

                html += addPagination(data.pager, searchterm, 'loadBuildingtypesPage');

                $('div#content').html(html);
            },
            error: function(jqXHR) {
                loadErrorPage(jqXHR);
            },
            complete: function() {
                $('.tooltipped').tooltip({'enterDelay': 1000, 'outDuration': 0});
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
            '            <div class="col s6">\n' +
            '                <button class="btn" name="create" type="submit">\n' +
            '                    <i class="material-icons left">add_home_work</i>Create\n' +
            '                </button>\n' +
            '            </div>\n' +
            '            <div class="col s6">\n' +
            '                <button class="btn right" name="cancel">\n' +
            '                    <i class="material-icons left">cancel</i>Cancel\n' +
            '                </button>\n' +
            '            </div>\n' +
            '        </div>\n' +
            '    </form>\n'
        );

        $("form#newbuildingtype button[name='cancel']").click(
            function(event) {
                event.preventDefault();
                loadBuildingtypesPage();
            }
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
 * Addresses
 */

function loadAddressesPage(page = 1, searchterm = '') {
    if(localStorage.getItem('activeHousingstockId')) {
        $.ajax({
            url: '/api/v1/housingstocks/' + localStorage.getItem('activeHousingstockId') + '/addresses',
            type: 'GET',
            data: {
                page: page,
                searchterm: searchterm
            },
            dataType: 'json',
            accepts: {
                json: 'application/json'
            },
            beforeSend: function() {
                showLoader();
                $('.material-tooltip').remove();
                $('#slide-out').sidenav('close');
            },
            success: function(data) {
                let rows = '';
                $(data.data).each(function (index, element) {
                    rows +=
                        '            <tr class="tooltipped" data-position="bottom" data-tooltip="' + element.id + ' - ' + (element.rentalUnitNumber ?? '') + '<br />' + element.publicSpace.name + ' ' + element.houseNumber + (element.addition ? ' ' + element.addition : '') + '<br />' + element.zipcode + ' ' + element.city.name + '">\n' +
                        '                <td class="hide-on-small-only">\n' +
                        '                    <a href="javascript:void(0);" onclick="loadAddressDetailPage(' + element.id + ');">\n' +
                        '                        <i class="material-icons prefix">home</i>\n' +
                        '                    </a>\n' +
                        '                </td>\n' +
                        '                <td class="hide-on-small-only">' + (element.rentalUnitNumber ?? '') + '</td>\n' +
                        '                <td class="hide-on-small-only">' + (element.publicSpace.name ?? '') + '</td>\n' +
                        '                <td class="hide-on-small-only">' + (element.houseNumber ?? '') + '</td>\n' +
                        '                <td class="hide-on-small-only">' + (element.addition ?? '') + '</td>\n' +
                        '                <td class="hide-on-small-only">' + (element.zipcode ?? '') + '</td>\n' +
                        '                <td class="hide-on-small-only">' + (element.city.name ?? '') + '</td>\n' +
                        '                <td class="hide-on-med-and-up">' +
                        '                    <a href="javascript:void(0);" onclick="loadAddressDetailPage(' + element.id + ');">\n' +
                        '                        <i class="material-icons small prefix" style="vertical-align:middle;">home</i>\n' +
                        '                    </a>\n' +
                        '                    ' + element.id + ' - ' + element.rentalUnitNumber + '<br />\n' +
                        '                    ' + element.publicSpace.name + ' ' + element.houseNumber + (element.addition ? ' ' + element.addition : '') + '<br />\n' +
                        '                    ' + element.zipcode + ' ' + element.city.name + '\n' +
                        '                </td>\n' +
                        '                <td class="actions">\n' +
                        '                    <button class="btn" name="edit" onclick="loadAddressEditPage(' + element.id + ');">\n' +
                        '                        <i class="material-icons">edit</i><span class="button-content hide-on-small-only">Edit</span>\n' +
                        '                    </button>\n' +
                        '                    <button class="btn" name="delete" onclick="showDeleteModal(' + element.id + ' , \'' + element.rentalUnitNumber + '\', \'deleteAddress\');">\n' +
                        '                        <i class="material-icons">delete</i><span class="button-content hide-on-small-only">Delete</span>\n' +
                        '                    </button>\n' +
                        '                </td>\n' +
                        '            </tr>\n';
                });

                let html =
                    '    <h3 class="header">Addresses</h3>\n' +
                    '    <div class="row">\n' +
                    '        <div class="input-field col s6">\n' +
                    '            <input id="searchterm" type="search" value="' + searchterm + '">\n' +
                    '            <label for="searchterm" class="' + ( Boolean(searchterm) ? 'active' : '' ) + '">Search</label>\n' +
                    '        </div>\n' +
                    '        <div class="input-field col s3">\n' +
                    '            <button class="btn" onclick="loadAddressesPage(1, $(\'input#searchterm\').val());">\n' +
                    '                <i class="material-icons">search</i><span class="button-content hide-on-small-only">Search</span>\n' +
                    '            </button>\n' +
                    '        </div>\n' +
                    '        <div class="input-field col s3">\n' +
                    '            <button class="btn right" onclick="loadAddressNewPage();">\n' +
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
                    '                <th class="hide-on-small-only">Zipcode</th>\n' +
                    '                <th class="hide-on-small-only">City</th>\n' +
                    '                <th class="hide-on-med-and-up">Address</th>\n' +
                    '                <th class="actions">Actions</th>\n' +
                    '            </tr>\n' +
                    '        </thead>\n' +
                    '        <tbody>\n' +
                    rows +
                    '        </tbody>\n' +
                    '    </table>\n';

                html += addPagination(data.pager, searchterm, 'loadAddressesPage');

                $('div#content').html(html);
            },
            error: function(jqXHR) {
                loadErrorPage(jqXHR);
            },
            complete: function() {
                $('.tooltipped').tooltip({'enterDelay': 1000, 'outDuration': 0});
                hideLoader();
            },
        });
    } else {
        loadInformationPage('You need to first choose an active housingstock');
    }
}

function loadAddressNewPage() {
    if(localStorage.getItem('activeHousingstockId')) {
        showLoader();
        $('#slide-out').sidenav('close');

        $.when(
            $.getJSON('/api/v1/housingstocks/' + localStorage.getItem('activeHousingstockId') + '/blocks'),
            $.getJSON('/api/v1/housingstocks/' + localStorage.getItem('activeHousingstockId') + '/buildingtypes'),
            $.getJSON('/api/v1/vtws')
        ).then(
            function (
                blocks,
                buildingtypes,
                vtws
            ) {
                let blockHtmlOptions = '                    <option disabled selected>Choose a block</option>\n';
                blocks[0].data.forEach(function(item) {
                    blockHtmlOptions += '                    <option value="' + item.id + '">' + item.name + '</option>\n';
                });

                let buildingTypeHtmlOptions = '                    <option disabled selected>Choose a building type</option>\n';
                buildingtypes[0].data.forEach(function(item) {
                    buildingTypeHtmlOptions += '                    <option value="' + item.id + '">' + item.name + '</option>\n';
                });

                let vtwHtmlOptions = '                    <option disabled selected>Choose a vtw</option>\n';
                vtws[0].data.forEach(function(item) {
                    vtwHtmlOptions += '                    <option value="' + item.id + '">' + item.code + ' - ' + item.typeDescription + '</option>\n';
                });

                $('div#content').html(
                    '    <h3 class="header">New address</h3>\n' +
                    '    <form id="newbuildingaddress">\n' +
                    '        <div class="row">\n' +
                    '            <div class="col s12">\n' +
                    '                <p>By filling in the zipcode, housenumber and addition the rest of the information about this new address will be fetched by appropiate external services.</p>' +
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
                    '                <i class="material-icons prefix">view_comfortable</i>\n' +
                    '                <select id="block" name="block">\n' +
                    blockHtmlOptions +
                    '                </select>\n' +
                    '                <label>Block</label>\n' +
                    '            </div>\n' +
                    '        </div>\n' +
                    '        <div class="row">\n' +
                    '            <div class="input-field col s12">\n' +
                    '                <i class="material-icons prefix">home_work</i>\n' +
                    '                <select id="buildingtype" name="buildingtype">\n' +
                    buildingTypeHtmlOptions +
                    '                </select>\n' +
                    '                <label>Building type</label>\n' +
                    '            </div>\n' +
                    '        </div>\n' +
                    '        <div class="row">\n' +
                    '            <div class="input-field col s12">\n' +
                    '                <i class="material-icons prefix">vtw</i>\n' +
                    '                <select id="vtw" name="vtw">\n' +
                    vtwHtmlOptions +
                    '                </select>\n' +
                    '                <label>Vtw</label>\n' +
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
                    '                <i class="material-icons prefix">explore</i>\n' +
                    '                <select id="orientation" name="orientation">\n' +
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
                    '                        <input id="daeb" name="daeb" type="checkbox">\n' +
                    '                        <span>Daeb</span>\n' +
                    '                    </label>\n' +
                    '                </p>\n' +
                    '            </div>\n' +
                    '        </div>\n' +
                    '        <div class="row">\n' +
                    '            <div class="col s6">\n' +
                    '                <button class="btn" name="create" type="submit">\n' +
                    '                    <i class="material-icons left">house_add</i>Create\n' +
                    '                </button>\n' +
                    '            </div>\n' +
                    '            <div class="col s6">\n' +
                    '                <button class="btn right" name="cancel">\n' +
                    '                    <i class="material-icons left">cancel</i>Cancel\n' +
                    '                </button>\n' +
                    '            </div>\n' +
                    '        </div>\n' +
                    '    </form>\n'
                );

                $('form#newbuildingaddress select').formSelect();

                $("form#newbuildingaddress button[name='cancel']").click(
                    function(event) {
                        event.preventDefault();
                        loadAddressesPage();
                    }
                );

                $('form#newbuildingaddress').submit(function (event) {
                    event.preventDefault();
                    $.ajax({
                        url: '/api/v1/housingstocks/' + localStorage.getItem('activeHousingstockId') + '/addresses',
                        type: 'POST',
                        dataType: 'json',
                        contentType: 'application/json; charset=UTF-8',
                        accepts: {
                            json: 'application/json'
                        },
                        data: JSON.stringify(
                            {
                                'zipcode': $('input#zipcode').val(),
                                'housenumber': parseInt($('input#housenumber').val()),
                                'addition': $('input#addition').val(),
                                'block': parseInt($('select#block').val()),
                                'buildingtype': parseInt($('select#buildingtype').val()),
                                'vtw': parseInt($('select#vtw').val()),
                                'rentalunitnumber': $('input#rentalunitnumber').val(),
                                'orientation': $('select#orientation').val(),
                                'daeb': $('input#daeb').prop("checked")
                            }
                        ),
                        beforeSend: function () {
                            showLoader();
                            $('#slide-out').sidenav('close');
                        },
                        success: function () {
                            loadAddressesPage();
                        },
                        error: function (jqXHR) {
                            loadErrorPage(jqXHR);
                        },
                        complete: function () {
                            hideLoader();
                        },
                    });
                });

                hideLoader();
            }
        );
    } else {
        loadInformationPage('You need to first choose an active housingstock');
    }
}

function loadAddressDetailPage(id) {
    if(localStorage.getItem('activeHousingstockId')) {
        let buildingIdentification;
        $.ajax({
            url: '/api/v1/housingstocks/' + localStorage.getItem('activeHousingstockId') + '/addresses/' + id,
            type: 'GET',
            dataType: 'json',
            accepts: {
                json: 'application/json'
            },
            beforeSend: function() {
                showLoader();
                $('.material-tooltip').remove();
                $('#slide-out').sidenav('close');
            },
            success: function(data) {
                let addressdata = data.data[0];
                buildingIdentification = addressdata.building.identification;
                let html = '        <div class="row">\n' +
                    '            <div class="col s12">\n' +
                    '                <div class="card blue-grey darken-1">\n' +
                    '                    <div class="card-content white-text">\n' +
                    '                        <span class="card-title">Address</span>\n' +
                    '                        <p>\n' +
                    '                            ' + addressdata.publicSpace.name + ' ' + addressdata.houseNumber + (addressdata.addition ? ' ' + addressdata.addition : '') + '<br />\n' +
                    '                            ' + addressdata.zipcode + ' ' + addressdata.city.name + '\n' +
                    '                        </p>\n' +
                    '                    </div>\n' +
                    '                </div>\n' +
                    '                <ul class="collapsible popout">\n' +
                    '                    <li>\n' +
                    '                        <div class="collapsible-header"><i class="material-icons">qr_code_2</i>Ids</div>\n' +
                    '                        <div class="collapsible-body">\n' +
                    '                            <span>\n' +
                    '                                <table>\n' +
                    '                                    <thead>\n' +
                    '                                        <tr>\n' +
                    '                                            <th>System</th>\n' +
                    '                                            <th>Id</th>\n' +
                    '                                        </tr>\n' +
                    '                                    </thead>\n' +
                    '                                    <tbody>\n' +
                    '                                        <tr>\n' +
                    '                                            <td style="vertical-align: top;">Building examinator</td>\n' +
                    '                                            <td>\n' +
                    '                                                ' + addressdata.id + '\n' +
                    '                                            </td>\n' +
                    '                                        </tr>\n' +
                    '                                        <tr>\n' +
                    '                                            <td style="vertical-align: top;">Rental unit number</td>\n' +
                    '                                            <td>\n' +
                    '                                                ' + (addressdata.rentalUnitNumber ?? '') + '\n' +
                    '                                            </td>\n' +
                    '                                        </tr>\n' +
                    '                                        <tr>\n' +
                    '                                            <td style="vertical-align: top;">Bag address</td>\n' +
                    '                                            <td>\n' +
                    '                                                ' + (addressdata.identification ?? '') + '\n' +
                    '                                            </td>\n' +
                    '                                        </tr>\n' +
                    '                                        <tr>\n' +
                    '                                            <td style="vertical-align: top;">Bag public space</td>\n' +
                    '                                            <td>\n' +
                    '                                                ' + (addressdata.publicSpace.identification?? '') + '\n' +
                    '                                            </td>\n' +
                    '                                        </tr>\n' +
                    '                                        <tr>\n' +
                    '                                            <td style="vertical-align: top;">Bag building</td>\n' +
                    '                                            <td>\n' +
                    '                                                ' + (addressdata.building.identification?? '') + '\n' +
                    '                                            </td>\n' +
                    '                                        </tr>\n' +
                    '                                        <tr>\n' +
                    '                                            <td style="vertical-align: top;">Bag residence</td>\n' +
                    '                                            <td>\n' +
                    '                                                ' + (addressdata.residence.identification?? '') + '\n' +
                    '                                            </td>\n' +
                    '                                        </tr>\n' +
                    '                                    </tbody>\n' +
                    '                                </table>\n' +
                    '                            </span>\n' +
                    '                        </div>\n' +
                    '                    </li>\n' +
                    '                    <li>\n' +
                    '                        <div class="collapsible-header"><i class="material-icons">location_groundplan</i>Location</div>\n' +
                    '                        <div class="collapsible-body">\n' +
                    '                            <span>\n' +
                    '                                <table>\n' +
                    '                                    <thead>\n' +
                    '                                        <tr>\n' +
                    '                                            <th>Place</th>\n' +
                    '                                            <th>Data</th>\n' +
                    '                                        </tr>\n' +
                    '                                    </thead>\n' +
                    '                                    <tbody>\n' +
                    '                                        <tr>\n' +
                    '                                            <td style="vertical-align: top;">Housingstock</td>\n' +
                    '                                            <td>\n' +
                    '                                                ' + addressdata.housingStock.name + '\n' +
                    '                                            </td>\n' +
                    '                                        </tr>\n' +
                    '                                        <tr>\n' +
                    '                                            <td style="vertical-align: top;">Municipality</td>\n' +
                    '                                            <td>\n' +
                    '                                                ' + addressdata.municipality.name + '\n' +
                    '                                            </td>\n' +
                    '                                        </tr>\n' +
                    '                                        <tr>\n' +
                    '                                            <td style="vertical-align: top;">Residential area</td>\n' +
                    '                                            <td>\n' +
                    '                                                ' + addressdata.residentialArea.name + '\n' +
                    '                                            </td>\n' +
                    '                                        </tr>\n' +
                    '                                        <tr>\n' +
                    '                                            <td style="vertical-align: top;">Neighbourhood</td>\n' +
                    '                                            <td>\n' +
                    '                                                ' + addressdata.neighbourhood.name + '\n' +
                    '                                            </td>\n' +
                    '                                        </tr>\n' +
                    '                                        <tr>\n' +
                    '                                            <td style="vertical-align: top;">City</td>\n' +
                    '                                            <td>\n' +
                    '                                                ' + addressdata.city.name + '\n' +
                    '                                            </td>\n' +
                    '                                        </tr>\n' +
                    '                                        <tr>\n' +
                    '                                            <td style="vertical-align: top;">Public space</td>\n' +
                    '                                            <td>\n' +
                    '                                                ' + addressdata.publicSpace.name + '\n' +
                    '                                            </td>\n' +
                    '                                        </tr>\n' +
                    '                                        <tr>\n' +
                    '                                            <td style="vertical-align: top;">Block</td>\n' +
                    '                                            <td>\n' +
                    '                                                ' + addressdata.block.name + '\n' +
                    '                                            </td>\n' +
                    '                                        </tr>\n' +
                    '                                    </tbody>\n' +
                    '                                </table>\n' +
                    '                                <br />\n' +
                    '                                <br />\n' +
                    '                                <div id="viewDiv"></div>\n' +
                    '                            </span>\n' +
                    '                        </div>\n' +
                    '                    </li>\n' +
                    '                    <li>\n' +
                    '                        <div class="collapsible-header"><i class="material-icons">category</i>Type</div>\n' +
                    '                        <div class="collapsible-body">\n' +
                    '                            <span>\n' +
                    '                                <table>\n' +
                    '                                    <thead>\n' +
                    '                                        <tr>\n' +
                    '                                            <th>Type</th>\n' +
                    '                                            <th>Data</th>\n' +
                    '                                        </tr>\n' +
                    '                                    </thead>\n' +
                    '                                    <tbody>\n' +
                    '                                        <tr>\n' +
                    '                                            <td style="vertical-align: top;">Building type</td>\n' +
                    '                                            <td>\n' +
                    '                                                ' + addressdata.buildingType.name + '\n' +
                    '                                            </td>\n' +
                    '                                        </tr>\n' +
                    '                                        <tr>\n' +
                    '                                            <td style="vertical-align: top;">Vtw</td>\n' +
                    '                                            <td>\n' +
                    '                                                ' + addressdata.vtw.code + '<br />\n' +
                    '                                                ' + addressdata.vtw.typeDescription + '<br />\n' +
                    '                                                ' + addressdata.vtw.roofTypeDescription + '\n' +
                    '                                            </td>\n' +
                    '                                        </tr>\n' +
                    '                                    </tbody>\n' +
                    '                                </table>\n' +
                    '                            </span>\n' +
                    '                        </div>\n' +
                    '                    </li>\n' +
                    '                    <li>\n' +
                    '                        <div class="collapsible-header"><i class="material-icons">access_time</i>Timeline</div>\n' +
                    '                        <div class="collapsible-body">\n' +
                    '                            <span>\n' +
                    '                                <div id="timeline" class="timeline-container">\n' +
                    '                                    <div class="timeline-wrapper">\n' +
                    '                                        <h2 class="timeline-time">1976</h2>\n' +
                    '                                        <dl class="timeline-series">\n' +
                    '                                            <dt class="timeline-event" id="event01"><a>Event</a></dt>\n' +
                    '                                            <dd class="timeline-event-content" id="event01EX">\n' +
                    '                                                <p>Content about the event goes here.</p>\n' +
                    '                                            </dd>\n' +
                    '                                            <dt class="timeline-event" id="event02"><a>Another Event</a></dt>\n' +
                    '                                            <dd class="timeline-event-content" id="event02EX">\n' +
                    '                                                <p>Content about the other event.</p>\n' +
                    '                                            </dd>\n' +
                    '                                        </dl>\n' +
                    '                                    </div>\n' +
                    '                                    <div class="timeline-wrapper">\n' +
                    '                                        <h2 class="timeline-time">1984</h2>\n' +
                    '                                       <dl class="timeline-series">\n' +
                    '                                           <dt class="timeline-event" id="event03"><a>Yet Another Event</a></dt>\n' +
                    '                                           <dd class="timeline-event-content" id="event03EX">\n' +
                    '                                               <p>Content about the event goes here.</p>\n' +
                    '                                           </dd>\n' +
                    '                                       </dl>\n' +
                    '                                    </div>\n' +
                    '                                    <br class="clear">\n' +
                    '                                </div>\n' +
                    '                            </span>\n' +
                    '                        </div>\n' +
                    '                    </li>\n' +
                    '                    <li>\n' +
                    '                        <div class="collapsible-header"><i class="material-icons">calculate</i>Statistics</div>\n' +
                    '                        <div class="collapsible-body">\n' +
                    '                            <span>\n' +
                    '                            </span>\n' +
                    '                        </div>\n' +
                    '                    </li>\n' +
                    '                </ul>\n' +
                    '            </div>\n' +
                    '        </div>\n';

                $('div#content').html(html);

                $('div#content div#viewDiv').height(500);

                require([
                    "esri/config",
                    "esri/Map",
                    "esri/views/MapView",
                    "esri/layers/FeatureLayer",
                    "esri/layers/support/LabelClass"
                ], function (esriConfig, Map, MapView, FeatureLayer, LabelClass) {
                    esriConfig.apiKey = "AAPK21dd9c351d74488a99225c91443945e8TwS-RdfcjDLG311EoDWT-PdkzjXfwNkr4Q5JMgS0stdN7VwIr8pLamQMhjjALefM";
                    const bagPandenLayerLabel = new LabelClass({
                        labelExpressionInfo: { expression: "$feature.objectid" },
                        allowOverrun: true,
                        deconflictionStrategy: "none",
                        minScale: 2500,
                        symbol: {
                            type: "text",
                            color: "black",
                            font: {
                                family: "Ubuntu Mono",
                                size: 6
                            }
                        }
                    });
                    const bagPandenLayer = new FeatureLayer({
                        url: "https://basisregistraties.arcgisonline.nl/arcgis/rest/services/BAG/BAGv3/FeatureServer/4",
                        definitionExpression:
                            "identificatie IN (" +buildingIdentification + ")",
                        minScale: 25000,
                        outFields: ['objectid'],
                        labelingInfo: bagPandenLayerLabel
                    });
                    const map = new Map({
                        basemap: "osm-light-gray",
                        layers: [
                            bagPandenLayer
                        ]
                    });
                    const view = new MapView({
                        map: map,
                        center: [6.0909033, 52.5129319],
                        zoom: 17,
                        container: "viewDiv",
                        constraints: {
                            snapToZoom: false
                        }
                    });
                    bagPandenLayer.when(() => {
                        return bagPandenLayer.queryExtent();
                    })
                    .then((response) => {
                        view.goTo(response.extent);
                    });
                });

                $.timeliner({});

                $('div#content .collapsible').collapsible();
            },
            error: function(jqXHR) {
                loadErrorPage(jqXHR);
            },
            complete: function() {
                $('.tooltipped').tooltip({'enterDelay': 1000, 'outDuration': 0});
                hideLoader();
            },
        });
    } else {
        loadInformationPage('You need to first choose an active housingstock');
    }
}

function loadAddressEditPage(id) {
    if(localStorage.getItem('activeHousingstockId')) {
        showLoader();
        $('#slide-out').sidenav('close');

        $.when(
            $.getJSON('/api/v1/housingstocks/' + localStorage.getItem('activeHousingstockId') + '/addresses/' + id),
            $.getJSON('/api/v1/housingstocks/' + localStorage.getItem('activeHousingstockId') + '/blocks'),
            $.getJSON('/api/v1/housingstocks/' + localStorage.getItem('activeHousingstockId') + '/buildingtypes'),
            $.getJSON('/api/v1/vtws')
        ).then(
            function (
                address,
                blocks,
                buildingTypes,
                vtws
            ) {

                let addressdata = address[0].data[0];

                let blockHtmlOptions = '';
                blocks[0].data.forEach(
                    function(item) {
                        if (addressdata.block.id === item.id) {
                            blockHtmlOptions += '                    <option value="' + item.id + '" selected>' + item.name + '</option>\n';
                        } else {
                            blockHtmlOptions += '                    <option value="' + item.id + '">' + item.name + '</option>\n';
                        }
                    }
                );

                let buildingTypeHtmlOptions = '';
                buildingTypes[0].data.forEach(
                    function(item) {
                        if (addressdata.buildingType.id === item.id) {
                            buildingTypeHtmlOptions += '                    <option value="' + item.id + '" selected>' + item.name + '</option>\n';
                        } else {
                            buildingTypeHtmlOptions += '                    <option value="' + item.id + '">' + item.name + '</option>\n';
                        }
                    }
                );

                let vtwHtmlOptions = '';
                vtws[0].data.forEach(
                    function(item) {
                        if (addressdata.vtw.id === item.id) {
                            vtwHtmlOptions += '                    <option value="' + item.id + '" selected>' + item.code + ' - ' + item.typeDescription + '</option>\n';
                        } else {
                            vtwHtmlOptions += '                    <option value="' + item.id + '">' + item.code + ' - ' + item.typeDescription + '</option>\n';
                        }
                    }
                );

                let orientationSelectValues = [
                    {'id': 'n',   'image': '/images/directions/n.png',   'text': 'Noord'},
                    {'id': 'nne', 'image': '/images/directions/nne.png', 'text': 'Noord Noord Oost'},
                    {'id': 'ne',  'image': '/images/directions/ne.png',  'text': 'Noord Oost'},
                    {'id': 'nee', 'image': '/images/directions/nee.png', 'text': 'Noord Oost Oost'},
                    {'id': 'e',   'image': '/images/directions/e.png',   'text': 'Oost'},
                    {'id': 'see', 'image': '/images/directions/see.png', 'text': 'Zuid Oost Oost'},
                    {'id': 'se',  'image': '/images/directions/se.png',  'text': 'Zuid Oost'},
                    {'id': 'sse', 'image': '/images/directions/sse.png', 'text': 'Zuid Zuid Oost'},
                    {'id': 's',   'image': '/images/directions/s.png',   'text': 'Zuid'},
                    {'id': 'ssw', 'image': '/images/directions/ssw.png', 'text': 'Zuid Zuid West'},
                    {'id': 'sw',  'image': '/images/directions/sw.png',  'text': 'Zuid West'},
                    {'id': 'sww', 'image': '/images/directions/sww.png', 'text': 'Zuid West West'},
                    {'id': 'w',   'image': '/images/directions/w.png',   'text': 'West'},
                    {'id': 'nww', 'image': '/images/directions/nww.png', 'text': 'Noord West West'},
                    {'id': 'nw',  'image': '/images/directions/nw.png',  'text': 'Noord West'},
                    {'id': 'nnw', 'image': '/images/directions/nnw.png', 'text': 'Noord Noord West'}
                ];

                let orientationHtmlOptions = '';
                let orientationIsSelected = false;
                orientationSelectValues.forEach(
                    function(item) {
                        if (addressdata.orientation === item.id) {
                            orientationHtmlOptions += '                    <option value="' + item.id + '" data-icon="' + item.image + '" selected>' + item.text + '</option>\n';
                            orientationIsSelected = true;
                        } else {
                            orientationHtmlOptions += '                    <option value="' + item.id + '" data-icon="' + item.image + '">' + item.text + '</option>\n';
                        }
                    }
                );
                if (orientationIsSelected === false) {
                    orientationHtmlOptions = '                    <option disabled selected>Choose a direction</option>\n' + orientationHtmlOptions;
                }

                $('div#content').html(
                    '    <h3 class="header">Edit address</h3>\n' +
                    '    <form id="editbuildingaddress">\n' +
                    '        <div class="card blue-grey darken-1">\n' +
                    '            <div class="card-content white-text">\n' +
                    '                <span class="card-title">Address</span>\n' +
                    '                <p>\n' +
                    '                    ' + addressdata.publicSpace.name + ' ' + addressdata.houseNumber + (addressdata.addition ? ' ' + addressdata.addition : '') + '<br />\n' +
                    '                    ' + addressdata.zipcode + ' ' + addressdata.city.name + '\n' +
                    '                </p>\n' +
                    '            </div>\n' +
                    '        </div>\n' +
                    '        <div class="row">\n' +
                    '            <div class="input-field col s12">\n' +
                    '                <i class="material-icons prefix">view_comfortable</i>\n' +
                    '                <select id="block" name="block">\n' +
                    blockHtmlOptions +
                    '                </select>\n' +
                    '                <label>Block</label>\n' +
                    '            </div>\n' +
                    '        </div>\n' +
                    '        <div class="row">\n' +
                    '            <div class="input-field col s12">\n' +
                    '                <i class="material-icons prefix">home_work</i>\n' +
                    '                <select id="buildingtype" name="buildingtype">\n' +
                    buildingTypeHtmlOptions +
                    '                </select>\n' +
                    '                <label>Building type</label>\n' +
                    '            </div>\n' +
                    '        </div>\n' +
                    '        <div class="row">\n' +
                    '            <div class="input-field col s12">\n' +
                    '                <i class="material-icons prefix">vtw</i>\n' +
                    '                <select id="vtw" name="vtw">\n' +
                    vtwHtmlOptions +
                    '                </select>\n' +
                    '                <label>Vtw</label>\n' +
                    '            </div>\n' +
                    '        </div>\n' +
                    '        <div class="row">\n' +
                    '            <div class="input-field col s12">\n' +
                    '                <i class="material-icons prefix">qr_code_2</i>\n' +
                    '                <input id="rentalunitnumber" name="rentalunitnumber" type="text" class="validate" value="' + (addressdata.rentalUnitNumber ?? '') + '">\n' +
                    '                <label for="rentalunitnumber" class="active">Rental unit number</label>\n' +
                    '            </div>\n' +
                    '        </div>\n' +
                    '        <div class="row">\n' +
                    '            <div class="input-field col s12">\n' +
                    '                <i class="material-icons prefix">explore</i>\n' +
                    '                <select id="orientation" name="orientation">\n' +
                    orientationHtmlOptions +
                    '                </select>\n' +
                    '                <label>Orientation façade</label>\n' +
                    '            </div>\n' +
                    '        </div>\n' +
                    '        <div class="row">\n' +
                    '            <div class="input-field col s12">\n' +
                    '                <p>\n' +
                    '                    <i class="material-icons prefix">house_money</i>\n' +
                    '                    <label>\n' +
                    '                        <input id="daeb" name="daeb" type="checkbox"' + (addressdata.daeb ? ' checked="checked"' : '') + '>\n' +
                    '                        <span>Daeb</span>\n' +
                    '                    </label>\n' +
                    '                </p>\n' +
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

                $('form#editbuildingaddress select').formSelect();

                $('form#editbuildingaddress').submit(function (event) {
                    event.preventDefault();
                    $.ajax({
                        url: '/api/v1/housingstocks/' + localStorage.getItem('activeHousingstockId') + '/addresses/' + id,
                        type: 'PUT',
                        dataType: 'json',
                        contentType: 'application/json; charset=UTF-8',
                        accepts: {
                            json: 'application/json'
                        },
                        data: JSON.stringify(
                            {
                                'block': parseInt($('select#block').val()),
                                'buildingtype': parseInt($('select#buildingtype').val()),
                                'vtw': parseInt($('select#vtw').val()),
                                'rentalunitnumber': $('input#rentalunitnumber').val(),
                                'orientation': $('select#orientation').val(),
                                'daeb': $('input#daeb').prop("checked")
                            }
                        ),
                        beforeSend: function () {
                            showLoader();
                            $('#slide-out').sidenav('close');
                        },
                        success: function () {
                            loadAddressesPage();
                        },
                        error: function (jqXHR) {
                            loadErrorPage(jqXHR);
                        },
                        complete: function () {
                            hideLoader();
                        },
                    });
                });

                hideLoader();
            }
        );
    } else {
        loadInformationPage('You need to first choose an active housingstock');
    }
}

function deleteAddress(id) {
    if(localStorage.getItem('activeHousingstockId')) {
        $.ajax({
            url: '/api/v1/housingstocks/' + localStorage.getItem('activeHousingstockId') + '/addresses/' + id,
            type: 'DELETE',
            beforeSend: function() {
                showLoader();
                $('#slide-out').sidenav('close');
            },
            success: function() {
                loadAddressesPage();
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
 * #################################################
 */