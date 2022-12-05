<?php

namespace Kastanaz\LaravelUtility\Helpers;

class Response
{
    /**
     * Show a success message and redirect to a specified page
     *
     * @param string $redirect
     * @param string $title
     * @param string $message
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public static function success(string $redirect, $title = '', $message ='')
    {
        $title = $title == '' ? __('laravel-utility::response.success') : $title;
        toastr()->success($title, $message);

        return self::redirect($redirect);
    }

     /**
     * Show an error message and redirect to a specified page
     *
     * @param string $redirect
     * @param string $title
     * @param string $message
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public static function error(string $redirect, $title = '', $message ='')
    {
        $title = $title == '' ? __('laravel-utility::response.error') : $title;
        toastr()->error($title, $message);

        return self::redirect($redirect);
    }

    /**
     * Redirect to a specified page
     *
     * @param string $redirect
     *
     * @return \Illuminate\Http\RedirectResponse
     */
    public static function redirect(string $redirect)
    {
        if ($redirect == 'back') {
            return back();
        }

        return redirect($redirect);
    }
}
