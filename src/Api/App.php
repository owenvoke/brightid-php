<?php

namespace OwenVoke\BrightID\Api;

class App extends AbstractApi
{
    /**
     * @link https://dev.brightid.org/docs/node-api/c4ce5d3a2cd2f-gets-all-apps
     */
    public function all(): array
    {
        return $this->get('/apps');
    }

    /**
     * @link https://dev.brightid.org/docs/node-api/47e9823def15b-gets-information-about-an-app
     */
    public function show(string $id): array
    {
        return $this->get("/apps/{$id}");
    }
}
