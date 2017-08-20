<?php

namespace App\Http\Controllers;
use Request;
use Illuminate\Support\Facades\DB;

use App\Aluno;
use App\Endereco;
use App\Nota;
use Validator;

class AlunoController extends Controller
{
    //
	public function cadastrar(){
		return view('cadastro');
	}
	public function buscar(){
		//return view('entrada');
		$id = Request::route('id');
		return view('buscar')->with('cpf',$id);
	}
	
	public function notas(){
		$results = DB::select('select round( CAST(AVG(valor) as numeric), 1) as valor from nota');
		if(!empty($results))
		$results = get_object_vars($results[0]); else $results['valor']='';
		$alunos = DB::select('select round( CAST(AVG(n.valor) as numeric), 1),a.nome from aluno a INNER JOIN nota n ON n.aluno_id = a.id GROUP BY a.nome');
		$melhor = DB::select('select round( CAST(AVG(n.valor) as numeric), 1) as r,a.nome from aluno a INNER JOIN nota n ON n.aluno_id = a.id GROUP BY a.nome ORDER BY r DESC LIMIT 1');
		if(!empty($melhor))
		$melhor = get_object_vars($melhor[0]); else $melhor['nome'] ='';
		$pior = DB::select('select round( CAST(AVG(n.valor) as numeric), 1) as r,a.nome from aluno a INNER JOIN nota n ON n.aluno_id = a.id GROUP BY a.nome ORDER BY r ASC LIMIT 1');
		if(!empty($pior))
		$pior = get_object_vars($pior[0]); else $pior['nome'] = '';
		//DB::insert('INSERT INTO contas_pagar (descricao, valor) VALUES (?,?)', array($descricao,$valor))
		return view('notas')->with("result",$results['valor'])->with("alunos",$alunos)->with("melhor",$melhor['nome'])->with("pior",$pior['nome']);
	}
	
	
	public function cadasalvo(){
		$nome = Request::input('nome');
		$cpf = Request::input('cpf');
		$matricula = Request::input('matricula');
		$nota = Request::input('nota');
		$rua = Request::input('rua');
		$num = Request::input('numero');
		$bairro = Request::input('bairro');
		
		$validator = Validator::make(
		[
		'nome' => $nome,
		'cpf' => $cpf,
		'matricula' => $matricula,
		'rua' => $rua,
		'num' => $num,
		'bairro' => $bairro		
		],
		[
		'nome' => 'required|min:1',
		'cpf' => 'required|numeric',
		'matricula' => 'required|min:1',
		'num' => 'required|numeric',
		'rua' => 'required|min:1',
		'bairro' => 'required|min:1'
		]
		);
		
		if($validator->fails()){
			return 'Houve erro';
		}
			
		$novoEnd = new Endereco();
		$novoEnd->logradouro = $rua;
		$novoEnd->numero = $num;
		$novoEnd->bairro = $bairro;
		$novoEnd->save();
		
		$novoAluno = new Aluno();
		$novoAluno->nome = $nome;
		$novoAluno->cpf = $cpf;
		$novoAluno->matricula = $matricula;
		$novoAluno->endereco_int = $novoEnd->id;
		$novoAluno->save();
		
		foreach($nota as $valor){
		$novoNota = new Nota();
		$novoNota->valor = $valor;
		$novoNota->aluno_id = $novoAluno->id;
		$novoNota->save();
		}
	
		return redirect()->action('AlunoController@cadastrar');
	}
	
	public function buscarr(){
		$procura = Request::input('procura');
		$seletor = Request::input('seletor');
		//return view('entrada');
		if($seletor == 1) 
		$sql = "SELECT id FROM aluno WHERE nome ILIKE '$procura%' LIMIT 1";
		if($seletor == 0)
		$sql = "SELECT id FROM aluno WHERE cpf ILIKE '$procura%' LIMIT 1";
		if($seletor == 2)
		$sql = "SELECT id FROM aluno WHERE matricula ILIKE '$procura%' LIMIT 1";
		
		$resultado = DB::select($sql);
		if(!empty($resultado)){
		$results = get_object_vars($resultado[0]);
		$aluno = Aluno::find($results['id']);
		$endereco = Endereco::find($aluno->endereco_int);
		$notas = DB::select('select * from nota WHERE aluno_id = '.$aluno->id);
		} else {
			$aluno = new Aluno();
			$endereco = new Endereco();
			$notas = '';
		}
		
		
		return view('buscarr')->with('procura',$procura)->with('seletor',$seletor)->with('aluno',$aluno)->with('endereco',$endereco)->with('notas',$notas);
	}
	
	public function editar(){
		$id = Request::input('id');
		$nome = Request::input('nome');
		$cpf = Request::input('cpf');
		$matricula = Request::input('matricula');
		$nota = Request::input('nota');
		$rua = Request::input('rua');
		$num = Request::input('numero');
		$bairro = Request::input('bairro');
		
		$validator = Validator::make(
		[
		'nome' => $nome,
		'cpf' => $cpf,
		'matricula' => $matricula,
		'rua' => $rua,
		'num' => $num,
		'bairro' => $bairro		
		],
		[
		'nome' => 'required|min:1',
		'cpf' => 'required|numeric',
		'matricula' => 'required|min:1',
		'num' => 'required|numeric',
		'rua' => 'required|min:1',
		'bairro' => 'required|min:1'
		]
		);
		
		if($validator->fails()){
			return 'Houve erro';
		}
		
		$novoAluno = Aluno::find($id);
		$novoAluno->nome = $nome;
		$novoAluno->cpf = $cpf;
		$novoAluno->matricula = $matricula;
		$novoAluno->save();
		
		$novoEnd = Endereco::find($novoAluno->endereco_int);
		$novoEnd->logradouro = $rua;
		$novoEnd->numero = $num;
		$novoEnd->bairro = $bairro;
		$novoEnd->save();
		
		DB::delete('delete from nota WHERE aluno_id = '.$id);
		
		foreach($nota as $valor){
		$novoNota = new Nota();
		$novoNota->valor = $valor;
		$novoNota->aluno_id = $novoAluno->id;
		$novoNota->save();
		}
		
		$notas = DB::select('select * from nota WHERE aluno_id = '.$id);
		
		
		return redirect()->action('AlunoController@buscar',$cpf);
	}
	public function deletar($id){
		
		$novoAluno = Aluno::find($id);
		$novoEnd = Endereco::find($novoAluno->endereco_int);
		DB::delete('delete from nota WHERE aluno_id = '.$id);
		$novoAluno->delete();
		$novoEnd->delete();		
		
		
		return redirect()->action('AlunoController@buscar');
	}
	
}

