<?php
namespace App\Http\Library;

trait ApiHelpers
{
    /**
     * Check if token has admin ability
     * @param $user
     * @return bool
     */
    protected function isAdmin($user): bool
    {

        if (!empty($user)){
            return $user->tokenCan('admin');
        }

        return false;

    }

    /**
     * Check if token has writer ability
     * @param $user
     * @return bool
     */
    protected function isWriter($user): bool
    {

        if (!empty($user)){
            return $user->tokenCan('writer');
        }

        return false;

    }

    /**
     * Check if token has subscriber ability
     * @param $user
     * @return false
     */
    protected function isSubscriber($user): bool
    {

        if (!empty($user)){
            return $user->tokenCan('subscriber');
        }

        return false;

    }

    /**
     * @param $data
     * @param string $message
     * @param int $code
     * @return \Illuminate\Http\JsonResponse
     */
    protected function onSuccess($data, string $message = '', int $code = 200): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'status' => $code,
            'message' => $message,
            'data' => $data
        ], $code);
    }

    /**
     * @param int $code
     * @param string $message
     * @return \Illuminate\Http\JsonResponse
     */
    protected function onError( int $code, string $message = ''): \Illuminate\Http\JsonResponse
    {
        return response()->json([
            'status' => $code,
            'message' => $message,
        ], $code);
    }

    /**
     * Validation Rules To Be Used When Creating/Updating Post
     * @return string[]
     */
    protected function postValidationRules (): array
    {
        return [
            'title' => 'required|string',
            'content' => 'required|string',
        ];
    }

    /**
     * Validation Rules To Be Used When Creating a User
     * @return string[][]
     */
    protected function userValidatedRules (): array
    {
        return [
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            'password' => ['required', 'string', 'min:8', 'confirmed'],
        ];
    }

}
