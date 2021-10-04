<?php
namespace App\Http\Controllers;
use Exception;
use Illuminate\Http\Request;
use App\Models\cad_turmas as Turmas;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Validator;

class CadTurmasController extends Controller
{
    public function index(){
        try{
            return response()->json(['msg'=>"ok","response"=>Turmas::all()],200);//retorna [] em response se vazio
        }catch(Exception $e){
            return response()->json(['msg'=>'Server Error'],500);//erro servidor
        }
    }
    public function show($id){
        try{
            return response()->json(['msg'=>"ok","response"=>Turmas::findOrFail($id)],200);//ao encontrar os usuários é retornado um json: ['response':[dados do banco de dados]]
        }catch(ModelNotFoundException $e){
            return response()->json(['msg'=>'Turma not found'],404);//not found
        }catch(Exception $e){
            return response()->json(['msg'=>'Server Error'],500);//erro servidor
        }
    }
    public function store(Request $request){
        try{
            if(Validator::make($request->all(),[ //verificação de parametros
                'ano'=>'required|date',
                'nivel'=>'required|boolean',
                'serie'=>'required|digits:1',
                'turno'=>'required|digits:1'
            ])->fails())
                return response()->json(['msg'=>'Erro parameter'],400); //erro do usuario
            if(Turmas::create($request->all()))
                return response()->json(['msg'=>'Added'],201); //adicionado com sucesso
            else
                return response()->json(['msg'=>'Turma not added'],500);//erro servidor
        }catch(Exception $e){
            return response()->json(['msg'=>'Server Error'],500);//erro servidor
        }
    }
    public function update(Request $request){
        try{
            if(Validator::make($request->all(),[ //verificação de parametros
                'ano'=>'required|date',
                'nivel'=>'required|boolean',
                'serie'=>'required|digits:1',
                'turno'=>'required|digits:1'
            ])->fails())
                return response()->json(['msg'=>'Erro parametros'],400); //erro do usuario
            $turma = Turmas::findOrFail($request->id);
            if($turma->update($request->all()))
                return response()->json(['msg'=>'Changed'],201);//alterado com sucesso
            else
                return response()->json(['msg'=>'Turma not changed'],500);//erro do servidor
        }catch(ModelNotFoundException $e){
            return response()->json(['msg'=>'Turma not found'],404);//not found
        }catch(Exception $e){
            return response()->json(['msg'=>'Server Error'],500);//erro do servidor
        }
    }
    public function destroy($id){
        try{
            if(Turmas::findOrFail($id)->delete())
                return response()->json(['msg'=>'Deleted'],200);//deletado com sucesso
            else
                return response()->json(['msg'=>'Turma not deleted'],404);//not found
        }catch(ModelNotFoundException $e){
            return response()->json(['msg'=>'Turma not found'],404);//not found
        }catch(Exception $e){
            return response()->json(['msg'=>'Server Error'],500);//erro servidor
        }
    }
}
