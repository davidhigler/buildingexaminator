Twig.extendFilter('trans', function(id, params, domain, locale) {
    params = params || {}

    for (var key in params) {
        if (
            params.hasOwnProperty(key) &&
            key[0] == Translator.placeHolderPrefix &&
            key[key.length - 1] == Translator.placeHolderSuffix
        ) {
            params[key.substr(1, key.length - 2)] = params[key]
            delete params[key]
        }
    }

    return Translator.trans(id, params[0], domain, locale)
});

let sideNavInstance;

loadTemplates();

$(document).ready(function(){
    const $sideNavElem = $('.sidenav');
    $sideNavElem.sidenav();
    sideNavInstance = M.Sidenav.getInstance($sideNavElem);
    $('.fixed-action-btn').floatingActionButton({
        direction: 'bottom'
    });
    loadHomePage();
});

/**
 * Support functions
 */

function loadTemplates() {
    Twig.twig({id: 'homePage', method: 'ajax', async: false, href: '/views/pages/home.twig' });
    Twig.twig({id: 'creditsPage', method: 'ajax', async: false, href: '/views/pages/credits.twig' });
    Twig.twig({id: 'underconstructionPage', method: 'ajax', async: false, href: '/views/pages/underconstruction.twig' });
    Twig.twig({id: 'testPage', method: 'ajax', async: false, href: '/views/pages/test.twig' });

    Twig.twig({id: 'errorPartial', method: 'ajax', async: false, href: '/views/partials/error.twig' });
    Twig.twig({id: 'informationPartial', method: 'ajax', async: false, href: '/views/partials/information.twig' });

    Twig.twig({id: 'deleteModal', method: 'ajax', async: false, href: '/views/modals/delete.twig' });
    Twig.twig({id: 'activeHousingStockSelect', method: 'ajax', async: false, href: '/views/others/activehousingstockselect.twig' });

    Twig.twig({id: 'overviewPage', method: 'ajax', async: false, href: '/views/others/overviews/overview.twig' });

    Twig.twig({id: 'addressesHeader', method: 'ajax', async: false, href: '/views/others/overviews/addresses/header.twig' });
    Twig.twig({id: 'addressesRows', method: 'ajax', async: false, href: '/views/others/overviews/addresses/rows.twig' });
    Twig.twig({id: 'newAddresss', method: 'ajax', async: false, href: '/views/pages/address/new.twig' });
    Twig.twig({id: 'editAddresss', method: 'ajax', async: false, href: '/views/pages/address/edit.twig' });
    Twig.twig({id: 'detailsAddresss', method: 'ajax', async: false, href: '/views/pages/address/details.twig' });

    Twig.twig({id: 'ownersHeader', method: 'ajax', async: false, href: '/views/others/overviews/owners/header.twig' });
    Twig.twig({id: 'ownersRows', method: 'ajax', async: false, href: '/views/others/overviews/owners/rows.twig' });
    Twig.twig({id: 'newOwnerPage', method: 'ajax', async: false, href: '/views/pages/owner/new.twig' });
    Twig.twig({id: 'editOwnerPage', method: 'ajax', async: false, href: '/views/pages/owner/edit.twig' });

    Twig.twig({id: 'municipalitiesHeader', method: 'ajax', async: false, href: '/views/others/overviews/municipalities/header.twig' });
    Twig.twig({id: 'municipalitiesRows', method: 'ajax', async: false, href: '/views/others/overviews/municipalities/rows.twig' });

    Twig.twig({id: 'citiesHeader', method: 'ajax', async: false, href: '/views/others/overviews/cities/header.twig' });
    Twig.twig({id: 'citiesRows', method: 'ajax', async: false, href: '/views/others/overviews/cities/rows.twig' });

    Twig.twig({id: 'residentialareasHeader', method: 'ajax', async: false, href: '/views/others/overviews/residentialareas/header.twig' });
    Twig.twig({id: 'residentialareasRows', method: 'ajax', async: false, href: '/views/others/overviews/residentialareas/rows.twig' });

    Twig.twig({id: 'neighbourhoodsHeader', method: 'ajax', async: false, href: '/views/others/overviews/neighbourhoods/header.twig' });
    Twig.twig({id: 'neighbourhoodsRows', method: 'ajax', async: false, href: '/views/others/overviews/neighbourhoods/rows.twig' });

    Twig.twig({id: 'vtwsHeader', method: 'ajax', async: false, href: '/views/others/overviews/vtws/header.twig' });
    Twig.twig({id: 'vtwsRows', method: 'ajax', async: false, href: '/views/others/overviews/vtws/rows.twig' });

    Twig.twig({id: 'publicspacesHeader', method: 'ajax', async: false, href: '/views/others/overviews/publicspaces/header.twig' });
    Twig.twig({id: 'publicspacesRows', method: 'ajax', async: false, href: '/views/others/overviews/publicspaces/rows.twig' });

    Twig.twig({id: 'buildingsHeader', method: 'ajax', async: false, href: '/views/others/overviews/buildings/header.twig' });
    Twig.twig({id: 'buildingsRows', method: 'ajax', async: false, href: '/views/others/overviews/buildings/rows.twig' });

    Twig.twig({id: 'residencesHeader', method: 'ajax', async: false, href: '/views/others/overviews/residences/header.twig' });
    Twig.twig({id: 'residencesRows', method: 'ajax', async: false, href: '/views/others/overviews/residences/rows.twig' });

    Twig.twig({id: 'blocksHeader', method: 'ajax', async: false, href: '/views/others/overviews/blocks/header.twig' });
    Twig.twig({id: 'blocksRows', method: 'ajax', async: false, href: '/views/others/overviews/blocks/rows.twig' });
    Twig.twig({id: 'newBlockPage', method: 'ajax', async: false, href: '/views/pages/block/new.twig' });
    Twig.twig({id: 'editBlockPage', method: 'ajax', async: false, href: '/views/pages/block/edit.twig' });

    Twig.twig({id: 'buildingtypesHeader', method: 'ajax', async: false, href: '/views/others/overviews/buildingtypes/header.twig' });
    Twig.twig({id: 'buildingtypesRows', method: 'ajax', async: false, href: '/views/others/overviews/buildingtypes/rows.twig' });
    Twig.twig({id: 'newBuildingTypePage', method: 'ajax', async: false, href: '/views/pages/buildingtype/new.twig' });
    Twig.twig({id: 'editBuildingTypePage', method: 'ajax', async: false, href: '/views/pages/buildingtype/edit.twig' });

    Twig.twig({id: 'usersHeader', method: 'ajax', async: false, href: '/views/others/overviews/users/header.twig' });
    Twig.twig({id: 'usersRows', method: 'ajax', async: false, href: '/views/others/overviews/users/rows.twig' });
    Twig.twig({id: 'newUserPage', method: 'ajax', async: false, href: '/views/pages/user/new.twig' });
    Twig.twig({id: 'editUserPage', method: 'ajax', async: false, href: '/views/pages/user/edit.twig' });

    Twig.twig({id: 'housingstocksHeader', method: 'ajax', async: false, href: '/views/others/overviews/housingstocks/header.twig' });
    Twig.twig({id: 'housingstocksRows', method: 'ajax', async: false, href: '/views/others/overviews/housingstocks/rows.twig' });
    Twig.twig({id: 'newHousingstockPage', method: 'ajax', async: false, href: '/views/pages/housingstock/new.twig' });
    Twig.twig({id: 'editHousingstockPage', method: 'ajax', async: false, href: '/views/pages/housingstock/edit.twig' });

    Twig.twig({id: 'contractorsHeader', method: 'ajax', async: false, href: '/views/others/overviews/contractors/header.twig' });
    Twig.twig({id: 'contractorsRows', method: 'ajax', async: false, href: '/views/others/overviews/contractors/rows.twig' });
    Twig.twig({id: 'newContractorPage', method: 'ajax', async: false, href: '/views/pages/contractor/new.twig' });
    Twig.twig({id: 'editContractorPage', method: 'ajax', async: false, href: '/views/pages/contractor/edit.twig' });

    Twig.twig({id: 'subcontractorsHeader', method: 'ajax', async: false, href: '/views/others/overviews/subcontractors/header.twig' });
    Twig.twig({id: 'subcontractorsRows', method: 'ajax', async: false, href: '/views/others/overviews/subcontractors/rows.twig' });
    Twig.twig({id: 'newSubcontractorPage', method: 'ajax', async: false, href: '/views/pages/subcontractor/new.twig' });
    Twig.twig({id: 'editSubcontractorPage', method: 'ajax', async: false, href: '/views/pages/subcontractor/edit.twig' });

    Twig.twig({id: 'pagination', method: 'ajax', async: false, href: '/views/others/pagination.twig' });
}

