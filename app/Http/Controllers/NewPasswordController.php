<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Password;
use Illuminate\Auth\Events\PasswordReset;
use Doctrine\Inflector\Rules\English\Rules;
use Illuminate\Validation\ValidationException;
use Mockery\Generator\StringManipulation\Pass\Pass;

class NewPasswordController extends Controller
{
    //
    public function forgotPassword(Request $request){
        $request->validate([
            'email'=>'required',
        ]);
    $status = Password::sendResetLink($request->only('email'));

        if($status == Password::RESET_LINK_SENT){
            return[
               //  'status'=>__($status)
                   'status'=> 'Nous avons reçu votre demande et vous envoyons un lien de changement de mot de passe , Veuillez vous reconnecter         ',
            ];
        }

        throw ValidationException::withMessages([
            'email'=>[trans($status)],
        ]);
      //  return response()->json(['ma'=>'aaa']);
    }

    public function reset(Request $request){
        $request->validate([
          'token'=>"required",
          'email'=>"required|email",
          'password'=>["required","confirmed",/*RulesPassword::defaults()*/],

        ]);

        $status = Password::reset(
            $request->only('email', 'password', 'password_confirmation', 'token'),
            function($user, $password) {
                $user->forceFill([
                    'password' => Hash::make($password)
                ])->setRememberToken(Str::random(60));

                $user->save();

                $user->tokens()->delete();
                event(new PasswordReset($user));
            }
        );

        if ($status == Password::PASSWORD_RESET) {
            return response([
               // 'message'=> 'Password reset successfully'
                'message'=> 'Le mot de passe a été modifié avec succès'
            ]);
        }

        return response([
            'message'=> __($status)
        ], 500);

    }
}
