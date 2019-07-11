<?php

namespace App\Http\Middleware;

use Illuminate\Cookie\Middleware\EncryptCookies as Middleware;

class EncryptCookies extends Middleware
{
    /**
     * The names of the cookies that should not be encrypted.
     *
     * @var array
     */
    protected $except = [
        '/api/login/do', '/api/test/verify', '/api/clients/list', '/api/users/list', 
        '/api/users/save', '/api/users/get', '/api/companies/list','/public/api/login/do',
        '/api/companies/get', '/public/api/companies/get', '/api/companies/withclients',
        '/public/api/test/verify','/public/api/clients/list',   '/public/api/users/list', 
        '/public/api/users/save', '/public/api/users/get', '/public/api/companies/list',
        '/public/api/companies/withclients', '/api/clients/getbyhash', '/public/api/clients/getbyhash',
        '/api/clients/lockbyhash', '/api/clients/unlockbyhash', '/public/api/clients/unlockbyhash',
        '/api/statuses/list','/public/api/statuses/list', '/api/scripts/save', '/public/api/scripts/save'
    ];
}
