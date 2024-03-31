<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;
use App\Mail\EnviarCorreo;
use App\Models\factura;
use App\Models\Receipt;
use App\Models\ReceiptItem;
use App\Models\ShoppingCart;
use Illuminate\Support\Facades\Mail;

class ProductController extends Controller
{
    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Request $request)
    {
        $name_filter = $request->input('name_filter', '');
        $order_column_filter = $request->input('order_column_filter', 'name');
        $order_direction_filter = $request->input('order_direction_filter', 'ASC');

        $products = Product::where('name', 'LIKE', '%'.$name_filter.'%')->orderBy($order_column_filter, $order_direction_filter)->paginate(20);

        foreach ($products as $product) {

            $imagePath = public_path().'/storage/images/products/prod_'. $product->id.'.png';
    
            if (file_exists($imagePath)) {
                $product->image = asset('storage/images/products/prod_'.$product->id.'.png');
            } else {
                $product->image = asset('storage/images/products/default.png');
            }
        }

        return $products;
    }

    /**
     * Display the individual product view along with the info of one given product
     */
    public function find($productId)
    {
        $product = Product::with(['reviews' => function ($query) {
            $query->orderBy('created_at', 'desc');
        }, 'reviews.author'])->find($productId);

        $imagePath = public_path().'/storage/images/products/prod_'. $product->id.'.png';

        if (file_exists($imagePath)) {
            $product->image = asset('storage/images/products/prod_'.$product->id.'.png');
        } else {
            $product->image = asset('storage/images/products/default.png');
        }

        return view('product.view', compact(['product']));
    }

    /**
     * Display the view for creating a product
     */
    public function create()
    {
        // Validate that user is logged in and an admin
        if (!Auth::check() || auth()->user()->admin != 1) {
            return redirect()->route('home');
        }

        return view('product.create');
    }

    /**
     * Return the products in a JSON format in order to be used to form a table
     */
    public function table(Request $request)
    {
        // Validate that user is logged in and an admin
        if (!Auth::check() || auth()->user()->admin != 1) {
            return ['status' => 'NOT OK', 'message' => 'Acceso no autorizado', 'icon' => 'error'];
        }

        $products=Product::get();


        return $products;
    }

    /**
     * Destroy an instance of the product and delete its image
     */
    public function destroy(Request $request){

        // Validate that user is logged in and an admin
        if (!Auth::check() || auth()->user()->admin != 1) {
            return ['status' => 'NOT OK', 'message' => 'Acceso no autorizado', 'icon' => 'error'];
        }

        $id = $request->input('id');

        // $imagePath = storage_path('app\public\images\products\prod_'. $id.'.png');
        $imagePath = public_path().'/storage/images/products/prod_'. $id.'.png';

        
        if (file_exists($imagePath)) {
            unlink($imagePath);
        } 
        
        try {
            Product::find($id)->delete();
            $return = ['OK'];
        } catch (\Throwable $th) {
            $return = ['NOT - OK ', 'error' => $th->getMessage()];
        }

        return $return;
    }

    /**
     * Store a new instance of a product in the database and save the given image
     */
    public function store(Request $request)
    {
        // Validate that user is logged in and an admin
        if (!Auth::check() || auth()->user()->admin != 1) {
            return ['status' => 'NOT OK', 'message' => 'Acceso no autorizado', 'icon' => 'error'];
        }

        $product = $request->except('_token', 'img');
        $filetype = explode('/', $_FILES['img']['type'])[1];

        // Use Validator class to avoid automatic response by laravel
        $validation = Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'description' => 'required',
                'price' => 'required|numeric|min:0',
                'img' => 'required|file|image'
            ]
        );

        if ($validation->stopOnFirstFailure()->fails()) {
            return ['status' => 'NOT OK', 'message' => $validation->errors()->first(), 'icon' => 'error'];
        }


        if ($filetype != 'png' && $filetype != 'jpg' && $filetype != 'jpeg') {
            return ['status' => 'NOT OK', 'message' => 'Invalid File Type', 'icon' => 'error'];
        }

        try {
            $id = Product::insertGetId($product);

            $request->file('img')->move(public_path('storage/images/products'), 'prod_'.$id.'.png');
            
            return ['status' => 'OK', 'message' => 'Product created successfully', 'icon' => 'success'];
        } catch (\Throwable $th) {
            return ['status' => 'NOT OK', 'message' => $th->getMessage(), 'icon' => 'error'];
        }
    }

    /**
     * Show the edit form for a product
     */
    public function edit(Request $request)
    {
        // Validate that user is logged in and an admin
        if (!Auth::check() || auth()->user()->admin != 1) {
            return redirect()->route('home')->with(['status' => 'NOT OK', 'message' => 'Acceso no autorizado', 'icon' => 'error']);
        }

        $id = $request->input('id');
        
        $product = Product::with(['reviews' => function ($query) {
            $query->orderBy('created_at', 'desc');
        }, 'reviews.author'])->find($id);

        $imagePath = public_path().'/storage/images/products/prod_'. $product->id.'.png';

        if (file_exists($imagePath)) {
            $product->image = asset('storage/images/products/prod_'.$product->id.'.png');
        } else {
            $product->image = asset('storage/images/products/default.png');
        }

        return view('product.create', compact(['product']));
    }

    /**
     * Update a record in the DB
     */
    public function update(Request $request)
    {

        // Validate that user is logged in and an admin
        if (!Auth::check() || auth()->user()->admin != 1) {
            return ['status' => 'NOT OK', 'message' => 'Acceso no autorizado', 'icon' => 'error'];
        }
        
        // Use Validator class to avoid automatic response by laravel
        $validation = Validator::make(
            $request->all(),
            [
                'name' => 'required',
                'description' => 'required',
                'price' => 'required|numeric|min:0',
                'img' => 'file|image'
            ]
        );

        if ($validation->stopOnFirstFailure()->fails()) {
            return ['status' => 'NOT OK', 'message' => $validation->errors()->first(), 'icon' => 'error'];
        }
        
        $id = $request->input('id');
        
        $product=Product::find($id);
        
        $product_data = $request->except('_token', '_method', 'id', 'img');
        
        try {
            // Change image
            $existingImagePath = public_path("storage/images/products/prod_".$id.".png");
            
            $file=$request->file('img');
            
            if ($file != null){            
                // Delete current image if exists
                // return ['status' => 'OK', 'message' => file_exists($existingImagePath), 'icon' => 'error'];
                if (file_exists($existingImagePath)) {
                    File::delete($existingImagePath);
                }
                
                $file->move(public_path("storage\images\products"), "\prod_".$id.".png");
            } 
            
            $product->update($product_data);
        } catch (\Throwable $th) {
            return ['status' => 'OK', 'message' => 'Ha habido un error actualizando el producto', 'icon' => 'error'];
        }
    
        return ['status' => 'OK', 'message' => 'Producto actualizado', 'icon' => 'success'];
    }


    /**
     * Perform a payment for the specified products
     */
    public function pagar(Request $request){

        // Validate that user is logged in
        if (!Auth::check()) {
            return ['status' => 'NOT OK', 'message' => 'Acceso no autorizado', 'icon' => 'error'];
        }

        // Validate items sent and add up price
        $precio = 0;
        $items = $request->input('items');

        foreach ($items as $id) {
            $product = Product::find($id);

            if (!$product) {
                return back()->with('status', 'Producto no encontrado');
            }

            $precio += $product->price;

        }

        $idsGETVar = implode(',', $items);

        $correo = auth()->user()->email;

        $apiContext = new \PayPal\Rest\ApiContext(
            new \PayPal\Auth\OAuthTokenCredential(
                config('services.paypal.client_id'), // ClientID
                config('services.paypal.secret') // ClientSecret
            )
        );


        $payer = new \PayPal\Api\Payer();
        $payer->setPaymentMethod('paypal');


        $amount = new \PayPal\Api\Amount();
        //precio a pagar
        $amount->setTotal($precio);
        $amount->setCurrency('EUR');

        // Generar var GET ids
   


        $varGetIds = implode(',',$items);
       
    

        $transaction = new \PayPal\Api\Transaction();
        $transaction->setAmount($amount);
        
        //le envio a la pagina informacion del id
        //si se cancela lo llevo a la pagina que quiero
        $redirectUrls = new \PayPal\Api\RedirectUrls();
        $redirectUrls
        ->setReturnUrl(url(route('product.bought')."?ids=$varGetIds"))  //Ruta 'OK'
        ->setCancelUrl(url(route('cart.show')));        //Ruta 'Cancel'


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

    /**
     * Return view after purchase for confirmation
     */
    public function afterPurchase(Request $request)
    {
        // Validate that user is logged in
        if (!Auth::check()) {
            return ['status' => 'NOT OK', 'message' => 'Acceso no autorizado', 'icon' => 'error'];
        }

        $ids=explode(',',$request->input('ids'));

        //ENVIAMOS UNA VARIABLE FACTURA TRUE PARA INDICAR QUE LA VIEW DEL CORREO QUE ENVIAMOS ES LA DE LA TABLA
        $factura=true;
      
        $correo=auth()->user()->email;
        
        //ASUNTO
        $sub="FACTURA CAHM";

        // ELIMINAR PRODUCTOS DEL CARRITO COMPRADOS

        foreach ($ids as $id) {
            try {
                ShoppingCart::where([
                    'user_id'=>auth()->user()->id,
                    'product_id'=>$id
                ])->first()->delete();
            } catch (\Throwable $th) {
                continue;
            }
        }

        //Mensaje: enviar los productos que se han comprado
        try {
            $datos=array('products'=>$ids);
            
            //ENVIAMOS CORREO
            $enviar= new EnviarCorreo($datos,$factura);
            $enviar->sub=$sub;
            Mail::to($correo)->send($enviar);
          
        } catch (\Throwable $th) {
            // dd($th);
        }
        
        // REDIRIGIMOS A LA VIEW DE COMPRA FINALIZADA
        return view('cart.afterPurchase');
    }


    public function test()
    {
        // $receipt = ReceiptItem::find(1);

        // $receipt->items()->createMany([
        //     ['product_id' => 3],
        //     ['product_id' => 2]
        // ]);
        // $result = $receipt;

        // return view('test.test', compact(['result']));

        return redirect()->route('home');
    }
}
