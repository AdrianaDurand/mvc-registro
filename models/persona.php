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

  public function registrarPersona($datos = []){
    try{
      // 1. Preparamos la consulta
      $consulta = $this->accesoBD->prepare("CALL spu_registrar_persona(?,?,?,?,?,?,?,?,?,?)");
      // 2. Ejecutamos la consulta
      $consulta->execute(
        array(
          $datos["nombres"],
          $datos["apellidos"],
          $datos["dni"],
          $datos["fecha_nacimiento"],
          $datos["direccion"],
          $datos["ocupacion"],
          $datos["telefono"],
          $datos["email"],
          $datos["estado_civil"],
          $datos["discapacidad"]
        )
      );

    }
    catch(Exception $e){
      die($e->getMesssage());
    }
  }

  public function eliminarPersona($idpersona = 0){
    try{
      $consulta = $this->accesoBD->prepare("CALL spu_eliminar_persona(?)");
      $consulta->execute(array($idpersona));
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