<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;
use App\Models\User;
use App\Models\Admin;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
use App\Mail\GeneratePassword;
use Carbon\Carbon;

class SettingsDashboard extends Component
{
	public $mode;

	public $name;
	public $start;
	public $end;

	public $firstName;
	public $lastName;
	public $email;
	public $passtype;
	public $password;
	public $password_confirmation;

	public $lakename;
	public $lakedesc;
	public $lakeslug;
	public $laketype;

	public $admin;

	public function mode($id)
	{
		if($id == 1)
		{
			$this->mode = 1;

			$this->dispatchBrowserEvent('activate-datepicker');
		}
	}

	public function saveAdmin()
	{
		$data = $this->validate([
			'firstName' => 'required',
			'lastName' => 'required',
			'email' => 'required|unique:users|email',
			'passtype' => 'required|numeric',
			'password' => 'exclude_if:passtype,2|required|confirmed'
		]);

		if($data['passtype'] == 1)
		{
			$password = $data['password'];
		} else {
			$password = Str::random(8);
		}

		$user = User::create([
			'email' => $data['email'],
			'password' => bcrypt($password),
			'permission' => 1
		]);

		$user->admin()->create([
			'firstName' => $data['firstName'],
			'lastName' => $data['lastName']
		]);

		$user->pwd = $password;

		if($data['passtype'] == 2)
		{
			Mail::to($user->email)->send(new GeneratePassword($user));
		}

		$this->reset();
	}

	public function adminToReset($id)
	{
		$this->admin = Admin::findOrFail($id);

		$this->mode = 4;
	}

	public function resetPassword()
	{
		$data = $this->validate([
			'passtype' => 'required|numeric',
			'password' => 'exclude_if:passtype,2|required|confirmed'
		]);

		if($data['passtype'] == 1)
		{
			$password = $data['password'];
		} else {
			$password = Str::random(8);
		}

		$user = $this->admin->user->update([
			'password' => bcrypt($password),
		]);

		if($data['passtype'] == 2)
		{
			Mail::to($this->admin->user->email)->send(new GeneratePassword($password));
		}

		$this->reset(['passtype', 'password', 'mode']);

		session()->flash('success', 'Administrator password reset');
	}

	public function deleteAdmin($id)
	{
		if(User::where('permission', 1)->count() < 2)
		{
			session()->flash('failure', 'You cannot delete all admins.');
		} else {

			User::find($id)->delete();

			session()->flash('success', 'Admin sucessfully deleted.');
		}
		
	}

    public function render()
    {
        return view('livewire.admin.settings-dashboard',[
        	'admins' => Admin::whereHas('user')->get()
        ]);
    }
}
