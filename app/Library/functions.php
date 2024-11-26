<?php

/**
 * Jsonize data for API calls
 *
 * @param $data
 * @param bool $response
 * @param int $status
 * @param string $msg
 * @return \Illuminate\Http\JsonResponse
 */
function jsonize($data, bool $response = false, int $status = 200, $msg = "")
{
    //strip any tokens
    if (is_array($data)) {
        if (array_key_exists('_token', $data)) {
            unset($data['_token']);
        }
    }

    $response = [
        'status' => $status,
        'response' => $response,
        'data' => $data,
        'msg' => $msg
    ];

    return response()->json($response);
}
