<?php

namespace App\Traits;

use Illuminate\Http\JsonResponse;

trait ApiResponse
{
  protected function success($data = '', string $message = '', int $codeHttp = 200): JsonResponse
  {
    return response()->json(['message' => $message, 'data' => $data], $codeHttp);
  }

  protected function error($errors = '', string $message = '', int $codeHttp = 400): JsonResponse
  {
    return response()->json(['message' => $message, 'errors' => $errors], $codeHttp);
  }
}
