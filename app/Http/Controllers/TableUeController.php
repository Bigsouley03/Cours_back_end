<?php

namespace App\Http\Controllers;


use App\Models\TableUe;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class TableUeController extends Controller
{
    /**
     * Affiche la liste des ressources.
     */
    public function index()
    {
        $tableUes = TableUe::all();
        return response()->json($tableUes, 200);
    }

    /**
     * Stocke une nouvelle ressource dans la base de données.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nomUe' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $tableUe = new TableUe();
        $tableUe->nomUe = $request->input('nomUe');
        $tableUe->save();

        return response()->json($tableUe, 201);
    }

    /**
     * Affiche la ressource spécifiée.
     */
    public function show(TableUe $tableUe)
    {
        return response()->json($tableUe, 200);
    }

    /**
     * Met à jour la ressource spécifiée dans la base de données.
     */
    public function update(Request $request, TableUe $tableUe)
    {
        $validator = Validator::make($request->all(), [
            'nomUe' => 'required|string|max:255',
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $tableUe->nomUe = $request->input('nomUe');
        $tableUe->save();

        return response()->json($tableUe, 200);
    }

    /**
     * Supprime la ressource spécifiée de la base de données.
     */
    public function destroy(TableUe $tableUe)
    {
        $tableUe->delete();
        return response()->json(['message' => 'Ressource supprimée avec succès.'], 200);
    }
}