function showLoader() {
    $('div.overlay').show();
}

function hideLoader() {
    $('div.overlay').hide();
}

function addPagination(pager, searchterm, callback) {
    return Twig.twig({ref: 'pagination'}).render({
        Pager: pager,
        SeachTerm: searchterm,
        Callback: callback
    });
}

function showDeleteModal(id, name, callback) {
    let modal = $(Twig.twig({ref: 'deleteModal'}).render({Id: id, Name: name, Callback: callback}))
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

function checkMenu(element) {
    $liElement = $(element).parent();
    $liElement.parent().children().removeClass('active')
    $liElement.addClass('active');
}

function checkScreen() {
    if ($(window).width() < 992) {
        sideNavInstance.close();
    }

    hideLoader();
}

function capFirstLetter(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
}

function keyPressListener(event) {
    if (event.keyCode == 13) {
        let target = $(event.srcElement).data("keyPressTarget");
        $("#" + target).click();
    }
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

    const messages = [];

    if(IS_JSON) {
        if(
            typeof response.class !== "undefined"
            && typeof response.detail !== "undefined"
        ) {
            messages.push(response.class + ': ' + response.detail);
        } else if(Array.isArray(response)) {
            for (let i = 0; i < response.length; i++) {
                messages.push(response[i].message);
            }
        }
    } else {
        messages.push(jqXHR.status + ': ' + jqXHR.statusText);
    }

    $('div#content').html(Twig.twig({ref: 'errorPartial'}).render({Messages: messages}));
}

function loadInformationPage(message) {
    $('div#content').html(Twig.twig({ref: 'informationPartial'}).render({Message: message}));
}

function loadUnderConstructionPage(title) {
    $('div#content').html(Twig.twig({ref: 'underconstructionPage'}).render({Title: title}));
}

function loadHomePage() {
    showLoader();

    $.when(
        $.getJSON('/api/v1/housingstocks'),
        $.getJSON('/api/v1/statistics'),
    ).then(
        function (
            housingstocks,
            statistics,
        ) {
            $('div#activeHousingstockSelector').html(Twig.twig({ref: 'activeHousingStockSelect'}).render({
                HousingStocks: housingstocks[0].data,
                ActiveHousingStock: parseInt(localStorage.getItem('activeHousingstockId'))
            }));

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

            $('div#content').html(Twig.twig({ref: 'homePage'}).render({
                HousingStocks: statistics[0].HousingStocks,
                Addresses: statistics[0].Addresses
            }));

            checkScreen();
        }
    );
}

function loadCreditsPage() {
    $('div#content').html(Twig.twig({ref: 'creditsPage'}).render());
}

function loadTestPage() {

    $('div#content').html(Twig.twig({ref: 'testPage'}).render());

    $('div#content div#viewDiv').height(700);

    // config.apiKey = "AAPK21dd9c351d74488a99225c91443945e8TwS-RdfcjDLG311EoDWT-PdkzjXfwNkr4Q5JMgS0stdN7VwIr8pLamQMhjjALefM";
    //
    // const bagPandenLayerLabel = new LabelClass({
    //     labelExpressionInfo: { expression: "$feature.objectid" },
    //     allowOverrun: true,
    //     deconflictionStrategy: "none",
    //     minScale: 2500,
    //     symbol: {
    //         type: "text",
    //         color: "black",
    //         font: {
    //             family: "Ubuntu Mono",
    //             size: 6
    //         }
    //     }
    // });
    //
    // const bagPandenLayer = new FeatureLayer({
    //     url: "https://basisregistraties.arcgisonline.nl/arcgis/rest/services/BAG/BAGv3/FeatureServer/4",
    //     definitionExpression:
    //         "identificatie IN (" +
    //             "'0193100000017808', " +
    //             "'0193100000004644', " +
    //             "'0193100000058461', " +
    //             "'0193100000058462', " +
    //             "'0193100000018103', " +
    //             "'0193100000018102', " +
    //             "'0193100000018100', " +
    //             "'0193100000018075', " +
    //             "'0193100000018074', " +
    //             "'0193100000018073', " +
    //             "'0193100000018072', " +
    //             "'0193100000018071', " +
    //             "'0193100000018070'" +
    //         ")",
    //     minScale: 25000,
    //     outFields: ['objectid'],
    //     labelingInfo: bagPandenLayerLabel
    // });
    //
    // const map = new Map({
    //     basemap: "osm-light-gray",
    //     layers: [
    //         bagPandenLayer
    //     ]
    // });
    //
    // const view = new MapView({
    //     map: map,
    //     center: [6.0909033, 52.5129319],
    //     zoom: 17,
    //     container: "viewDiv",
    //     constraints: {
    //         snapToZoom: false
    //     }
    // });
    //
    // bagPandenLayer.when(() => {
    //     return bagPandenLayer.queryExtent();
    // })
    // .then((response) => {
    //     view.goTo(response.extent);
    // });

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
                        let realX = Math.floor((event.offsetX/event.target.clientWidth)*event.target.naturalWidth);
                        let realY = Math.floor((event.offsetY/event.target.clientHeight)*event.target.naturalHeight);
                        M.toast({html: 'X:' + realX + ' Y:' + realY});
                    }
                );
        }
    );

    checkScreen();
}

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
        },
        success: function(data) {
            $('div#content').html(
                Twig.twig(
                    {ref: 'overviewPage'}
                ).render(
                    {
                        Title: capFirstLetter(Translator.trans('municipalities', {}, 'messages')),
                        Search: {
                            Term: searchterm,
                            Loader: 'loadMunicipalitiesPage'
                        },
                        Header: Twig.twig({ref: 'municipalitiesHeader'}).render(),
                        Rows: Twig.twig({ref: 'municipalitiesRows'}).render({Items: data.data}),
                        Pager: data.pager,
                        SeachTerm: searchterm,
                        Callback: 'loadMunicipalitiesPage'
                    }
                )
            );
        },
        error: function(jqXHR) {
            loadErrorPage(jqXHR);
        },
        complete: function() {
            checkScreen();
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
            },
            success: function(data) {
                $('div#content').html(
                    Twig.twig(
                        {ref: 'overviewPage'}
                    ).render(
                        {
                            Title: capFirstLetter(Translator.trans('cities', {}, 'messages')),
                            Search: {
                                Term: searchterm,
                                Loader: 'loadCitiesPage'
                            },
                            Header: Twig.twig({ref: 'citiesHeader'}).render(),
                            Rows: Twig.twig({ref: 'citiesRows'}).render({Items: data.data}),
                            Pager: data.pager,
                            SeachTerm: searchterm,
                            Callback: 'loadCitiesPage'
                        }
                    )
                );
            },
            error: function(jqXHR) {
                loadErrorPage(jqXHR);
            },
            complete: function() {
                checkScreen();
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
        },
        success: function(data) {
            $('div#content').html(
                Twig.twig(
                    {ref: 'overviewPage'}
                ).render(
                    {
                        Title: capFirstLetter(Translator.trans('residential areas', {}, 'messages')),
                        Search: {
                            Term: searchterm,
                            Loader: 'loadResidentialAreasPage'
                        },
                        Header: Twig.twig({ref: 'residentialareasHeader'}).render(),
                        Rows: Twig.twig({ref: 'residentialareasRows'}).render({Items: data.data}),
                        Pager: data.pager,
                        SeachTerm: searchterm,
                        Callback: 'loadResidentialAreasPage'
                    }
                )
            );
        },
        error: function(jqXHR) {
            loadErrorPage(jqXHR);
        },
        complete: function() {
            checkScreen();
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
        },
        success: function(data) {
            $('div#content').html(
                Twig.twig(
                    {ref: 'overviewPage'}
                ).render(
                    {
                        Title: capFirstLetter(Translator.trans('neighbourhoods', {}, 'messages')),
                        Search: {
                            Term: searchterm,
                            Loader: 'loadNeighbourhoodsPage'
                        },
                        Header: Twig.twig({ref: 'neighbourhoodsHeader'}).render(),
                        Rows: Twig.twig({ref: 'neighbourhoodsRows'}).render({Items: data.data}),
                        Pager: data.pager,
                        SeachTerm: searchterm,
                        Callback: 'loadNeighbourhoodsPage'
                    }
                )
            );
        },
        error: function(jqXHR) {
            loadErrorPage(jqXHR);
        },
        complete: function() {
            checkScreen();
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
        },
        success: function(data) {
            $('div#content').html(
                Twig.twig(
                    {ref: 'overviewPage'}
                ).render(
                    {
                        Title: capFirstLetter(Translator.trans('VTWs', {}, 'messages')),
                        Search: {
                            Term: searchterm,
                            Loader: 'loadVtws'
                        },
                        Header: Twig.twig({ref: 'vtwsHeader'}).render(),
                        Rows: Twig.twig({ref: 'vtwsRows'}).render({Items: data.data}),
                        Pager: data.pager,
                        SeachTerm: searchterm,
                        Callback: 'loadVtws'
                    }
                )
            );
        },
        error: function(jqXHR) {
            loadErrorPage(jqXHR);
        },
        complete: function() {
            checkScreen();
        },
    });
}

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
            },
            success: function(data) {
                $('div#content').html(
                    Twig.twig(
                        {ref: 'overviewPage'}
                    ).render(
                        {
                            Title: capFirstLetter(Translator.trans('public spaces', {}, 'messages')),
                            Search: {
                                Term: searchterm,
                                Loader: 'loadPublicSpacesPage'
                            },
                            Header: Twig.twig({ref: 'publicspacesHeader'}).render(),
                            Rows: Twig.twig({ref: 'publicspacesRows'}).render({Items: data.data}),
                            Pager: data.pager,
                            SeachTerm: searchterm,
                            Callback: 'loadPublicSpacesPage'
                        }
                    )
                );
            },
            error: function(jqXHR) {
                loadErrorPage(jqXHR);
            },
            complete: function() {
                checkScreen();
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
            },
            success: function(data) {
                $('div#content').html(
                    Twig.twig(
                        {ref: 'overviewPage'}
                    ).render(
                        {
                            Title: capFirstLetter(Translator.trans('buildings', {}, 'messages')),
                            Search: {
                                Term: searchterm,
                                Loader: 'loadBuildingsPage'
                            },
                            Header: Twig.twig({ref: 'buildingsHeader'}).render(),
                            Rows: Twig.twig({ref: 'buildingsRows'}).render({Items: data.data}),
                            Pager: data.pager,
                            SeachTerm: searchterm,
                            Callback: 'loadBuildingsPage'
                        }
                    )
                );
            },
            error: function(jqXHR) {
                loadErrorPage(jqXHR);
            },
            complete: function() {
                checkScreen();
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
            },
            success: function(data) {
                $('div#content').html(
                    Twig.twig(
                        {ref: 'overviewPage'}
                    ).render(
                        {
                            Title: capFirstLetter(Translator.trans('residences', {}, 'messages')),
                            Search: {
                                Term: searchterm,
                                Loader: 'loadResidencesPage'
                            },
                            Header: Twig.twig({ref: 'residencesHeader'}).render(),
                            Rows: Twig.twig({ref: 'residencesRows'}).render({Items: data.data}),
                            Pager: data.pager,
                            SeachTerm: searchterm,
                            Callback: 'loadResidencesPage'
                        }
                    )
                );
            },
            error: function(jqXHR) {
                loadErrorPage(jqXHR);
            },
            complete: function() {
                checkScreen();
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
            },
            success: function(data) {
                $('div#content').html(
                    Twig.twig(
                        {ref: 'overviewPage'}
                    ).render(
                        {
                            Title: capFirstLetter(Translator.trans('blocks', {}, 'messages')),
                            New: {
                                Loader: 'loadBlockNewPage',
                                Icon: 'add_view_module'
                            },
                            Search: {
                                Term: searchterm,
                                Loader: 'loadBlocksPage'
                            },
                            Header: Twig.twig({ref: 'blocksHeader'}).render(),
                            Rows: Twig.twig({ref: 'blocksRows'}).render({Items: data.data}),
                            Pager: data.pager,
                            SeachTerm: searchterm,
                            Callback: 'loadBlocksPage'
                        }
                    )
                );
            },
            error: function(jqXHR) {
                loadErrorPage(jqXHR);
            },
            complete: function() {
                $('.tooltipped').tooltip({'enterDelay': 1000, 'outDuration': 0}); // @ToDo Only show if not empty
                checkScreen();
            },
        });
    } else {
        loadInformationPage('You need to first choose an active housingstock');
    }
}

