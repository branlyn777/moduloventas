<table>
    <thead>
        <tr>
        
                                  
            <th>PRODUCTO</th>                              
            <th>CODIGO</th>                              
            <th>STOCK</th>
            <th>CANT.MIN</th>                                       
          
    </thead>
    <tbody>
        @foreach ($destinos_almacen as $destino)
       <tr>
              
                <td>
                   {{$destino->nombre}}
                   
                 
                </td>
                <td>
                    {{$destino->codigo}}
                </td>
              
                @if ($destino->stock_s != null)
                <td>
                    {{ $destino->stock_s }} 
                </td>
                    
                @else
                <td>
                    {{ $destino->stock }} 
                </td>
                @endif
                <td>
                   {{ $destino->cantidad_minima }}
                </td>
          
            

            </tr>
        @endforeach
    </tbody>
</table>