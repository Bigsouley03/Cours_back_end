<?php

namespace App\Http\Controllers;

use App\Models\Classe;
use Illuminate\Http\Request;
use App\Http\Requests\UpdateClasseRequest;
use App\Models\Etudiant;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class ClasseController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $classes = Classe::with('etudiant_id')->get();
        return response()->json([
            'classes' => $classes
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'className' => 'required|string',
            'etudiant_name' => 'required|string',
            'etudiant_email' => 'required|email|unique:users,email',
            'etudiant_password' => 'required|string|min:8,users,password',

        ]);

        // Créez un nouvel utilisateur
        $user = new User([
            'name' => $request->input('etudiant_name'),
            'email' => $request->input('etudiant_email'),
            'password' => Hash::make($request->input('etudiant_password')),
        ]);
        $user->save();

        // Créez un nouvel étudiant avec la clé étrangère user_id
        $etudiant = new Etudiant([
            'name' => $request->input('etudiant_name'),
            'user_id' => $user->id,
        ]);
        $etudiant->save();

        // Créez la classe en associant l'étudiant créé
        $classe = new Classe([
            'className' => $request->input('className'),
            'etudiant_id' => $etudiant->id,
        ]);
        $classe->save();

        return response()->json([
            'message' => "La classe a été créée avec succès"
        ], 201); // 201 Created
    }

    /**
     *
     * Display the specified resource.
     */
    public function show($id)
    {
        $classe = Classe::with('etudiant_id')->find($id);
        if (!$classe) {
            return response()->json([
                'message' => 'Classe non trouvé'
            ], 404);
        }
        return response()->json($classe, 200);

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateClasseRequest $request, $id,$etudiant_id)
    {
        $donnees = $request->all();
        $classe = Classe::findOrfail($id);
        $classe= Etudiant::findOrfail($etudiant_id);
        $classe->update($donnees);

        return response()->json([
            'status' => true,
            'message' => "La classe a ete modifiée avec succés",
            'classe' => $classe
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $classe = Classe::find($id);

        if (!$classe) {
            return response()->json(['message' => 'Classe introuvable'], 404);
        }

        // Supprimer l'article
        $classe->delete();

        return response()->json(['message' => 'Classe supprimé avec succès'], 200);
    }
}
