<?php

require_once '../models/persona.php';

if (isset($_POST['operacion'])){

  $curso = new Curso();

  if($_POST['operacion'] == 'listar'){

    $datosObtenidos = $curso->listarCursos();

    // En esta ocación NO enviaremos un objeto JSON, es su lugar el controlador renderizará las filas que necesita el <tbody></tbody>
    //echo json_encode($datosObtenidos);

    // PASO 1: Verificar que el objeto contenga datos
    if ($datosObtenidos){
      $numeroFila = 1;
    // PASO 2: Recorrer todo el objeto
      foreach($datosObtenidos as $curso){
    //PASO 3: Ahora construimos las filas
        echo "
          <tr>
          <td>{$numeroFila}</td>
          <td>{$curso['nombrecurso']}</td>
          <td>{$curso['especialidad']}</td>
          <td>{$curso['complejidad']}</td>
          <td>{$curso['fechainicio']}</td>
          <td>{$curso['precio']}</td>
          <td>
            <a href='#' data-idcurso='{$curso['idcurso']}' class='btn btn-danger btn-sm eliminar'><i class='bi bi-trash3-fill'></i></a>
            <a href='#' data-idcurso='{$curso['idcurso']}' class='btn btn-warning btn-sm editar'><i class='bi bi-pencil-fill'></i></a>
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
      "nombrecurso" => $_POST['nombrecurso'],
      "especialidad" => $_POST['especialidad'],
      "complejidad" => $_POST['complejidad'],
      "fechainicio" => $_POST['fechainicio'],
      "precio" => $_POST['precio']
    ];

    // Paso2: Enviar el arreglo como parametro del metodo registrar
    $curso->registrarCurso($datosForm);
}

  if($_POST['operacion'] == 'eliminar'){
    $curso->eliminarCurso($_POST['idcurso']);
}

}