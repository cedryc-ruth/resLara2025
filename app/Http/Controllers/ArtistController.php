<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Artist;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ArtistController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $artists = Artist::all();
        
        return view('artist.index',[
            'artists' => $artists,
            'resource' => 'artistes',
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if(Auth::user()==null) {
            return redirect()->route('login');
        }

        if (!Gate::allows('create-artist')) {
            abort(403);
        }

        //Traitement

        return view('artist.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        if (!Gate::allows('update-artist')) {
            abort(403);
        }

        //Validation des données du formulaire
        $validated = $request->validate([
            'firstname' => 'required|max:60',
            'lastname' => 'required|max:60',
        ]);

	   //Le formulaire a été validé, nous créons un nouvel artiste à insérer
        $artist = new Artist();

        //Assignation des données et sauvegarde dans la base de données
        $artist->firstname = $validated['firstname'];
        $artist->lastname = $validated['lastname'];

        $artist->save();

        return redirect()->route('artist.index');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $artist = Artist::find($id);
        
        return view('artist.show',[
            'artist' => $artist,
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        if (!Gate::allows('update-artist')) {
            abort(403);
        }

        $artist = Artist::find($id);
        
        return view('artist.edit',[
            'artist' => $artist,
        ]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        if (!Gate::allows('update-artist')) {
            abort(403);
        }

    
        //Validation des données du formulaire
        $validated = $request->validate([
            'firstname' => 'required|max:60',
            'lastname' => 'required|max:60',
        ]);

        //Le formulaire a été validé, nous récupérons l’artiste à modifier
        $artist = Artist::find($id);

        //Mise à jour des données modifiées et sauvegarde dans la base de données
        $artist->update($validated);

        return view('artist.show',[
            'artist' => $artist,
        ]);    
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        if (!Gate::allows('delete-artist')) {
            abort(403);
        }

        $artist = Artist::find($id);

        if($artist) {
            $artist->delete();
        }

        return redirect()->route('artist.index');
    }
}
