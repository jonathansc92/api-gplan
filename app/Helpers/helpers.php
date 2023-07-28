<?php

use Illuminate\Http\JsonResponse;
use Illuminate\Http\Resources\Json\JsonResource;
use Illuminate\Http\Resources\Json\ResourceCollection;

if (!function_exists('success_response')) {
    function success_response(array|JsonResource $data = null, string $message = '', int $httpStatus = 200)
    {
        $response = [
            'success' => true,
            'message' => $message,
        ];

        if (empty($data)) {
            return new JsonResponse($response, $httpStatus);
        }

        $data = $data instanceof ResourceCollection
            ? $data->toArray(request())
            : ['data' => $data];

        $response = array_merge($response, $data);
        // Necessario informar o JSON_PRESERVE_ZERO_FRACTION pois qdo é um numero inteiro (Ex. 100),
        // estava convertendo para integer. E qdo tinha casas decimais (Ex. 100.01), era mantido o float.
        // Isso estava quebrando os testes.
        return new JsonResponse(
            data: $response,
            status: $httpStatus,
            options: JSON_PRESERVE_ZERO_FRACTION
        );
    }
}

if (!function_exists('error_response')) {
    function error_response(string $message = '', int $httpStatus = 404, array $errors = null)
    {
        $response = [
            'success' => false,
            'message' => $message,
        ];

        if (!empty($errors)) {
            $response['errors'] = $errors;
        }

        return new JsonResponse($response, $httpStatus);
    }
}

if (!function_exists('number_format_round')) {
    function number_format_round(int|float $number)
    {
        $numberRounded = (float) round($number, 2);

        return number_format(
            num: $numberRounded,
            decimals: 2,
            decimal_separator: ',',
            thousands_separator: '.'
        );
    }
}
