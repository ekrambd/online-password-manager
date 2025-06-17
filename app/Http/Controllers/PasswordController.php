<?php

namespace App\Http\Controllers;

use App\Models\Password;
use App\Repositories\Password\PasswordInterface;
use Illuminate\Http\Request;
use App\Http\Requests\StorePasswordRequest;
use App\Http\Requests\UpdatePasswordRequest;
use DataTables;

class PasswordController extends Controller
{
    /**
     * Display a listing of the resource.
     */

    protected $password;

    public function __construct(PasswordInterface $password)
    {   
        $this->middleware('auth_check');
        $this->password = $password;
    }

    public function index(Request $request)
    {
        if($request->ajax()){
                $passwords = $this->password->fetch()->where('user_id',user()->id)->latest();
                return DataTables::of($passwords)
                    ->addIndexColumn()
                    ->addColumn('category', function($row){
                        return $row->category->category_name;
                    })
                    ->addColumn('status', function($row){
                        return '<label class="switch"><input class="' . ($row->status == 'Active' ? 'active-password' : 'decline-password') . '" id="status-password-update"  type="checkbox" ' . ($row->status == 'Active' ? 'checked' : '') . ' data-id="'.$row->id.'"><span class="slider round"></span></label>';
                    })
                    ->addColumn('action', function ($row) {
                        $btn = "";
                        $btn .= ' <a href="' . route('passwords.show', $row->id) . '" class="btn btn-primary btn-sm action-button edit-product-password"><i class="fa fa-edit"></i></a>';
                        $btn .= '&nbsp;';
                        $btn .= ' <button type="button" class="btn btn-danger btn-sm delete-password action-button" data-id="' . $row->id . '"><i class="fa fa-trash"></i></button>';
                        return $btn;
                    })
                    ->rawColumns(['action','status','category']) 
                    ->make(true);
        }
        return view('passwords.index');  
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('passwords.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StorePasswordRequest $request)
    {
        $response = $this->password->store($request);
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
    public function show(Password $password)
    {
        return view('passwords.edit', compact('password'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Password $password)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdatePasswordRequest $request, Password $password)
    {
        $response = $this->password->update($request,$password);
        $data = $response->getData(true);
        if($data['status'])
        {
            $notification = array(
                'messege'=>$data['message'],
                'alert-type'=>'success'
            );

            return redirect()->route('passwords.index')->with($notification); 
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
    public function destroy(Password $password)
    {
        $delete = $this->password->delete($password);
        return $delete;
    }
}