function loadBlockNewPage() {
    if(localStorage.getItem('activeHousingstockId')) {
        $('div#content').html(
            Twig.twig(
                {ref: 'newBlockPage'}
            ).render()
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
                },
                success: function () {
                    loadBlocksPage();
                },
                error: function (jqXHR) {
                    loadErrorPage(jqXHR);
                },
                complete: function () {
                    checkScreen();
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
            },
            success: function(data) {
                $('div#content').html(
                    Twig.twig(
                        {ref: 'editBlockPage'}
                    ).render(
                        data.data
                    )
                );

                $("form#editblock button[name='cancel']").click(
                    function(event) {
                        event.preventDefault();
                        loadBlocksPage();
                    }
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
                        },
                        success: function() {
                            loadBlocksPage();
                        },
                        error: function(jqXHR) {
                            loadErrorPage(jqXHR);
                        },
                        complete: function() {
                            checkScreen();
                        },
                    });
                });
            },
            error: function (jqXHR) {
                loadErrorPage(jqXHR)
            },
            complete: function() {
                checkScreen();
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
            },
            success: function() {
                loadBlocksPage();
            },
            error: function(jqXHR) {
                loadErrorPage(jqXHR);
                checkScreen();
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
            },
            success: function(data) {
                $('div#content').html(
                    Twig.twig(
                        {ref: 'overviewPage'}
                    ).render(
                        {
                            Title: capFirstLetter(Translator.trans('building types', {}, 'messages')),
                            New: {
                                Loader: 'loadBuildingtypeNewPage',
                                Icon: 'add_home_work'
                            },
                            Search: {
                                Term: searchterm,
                                Loader: 'loadBuildingtypesPage'
                            },
                            Header: Twig.twig({ref: 'buildingtypesHeader'}).render(),
                            Rows: Twig.twig({ref: 'buildingtypesRows'}).render({Items: data.data}),
                            Pager: data.pager,
                            SeachTerm: searchterm,
                            Callback: 'loadBuildingtypesPage'
                        }
                    )
                );
            },
            error: function(jqXHR) {
                loadErrorPage(jqXHR);
            },
            complete: function() {
                $('.tooltipped').tooltip({'enterDelay': 1000, 'outDuration': 0});
                checkScreen();
            },
        });
    } else {
        loadInformationPage('You need to first choose an active housingstock');
    }
}

