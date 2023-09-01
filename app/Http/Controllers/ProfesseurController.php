<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProfRequest;
use App\Http\Requests\UpdateProfRequest;
use App\Models\Professeur;

use Illuminate\Http\Request;

class ProfesseurController extends Controller
{
    public function index()
    {
        $professeurs = Professeur::with('user_id')->get();
        return response()->json($professeurs);
    }

    public function store(StoreProfRequest $request)
    {
        $professeur = Professeur::create($request->all());

        return response()->json([
            'message' => "Professeur créé avec succés!",
            'Professeur' => $professeur
        ], 200);
    }


    public function show($id)
    {
        $professeur = Professeur::with('user_id')->find($id);

        if (!$professeur) {
            return response()->json(['message' => 'Professeur non trouvé.'], 404);
        }

        return response()->json($professeur);
    }

    public function update(UpdateProfRequest $request, $id)
    {
        $donnees= $request->all();
        $professeur= Professeur::findOrfail($id);
        $professeur->update($donnees);

        return response()->json([
            'message' => 'Professeur mis à jour avec succès.',
            'Professeur' => $professeur

        ]);
    }

    public function destroy($id)
    {
        $professeur = Professeur::find($id);

        if (!$professeur) {
            return response()->json(['message' => 'Professeur non trouvé.'], 404);
        }

        $professeur->delete();

        return response()->json(['message' => 'Professeur supprimé avec succès.']);
    }
}
