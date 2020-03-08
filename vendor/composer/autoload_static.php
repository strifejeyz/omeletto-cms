<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit713e105862dfd52d71a5066e67b91d37
{
    public static $files = array (
        '3eac8a9ce007dee7165fbccb8e4c63f7' => __DIR__ . '/../..' . '/kernel/helpers.php',
        '555082641dfed149832ebe1b57ef25e3' => __DIR__ . '/../..' . '/app/routes.php',
        '63fa2066443e0bea4c25c52cd29fb025' => __DIR__ . '/../..' . '/config/database.php',
        '7ed5f8beb43243ac61b542c40bd39cda' => __DIR__ . '/../..' . '/config/application.php',
        'f16ce49013d76f69c059fc9c3d54fd67' => __DIR__ . '/../..' . '/bootstrap.php',
    );

    public static $prefixLengthsPsr4 = array (
        'F' => 
        array (
            'Faker\\' => 6,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Faker\\' => 
        array (
            0 => __DIR__ . '/..' . '/fzaninotto/faker/src/Faker',
        ),
    );

    public static $classMap = array (
        'App\\Migrations\\ArticlesTableMigration' => __DIR__ . '/../..' . '/app/migrations/ArticlesTableMigration.php',
        'App\\Migrations\\MediaTableMigration' => __DIR__ . '/../..' . '/app/migrations/MediaTableMigration.php',
        'App\\Migrations\\SettingsTableMigration' => __DIR__ . '/../..' . '/app/migrations/SettingsTableMigration.php',
        'App\\Migrations\\TokensTableMigration' => __DIR__ . '/../..' . '/app/migrations/TokensTableMigration.php',
        'App\\Migrations\\UsersTableMigration' => __DIR__ . '/../..' . '/app/migrations/UsersTableMigration.php',
        'App\\Models\\Article' => __DIR__ . '/../..' . '/app/models/Article.php',
        'App\\Models\\Media' => __DIR__ . '/../..' . '/app/models/Media.php',
        'App\\Models\\Tokens' => __DIR__ . '/../..' . '/app/models/Tokens.php',
        'App\\Models\\User' => __DIR__ . '/../..' . '/app/models/User.php',
        'App\\Requests\\CreateArticleRequest' => __DIR__ . '/../..' . '/app/requests/CreateArticleRequest.php',
        'App\\Requests\\CreateUserRequest' => __DIR__ . '/../..' . '/app/requests/CreateUserRequest.php',
        'App\\Requests\\EditUserRequest' => __DIR__ . '/../..' . '/app/requests/EditUserRequest.php',
        'App\\Requests\\LoginRequest' => __DIR__ . '/../..' . '/app/requests/LoginRequest.php',
        'App\\Requests\\ResetPasswordRequest' => __DIR__ . '/../..' . '/app/requests/ResetPasswordRequest.php',
        'App\\Seeders\\UsersTableSeeder' => __DIR__ . '/../..' . '/app/seeders/UsersTableSeeder.php',
        'Auth' => __DIR__ . '/../..' . '/kernel/security/Auth.php',
        'Cookie' => __DIR__ . '/../..' . '/kernel/security/Cookie.php',
        'Form' => __DIR__ . '/../..' . '/kernel/Form.php',
        'Kernel\\Database\\Connection' => __DIR__ . '/../..' . '/kernel/database/Connection.php',
        'Kernel\\Database\\Database' => __DIR__ . '/../..' . '/kernel/database/Database.php',
        'Kernel\\Database\\Migration' => __DIR__ . '/../..' . '/kernel/database/Migration.php',
        'Kernel\\Database\\QueryBuilder' => __DIR__ . '/../..' . '/kernel/database/QueryBuilder.php',
        'Kernel\\Database\\QueryBuilderInterface' => __DIR__ . '/../..' . '/kernel/database/QueryBuilder.php',
        'Kernel\\Database\\QueryBuilderMagicInterface' => __DIR__ . '/../..' . '/kernel/database/QueryBuilder.php',
        'Kernel\\Engine' => __DIR__ . '/../..' . '/kernel/Engine.php',
        'Kernel\\FileHandler' => __DIR__ . '/../..' . '/kernel/FileHandler.php',
        'Kernel\\Format' => __DIR__ . '/../..' . '/kernel/Format.php',
        'Kernel\\Log' => __DIR__ . '/../..' . '/kernel/Log.php',
        'Kernel\\Requests\\FileRequest' => __DIR__ . '/../..' . '/kernel/requests/FileRequest.php',
        'Kernel\\Requests\\FileRequestInterface' => __DIR__ . '/../..' . '/kernel/requests/FileRequest.php',
        'Kernel\\Requests\\HTTPRequest' => __DIR__ . '/../..' . '/kernel/requests/HTTPRequest.php',
        'Kernel\\Requests\\HTTPRequestInterface' => __DIR__ . '/../..' . '/kernel/requests/HTTPRequest.php',
        'Kernel\\Security\\Encryption' => __DIR__ . '/../..' . '/kernel/security/Encryption.php',
        'Kernel\\Security\\Hash' => __DIR__ . '/../..' . '/kernel/security/Hash.php',
        'Kernel\\Security\\Token' => __DIR__ . '/../..' . '/kernel/security/Token.php',
        'Kernel\\YamatoCLI' => __DIR__ . '/../..' . '/kernel/YamatoCLI.php',
        'Route' => __DIR__ . '/../..' . '/kernel/Route.php',
        'Session' => __DIR__ . '/../..' . '/kernel/security/Session.php',
        'View' => __DIR__ . '/../..' . '/kernel/View.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit713e105862dfd52d71a5066e67b91d37::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit713e105862dfd52d71a5066e67b91d37::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit713e105862dfd52d71a5066e67b91d37::$classMap;

        }, null, ClassLoader::class);
    }
}