function loadBuildingtypeNewPage() {
    if(localStorage.getItem('activeHousingstockId')) {
        $('div#content').html(
            Twig.twig(
                {ref: 'newBuildingTypePage'}
            ).render()
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
                },
                success: function () {
                    loadBuildingtypesPage();
                },
                error: function (jqXHR) {
                    loadErrorPage(jqXHR);
                },
                complete: function () {
                    checkScreen();
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
            },
            success: function(data) {
                $('div#content').html(
                    Twig.twig(
                        {ref: 'editBuildingTypePage'}
                    ).render(
                        data.data
                    )
                );

                $("form#editbuildingtype button[name='cancel']").click(
                    function(event) {
                        event.preventDefault();
                        loadBuildingtypesPage();
                    }
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
                        },
                        success: function() {
                            loadBuildingtypesPage();
                        },
                        error: function(jqXHR) {
                            loadErrorPage(jqXHR);
                        },
                        complete: function() {
                            checkScreen();
                        },
                    });
                });
            },
            error: function (jqXHR) {
                loadErrorPage(jqXHR)
            },
            complete: function() {
                checkScreen();
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
            },
            success: function() {
                loadBuildingtypesPage();
            },
            error: function(jqXHR) {
                loadErrorPage(jqXHR);
                checkScreen();
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
            },
            success: function(data) {
                $('div#content').html(
                    Twig.twig(
                        {ref: 'overviewPage'}
                    ).render(
                        {
                            Title: capFirstLetter(Translator.trans('addresses', {}, 'messages')),
                            New: {
                                Loader: 'loadAddressNewPage',
                                Icon: 'house_add'
                            },
                            Search: {
                                Term: searchterm,
                                Loader: 'loadAddressesPage'
                            },
                            Header: Twig.twig({ref: 'addressesHeader'}).render(),
                            Rows: Twig.twig({ref: 'addressesRows'}).render({Items: data.data}),
                            Pager: data.pager,
                            SeachTerm: searchterm,
                            Callback: 'loadAddressesPage'
                        }
                    )
                );
            },
            error: function(jqXHR) {
                loadErrorPage(jqXHR);
            },
            complete: function() {
                checkScreen();
            },
        });
    } else {
        loadInformationPage('You need to first choose an active housingstock');
    }
}

