<?php

namespace App\Http\Controllers;

use App\Models\cad_alunos as Alunos;
use Exception;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
//erros: 500 erro interno, 404 se o recurso nao for encontrado,400 erro do lado usuario, 201: criado ou alterado com sucesso, 200 OK
class CadAlunosController extends Controller
{
    public function index(){
        try{
            return response()->json(['msg'=>"ok","response"=>Alunos::all()],200);//retorna [] em response se vazio
        }catch(Exception $e){
            return response()->json(['msg'=>'Server Error'],500);//erro servidor
        }
    }
    public function show($id){
        try{
            return response()->json(['msg'=>"ok","response"=>Alunos::findOrFail($id)],200);//ao encontrar os usuários é retornado um json: ['response':[dados do banco de dados]]
        }catch(ModelNotFoundException $e){
            return response()->json(['msg'=>'Aluno not found'],404);//not found
        }catch(Exception $e){
            return response()->json(['msg'=>'Server Error'],500);//erro servidor
        }
    }
    public function store(Request $request){
        try{
            $genero = array("Masculino","Feminino");
            $val = Validator::make($request->all(),[ //verificação de parametros
                'nome'=>'min:3|max:54|required',
                'email' => 'email|max:79|required',
                'data_nascimento' => 'date|nullable',
                'telefone' => 'max:11', //DDD:85 Digito:9 Numero:00000000
                'genero' => 'max:9',
            ]);
            if($val->fails())
                return response()->json(['msg'=>json_encode($val->getMessageBag())],400); //erro do usuario
            
                if(Alunos::create($request->all()))
                return response()->json(['msg'=>'Added'],201); //adicionado com sucesso
            else
                return response()->json(['msg'=>'Aluno not added'],500);//erro servidor
        }catch(Exception $e){
            return response()->json(['msg'=>$e->getMessage()],500);//erro servidor
        }
    }
    public function update(Request $request,$id){
        try{
            $genero = array("Masculino","Feminino");
            $val = Validator::make($request->all(),[ //verificação de parametros
                'nome'=>'min:3|max:54|required',
                'email' => 'email|max:79|required',
                'data_nascimento' => 'date|nullable',
                'telefone' => 'max:11', //DDD:85 Digito:9 Numero:00000000
                'genero' => 'max:9',
            ]);
            if($val->fails())
                return response()->json(['msg'=>json_encode($val->getMessageBag())],400); //erro do usuario
            
            $aluno = Alunos::findOrFail($id);
            if($aluno->update($request->all()))
                return response()->json(['msg'=>'Changed'],201);//alterado com sucesso
            else
                return response()->json(['msg'=>'Aluno not changed'],500);//erro do servidor
        }catch(ModelNotFoundException $e){
            return $e->getMessage();
            return response()->json(['msg'=>'Aluno not found'],404);//not found
        }catch(Exception $e){
            return response()->json(['msg'=>'Server Error'],500);//erro do servidor
        }
    }
    public function destroy($id){
        try{
            Alunos::findOrFail($id)->delete();
            return response()->json(['msg'=>'Deleted'],200);//deletado com sucesso
        }catch(ModelNotFoundException $e){
            return response()->json(['msg'=>'Aluno not found'],404);//not found
        }catch(Exception $e){
            return response()->json(['msg'=>'Server Error'],500);//erro servidor
        }
    }
    public function showbyname($name){
        try{
            return response()->json(['msg'=>"ok","response"=>Alunos::where('nome','like',"%{$name}%")->get()],200);
        }catch(Exception $e){
            return response()->json(['msg'=>'Server Error'],500);//erro do servidor
        }
    }
}
