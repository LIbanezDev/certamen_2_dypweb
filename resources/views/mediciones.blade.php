@extends('layout.base')
@section('contenido')
    <div class="row justify-content-center">
        <div class="col-6">
            <h1 class="text-center mb-3"> Listado de Mediciones </h1>
            <div class="mb-3">
                <label for="select-medidor"> Filtrar por medidor </label>
                <select id="select-medidor" class="form-select">
                    <option value="0" selected>Todos</option>
                    <option value="1" >1</option>
                    <option value="2" >2</option>
                    <option value="3" >3</option>
                    <option value="4" >4</option>
                    <option value="5" >5</option>
                    <option value="6" >6</option>
                    <option value="7" >7</option>
                    <option value="8" >8</option>
                    <option value="9" >9</option>
                    <option value="10">10</option>
                </select>
            </div>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">Fecha</th>
                    <th scope="col">Hora</th>
                    <th scope="col">Medidor</th>
                    <th scope="col">Valor</th>
                    <th scope="col">Acciones</th>
                </tr>
                </thead>
                <tbody id="mediciones-container">
                @foreach($mediciones as $medicion)
                    <tr>
                        <th scope="row">{{$medicion->fecha}}</th>
                        <td>{{$medicion->hora}}</td>
                        <td>{{$medicion->medidor}}</td>
                        <td>
                            {{$medicion->valor}} <strong> {{$medicion->tipo_medida}} </strong>
                            @if($medicion->tipo_medida == 'C')
                                @if($medicion->valor > 50)
                                    <i class="fas fa-fire text-danger"></i>
                                @endif
                            @endif
                        </td>
                        <td>
                            <button class="btn btn-danger" onclick="deleteMedicion(this, {{$medicion->id}})"> Eliminar
                            </button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
@section('javascript')
    const medicionesContainer = document.getElementById('mediciones-container');
    const selectMedidor = document.getElementById('select-medidor');

    selectMedidor.addEventListener('change', async () => {
        medicionesContainer.innerHTML = '';
        const {data} = await axios.get(`/api/lecturas?medidor=${parseInt(selectMedidor.value)}`)
        data.forEach(lectura => {
            medicionesContainer.innerHTML += `
                <tr>
                    <th scope="row">${lectura.fecha}</th>
                    <td>${lectura.hora}</td>
                    <td>${lectura.medidor}</td>
                    <td>
                        ${lectura.valor} <strong> ${lectura.tipo_medida} </strong>
                        ${
                            lectura.tipo_medida === 'C' ? (lectura.valor > 60 ? '<i class="fas fa-fire text-danger"></i>' : '') : ''
                        }
                    </td>
                    <td>
                        <button class="btn btn-danger" onclick="deleteMedicion(this, ${lectura.id})"> Eliminar</button>
                    </td>
                </tr>
                `
            }
        )
    })

    const deleteMedicion = async (event, id) => {
        const alertResponse = await Swal.fire({title:"¿Esta seguro de eliminar esta medicion?", text:"Esta operacion es irreversible", icon:"error", showCancelButton:true});
        if (alertResponse) {
            const {status} = await axios.delete(`/api/lecturas/${id}`)
            if (status === 200) {
                event.parentElement.parentElement.remove(); // removing table row
                return Swal.fire("Medicion eliminada", "Medicion eliminada exitosamente", "info");
            }
            Swal.fire("Error", "Hubo un error al procesar la peticion, intente mas tarde", "error");
       }
    }


@endsection
