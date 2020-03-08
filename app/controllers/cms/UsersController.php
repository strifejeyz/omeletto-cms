<?php

use App\Models\User;
use Kernel\Database\Database;
use Kernel\Requests\HTTPRequest;
use App\Requests\EditUserRequest;
use App\Requests\CreateUserRequest;

class UsersController extends Auth
{
    /**
     * Controller Index
     *
     * @return view
     **/
    public function index()
    {
        return render('backend/users/index');
    }

    /**
     * Controller Index
     *
     * @return mixed
     **/
    public function fetch()
    {
        $res = new HTTPRequest;

        if (empty($res->get('query'))) {
            $users = User::order($res->get('sort_by'), $res->get('order'))
                ->limit(!is_numeric($res->get('limit')) ? false : $res->get('limit'))
                ->get();
        } else {
            $check = User::where('id', $res->get('query'))->get();
            if (is_numeric($res->get('query')) && !empty($check)) {
                $users = ($check);
            } else {
                $users = User::where('firstname', 'like', "%{$res->get('query')}%")
                    ->orWhere('lastname', 'like', "%{$res->get('query')}%")
                    ->orWhere('email', 'like', "%{$res->get('query')}%")
                    ->orWhere('phone_number', 'like', "%{$res->get('query')}%")
                    ->orWhere('role', 'like', "%{$res->get('query')}%")
                    ->orWhere('active', 'like', "%{$res->get('query')}%")
                    ->order($res->get('sort_by'), $res->get('order'))
                    ->limit(!is_numeric($res->get('limit')) ? false : $res->get('limit'))
                    ->get();
            }
        }

        echo <<<EOF
        <table id="table" class="table table-sm display">
            <thead>
            <tr>
                <th>ID</th>
                <th>First Name</th>
                <th>Last Name</th>
                <th>Email</th>
                <th>Number</th>
                <th>Role</th>
                <th>Active</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
EOF;


        foreach ($users as $user):

            $toggle_link = r('cms.users.toggle',$user->id);
            $user_active = $user->active=='yes'?'Deactivate':'Activate';

            if ($user->id == Session::user()->id):
                $edit = "<a href='".r('cms.users.edit')."' class='btn btn-xs btn-warning'>Edit</a>";
            else: $edit = "";
            endif;

            echo <<<EOF
            <tr>
                <td>{$user->id}</td>
                <td>{$user->firstname}</td>
                <td>{$user->lastname}</td>
                <td>{$user->email}</td>
                <td>{$user->phone_number}</td>
                <td>{$user->role}</td>
                <td>{$user->active}</td>
                <td>
                    <a href="#" onclick="toggle('{$toggle_link}')" class="btn btn-xs btn-primary">{$user_active}</a> 
                    {$edit} 
                </td>
            </tr>

EOF;
        endforeach;
        echo "</tbody></table>";
    }


    /**
     * Controller Index
     *
     * @return view
     **/
    public function create()
    {
        return render('backend/users/create');
    }


    /**
     * Controller Index
     *
     * @return view
     */
    public function store()
    {
        $request = new CreateUserRequest;

        if ($request->validate() == true):
            $request->append('active', 'no');
            $request->append('created', time());
            $request->append('updated', time());
            $request->append('password', $request->get_hash('password'));
            $request->remove('confirm_password');

            if (User::insert($request->values())):
                setflash("message", "<i class='text-success'>A new user was added.</i>");
            else:
                setflash("message", "<i class='text-danger'>Something happened, please try again later..</i>");
            endif;
        else:
            setflash("message", "<i class='text-danger'>Please fill out all fields.</i>");
        endif;

        return render('backend/users/create');
    }


    /**
     * Toggle yes|no for user active.
     *
     * @return string
     */
    public function edit()
    {
        $user = User::find(Session::user()->id);

        return render('/backend/users/edit', compact('user'));
    }


    /**
     * Toggle yes|no for user active.
     *
     * @return string
     */
    public function update()
    {
        $request = new EditUserRequest;
        #dump($request->values(), 0);
        $user = User::find(Session::user()->id);

        if ($request->validate()):

            //check email
            if ($request->get('email') != $user->email):
                if (!$user->row("SELECT * FROM users WHERE email=?", [$request->get('username')])):
                    $user->email = $request->get('email');
                else:
                    set_form_error('message', "Username is already taken");
                endif;
            endif;

            //check username/password
            if (!empty($request->get('username'))):
                if ($request->get('username') != $user->username):
                    if (!$user->row("SELECT * FROM users WHERE username=?", [$request->get('username')])):
                        $user->username = $request->get('username');
                    else:
                        set_form_error('username', "Username is not available.");
                    endif;
                endif;
            endif;

            if (!empty($request->get('password')) && !empty($request->get('confirm_password'))):
                if ($request->get('password') == $request->get('confirm_password')):
                    $user->password = $request->get_hash('password');
                else:
                    set_form_error("password", "Passwords did not match.");
                    set_form_error("confirm_password", "Passwords did not match");
                endif;
            endif;

            $user->firstname = $request->get('firstname');
            $user->lastname = $request->get('lastname');
            $user->phone_number = $request->get('phone_number');
            $user->save();
            setflash('message', "<i class='text-success'>Profile successfully updated.</i><br>");

        endif;

        return redirect($request->origin());
    }


    /**
     * Toggle yes|no for user active.
     *
     * @param $int (id)
     * @return string
     */
    public function toggle($int)
    {
        $user = User::find($int);
        if ($user->active == 'yes'):
            $user->active = 'no';
        else:
            $user->active = 'yes';
        endif;

        if ($user->save()) {
            return print 1;
        } else return print 0;
    }
}
