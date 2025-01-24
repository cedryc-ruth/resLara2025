<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Artist;
use Illuminate\Support\Facades\Gate;

class ArtistApiController extends Controller
{
    /**
     * Afficher tous les artistes.
     */
    public function index()
    {
        return response()->json(Artist::all(), 200);
    }

    /**
     * Ajouter un nouvel artiste.
     */
    public function store(Request $request)
    {
        if (!Gate::allows('update-artist')) {
            return response()->json(["error"=>"Action non autorisée."],403);
        }
        
        $validated = $request->validate([
            'firstname' => 'required|string|max:255',
            'lastname' => 'required|string|max:255',
        ]);

        $artist = Artist::create($validated);

        return response()->json($artist, 201);
    }

    /**
     * Afficher un artiste spécifique.
     */
    public function show(string $id)
    {
        $artist = Artist::find($id);

        if (!$artist) {
            return response()->json(['message' => 'Artist not found'], 404);
        }

        return response()->json($artist, 200);
    }

    /**
     * Mettre à jour un artiste.
     */
    public function update(Request $request, string $id)
    {
        if (!Gate::allows('update-artist')) {
            return response()->json(["error"=>"Action non autorisée."],403);
        }

        $artist = Artist::find($id);

        if (!$artist) {
            return response()->json(['message' => 'Artist not found'], 404);
        }

        $validated = $request->validate([
            'firstname' => 'sometimes|string|max:255',
            'lastname' => 'sometimes|string|max:255',
        ]);

        $artist->update($validated);

        return response()->json($artist, 200);
    }

    /**
     * Supprimer un artiste.
     */
    public function destroy(string $id)
    {
        if (!Gate::allows('delete-artist')) {
            return response()->json(["error"=>"Action non autorisée."],403);
        }

        $artist = Artist::find($id);

        if (!$artist) {
            return response()->json(['message' => 'Artist not found'], 404);
        }

        $artist->delete();

        return response()->json(['message' => 'Artist deleted'], 200);
    }
}
