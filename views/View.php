<?php
require_once './libs/smarty-4.2.1/libs/Smarty.class.php';

class View{
    private $smarty;

    function __construct($user) {
        $this->smarty = new Smarty();
        $this->smarty->assign('user', $user);

    }
    function showHomeLocation(){
        header("Location: ".BASE_URL."home");
    }
  
   function showFormLogin($error = null) {
        $this->smarty->assign("title", 'Log in');
        $this->smarty->assign("error", $error);
        $this->smarty->display('templates/login.tpl');
}

    function showErrorDefault(){
        $this->smarty->assign('error', '404 page not found');
        $this->smarty->display('templates/errordefault.tpl');
}

}?>
