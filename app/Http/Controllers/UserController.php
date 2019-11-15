<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\User;
use App\Reason;
class UserController extends Controller
{
    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function adminIndex()
    {
        return view('admin.index');
    }
    public function sellerIndex()
    {
        return view('seller.index');
    }
    public function sellerInactive()
    {
        return view('seller.inactive');
    }
    public function sellerRegister()
    {
        return view('auth.sellerRegistration');
    }
    public function allSeller()
    {
        $users = User::where('is_seller',true)->get();
        return view('admin.seller.activeSeller',compact('users'));
    }
    public function allInactiveSeller()
    {
        $users = User::where('is_seller',false)->get();
        return view('admin.seller.inactiveSeller',compact('users'));
    }
    protected function activeSeller(User $user){
        $user->is_seller = true;
        $user->save();
        return redirect()->route('activeseller.list')->with('status','Seller Activated Successfully');
    }
    protected function deactiveSeller(Request $request, User $user){
        $this->validate($request,[
            'reason' => 'required',
        ]);
        Reason::create([
            'reason' => $request->reason,
            'user_id' => $user->id
        ]);
        $user->is_seller = false;
        $user->save();
        return redirect()->route('activeseller.list')->with('status','Seller Deactive Successfully');
    }
}
