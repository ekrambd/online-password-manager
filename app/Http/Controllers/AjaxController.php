<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Repositories\Category\CategoryInterface;
use App\Repositories\User\UserInterface;

class AjaxController extends Controller
{
    protected $category;
    protected $user;

    public function __construct(
        CategoryInterface $category,
        UserInterface $user
    )
    {
        $this->category = $category;
        $this->user = $user;
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
}
