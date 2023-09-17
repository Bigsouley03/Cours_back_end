<?php

namespace App\Http\Controllers;

use App\Models\ProgramUe;
use Illuminate\Http\Request;

class ProgramUeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $programUes = ProgramUe::with('table_ue','module')->get();
        return response()->json($programUes, 200);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'table_ue_id' => 'required|exists:table_ues,id',
            'module_id' => 'required|exists:modules,id',

        ]);

        $programUe = ProgramUe::create($data);

        return response()->json($programUe, 201);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $programUe = ProgramUe::with('module_id','table_ue_id')->find($id);
        return response()->json($programUe, 200);
    }

    /**
     * Update the specified resource in storage.
     */




    public function update(Request $request, ProgramUe $programUe)
    {
        $data = $request->validate([
            'table_ue_id' => 'exists:table_ues,id',
            'classe_id' => 'exists:classes,id',
        ]);

        $programUe->update($data);

        return response()->json($programUe, 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(ProgramUe $programUe)
    {
        $programUe->delete();

        return response()->json(['message' => 'ProgramUe deleted'], 204);
    }
}

