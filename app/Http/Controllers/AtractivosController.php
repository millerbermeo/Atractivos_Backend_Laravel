<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Atractivo;


class AtractivosController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        try {
            $atractivo = Atractivo::Where('estado', 'activo')->get();
            return response()->json($atractivo, 200);
        } catch (\Exception $e) {
            return response()->json(["mensaje" => "informacion no procesada"]);
        }
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        try {
            // $user = Auth::user();
            // if ($user->rol == 'turista') {
            //     return response()->json(["mensaje" => "usuario no autorizado"], 401);
            // }

            $request -> validate([
                'nombre' => 'required',
                'descripcion' => 'required',
                'municipio' => 'required',
                'imagen' => 'required',
            ]);

            // $image = $request->file('imagen');
            // $nombreImagen = $image->getClientOriginalName();
            // $image -> move(public_path('images'), $nombreImagen);

            // $atractivo = Atractivo::create([
            //     'nombre' => $request->nombre,
            //     'descripcion' => $request->descripcion,
            //     'municipio' => $request->municipio,
            //     'imagen' => $nombreImagen,
            //     'estado' => 1
            // ]);

            
            $atractivo = Atractivo::create([
                'nombre' => $request->nombre,
                'descripcion' => $request->descripcion,
                'municipio' => $request->municipio,
                'imagen' => $request->imagen,
                'estado' => 1
            ]);

            $response = [
                'id' => $atractivo->id,
                'nombre' => $atractivo->nombre,
                'descripcion' => $atractivo->descripcion,
                'municipio' => $atractivo->municipio,
                'imagen' => $atractivo->imagen
            ];

            return response()->json($response, 201);

        } catch (\Exception $e) {
            return response()->json($e->getMessage());
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        try {
            $user = Auth::user();

        if ($user->role == 'adminstrador') {
            return response()->json(["mensaje" => "usuario no autorizado"], 401);
        }

        $atractivo = Atractivo::find($id);
        return response()->json($atractivo, 200);
        } catch (\Exception $e) {
            return response()->json(["mensaje" => "informacion no procesada"], 422);
        }

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        try {
            $user = Auth::user();

            if ($user->rol == 'turista') {
                return response()->json(["mensaje" => "usuario no autorizado"], 401);
            }

            $atractivo = Atractivo::find($id);

            $estado = $atractivo;
            $estado -> estado = 2;
            $estado -> save();

            return response()->json(["mensaje" => "Atractivo Turistico desactivado"], 200);

        }  catch (\Exception $e) {
            return response()->json(["mensaje" => "informacion no procesada"], 422);
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
