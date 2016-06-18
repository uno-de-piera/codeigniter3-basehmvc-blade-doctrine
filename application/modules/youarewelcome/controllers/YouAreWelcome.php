<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Class YouAreWelcome
 */
class YouAreWelcome extends BB_Controller
{
    /**
     * @desc custom autoload for each controller with public property $autoload
     * @var array
     */
    public $autoload = array(
        "libraries" => array( "session" )
    );

    /**
     * YouAreWelcome constructor.
     */
    public function __construct()
    {
        self::$profiler = FALSE; //habilitar el profiler de la app
        $this->module = APPPATH . "modules/youarewelcome"; //establecemos el modulo
        parent::__construct();
    }

    /**
     * @desc Crea un nuevo usuario
     */
    public function create_user()
    {
        //creamos una instancia de la entidad User
        $user = new Entities\User;

        //establecemos las propiedades a través de los setters
        $user->setUsername("bcnbit");
        $user->setEmail("bcnbit@mail.com");
        $user->setPassword("bcnbit");

        //guardamos la entidad en la tabla users
        $this->doctrine->em->persist($user);
        $this->doctrine->em->flush();
        echo "Se ha creado el usuario con ID " . $user->getId() . "\n";
    }

    /**
     * @desc Obtiene todos los usuarios de la entidad User
     */
    public function get_all_users()
    {
        //obtenemos y mostramos todos los usuarios con el método findAll disponible
        $users = $this->doctrine->em->getRepository("Entities\\User")->findAll();
        if( ! empty($users))
        {
            foreach ($users as $user)
            {
                echo sprintf(
                    "- %s, %s, %s, %s <br>",
                    $user->getUsername(), $user->getPassword(), $user->getEmail(), $user->getCreated()->format("d/m/Y")
                );
            }
        }
        else
        {
            echo "No hay usuarios";
        }
    }

    /**
     * @param $id
     * @desc Obtiene un usuario por su id
     */
    public function find($id)
    {
        //obtiene un usuario con el método find de otra forma.
        $user = $this->doctrine->em->find("Entities\\User", $id);
        if ($user === null)
        {
            echo "No existe el usuario.\n";
            exit();
        }

        echo sprintf(
            "- %s, %s, %s, %s <br>",
            $user->getUsername(), $user->getPassword(), $user->getEmail(), $user->getCreated()->format("d/m/Y")
        );
    }

    /**
     * @param $id
     * @param $username
     * @desc Actualiza un usuario
     */
    public function update($id, $username)
    {
        //obtenemos el usuario
        $user = $this->doctrine->em->getRepository("Entities\\User")->find($id);

        if ($user === null)
        {
            echo "No existe el usuario.\n";
            exit();
        }

        //seteamos su nombre y lo actualizamos
        $user->setUsername($username);
        $this->doctrine->em->flush();

        echo "<pre>";
        print_r($user);
    }

    /**
     * @param $id
     * @desc Obtenemos un usuario por su id con el método findOneBy por su id y si existe lo eliminamos
     */
    public function remove($id)
    {
        $user = $this->doctrine->em->getRepository("Entities\\User")->findOneBy(["id" => $id]);
        if ($user === null)
        {
            echo "No existe el usuario.\n";
            exit();
        }
        $this->doctrine->em->remove($user);
        $this->doctrine->em->flush();
    }

    /**
     * @param $username
     */
    public function find_by_username($username)
    {
        $user = $this->doctrine->em->getRepository("Entities\\User")->findByUsername($username);
        echo sprintf(
            "- %s, %s, %s, %s <br>",
            $user->getUsername(), $user->getPassword(), $user->getEmail(), $user->getCreated()->format("d/m/Y")
        );
    }

    /**
     * @desc Crea un post asociado a un usuario
     */
    public function create_post()
    {
        //obtenemos un usuario
        $user = $this->doctrine->em->find("Entities\\User", 1);
        $post = new Entities\Post();
        $post->setUser($user);
        $post->setTitle("Título post 1 user 1");
        $post->setBody("Body post 1 user 1");
        $this->doctrine->em->persist($post);
        $this->doctrine->em->flush();
    }

    /**
     * @desc obtiene un usuario y todos sus posts
     * @param $id
     */
    public function user_with_posts($id)
    {
        $user = $this->doctrine->em->find("Entities\\User", $id);
        foreach($user->getPosts() as $post)
        {
            echo sprintf(
                "- %s, %s, %s <br>",
                $post->getTitle(), $post->getBody(), $post->getCreated()->format("d/m/Y")
            );
        }
    }

    /**
     * @desc obtiene el creador de un post a través de su post
     * @param $id
     */
    public function get_user_from_post($id)
    {
        $post = $this->doctrine->em->find("Entities\\Post", $id);
        echo sprintf(
            "- %s, %s, %s, %s <br>",
            $post->getUser()->getUsername(), $post->getTitle(), $post->getBody(), $post->getCreated()->format("d/m/Y")
        );
    }

    /**
     * @param $id
     * @desc Obtenemos un usuario por su id con el método findOneBy por su id y si existe lo eliminamos
     */
    public function remove_user_and_posts($id)
    {
        $user = $this->doctrine->em->getRepository("Entities\\User")->findOneBy(["id" => $id]);
        if ($user === null)
        {
            echo "No existe el usuario.\n";
            exit();
        }
        $this->doctrine->em->remove($user);
        $this->doctrine->em->flush();
    }

    /**
     * @desc display modules/youarewelcome/views/index.blade.php views
     */
    public function index()
    {
        echo $this->blade->view()->make('index', ['name' => 'pepe', 'users' => ['juan', 'pepe', 'andrés'], 'session_key' => $this->config->item('encryption_key')])->render();
    }

    public function docs()
    {
        echo $this->blade->view()->make('docs')->render();
    }
}