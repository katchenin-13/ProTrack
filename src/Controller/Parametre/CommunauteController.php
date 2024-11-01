<?php

namespace App\Controller\Parametre;

use App\Entity\Communaute;
use App\Entity\Emailpf;
use App\Entity\Nompf;
use App\Entity\Numeropf;
use App\Service\FormError;
use App\Form\CommunauteType;
use App\Service\ActionRender;
use App\Repository\CommunauteRepository;
use Omines\DataTablesBundle\DataTableFactory;
use Symfony\Component\HttpFoundation\Request;
use Omines\DataTablesBundle\Column\BoolColumn;
use Omines\DataTablesBundle\Column\TextColumn;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Omines\DataTablesBundle\Column\DateTimeColumn;
use Doctrine\ORM\QueryBuilder;
use Dompdf\Dompdf;
use Omines\DataTablesBundle\Adapter\Doctrine\ORMAdapter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Controller\BaseController;
use Mpdf\MpdfException;

#[Route('/parametre/communaute')]
class CommunauteController extends BaseController
{
    const INDEX_ROOT_NAME = 'app_parametre_communaute_index';
    /**
 * Undocumented function
 *
 * @param CommunauteRepository $communaute
 * @param Request $request
 * @param DataTableFactory $dataTableFactory
 * @return Response
 */
    #[Route('/', name: 'app_parametre_communaute_index', methods: ['GET', 'POST'])]
    public function index(CommunauteRepository $communaute,Request $request, DataTableFactory $dataTableFactory): Response
    {
        $permission = $this->menu->getPermissionIfDifferentNull($this->security->getUser()->getGroupe()->getId(), self::INDEX_ROOT_NAME);

        $table = $dataTableFactory->create()
        ->add('libelle', TextColumn::class, ['label' => 'Nom '])
        ->add('localite', TextColumn::class, ['label' => 'Localité','field' => 'l.libelle'])
        ->add('categorie', TextColumn::class, ['label' => 'Catégorie','field' => 'ca.libelle'])
        ->createAdapter(ORMAdapter::class, [
            'entity' => Communaute::class,
            'query'=> function(QueryBuilder $req){
              $req->select('c,l,ca')
                  ->from(Communaute::class,'c')
                  ->join('c.localite', 'l')
                  ->join('c.categorie', 'ca')
                ;
            }
        ])

        ->setName('dt_app_parametre_communaute');
        if ($permission != null) { 
            $renders = [
                    'edit' =>  new ActionRender(function () use ($permission) {
                        if ($permission == 'R') {
                            return false;
                        } elseif ($permission == 'RD') {
                            return false;
                        } elseif ($permission == 'RU') {
                            return true;
                        } elseif ($permission == 'RUD') {
                            return true;
                        } elseif ($permission == 'CRU') {
                            return true;
                        } elseif ($permission == 'CR') {
                            return false;
                        } else {
                            return true;
                        }
                    }),
                    'delete' => new ActionRender(function () use ($permission) {
                        if ($permission == 'R') {
                            return false;
                        } elseif ($permission == 'RD') {
                            return true;
                        } elseif ($permission == 'RU') {
                            return false;
                        } elseif ($permission == 'RUD') {
                            return true;
                        } elseif ($permission == 'CRU') {
                            return false;
                        } elseif ($permission == 'CR') {
                            return false;
                        } else {
                            return true;
                        }
                    }),
                    'show' => new ActionRender(function () use ($permission) {
                        if ($permission == 'R') {
                            return true;
                        } elseif ($permission == 'RD') {
                            return true;
                        } elseif ($permission == 'RU') {
                            return true;
                        } elseif ($permission == 'RUD') {
                            return true;
                        } elseif ($permission == 'CRU') {
                            return true;
                        } elseif ($permission == 'CR') {
                            return true;
                        } else {
                            return true;
                        }
                        return true;
                    }),

                ];


            $hasActions = false;
            foreach ($renders as $_ => $cb) {
                if ($cb->execute()) {
                    $hasActions = true;
                    break;
                }
            }

            if ($hasActions) {
                $table->add('id', TextColumn::class, [
                    'label' => 'Actions', 'orderable' => false, 'globalSearchable' => false, 'className' => 'grid_row_actions', 'render' => function ($value, Communaute $context) use ($renders) {
                        $options = [
                            'default_class' => 'btn btn-xs btn-clean btn-icon mr-2 ',
                            'target' => '#exampleModalSizeLg2',

                            'actions' => [
                                'show' => [
                                    'url' => $this->generateUrl('app_parametre_communaute_show', ['id' => $value]), 'ajax' => true, 'icon' => '%icon% bi bi-eye', 'attrs' => ['class' => 'btn-success'], 'render' => $renders['show']
                                ],
                                'edit' => [
                                    'url' => $this->generateUrl('app_parametre_communaute_edit', ['id' => $value]), 'ajax' => true, 'icon' => '%icon% bi bi-pen', 'attrs' => ['class' => 'btn-default'], 'render' => $renders['edit']
                                ],
                                'delete' => [
                                    'target' => '#exampleModalSizeNormal',
                                    'url' => $this->generateUrl('app_parametre_communaute_delete', ['id' => $value]), 'ajax' => true, 'icon' => '%icon% bi bi-trash', 'attrs' => ['class' => 'btn-danger'],  'render' => $renders['delete']
                                ]
                            ]

                        ];
                        return $this->renderView('_includes/default_actions.html.twig', compact('options', 'context'));
                    }
                ]);
            }
        }

        $renders = [
            'show' =>  new ActionRender(function () {
                return true;
            }),
            'edit' =>  new ActionRender(function () {
                return true;
            }),
            'delete' => new ActionRender(function () {
                return true;
            }),
        ];
        $table->handleRequest($request);

        if ($table->isCallback()) {
            return $table->getResponse();
        }
        return $this->render('parametre/communaute/index.html.twig', [
            'datatable' => $table,
            'permition' => $permission
        ]);
    }
    

