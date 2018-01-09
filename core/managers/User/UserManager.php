<?php
/**
 * Created by PhpStorm.
 * User: Max
 * Date: 21.09.2017
 * Time: 14:07
 */

namespace core\managers\User;

use core\entities\User\User;
use core\forms\User\UserForm;
use core\forms\User\PhotosForm;
use core\repositories\ObjectRepository;
use core\repositories\User\UserRepository;
use core\entities\transactions\UserTransaction;
class UserManager
{
    private $users;

    public function __construct(
        UserRepository $repository
    )
    {
        $this->users = $repository;
    }



    public function createUser(UserForm $form)
    {
        $user = User::create($form);
        foreach ($form->photos->files as $file) {
            $user->addPhoto($file);
        }

        $this->users->save($user);
        return $user;
    }


    public function addPhotos($id, PhotosForm $form)
    {
        $user = $this->users->get($id);
        foreach ($form->files as $file) {
            $user->addPhoto($file);
        }
        $this->users->save($user);
    }

    public function removePhoto($id, $photoId)
    {
        $user = $this->users->get($id);
        $user->removePhoto($photoId);
        $this->users->save($user);
    }

    public function remove($id)
    {
        $user = $this->users->get($id);
        $this->users->remove($user);
    }

    public function editUser($id, UserForm $form)
    {
        $user = $this->users->get($id);
        $user->edit($form);
        foreach ($form->photos->files as $file) {
            $user->addPhoto($file);
        }
        $this->users->save($user);
    }

    public function changeBalance(int $id,int $amount)
    {
            $user=$this->users->get($id);
            $user->wallet+=$amount;
            $this->users->save($user);
    }

}