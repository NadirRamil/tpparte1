<?php
require_once './libs/smarty-4.2.1/libs/Smarty.class.php';

class RecitalesView{
    private $smarty;

    function __construct() {
        $this->smarty = new Smarty();
      
    }
    function showrecitales($recitales, $artistas){
        $this->smarty->assign('titulo', 'Agrega un recital');
        $this->smarty->assign('recitales', $recitales);
        $this->smarty->assign('artistas', $artistas);
        $this->smarty->display('templates/recitaleslist.tpl');
    }
    function showrecital($recital){
        $this->smarty->assign('recital', $recital);
        $this->smarty->display('templates/viewrecital.tpl');

    }
    function editrecital($recital, $artistas){
        $this->smarty->assign('titulo', 'Edita el recital');
        $this->smarty->assign('recital', $recital);
        $this->smarty->assign('artista', $artistas);
        $this->smarty->display('./templates/editrecital.tpl');
    
       }

}?>