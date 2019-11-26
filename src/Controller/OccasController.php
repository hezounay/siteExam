<?php

namespace App\Controller;

use App\Entity\Occasions;
use App\Entity\Gallery;
use App\Form\AnnonceType;
use App\Controller\OccasController;
use App\Repository\GalleryRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class OccasController extends AbstractController
{
    /**
     * @Route("/occas", name="occas_view")
     */
    public function index()  
    {
        $repo = $this->getDoctrine()->getRepository(Occasions::class);

        $occasions = $repo->findAll();
        return $this->render('occas/index.html.twig', [
            'controller_name' => 'OccasController',
            'occasions' => $occasions
        ]);
    }
    
      /**
     * Permet de créer une annonce
     * @Route("/occas/new", name="occas_create")
     *
     * @return Response
     */
    public function create(Request $request, ObjectManager $manager){
        $occasion = new Occasions();
        /*
        $image1 = new Image();

        $image1->setUrl('http://placehold.it/400x200')
            ->setCaption('Titre 1');
            $occasion->addImage($image1);
        */
        $form = $this->createForm(AnnonceType::class, $occasion);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            foreach($occasion->getGallery() as $gallery){
            $gallery->setOccasion($occasion);
            $manager->persist($gallery);
            }

            $manager->persist($occasion);
            $manager->flush(); 
            

            $this->addFlash(
                'success',
                "L'annonce <strong>{$occasion->getModele()}</strong> a bien été enregistrée ! "
            );

            return $this->redirectToRoute('occas_view',[
                'slug' => $occasion->getSlug()
            ]);
        }

        return $this->render('occas/new.html.twig', [
           'myForm' => $form->createView()
        ]);

    } 


      /**
     * @Route("/occas/{slug}", name="occas_show")
     *
     * @return Response
     */
    public function show($slug, Occasions $occasions){

        //$occas = $repo->findOneBySlug($slug);

        return $this->render('occas/show.html.twig',[
          'occasions' => $occasions
        ]);

    }
    
    /**
     * Permiet d'afficher le formulaire d'édition
     * 
     * @Route("/occas/{slug}/edit", name="occas_edit")
     * 
     * @return Response
     */
    public function edit(Occasions $occasions, Request $request, ObjectManager $manager) {
    
        $form=$this->createForm(AnnonceType::class,$occasions);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){
            foreach($occasions->getGallery() as $gallery){
                $gallery->setOccasion($occasions);
                $manager->persist($gallery);
            }

                $manager->persist($occasions);

                $manager->flush();

                $this->addFlash(
                    'success',
                    "L'annonce <strong>{$occasions->getModele()}</strong> a bien été modifiée"
                );

                return $this->redirectToRoute('occas_show',[
                    'slug'=>$occasions->getSlug()
                ]);
                

        }

        return $this->render("occas/edit.html.twig", [ 
    'occasions'=>$occasions,
    'myForm'=>$form->createView()
    ]);

    }


 


  
}


