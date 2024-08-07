<?php

namespace App\Controller;

use App\Repository\ClassNameRepository;
use App\Repository\DocumentRepository;
use App\Repository\GradeRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Service\GradeService;
use App\Service\DocumentService;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class WidgetController extends AbstractController
{
    #[Route('', name: 'home')]
    #[IsGranted('IS_AUTHENTICATED_FULLY')]
    public function index(GradeRepository $gradeRepository, DocumentRepository $documentRepository,UserRepository $userRepository): Response
    {
        $user = $this->getUser();
        $gradesService = new GradeService();
        $grades= $gradesService->getGrades($gradeRepository,$user);

        $documentsService = new DocumentService();
        $documents= $documentsService->getDocuments($documentRepository,$user,$userRepository);

        return $this->render('default/index.html.twig', [
            'grades' => $grades,
            'documents' => $documents
        ]);
    }
}
