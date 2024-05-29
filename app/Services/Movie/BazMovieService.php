<?php

namespace App\Services\Movie;

use External\Baz\Exceptions\ServiceUnavailableException;
use External\Baz\Movies\MovieService;

class BazMovieService implements MovieServiceInterface {

    private MovieService $movieService;

    public function __construct(MovieService  $movieService) {

        $this->movieService = $movieService;
    }

    /**
     * @return array
     * @throws ServiceUnavailableException
     */
    public function getTitles (): array {

        $result = $this->movieService->getTitles();

        return $result['titles'];
    }
}
