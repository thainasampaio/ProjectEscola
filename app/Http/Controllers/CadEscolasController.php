<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use App\Models\cad_escolas as Escolas;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Validator;
class CadEscolasController extends Controller
{
    public function index(){
        try{
            return response()->json(['msg'=>"ok","response"=>Escolas::all()],200);//retorna [] em response se vazio
        }catch(Exception $e){
            return response()->json(['msg'=>'Server Error'],500);//erro servidor
        }
    }
    public function show($id){
        try{
            return response()->json(['msg'=>"ok","response"=>Escolas::findOrFail($id)],200);//ao encontrar os usuários é retornado um json: ['response':[dados do banco de dados]]
        }catch(ModelNotFoundException $e){
            return response()->json(['msg'=>'Escola not found'],404);//not found
        }catch(Exception $e){
            return response()->json(['msg'=>'Server Error'],500);//erro servidor
        }
    }
    public function store(Request $request){
        try{
            $val = Validator::make($request->all(),[ //verificação de parametros
                'nome'=>'required|max:54|alpha',
                'endereco'=>'required|max:54'
            ]);
            if($val->fails())
                return response()->json(['msg'=>$val->getMessageBag()],400); //erro do usuario
            if(Escolas::create($request->all()))
                return response()->json(['msg'=>'Added'],201); //adicionado com sucesso
            else
                return response()->json(['msg'=>'Escola not added'],500);//erro servidor
        }catch(Exception $e){
            return response()->json(['msg'=>json_encode($e->getMessage())],500);//erro servidor
        }
    }
    public function update(Request $request,$id){
        try{
            $val = Validator::make($request->all(),[ //verificação de parametros
                'nome'=>'required|max:54|alpha',
                'endereco'=>'required|max:54'
            ]);
            if($val->fails())
                return response()->json(['msg'=>$val->getMessageBag()],400); //erro do usuario
            $escola = Escolas::findOrFail($id);
            if($escola->update($request->all()))
                return response()->json(['msg'=>'Changed'],201);//alterado com sucesso
            else
                return response()->json(['msg'=>'Escola not changed'],500);//erro do servidor
        }catch(ModelNotFoundException $e){
            return response()->json(['msg'=>'Escola not found'],404);//not found
        }catch(Exception $e){
            return response()->json(['msg'=>'Server Error'],500);//erro do servidor
        }
    }
    public function destroy($id){
        try{
            if(Escolas::findOrFail($id)->delete())
                return response()->json(['msg'=>'Deleted'],200);//deletado com sucesso
            else
                return response()->json(['msg'=>'Escola not deleted'],404);//not found
        }catch(ModelNotFoundException $e){
            return response()->json(['msg'=>'Escola not found'],404);//not found
        }catch(Exception $e){
            return response()->json(['msg'=>'Server Error'],500);//erro servidor
        }
    }
    public function showbyname($name){
        try{
            return response()->json(['msg'=>"ok","response"=>Escolas::where('nome','like',"%{$name}%")->get()],200);
        }catch(Exception $e){
            return response()->json(['msg'=>'Server Error'],500);//erro do servidor
        }
    }
}
