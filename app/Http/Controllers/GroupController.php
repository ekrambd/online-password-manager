<?php

namespace App\Http\Controllers;

use App\Models\Group;
use App\Repositories\Group\GroupInterface; 
use Illuminate\Http\Request;
use App\Http\Requests\StoreGroupRequest;
use App\Http\Requests\UpdateGroupRequest;
use DataTables;

class GroupController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    protected $group;

    public function __construct(GroupInterface $group)
    {   
        $this->middleware('auth_check');
        $this->group = $group;
    }

    public function index(Request $request)
    {
        if($request->ajax()){
                $groups = $this->group->fetch()->where('user_id',user()->id)->latest();
                return DataTables::of($groups)
                    ->addIndexColumn()
                    ->addColumn('total_member', function($row){
                        return count($row->users);
                    })
                    ->addColumn('status', function($row){
                        return '<label class="switch"><input class="' . ($row->status == 'Active' ? 'active-group' : 'decline-group') . '" id="status-group-update"  type="checkbox" ' . ($row->status == 'Active' ? 'checked' : '') . ' data-id="'.$row->id.'"><span class="slider round"></span></label>';
                    })
                    ->addColumn('action', function ($row) {
                        $btn = "";
                        $btn .= ' <a href="' . route('groups.show', $row->id) . '" class="btn btn-primary btn-sm action-button edit-product-group"><i class="fa fa-edit"></i></a>';
                        $btn .= '&nbsp;';
                        $btn .= ' <button type="button" class="btn btn-danger btn-sm delete-group action-button" data-id="' . $row->id . '"><i class="fa fa-trash"></i></button>';
                        return $btn;
                    })
                    ->rawColumns(['action','status','total_member']) 
                    ->make(true);
        }
        return view('groups.index');
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('groups.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreGroupRequest $request)
    {
        $response = $this->group->store($request);
        $data = $response->getData(true);
        if($data['status'])
        {
            $notification = array(
                'messege'=>$data['message'],
                'alert-type'=>'success'
            );

            return redirect()->back()->with($notification); 
        }

        $notification = array(
            'messege'=>$data['message'],
            'alert-type'=>'error'
        );

        return redirect()->back()->with($notification); 
    }

    /**
     * Display the specified resource.
     */
    public function show(Group $group)
    {
        return view('groups.edit', compact('group'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Group $group)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateGroupRequest $request, Group $group)
    {
        $response = $this->group->update($request,$group);
        $data = $response->getData(true);
        if($data['status'])
        {
            $notification = array(
                'messege'=>$data['message'],
                'alert-type'=>'success'
            );

            return redirect()->route('groups.index')->with($notification); 
        }

        $notification = array(
            'messege'=>$data['message'],
            'alert-type'=>'error'
        );

        return redirect()->back()->with($notification);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Group $group)
    {
        $group->delete();
        return response()->json(['status'=>true, 'message'=>'Successfully the group has been deleted']);
    }
}
