export function getStates(container) {

    RequestObject.AjaxJson('POST', 'sepomex/get-states').then(
        function (response) {

            $('#' + container + ' .state-data').empty();
            $('#' + container + ' .state-data').append('<option value="S">Seleccionar</option>');

            response.data.forEach(function (element) {
                $('#' + container + ' .state-data').append('<option value="' + element.state + '">' + element.state + '</option>');
            });

        },
        function (xhrObj, textStatus, err) {
            alert(err);
        });

}

export function getLocation(container, state) {

    $('#' + container + ' .location-data').removeAttr("disabled");

    const data = {
        state: state,
    }

    RequestObject.AjaxJson('POST', 'sepomex/get-location-by-state', data).then(
        function (response) {

            $('#' + container + ' .location-data').empty();
            $('#' + container + ' .location-data').append('<option value="S">Seleccionar</option>');

            $('#' + container + ' .colony-data').empty();
            $('#' + container + ' .colony-data').append('<option value="S">Seleccionar</option>');

            $('#' + container + ' .sepomex-id').val('');
            $('#' + container + ' .zip-code').val('');

            response.data.forEach(function (element) {
                $('#' + container + ' .location-data').append('<option value="' + element.location + '">' + element.location + '</option>');
            });

        },
        function (xhrObj, textStatus, err) {
            $('#' + container + ' .location-data').empty();
            $('#' + container + ' .location-data').append('<option value="S">Seleccionar</option>');
            $('#' + container + ' .colony-data').empty();
            $('#' + container + ' .colony-data').append('<option value="S">Seleccionar</option>');
        });
}

export function getColony(container, location) {

    $('#' + container + ' .colony-data').removeAttr("disabled");
    var state = $('#' + container + ' .state-data').val();

    const data = {
        'state': state,
        'location': location
    }

    RequestObject.AjaxJson('POST', 'sepomex/get-colonies-by-location-state', data).then(
        function (response) {

            $('#' + container + ' .colony-data').empty();
            $('#' + container + ' .colony-data').append('<option value="S">Seleccionar</option>');

            $('#' + container + ' .sepomex-id').val('');
            $('#' + container + ' .zip-code').val('');

            response.data.forEach(function (element) {
                $('#' + container + ' .colony-data').append('<option value="' + element.id + '">' + element.name + ' - ' + element.zip_code + '</option>');
            });

        },
        function (xhrObj, textStatus, err) {
            alert(err);
        });
}

export function getZipCode(container, sepomex_id) {

    const data = {
        'sepomex_id': sepomex_id
    }

    RequestObject.AjaxJson('POST', 'sepomex/get-zip-code', data).then(
        function (response) {

            $('#' + container + ' .zip-code').val(response.data.zip_code);
            $('#' + container + ' .sepomex-id').val(response.data.id);

        },
        function (xhrObj, textStatus, err) {
            alert(err);
        });

}

export function searchZip(container) {

    var zip_code = $('#' + container + ' .zip-code').val();
    $('#' + container + ' .sepomex-id').val('');

    if (zip_code.length == 5) {

        const data = {
            'zip_code': zip_code
        }

        RequestObject.AjaxJson('POST', 'sepomex/get-search-zip-code', data).then(
            function (response) {

                let state = response.data[0].state;
                let location = response.data[0].location;
                const colonies = response.data;

                $('#' + container + ' .state-data').val(state);

                const data = {
                    state: state,
                }

                RequestObject.AjaxJson('POST', 'sepomex/get-location-by-state', data).then(
                    function (response) {

                        $('#' + container + ' .location-data').removeAttr('disabled');
                        $('#' + container + ' .location-data').empty();
                        $('#' + container + ' .location-data').append('<option value="S">Seleccionar</option>');

                        response.data.forEach(function (element) {
                            $('#' + container + ' .location-data').append('<option value="' + element.location + '">' + element.location + '</option>');
                        });

                        $('#' + container + ' .location-data').val(location);

                        $('#' + container + ' .colony-data').removeAttr('disabled');
                        $('#' + container + ' .colony-data').empty();
                        $('#' + container + ' .colony-data').append('<option value="S">Seleccionar</option>');

                        colonies.forEach(function (element) {
                            $('#' + container + ' .colony-data').append('<option value="' + element.id + '">' + element.name + ' - ' + element.zip_code + '</option>');
                        });

                    },
                    function (xhrObj, textStatus, err) {
                        $('#' + container + ' .location-data').empty();
                        $('#' + container + ' .location-data').append('<option value="S">Seleccionar</option>');
                        $('#' + container + ' .colony-data').empty();
                        $('#' + container + ' .colony-data').append('<option value="S">Seleccionar</option>');
                    });

            },
            function (xhrObj, textStatus, err) {
                alert(err);
            });
    }

}

export function searchZipSelected(container, sepomex_id) { 
    
    var zip_code = $('#' + container + ' .zip-code').val();
    $('#' + container + ' .sepomex-id').val('');

    if (zip_code.length == 5) {

        const data = {
            'zip_code': zip_code
        }

        RequestObject.AjaxJson('POST', 'sepomex/get-search-zip-code', data).then(
            function(response) {

                let state = response.data[0].state;
                let location = response.data[0].location;
                const colonies = response.data;

                $('#' + container + ' .state-data').val(state);

                const data = {
                    state: state,
                }

                RequestObject.AjaxJson('POST', 'sepomex/get-location-by-state', data).then(
                    function(response) {

                        $('#' + container + ' .location-data').removeAttr('disabled');
                        $('#' + container + ' .location-data').empty();
                        $('#' + container + ' .location-data').append('<option value="S">Seleccionar</option>');

                        response.data.forEach(function(element) {
                            $('#' + container + ' .location-data').append('<option value="' + element.location + '">' + element.location + '</option>');
                        });

                        $('#' + container + ' .location-data').val(location);

                        $('#' + container + ' .colony-data').removeAttr('disabled');
                        $('#' + container + ' .colony-data').empty();
                        $('#' + container + ' .colony-data').append('<option value="S">Seleccionar</option>');

                        colonies.forEach(function(element) {
                            $('#' + container + ' .colony-data').append('<option value="' + element.id + '">' + element.name + ' - ' + element.zip_code + '</option>');
                        });

                        $('#' + container + ' .colony-data').val(sepomex_id);
                        $('#' + container + ' .sepomex-id').val(sepomex_id)

                    },
                    function(xhrObj, textStatus, err) {
                        $('#' + container + ' .location-data').empty();
                        $('#' + container + ' .location-data').append('<option value="S">Seleccionar</option>');
                        $('#' + container + ' .colony-data').empty();
                        $('#' + container + ' .colony-data').append('<option value="S">Seleccionar</option>');
                    });

            },
            function(xhrObj, textStatus, err) {
                alert(err);
            });
    }
}
