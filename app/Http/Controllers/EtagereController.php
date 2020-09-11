<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Models\Etagere;
use App\APIError;
use Illuminate\Http\Request;    

class EtagereController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $req)
    {
        $data = Etagere::latest()->simplePaginate($req->has('limit') ? $req->limit : 15);
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
            'nomEtagere' => 'required', 
            'numEtagere' => 'required',
            
        ]);

        $etagere = new Produit();
        $etagere ->nomEtagere = $data['nomEtagere'];
        $etagere ->numEtagere = $data['numEtagere'];
        $etagere->save();
        return response()->json( $etagere);

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
        $etagere = etagere::find($id);
        if($etagere == null){
            $notfound = new APIError;
            $notfound->setStatus("404");
            $notfound->setCode("ETAGERE_NOT_FOUND");
            $notfound->setMessage("etagere id not found in database.");
            return response()->json($notfound, 404);
        }

        $data = $req->all();
        $data = $req->validate([
            'nomEtagere' => 'required', 
            'numEtagere' => 'required',
            ]);

            $etagere = new Etagere();
            $etagere ->nomEtagere = $data['nomEtagere'];
            $etagere ->numEtagere = $data['numEtagere'];
            $etagere ->save();
            return response()->json($etagere);  
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $etagere = Etagere::find($id);
       if($etagere == null){
           $notfound = new APIError;
           $notfound->setStatus("404");
           $notfound->setCode("ETAGERE_NOT_FOUND");
           $notfound->setMessage("etagere id not found in database.");
           return response()->json($notfound, 404);
       }

       $categorie->delete();
        return response()->json(200);

    }

    // methode pour rechercher une categorie en base de donnee
    public function find($id){
       
        $etagere = Etagere::find($id);
        if($etagere == null){
            $notfound = new APIError;
            $notfound->setStatus("404");
            $notfound->setCode("CATEGORY_NOT_FOUND");
            $notfound->setMessage("etagere id not found in database.");
            return response()->json($notfound, 404);
        }
        return response()->json($etagere);
      }


}
