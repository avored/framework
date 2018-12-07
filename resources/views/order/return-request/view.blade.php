@extends('avored-framework::layouts.app')

@section('content')
<div class="row">
    <div class="col-12">
        <div class="main-title-wrap">
            <div class='h2'>
                {{  __('avored-framework::orders.order-return-request-details') }} (#{{ $returnRequest->id }}) 

                @if($returnRequest->status === "PENDING")
                <small><span class="badge badge-danger">{{  __('avored-framework::orders.pending') }}</span></small>
                @elseif($returnRequest->status === "IN_PROGRESS")
                <small><span class="badge badge-info">{{  __('avored-framework::orders.in-progress') }}</span></small>
                @elseif($returnRequest->status === "APPROVED")
                <small><span class="badge badge-success">{{  __('avored-framework::orders.approved') }}</span></small>
                @elseif($returnRequest->status === "REJECTED")
                <small><span class="badge badge-danger">{{  __('avored-framework::orders.rejected') }}</span></small>
                
                @endif

                </div>
            </div>
            
           

            <div class="clearfix"></div>
            <div class="card mt-3">
                    <div class="card-header text-white bg-secondary">{{  __('avored-framework::orders.other-data') }}</div>
                    <div class="card-body">
                        <table class="table">
                            <tr>
                                <th>Shipping Option</th>
                                <td><span class="badge badge-info"> {{ $returnRequest->order->shipping_option }} </span></td>
                            </tr>
                            <tr>
                                <th>Payment Option</th>
                                <td>{{ $returnRequest->order->payment_option }}</td>
                            </tr>
                            <tr>
                                <th>User Comment</th>
                                <td>{{ $returnRequest->comment }}</td>
                            </tr>
                            <tr>
                                <th>Action</th>
                                <td>
                                    <p>
                                        <form method="post"
                                            action="{{ route('admin.order-return-request.update-status', 
                                                            [
                                                                'returnRequest' => $returnRequest->id,
                                                                'status' => 'REJECTED',
                                                            ]) }}"
                                        >
                                            @csrf()
                                            @method('put')


                                            <button type="submit" class="btn btn-warning" >
                                                {{  __('avored-framework::orders.rejected') }}
                                            </button>
                                        </form>
                                    </p>
                                    <p>
                                    <form method="post"
                                            action="{{ route('admin.order-return-request.update-status', 
                                                            [
                                                                'returnRequest' => $returnRequest->id,
                                                                'status' => 'IN_PROGRESS',
                                                            ]) }}"
                                        >
                                            @csrf()
                                            @method('put')


                                            <button type="submit" class="btn btn-info" >
                                                {{  __('avored-framework::orders.in-progress') }}
                                            </button>
                                        </form>
                                    </p>
                                    <p>
                                    <form method="post"
                                            action="{{ route('admin.order-return-request.update-status', 
                                                            [
                                                                'returnRequest' => $returnRequest->id,
                                                                'status' => 'APPROVED',
                                                            ]) }}"
                                        >
                                            @csrf()
                                            @method('put')


                                            <button type="submit" class="btn btn-success" >
                                                {{  __('avored-framework::orders.approved') }}
                                            </button>
                                        </form>
                                    </p>
                                </td>
                            </tr>
                        </table>
                    </div>
                </div> 

                <div class="mt-3 card">
                    <div class="card-header text-white bg-secondary">
                        
                        {{  __('avored-framework::lang.products') }}
                    </div>

                    <div class="card-body">
                        <table class="table">
                            <thead>
                                <tr>
                                    <th>{{ __('avored-framework::lang.name') }}</th>
                                    <th>{{ __('avored-framework::lang.qty') }}</th>
                                    
                                    <th>Reason</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach($returnRequest->products as $product)
                            
                                <tr>
                                    <td>
                                        {{ $product->model->name }} 
                                    </td>
                                    <td> {{ $product->qty }} </td>
                                    <td> {{ $product->reason }} </td>
                                  
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                <div class="mt-3 card">
                    <div class="card-header text-white bg-secondary">
                        <span class="fa fa-user"></span>
                        {{  __('avored-framework::orders.customer-data') }}
                    </div>

                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <h4>{{  __('avored-framework::orders.shipping-address') }}</h4>

                                <p>
                                    {{ $returnRequest->order->shipping_address->first_name }} {{ $returnRequest->order->shipping_address->last_name }}
                                    <br/>
                                    {{ $returnRequest->order->shipping_address->address1 }}<br/>
                                    {{ $returnRequest->order->shipping_address->address2 }}<br/>
                                    {{ $returnRequest->order->shipping_address->area }}<br/>
                                    {{ $returnRequest->order->shipping_address->city }}<br/>
                                    {{ $returnRequest->order->shipping_address->state }} {{ $returnRequest->order->shipping_address->country->name }}
                                    <br/>
                                    {{ $returnRequest->order->shipping_address->phone }}<br/>
                                </p>
                            </div>
                            <div class="col-md-6">
                                <h4>{{  __('avored-framework::orders.billing-address') }}</h4>

                                <p>
                                    {{ $returnRequest->order->billing_address->first_name }} {{ $returnRequest->order->shipping_address->last_name }}
                                    <br/>
                                    {{ $returnRequest->order->billing_address->address1 }}<br/>
                                    {{ $returnRequest->order->billing_address->address2 }}<br/>
                                    {{ $returnRequest->order->billing_address->area }}<br/>
                                    {{ $returnRequest->order->billing_address->city }}<br/>
                                    {{ $returnRequest->order->billing_address->state }} {{ $returnRequest->order->shipping_address->country->name }}
                                    <br/>
                                    {{ $returnRequest->order->billing_address->phone }}<br/>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
               
            </div>
        </div>
    </div>

@endsection

