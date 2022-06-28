<?php declare(strict_types=1);

namespace Messagehub\Common\Application\HandlerResponse\ReturnResponse;

use Messagehub\Common\Application\HandlerResponse\HandlerResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\DateTimeNormalizer;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Component\Serializer\Normalizer\UidNormalizer;
use Symfony\Component\Serializer\Serializer;

abstract class ReturnResponse implements HandlerResponse
{
    const AJAX_STATUS_SUCCESS_CODE = 'success';
    const AJAX_STATUS_ERROR_CODE = 'error';

    protected static function toJson($object): string
    {
        $encoders = [new JsonEncoder()];
        $normalizers = [new UidNormalizer(), new DateTimeNormalizer(), new ObjectNormalizer()];
        $serializer = new Serializer($normalizers, $encoders);
        return $serializer->serialize($object, 'json');
    }

    protected static function ajaxResponse($body): Response
    {
        $response = new Response();

        $response->headers->set('Content-Type', 'application/json');
        $response->headers->set('Access-Control-Allow-Origin', '*');

        $response->setContent($body);

        return $response;
    }
}