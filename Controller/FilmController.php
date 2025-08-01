<?php

namespace Controller;

use Model\film;
use Exception;

class FilmController{

    private $filmModel;

    public function __construct()
    {
        $this->filmModel = new Film();
    }

    public function CreateFilm($filme, $id_usuario)
{
   if (empty($filme) || empty($id_usuario)) {
       return false;
   }

   return $this->filmModel->addFilm($filme, $id_usuario);
}

public function getFilmesDoUsuario($id_usuario)
{
    return $this->filmModel->getFilmesByUsuario($id_usuario);
}

public function deletarFilme($id_filme, $id_usuario)
{
    return $this->filmModel->deletarFilme($id_filme, $id_usuario);
}

}