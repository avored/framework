
@include('avored-framework::forms.file',['name' => 'downloadable[demo_product]','label' => 'Demo Product (If any)'])

@if(isset($product) && isset($product->downloadable) && $product->downloadable->demo_path != "")
        
<a href="{{ route('admin.product.download.demo.media', $product->downloadable->token) }}"
           class="download-main-media-link" 
    >
        Download Demo Media
    </a>
@endif



@include('avored-framework::forms.file',['name' => 'downloadable[main_product]','label' => 'Main Product'])

@if(isset($product) && isset($product->downloadable) && $product->downloadable != "")

    
    
    <a href="{{ route('admin.product.download.main.media', $product->downloadable->token) }}"
           class="download-main-media-link" 
    >
        Download Main Media
    </a>
    

@endif
