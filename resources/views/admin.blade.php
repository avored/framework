@extends('avored::layouts.app')

@section('meta_title')
    AvoRed E commerce Admin Dashboard
@endsection

@section('page_title')
    Dashboard
@endsection

@section('content')
<a-row type="flex" :gutter="20" justify="center">
    {{ $orderWidget->render() }}
    {{ $customerWidget->render() }}
    {{ $revenueWidget->render() }}
</a-row>
<a-row type="flex" class="mt-1" justify="center">
    <a-col :span="24">
        <a-card  title="Admin Dashboard">
            <div>
                <p>We will really appriciate if you give us any feedback about the project.
                It helps us to developed more better.</p>
                <p>You can help us in my ways like helping in our 
                    <a href="https://github.com/avored/documentation" title="AvoRed Documantation Repository">docs</a>, 
                    <a href="https://github.com/avored/framework" title="AvoRed Framework Repository">framework</a>, or create an
                    <a href="https://github.com/avored/laravel-ecommerce/issues" title="Avored laravel repository">issue</a>.
                </p>
                
            </div>
        </a-card>
    </a-col>
</a-row>
@endsection
