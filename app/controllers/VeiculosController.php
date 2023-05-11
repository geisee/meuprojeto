<?php
use models\Veiculos;

/**
* Tutorial CRUD
* Autor:Alan Klinger 05/06/2017
*/

#A classe devera sempre iniciar com letra maiuscula
#terá sempre o mesmo nome do arquivo
#e precisa terminar com a palavra Controller
class VeiculosController {

	/**
	* Para acessar http://localhost/NOMEDOPROJETO/veiculos/index
	**/
	function index($id = null){

		#variáveis que serao passados para a view
		$send = [];

		#cria o model
		$model = new Veiculos();
		
		
		$send['data'] = null;
		#se for diferente de nulo é porque estou editando o registro
		if ($id != null){
			#então busca o registro do banco
			$send['data'] = $model->findById($id);
		}

		#busca todos os registros
		$send['lista'] = $model->all();

		$send['tipos'] = [0=>"Escolha uma opção", 1=>"Usuário comum", 2=>"Admin"];

		#chama a view
		render("veiculos", $send);
	}

	
	function salvar($id=null){

		$model = new veiculos();
		
		if ($id == null){
			$id = $model->save($_POST);
		} else {
			$id = $model->update($id, $_POST);
		}
		
		redirect("veiculos/index/$id");
	}

	function deletar(int $id){
		
		$model = new veiculos();
		$model->delete($id);

		redirect("veiculos/index/");
	}


}
