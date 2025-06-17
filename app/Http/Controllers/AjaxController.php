<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Category\CategoryInterface;
use App\Repositories\User\UserInterface;
use App\Repositories\Group\GroupInterface;
use App\Repositories\Password\PasswordInterface;

class AjaxController extends Controller
{
    protected $category;
    protected $user;
    protected $group;
    protected $password;

    public function __construct(
        CategoryInterface $category,
        UserInterface $user,
        GroupInterface $group,
        PasswordInterface $password
    )
    {
        $this->category = $category;
        $this->user = $user;
        $this->group = $group;
        $this->password = $password;
    }

    public function categoryStatusUpdate(Request $request)
    {
        $statusUpdate = $this->category->statusUpdate($request);
        return $statusUpdate;
    }

    public function userStatusUpdate(Request $request)
    {
        $statusUpdate = $this->user->statusUpdate($request);
        return $statusUpdate;
    }

    public function groupStatusUpdate(Request $request)
    {
        $statusUpdate = $this->group->statusUpdate($request);
        return $statusUpdate;
    }

    public function passwordStatusUpdate(Request $request)
    {
        $statusUpdate = $this->password->statusUpdate($request);
        return $statusUpdate;
    }
}
