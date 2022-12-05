<?php

namespace Kastanaz\LaravelUtility\Helpers;

class ApiResponse
{
    /**
     * Array of Status Code
     *
     * @var array
     */
    private static array $statusCode = [
        'success' => 200,
        'not_found' => 404
    ];

    /**
     * Success Response Status
     *
     * @var boolean
     */
    private static bool $success = true;

    /**
     * Error Response Status
     *
     * @var boolean
     */
    private static bool $error = false;

    /**
     * Base response
     *
     * @param boolean $status
     * @param string $message
     * @param mixed $data
     * @param integer $statusCode
     * @return \Illuminate\Http\JsonResponse
     */
    private static function response(bool $status, string $message, mixed $data = null, int $statusCode): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data
        ], $statusCode);
    }

    /**
     * Success response
     *
     * @param string $message
     * @param mixed $data
     * @return \Illuminate\Http\JsonResponse
     */
    public static function success(string $message = '', mixed $data = null): \Illuminate\Http\JsonResponse
    {
        $message = $message != '' ? $message : __('message.response.success');
        return self::response(self::$success, $message, $data, self::$statusCode['success']);
    }

    /**
     * Not found response
     *
     * @param string $message
     * @param mixed $data
     * @return \Illuminate\Http\JsonResponse
     */
    public function notFound(string $message = '', mixed $data = null): \Illuminate\Http\JsonResponse
    {
        $message = $message != '' ? $message : __('message.response.not_found');
        return self::response(self::$error, $message, $data, self::$statusCode['not_found']);
    }
}