function loadAddressNewPage() {
    if(localStorage.getItem('activeHousingstockId')) {
        showLoader();

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
                $('div#content').html(
                    Twig.twig(
                        {ref: 'newAddresss'}
                    ).render(
                        {
                            'blocks': blocks[0].data,
                            'buildingtypes': buildingtypes[0].data,
                            'vtws': vtws[0].data
                        }
                    )
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
                        },
                        success: function () {
                            loadAddressesPage();
                        },
                        error: function (jqXHR) {
                            loadErrorPage(jqXHR);
                        },
                        complete: function () {
                            checkScreen();
                        },
                    });
                });

                checkScreen();
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
            },
            success: function(data) {
                let addressdata = data.data;
                buildingIdentification = addressdata.building.identification;

                $('div#content').html(
                    Twig.twig(
                        {ref: 'detailsAddresss'}
                    ).render(
                        {'addressdata': addressdata}
                    )
                );

                $('div#content div#viewDiv').height(500);

                // require([
                //     "esri/config",
                //     "esri/Map",
                //     "esri/views/MapView",
                //     "esri/layers/FeatureLayer",
                //     "esri/layers/support/LabelClass"
                // ], function (esriConfig, Map, MapView, FeatureLayer, LabelClass) {
                //     esriConfig.apiKey = "AAPK21dd9c351d74488a99225c91443945e8TwS-RdfcjDLG311EoDWT-PdkzjXfwNkr4Q5JMgS0stdN7VwIr8pLamQMhjjALefM";
                //     const bagPandenLayerLabel = new LabelClass({
                //         labelExpressionInfo: { expression: "$feature.objectid" },
                //         allowOverrun: true,
                //         deconflictionStrategy: "none",
                //         minScale: 2500,
                //         symbol: {
                //             type: "text",
                //             color: "black",
                //             font: {
                //                 family: "Ubuntu Mono",
                //                 size: 6
                //             }
                //         }
                //     });
                //     const bagPandenLayer = new FeatureLayer({
                //         url: "https://basisregistraties.arcgisonline.nl/arcgis/rest/services/BAG/BAGv3/FeatureServer/4",
                //         definitionExpression:
                //             "identificatie IN (" +buildingIdentification + ")",
                //         minScale: 25000,
                //         outFields: ['objectid'],
                //         labelingInfo: bagPandenLayerLabel
                //     });
                //     const map = new Map({
                //         basemap: "osm-light-gray",
                //         layers: [
                //             bagPandenLayer
                //         ]
                //     });
                //     const view = new MapView({
                //         map: map,
                //         center: [6.0909033, 52.5129319],
                //         zoom: 17,
                //         container: "viewDiv",
                //         constraints: {
                //             snapToZoom: false
                //         }
                //     });
                //     bagPandenLayer.when(() => {
                //         return bagPandenLayer.queryExtent();
                //     })
                //     .then((response) => {
                //         view.goTo(response.extent);
                //     });
                // });

                $('div#content .collapsible').collapsible();
            },
            error: function(jqXHR) {
                loadErrorPage(jqXHR);
            },
            complete: function() {
                $('.tooltipped').tooltip({'enterDelay': 1000, 'outDuration': 0});
                checkScreen();
            },
        });
    } else {
        loadInformationPage('You need to first choose an active housingstock');
    }
}

