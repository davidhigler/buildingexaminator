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
 * #################################################
 */

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

    Twig.twig({id: 'ownersHeader', method: 'ajax', async: false, href: '/views/others/overviews/owners/header.twig' });
    Twig.twig({id: 'ownersRows', method: 'ajax', async: false, href: '/views/others/overviews/owners/rows.twig' });

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

    Twig.twig({id: 'housingstocksHeader', method: 'ajax', async: false, href: '/views/others/overviews/housingstocks/header.twig' });
    Twig.twig({id: 'housingstocksRows', method: 'ajax', async: false, href: '/views/others/overviews/housingstocks/rows.twig' });

    Twig.twig({id: 'contractorsHeader', method: 'ajax', async: false, href: '/views/others/overviews/contractors/header.twig' });
    Twig.twig({id: 'contractorsRows', method: 'ajax', async: false, href: '/views/others/overviews/contractors/rows.twig' });

    Twig.twig({id: 'subcontractorsHeader', method: 'ajax', async: false, href: '/views/others/overviews/subcontractors/header.twig' });
    Twig.twig({id: 'subcontractorsRows', method: 'ajax', async: false, href: '/views/others/overviews/subcontractors/rows.twig' });

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
    //             "identificatie IN (" +
    //                 "'0193100000017808', " +
    //                 "'0193100000004644', " +
    //                 "'0193100000058461', " +
    //                 "'0193100000058462', " +
    //                 "'0193100000018103', " +
    //                 "'0193100000018102', " +
    //                 "'0193100000018100', " +
    //                 "'0193100000018075', " +
    //                 "'0193100000018074', " +
    //                 "'0193100000018073', " +
    //                 "'0193100000018072', " +
    //                 "'0193100000018071', " +
    //                 "'0193100000018070'" +
    //             ")",
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
                console.log(data);
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
                let addressdata = address[0].data;

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
                    '            <div class="col s6">\n' +
                    '                <button type="submit" class="btn" name="save">\n' +
                    '                    <i class="material-icons left">save</i>Save\n' +
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
        },
        success: function(data) {
            $('div#content').html(
                Twig.twig(
                    {ref: 'overviewPage'}
                ).render(
                    {
                        Title: capFirstLetter(Translator.trans('owners', {}, 'messages')),
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
                '            <div class="col s6">\n' +
                '                <button type="submit" class="btn" name="save">\n' +
                '                    <i class="material-icons left">save</i>Save\n' +
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
        },
        error: function (jqXHR) {
            loadErrorPage(jqXHR)
        },
        complete: function() {
            checkScreen();
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
                            Loader: 'loadHousingstockNewPages',
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
                        '            <div class="col s6">\n' +
                        '                <button type="submit" class="btn" name="save">\n' +
                        '                    <i class="material-icons left">save</i>Save\n' +
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
        complete: function() {
            checkScreen();
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
    showLoader();

    $('div#content').html(
        '    <h3 class="header">New contractor</h3>\n' +
        '    <form id="newcontractor">\n' +
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
        '                <i class="material-icons prefix">http</i>\n' +
        '                <input id="website" name="website" type="url" class="validate" pattern="https://.*" maxlength="256">\n' +
        '                <label for="website">Website</label>\n' +
        '                <span class="helper-text" data-error="Wrong (must be a valid URL)" data-success="Right"></span>\n' +
        '            </div>\n' +
        '        </div>\n' +
        '        <div class="row">\n' +
        '            <div class="col s6">\n' +
        '                <button class="btn" name="create" type="submit">\n' +
        '                    <i class="material-icons left">add_contractor</i>Create\n' +
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

    checkScreen();

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
                '    <h3 class="header">Edit contractor</h3>\n' +
                '    <form id="editcontractor">\n' +
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
                '                <i class="material-icons prefix">http</i>\n' +
                '                <input id="website" name="website" type="text" class="validate" pattern="https://.*" maxlength="256" value="' + (data.data.website ?? '') + '">\n' +
                '                <label for="website" class="active">Website</label>\n' +
                '                <span class="helper-text" data-error="Wrong (must be a valid URL)" data-success="Right"></span>\n' +
                '            </div>\n' +
                '        </div>\n' +
                '        <div class="row">\n' +
                '            <div class="col s6">\n' +
                '                <button type="submit" class="btn" name="save">\n' +
                '                    <i class="material-icons left">save</i>Save\n' +
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
        complete: function() {
            checkScreen();
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
    showLoader();

    $('div#content').html(
        '    <h3 class="header">New subcontractor</h3>\n' +
        '    <form id="newsubcontractor">\n' +
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
        '                <i class="material-icons prefix">http</i>\n' +
        '                <input id="website" name="website" type="url" class="validate" pattern="https://.*" maxlength="256">\n' +
        '                <label for="website">Website</label>\n' +
        '                <span class="helper-text" data-error="Wrong (must be a valid URL)" data-success="Right"></span>\n' +
        '            </div>\n' +
        '        </div>\n' +
        '        <div class="row">\n' +
        '            <div class="col s6">\n' +
        '                <button class="btn" name="create" type="submit">\n' +
        '                    <i class="material-icons left">add_subcontractor</i>Create\n' +
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

    checkScreen();

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
                '    <h3 class="header">Edit subcontractor</h3>\n' +
                '    <form id="editsubcontractor">\n' +
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
                '                <i class="material-icons prefix">http</i>\n' +
                '                <input id="website" name="website" type="text" class="validate" pattern="https://.*" maxlength="256" value="' + (data.data.website ?? '') + '">\n' +
                '                <label for="website" class="active">Website</label>\n' +
                '                <span class="helper-text" data-error="Wrong (must be a valid URL)" data-success="Right"></span>\n' +
                '            </div>\n' +
                '        </div>\n' +
                '        <div class="row">\n' +
                '            <div class="col s6">\n' +
                '                <button type="submit" class="btn" name="save">\n' +
                '                    <i class="material-icons left">save</i>Save\n' +
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
        complete: function() {
            checkScreen();
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
    showLoader();

    $('div#content').html(
        '    <h3 class="header">New user</h3>\n' +
        '    <form id="newuser">\n' +
        '        <div class="row">\n' +
        '            <div class="input-field col s12">\n' +
        '                <i class="material-icons prefix">man</i>\n' +
        '                <select id="user_type_select">\n' +
        '                    <option value="Dobro">Dobro</option>\n' +
        '                    <option value="Owner">Owner</option>\n' +
        '                    <option value="Contractor">Contractor</option>\n' +
        '                    <option value="Subcontractor">Subcontractor</option>\n' +
        '                </select>\n' +
        '                <label>Type</label>\n' +
        '            </div>\n' +
        '        </div>\n' +
        '        <div class="row">\n' +
        '            <div class="input-field col s12">\n' +
        '                <i class="material-icons prefix">email</i>\n' +
        '                <input id="email" name="email" type="email" class="validate" required aria-required="true" minlength="3" maxlength="128">\n' +
        '                <label for="email">Email</label>\n' +
        '                <span class="helper-text" data-error="Wrong (min 3 and max 128 characters)" data-success="Right"></span>\n' +
        '            </div>\n' +
        '        </div>\n' +
        '        <div class="row">\n' +
        '            <div class="input-field col s12">\n' +
        '                <i class="material-icons prefix">fingerprint</i>\n' +
        '                <input id="password" name="password" type="password" class="validate" required aria-required="true" minlength="3" maxlength="128">\n' +
        '                <label for="password">Password</label>\n' +
        '                <span class="helper-text" id="password_errors" style="color: #F44336;"></span>\n' +
        '            </div>\n' +
        '        </div>\n' +
        '        <div class="row">\n' +
        '            <div class="input-field col s12">\n' +
        '                <i class="material-icons prefix">refresh</i>\n' +
        '                <input id="confirmpassword" name="confirmpassword" type="password" class="validate" required aria-required="true" minlength="3" maxlength="128">\n' +
        '                <label for="confirmpassword">Confirm password</label>\n' +
        '            </div>\n' +
        '        </div>\n' +
        '        <div class="row">\n' +
        '            <div class="input-field col s12">\n' +
        '               <div class="switch">\n' +
        '                   <label>\n' +
        '                       Admin\n' +
        '                       <input type="checkbox" id="adminrole">\n' +
        '                       <span class="lever"></span>\n' +
        '                   </label>\n' +
        '               </div>\n' +
        '            </div>\n' +
        '        </div>\n' +
        '        <div class="row">\n' +
        '            <div class="col s6">\n' +
        '                <button class="btn" name="create" type="submit">\n' +
        '                    <i class="material-icons">person_add</i>Create\n' +
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
                '    <h3 class="header">Edit user</h3>\n' +
                '    <form id="edituser">\n' +
                '        <div class="row">\n' +
                '            <div class="input-field col s12">\n' +
                '                <i class="material-icons prefix disabled">numbers</i>\n' +
                '                <input disabled id="id" name="id" type="text" value="' + data.data.id + '">\n' +
                '                <label for="id" class="active">Id</label>\n' +
                '            </div>\n' +
                '        </div>\n' +
                '        <div class="row">\n' +
                '            <div class="input-field col s12">\n' +
                '                <i class="material-icons prefix">email</i>\n' +
                '                <input id="email" name="email" type="email" class="validate" required aria-required="true" minlength="3" maxlength="128" value="' + data.data.email + '">\n' +
                '                <label for="name" class="active">Email</label>\n' +
                '                <span class="helper-text" data-error="Wrong (min 3 and max 128 characters)" data-success="Right"></span>\n' +
                '            </div>\n' +
                '        </div>\n' +
                '        <div class="row">\n' +
                '            <div class="input-field col s12">\n' +
                '                <i class="material-icons prefix">fingerprint</i>\n' +
                '                <input id="password" name="password" type="password" class="validate" required aria-required="true" minlength="3" maxlength="128">\n' +
                '                <label for="password" class="active">New password</label>\n' +
                '                <span class="helper-text" id="errors" style="color: #F44336;"></span>\n' +
                '            </div>\n' +
                '        </div>\n' +
                '        <div class="row">\n' +
                '            <div class="input-field col s12">\n' +
                '                <i class="material-icons prefix">refresh</i>\n' +
                '                <input id="confirmpassword" name="confirmpassword" type="password" class="validate" required aria-required="true" minlength="3" maxlength="128">\n' +
                '                <label for="confirmpassword" class="active">Confirm new password</label>\n' +
                '            </div>\n' +
                '        </div>\n' +
                '        <div class="row">\n' +
                '            <div class="input-field col s12">\n' +
                '               <div class="switch">\n' +
                '                   <label>\n' +
                '                       Admin\n' +
                '                       <input type="checkbox" id="adminrole"' + (data.data.admin ? ' checked="checked"' : '') + '>\n' +
                '                       <span class="lever"></span>\n' +
                '                   </label>\n' +
                '               </div>\n' +
                '            </div>\n' +
                '        </div>\n' +
                '        <div class="row">\n' +
                '            <div class="col s6">\n' +
                '                <button class="btn" name="create" type="submit">\n' +
                '                    <i class="material-icons">person_add</i>Create\n' +
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

            $("form#edituser button[name='cancel']").click(
                function(event) {
                    event.preventDefault();
                    loadAddressesPage();
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
        complete: function() {
            checkScreen();
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

/**
 * #################################################
 */
