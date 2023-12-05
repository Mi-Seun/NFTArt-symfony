<?php

namespace App\Twig\Runtime;

use Twig\Extension\RuntimeExtensionInterface;

class DisplayHighestRoleRuntime implements RuntimeExtensionInterface
{
    public function __construct()
    {
        // Inject dependencies if needed
    }

    public function getHighestRole($value)
    {
        if(in_array("ROLE_SUPER_ADMIN" , $value)){
            return "SUPER_ADMIN";
        }else if (in_array("ROLE_ADMIN" ,$value)){
            return "ADMIN";
        }else{
            return "USER";
        }
    }
}