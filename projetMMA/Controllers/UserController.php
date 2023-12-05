<?php

namespace Controllers;

//use Symfony\Component\Routing\Annotation\Route;
use User;
use Doctrine\ORM\Query\ResultSetMapping;

class UserController extends Controller {

        public function one($params)
        {
            $entityManager = $params["em"];
            $connectUser = "Un seul";

            $user = new User();

            $user -> setNom("LINEATTE");

            $user -> setPrenom("Guillaume");

            $user -> setAvatar();
            //var_dump($user);die;
            $entityManager -> persist($user);

            $entityManager -> flush();

            echo $this->twig->render('user/user.html', ['connectUser' => $connectUser, 'params' => $params]);
        }

    public function userList($params) {
        $entityManager = $params["em"];
        $userRepository = $entityManager->getRepository('User');
        $users = $userRepository->findAll();

        echo $this->twig->render('user/userList.html', ['users' => $users]);
    }

    public function create()
    {
        echo $this->twig->render('/user/create.html');
    }

    public function insert($params) {

        $em = $params['em'];
        $name =($_POST['name']);
        $surname =($_POST['surname']);
        $age =($_POST['age']);
        //var_dump($_POST);die;
        $avatar=file_get_contents($_FILES['avatar']['tmp_name']);

        $newUser = new User();
        $newUser->setName($name);
        $newUser->setSurname($surname);
        $newUser->setAge($age);
        $newUser->setAvatar($avatar);

        $em->persist($newUser);
        $em->flush();

        header('Location: start.php?c=user&t=userList');
    }

    public function read($params) {

    }

    public function edit($params) {

        $id = $params['get']['id'];
        $em = $params["em"];
        $user = $em->find('User', $id);
        echo $this->twig->render('edit.html', ['user' => $user]);

    }

    public function update($params) {
        $id = $params['get']['id'];
        $em = $params['em'];
        $user = $em->find('User', $id);

        //var_dump($params['post']);die;
        $user->setName = $params['post']['name'];
        $user->setSurname =$params['post']['surname'];
        $user->setAge = $params['post']['age'];
        $user->setAvatar = $params['post']['avatar'];



        $em->flush();
        $this->userList();
        //echo $this->twig->render('edit.html', ['user' => $user]);
    }
}
?>
