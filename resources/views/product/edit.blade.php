@extends('avored-framework::layouts.app')

@section('content')
<div id="admin-product-edit-page">
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-body">
                    <nav class="navbar navbar-expand-lg navbar-default">
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav mr-auto">
                                <li class="nav-item dropdown">
                                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> {{  __('avored-framework::product.actions.title') }}</a>
                                    <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                        <a class="dropdown-item" href="#">Change product SEO</a>
                                        <div class="dropdown-divider"></div>          
                                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#exampleModal">{{  __('avored-framework::product.actions.manage_barcodes') }}</a>
                                        <a class="dropdown-item" href="#" data-toggle="modal" data-target="#historyModal">{{  __('avored-framework::product.actions.history') }}</a>
                                        <div class="dropdown-divider"></div>
                                        <form method="post" action="{{ route('admin.product.destroy', $model->id)  }}">
                                            @csrf()
                                            @method('delete')
                                            <button class="btn-link dropdown-item" onClick="event.preventDefault(); 
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
                                            });">{{  __('avored-framework::product.actions.delete') }}</a>
                                        </form>
                                    </div>
                                </li>

                                <li class="nav-item"><a class="nav-link" href="#info">{{  __('avored-framework::product.details.information') }}</a></li>
                                <li class="nav-item"><a class="nav-link" href="#pricing">{{  __('avored-framework::product.details.pricing') }}</a></li>
                                <li class="nav-item"><a class="nav-link" href="#stock">{{  __('avored-framework::product.details.stock') }}</a></li>
                                <li class="nav-item"><a class="nav-link" href="#images">{{  __('avored-framework::product.details.images') }}</a></li>
                                <li class="nav-item"><a class="nav-link" href="#crossupsell">{{  __('avored-framework::product.details.crossupsell') }}</a></li> 
                            </ul>
                        </div>
                    </nav>
                </div>
            </div>
        </div>
    </div>

    <div class="clearfix">&nbsp;</div>
    
    <?php $productCategories = $model->categories()->get()->pluck('id')->toArray(); ?>
    
    <form id="product-save-form" action="{{route('admin.product.update', $model->id)}}" enctype="multipart/form-data" method="post">
        @csrf
        @method('put')
        <div class="row" id="product-save-accordion" data-children=".product-card">
            <div class="col-12">
                <div class="card product-card">
                    <div class="card-body" id="basic">
                        <form>
                            <div class="form-row">
                                <div class="col-md-4">
                                    <div class="form-group col-md-12">
                                        @include('avored-framework::forms.text',['name' => 'name', 'label' => __('avored-framework::product.name')])
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group col-md-12">
                                        @include('avored-framework::forms.text',['name' => 'slug', 'label' => __('avored-framework::product.slug')])
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group col-md-8">
                                         @include('avored-framework::forms.select',[
                                            'name' => 'status', 
                                            'label' => __('avored-framework::product.status.title'), 
                                            'options' => [
                                                '1' => __('avored-framework::product.status.enabled'),
                                                '0' => __('avored-framework::product.status.disabled')
                                            ]
                                        ])
                                    </div>
                                </div>
                            </div>
                            <div class="form-row">
                                <div class="col-md-4">
                                    <div class="form-group col-md-12">
                                        @include('avored-framework::forms.select2',[
                                            'name' => 'category_id[]',
                                            'label' => __('avored-framework::product.category'),
                                            'attributes' => ['class' => 'form-control select2', 'id' => 'category_id', 'multiple' => true],
                                            'options' => $categoryOptions,
                                            'values' => $productCategories])                                    
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group col-md-12">
                                        @include('avored-framework::forms.text',['name' => 'sku','label' => __('avored-framework::product.sku')])
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

        <div class="clearfix">&nbsp;</div>
        @include('avored-framework::product.card.price')
        <div class="clearfix">&nbsp;</div>
        @include('avored-framework::product.card.stock')
        <div class="clearfix">&nbsp;</div>
        @include('avored-framework::product.card.images')
        <div class="clearfix">&nbsp;</div>
        @include('avored-framework::product.card.property')        
    </form>
</div>


<!-- Barcode management !-->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Manage Bardcodes</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        All barcodes known in the system for this product.
        <div class="text-right">
            <button class="btn btn-sm btn-primary">Add barcode</button>
        </div>
        <div class="clearfix">&nbsp;</div>

        <table class="table table-striped">
            <thead>
                <th>Barcode</th>
                <th>Action</th>
            </thead>
            <tbody>
                <tr>
                    <td><input type="text" name="bardcode" value="465465487" class="form-control"></td>
                    <td><button class="btn btn-sm btn-danger">-</button></td>
                </tr>
                <tr>
                    <td><input type="text" name="bardcode" value="123456789" class="form-control"></td>
                    <td><button class="btn btn-sm btn-danger">-</button></td>
                </tr>
            </tbody>
        </table>
      </div>
    </div>
  </div>
</div>

<!-- Product History !-->
<div class="modal fade" id="historyModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Manage Bardcodes</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
            All barcodes known in the system for this product.
        <div class="text-right">
            <button class="btn btn-sm btn-primary">Add barcode</button>
        </div>
        <div class="clearfix">&nbsp;</div>

        <table class="table table-striped">
            <thead>
                <th>Barcode</th>
                <th>Action</th>
            </thead>
            <tbody>
                <tr>
                    <td><input type="text" name="bardcode" value="465465487" class="form-control"></td>
                    <td><button class="btn btn-sm btn-danger">-</button></td>
                </tr>
                <tr>
                    <td><input type="text" name="bardcode" value="123456789" class="form-control"></td>
                    <td><button class="btn btn-sm btn-danger">-</button></td>
                </tr>
            </tbody>
        </table>
      </div>
    </div>
  </div>
</div>
@endsection