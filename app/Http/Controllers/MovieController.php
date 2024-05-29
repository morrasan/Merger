<?php

namespace App\Http\Controllers;

use App\Services\Movie\MovieService;
use External\Foo\Exceptions\ServiceUnavailableException;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class MovieController extends Controller
{
    private MovieService $movieService;

    public function __construct (MovieService  $movieService) {

        $this->movieService = $movieService;
    }

    /**
     * @param Request $request
     *
     * @return JsonResponse
     */
    public function getTitles(Request $request): JsonResponse
    {
        try {
            $titles = $this->movieService->getAllTitles();

            return response()->json($titles);

        } catch (ServiceUnavailableException $e) {

            return response()->json(['status' => 'failure'], 500);
        }
    }
}
