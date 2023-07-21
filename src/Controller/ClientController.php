<?php

namespace App\Controller;

use App\Entity\Client;
use App\Repository\ClientRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ClientController extends AbstractController
{
    #[Route('/', name: 'prdg_clients', methods: ['GET'])]
    public function index(ClientRepository $clients): Response
    {
        $client = new Client();
        return $this->render('client/index.html.twig', [
            'clients' => $clients->findAll(),
        ]);
    }

    #[Route('/clients', name: 'prdg_client_create', methods: ['POST'])]
    public function create(Request $request, EntityManagerInterface $entityManager): Response
    {
        $client = new Client();
        $client->setName($request->request->get('name'));
        $client->setEmail($request->request->get('email'));

        $entityManager->persist($client);
        $entityManager->flush();

        return $this->redirectToRoute('prdg_clients');
    }
}
