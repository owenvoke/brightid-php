<?php

namespace OwenVoke\BrightID\Api;

class Node extends AbstractApi
{
    /**
     * @link https://dev.brightid.org/docs/node-api/10526353738f6-gets-state-of-this-node
     */
    public function state(): array
    {
        return $this->get('/state');
    }
}
