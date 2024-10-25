<?php

require_once 'app/models/task.model.php';
require_once 'app/views/task.api.view.php';

class TaskApiController {

    private $model;
    private $view;

    public function __construct() {
        $this->model = new TaskModel();
        $this->view = new APIView();
    }
  
    public function getAll(){
        $tareas = $this->model->getTareas();

        return $this->view->response($tareas, 200);
    }

    public function get($req){
        $id = $req->params->id;

        $tarea = $this->model->getTask($id);

        if(!$tarea){
            return $this->view->response("No existe la tarea con el id = $id", 404);
        }

        return $this->view->response($tarea, 200);
    }

    public function delete($req){
        $id = $req->params->id;

        $tarea = $this->model->getTask($id);

        if(!$tarea){
            return $this->view->response("No existe la tarea con el id = $id", 404);
        }
        else{
            $this->model->deleteTask($id);
            return $this->view->response("Se a eliminado la tarea con id = $id", 200);
        }
    }

    public function create($req){
        $descripcion = $req->body->descripcion;
        $terminada = $req->body->terminada;
        $prioridad = $req->body->prioridad;

        if(empty($descripcion) || empty($terminada) || empty($prioridad)){
            return $this->view->response("Faltan completar campos", 401);
        }

        $dato = $this->model->createTask($descripcion, $terminada, $prioridad);

        return $this->view->response($dato, 200);

    }

    public function update($req){
        $id = $req->params->id;

        $tarea = $this->model->getTask($id);

        if(!$tarea){
            return $this->view->response("No existe tarea con id = $id", 404);
        }

        $descripcion = $req->body->descripcion;
        $terminada = $req->body->terminada;
        $prioridad = $req->body->prioridad;

        if(empty($descripcion) || empty($terminada) || empty($prioridad)){
            return $this->view->response("Faltan completar campos", 401);
        }

        $idEditado = $this->model->updateTask($descripcion, $terminada, $prioridad, $id);

        return $this->view->response($idEditado, 200);
    }
}
  