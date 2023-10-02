<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Objectif;
use App\Models\CoursEnroller; // Assurez-vous d'importer le modèle CoursEnroller

class ObjectifController extends Controller
{


    public function index()
    {
        // Récupérez les objectifs avec les données liées à la clef étrangère "cours_enroller_id"
        $objectifs = Objectif::with('cours_enroller_id')->get();

        return response()->json([
            'objectifs' => $objectifs
        ]);
    }
    public function getObjectifsByCoursE($coursEnrollerId)
{
    // Récupérez les objectifs liés au cours enroulé spécifié par son ID
    $objectifs = Objectif::where('cours_enroller_id', $coursEnrollerId)->get();

    return response()->json(['objectifs' => $objectifs]);
}
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'description' => 'required|string',
            'cours_enroller_id' => 'required|exists:cours_enrollers,id',
            'etat' => 'boolean',
        ]);

        $objectif = Objectif::create($validatedData);

        return response()->json(['message' => 'Objectif ajouté avec succès', 'objectif' => $objectif], 201);
    }

    public function update(Request $request, $id)
    {
        $objectif = Objectif::findOrFail($id);

        $validatedData = $request->validate([
            'description' => 'required|string',
            'atteint' => 'boolean',
        ]);

        $objectif->update($validatedData);

        return response()->json(['message' => 'Objectif mis à jour avec succès', 'objectif' => $objectif]);
    }

    public function destroy($id)
    {
        $objectif = Objectif::findOrFail($id);
        $objectif->delete();

        return response()->json(['message' => 'Objectif supprimé avec succès']);
    }


}
