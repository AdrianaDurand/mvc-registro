<?php

require_once "conexion.php";

//MODELO = CONTIENE LA LÓGICA
// extends : HERENCIA (POO) en PHP
class Persona extends Conexion{

  //Objeto que almacena la conexion que viene desde el padre(Conexion) y la compartirá con todos los métodos (CRUD+)
  private $accesoBD;

  //Constructor, INICIALIZAR
  public function __CONSTRUCT(){
    $this->accesoBD = parent::getConexion(); //el valor de retorno getConexion a sido asignada al objEto accesoDB
  }

  // Método listar cursos
  public function listarPersonas(){
    try{
      //1.Preparamos la consulta
      $consulta = $this->accesoBD->prepare("CALL spu_listar_personas()");
      //2.Ejecutamos la consulta
      $consulta->execute();
      //3.Devolvemos el resultado (array asociativo)
      return $consulta->fetchAll(PDO::FETCH_ASSOC);
    }
    catch(Exception $e){
      die($e->getMesssage());
    }
  }

  public function registrarCurso($datos = []){
    try{
      // 1. Preparamos la consulta
      $consulta = $this->accesoBD->prepare("CALL spu_cursos_registrar(?,?,?,?,?)");
      // 2. Ejecutamos la consulta
      $consulta->execute(
        array(
          $datos["nombrecurso"],
          $datos["especialidad"],
          $datos["complejidad"],
          $datos["fechainicio"],
          $datos["precio"]
        )
      );

    }
    catch(Exception $e){
      die($e->getMesssage());
    }
  }

  public function eliminarCurso($idcurso = 0){
    try{
      $consulta = $this->accesoBD->prepare("CALL spu_cursos_eliminar(?)");
      $consulta->execute(array($idcurso));
    }
    catch(Exception $e){
      die($e->getMesssage());
    }
  }

  public function actualizarCurso(){
    try{

    }
    catch(Exception $e){
      die($e->getMesssage());
    }
  }

}
?>