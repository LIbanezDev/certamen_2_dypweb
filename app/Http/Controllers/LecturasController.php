<?php

namespace App\Http\Controllers;

use App\Models\Lectura;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class LecturasController extends Controller
{
    public function getAll(Request $request): \Illuminate\Support\Collection
    {
        $filtros = $request->all();
        $data = DB::table('lecturas');
        if (isset($filtros['medidor']) && $filtros['medidor'] != 0) {
            $data->where('medidor', $filtros['medidor']);
        }
        return $data->get();
    }

    public function getViewWithLecturas() {
        $mediciones = Lectura::all();
        return view('mediciones', compact('mediciones'));
    }

    public function createOne(Request $request) {
        try {
            $data = $request->all();
            $lectura = new Lectura();
            $lectura->fecha = $data['fecha'];
            $lectura->direccion = $data['direccion'];
            $lectura->hora = $data['hora'];
            $lectura->medidor = $data['medidor'];
            $lectura->valor = $data['valor'];
            $lectura->tipo_medida = $data['tipo_medida'];
            $lectura->save();
            return response(['msg' => 'Registro creado exitosamente'], 201);
        } catch (\Exception $exception) {
            return response(['msg' => 'Revise los campos'], 400);
        }
    }

    public function deleteOne($id) {
        try {
            $lectura = Lectura::findOrFail($id);
            $lectura->delete();
            return ['msg' => 'Registro eliminado exitosamente'];
        } catch (\Exception $exception) {
            return response(['msg' => 'Registro no encontrado'], 404);
        }
    }
}
