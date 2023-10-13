<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Program_module;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class Program_moduleController extends Controller
{
    public function index()
    {
        // Récupérer tous les ProgramUe avec leurs modules associés, ainsi que les classes et tables_ue correspondantes
        $programUes = Program_module::with('modules')->get();

        // Retourner la réponse JSON
        return response()->json($programUes, 200);
    }

    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'table_ue_id' => 'required',
            'classe_id' => 'required',
            'module_id' => 'required|array', // Change 'module_id' to 'modules'
        ]);

        if ($validator->fails()) {
            return response()->json(['error' => $validator->errors()], 400);
        }

        $programModule = Program_module::create([
            'table_ue_id' => $request->input('table_ue_id'),
            'classe_id' => $request->input('classe_id'),
        ]);

        // Attach modules to the program module
        $programModule->modules()->sync($request->input('module_id')); // Change to 'module_id'

        return response()->json(['programModule' => $programModule], 201);
    }

    public function show(Program_module $programUe)
    {
        // Charger les relations 'modules', 'classe', et 'table_ue' du ProgramUe
        $programUe->load('modules', 'classe', 'table_ue');

        // Retourner une réponse JSON avec les données du ProgramUe
        return response()->json($programUe, 200);
    }

    public function update(Request $request, Program_module $programUe)
    {
        // Valider les données de la requête
        $request->validate([
            'table_ue_id' => 'required',
            'classe_id' => 'required',
            'modules' => 'array', // Assurez-vous que le champ 'modules' est un tableau
        ]);

        // Mettre à jour les propriétés du ProgramUe avec les données de la requête
        $programUe->update([
            'table_ue_id' => $request->input('table_ue_id'),
            'classe_id' => $request->input('classe_id'),
        ]);

        // Mettre à jour les modules associés au ProgramUe à partir du tableau
        $programUe->modules()->sync($request->input('modules'));

        // Rafraîchir le modèle pour obtenir les relations mises à jour
        $programUe->load('modules', 'classe', 'table_ue');

        // Retourner une réponse JSON pour indiquer que le ProgramUe a été mis à jour avec succès
        return response()->json($programUe, 200);
    }

    public function showModulesByUeId($ueId)
    {
        // Récupérer les modules associés à un ProgramUe spécifique par son ID
        $programUe = Program_module::with('modules')->find($ueId);

        if (!$programUe) {
            return response()->json(['message' => 'ProgramUe non trouvé'], 404);
        }

        // Retourner une réponse JSON avec les modules associés
        return response()->json($programUe->modules, 200);
    }
    public function showModulesByUeAndClass($ueId, $classId)
{
    // Récupérer les modules associés à un ProgramUe spécifique par son ID et sa classe
    $programModule = Program_module::where('table_ue_id', $ueId)
        ->where('classe_id', $classId)
        ->with('modules')
        ->first();

    if (!$programModule) {
        return response()->json(['message' => 'ProgramUe non trouvé'], 404);
    }

    // Retourner une réponse JSON avec les modules associés
    return response()->json($programModule->modules, 200);
}


    public function destroy(Program_module $programUe)
    {
        // Supprimer le ProgramUe
        $programUe->delete();

        // Retourner une réponse JSON pour indiquer que le ProgramUe a été supprimé avec succès
        return response()->json(['message' => 'ProgramUe supprimé avec succès'], 200);
    }
}
