<?php declare(strict_types=1);

namespace App\Controllers;

use Core\Controller;
use App\Models\User;
use App\Auth;
use App\Flash;

class Login extends Controller
{
    public function indexAction(): void
    {
        $this->render('Login/index', ['title' => 'Login']);
    }

    public function validateAction(): void
    {
        $user = User::authenticate($_POST['email'], $_POST['password']);

        $rememberMe = isset($_POST['rememberMe']);

        if (false !== $user && 1 === $user->is_active) {

            Auth::login($user, $rememberMe);

            Flash::add('Login successful!');

            $this->redirect(Auth::getReturnToPage());

        } else {

            Flash::add('Login unsuccessful, try again', Flash::WARNING);

            $this->render('Login/index', [
                'title' => 'Login', 
                'email' => $_POST['email'], 
                'rememberMe' => $rememberMe]
            );
        }
    }

    public function logoutAction(): void
    {
        Auth::logout();

        $this->redirect('/login/show-logout-message');
    }

    public function showLogoutMessageAction(): void
    {
        Flash::add('Logout successful');
    
        $this->redirect('/');
    }
}
