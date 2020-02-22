<?php

namespace App\Http\Controllers\Dashboard;

use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\ImageManagerStatic as Image;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;


class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware(['permission:read_users'])->only('index');
        $this->middleware(['permission:create_users'])->only('create');
        $this->middleware(['permission:update_users'])->only('edit');
        $this->middleware(['permission:delete_users'])->only('destroy');
    }

    /*
    * index
    */
    public function index(Request $request)
    {
        //search way #1
        /*
            if($request->search) {
                $users = User::whereRoleIs('admin')->where('name','like','%'.$request->search. '%')
                                                   ->orWhere('email','like','%'. $request->search .'%')->get();
            }else{                               
                $users = User::whereRoleIs('admin')->get();
            }
*/
        //search (Better) #2
        $users = User::whereRoleIs('admin')->where(function ($q) use ($request) {

            return $q->when($request->search, function ($query) use ($request) {

                return $query->where('name','like','%'. $request->search .'%')
                        ->orWhere('email','like','%'. $request->search .'%');
            });

        })->latest()->paginate(3);

       
        return view('dashboard.users.index', compact('users'));
    }



   /*
    * create
    */
    public function create()
    {
        return view('dashboard.users.create');
    }



    /*
    * store
    */
    public function store(Request $request)
    {
        //The validation
        $request->validate([
            'name' => 'required|max:50',
            'email' => 'required|unique:users',
            'image' => 'image',
            'password' => 'required|confirmed',
            'permissions' => 'required|min:1'
        ]);

        $req_data = $request->except(['password','password_confirmation', 'permissions','image']);

        //encrypt user's password
        $req_data['password'] =  bcrypt($request->password);



        //image uploading (We use intervention package)
        if($request->image){

            Image::make($request->image)->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            })

                ->save(public_path('uploads/user_images/' . $request->image->hashName()));

                $req_data['image'] =  $request->image->hashName();

        }//end of image

        //create permissions to the user
        $user = User::create($req_data);

        $user->attachRole('admin');
        $user->syncPermissions($request->permissions);

        session()->flash('success', __('site.added_successfully'));

       return redirect()->route('dashboard.users.index');
    }


    /*
    *   show
    */
    public function show(User $user)
    {
        //
    }


    /*
    *   edit
    */
    public function edit(User $user)
    {
        return view('dashboard.users.edit', compact('user'));
    }



    /*
    *   update
    */
    public function update(Request $request, User $user)
    {
        //The validation
        $request->validate([
            'name' => 'required|max:50',
            'email' => ['required', Rule::unique('users')->ignore($user->id),],
            'image' => 'image',
            'permissions' => 'required|min:1'
        ]);

        $req_data = $request->except(['permissions','image']);




        //create permissions to the user
        $user->syncPermissions($request->permissions);


     

        //start manuplating the image
        if($request->image){

               //image handling
                if($user->image != 'default_user.png'){

                    Storage::disk('public_uploads')->delete('/user_images/' . $user->image);
        
                }// end of small if
  
            //image uploading (We use intervention package) 
            Image::make($request->image)->resize(300, null, function ($constraint) {
                $constraint->aspectRatio();
            })

                ->save(public_path('uploads/user_images/' . $request->image->hashName()));

                

         $req_data['image'] =  $request->image->hashName();

        }//end of outer if $request->image 


        $user->update($req_data);


        session()->flash('success', __('site.updated_successfully'));

       return redirect()->route('dashboard.users.index');
    }


    /*
    *   destroy
    */
    public function destroy(User $user)
    {
        if($user->image != 'default_user.png'){

            Storage::disk('public_uploads')->delete('/user_images/' . $user->image);
        }

        $user->delete();
        session()->flash('success', __('site.deleted_successfully'));
        return redirect()->route('dashboard.users.index');

    }
}