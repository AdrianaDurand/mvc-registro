<?php

require_once '../models/persona.php';

if (isset($_POST['operacion'])){

  $persona = new Persona();

  if($_POST['operacion'] == 'listar'){
    
    $datosObtenidos = $persona->listarPersonas();

    // En esta ocación NO enviaremos un objeto JSON, es su lugar el controlador renderizará las filas que necesita el <tbody></tbody>
    //echo json_encode($datosObtenidos);

    // PASO 1: Verificar que el objeto contenga datos
    if ($datosObtenidos){
      $numeroFila = 1;
    // PASO 2: Recorrer todo el objeto
      foreach($datosObtenidos as $persona){
    //PASO 3: Ahora construimos las filas
        echo "
          <tr>
          <td>{$numeroFila}</td>
          <td>{$persona['nombres']}</td>
          <td>{$persona['apellidos']}</td>
          <td>{$persona['dni']}</td>
          <td>{$persona['fecha_nacimiento']}</td>
          <td>{$persona['direccion']}</td>
          <td>{$persona['ocupacion']}</td>
          <td>{$persona['telefono']}</td>
          <td>{$persona['email']}</td>
          <td>{$persona['estado_civil']}</td>
          <td>{$persona['discapacidad']}</td>
          <td>
            <a href='#' data-idpersona='{$persona['idpersona']}' class='btn btn-danger btn-sm eliminar'><i class='bi bi-trash3-fill'></i></a>
            <a href='#' data-idpersona='{$persona['idpersona']}' class='btn btn-warning btn-sm editar'><i class='bi bi-pencil-fill'></i></a>
          </td>
          </tr>
        ";
        $numeroFila++;
      }
    }

  }

  if($_POST['operacion'] == 'registrar'){
    // Paso1: Recoger los datos que nos envía la vista (FORM, utilizando AJAX)
    // $_POST : Esto es lo que se nos envía desde FORM
    $datosForm = [
      "nombres"=> $_POST['nombres'],
      "apellidos"=> $_POST['apellidos'],
      "dni"=> $_POST['dni'],
      "fecha_nacimiento"=> $_POST['fecha_nacimiento'],
      "direccion"=> $_POST['direccion'],
      "ocupacion"=> $_POST['ocupacion'],
      "telefono"=> $_POST['telefono'],
      "email"=> $_POST['email'],
      "estado_civil"=> $_POST['estado_civil'],
      "discapacidad"=> $_POST['discapacidad']
    ];

    // Paso2: Enviar el arreglo como parametro del metodo registrar
    $persona->registrarPersona($datosForm);
}

  if($_POST['operacion'] == 'eliminar'){
    $persona->eliminarCurso($_POST['idcurso']);
}

}