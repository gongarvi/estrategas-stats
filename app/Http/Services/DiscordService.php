<?php

namespace App\Http\Services;

use App\responses\pojo\Discord\RequestCodeToToken;
use App\responses\pojo\Discord\RequestGuildMember;
use App\responses\pojo\Discord\RequestUserGuild;
use App\responses\pojo\Discord\UserData;
use Exception;
use Illuminate\Support\Facades\Http;

enum DiscordEndpoints
{
        #User token
    case UserGuilds;
    case ChageCodeToken;
    case UserData;

        #Bot token
    case GuildRoles;

    public function endpoint()
    {
        return match ($this) {
            DiscordEndpoints::ChageCodeToken => "/oauth2/token",
            DiscordEndpoints::UserGuilds => "/users/@me/guilds/{guild.id}/member",
            DiscordEndpoints::UserData => "/users/@me",
            DiscordEndpoints::GuildRoles => "/guilds/{guild.id}/roles"
        };
    }
}

class DiscordService
{
    private string $apiEndpoint = 'https://discord.com/api/v8';

    public function changeCodeToToken(string $code): RequestCodeToToken
    {
        $response = Http::asForm()
            ->post(
                $this->apiEndpoint . DiscordEndpoints::ChageCodeToken->endpoint(),
                [
                    'client_id' => env('DISCORD_API_CLIENT_ID'),
                    'client_secret' => env('DISCORD_API_CLIENT_SECRET'),
                    'grant_type' => 'authorization_code',
                    'code' => $code,
                    'redirect_uri' => 'http://localhost:8000'
                ]
            );

        $body = $response->object();

        if (property_exists($body, "error")) {
            throw new Exception("Token conversion Failed\n" . print_r($body, true));
        }

        return new RequestCodeToToken($body);
    }

    public function refreshToken(string $refreshToken): RequestCodeToToken
    {
        $response = Http::asForm()->post(
            $this->apiEndpoint . DiscordEndpoints::ChageCodeToken->endpoint(),
            [
                'client_id' => env('DISCORD_API_CLIENT_ID'),
                'client_secret' => env('DISCORD_API_CLIENT_SECRET'),
                "grant_type" => 'refresh_token',
                'refresh_token' => $refreshToken
            ]
        );

        $body = $response->object();

        if (property_exists($body, "error")) {
            throw new Exception("Refreshtoken Failed\n" . print_r($body, true));
        }

        return new RequestCodeToToken($body);
    }

    public function getUserData(string $authorization): UserData
    {
        $response = Http::withHeaders([
            'Authorization' => $authorization
        ])
            ->get($this->apiEndpoint . DiscordEndpoints::UserData->endpoint());

        $body = $response->object();

        if (property_exists($body, "error")) {
            throw new Exception("Refreshtoken Failed\n" . print_r($body, true));
        }

        return new UserData($body);
    }

    /**
     * The attributes that are mass assignable.
     *
     * @return RequestGuildMember
     */
    public function getUserGuild(string $authorization, string $guildId)
    {
        $endpoint = str_replace("{guild.id}", $guildId, $this->apiEndpoint . DiscordEndpoints::UserGuilds->endpoint());

        $response = Http::withHeaders([
            'Authorization' => $authorization
        ])
            ->get($endpoint);

        $body = $response->object();

        if (!is_array($body) && property_exists($body, "error")) {
            throw new Exception("Refreshtoken Failed\n" . print_r($body, true));
        }

        return new RequestUserGuild($body);
    }

    /**
     * The attributes that are mass assignable.
     *
     * @return array<mixed>
     */
    public function getGuildRoles(string $authorization, string $guildId)
    {
        $endpoint = str_replace("{guild.id}", $guildId, $this->apiEndpoint . DiscordEndpoints::GuildRoles->endpoint());

        $response = Http::withHeaders([
            'Authorization' => $authorization
        ])
            ->get($endpoint);

        $body = $response->object();

        if (!is_array($body) && property_exists($body, "error")) {
            throw new Exception("Refreshtoken Failed\n" . print_r($body, true));
        }

        return ($body);
    }
}