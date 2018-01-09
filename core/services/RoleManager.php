<?php

namespace core\services;

use yii\rbac\ManagerInterface;

class RoleManager
{
    private $manager;

    public function getRoles()
    {
        $new= new \ReflectionClass(static::class);
        return $new->getConstants();
    }

    public function __construct(ManagerInterface $manager)
    {
        $this->manager = $manager;
    }

    public function assign($userId, $name)
    {
        $am = $this->manager;
        echo $userId."|";
        echo $name;
        if (!$role = $am->getRole($name)) {
            throw new \DomainException('Role "' . $name . '" does not exist.');
        }
        $am->revokeAll($userId);
        $am->assign($role, $userId);
    }
}