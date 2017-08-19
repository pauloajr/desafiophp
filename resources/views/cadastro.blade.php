@extends('principal')	
@section('content')
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
<!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Nota(use ponto)</h4>
        </div>
        <div class="modal-body">
          <p><input type="text" name="addnota" id="addnota" class="form-control"></p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal" id="ok">ok</button>
        </div>
      </div>
      
    </div>
  </div>
<ul class="nav nav-tabs">
  <li role="presentation" class="active"><a href="#">Cadastrar</a></li>
  <li role="presentation"><a href="{{action('AlunoController@buscar')}}">Busca de Aluno</a></li>
  <li role="presentation"><a href="{{action('AlunoController@notas')}}">Notas</a></li>
</ul>
<div class="panel panel-default">
  <div class="panel-body">
    <form action="{{action('AlunoController@cadasalvo')}}" method="post">
	<input type="hidden" name="_token" value="{{{csrf_token()}}}">
    <table width="100%" class="table">
      <tr>
        <td width="20%">Nome</td>
        <td width="70%"><input type="text" name="nome" class="form-control"></td>
        <td width="10%">&nbsp;</td>
      </tr>
      <tr>
        <td>CPF</td>
        <td><input type="text" name="cpf" class="form-control"></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>Matr&iacute;cula</td>
        <td><input type="text" name="matricula" class="form-control"></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>Nota</td>
        <td id="nota"><label for="textarea"></label></td>
        <td><span class="glyphicon glyphicon-plus" data-toggle="modal" data-target="#myModal" style="cursor:pointer"></span></td>
      </tr>
      <tr>
        <td>Rua</td>
        <td><input type="text" name="rua" class="form-control"></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>Numero</td>
        <td><input type="text" name="numero" class="form-control"></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td>Bairro</td>
        <td><input type="text" name="bairro" class="form-control"></td>
        <td>&nbsp;</td>
      </tr>
      <tr>
        <td colspan="2" align="right"><button type="submit" class="btn btn-default"><span  class="glyphicon glyphicon-floppy-disk"></span> Salvar</button></td>
        <td>&nbsp;</td>
      </tr>
    </table>
    </form>
  </div>
</div>
<script language="javascript">
function excluir(pt){
document.getElementById(pt).remove();
}

i = 0;
$("#ok").click(function() {
  valor = parseFloat($("#addnota").val());
  if (valor > 0) {
	  filho = '<div id="notanum'+i+'">'+valor+' <input name="nota[]" type="hidden" value="'+valor+'"> <input type="checkbox" value="'+valor+'" onclick="excluir(\'notanum'+i+'\')"></div>';
	  $('#nota').append(filho);
	  i++;
	  $("#addnota").val('');
	  };
	});
</script>
@stop