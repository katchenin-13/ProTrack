<?php

namespace App\Controller\AutresMethodes;

use App\Controller\BaseController;
use App\Entity\PubliciteCategorie;
use App\Entity\WorkflowServicePrestataire;
use App\Form\PubliciteCategorieType;
use App\Form\WorkflowServicePrestataireType;
use App\Repository\PubliciteCategorieRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\FormError;



#[Route('/ads/autres/methodes/autres')]
class AutresController extends BaseController
{



    #[Route('/ads/new', name: 'app_workflowdemande_workflow_service_prestataire_new', methods: ['GET', 'POST'])]
    public function new(Request $request,  FormError $formError): Response
    {
        $validationGroups = ['Default', 'FileRequired', 'autre'];

        $workflowServicePrestataire = new WorkflowServicePrestataire();
        $form = $this->createForm(WorkflowServicePrestataireType::class, $workflowServicePrestataire, [
            'method' => 'POST',
            'type' => 'allData',
            'doc_options' => [
                'uploadDir' => $this->getUploadDir(self::UPLOAD_PATH, true),
                'attrs' => ['class' => 'filestyle'],
            ],
            'validation_groups' => $validationGroups,
            'action' => $this->generateUrl('app_workflowdemande_workflow_service_prestataire_new')
        ]);
        $form->handleRequest($request);

        $data = null;
        $statutCode = Response::HTTP_OK;

        $isAjax = $request->isXmlHttpRequest();

        if ($form->isSubmitted()) {
            $response = [];
            $redirect = $this->generateUrl('app_config_workflow_index');


            if ($form->isValid()) {
                $workflowServicePrestataire->setEtat('demande_initie');
                $this->em->persist($workflowServicePrestataire);
                $this->em->flush();
                //($workflowServicePrestataire, true);
                $data = true;
                $message       = 'Opération effectuée avec succès';
                $statut = 1;
                $this->addFlash('success', $message);
            } else {
                $message = $formError->all($form);
                $statut = 0;
                $statutCode = Response::HTTP_INTERNAL_SERVER_ERROR;
                if (!$isAjax) {
                    $this->addFlash('warning', $message);
                }
            }


            if ($isAjax) {
                return $this->json(compact('statut', 'message', 'redirect', 'data'), $statutCode);
            } else {
                if ($statut == 1) {
                    return $this->redirect($redirect, Response::HTTP_OK);
                }
            }
        }

        return $this->renderForm('workflowdemande/workflow_service_prestataire/new.html.twig', [
            'workflow_service_prestataire' => $workflowServicePrestataire,
            'form' => $form,
        ]);
    }
}
