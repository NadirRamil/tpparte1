<?php

class RecitalesModel {

    private $db;

    public function __construct() {
        $this->db = new PDO('mysql:host=localhost;'.'dbname=tpespecial;charset=utf8', 'root', '');
    }

     //----------------------------Function getAllRecitales --------------------//
    //Devuelve la lista de recitales completa.
    public function getAllrecitales() {
        // 1. abro conexión a la DB
        // ya esta abierta por el constructor de la clase
        // 2. ejecuto la sentencia (2 subpasos)
        $query = $this->db->prepare("SELECT recitales.*,artistas.nombre 
                                     as artistas 
                                     FROM recitales 
                                     JOIN artistas 
                                     ON recitales.artista_id = artistas.artista_id");
        $query->execute();
         // 3. obtengo los resultados
        $recitales= $query->fetchAll(PDO::FETCH_OBJ); // devuelve un arreglo de objetos
        return $recitales;
    }

     //----------------------------Function getRecital --------------------//
    public function getrecital($id){
        $query = $this->db->prepare("SELECT recitales.*,artistas.nombre 
                                     as artistas 
                                     FROM recitales 
                                     JOIN artistas 
                                     ON recitales.artista_id = artistas.artista_id 
                                     WHERE id_recital = ?");
        $query->execute(array($id));
        $recital = $query->fetch(PDO::FETCH_OBJ);
        return $recital;
    }

        //----------------------------Funcion deleteRecital--------------------//
    public function deleterecitalFromDB($id){
        $sentencia = $this->db->prepare("DELETE FROM recitales WHERE id_recital = ?");
        $response = $sentencia->execute(array($id));
    }

     //----------------------------Funcion insertRecital--------------------//
    public function Insertarrecital($fecha, $lugar, $artista_id){
        $query = $this->db->prepare("INSERT INTO recitales (fecha, lugar, artista_id) VALUES (?, ?, ?)");
        $query->execute([$fecha, $lugar, $artista_id]);

        return $this->db->lastInsertId();
    }

     //----------------------------Funcion editRecital --------------------//
    public function editrecital($fecha, $lugar, $artista_id, $id_recital){
        $query = $this->db->prepare('UPDATE recitales 
                                     SET fecha= ?, lugar = ?, artista_id = ? 
                                     WHERE id_recital = ?');
        $query->execute([$fecha, $lugar, $artista_id, $id_recital]);
    }
    
    
}