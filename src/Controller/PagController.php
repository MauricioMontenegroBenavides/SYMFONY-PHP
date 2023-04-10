<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;

use App\Form\ContactType;




class PagController extends AbstractController
{
    #[Route('/contactos-v1',name:'contact-v1',methods:['GET','POST'])]// Esta ruta esta preparada para trabjar con GET Y POST
    public function index(Request $request): Response{
        $form=$this->createFormBuilder()
              ->add('email',TextType::class)  
              ->add('message',TextareaType::class)
              ->add('save',SubmitType::class)
              ->getForm(); 

             
        $form->handleRequest($request); 
        //dd($form); 
        if($form->isSubmitted()){
           // $form->GetData();Contiene los valores que se han enviado 
            //dd($form->GetData())
            // Dentro del if() se puede utilizar la logica de si se envia el formulario se guarde en la DB
            $this->addFlash('exito1','Prueba form #1 con éxito');// Es para enviar un msm
            return $this->redirectToRoute('contact-v1'); 
        }
        return $this->render('pag/index.html.twig', [
            'form' =>$form->createView(),
        ]); 
    }


    #[Route('/contactos-v2',name:'/contact-v2',methods:['GET','POST'])]// Esta ruta esta preparada para trabjar con GET Y POST
    public function index2(Request $request): Response{


        $form=$this->createForm(ContactType::class);
             

        $form->handleRequest($request); 
        if($form->isSubmitted()){

            //dd($form->getData(),$request);

            $this->addFlash('exito2','Prueba form #2 con éxito');// Es para enviar un msm
            return $this->redirectToRoute('contactos-v2');

        }

        return $this->render('pag/index2.html.twig', [
            'form' =>$form->createView(),
        ]); 
    }
}
