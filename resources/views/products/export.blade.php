<table>
    <thead>
        <tr>

            <th> CODIGO</th>
            <th> NOMBRE DE PRODUCTO</th>
            <th> CARACTERISTICAS</th>
            <th> UNIDAD</th>
            <th> MARCA</th>
            <th> INDUSTRIA</th>
            <th> CATEGORIA</th>
            <th> SUBCATEGORIA</th>
            <th> COSTO</th>
            <th> PRECIO VENTA</th>
            <th> STATUS</th>

        </tr>
    </thead>
    <tbody>
        @foreach ($data as $products)
            <tr>


                <td>
                    {{ $products->codigo }}
                </td>
                <td>
                    {{ $products->nombre }}


                </td>
                <td>
                    {{ $products->caracteristicas }}
                </td>
                <td>
                    {{ $products->unidad ? $products->unidad : 'No definido' }}
                </td>
                <td>
                    {{ $products->marca ? $products->marca : 'No definido' }}
                </td>
                <td>
                    {{ $products->industria ? $products->industria : 'No definido' }}
                </td>
                @if ($products->category->subcat != null)
                    <td>
                        {{ $products->category->subcat->name }}
                    </td>
                    <td>
                        {{ $products->category->name }}
                    </td>
                @else
                    <td>
                        {{ $products->category->name }}
                    </td>
                    <td>
                        No definido

                    </td>
                @endif

                <td>
                    {{ $products->costoActivo() == null ? '--' : $products->costoActivo()}}
                </td>
                <td>
                    {{ $products->precioActivo() == null ? '--' : $products->precioActivo()}}
                </td>
                

                <td>
                    {{ $products->status }}
                </td>




            </tr>
        @endforeach

        {{-- {{var_export ($selectedProduct)}} --}}
    </tbody>
</table>
