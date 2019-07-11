<?php

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    /**
     * Indicates whether the XSRF-TOKEN cookie should be set on the response.
     *
     * @var bool
     */
    protected $addHttpCookie = true;

    /**
     * The URIs that should be excluded from CSRF verification.
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
        '/api/scripts/list', '/public/api/scripts/list', '/api/scripts/save', '/public/api/scripts/save',
        '/api/scripts/get/by/status', '/public/api/scripts/get/by/status', '/api/clients/nextclient',
        '/public/api/clients/nextclient', '/api/clients/notes/list', '/public/api/clients/notes/list',
        '/api/clients/notes/save', '/public/api/clients/notes/save', '/api/clients/logs',
        '/public/api/clients/logs', '/public/api/clients/logs/save', '/api/clients/logs/save',
        '/api/clients/sms/list', '/public/api/clients/sms/list', '/public/api/clients/sms/save',
        '/api/clients/sms/save', '/api/clients/save', '/public/api/clients/save', '/api/imports/upload',
        '/api/mailling/send', '/public/api/mailling/send'
    ];
}
