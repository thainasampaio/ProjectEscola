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
          <th scope="col">Telefone</th>
          <th scope="col">E-mail</th>
          <th scope="col">Data de nascimento</th>
          <th scope="col">Gênero</th>
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
                  <span>Editar alunos</span>
                </div>
          <div class="card-body">
            <div class="form-group">
              <label for="Efrm_nome">Nome</label>
              <input type="text" class="form-control" id="Efrm_nome" placeholder="Digite seu nome">
            </div>
            <input type="hidden" id="Eid" value="">
            <br>
          <div class="form-group">
            <label for="Efrm_telefone">Telefone</label>
            <input type="tel" class="form-control" id="Efrm_telefone" placeholder="(85) 9 9999-9999">
          </div>
          <br>
          <div class="form-group">
            <label for="Efrm_email">E-mail</label>
            <input type="email" class="form-control" id="Efrm_email" placeholder="exemplo@gmail.com">
          </div>
          <br>
          <label for="frm_email">Data de nascimento</label>
          <div class="form-group">
            <input type="date" id="Efrm_date" class="form-control datepicker">
          </div>
          <br>
          <label for="frm_genero">Gênero</label>
          <div class="form-check">
            <select id="Egen">
              <option value="Feminino">Feminino</option>
              <option value="Masculino">Masculino</option>
            </select> 
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
      url:'/api/alunos',
      success:function(data){
      
        let vvv = ""
        vvv += "<tr>"
        vvv += '<td></td>'
        vvv += '<td><input type="text" class="form-control" id="frm_nome" placeholder="Digite seu nome"></td>'
        vvv += '<td><input type="tel" class="form-control" id="frm_telefone" placeholder="(85) 9 9999-9999"></td>'
        vvv += '<td><input type="email" class="form-control" id="frm_email" placeholder="exemplo@gmail.com"></td>'
        vvv += '<td><input type="date" class="form-control id="frm_date" datepicker"></td>'
        vvv += '<td><select id="frm_gen" class="form-select" aria-label="Default select example"><option value="Feminino">Feminino</option><option value="Masculino">Masculino</option></select></td>'
        vvv += '<td><button type="button" class="btn btn-outline-primary" onclick="send_data()">Cadastrar</button></td>'
        vvv += "<tr>"
        
        $.each(data["response"],function(key,value){
          vvv += "<tr>"
          vvv += "<td>"+value.id+"</td>"
          vvv += "<td>"+value.nome+"</td>"
          vvv += "<td>"+value.telefone+"</td>"
          vvv += "<td>"+value.email+"</td>"
          vvv += "<td>"+value.data_nascimento+"</td>"
          vvv += "<td>"+value.genero+"</td>"
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
          url:'/api/alunos/nome/'+name,
          success:function(data){
            let vvv = ""
                vvv += "<tr>"
                vvv += '<td></td>'
                vvv += '<td><input type="text" class="form-control" id="frm_nome" placeholder="Digite seu nome"></td>'
                vvv += '<td><input type="tel" class="form-control" id="frm_telefone" placeholder="(85) 9 9999-9999"></td>'
                vvv += '<td><input type="email" class="form-control" id="frm_email" placeholder="exemplo@gmail.com"></td>'
                vvv += '<td><input type="date" class="form-control id="frm_date" datepicker"></td>'
                vvv += '<td><select id="frm_gen" class="form-select" aria-label="Default select example"><option value="Feminino">Feminino</option><option value="Masculino">Masculino</option></select></td>'
                vvv += '<td><button type="button" class="btn btn-outline-primary" onclick="send_data()">Cadastrar</button></td>'
                vvv += "<tr>"
                        
            $.each(data["response"],function(key,value){
              vvv += "<tr>"
              vvv += "<td>"+value.id+"</td>"
              vvv += "<td>"+value.nome+"</td>"
              vvv += "<td>"+value.telefone+"</td>"
              vvv += "<td>"+value.email+"</td>"
              vvv += "<td>"+value.data_nascimento+"</td>"
              vvv += "<td>"+value.genero+"</td>"
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
    let telefone = $("#frm_telefone").val().replace("-","").replace(" ","").replace("(","").replace(")","")
    let email = $("#frm_email").val()
    let genero = $('#frm_gen option:selected').val()
    let gen_desc = $("#frm_desc").val()
    let date = $("#frm_date").val()
    if(date == "" || date == null)
      date = "1999-01-01"
    $.ajax({
      url:"/api/alunos",
      type:"POST",
      datatype:"json",
      data: {nome:nome,email:email,telefone:telefone,data_nascimento:date,genero:genero},
      success: function(data){
        alert("adicionado com sucesso!");
        get_data() 
      }
    });
  }
  function alter(id){
    $.ajax({
      url:"/api/alunos/"+id,
      type:"GET",
      datatype:"json",
      success: function(data){
        $("#Efrm_nome").val(data["response"].nome)
        $("#Efrm_telefone").val(data["response"].telefone)
        $("#Efrm_email").val(data["response"].email)
        $('#Egen option').val(data["response"].genero).change()
        $("#Efrm_date").val(data["response"].data_nascimento)
        $("#Eid").val(data["response"].id)
        $("#ModEditar").modal("show")
      }
    });
    
  }
  function alter_data(){
    let nome = $("#Efrm_nome").val()
    let telefone = $("#Efrm_telefone").val()
    let email = $("#Efrm_email").val()
    let gener = $('#Egen option:selected').val()
    let date = $("#Efrm_date").val()
    let id = $("#Eid").val()
    $.ajax({
      type: 'PUT',
      datatype: 'json',
      url:'/api/alunos/'+id,
      data: {nome:nome,email:email,telefone:telefone,data_nascimento:date,genero:gener},
      success: function(data){
        get_data();
        alert("Alterado com sucesso!");
      }
     });
  }
  function deletebyid(id){
     $.ajax({
      type: 'DELETE',
      datatype: 'json',
      url:'/api/alunos/'+id,
      success: function(data){
        get_data()
      }
     });
  }
  $("#addAluno").on("click",function (){send_data()});
  //clear_data();
  get_data();
</script>
@endsection