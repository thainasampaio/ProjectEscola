@extends('templates.core')

@section('content')
<div class="container">
  <div class="form">
    <table class="table">
      <thead class="bg-primary text-white text-center">
        <tr>
          <th scope="col">ID</th>
          <th scope="col">Ano</th>
          <th scope="col">Nível de ensino</th>
          <th scope="col">Série</th>
          <th scope="col">Turno</th>
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
              <label for="Efrm_ano">Ano</label>
              <input type="text" class="form-control" id="Efrm_ano">
            </div>
            <input type="hidden" id="Eid" value="">
            <br>
            <div class="form-check">
            <label for="Efrm_nivel">Nível de ensino</label>
            <select id="Egen">
              <option>Fundamental</option>
              <option>Médio</option>
            </select>
          </div>
            <div class="form-group">
              <label for="Efrm_serie">Série</label>
              <input type="text" class="form-control" id="Efrm_serie">
            </div>
            <div class="form-group">
              <label for="Efrm_turno">Turno</label>
              <input type="text" class="form-control" id="Efrm_turno">
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" onclick="alter_data()" class="btn btn-primary">Salvar</button>
        </div>
    </div>
  </div>
</div>

<script>
  //$('.telefone').mask("(00) 99999-9999");
  /*$('.datepicker').datepicker({
    dateFormat: 'yy-mm-dd'
  });*/
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
  function get_data(){
    $.ajax({
      type: 'GET',
      datatype: 'json',
      url:'/api/escolas',
      success:function(data){
        let vvv = ""
        vvv += "<tr>"
        vvv += '<td></td>'
        vvv += '<td><input type="text" class="form-control" id="frm_ano"></td>'
        vvv += '<td><select id="frm_nivel" class="form-select" aria-label="Default select example"><option value="Fundamental">Fundamental</option><option value="Médio">Médio</option></select></td>'
        vvv += '<td><input type="text" class="form-control" id="frm_serie"</td>'
        vvv += '<td><input type="text" class="form-control" id="frm_turno"></td>'
        vvv += '<td><button onclick="send_data()" class="btn btn-outline-primary">Cadastrar</button></td>'
        
        vvv += "</tr>"
        $.each(data["response"],function(key,value){
          vvv += "<tr>"
          vvv += "<td>"+value.id+"</td>"
          vvv += "<td>"+value.ano+"</td>"
          vvv += "<td>"+value.nivel+"</td>"
          vvv += "<td>"+value.serie+"</td>"
          vvv += "<td>"+value.turno+"</td>"
          vvv += '<td><button type="button" onclick="alter('+value.id+')" class="btn btn-outline-primary">Editar</button></td>'
          vvv += '<td><button type="button" onclick="deletebyid('+value.id+')" class="btn btn-outline-danger">Deletar</button></td>'
          vvv += "</tr>"
        });
        $("tbody").html(vvv);
      }
    });
  }
  function send_data(){
    let ano = $("#frm_ano").val()
    let nivel = $("#frm_nivel").val()
    let serie = $("#frm_serie").val()
    let turno = $("#frm_turno").val()
    $.ajax({
      url:"/api/escolas",
      type:"POST",
      datatype:"json",
      data: {ano:ano,nivel:nivel,serie:serie,turno:turno},
      success: function(data){
        alert("adicionado com sucesso!");
        get_data()
      }
    });
  }
  function alter(id){
    $.ajax({
      url:"/api/turmas/"+id,
      type:"GET",
      datatype:"json",
      success: function(data){
        $("#Efrm_ano").val(data["response"].ano)
        $("#Efrm_nivel").val(data["response"].nivel)
        $("#Efrm_serie").val(data["response"].serie)
        $("#Efrm_turno").val(data["response"].turno)
        $("#Eid").val(data["response"].id)
        $("#ModEditar").modal("show")
      }
    });
    
  }
  function alter_data(){
    let ano = $("#frm_ano").val()
    let nivel = $("#frm_nivel").val()
    let serie = $("#frm_serie").val()
    let turno = $("#frm_turno").val()
    let id = $("#Eid").val()
    $.ajax({
      type: 'PUT',
      datatype: 'json',
      url:'/api/turmas/'+id,
      data:{ano:ano,nivel:nivel,serie:serie,turno:turno},
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
      url:'/api/turmas/'+id,
      success: function(data){
        get_data();
      }
     });
  }
  $("#addTurma").on("click",function (){send_data()});
  //clear_data();
  get_data();
</script>
@endsection