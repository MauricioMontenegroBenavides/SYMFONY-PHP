<?php
 //composer require symfony/maker-bundle --dev
/*  proporciona una serie de herramientas de línea de comandos que facilitan la creación de diferentes 
 elementos en una aplicación Symfony, como entidades, controladores, formularios, servicios, 
 pruebas y más */
 namespace App\Controller;

  /* AbstractController es una clase abstracta de Symfony y proporciona métodos y funcionalidades útiles
  para el controlador, como la gestión de plantillas, la gestión de formularios y la generación de URL */
 use App\Entity\Commnet;
 use App\Form\CommentType;
 use App\Entity\Sym;
 use Doctrine\ORM\EntityManagerInterface;// Este el sistema que administra mis entidades
 use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
 use Symfony\Component\HttpFoundation\Request;
 use Symfony\Component\HttpFoundation\Response;
 use Symfony\Component\Routing\Annotation\Route;// Este es le sistema de rutas

    class PageController extends AbstractController{//Cualquier controlador debe devolver una respuesta
        
        #[Route('/',name:'home')]// Esto dice cuando te conectas a la raiz del proYecto activa el metodo home
        //Se utiliza para asociar una URL específica con un controlador en Symfony.
        public function home(EntityManagerInterface $entityManager, Request $request){

           /* El $entityManager obtiene el repositorio getRepository(Comment::class) de Comment que es la
              entidad que me importado, y a partir de ahi utilizo el metodo findAll() */

            $form=$this->createForm(CommentType::class); // Creamos el formulario trabajamos con la clase que importamos 
            $form->handleRequest($request);// Trabajamos con el manejador del formulario, manejamos de manera directa su solicitud 
            if($form->isSubmitted() && $form->isValid()){// Pregunto si mi formulario ha sido enviado y si es correcto guardamos dentro de la base datos 
                  // Guardamos la información en la base de datos 
                $entityManager->persist($form->getData());// prepara la informacion
                $entityManager->flush();// guarda la informacion en la tabla
                return $this->redirectToRoute('home');
            }

            $consulta=$entityManager->getRepository(Commnet::class)->findBy([],[
                'id'=>'DESC'
            ]) ;

            return $this->render('home.html.twig',[
                'DA'=> $consulta,
                'form'=>$form->createView()
                //'comments'=>$entityManager->getRepository(Commnet::class)->findAll() // Esta es la consulta cuando vayamos a manejar una base de datos 
             ]);// Generalmente la respuesta es html 
        }
    }
 
//RUTA + CONTROLADOR =PAGINA WEB



/* Una entidad es una clase que representa un objeto,y se mapea a
   una tabla en una base de datos relacional y contiene propiedades que representan las columnas de esa tabla.
   donde se, actualizar y eliminar registros en una base de datos */

//Modelos = Entidades

// composer require symfony/orm-pack=> crear el orm
// php bin/console doctrine:database:create =>para crear una base de datos 

// php bin/console make:entity => Crea Entidades
// php bin/console make:migration=> Crea una migracion a partir de Entidad
// php bin/console doctrine:migrations:migrate => Crea la tabla en la base de datos 

//php bin/console doctrine:schema:update --force=> cunado ocurre errorr al aplicar migration
//php bin/console make:form=>Este comando crea formularios
//php bin/console make:controller=>Este comando crea Controladores



// Una entidad representa una tabla 
// Para consultas representamos a CommetRepository(Un repositorio tiene todos los metodos de consultas)
// Para crear una tabla o modificarla utilizamos una migracion, y esta migracoin se crea a partir de una entidad


// 
/* public function home(Request $res){

    $search=$res->get('search');
    return $this->render('home.html.twig',['search'=>$search]);// Generalmente la respuesta es html 
} */



/* public function home(Request $res){

    $search=$res->get('search');
    return new Response('Bienvenido',$search)// Generalmente la respuesta es html 
} */

/* public function home(EntityManagerInterface $entityManager){

   
    return $this->render('home.html.twig',['comments'=>$entityManager->getRepository(Commnet::class)->findBy([],[
                'id'=>'DESC'
            ]) ;]);// Generalmente la respuesta es html
} */



/* 
Para trabajar con validaciones 
composer require symfony/validator 
*/

/* composer require symfony/webpack-encore-bundle=> instala los asets
npm install para instalar node_models

npm install bootstrap --save => instala bootstraap

cada vez q se haga un cambio en app.css se debe correr=> npm run dev*/
?>