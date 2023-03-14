<?php

namespace App\Controller;

use App\Entity\Post;
use App\Entity\Comment;
use App\Repository\PostRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class PostController extends AbstractController
{
    #[Route('/', name: 'app_post')]
    public function index(PostRepository $postRepository): Response
    {
        $posts = $postRepository->findAll();
    
        return $this->render('post/index.html.twig', [
            'posts' => $posts,
        ]);
    }
    #[Route('/post/new', name: 'new_post')]
    public function create(Request $request, EntityManagerInterface $entityManager)
    {
        $post = new Post();
    
        $form = $this->createFormBuilder($post)
            ->add('pseudo')
            ->add('title')
            ->add('content')
            ->getForm();
    
        $form->handleRequest($request);
    
        if ($form->isSubmitted() && $form->isValid()) {
            $post->setSentAt(new \DateTimeImmutable());
            $entityManager->persist($post);
            $entityManager->flush();
    
            return $this->redirectToRoute('app_post');
        }
    
        return $this->render('post/new.html.twig', [
            'form' => $form->createView(),
        ]);
    }
    #[Route('/post/remove/{id}', name: 'delete_post')]
    public function delete(ManagerRegistry $doctrine,Post $post){
    
        $entityManager = $doctrine->getManager();
        $entityManager->remove(	$post);
        $entityManager->flush();
    
        return $this->redirectToRoute('app_post');
    }
    public function show(Post $post): Response
{
    return $this->render('post/show.html.twig', [
        'post' => $post
    ]);
}
    
    

}

