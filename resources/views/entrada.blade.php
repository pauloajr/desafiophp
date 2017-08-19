<html>
<head>
<title>Desafio PHP</title>
<!-- Latest compiled and minified CSS -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
<!-- Optional theme -->
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap-theme.min.css" integrity="sha384-rHyoN1iRsVXV4nD0JutlnGaslCJuC7uwjduW9SVrLvRYooPp2bWYgmgJQIXwl/Sp" crossorigin="anonymous">
<!-- Latest compiled and minified JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>

</head>

<body>
<ul class="nav nav-tabs">
  <li role="presentation"><a href="{{action('AlunoController@cadastrar')}}">Cadastrar</a></li>
  <li role="presentation"><a href="{{action('AlunoController@buscar')}}">Busca de Aluno</a></li>
  <li role="presentation" class="active"><a href="{{action('AlunoController@notas')}}">Notas</a></li>
</ul>
<div class="panel panel-default">
  <div class="panel-body">
	<table width="100%">
  <tr>
    <td colspan="2">Média da turma:</td>
  </tr>
  <tr>
    <td colspan="2">0,00</td>
  </tr>
  <tr>
    <td colspan="2">&nbsp;</td>
  </tr>
  <tr>
    <td  width="30%">Melhor aluno:</td>
    <td>Pior aluno:</td>
  </tr>
  <tr>
    <td>&nbsp;</td>
    <td>&nbsp;</td>
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
    <tr>
    	<td width="80%">Nome:</td>
        <td width="20%">Nota:</td>
    </tr>
    </table>
    </td>
  </tr>
</table>

  </div>
</div>
</body>
</html>