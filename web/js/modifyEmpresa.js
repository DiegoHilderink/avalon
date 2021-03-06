var user;
var urlUserAuth;
var urlSend;
var urlEmpSend;
var urlUserMod;
var urlEmpSearch;
var urlPais;

var nombre = '',
    pais = 'Eliga un país',
    titulo = 'Crear empresa',
    btn = 'Crear';

var paises = [];
var hrefUser = $('#comfirmDeleteUser').attr('href');

function setter(id, url1, url2, url3, url4, url5, url6) {
    user = id;
    urlUserAuth = url1;
    urlSend = url2;
    urlEmpSend = url3;
    urlPais = url4;
    urlEmpSearch = url5;
    urlUserMod = url6;
}

function getPaises(url, id) {
    $.ajax({
        method: 'GET',
        url: url,
        data: {},
        success: function (data) {
            var k = 0;
            while (k < data.length) {
                $(id).append(
                    "<option value='" + (k + 1) + "'>" + data[k].nombre + "</option>"
                )
                k++;
            }
        },
    })
}

$('#comfirmDeleteUser').removeAttr('href');

$('#deleteUser').change(() => {
    if ($('#deleteUser').val() === nombre) {
        $('#comfirmDeleteUser').attr('href', hrefUser);
    } else {
        $('#comfirmDeleteUser').removeAttr('href');
    }
})

arr = {
    '#modificar-imagen': '#setImg'
}

$.each(arr, (k, v) => {
    $(k).change(function () {
        var input = this;
        var url = $(this).val();
        var ext = url.substring(url.lastIndexOf('.') + 1).toLowerCase();
        if (input.files && input.files[0] && (ext == 'gif' || ext == 'png' || ext == 'jpeg' || ext == 'jpg')) {
            var reader = new FileReader();

            reader.onload = function (e) {
                $(v).attr('src', e.target.result);
            }
            reader.readAsDataURL(input.files[0]);
        } else {
            $(v).attr('src', '/assets/no_preview.png');
        }
    });
})

function sendClave(id, url, user) {
    $(id).click(() => {
        $.ajax({
            method: 'GET',
            url: url,
            data: {
                id: user,
                clave: $('#claveEmp').val(),
            },
            success: function (data) {
                showForm('create');
                sendEmpData('#sendata', urlEmpSend, user)
            },
        })
    });
}

function getUser(id, url) {
    $.ajax({
        method: 'GET',
        url: url,
        data: {
            entidad: id,
        },
        success: function (data) {
            if (!data) {
                showForm('auth');
            } else {
                getEmp(id, urlEmpSearch)
            }
        },
    })
}

function sendEmpData(id, url, user) {
    $(id).click(() => {
        $.ajax({
            method: 'GET',
            url: url,
            data: {
                id: user,
                name: $('#nombreEmp').val(),
                pais_id: $('#paisEmp').val(),
            }
        })
    })
}

function showForm(opc, emp = null) {
    $('#formEmp').empty();

    switch (opc) {
        case 'auth':
            $('#formEmp').append(
                `<section class="border rounded p-3">
                    <h2>Confirmación de usuarios</h2>
                    <p>Esto no es más que una medida de seguridad.</p>
                    <form>
                        <div class="form-group">
                            <label for="claveEmp">Clave</label>
                            <input type="text" class="form-control" id="claveEmp" aria-describedby="claveInfo" placeholder="Ingresa la clave que ha sido envada a tu correo">
                            <small id="claveInfo" class="form-text text-muted">
                                Para tener acceso a la creación de una empresa, primero debe confirmar su cuenta mediante la clave que le fué enviada a su correo.
                            </small>
                        </div>
                        <a class="btn btn-dark text-white" id="senclave">Enviar</a>
                    </form>
                </section>`
            );
            sendClave('#senclave', urlSend, user);
            break;
        case 'create':
            if (emp != null) {
                nombre = emp[0];
                pais = emp[1];
                titulo = 'Modificar empresa';
                btn = 'Cambiar';
            }

            $('#formEmp').append(`
            <section class="border rounded p-3">
                <h2 class="border-bottom">${titulo} <i class="fas fa-cog" style='font-size: 20px;' id="unlock"></i></h2>
                <form>
                    <div class='form-group' id='nombreEmpSec'>
                        <label for='nombreEmp' class='ml-2'>Nombre de la empresa</label>
                        <input type='text' class='form-control' id='nombreEmp' aria-describedby='nombreInfo' placeholder='${nombre}'>
                        <small id='nombreInfo' class='form-text text-muted'>
                            Este será el nombre que lo identifique como empresa.
                        </small>
                    </div>
                    <div class='form-group' class='ml-2' id='paisEmpSec'>
                        <label for='paisEmp'>Pais</label>
                        <select class='form-control ' id='paisEmp'>
                            <option>${pais}</option>
                        </select>
                    </div>
                    <a class='btn btn-dark text-white' id='sendata'>${btn}</a>
                </form>
                </section>`);
            getPaises(urlPais, '#paisEmp');
            break;
        default:
            console.error('Fail forms')
    }
}

function getEmp(id, url) {
    $.ajax({
        method: 'GET',
        url: url,
        data: {
            entidad: id,
        },
        success: function (data) {
            if (data) {
                showForm('create', data)
                sendEmpData('#sendata', urlEmpSend, id)
                ableProp('#nombreEmp');
                ableProp('#paisEmp');
            } else {
                showForm('auth');
            }
        },
    })
}

function ableProp(id) {
    var aux = true;
    $(id).prop('disabled', true);
    $(id).addClass('border-0')
    $('#unlock').click(() => {
        if (aux) {
            $(id).prop('disabled', false);
            $(id).removeClass('border-0')
        } else {
            $(id).prop('disabled', true);
            $(id).addClass('border-0')
        }
        aux = !aux;
    })

}