<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ProgramUe; // Assurez-vous d'importer le modèle ProgramUe approprié

class ProgramUeController extends Controller
{
    /**
     * Affiche la liste des ressources.
     */
    public function index(Request $request)
    {
        // Récupérez toutes les entrées de la table program_ues
        $programUes = ProgramUe::all();

        // Retournez les données sous forme de réponse JSON
        return response()->json($programUes);
    }

    /**
     * Stocke une nouvelle ressource dans la base de données.
     */
    public function store(Request $request)
    {
        // Validez les données du formulaire (vous pouvez ajouter des règles de validation ici)

        // Créez une nouvelle instance de ProgramUe
        $programUe = new ProgramUe;

        // Remplissez les propriétés du modèle avec les données du formulaire
        $programUe->table_ue_id = $request->input('table_ue_id');
        $programUe->classe_id = $request->input('classe_id');

        // Enregistrez la nouvelle ressource dans la base de données
        $programUe->save();

        // Retournez une réponse JSON indiquant que la ressource a été créée avec succès
        return response()->json(['message' => 'Ressource créée avec succès'], 201);
    }

    /**
     * Affiche la ressource spécifiée.
     */
    public function show($id)
    {
        // Recherchez la ressource par son ID
        $programUe = ProgramUe::find($id);

        // Vérifiez si la ressource existe
        if (!$programUe) {
            return response()->json(['message' => 'Ressource non trouvée'], 404);
        }

        // Retournez la ressource sous forme de réponse JSON
        return response()->json($programUe);
    }
    public function showUeByClassId($classeId)
{
    // Recherchez toutes les ressources ProgramUe ayant la classe_id correspondante
    $programUes = ProgramUe::where('classe_id', $classeId)->get();

    // Vérifiez si des ressources ont été trouvées
    if ($programUes->isEmpty()) {
        return response()->json(['message' => 'Aucune ressource trouvée pour cette classe'], 404);
    }

    // Retournez les ressources sous forme de réponse JSON
    return response()->json($programUes);
}
    /**
     * Met à jour la ressource spécifiée dans la base de données.
     */
    public function update(Request $request, $id)
    {
        // Recherchez la ressource par son ID
        $programUe = ProgramUe::find($id);

        // Vérifiez si la ressource existe
        if (!$programUe) {
            return response()->json(['message' => 'Ressource non trouvée'], 404);
        }

        // Validez les données du formulaire (vous pouvez ajouter des règles de validation ici)

        // Mettez à jour les propriétés du modèle avec les données du formulaire
        $programUe->table_ue_id = $request->input('table_ue_id');
        $programUe->classe_id = $request->input('classe_id');

        // Enregistrez les modifications dans la base de données
        $programUe->save();

        // Retournez une réponse JSON indiquant que la ressource a été mise à jour avec succès
        return response()->json(['message' => 'Ressource mise à jour avec succès']);
    }

    /**
     * Supprime la ressource spécifiée de la base de données.
     */
    public function destroy($id)
    {
        // Recherchez la ressource par son ID
        $programUe = ProgramUe::find($id);

        // Vérifiez si la ressource existe
        if (!$programUe) {
            return response()->json(['message' => 'Ressource non trouvée'], 404);
        }

        // Supprimez la ressource de la base de données
        $programUe->delete();

        // Retournez une réponse JSON indiquant que la ressource a été supprimée avec succès
        return response()->json(['message' => 'Ressource supprimée avec succès']);
    }
}
