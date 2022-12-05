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
        'bad_request' => 400,
        'unauthorized' => 401,
        'forbidden' => 403,
        'not_found' => 404,
        'server_error' => 500
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
     * 200 Success response
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
     * 400 Bad request response
     *
     * @param string $message
     * @param mixed $data
     * @return \Illuminate\Http\JsonResponse
     */
    public function badRequest(string $message = '', mixed $data = null): \Illuminate\Http\JsonResponse
    {
        $message = $message != '' ? $message : __('message.response.bad_request');
        return self::response(self::$error, $message, $data, self::$statusCode['bad_request']);
    }

    /**
     * 401 Unauthorized response
     *
     * @param string $message
     * @param mixed $data
     * @return \Illuminate\Http\JsonResponse
     */
    public static function unauthorized(string $message = '', mixed $data = null): \Illuminate\Http\JsonResponse
    {
        $message = $message != '' ? $message : __('message.response.unauthorized');
        return self::response(self::$error, $message, $data, self::$statusCode['unauthorized']);
    }

    /**
     * 403 Forbidden response
     *
     * @param string $message
     * @param mixed $data
     * @return \Illuminate\Http\JsonResponse
     */
    public static function forbidden(string $message = '', mixed $data = null): \Illuminate\Http\JsonResponse
    {
        $message = $message != '' ? $message : __('message.response.forbidden');
        return self::response(self::$error, $message, $data, self::$statusCode['forbidden']);
    }

    /**
     * 404 Not found response
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

    /**
     * 500 Server error response
     *
     * @param string $message
     * @param mixed $data
     * @return \Illuminate\Http\JsonResponse
     */
    public static function serverError(string $message = '', mixed $data = null): \Illuminate\Http\JsonResponse
    {
        $message = $message != '' ? $message : __('message.response.server_error');
        return self::response(self::$error, $message, $data, self::$statusCode['server_error']);
    }
}
