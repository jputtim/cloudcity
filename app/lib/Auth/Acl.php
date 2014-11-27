<?php

namespace CloudCity\Auth;

use Zend\Permissions\Acl\Acl as ZendAcl;

class Acl extends ZendAcl
{
    public function __construct()
    {
        // APPLICATION ROLES
        $this->addRole('guest');
        // member role "extends" guest, meaning the member role will get all of 
        // the guest role permissions by default
        $this->addRole('member', 'guest');
        $this->addRole('admin');

        // APPLICATION RESOURCES
        // Application resources == Slim route patterns
        $this->addResource('/');
        $this->addResource('/login');
        $this->addResource('/logout');
        $this->addResource('/dashboard');
        $this->addResource('/api/accounts(/p/:page)');

        // APPLICATION PERMISSIONS
        // Now we allow or deny a role's access to resources. The third argument
        // is 'privilege'. We're using HTTP method for resources.
        $this->allow('guest', '/', 'GET');
        $this->allow('guest', '/login', array('GET', 'POST'));
        $this->allow('guest', '/logout', 'GET');
        $this->allow('guest', '/api/accounts(/p/:page)', 'GET');

        $this->allow('member', '/dashboard', 'GET');

        // This allows admin access to everything
        $this->allow('admin');
    }
}