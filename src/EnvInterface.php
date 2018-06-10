<?php
/**
 * Created by PhpStorm.
 * User: igor
 * Date: 31/05/18
 * Time: 12:33
 */

namespace AdminWeb\Payer;


interface EnvInterface
{
    const SandBox = 'SANDBOX';
    const Production = 'PRODUCTION';

    public function getUri();

    public function getCredential();

    public function getToken();
}