<?php

namespace App\Controller;

use App\Entity\PFE;
use App\Form\PFEType;
use App\Repository\EntrepriseRepository;
use App\Repository\PFERepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PFEController extends AbstractController
{
    #[Route('/printPFE', name: 'printPFE')]
    public function index(PFERepository $repo): Response
    {
        $res = $repo->findAll();

        return $this->render('pfe/index.html.twig', [
            'controller_name' => 'PFEController', 'res' => $res
        ]);
    }
    #[Route("/addPFE", name: "addPFE")]
    public function Form(ManagerRegistry $doctrine, Request $request): Response
    {
        $manager = $doctrine->getManager();
        $pfe = new PFE();
        $form = $this->createForm(PFEType::class, $pfe);
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            $manager->persist($pfe);
            $manager->flush();
            return $this->redirecttoRoute('printPFE');
        }
        return $this->render('pfe/form.html.twig', ['form' => $form->createView()]);
    }
    #[Route("/printEntreprise", name: "printEntreprise")]
    public function print(EntrepriseRepository $repo): Response
    {
        $res = $repo->findAll();
        return $this->render('pfe/entreprise.html.twig', [
            'res' => $res

        ]);
    }
}
