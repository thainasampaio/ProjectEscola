@extends('templates.core')

@section('content')

<nav class="navbar navbar-light bg-light">
  <div class="container-fluid">
    <a class="navbar-right"></a>
    <form class="d-flex">
      <input id="pesquisar" class="form-control me-2" type="search" onkeyup="get_data(true)" placeholder="Pesquise aqui..." aria-label="Search">
    </form>
  </div>
</nav>

<br>

<div class="container">
  <div class="form">
    <table class="table">
      <thead class="bg-primary text-white text-center">
        <tr>
        <th scope="col">ID</th>
          <th scope="col">Nome</th>
          <th scope="col">Endereço</th>
          <th scope="col"></th>
          <th scope="col"></th>  
        </tr>
      </thead>
      <tbody>
        
      </tbody>
    </table>
    </div>
  </div>
</div>
      <!-- Modal -->
      <div class="modal fade" id="ModEditar" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
            <h5 class="modal-title" id="exampleModalLabel">Editar</h5>
            <button type="button" id="cls_add" class="close" data-dismiss="modal" aria-label="Fechar"> <span aria-hidden="true">&times;</span> </button>
            </div>
          <div class="modal-body">
            <div class="col">
              <div class="card" >
                <div class="card-header">
                  <span>Editar Escola</span>
                </div>
          <div class="card-body">
            <div class="form-group">
              <label for="Efrm_nome">Nome</label>
              <input type="text" class="form-control" id="Efrm_nome" placeholder="Digite o nome da escola">
            </div>
            <input type="hidden" id="Eid" value="">
            <br>
          <div class="form-group">
            <label for="Efrm_endereco">Endereco</label>
            <input type="text" class="form-control" id="Efrm_endereco" placeholder="Digite o endereço da escola">
          </div>
        </div>
        <div class="modal-footer">
            <button type="button" onclick="alter_data()" class="btn btn-primary">Salvar</button>
        </div>
    </div>
  </div>
</div>

<script>
 
  $(".btn").on("click",function (){
    $("#ModEditar").modal("show")
  })
  $("#cls_add").on("click", function(){
    $("#ModEditar").modal("hide")
  })
  function erro(){

  }
  function sucesso(){

  }
  function get_data(name = false){
    if(name==false){
    $.ajax({
      type: 'GET',
      datatype: 'json',
      url:'/api/escolas',
      success:function(data){
        let vvv = ""
        vvv += "<tr>"
        vvv += '<td></td>'
        vvv += '<td><input type="text" class="form-control" id="frm_nome" placeholder="Digite o nome da escola"></td>'
        vvv += '<td><input type="text" class="form-control" id="frm_endereco" placeholder="Digite o endereço da escola"></td>'
        vvv += '<td><button onclick="send_data()" class="btn btn-outline-primary">Cadastrar</button></td>'
        
        vvv += "</tr>"
        $.each(data["response"],function(key,value){
          vvv += "<tr>"
          vvv += "<td>"+value.id+"</td>"
          vvv += "<td>"+value.nome+"</td>"
          vvv += "<td>"+value.endereco+"</td>"
          vvv += '<td><button type="button" onclick="alter('+value.id+')" class="btn btn-outline-primary">Editar</button></td>'
          vvv += '<td><button type="button" onclick="deletebyid('+value.id+')" class="btn btn-outline-danger">Deletar</button></td>'
          vvv += "</tr>"
        });
        $("tbody").html(vvv);
      }
    });
  }else{
      name = $("#pesquisar").val();
      if(name == "") get_data();
      else{
        $.ajax({
          type: 'GET',
          datatype: 'json',
          url:'/api/escolas/nome/'+name,
          success:function(data){
            let vvv = ""
                vvv += "<tr>"
                vvv += '<td><input type="text" class="form-control" id="frm_nome" placeholder="Digite o nome da escola"></td>'
                vvv += '<td><input type="text" class="form-control" id="frm_endereco" placeholder="Digite o endereço da escola"></td>'
                vvv += '<td><button onclick="send_data()" class="btn btn-outline-primary">Cadastrar</button></td>'
                                
                vvv += "</tr>"
              $.each(data["response"],function(key,value){
                vvv += "<tr>"
                vvv += "<td>"+value.id+"</td>"
                vvv += "<td>"+value.nome+"</td>"
                vvv += "<td>"+value.endereco+"</td>"
                vvv += '<td><button type="button" onclick="alter('+value.id+')" class="btn btn-outline-primary">Editar</button></td>'
                vvv += '<td><button type="button" onclick="deletebyid('+value.id+')" class="btn btn-outline-danger">Deletar</button></td>'
                vvv += "</tr>"
            });
            $("tbody").html(vvv);
          }
        });
      }
    }
  }
  function send_data(){
    let nome = $("#frm_nome").val()
    let endereco = $("#frm_endereco").val()
    $.ajax({
      url:"/api/escolas",
      type:"POST",
      datatype:"json",
      data: {nome:nome,endereco:endereco},
      success: function(data){
        alert("adicionado com sucesso!");
        get_data()
      }
    });
  }
  function alter(id){
    $.ajax({
      url:"/api/escolas/"+id,
      type:"GET",
      datatype:"json",
      success: function(data){
        $("#Efrm_nome").val(data["response"].nome)
        $("#Efrm_endereco").val(data["response"].endereco)
        $("#Eid").val(data["response"].id)
        $("#ModEditar").modal("show")
      }
    });
    
  }
  function alter_data(){
    let nome = $("#Efrm_nome").val()
    let endereco = $("#Efrm_endereco").val()
    let id = $("#Eid").val()
    $.ajax({
      type: 'PUT',
      datatype: 'json',
      url:'/api/escolas/'+id,
      data: {nome:nome,endereco:endereco},
      success: function(data){
        get_data();
        alert("alterado com sucesso!")
      }
     });
  }
  function deletebyid(id){
     $.ajax({
      type: 'DELETE',
      datatype: 'json',
      url:'/api/escolas/'+id,
      success: function(data){
        get_data();
      }
     });
  }
  $("#addEscola").on("click",function (){send_data()});
  //clear_data();
  get_data();
</script>
@endsection