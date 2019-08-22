<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Initialize extends CI_Controller {

    //Variable de tipo array, que contiene la información que se mostrara en la/s vista/s
    private $data_view = array();
    
    //Variable de tipo array, a la que se le asignaran N cantidad de números.
    private $randomArray = array();
    
    public function __construct() {
        parent::__construct(); 
        //Cargo el modelo que contiene la logica de la aplicación
        $this->load->model('modelo_logico');

    }
    

    public function index() {
        //Asignación de valores random al array
        for ($i=0; $i < 20 ; $i++) { 
            $this->randomArray[] = rand(-12,20);
        }

        

        $this->data_view['array_generado'] = json_encode($this->randomArray);

        $this->data_view['resultado_op'] = $this->modelo_logico->searchInArray(13,$this->randomArray);

        $this->data_view['estadisticas'] = $this->modelo_logico->generateStatistics();

        //Cargo la vista
        $this->load->view('init_view',$this->data_view);


    }

}

/* End of file Controllername.php */
