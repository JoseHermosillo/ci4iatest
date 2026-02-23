<?php

namespace App\Controllers;

use App\Controllers\BaseController;
use App\Models\UserModel;

class Auth extends BaseController
{
    protected $session;
    protected $userModel;

    public function __construct()
    {
        $this->session = session();
        $this->userModel = new UserModel();
    }

    public function register()
    {
        return view('auth/register', ['title' => 'Create Account']);
    }

    public function store()
    {
        // ensure request is POST
        if ($this->request->getMethod() !== 'post') {
            return redirect()->to('/register');
        }

        // fetch individual fields to avoid null array issues
        $name     = $this->request->getPost('name');
        $email    = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        // basic validation
        $rules = [
            'name'     => 'required|min_length[3]|max_length[100]',
            'email'    => 'required|valid_email|is_unique[users.email]',
            'password' => 'required|min_length[6]',
        ];

        if (! $this->validate($rules)) {
            return redirect()->back()->withInput()->with('errors', $this->validator->getErrors());
        }

        // save user - model has its own validation rules which expect a
        // `password` field, but we are storing a hash.  We already ran manual
        // validation above so skip model validation here to avoid the mismatch.
        $saveData = [
            'name'          => $name,
            'email'         => $email,
            'password_hash' => password_hash($password, PASSWORD_DEFAULT),
        ];

        if (! $this->userModel->skipValidation(true)->save($saveData)) {
            // grab any errors from the model (should be none since we skipped, but
            // just in case something else failed)
            $errors = $this->userModel->errors();
            if (empty($errors)) {
                $errors = ['Unable to save user.'];
            }
            return redirect()->back()->withInput()->with('errors', $errors);
        }

        // automatically log the user in
        $user = $this->userModel->where('email', $email)->first();
        $this->session->set('user_id', $user['id']);
        $this->session->set('user_name', $user['name']);

        return redirect()->to('/dashboard');
    }

    public function login()
    {
        return view('auth/login', ['title' => 'Sign In']);
    }

    public function attempt()
    {
        $email = $this->request->getPost('email');
        $password = $this->request->getPost('password');

        $user = $this->userModel->where('email', $email)->first();
        if (! $user || ! password_verify($password, $user['password_hash'])) {
            return redirect()->back()->withInput()->with('error', 'Invalid credentials');
        }

        $this->session->set('user_id', $user['id']);
        $this->session->set('user_name', $user['name']);

        return redirect()->to('/dashboard');
    }

    public function logout()
    {
        $this->session->destroy();
        return redirect()->to('/login');
    }
}
