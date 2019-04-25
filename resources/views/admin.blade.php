@extends('avored::layouts.app')

@section('meta_title')
    AvoRed E commerce Admin Dashboard
@endsection

@section('page_title')
    Dashboard
@endsection

@section('content')
<a-row type="flex" justify="center">
    <a-col :span="24">
        <a-card  title="Admin Dashboard">
            <div>
                <p>Avored Admin Dashboard</p>
            </div>
        </a-card>
    </a-col>
</a-row>
@endsection
