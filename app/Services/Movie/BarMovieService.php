<?php

namespace App\Services\Movie;

use External\Bar\Exceptions\ServiceUnavailableException;
use External\Bar\Movies\MovieService;

class BarMovieService implements MovieServiceInterface {

    private MovieService $movieService;

    public function __construct(MovieService $movieService) {

        $this->movieService = $movieService;
    }

    /**
     * @return array
     * @throws ServiceUnavailableException
     */
    public function getTitles (): array {

        $result = $this->movieService->getTitles();

        $titles = [];

        foreach ($result['titles'] as $title) {

            $titles[] = $title['title'];
        }
        return $titles;
    }
}
