<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Modelo_database extends CI_Model {

    //Nombre de la tabla que se consultara   
    private $tabla_nombre = "backend";

    
    public function __construct() {
        parent::__construct();
    }

    /** 
     * Guarda en la DB, los datos obtenidos de las ejecuciones realizadas en searchInArray() ver Modelo_logico.php
     * @access public
     * @param array $array, toma los números ingresados en el array en las vistas o controladores
     * @param string $valores, toma los valores que se sumaron para obtener X
     * @param boolean $resultado, toma si la operacion finalizo de forma exitosa ( true ), o ( false ) si no lo fue
     */

    public function saveExecution($array,$valores,$resultado){
        //guardo en $tabla_nombre los datos que recibo
        $this->db->insert($this->tabla_nombre,array('array_generado'=> $array,'valores' => $valores, 'resultado' => $resultado));
    }
    
    /** 
     * Cuenta todos los registros en $tabla_nombre para obtener el indicador de total de ejecuciones
     * @access public
     */
    public function countExecutions(){
        // Cuento todos los registros en la tabla
        return $this->db->count_all_results($this->tabla_nombre);
    }

    /** 
     * Cuenta todos los registros en $tabla_nombre con valores positivos, para obtener el indicador de ejecuciones positivas
     * @access public
     */
    public function countPositiveExecutions(){
        
        $this->db->where('resultado', 1);
        $this->db->from($this->tabla_nombre);
        return $this->db->count_all_results();
    }
    

}

/* End of file Modelo_database.php */
