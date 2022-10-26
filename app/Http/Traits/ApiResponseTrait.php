<?php

namespace App\Http\Traits;

trait ApiResponseTrait
{
	protected function successResponse($data, $message = null, $code = 0)
	{
		return response()->json([
			'code' => $code,
			'message' => $message,
			'data' => $data
		], 200);
	}

	protected function errorResponse($message = null, $code = 0)
	{
		return response()->json([
			'status' => 'Error',
			'message' => $message,
			'data' => null
		], $code);
	}

	protected function exceptionResponse($message = null)
	{
		return [
			'status' => 'Error',
			'message' => $message,
			'data' => null
		];
	}
}
