<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreCoursDeroulerRequest;
use App\Http\Requests\UpdateCoursDeroulerRequest;
use App\Models\CoursDerouler;
use App\Models\CoursEnroller;
use Illuminate\Http\Request;

class CoursDeroulerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $coursDeroulers = CoursDerouler::with('cours_enroller_id')->get();
        return response()->json([
            'cours' => $coursDeroulers
        ]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    // Créer un nouveau coursDerouler avec les données de la requête
    $coursDerouler = CoursDerouler::create($request->all());

    // Sauvegarder le nombre d'heures déroulées envoyées dans la requête
    $heureDeroule = $coursDerouler->nombreHeure;

    // Récupérer le coursEnroller lié
    $coursEnroller = CoursEnroller::findOrFail($coursDerouler->cours_enroller_id);

    // Récupérer l'ancien nombre d'heures déroulées
    $ancienNombreHeure = $coursEnroller->heureDeroule;

    // Calculer le nouveau nombre d'heures déroulées
    $nouveauHeureDeroule = $heureDeroule + $ancienNombreHeure;

    // Mettre à jour le champ "heureDeroule" dans le coursEnroller
    $coursEnroller->heureDeroule = $nouveauHeureDeroule;

    // Mettre à jour le champ "heureRestant" dans le coursEnroller
    $coursEnroller->heureRestant = $coursEnroller->heureTotal - $coursEnroller->heureDeroule;

    // Sauvegarder les changements dans le coursEnroller
    $coursEnroller->save();

    return response()->json([
        'message' => 'Le cours déroulé a été créé avec succès',
        'cours_derouler' => $coursDerouler
    ]);
}

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $coursD = CoursDerouler::with('cours_enroller_id')->find($id);



        if (!$coursD){
            return response()->json([
                'message'=> 'Cours non trouvé'
            ],404);
        }
        return response()->json($coursD, 200);
    }

    /**
     * Update the specified resource in storage.
     */

    public function update(Request $request, $coursDeroulerId)
        {
        // Récupérer le coursDerouler
        $coursDerouler = CoursDerouler::findOrFail($coursDeroulerId);

        // Mettre à jour le coursDerouler avec les nouvelles données de la requête
        $coursDerouler->update($request->all());

        // Sauvegarder le nombre d'heures déroulées envoyées dans la requête
        $nouveauNombreHeure = $request->input('nombreHeure');

        // Récupérer le coursEnroller lié
        $coursEnroller = CoursEnroller::findOrFail($coursDerouler->cours_enroller_id);

        // Récupérer l'ancien nombre d'heures déroulées
        $heureTotal = $coursEnroller->heureTotal;

        $ancienNombreHeure = $coursEnroller->heureDeroule;
        $heureDeroule=$coursDerouler->nombreHeure;
        $nouveauHeureDeroule = $heureDeroule + $ancienNombreHeure;


        // Mettre à jour le champ "heureDeroule" dans le coursEnroller
        $coursEnroller->heureDeroule = $nouveauHeureDeroule;

        // Mettre à jour le champ "heureRestant" dans le coursEnroller
        $coursEnroller->heureRestant = $coursEnroller->heureTotal - $coursEnroller->heureDeroule;

        // Sauvegarder les changements dans le coursEnroller
        $coursEnroller->save();

        return response()->json([
            'message'=>'le cours deroulé a été modifié avec succés',
            'cours_derouler'=>$coursDerouler
            ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $coursD = CoursDerouler::find($id);

        if (!$coursD) {
            return response()->json(['message' => 'Cours introuvable'], 404);
        }

        // Supprimer l'article
        $coursD->delete();

        return response()->json(['message' => 'Cours supprimé avec succès'], 200);
    }
}
