<?php
namespace App\Controllers;

class FuncionarioController extends BaseController {
	public function index()
	{
		return redirect()->to(base_url("FuncionarioController/inserirFuncionario"));
	}

	public function inserirFuncionario()
	{
		$request = service('request');
		$FuncionarioModelo = new \App\Models\FuncionarioModel();
		$UsuarioModel = new \App\Models\UsuarioModel();
		if($request -> getMethod() === 'post') 
		{			
			$codusuario = $request->getPost('codUsu');
			$registros = $UsuarioModel->find($codusuario);
	
			if(!isset($registros->codusu) && $codusuario!=null) {
				$data['msg'] = 'Usuario não encontrado';
				$data['cor'] = 'alert-warning';
				$data['icon'] = 
				"<svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' fill='currentColor' class='bi bi-exclamation-triangle-fill flex-shrink-0 me-2' viewBox='0 0 16 16' role='img' aria-label='Warning:'>
					<path d='M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z'/>
				</svg>";
			}
			elseif ($codusuario==null) {
				$FuncionarioModelo->set('codusu_FK', $request->getPost('codusu_FK'));
				$FuncionarioModelo->set('nomeFun', $request->getPost('nomeFun'));
				$FuncionarioModelo->set('foneFun', $request->getPost('foneFun'));
				

				if($FuncionarioModelo->insert()) {
					$data['msg'] = 'Informações cadastradas com sucesso';
					$data['cor'] = 'alert-success';
					$data['icon'] = 
					"<svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' fill='currentColor' class='bi bi-check-circle-fill flex-shrink-0 me-2' viewBox='0 0 16 16' aria-label='Success:'>
						<path d='M16 8A8 8 0 1 1 0 8a8 8 0 0 1 16 0zm-3.97-3.03a.75.75 0 0 0-1.08.022L7.477 9.417 5.384 7.323a.75.75 0 0 0-1.06 1.06L6.97 11.03a.75.75 0 0 0 1.079-.02l3.992-4.99a.75.75 0 0 0-.01-1.05z'/>
					</svg>";
				}
				else {
					$data['msg'] = 'Falha ao cadastrar as Informações';
					$data['cor'] = 'alert-danger';
					$data['icon'] = 
					"<svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' fill='currentColor' class='bi bi-exclamation-triangle-fill flex-shrink-0 me-2' viewBox='0 0 16 16' role='img' aria-label='Warning:'>
						<path d='M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z'/>
					</svg>";
				}
			}
			else {
				$data['usuario'] = $registros;
			}
			
		}

		if(isset($data)) {
			echo view('header', $data);
			echo view('cadFun', $data);
		}
		else {
			echo view('header');
			echo view('cadFun');
		}

		echo view('footer');
	}
	public function todosFuncionarios() {
		$request = service('request');
		$codFuncionario = $request->getPost('codFun');
		$codFunAlterar = $request->getPost('codFunAlterar');
		if($codFuncionario) {
			$this->deletarFuncionario($codFuncionario, 0);
		}
		else if($codFunAlterar) {
			$this->alterarFuncionario($codFunAlterar, 0);
		}

		$FuncionarioModel = new \App\Models\FuncionarioModel();
		$registros = $FuncionarioModel -> find();
		$data['funcionarios'] = $registros;

		echo view('header', $data);
		echo view('listaFun', $data);
		echo view('footer');
	}
	public function listaCodFuncionario() {
		$request = service('request');
		$codFuncionario = $request->getPost('codFun');
		$codFunDel = $request->getPost('codFunDel');
		$codFunAlterar = $request->getPost('codFunAlterar');

		if($codFunDel) {
			$this->deletarFuncionario($codFunDel, 1);
		}
		else if($codFunAlterar) {
			$this->alterarFuncionario($codFunAlterar, 1);
		}

		$FuncionarioModel = new \App\Models\FuncionarioModel();
		$registros = $FuncionarioModel->find($codFuncionario);



		$data['funcionario'] = $registros;

		if(!isset($registros->codFun) && $codFuncionario!=null) {
			$data['msg'] = 'Funcionario não encontrado';
			$data['cor'] = 'alert-warning';
			$data['icon'] = 
			"<svg xmlns='http://www.w3.org/2000/svg' width='24' height='24' fill='currentColor' class='bi bi-exclamation-triangle-fill flex-shrink-0 me-2' viewBox='0 0 16 16' role='img' aria-label='Warning:'>
				<path d='M8.982 1.566a1.13 1.13 0 0 0-1.96 0L.165 13.233c-.457.778.091 1.767.98 1.767h13.713c.889 0 1.438-.99.98-1.767L8.982 1.566zM8 5c.535 0 .954.462.9.995l-.35 3.507a.552.552 0 0 1-1.1 0L7.1 5.995A.905.905 0 0 1 8 5zm.002 6a1 1 0 1 1 0 2 1 1 0 0 1 0-2z'/>
			</svg>";
		}

		echo view('header', $data);
		echo view('listaCodFun', $data);
		echo view('footer');		
	}
	public function alterarFuncionario($codFunAlterar=null, $page=null) {

		if($page == 1)
			$pageName = 'FuncionarioController/listaCodFuncionario';
		else
			$pageName = 'FuncionarioController/todosFuncionarios';

		if(is_null($codFunAlterar)) {
			return redirect()->to(base_url($pageName));
		}
		$request = service('request');
		$nomeFun = $request->getPost('nomeFun');
		$foneFun = $request->getPost('foneFun');

		$FuncionarioModel = new \App\Models\FuncionarioModel();
		$registros = $FuncionarioModel->find($codFunAlterar);
	
		if($codFunAlterar) {
			$registros->nomeFun = $nomeFun;
			$registros->foneFun = $foneFun;

			if($FuncionarioModel->update($codFunAlterar, $registros)) {
				return redirect()->to(base_url($pageName));
			} else {
				return redirect()->to(base_url($pageName));
			}
		}
	}

	public function deletarFuncionario($codFuncionario=null, $page=null) {
		if($page == 1)
			$pageName = 'FuncionarioController/listaCodFuncionario';
		else
			$pageName = 'FuncionarioController/todosFuncionarios';

		if(is_null($codFuncionario)) {
			return redirect()->to(base_url($pageName));
		}

		$FuncionarioModel = new \App\Models\FuncionarioModel();
		if($FuncionarioModel->delete($codFuncionario)) {
			return redirect()->to(base_url($pageName));
		} else {
			return redirect()->to(base_url($pageName));
		}
	}

}

?>