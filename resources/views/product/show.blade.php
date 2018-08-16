@extends('avored-framework::layouts.app')
@section('content')
    <div class="card">
        <div class="card-header">
            Product Details
        </div>

        <div class="card-body table-bordered">
            <table class="table">
                <tr>
                    <td>Name</td>
                    <td>{{ $product->name }}</td>
                </tr>
                
                <tr>
                    <td>Slug</td>
                    <td>{{ $product->slug }}</td>
                </tr>
                
                <tr>
                    <td>SKU</td>
                    <td>{{ $product->sku }}</td>
                </tr>
                <tr>
                    <td>Category</td>
                    <td>
                        <ul>
                            @foreach($product->categories as $category)
                            <li>{{ $category->name }}</li>
                            @endforeach
                        </ul>
                    </td>
                </tr>

                <tr>
                    <td>Price</td>
                    <td>{{ $product->price }}</td>
                </tr>
                
                <tr>
                    <td>Status</td>
                    <td>{{ $product->status }}</td>
                </tr>
                
                <tr>
                    <td>Qty</td>
                    <td>{{ $product->qty }}</td>
                </tr>
                
                <tr>
                    <td>In Stock</td>
                    <td>{{ ($product->in_stock) ? "Enabled" : "Disabled" }}</td>
                </tr>
                <tr>
                    <td>Track Stock</td>
                    <td>{{ ($product->track_stock) ? "Enabled" : "Disabled" }}</td>
                </tr>
                

                <tr>
                    <td>Wight</td>
                    <td>{{ $product->weight }}</td>
                </tr>


                <tr>
                    <td>Width</td>
                    <td>{{ $product->width }}</td>
                </tr>


                <tr>
                    <td>Height</td>
                    <td>{{ $product->height }}</td>
                </tr>


                <tr>
                    <td>Length</td>
                    <td>{{ $product->length }}</td>
                </tr>
              
            </table>

            <div class="float-left">
            
                <form method="post" action="{{ route('admin.product.destroy', $product->id)  }}">
                    @csrf()
                    @method('delete')
                    <button
                        onClick="event.preventDefault(); 
                                    swal({
                                        dangerMode: true,
                                        title: 'Are you sure?',
                                        icon: 'warning',
                                        buttons: true,
                                        text: 'Once deleted, you will not be able to recover this Product!',
                                    }).then((willDelete) => {
                                        if (willDelete) {
                                            jQuery(this).parents('form:first').submit();
                                        }
                                    });"    
                        class="btn btn-danger" >
                        Destroy
                    </button>
                </form>
               
            </div>
            <a class="btn" href="{{ route('admin.product.index') }}">Cancel</a>
        </div>
    </div>

@stop