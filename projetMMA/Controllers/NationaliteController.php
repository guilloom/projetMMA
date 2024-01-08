<?php

namespace Controllers;

//use Symfony\Component\Routing\Annotation\Route;
use Nationalite;
use Doctrine\ORM\Query\ResultSetMapping;

class NationaliteController extends Controller {

    public function create()
    {
        echo $this->twig->render('nationalite.html');
    }

    public function insert($params) {

        $em = $params['em'];
        $nom =($_POST['name']);

        $newNationalite = new Nationalite();
        $newNationalite-> name($name);

        $em->persist($newNationalite);
        $em->flush();

        header('Location: start.php?c=user&t=nationaliteList');
    }

    public function edit($params) {
        $id = $params['get']['id'];
        $em = $params["em"];
        $user = $em->find('Nationalite', $id);
        echo $this->twig->render('edit.html', ['nationalite' => $nationalite]);

    }

    public function update($params) {
        $id = $params['get']['id'];
        $em = $params['em'];
        $user = $em->find('Nationalite', $id);

        $user->setNom = $params['post']['nom'];
        $user->setPrenom =$params['post']['prenom'];



        $em->flush();
        $this->nationaliteList();
        //echo $this->twig->render('edit.html', ['user' => $user]);
    }
}
?>
