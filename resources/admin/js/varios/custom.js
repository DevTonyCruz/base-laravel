export function mostrar_password() {
    var cambio = document.getElementById("password");
    if (cambio.type == "password") {
        cambio.type = "text";
        $('.view-password i').removeClass('mdi-eye-off-outline').addClass('mdi-eye-outline');
    } else {
        cambio.type = "password";
        $('.view-password i').removeClass('mdi-eye-outline').addClass('mdi-eye-off-outline');
    }
}

export function modal_permissions() {
    $('#modal-permiso').modal();
}

export function modal_errors() {
    $('#modal-error').modal();
}

$('#select-all').click(function(event) {

    if (this.checked) {
        $(':checkbox').each(function() {
            this.checked = true;
        });
    } else {
        $(':checkbox').each(function() {
            this.checked = false;
        });
    }
});


export function string_to_slug (str) {
    str = str.replace(/^\s+|\s+$/g, ''); // trim
    str = str.toLowerCase();
  
    // remove accents, swap ñ for n, etc
    var from = "àáäâèéëêìíïîòóöôùúüûñç·/_,:;";
    var to   = "aaaaeeeeiiiioooouuuunc------";
    for (var i=0, l=from.length ; i<l ; i++) {
        str = str.replace(new RegExp(from.charAt(i), 'g'), to.charAt(i));
    }

    str = str.replace(/[^a-z0-9 -]/g, '') // remove invalid chars
        .replace(/\s+/g, '-') // collapse whitespace and replace by -
        .replace(/-+/g, '-'); // collapse dashes

    return str;
}