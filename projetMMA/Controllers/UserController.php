<?php

namespace Controllers;

//use Symfony\Component\Routing\Annotation\Route;
use User;
use Doctrine\ORM\Query\ResultSetMapping;

class UserController extends Controller {

        public function showUser($params)
        {
            $entityManager = $params["em"];
            $connectUser = "Un seul";

            $user = new User();

            //$user -> setNom("LINEATTE");

            //$user -> setPrenom("Guillaume");

            $user -> setAvatar($user);
            //var_dump($user);die;
            $entityManager -> persist($user);

            $entityManager -> flush();

            echo $this->twig->render('user/user.html', ['connectUser' => $connectUser, 'params' => $params]);
        }

    public function userList($params) {
        $entityManager = $params["em"];
        $userRepository = $entityManager->getRepository('User');
        $users = $userRepository->findAll();

        echo $this->twig->render('user/userList.html', ['users' => $users, 'url' => $params['url']]);
    }

    public function create()
    {
        echo $this->twig->render('user/create.html');
    }

    public function insert($params) {
        if (
            isset($_POST['name']) &&
            isset($_POST['surname']) &&
            isset($_POST['age']) &&
            isset($_FILES['avatar'])
        ) {
            $em = $params['em'];
            $name = $_POST['name'];
            $surname = $_POST['surname'];
            $age = $_POST['age'];
            $avatar = file_get_contents($_FILES['avatar']['tmp_name']);
            $password = $_POST['password'];

            $newUser = new User();
            $newUser->setName($name);
            $newUser->setSurname($surname);
            $newUser->setAge($age);
            $newUser->setAvatar($avatar);
            $newUser->setPassword($password);

            $em->persist($newUser);
            $em->flush();

            header('Location: start.php?c=user&t=userList');
        }
    }

    public function read($params) {

    }

    public function edit($params) {
        $id = $params['get']['id'];
        $em = $params["em"];
        $user = $em->find('User', $id);

        echo $this->twig->render('user/edit.html', ['user' => $user]);
    }


    public function update($params) {
        $id = $params['post']['id'] ?? $params['get']['id'];

        $em = $params['em'];
        $user = $em->find('User', $id);

        $user->setName($params['post']['name']);
        $user->setSurname($params['post']['surname']);
        $user->setAge($params['post']['age']);

        $em->flush();

        header('Location: start.php?c=user&t=userList');
    }

    //public function delete($params) {}

    public function login($params) {
        $em = $params['em'];

        echo $this->twig->render('/login.html');
    }

    public function check($params) {
        $em = $params['em'];
        $name = $_POST['name'];
        $password = $_POST['password'];

        $qb=$em->createQueryBuilder();
        $qb->select('u')
            ->from('User', 'u')
            ->where('u.name = :name')
            ->setParameter('name', $name);
        $query = $qb->getQuery();
        $users = $query->getResult();
        //$user = $users[0];

        if ($users) {
            $user = $users[0];
            echo "Connexion réussie !";
            echo $user->getPassword();

            echo $this->twig->render('user/userList.html',
            ['users' => $users, 'url' => $params['url']]);
        } else {
            echo $this->twig->render('user/create.html');
        }
    }
}
