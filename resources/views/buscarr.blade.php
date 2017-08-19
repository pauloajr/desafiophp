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
  <li role="presentation"><a href="{{action('AlunoController@cadastrar')}}">Cadastrar</a></li>
  <li role="presentation" class="active"><a href="{{action('AlunoController@buscar')}}">Busca de Aluno</a></li>
  <li role="presentation"><a href="{{action('AlunoController@notas')}}">Notas</a></li>
</ul>
<div class="panel panel-default">
  <div class="panel-body">
    <form action="{{action('AlunoController@buscarr')}}" method="post">
	<input type="hidden" name="_token" value="{{{csrf_token()}}}">
    <table width="100%" class="table">
    <td width="50%"><input type="text" name="procura" class="form-control" value="{{$procura}}"></td>
    <td width="25%"><select name="seletor" class="form-control">
    <option value="0" <?php if($seletor == 0) {?>selected="selected"<?php } ?>>CPF</option>
    <option value="1" <?php if($seletor == 1) {?>selected="selected"<?php } ?>>Nome</option>
    <option value="2" <?php if($seletor == 2) {?>selected="selected"<?php } ?>>Matr&iacute;cula</option>
    </select></td>
    <td width="25%"><button type="submit" class="btn btn-default"><span  class="glyphicon glyphicon-search"></span> Procurar</button></td>
    </table>
    </form>
    <?php 
	if(!empty($aluno->nome)){
	?>
    <form action="{{action('AlunoController@editar')}}" method="post">
    <input type="hidden" name="_token" value="{{{csrf_token()}}}">
    <input type="hidden" name="id" value="{{$aluno->id}}" />
    <table width="100%" class="table" id="dados">
      <tr>
        <td width="20%">Nome</td>
        <td width="70%"><input type="text" name="nome" class="form-control" value="{{$aluno->nome}}" /></td>
        <td width="10%">&nbsp;</td>
      </tr>
      <tr>
        <td>CPF</td>
        <td><input type="text" name="cpf" class="form-control" value="{{$aluno->cpf}}" /></td>
        <td></td>
      </tr>
      <tr>
        <td>Matr&iacute;cula</td>
        <td><input type="text" name="matricula" class="form-control" value="{{$aluno->matricula}}" /></td>
        <td></td>
      </tr>
      <tr>
        <td>Nota</td>
        <td id="nota"><?php 
		$i = 0;
		if(!empty($notas))
		foreach($notas as $valor){
			$valor = get_object_vars($valor);
			echo '<div id="notanum'.$i.'">'.$valor['valor'].' <input name="nota[]" type="hidden" value="'.$valor['valor'].'"> <input type="checkbox" value="'.$valor['valor'].'" onclick="excluir(\'notanum'.$i.'\')"></div>';
			$i++;
		}
		?></td>
        <td><span id="sp" class="glyphicon glyphicon-plus" data-toggle="modal" data-target="#myModal" style="cursor:pointer"></span></td>
      </tr>
      <tr>
        <td>Rua</td>
        <td><input type="text" name="rua" class="form-control" value="{{$endereco->logradouro}}" /></td>
        <td></td>
      </tr>
      <tr>
        <td>Numero</td>
        <td><input type="text" name="numero" class="form-control" value="{{$endereco->numero}}" /></td>
        <td></td>
      </tr>
      <tr>
        <td>Bairro</td>
        <td><input type="text" name="bairro" class="form-control" value="{{$endereco->bairro}}" /></td>
        <td></td>
      </tr>
      <tr id="nsalvar">
        <td colspan="2" align="right"><button id="editar" type="button" class="btn btn-info"><span  class="glyphicon glyphicon-pencil"></span> Editar</button> <button type="button" class="btn btn-danger" onClick="apagar('{{action("AlunoController@deletar",$aluno->id)}}');"><span  class="glyphicon glyphicon-remove"></span> Excluir</button></td>
        <td>&nbsp;</td>
      </tr>
      <tr id="salvar" style="display:none">
        <td colspan="2" align="right"><button type="submit" class="btn btn-default"><span  class="glyphicon glyphicon-floppy-disk"></span> Salvar</button></td>
        <td>&nbsp;</td>
      </tr>
    </table>
    </form>
    
  </div>
</div>
<script language="javascript">
function apagar(url){
	if(window.confirm('Deseja realmente apagar?')){
		window.location = url;
	}
};
function excluir(pt){
document.getElementById(pt).remove();
}

$("#dados input").prop("disabled", true);
$("#sp").hide();

$("#editar").click(function(){
	$("#dados input").prop("disabled", false);
	$("#sp").show();
	$("#nsalvar").hide();
	$("#salvar").show();
});


i = <?php echo $i ?>;
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
<?php } ?>
@stop