function loadAddressEditPage(id) {
    if(localStorage.getItem('activeHousingstockId')) {
        showLoader();

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
                $('div#content').html(
                    Twig.twig(
                        {ref: 'editAddresss'}
                    ).render(
                        {
                            'addressdata': address[0].data,
                            'blocks': blocks[0].data,
                            'buildingtypes': buildingTypes[0].data,
                            'vtws': vtws[0].data
                        }
                    )
                );

                $('form#editbuildingaddress select').formSelect();

                $("form#editbuildingaddress button[name='cancel']").click(
                    function(event) {
                        event.preventDefault();
                        loadAddressesPage();
                    }
                );

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
                        },
                        success: function () {
                            loadAddressesPage();
                        },
                        error: function (jqXHR) {
                            loadErrorPage(jqXHR);
                        },
                        complete: function () {
                            checkScreen();
                        },
                    });
                });

                checkScreen();
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
            },
            success: function() {
                loadAddressesPage();
            },
            error: function(jqXHR) {
                loadErrorPage(jqXHR);
                checkScreen();
            },
        });
    } else {
        loadInformationPage('You need to first choose an active housingstock');
    }
}

/**
 * Projects
 */

function loadProjectsPage(id) {
    if(localStorage.getItem('activeHousingstockId')) {
        loadUnderConstructionPage('Projects');
    } else {
        loadInformationPage('You need to first choose an active housingstock');
    }
}

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
        },
        success: function(data) {
            $('div#content').html(
                Twig.twig(
                    {ref: 'overviewPage'}
                ).render(
                    {
                        Title: capFirstLetter(Translator.trans('owners', {}, 'messages')),
                        New: {
                            Loader: 'loadOwnerNewPage',
                            Icon: 'add_owner'
                        },
                        Search: {
                            Term: searchterm,
                            Loader: 'loadOwnersPage'
                        },
                        Header: Twig.twig({ref: 'ownersHeader'}).render(),
                        Rows: Twig.twig({ref: 'ownersRows'}).render({Items: data.data}),
                        Pager: data.pager,
                        SeachTerm: searchterm,
                        Callback: 'loadOwnersPage'
                    }
                )
            );
        },
        error: function(jqXHR) {
            loadErrorPage(jqXHR);
        },
        complete: function() {
            checkScreen();
        },
    });
}

function loadOwnerNewPage() {
    showLoader();

    $('div#content').html(
        Twig.twig(
            {ref: 'newOwnerPage'}
        ).render()
    );

    checkScreen();

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
            },
            success: function() {
                loadOwnersPage();
            },
            error: function(jqXHR) {
                loadErrorPage(jqXHR);
            },
            complete: function() {
                checkScreen();
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
        },
        success: function(data) {
            $('div#content').html(
                Twig.twig(
                    {ref: 'editOwnerPage'}
                ).render(
                    data.data
                )
            );

            $("form#editowner button[name='cancel']").click(
                function(event) {
                    event.preventDefault();
                    loadOwnersPage();
                }
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
                    },
                    success: function() {
                        loadOwnersPage();
                    },
                    error: function(jqXHR) {
                        loadErrorPage(jqXHR);
                    },
                    complete: function() {
                        checkScreen();
                    },
                });
            });

            checkScreen();
        },
        error: function (jqXHR) {
            loadErrorPage(jqXHR)
        },
    });
}

function deleteOwner(id) {
    $.ajax({
        url: '/api/v1/owners/' + id,
        type: 'DELETE',
        beforeSend: function() {
            showLoader();
        },
        success: function() {
            loadOwnersPage();
        },
        error: function(jqXHR) {
            loadErrorPage(jqXHR);
            checkScreen();
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
        },
        success: function(data) {
            $('div#content').html(
                Twig.twig(
                    {ref: 'overviewPage'}
                ).render(
                    {
                        Title: capFirstLetter(Translator.trans('housingstocks', {}, 'messages')),
                        New: {
                            Loader: 'loadHousingstockNewPage',
                            Icon: 'domain_add'
                        },
                        Search: {
                            Term: searchterm,
                            Loader: 'loadHousingstocksPage'
                        },
                        Header: Twig.twig({ref: 'housingstocksHeader'}).render(),
                        Rows: Twig.twig({ref: 'housingstocksRows'}).render({Items: data.data}),
                        Pager: data.pager,
                        SeachTerm: searchterm,
                        Callback: 'loadHousingstocksPage'
                    }
                )
            );
        },
        error: function(jqXHR) {
            loadErrorPage(jqXHR);
        },
        complete: function() {
            $('.tooltipped').tooltip({'enterDelay': 1000, 'outDuration': 0});
            checkScreen();
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
        },
        success: function(data) {
            $('div#content').html(
                Twig.twig(
                    {ref: 'newHousingstockPage'}
                ).render(
                    data
                )
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
                    },
                    success: function() {
                        loadHousingstocksPage();
                    },
                    error: function(jqXHR) {
                        loadErrorPage(jqXHR);
                    },
                    complete: function() {
                        checkScreen();
                    },
                });
            });
        },
        error: function(jqXHR) {
            loadErrorPage(jqXHR);
        },
        complete: function() {
            checkScreen();
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
                    $('div#content').html(
                        Twig.twig(
                            {ref: 'editHousingstockPage'}
                        ).render(
                            data.data
                        )
                    );

                    $("form#edithousingstock button[name='cancel']").click(
                        function(event) {
                            event.preventDefault();
                            loadHousingstocksPage();
                        }
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
                            },
                            success: function() {
                                loadHousingstocksPage();
                            },
                            error: function(jqXHR) {
                                loadErrorPage(jqXHR);
                            },
                            complete: function() {
                                checkScreen();
                            },
                        });
                    });
                },
                error: function (jqXHR) {
                    loadErrorPage(jqXHR)
                },
                complete: function () {
                    checkScreen();
                },
            });
        },
        error: function(jqXHR) {
            loadErrorPage(jqXHR);
        },
    });
}

