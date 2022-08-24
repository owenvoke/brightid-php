<?php

namespace OwenVoke\BrightID\Api;

use OwenVoke\BrightID\Enums\ConnectionDirection;

class User extends AbstractApi
{
    /**
     * @link https://dev.brightid.org/docs/node-api/5f925a7124856-gets-profile-information-of-a-user
     */
    public function profile(string $id): array
    {
        return $this->get("/users/{$id}/profile");
    }

    /**
     * @link https://dev.brightid.org/docs/node-api/1b180c6c98049-gets-profile-information-of-a-user
     */
    public function profileAs(string $id, string $requesterId): array
    {
        return $this->get("/users/{$id}/profile/{$requesterId}");
    }

    /**
     * @link https://dev.brightid.org/docs/node-api/cc66fd77eee33-gets-memberships-of-the-user
     */
    public function memberships(string $id): array
    {
        return $this->get("/users/{$id}/memberships");
    }

    /**
     * @link https://dev.brightid.org/docs/node-api/d9f564aa7356d-gets-invites-of-the-user
     */
    public function invites(string $id): array
    {
        return $this->get("/users/{$id}/invites");
    }

    /**
     * @link https://dev.brightid.org/docs/node-api/2c6426e0c23b3-gets-verifications-of-the-user
     */
    public function verifications(string $id): array
    {
        return $this->get("/users/{$id}/verifications");
    }

    /**
     * @link https://dev.brightid.org/docs/node-api/445c925a048bf-gets-inbound-or-outbound-connections-of-a-user
     */
    public function connections(string $id, ConnectionDirection $direction): array
    {
        return $this->get("/users/{$id}/connections/{$direction->value}");
    }

    /**
     * @link https://dev.brightid.org/docs/node-api/445c925a048bf-gets-inbound-or-outbound-connections-of-a-user
     */
    public function inboundConnections(string $id): array
    {
        return $this->connections($id, ConnectionDirection::INBOUND);
    }

    /**
     * @link https://dev.brightid.org/docs/node-api/445c925a048bf-gets-inbound-or-outbound-connections-of-a-user
     */
    public function outboundConnections(string $id): array
    {
        return $this->connections($id, ConnectionDirection::OUTBOUND);
    }

    /**
     * @link https://dev.brightid.org/docs/node-api/9abba7be801d3-gets-family-groups-which-the-user-can-vouch-for
     */
    public function familyGroups(string $id): array
    {
        return $this->get("/users/{$id}/familiesToVouch");
    }
}
