@extends('layouts.main')

@section('css')
<link rel="stylesheet" href="{{ asset('css/profile.css') }}">
@vite(['resources/css/app.css', 'resources/js/app.js'])
@endsection

@section('body')
<div class="container-fluid mt-3">
    <div class="mx-3">
        <div class="p-4 mb-4 bg-w-smoke shadow-lg rounded rounded-4">
            <div class="max-w-xl">
                @include('profile.partials.update-profile-information-form')
            </div>
        </div>

        <div class="p-4 mb-4 bg-w-smoke shadow-lg rounded rounded-4">
            <div class="max-w-xl">
                @include('profile.partials.update-password-form')
            </div>
        </div>

        <div class="p-4 mb-4 bg-w-smoke shadow-lg rounded rounded-4">
            <div class="max-w-xl">
                @include('profile.partials.update-store-form')
            </div>
        </div>

        <div class="p-4 mb-4 bg-w-smoke shadow-lg rounded rounded-4">
            <div class="max-w-xl">
                @include('profile.partials.delete-user-form')
            </div>
        </div>
    </div>
</div>
@endsection