function deleteHousingstock(id) {
    $.ajax({
        url: '/api/v1/housingstocks/' + id,
        type: 'DELETE',
        beforeSend: function() {
            showLoader();
        },
        success: function() {
            loadHousingstocksPage();
        },
        error: function(jqXHR) {
            loadErrorPage(jqXHR);
            checkScreen();
        },
    });
}

/**
 * Contractors
 */

function loadContractorsPage(page = 1, searchterm = '') {
    $.ajax({
        url: '/api/v1/contractors',
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
        },
        success: function(data) {
            $('div#content').html(
                Twig.twig(
                    {ref: 'overviewPage'}
                ).render(
                    {
                        Title: capFirstLetter(Translator.trans('contractors', {}, 'messages')),
                        New: {
                            Loader: 'loadContractorNewPage',
                            Icon: 'add_contractor'
                        },
                        Search: {
                            Term: searchterm,
                            Loader: 'loadContractorsPage'
                        },
                        Header: Twig.twig({ref: 'contractorsHeader'}).render(),
                        Rows: Twig.twig({ref: 'contractorsRows'}).render({Items: data.data}),
                        Pager: data.pager,
                        SeachTerm: searchterm,
                        Callback: 'loadContractorsPage'
                    }
                )
            );
        },
        error: function(jqXHR) {
            loadErrorPage(jqXHR);
        },
        complete: function() {
            checkScreen();
        },
    });
}

function loadContractorNewPage() {
    $('div#content').html(
        Twig.twig(
            {ref: 'newContractorPage'}
        ).render()
    );

    $("form#newcontractor button[name='cancel']").click(
        function(event) {
            event.preventDefault();
            loadContractorsPage();
        }
    );

    $('form#newcontractor').submit(function(event) {
        event.preventDefault();
        $.ajax({
            url: '/api/v1/contractors',
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
                    'kvk': $('input#kvk').val(),
                    'btw': $('input#btw').val(),
                    'website': $('input#website').val(),
                }
            ),
            beforeSend: function() {
                showLoader();
            },
            success: function() {
                loadContractorsPage();
            },
            error: function(jqXHR) {
                loadErrorPage(jqXHR);
            },
            complete: function() {
                checkScreen();
            },
        });
    });

    checkScreen();
}

function loadContractorEditPage(id) {
    $.ajax({
        url: '/api/v1/contractors/' + id,
        type: 'GET',
        dataType: 'json',
        accepts: {
            json: 'application/json'
        },
        beforeSend: function() {
            showLoader();
        },
        success: function(data) {
            $('div#content').html(
                Twig.twig(
                    {ref: 'editContractorPage'}
                ).render(
                    data.data
                )
            );

            $("form#editcontractor button[name='cancel']").click(
                function(event) {
                    event.preventDefault();
                    loadContractorsPage();
                }
            );

            $('form#editcontractor').submit(function(event) {
                event.preventDefault();
                $.ajax({
                    url: '/api/v1/contractors/' + $('input#id').val(),
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
                            'kvk': $('input#kvk').val(),
                            'btw': $('input#btw').val(),
                            'website': $('input#website').val(),
                        }
                    ),
                    beforeSend: function() {
                        showLoader();
                    },
                    success: function() {
                        loadContractorsPage();
                    },
                    error: function(jqXHR) {
                        loadErrorPage(jqXHR);
                    },
                    complete: function() {
                        checkScreen();
                    },
                });
            });
        },
        error: function (jqXHR) {
            loadErrorPage(jqXHR)
        },
    });
}

function deleteContractor(id) {
    $.ajax({
        url: '/api/v1/contractors/' + id,
        type: 'DELETE',
        beforeSend: function() {
            showLoader();
        },
        success: function() {
            loadContractorsPage();
        },
        error: function(jqXHR) {
            loadErrorPage(jqXHR);
            checkScreen();
        },
    });
}

/**
 * Subcontractors
 */

function loadSubcontractorsPage(page = 1, searchterm = '') {
    $.ajax({
        url: '/api/v1/subcontractors',
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
        },
        success: function(data) {
            $('div#content').html(
                Twig.twig(
                    {ref: 'overviewPage'}
                ).render(
                    {
                        Title: capFirstLetter(Translator.trans('subcontractors', {}, 'messages')),
                        New: {
                            Loader: 'loadSubcontractorNewPage',
                            Icon: 'add_subcontractor'
                        },
                        Search: {
                            Term: searchterm,
                            Loader: 'loadSubcontractorsPage'
                        },
                        Header: Twig.twig({ref: 'subcontractorsHeader'}).render(),
                        Rows: Twig.twig({ref: 'subcontractorsRows'}).render({Items: data.data}),
                        Pager: data.pager,
                        SeachTerm: searchterm,
                        Callback: 'loadSubcontractorsPage'
                    }
                )
            );
        },
        error: function(jqXHR) {
            loadErrorPage(jqXHR);
        },
        complete: function() {
            checkScreen();
        },
    });
}

function loadSubcontractorNewPage() {
    $('div#content').html(
        Twig.twig(
            {ref: 'newSubcontractorPage'}
        ).render()
    );

    $("form#newsubcontractor button[name='cancel']").click(
        function(event) {
            event.preventDefault();
            loadSubcontractorsPage();
        }
    );

    $('form#newsubcontractor').submit(function(event) {
        event.preventDefault();
        $.ajax({
            url: '/api/v1/subcontractors',
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
                    'kvk': $('input#kvk').val(),
                    'btw': $('input#btw').val(),
                    'website': $('input#website').val(),
                }
            ),
            beforeSend: function() {
                showLoader();
            },
            success: function() {
                loadSubcontractorsPage();
            },
            error: function(jqXHR) {
                loadErrorPage(jqXHR);
            },
            complete: function() {
                checkScreen();
            },
        });
    });

    checkScreen();
}

