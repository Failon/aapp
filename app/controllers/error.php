<?php
/**
*	Error controller
*
*	@params: null
	@return: merror, verror
*	@author: Toni
*/
	final class Error extends Controller{
		function __construct($params=null){
			parent::__construct($params);
			$this->conf=Registry::getInstance();

			$this->model=new mError;
			$this->view=new vError;
		}
		function home(){
			
			//home action
		}
	}