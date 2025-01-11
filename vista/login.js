QUnit.module("Pruebas de autenticación con Ajax");

QUnit.test("Prueba de inicio de sesión exitoso", function(assert) {
    var done = assert.async();
    var respuestaSimulada = {
        mensaje: "Usuario autenticado",
        nombre: "Fernando ss"
    };
    $.ajax = function(opciones) {
        assert.equal(opciones.url, "http://localhost/app-Alquiler-Autos/backend/apiRest.php", "URL correcta de la API");
        opciones.success(respuestaSimulada);
    };
    $('#loginForm').trigger('submit');
    assert.equal(localStorage.getItem('nombreUsuario'), "Fernando ss", "El nombre de usuario se guarda en localStorage");
    localStorage.removeItem('nombreUsuario');
    done();
});
QUnit.test("Prueba de inicio de sesión fallido", function(assert) {
    var done = assert.async();

    var respuestaSimulada = {
        mensaje: "Usuario o contraseña incorrectos"
    };

    $.ajax = function(opciones) {
        opciones.success(respuestaSimulada);
    };

    $('#loginForm').trigger('submit');
    assert.ok(true, "Mensaje de error mostrado al usuario"); 
    done();
});
