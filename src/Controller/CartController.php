<?php

namespace App\Controller;

use App\Classe\Cart;
use App\Entity\Product;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    
    #[Route('/mon-panier', name: 'cart')]
    public function index(Cart $cart): Response
    { 
      
        return $this->render('cart/index.html.twig', [
            'cart' => $cart->getFull(),
        ]);
    }

    #[Route('/mon-panier/add/{id}', name: 'add-to-cart')]
    public function add(Cart $cart, $id)
    {
        $cart->add($id);
        
        return $this->redirectToRoute('cart');
    }

    #[Route('/mon-panier/remove', name: 'remove-my-cart')]
    public function remove(Cart $cart)
    {
        $cart->remove();
        
        return $this->redirectToRoute('products');
    }
    
    #[Route('/mon-panier/delete/{id}', name: 'delete-to-cart')]
    public function delete(Cart $cart, $id)
    {
        $cart->delete($id);
        
        return $this->redirectToRoute('cart');
    }

    #[Route('/mon-panier/decrease/{id}', name: 'decrease-to-cart')]
    public function decrease(Cart $cart, $id)
    {
        $cart->decrease($id);
        
        return $this->redirectToRoute('cart');
    }
}
