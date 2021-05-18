<?php

namespace App\Controllers;

define('DEBUG','0');

//os recursos do miniframework
use MF\Controller\Action;
use MF\Model\Container;

class IndexController extends Action {

	public function index() {

		$this->view->login = isset($_GET['login']) ? $_GET['login'] : '';
		$this->render('index');
	}

	public function inscreverse() {


		$this->view->usuario = array(
			'nome'=>'',
			'email'=>'',
			'senha'=>''
		);

		
		$this->view->erroCadastro =  false;
		$this->render('inscreverse');
	}

	public function registrar() {

		// recebe dados
			$usuario = Container::getModel('usuario');

			$usuario->__set('nome',$_POST['nome']);
			$usuario->__set('email',$_POST['email']);
			$usuario->__set('senha',$_POST['senha']);

			if($usuario->validarCadastro() && count($usuario->getUsuarioPorEmail())==0){
					$usuario->salvar();
					$this->render('cadastro');
			}else{
			  //ocorreu um erro de preenchimento de dados
				
				$this->view->usuario = array(
					'nome'=>$_POST['nome'],
					'email'=>$_POST['email'],
					'senha'=>$_POST['senha']
				);
				$this->view->erroCadastro =  true;
				$this->render('inscreverse');
			}



		// sucesso

		//erro
		$this->render('inscreverse');
	}




}


?>