function loadSubcontractorEditPage(id) {
    $.ajax({
        url: '/api/v1/subcontractors/' + id,
        type: 'GET',
        dataType: 'json',
        accepts: {
            json: 'application/json'
        },
        beforeSend: function() {
            showLoader();
        },
        success: function(data) {
            $('div#content').html(
                Twig.twig(
                    {ref: 'editSubcontractorPage'}
                ).render(
                    data.data
                )
            );

            $("form#editsubcontractor button[name='cancel']").click(
                function(event) {
                    event.preventDefault();
                    loadSubcontractorsPage();
                }
            );

            $('form#editsubcontractor').submit(function(event) {
                event.preventDefault();
                $.ajax({
                    url: '/api/v1/subcontractors/' + $('input#id').val(),
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
                            'kvk': $('input#kvk').val(),
                            'btw': $('input#btw').val(),
                            'website': $('input#website').val(),
                        }
                    ),
                    beforeSend: function() {
                        showLoader();
                    },
                    success: function() {
                        loadSubcontractorsPage();
                    },
                    error: function(jqXHR) {
                        loadErrorPage(jqXHR);
                    },
                    complete: function() {
                        checkScreen();
                    },
                });
            });
        },
        error: function (jqXHR) {
            loadErrorPage(jqXHR)
        },
    });
}

function deleteSubcontractor(id) {
    $.ajax({
        url: '/api/v1/subcontractors/' + id,
        type: 'DELETE',
        beforeSend: function() {
            showLoader();
        },
        success: function() {
            loadSubcontractorsPage();
        },
        error: function(jqXHR) {
            loadErrorPage(jqXHR);
            checkScreen();
        },
    });
}

/**
 * Users
 */

function loadUsersPage(page = 1, searchterm = '') {
    $.ajax({
        url: '/api/v1/users',
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
        },
        success: function(data) {
            $('div#content').html(
                Twig.twig(
                    {ref: 'overviewPage'}
                ).render(
                    {
                        Title: capFirstLetter(Translator.trans('users', {}, 'messages')),
                        New: {
                            Loader: 'loadUserNewPage',
                            Icon: 'person_add'
                        },
                        Search: {
                            Term: searchterm,
                            Loader: 'loadUsersPage'
                        },
                        Header: Twig.twig({ref: 'usersHeader'}).render(),
                        Rows: Twig.twig({ref: 'usersRows'}).render({Items: data.data}),
                        Pager: data.pager,
                        SeachTerm: searchterm,
                        Callback: 'loadUsersPage'
                    }
                )
            );
        },
        error: function(jqXHR) {
            loadErrorPage(jqXHR);
        },
        complete: function() {
            checkScreen();
        },
    });
}

function loadUserNewPage() {
    $('div#content').html(
        Twig.twig(
            {ref: 'newUserPage'}
        ).render()
    );

    $("#user_type_select").formSelect();

    $("form#newuser button[name='cancel']").click(
        function(event) {
            event.preventDefault();
            loadUsersPage();
        }
    );

    $('form#newuser').submit(function (event) {
        event.preventDefault();
        $.ajax({
            url: '/api/v1/users',
            type: 'POST',
            dataType: 'json',
            contentType: 'application/json; charset=UTF-8',
            accepts: {
                json: 'application/json'
            },
            data: JSON.stringify(
                {
                    'type': $('select#user_type_select').val(),
                    'email': $('input#email').val(),
                    'password': $('input#password').val(),
                    'confirmpassword': $('input#confirmpassword').val(),
                    'adminrole': $('input#adminrole').prop("checked")
                }
            ),
            beforeSend: function () {
                showLoader();
            },
            success: function () {
                loadUsersPage();
            },
            error: function (jqXHR) {
                loadErrorPage(jqXHR);
            },
            complete: function () {
                checkScreen();
            },
        });
    });

    checkScreen();
}

function loadUserEditPage(id) {
    $.ajax({
        url: '/api/v1/users/' + id,
        type: 'GET',
        dataType: 'json',
        accepts: {
            json: 'application/json'
        },
        beforeSend: function() {
            showLoader();
        },
        success: function(data) {
            $('div#content').html(
                Twig.twig(
                    {ref: 'editUserPage'}
                ).render(
                    data.data
                )
            );

            $("form#edituser button[name='cancel']").click(
                function(event) {
                    event.preventDefault();
                    loadUsersPage();
                }
            );

            $('form#edituser').submit(function(event) {
                event.preventDefault();
                $.ajax({
                    url: '/api/v1/users/' + id,
                    type: 'PUT',
                    dataType: 'json',
                    contentType: 'application/json; charset=UTF-8',
                    accepts: {
                        json: 'application/json'
                    },
                    data: JSON.stringify(
                        {
                            'email': $('input#email').val(),
                            'password': $('input#password').val(),
                            'confirmpassword': $('input#confirmpassword').val(),
                            'adminrole': $('input#adminrole').prop("checked")
                        }
                    ),
                    beforeSend: function() {
                        showLoader();
                    },
                    success: function() {
                        loadUsersPage();
                    },
                    error: function(jqXHR) {
                        loadErrorPage(jqXHR);
                    },
                    complete: function() {
                        checkScreen();
                    },
                });
            });
        },
        error: function (jqXHR) {
            loadErrorPage(jqXHR)
        },
    });
}

function deleteUser(id) {
    $.ajax({
        url: '/api/v1/users/' + id,
        type: 'DELETE',
        beforeSend: function() {
            showLoader();
        },
        success: function() {
            loadUsersPage();
        },
        error: function(jqXHR) {
            loadErrorPage(jqXHR);
            checkScreen();
        },
    });
}
