<?php


namespace App\Constants;

use PHPUnit\TextUI\XmlConfiguration\Constant;

class Constants{
    public static int $DISCORD_REFRESH_TOKEN_TIME = 5 * 60* 1000;
    public static string $SUPER_ADMIN = "SENADOR";
    public static string $ADMIN = "MAGISTRADO";
    public static string $DISCORD_SERVER = "656278110379048970";
    public static string $DISCORD_OAUTH = "https://discord.com/api/oauth2/authorize?client_id=869264506365288518&redirect_uri=http%3A%2F%2Flocalhost%3A8000&response_type=code&scope=identify%20email%20guilds";
    public static int $ONE_MINUTE_SECONDS = 60;
    public static int $FIVE_MINUTES_SECONDS = 5 * 60;
}