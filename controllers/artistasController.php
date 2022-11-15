<?php
require_once './models/artistasModel.php';
require_once './views/ArtistasView.php';
require_once './helpers/AuthHelper.php';

class ArtistasController {
    private $model;
    private $view;
    private $authHelper;

    function __construct(){
        $this->model = new ArtistasModel();
        $this->authHelper = new AuthHelper();
        $this->view =new ArtistasView($this->authHelper->getUser());

        
    }

     //----------------------------Funcion ShowArtistas--------------------------//
    function showartistas(){
        $artistas = $this->model->getAllartistas();
        $this->view->showartistas($artistas, $error = false);
    }

    //----------------------------FuncionVerArtistaDetalle--------------------//
    function viewartistaRecitales($id){
        $artistaRecitales = $this-> model->getrecitales($id);
        $artista = $this-> model ->getartista($id);
        
        if(!empty($artistaRecitales)){
            $this->view->showartistaRecitales($artistaRecitales, $artista);
        }else{
            $artistas = $this->model->getAllartistas();
            $this->view->showartistas($artistas, "No se encuentra recitales del artista elegido.");
        }
    }

    //----------------------------Funcion insertArtista--------------------//
    function addartista() {
        $this->authHelper->checkLoggedIn();
        //todo: validar entrada de datos
        $nombre= $_POST['nombre'];
        $nacionalidad= $_POST['nacionalidad'];
        $id = $this->model->insertartista($nombre, $nacionalidad);
         header("Location: " . BASE_URL . 'artistas'); 
    }

    
    //----------------------------Funcion deleteArtista--------------------//
    function deleteartista($id){
        $this->authHelper->checkLoggedIn();
        try{ 
            $this->model->deleteartistaById($id);
            header("Location: " . BASE_URL . 'artistas');
            
        }catch(Exception $e){
            $artistas = $this->model->getAllartistas();
            $this->view->showartistas($artistas, "No se puede eliminar el artista ya que esta tiene recitales asociados, elimine primero el recital.");
        }
    }
    
    //----------------------------Funcion editArtista--------------------//
    function editartista ($id){
        $this->authHelper->checkLoggedIn();
        if((isset($_POST['nombre']))){
            $artista_id = $id;
            $nombre= $_POST['nombre'];
            $nacionalidad= $_POST['nacionalidad'];
            
        $id = $this->model->editartista($nombre, $nacionalidad, $artista_id, );
        
        header("Location: ".BASE_URL. 'artistas');
        }
    }
    function updateartista($id){
        $this->authHelper->checkLoggedIn();
        $artista = $this->model->getartista($id);
        $this->view->showFormEdit($artista);
    }

}
