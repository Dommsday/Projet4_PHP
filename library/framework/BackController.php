<?php 

namespace frameworks;

class BackController extends Component{

	protected $action = '';
	protected $module = '';
	protected $page = null;
	protected $view = '';

	protected $managers = null;

	public function __construct(Application $app, $module, $action){

		parent::__construct($app);


		$this->managers = new Managers('PDO', PDOFactory::mysqlConnexion());
		$this->page = new Page($app);

		$this->setModule($module);
		$this->setAction($action);
		$this->setView($view);
	}

	public function execute(){

		$method = 'execute'.ucfirst($this->action);

		//Si l'argument peut être executé comme fonction
		if(is_callable([$this, $method])){

			$this->$method($this->app->httpRequest);

		}else{

			throw new \RuntimeException('L\'action "'.$this->action.'" n\'existe pas');
		}
	}

	public function setAction($action){

		if(!is_string($action) || empty($action)){
			throw new \InvalidArgumentExeption('L\'action doit être une chaîne de caractère et être précisée');
		}

		$this->action = $action;
	}

	public function setModule($module){

		if(!is_string($module) || empty($module)){
			throw new \InvalidArgumentExeption('Le module doit être une chaîne de caractère et être précisé');
		}

		$this->module = $module;
	}

	public function setView($view){

		if(!is_string($view) || empty($view)){
			throw new \InvalidArgumentExeption('La vue doit être une chaîne de caractère et être précisé');
		}
	}

	public function page(){

		return $this->page;
	}
}
