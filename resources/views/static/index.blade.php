@extends('layouts.main')

@section('header-title')
Главная
@endsection

@section('content')

@if(session('success'))
<div class="alert-success">{{ session('success') }}</div>
@endif

<div class="main-container">
    <h1 class="page-title">Главная</h1>

</div>

<div class="review">
        
</div>
@endsection