<?php
/**
 * Created by PhpStorm.
 * User: marcinworwa
 * Date: 15/10/2018
 * Time: 17:10
 */

namespace App\Factory\User;


interface UserFactory
{
    public function createUser(string $jsonData);
}