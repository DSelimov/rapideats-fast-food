@extends('layouts.app') <!-- This tells Blade to use the app layout -->

@section('content') <!-- This defines the content that will be injected into the layout -->

<div class="container mx-auto py-12">
    <h2 class=" font-semibold text-3xl text-black leading-tight mb-6">Profile</h2>

    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
            @include('profile.partials.update-profile-information-form')
        </div>

        <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
            @include('profile.partials.update-password-form')
        </div>

        <div class="bg-white dark:bg-gray-800 shadow rounded-lg p-6">
            @include('profile.partials.delete-user-form')
        </div>
    </div>
</div>

@endsection
