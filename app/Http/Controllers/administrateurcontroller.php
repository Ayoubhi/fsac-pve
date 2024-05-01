<?php

namespace App\Http\Controllers;
use App\Http\Requests\administrateurRequest;
use App\Models\administrateur;
use Exception;
use Illuminate\Http\Request;

class administrateurController extends Controller
{
    public function index(){
        return 'Liste des Administrateurs';
    }
    public function store(administrateurRequest $request){

        try{
        $administrateur = new Administrateur();
        $administrateur->mail=$request->mail;
        $administrateur->nom=$request->nom;
        $administrateur->prenom=$request->prenom;
        $administrateur->mot_de_passe = bcrypt($request->mot_de_passe);
        $administrateur->save();


        return response()->json([
            'status_code'=>201,
            'status_message'=>'authentification validee',
            'data'=>$administrateur
        ]);
        
        }catch(Exception $exception){
            return response()->json($exception);
        }
        
    }

    public function update(Request $request, $id)
    {
        
        $administrateur = Administrateur::findOrFail($id);

            $administrateur->mot_de_passe = $request->mot_de_passe;
        
    
            $administrateur->mail = $request->mail;
            $administrateur->save();
        }

    
        


    public function delete(administrateur  $administrateur) {
         try{
                $administrateur->delete();

            return response()->json([
                'status_code'=>200,
                'status_message'=>'ladministrateur a été supprimer',
                'data'=>$administrateur
            ]);
            
            
         }catch(Exception $exeption){
            return response()->json($exeption);
        }
    }
}

