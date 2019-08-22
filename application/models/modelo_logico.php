<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Modelo_logico extends CI_Model {


    
    public function __construct() {
        parent::__construct();
        //Cargo el modelo que contiene las consultas a la DB
        $this->load->model('modelo_database');
    }
    
   /**  
    * Busca en un array con N elementos un valor X
    * Devuelve un par de elementos que cumplan la condición o “false” en caso de no encontrarlos.
    * @access public
    * @param $valueToSearch representa el valor a buscar dentro del array
    * @param array $arrayData, representa el array donde se buscar el valor X
    */
    public function searchInArray($valueToSearch,$arrayData = array()){
       
       
        $i = 0;
        $arrayLength = count($arrayData);
        
        //Suma las primeras columnas del array buscado el valor de X, si no lo encuentra lo revuelve y comienza de nuevo

        while ($arrayData[0] + $arrayData[1] != $valueToSearch && $i < $arrayLength){
            shuffle($arrayData);
            $i++;
         }

         // Verifica si las columnas seleccionadas del array son numeros positivos, y si la suma de ambas es igual a X
        if($arrayData[0] > 0 && $arrayData[1] > 0 && $arrayData[0] + $arrayData[1] == $valueToSearch){
            
            //Almacena el resultado positivo en la db
            $this->modelo_database->saveExecution(json_encode($arrayData),$arrayData[0].' + '.$arrayData[1],true);
            // Retorna los valores que se sumaron para llegar a X
            return 'X = '.$valueToSearch.' <br> Respuesta correcta : <b style="color:red">'. $arrayData[0] .'</b> y  <b style="color:red">'. $arrayData[1].' </b> ';
        }else{
             //Almacena el resultado en la db
            $this->modelo_database->saveExecution(json_encode($arrayData),false,false);
            return false;
        }

    }

    /** 
     * Obtiene y establece los valores de las estadisticas en base a los datos obtenidos de las consultas a la DB
     * retorna un array con los valores finales
     */

    public function generateStatistics(){

        $total_ejecuciones = $this->modelo_database->countExecutions();

        $casos_positivos = $this->modelo_database->countPositiveExecutions();

        $ratio_positivos = $casos_positivos / $total_ejecuciones;

        return array('total' => $total_ejecuciones, 'positivos' => $casos_positivos, 'ratio' => $ratio_positivos);
        
    }
    

}

/* End of file Modelo_logico.php */
