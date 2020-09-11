<?php

namespace App\Http\Controllers;

use App\Livre;
use App\APIError;
use Illuminate\Http\Request;

class livreController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $req)
    {
        $data = Etagere::latest()->simplePaginate($req->has('limit') ? $req->limit : 15);
        //ceci te sera util pour ajouter l'url du serveur a tes images lorsque tu les retournes.
        /* foreach ($data as $not) {
            $not->image = url($not->image);
        } */
        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $req)
    {
        $data = $req->all();
        $data = $req->validate([
            'nomLivre' =>  'required',
            'nomAuteur' => 'required',
            'maisonEdition' => 'required',
            'dateParution' => 'required',
            'idEtagere' => 'required',
        ]);


        $path1 = " ";
        //upload image
        if(isset($request->photo)){
            $photo = $request->file('photo'); 
            if($photo != null){
                $extension = $photo->getClientOriginalExtension();
                $relativeDestination = "uploads/Livre";
                $destinationPath = public_path($relativeDestination);
                $safeName = "Livre".time().'.'.$extension;
                $photo->move($destinationPath, $safeName);
                $path1 = "$relativeDestination/$safeName";
            }
        }
        $data['photo'] = $path1;

        $livre = new Livre();
        $livre ->nomLivre = $data['nomLivre'];
        $livre ->nomAuteur = $data['nomAuteur'];
        $livre ->maisonEdition = $data['maisonEdition'];
        $livre ->dateParution = $data['dateParution'];
        $livre ->idEtagere = $data['idEtagere'];
        $livre ->photo = $data['photo'];
        $livre ->save();
        return response()->json($livre);  
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $livre = Livre::find($id);
        if($livre == null){
            $notfound = new APIError;
            $notfound->setStatus("404");
            $notfound->setCode("LIVRE_NOT_FOUND");
            $notfound->setMessage("livre id not found in database.");
            return response()->json($notfound, 404);
        }

        $data = [];
        $data = array_merge($data, $request->only([
            'nomLivre', 
            'nomAuteur', 
            'maisonEdition',
            'dateParution',
            'photo',
            'idEtagere',
            ]));

            $path1 = " ";
            //upload image
            if(isset($request->photo)){
                $photo = $request->file('photo'); 
                if($photo != null){
                    $extension = $photo->getClientOriginalExtension();
                    $relativeDestination = "uploads/Livre";
                    $destinationPath = public_path($relativeDestination);
                    $safeName = "Livre".time().'.'.$extension;
                    $photo->move($destinationPath, $safeName);
                    $path1 = "$relativeDestination/$safeName";
                }
            }
            $data['photo'] = $path1;  

        $livre = new Livre();
        $livre ->nomLivre = $data['nomLivre'];
        $livre ->nomAuteur = $data['nomAuteur'];
        $livre ->maisonEdition = $data['maisonEdition'];
        $livre ->dateParution = $data['dateParution'];
        $livre ->idEtagere = $data['idEtagere'];
        $livre ->photo = $data['photo'];
        $livre ->save();
        return response()->json($livre);  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $livre = Livre::find($id);
        if($etagere == null){
            $notfound = new APIError;
            $notfound->setStatus("404");
            $notfound->setCode("LIVRE_NOT_FOUND");
            $notfound->setMessage("livre id not found in database.");
            return response()->json($notfound, 404);
        }
 
        $categorie->delete();
         return response()->json(200);
    }

     // methode pour rechercher une categorie en base de donnee
     public function find($id){
       
        $livre = Livre::find($id);
        if($livre == null){
            $notfound = new APIError;
            $notfound->setStatus("404");
            $notfound->setCode("LIVRE_NOT_FOUND");
            $notfound->setMessage("livre id not found in database.");
            return response()->json($notfound, 404);
        }
        return response()->json($livre);
      }

}
