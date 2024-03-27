<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\Mail\EnviarCorreo;
use Illuminate\Support\Facades\Mail;

class AuthController extends Controller
{
    /**
     * Sign Up page
     */
    public function signup()
    {
        return view('auth.signup');
    }

    /**
     * Sign In page
     */
    public function signin()
    {
        return view('auth.signin');
    }

    /**
     * Register new user
     */
    public function register(Request $request)
    {
        // Validate user
        $this->validate($request, [
            'name' => 'required|max:255',
            'email' => 'required|email|max:255',
            'password' => 'confirmed'
        ]);

        // Store user
        User::create([
            'name' => $request->name,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        // Sign user in
        auth()->attempt($request->only('email', 'password'));

        // Redirect
        return redirect()->route('home');
    }

    /**
     * Log existing user in
     */
    public function login(Request $request)
    {
        // Validate user
        $this->validate($request, [
            'email' => 'required|email',
        ]);

        // Sign user in
        if (!auth()->attempt($request->only('email', 'password'))) {
            return back()->with('status', 'Invalid user or password');
        }

        // Redirect
        return redirect()->route('home');
    }

    /**
     * Log user out
     */
    public function logout(Request $request)
    {
        // Sign user out
        auth()->logout();

        return redirect()->route('home');
    }


    public function enviarEmail(){
        return view('enviarEmail');
    }


    public function crudProductos(){
        return view('crudProductos');
    }

    public function FuncionMail(Request $req){
        $co=$req->input('Destinatario');

        $sub=$req->input('Asunto');

        $msg=$req->input('mensaje');

        $factura="";

        if ((empty($co)) || (empty($sub)) ) {
            return redirect('/enviarEmail?mal=va');
        } else {
            
            //CORREO PARA TODOS LOS USUARIOS
            if ($co=="Todos los usuarios") {
                $correos = User::select('email')->get();
    
                $datos=array('msg'=>$msg);
    
                foreach ($correos as $correo) {
                    $enviar= new EnviarCorreo($datos,$factura);
                    $enviar->sub=$sub;
                    Mail::to($correo)->send($enviar);
                }
            
                return redirect('/enviarEmail?email=si');
                
            } else {
                //CORREO PARA LOS USUARIOS ESCRITOS A MANO EN EL CAMPO DE DESTINATARIO
                $correos = explode(',', rtrim(trim($co), ','));
            
                $datos=array('msg'=>$msg);
                
                $formato=true;

                foreach ($correos as $correo) {
                
                    if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
                        $formato=false;
                    }
                }

                if ($formato==true) {
                
                    foreach ($correos as $correo) {
                    
                        $enviar= new EnviarCorreo($datos,$factura);
                        $enviar->sub=$sub;
                        Mail::to($correo)->send($enviar);
                    }  
                    // dd($msg);
                    return redirect('/enviarEmail?email=si');
                } else {
                    return redirect('/enviarEmail?email=no');
                }

            }
        }
    }

    public function listarCorreos(Request $req){

        $buscador=$req->except('_token');
        /* $buscador='Mc'; */
        /* echo $buscador; */
        /* echo $buscador['buscar']; */
        /* dd($request); */
        $consulta=User::where('email', 'like', ''.$buscador['buscar'].'%')->get();
        /* $count = $consulta->count(); */
        return response()->json($consulta);
    }


    public function pagar($correo,$precio){
        $apiContext = new \PayPal\Rest\ApiContext(
            new \PayPal\Auth\OAuthTokenCredential(
                config('services.paypal.client_id'),     // ClientID
                config('services.paypal.secret')      // ClientSecret
            )
        );


        $payer = new \PayPal\Api\Payer();
        $payer->setPaymentMethod('paypal');


        $amount = new \PayPal\Api\Amount();
        //precio a pagar
        $amount->setTotal($precio);
        $amount->setCurrency('EUR');


        $transaction = new \PayPal\Api\Transaction();
        $transaction->setAmount($amount);
        //le envioa la pagina informacion del id
        //si se cancela lo llevo a la pagina que quiero
        $redirectUrls = new \PayPal\Api\RedirectUrls();
        $redirectUrls
        ->setReturnUrl(url("comprado/".$correo))  //Ruta 'OK'
        ->setCancelUrl(url("/cesta"));        //Ruta 'Cancel'


        $payment = new \PayPal\Api\Payment();
        $payment->setIntent('sale')
            ->setPayer($payer)
            ->setTransactions(array($transaction))
            ->setRedirectUrls($redirectUrls);
        try {
            $payment->create($apiContext);
            //me redirige a la pagina de paypal
            return redirect()->away( $payment->getApprovalLink());


        }catch (\PayPal\Exception\PayPalConnectionException $ex) {
            // This will print the detailed information on the exception.
            //REALLY HELPFUL FOR DEBUGGING
            echo $ex->getData();
        }
    }

}

