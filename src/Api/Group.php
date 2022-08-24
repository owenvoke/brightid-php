<?php

namespace OwenVoke\BrightID\Api;

class Group extends AbstractApi
{
    /**
     * @link https://dev.brightid.org/docs/node-api/6bf034ea25910-gets-information-about-a-group
     */
    public function show(string $id): array
    {
        return $this->get("/groups/{$id}");
    }
}
