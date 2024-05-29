<?php

namespace App\Services\Movie;

use External\Foo\Exceptions\ServiceUnavailableException;
use Illuminate\Support\Facades\Cache;

class MovieService {

    private FooMovieService $fooMovieService;
    private BarMovieService $barMovieService;
    private BazMovieService $bazMovieService;

    private int $maxAttempts = 3;
    private int $ttl = 3600;
    private string $cachedTitlesKey = 'cached_titles';
    private int $secondsOfWaitingBeforeNextAttempt = 3;

    public function __construct(FooMovieService $fooMovieService, BarMovieService $barMovieService, BazMovieService $bazMovieService) {

        $this->fooMovieService = $fooMovieService;
        $this->barMovieService = $barMovieService;
        $this->bazMovieService = $bazMovieService;
    }

    /**
     * @return array
     * @throws ServiceUnavailableException
     */
    public function getAllTitles (): array {

        if (Cache::has($this->cachedTitlesKey)) {

            return Cache::get($this->cachedTitlesKey);
        }

        $titles = array_merge(
            $this->makeAttempts([$this->fooMovieService, 'getTitles']),
            $this->makeAttempts([$this->barMovieService, 'getTitles']),
            $this->makeAttempts([$this->bazMovieService, 'getTitles']),
        );

        Cache::put($this->cachedTitlesKey, $titles, $this->ttl);

        return $titles;
    }

    /**
     * @param callable $callback
     *
     * @return array
     * @throws ServiceUnavailableException
     */
    private function makeAttempts (callable $callback):array {

        $attempts = 0;

        while ($attempts < $this->maxAttempts) {

            try {
                return call_user_func($callback);

            } catch (ServiceUnavailableException $e) {

                $attempts ++;

                sleep($this->secondsOfWaitingBeforeNextAttempt);
            }
        }
        throw new ServiceUnavailableException();
    }
}
