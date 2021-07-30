@extends('layout.base')
@section('contenido')
    <div class="row justify-content-center">
        <div class="col-6">
            <h2 class="text-center"> Registrar lectura </h2>
            <form autocomplete="off" id="form-agregar-lectura">
                <div class="mb-3">
                    <div class="form-group">
                        <label for="fecha-input">Fecha</label>
                        <input required type="date" class="form-control" id="fecha-input">
                    </div>
                </div>
                <div class="mb-3">
                    <div class="form-group">
                        <label for="hora-input">Hora</label>
                        <input required type="text" class="form-control" id="hora-input" aria-describedby="horaHelp">
                        <small id="horaHelp" class="form-text text-muted">Debe ser en formato HH:mm. </small>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="form-group">
                        <label for="select-medidor"> Medidor </label>
                        <select required id="select-medidor" class="form-select">
                            <option selected>Seleccionar medidor</option>
                        </select>
                    </div>
                </div>
                <div class="mb-3">
                    <div class="form-group">
                        <label for="direccion-input">Direccion</label>
                        <input required type="text" class="form-control" id="direccion-input">
                    </div>
                </div>
                <div class="mb-3">
                    <div class="form-group">
                        <label for="valor-input">Valor</label>
                        <input required type="number" class="form-control" id="valor-input" min="0" max="500">
                    </div>
                </div>
                <div class="mb-3">
                    <div class="form-group">
                        <label for="select-tipo"> Tipo de Medida </label>
                        <select required id="select-tipo" class="form-select">
                            <option selected>Seleccionar tipo de medida</option>
                            <option value="kW">Kilowatts</option>
                            <option value="W">Watts</option>
                            <option value="C">Temperatura</option>
                        </select>
                    </div>
                </div>
                <button type="submit" id="btn-submit" class="btn btn-primary">Agregar</button>
            </form>
        </div>
    </div>
@endsection
@section('javascript')
    const selectMedidor = document.getElementById('select-medidor')
    const formAgregarLectura = document.getElementById('form-agregar-lectura')
    const horaInput = document.getElementById('hora-input');
    const fechaInput = document.getElementById('fecha-input');
    const valorInput = document.getElementById('valor-input');
    const direccionInput = document.getElementById('direccion-input');
    const tipoMedidaSelect = document.getElementById('select-tipo')
    const medidorSelect = document.getElementById('select-medidor')
    const btnSubmit = document.getElementById('btn-submit');

    formAgregarLectura.addEventListener('submit', async (evt) => {
        evt.preventDefault();
        btnSubmit.innerHTML = `<span class="spinner-border spinner-border-sm" role="status" aria-hidden="true"></span>
                                <span class="sr-only">Loading...</span>`
        if (validarFormulario()) {
                const body = {
                    fecha: fechaInput.value,
                    hora: horaInput.value,
                    direccion: direccionInput.value,
                    medidor: parseInt(medidorSelect.value),
                    valor: parseInt(valorInput.value),
                    tipo_medida: tipoMedidaSelect.value
                }
                const {status} = await axios.post('/api/lecturas',body)
                if (status === 201) {
                    window.location.href = '/mediciones';
                } else {
                    Swal.fire({
                        title: 'Intente nuevamente',
                        text: 'Hubo en error al agregar lectura',
                        timer: 3000,
                        timerProgressBar: true,
                        showCloseButton: true
                    })
                }
        }
        btnSubmit.innerHTML = 'Agregar'
    })

    const validarFormulario = () => {
        try {
            const [hora, minuto] = horaInput.value.split(':');
            if (hora.length === 2 && minuto.length === 2) return true;
            Swal.fire("Error", "La hora debe ser en formato HH:MM!!!!!", "error");
            return false;
        } catch (e) {
            Swal.fire("Error", "La hora debe ser en formato HH:MM!!!!!", "error");
            return false;
        }
    }

    const llenarMedidores = () => {
        for(let i = 1; i <= 10; i++) {
            selectMedidor.innerHTML += `<option value="${i}"> ${i}</option>`
        }
    }

    llenarMedidores();

@endsection
