export function AjaxJson(method, url, data = null) {

    var URL_WEB = $('meta[name="Urlapp"]').attr('content');

    let paramResponse =

        $.ajax({
            method: method,
            url: URL_WEB + '/' + url,
            dataType: 'json',
            data: data
        })
            .done(function (data) {
                return data;
            })
            .fail(function (jqXHR, error, errorThrown) {
                return jqXHR;
            });

    return paramResponse;

}

export function AjaxSimple(method, url, data = null) {

    var URL_WEB = $('meta[name="Urlapp"]').attr('content');

    let paramResponse =

        $.ajax({
            method: method,
            url: URL_WEB + '/' + url,
            data: data
        })
            .done(function (data) {
                return data;
            })
            .fail(function (jqXHR, error, errorThrown) {
                return jqXHR;
            });

    return paramResponse;
}