    /**
     * cette fonction permet de generer un pdf de communaute
     *
     * @param CommunauteRepository $communaute
     * @return Response
     */
    #[Route('/pdf/generator/communaute', name: 'app_pdf_generator_communaute')]
    public function generatePdf(CommunauteRepository $communaute): Response
    {
        $data = $communaute->findAll();
  

        $html =  $this->renderView('parametre/communaute/detail.html.twig', [
            'data' => $data
        ]);
        $mpdf = new \Mpdf\Mpdf([

            'mode' => 'utf-8', 'format' => 'A4', 
        ]);
        $mpdf->PageNumSubstitutions[] = [
            'from' => 1,
            'reset' => 0,
            'type' => 'I',
            'suppress' => 'on'
        ];

        $mpdf->WriteHTML($html);
        $mpdf->SetFontSize(6);
        $mpdf->Output();
    }

    /**
     * Undocumented function
     *
     * @param Request $request
     * @param CommunauteRepository $communauteRepository
     * @param FormError $formError
     * @return Response
     */
    #[Route('/new', name: 'app_parametre_communaute_new', methods: ['GET', 'POST'])]
    public function new(Request $request, CommunauteRepository $communauteRepository, FormError $formError): Response
    {
        $communaute = new Communaute();
        $nompf = new Nompf();
        $numeropf = new Numeropf();
        $emailpf = new Emailpf();

        $communaute->addNompf($nompf);
        $communaute->addNumeropf($numeropf);
        $communaute->addEmailpf($emailpf);


        $form = $this->createForm(CommunauteType::class, $communaute, [
            'method' => 'POST',
            'action' => $this->generateUrl('app_parametre_communaute_new')
        ]);
        $form->handleRequest($request);

        $data = null;
        $statutCode = Response::HTTP_OK;

        $isAjax = $request->isXmlHttpRequest();

        if ($form->isSubmitted()) {
            $response = [];
            $redirect = $this->generateUrl('app_parametre_communaute_index');




            if ($form->isValid()) {

                $communauteRepository->save($communaute, true);
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
                return $this->json( compact('statut', 'message', 'redirect', 'data'), $statutCode);
            } else {
                if ($statut == 1) {
                    return $this->redirect($redirect, Response::HTTP_OK);
                }
            }


        }

        return $this->renderForm('parametre/communaute/new.html.twig', [
            'communaute' => $communaute,
            'form' => $form,
        ]);
    }
     /**
      * cette fonction permet d'afficher
      */
    #[Route('/{id}/show', name: 'app_parametre_communaute_show', methods: ['GET'])]
    public function show(Communaute $communaute): Response
    {
        return $this->render('parametre/communaute/show.html.twig', [
            'communaute' => $communaute,
        ]);
    }
    
    /**
     * cette fonction permet d'editer
     */
    #[Route('/{id}/edit', name: 'app_parametre_communaute_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Communaute $communaute, CommunauteRepository $communauteRepository, FormError $formError): Response
    {

        $form = $this->createForm(CommunauteType::class, $communaute, [
            'method' => 'POST',
            'action' => $this->generateUrl('app_parametre_communaute_edit', [
                    'id' =>  $communaute->getId()
            ])
        ]);

        $data = null;
        $statutCode = Response::HTTP_OK;

        $isAjax = $request->isXmlHttpRequest();


        $form->handleRequest($request);

        if ($form->isSubmitted()) {
            $response = [];
            $redirect = $this->generateUrl('app_parametre_communaute_index');


            if ($form->isValid()) {

                $communauteRepository->save($communaute, true);
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
                return $this->json( compact('statut', 'message', 'redirect', 'data'), $statutCode);
            } else {
                if ($statut == 1) {
                    return $this->redirect($redirect, Response::HTTP_OK);
                }
            }
        }

        return $this->renderForm('parametre/communaute/edit.html.twig', [
            'communaute' => $communaute,
            'form' => $form,
        ]);
    }
    
    /**
     * cette fonction permet de supprimer un elements
     */
    #[Route('/{id}/delete', name: 'app_parametre_communaute_delete', methods: ['DELETE', 'GET'])]
    public function delete(Request $request, Communaute $communaute, CommunauteRepository $communauteRepository): Response
    {
        $form = $this->createFormBuilder()
            ->setAction(
                $this->generateUrl(
                'app_parametre_communaute_delete'
                ,   [
                        'id' => $communaute->getId()
                    ]
                )
            )
            ->setMethod('DELETE')
        ->getForm();
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $data = true;
            $communauteRepository->remove($communaute, true);

            $redirect = $this->generateUrl('app_parametre_communaute_index');

            $message = 'Opération effectuée avec succès';

            $response = [
                'statut'   => 1,
                'message'  => $message,
                'redirect' => $redirect,
                'data' => $data
            ];

            $this->addFlash('success', $message);

            if (!$request->isXmlHttpRequest()) {
                return $this->redirect($redirect);
            } else {
                return $this->json($response);
            }
        }

        return $this->renderForm('parametre/communaute/delete.html.twig', [
            'communaute' => $communaute,
            'form' => $form,
        ]);
    }
}
