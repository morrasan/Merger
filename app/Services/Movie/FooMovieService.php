<?php

namespace App\Services\Movie;

use External\Foo\Exceptions\ServiceUnavailableException;
use External\Foo\Movies\MovieService;

class FooMovieService implements MovieServiceInterface {

    private MovieService $movieService;

    public function __construct(MovieService $movieService) {

        $this->movieService = $movieService;
    }

    /**
     * @return array
     * @throws ServiceUnavailableException
     */
    public function getTitles (): array {

        return $this->movieService->getTitles();
    }
}
