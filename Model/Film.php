<?php

namespace Model;

use PDO;
use PDOException;
use Model\Connection;

class Film
{
    private $db;

    public function __construct()
    {
        $this->db = Connection::getConnection();
    }

    public function addFilm($filme, $id_usuario)
    {
    try {
        $sql = "INSERT INTO film (filme, id_usuario) VALUES (:filme, :id_usuario)";
        $connection = $this->db->prepare($sql);

        $connection->bindParam(':filme', $filme, PDO::PARAM_STR);
        $connection->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);

        return $connection->execute();
    } catch (PDOException $error) {
        die("Erro ao registrar filme: " . $error->getMessage());
        return false;
    } 
}

public function getFilmesByUsuario($id_usuario)
{
    try {
        $sql = "SELECT * FROM film WHERE id_usuario = :id_usuario";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    } catch (PDOException $e) {
        die("Erro ao buscar filmes: " . $e->getMessage());
    }
}

public function deletarFilme($id_filme, $id_usuario)
{
    try {
        $sql = "DELETE FROM film WHERE id = :id AND id_usuario = :id_usuario";
        $stmt = $this->db->prepare($sql);
        $stmt->bindParam(':id', $id_filme, PDO::PARAM_INT);
        $stmt->bindParam(':id_usuario', $id_usuario, PDO::PARAM_INT);
        return $stmt->execute();
    } catch (PDOException $e) {
        die("Erro ao deletar filme: " . $e->getMessage());
    }
}

}
