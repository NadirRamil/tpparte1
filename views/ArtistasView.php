<?php
require_once './libs/smarty-4.2.1/libs/Smarty.class.php';

class ArtistasView{
    private $smarty;

    function __construct() {
        $this->smarty = new Smarty();
      
    }
    function showartistas($artistas, $error){
        $this->smarty->assign('cantante', $artistas);
        $this->smarty->assign('error', $error);
        $this->smarty->assign('titulo', 'Agrega un artista');
        $this->smarty->display('templates/artistalist.tpl');
        
    }
    function showartistaRecitales($artistaRecitales ,$artista){
        $this->smarty->assign('artista', $artista);
        $this->smarty->assign('recitales', $artistaRecitales);
        $this->smarty->display('templates/artistaRecitales.tpl');
    }    
    function showFormEdit($artista){
        $this->smarty->assign('titulo', 'Edita el artista');
        $this->smarty->assign('artista', $artista);
        $this->smarty->display('./templates/editartista.tpl');
    
       }

}?>