const d = document;
// editar registro
function edit(pilar_uuid){
    d.getElementById('form').onsubmit = function(e){
        if(! e.target.hasAttribute('data-form')){
            e.preventDefault();
            d.querySelector('.spinner-border').style.display = 'inline-block';
            d.getElementById('btnGuardar').setAttribute('disabled', true);
            d.querySelectorAll('[data-error="input"]').forEach( (el) =>{ el.classList.remove('is-invalid');  el.classList.remove('is-valid');});
            d.querySelectorAll('[data-error="span"]').forEach( (el) =>{ el.textContent = '' });
            axios.put('/pilares/'+ pilar_uuid,{
                nombre_pilar: d.getElementById('nombre_pilar').value,
                gestion_pilar: d.getElementById('gestion_pilar').value,
            })
            .then(function (resp){
                $('#modal').modal('hide');
                $('#pilares').DataTable().ajax.reload();
            })
            .catch(function (error){
            const objeto = error.response.data.errors; //creamos el objeto para luego recorrerlo
            if (error.response.data.hasOwnProperty('errors')) //preguntamos si exite la propiedad donde se almacenan los errores false/true
            {
                for (let key in  objeto) 
                {
                    d.getElementById(key).classList.add('is-invalid');
                    d.getElementById(key+'-error').textContent = objeto[key];
                }
            }
            })
        }   
    };
}

// eliminar registro
function delet(pilar_uuid){
    d.getElementById('form_delete').onsubmit = function(e){
        e.preventDefault();
        axios.delete('/pilares/'+ pilar_uuid)
        .then(function (resp){
            $('#modal_delete').modal('hide');
            $('#pilares').DataTable().ajax.reload();
        })
        .catch(function (error){
            console.log(error);
        })
    }
}

d.addEventListener('click', (e)=>{
    if(e.target.matches('#nuevo') || e.target.matches('#nuevo *')){
        d.querySelector('.spinner-border').style.display = 'none';
        d.getElementById('btnGuardar').removeAttribute('disabled');
        d.querySelectorAll('[data-error="input"]').forEach( (el) =>{ el.classList.remove('is-invalid');  el.classList.remove('is-valid');});
        d.querySelectorAll('[data-error="span"]').forEach( (el) =>{ el.textContent = '' });
        d.getElementById('form').setAttribute('data-form', '');
        d.querySelector('.modal-title').textContent = 'Registrar Nuevo Pilar';
        d.getElementById('form').reset();
        $("#modal").modal("show");
    
        const expresiones = {
        letra: /^[a-zA-ZÀ-ÿ\s]{1,40}$/, // Letras y espacios, pueden llevar acentos.
        numeros_digitos: /^\d{4}$/,
        }
    
        const validar_campo = (expresion, input, name) =>{
            if (expresion.test(input.value)){
                d.getElementById(name).classList.remove('is-invalid');
                d.getElementById(`${name}-error`).textContent = '';
                d.getElementById(name).classList.add('is-valid');
            } else {
                d.getElementById(name).classList.add('is-invalid');
                d.getElementById(`${name}-error`).textContent = `El campo ${name} no es admitido`;
            }
        }
    
        const validarform = (e)=>{
            const $input = e.target;
            switch ($input.name){
                case "nombre_pilar":
                    validar_campo(expresiones.letra, $input, $input.name)
                break;
                case "gestion_pilar":
                    validar_campo(expresiones.numeros_digitos, $input, $input.name)
                break;
            }
        }
    
        var inputs = d.querySelectorAll('#form *[data-required]');
        inputs.forEach((input)=>{
            input.addEventListener('keyup', validarform);
        });
    }

    if(e.target.matches('[data-edit]') || e.target.matches('[data-edit] *')){
        d.querySelector('.spinner-border').style.display = 'none';
        d.getElementById('btnGuardar').removeAttribute('disabled');
        d.getElementById('form').removeAttribute('data-form');
        d.querySelectorAll('[data-error="input"]').forEach( (el) =>{ el.classList.remove('is-invalid'); el.classList.remove('is-valid'); });
        d.querySelectorAll('[data-error="span"]').forEach( (el) =>{ el.textContent = '' });
        // let data = $('#pilares').DataTable().row($(this).parents('tr') ).data();
        let data = $('#pilares').DataTable().row($(e.target).parents('tr') ).data();

        let nombre_pilar = data['nombre_pilar'];
        let gestion_pilar = data['gestion_pilar'];
        d.getElementById('nombre_pilar').value = nombre_pilar;
        d.getElementById('gestion_pilar').value = gestion_pilar;
        d.querySelector('.modal-title').textContent = 'Editar Pilar';
        $("#modal").modal("show");
    }

    if(e.target.matches('[data-metas]')){
        let data = $('#pilares').DataTable().row($(e.target).parents('tr') ).data();
        let pilar_uuid = data.uuid;
        location.href='/pilares/'+pilar_uuid+'/metas'; //enviamos el id del pilar clickeado
    }

    if(e.target.matches('[data-delete]') || e.target.matches('[data-delete] *')){
        let data = $('#pilares').DataTable().row($(e.target).parents('tr') ).data();
        d.querySelector('.message').innerHTML = data.nombre_pilar;
        $('#modal_delete').modal('show');
    }

    if(e.target.matches('[data-directriz]') || e.target.matches('[data-directriz] *')){
        let iframepdf = d.getElementById('iframe_pdf');
        iframepdf.setAttribute('src', '/directriz_pdf');
        $('#modal_directriz').modal('show');
    }
})

//REGISTRAR NUEVO
d.addEventListener('submit', (e) =>{
    if(e.target.matches('#form')){
        e.preventDefault();
        d.querySelectorAll('[data-error="input"]').forEach( (el) => { el.classList.remove('is-invalid') });
        d.querySelectorAll('[data-error="span"]').forEach( (el) => { el.textContent = '' });
        let data = new FormData(e.target);
        // let inputs = d.querySelectorAll('#form [data-required]');
        if (e.target.hasAttribute('data-form'))
        {   //POST
            d.querySelector('.spinner-border').style.display = 'inline-block';
            d.getElementById('btnGuardar').setAttribute('disabled', true);
            axios.post('/pilares', data) //enviamos todos los input del form
            .then(function (response) {
                $('#modal').modal('hide');
                $('#pilares').DataTable().ajax.reload(null, false);
            })
            .catch(function (error) {
                d.querySelector('.spinner-border').style.display = 'none';
                d.getElementById('btnGuardar').removeAttribute('disabled');
                // console.log(error.response.data.errors);
                const objeto = error.response.data.errors; //creamos el objeto para luego recorrerlo
                if (error.response.data.hasOwnProperty('errors')) //preguntamos si exite la propiedad donde se almacenan los errores false/true
                {
                    for (let key in  objeto) 
                    {
                        //console.log(key);
                        //console.log(errores[key]);
                        //key nombre del campo ej. nombre_operacion
                        //objeto[key] valor ej. "El campo nombre operacion es obligatorio. SU VALOR"
                        d.getElementById(key).classList.add('is-invalid');
                        d.getElementById(key+'-error').textContent = objeto[key];
                    }
                }
            });
        }
    }
});