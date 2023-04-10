<?php

namespace App\Controller;

use App\Form\PostType;
use App\Entity\Post;
use App\Entity\Category;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;// Este el sistema que administra mis entidades

class PostController extends AbstractController
{
    /**
     * @Route("/post/crear", name="post_create", methods={"GET", "POST"})
     */
    public function create(EntityManagerInterface $entityManager, Request $request): Response {
        $form=$this->createForm(PostType::class);// Se crea el formulario 
        $form->handleRequest($request);//Se maneja el formulario
        if($form->isSubmitted() && $form->isValid()){
           // Guarda en DB
            $entityManager->persist($form->getData());// Prepara la informacion
            $entityManager->flush();// guarda la informacion en la tabla
            return $this->redirectToRoute('post_create'); 
        }
        return $this->render('post/create.html.twig', [
            'form' =>$form->createView(),
        ]);
    }

     /**
     * @Route("/post/editar/{id}", name="post_edit", methods={"GET", "POST"})
     */
    public function edit(Post $post,EntityManagerInterface $entityManager, Request $request): Response {
        //dd($post);
        // Convierto el parametro id en objeto de publicaciones 
        $form=$this->createForm(PostType::class,$post);// Se crea el formulario y se dice que publicacion se desea editar 
        $form->handleRequest($request);//Se maneja el formulario
        if($form->isSubmitted() && $form->isValid()){
            // Guarda en DB
            $entityManager->persist($form->getData());// Prepara la información
            $entityManager->flush();// Guarda la informacion en la tabla
            return $this->redirectToRoute('post_edit',[
                'id'=>$post->getId()// Obtengo el id de la publicacion
            ]);
        }
        return $this->render('post/edit.html.twig',[
            'form' =>$form->createView(),
        ]);
    }
}
