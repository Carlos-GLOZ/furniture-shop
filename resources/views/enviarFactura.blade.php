
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>
<body>

    <br>




<div style="text-align:center;">
    <div><h1> FICHA DE LA FACTURA  <img style="width: 30px;height:30px" src="https://canyengues.files.wordpress.com/2019/05/ficha-png.png" alt=""> </h1></div>
    

    <table style="border-collapse: collapse;background-color:#c7d0d8;">
                        <thead >
                            <tr>
                               
                                <th style=" border: 1px solid #333;  padding: 8px;">Producto <img style="width: 20px;height:20px" src="https://cdn.pixabay.com/photo/2021/05/25/02/03/restaurant-6281067_960_720.png" alt=""> </th>
                                <th style=" border: 1px solid #333;  padding: 8px;">Precio <img style="width: 20px;height:20px" src="https://cdn-icons-png.flaticon.com/512/40/40087.png" alt=""></th>
                              
                               
                                
                            </tr>
                        </thead>
                        <tbody >
                           

                                @foreach ($products as $product)
                                <tr>
                                    <td style=" border: 1px solid #333;  padding: 8px;">
                                        {{$product->name}}
                                    </td>
                                    <td style=" border: 1px solid #333;  padding: 8px;">
                                        {{$product->price}}€
                                
                                    </td>
                                </tr>
                                @endforeach
                            
                            

                            

                            <tr>
                                <th style=" border: 1px solid #333;  padding: 8px;" >TOTAL</th>
                                <th style=" border: 1px solid #333;  padding: 8px;">{{ number_format($products->sum('price'), 2) }}€</th>
                            </tr>
                       </tbody>
    </table>
                   
    
                    <div style="margin-top:20px;">
    
                    <img style="width: 50px;height:50px" src="https://lh3.googleusercontent.com/a/AGNmyxaaM81UMeOKutDaA8kCTm1angF9jC4iG2yfWmQe=s96-c-rg-br100" alt="Example Image">
                    </div>
    
                    </div>

</body>
</html>
