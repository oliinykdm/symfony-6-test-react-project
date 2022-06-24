<?php declare(strict_types=1);

namespace Messagehub\ApiV1Bundle\Ajax;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\Serializer\Normalizer\UidNormalizer;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Security\Csrf\CsrfTokenManagerInterface;
use Symfony\Component\Routing\Annotation\Route;

class AjaxController extends AbstractController
{
    const AJAX_STATUS_SUCCESS_CODE = 'success';
    const AJAX_STATUS_ERROR_CODE = 'error';

    private CsrfTokenManagerInterface $csrfTokenManager;

    public function __construct(
        CsrfTokenManagerInterface $csrfTokenManager
    )
    {
        $this->csrfTokenManager = $csrfTokenManager;
    }
    protected function toJson($object): string {
        $encoders = [new JsonEncoder()];
        $normalizers = [new UidNormalizer(), new DateTimeNormalizer(), new ObjectNormalizer()];
        $serializer = new Serializer($normalizers, $encoders);
        return $serializer->serialize($object, 'json');
    }
    protected function ajaxResponse($body): Response {
        $response = new Response();

        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');

        $response->setContent($body);

        return $response;
    }
    /**
     * @Route("/api/csrf", methods={"GET"})
     */
    public function getCsrf(Request $request): Response
    {
        return $this->ajaxResponse(
            $this->toJson(
                $this->csrfTokenManager->getToken(
                    $request->get('action')
                )
            )
        );
    }

}