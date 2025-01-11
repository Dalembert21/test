    QUnit.test("Registro con datos correctos", function(assert) {
        const done = assert.async();
        const formData = {
            nombre_Registro: "Juan",
            apellido_Registro: "Pérez",
            correo_Registro: "juan@gmail.com",
            clave_Registro: "123"
        };
        $.ajax = function(options) {
            assert.equal(options.type, "POST", "El método HTTP debería ser POST");
            assert.equal(options.url, "http://localhost/app-Alquiler-Autos/backend/apiRest.php", "La URL debería ser la correcta");
            options.success({ mensaje: 'Usuario creado exitosamente' });
            done();
        };
        $('#registroForm').trigger('submit');
    });
    /*
    QUnit.test("Registro con datos incompletos", function(assert) {
        const done = assert.async();
        const formData = {
            nombre_Registro: "", 
            apellido_Registro: "Pérez",
            correo_Registro: "juan@gmail.com",
            clave_Registro: "123"
        };
        $.ajax = function(options) {
            assert.equal(options.type, "POST", "El método HTTP debería ser POST");
            options.error(null, 'error', 'Faltan campos obligatorios');
            done();
        };
        $('#registroForm').trigger('submit');
    });

    QUnit.test("Registro con datos erróneos", function(assert) {
        const done = assert.async();
        const formData = {
            nombre_Registro: "Juan",
            apellido_Registro: "Pérez",
            correo_Registro: "correo_invalido", 
            clave_Registro: "123"
        };

        $.ajax = function(options) {
            assert.equal(options.type, "POST", "El método HTTP debería ser POST");
            options.error(null, 'error', 'Formato de correo inválido');

            done();
        };
        $('#registroForm').trigger('submit');
    });

    QUnit.test("Registro con datos vacios", function(assert) {
        const done = assert.async();
        const formData = {
            nombre_Registro: "",
            apellido_Registro: "",
            correo_Registro: "", 
            clave_Registro: ""
        };

        $.ajax = function(options) {
            assert.equal(options.type, "POST", "El método HTTP debería ser POST");
            options.error(null, 'error', 'Campos vacios');

            done();
        };
        $('#registroForm').trigger('submit');
    });*/

    
