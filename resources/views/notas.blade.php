@extends('principal')	
@section('content')
<ul class="nav nav-tabs">
  <li role="presentation"><a href="{{action('AlunoController@cadastrar')}}">Cadastrar</a></li>
  <li role="presentation"><a href="{{action('AlunoController@buscar')}}">Busca de Aluno</a></li>
  <li role="presentation" class="active"><a href="#">Notas</a></li>
</ul>
<div class="panel panel-default">
  <div class="panel-body">
	<table width="100%">
  <tr>
    <td colspan="2">Média da turma:</td>
  </tr>
  <tr>
    <td colspan="2"><?php print_r($result) ?></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td  width="30%">Melhor aluno:</td>
    <td>Pior aluno:</td>
  </tr>
  <tr>
    <td><?php print_r($melhor) ?></td>
    <td><?php print_r($pior) ?></td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td colspan="2">Alunos:<br/>
    <table width="50%" class="table table-bordered table-condensed table-striped table-hover" >
    <tr>
    	<td width="80%">Nome:</td>
        <td width="20%">Nota:</td>
    </tr>
    <?php foreach($alunos as $valor){
		$valor = get_object_vars($valor);
	?>
    <tr>
    	<td width="80%"><?php echo $valor['nome'] ?></td>
        <td width="20%"><?php echo $valor['round'] ?></td>
    </tr>
	<?php } ?>
    </table>
    </td>
  </tr>
</table>

  </div>
</div>
@stop