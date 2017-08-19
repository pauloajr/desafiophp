@extends('principal')	
@section('content')
<ul class="nav nav-tabs">
  <li role="presentation"><a href="{{action('AlunoController@cadastrar')}}">Cadastrar</a></li>
  <li role="presentation" class="active"><a href="">Busca de Aluno</a></li>
  <li role="presentation"><a href="{{action('AlunoController@notas')}}">Notas</a></li>
</ul>
<div class="panel panel-default">
  <div class="panel-body">
    <form action="{{action('AlunoController@buscarr')}}" method="post">
	<input type="hidden" name="_token" value="{{{csrf_token()}}}">
    <table width="100%" class="table">
    <td width="50%"><input type="text" name="procura" class="form-control" value="<?php if(!empty($cpf)) echo $cpf ?>"></td>
    <td width="25%"><select name="seletor" class="form-control">
    <option value="0">CPF</option>
    <option value="1">Nome</option>
    <option value="2">Matr&iacute;cula</option>
    </select></td>
    <td width="25%"><button type="submit" class="btn btn-default"><span  class="glyphicon glyphicon-search"></span> Procurar</button></td>
    </table>
    </form>
  </div>
</div>
@stop
