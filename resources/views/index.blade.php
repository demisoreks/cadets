@extends('app', ['page_title' => config('app.name')])

<?php
use GuzzleHttp\Client;

if (!isset($_SESSION)) session_start();
$halo_user = $_SESSION['halo_user'];
        
$client = new Client();
$res = $client->request('GET', DB::table('acc_config')->whereId(1)->first()->master_url.'/api/getRoles', [
    'query' => [
        'username' => $halo_user->username,
        'link_id' => config('var.link_id')
    ]
]);
$permissions = json_decode($res->getBody());
?>
@section('content')
@include('commons.message')
<div class="row">
    @if (count(array_intersect($permissions, ['Instructor', 'SeniorInstructor', 'RegionalManager', 'Admin'])) != 0)
    <div class="col-12">
        <h4 class="page-header text-primary" style="border-bottom: 1px solid #999; padding-bottom: 20px; margin-bottom: 20px;">Training Management</h4>
    </div>
    @if (count(array_intersect($permissions, ['Instructor', 'SeniorInstructor'])) != 0)
    <div class="col-md-3" style="margin-bottom: 20px;">
        <a href="{{ route('courses.index') }}">
            <div class="card">
                <div class="card-body text-center">
                    <h1 class="text-info"><i class="fas fa-users"></i></h1>
                    <h5 class="text-primary">Courses</h5>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-3" style="margin-bottom: 20px;">
        <a href="{{ route('locations.index') }}">
            <div class="card">
                <div class="card-body text-center">
                    <h1 class="text-info"><i class="fas fa-map"></i></h1>
                    <h5 class="text-primary">Locations</h5>
                </div>
            </div>
        </a>
    </div>
    @if (count(array_intersect($permissions, ['SeniorInstructor'])) != 0)
    <div class="col-md-3" style="margin-bottom: 20px;">
        <a href="{{ route('cadets.waiver') }}">
            <div class="card">
                <div class="card-body text-center">
                    <h1 class="text-info"><i class="fas fa-hand-point-right"></i></h1>
                    <h5 class="text-primary">Entry Waiver</h5>
                </div>
            </div>
        </a>
    </div>
    @endif
    @endif
    @if (count(array_intersect($permissions, ['RegionalManager'])) != 0)
    <div class="col-md-3" style="margin-bottom: 20px;">
        <a href="{{ route('courses.approvals') }}">
            <div class="card">
                <div class="card-body text-center">
                    <h1 class="text-info"><i class="fas fa-money-check"></i></h1>
                    <h5 class="text-primary">Approvals</h5>
                </div>
            </div>
        </a>
    </div>
    @endif
    @endif
    @if (count(array_intersect($permissions, ['Admin'])) != 0)
    <div class="col-12">
        <h4 class="page-header text-primary" style="border-bottom: 1px solid #999; padding-bottom: 20px; margin-bottom: 20px;">Settings</h4>
    </div>
    <div class="col-md-3" style="margin-bottom: 20px;">
        <a href="{{ route('config') }}">
            <div class="card">
                <div class="card-body text-center">
                    <h1 class="text-info"><i class="fas fa-cogs"></i></h1>
                    <h5 class="text-primary">Configuration</h5>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-3" style="margin-bottom: 20px;">
        <a href="{{ route('regions.index') }}">
            <div class="card">
                <div class="card-body text-center">
                    <h1 class="text-info"><i class="fas fa-map"></i></h1>
                    <h5 class="text-primary">Regions</h5>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-3" style="margin-bottom: 20px;">
        <a href="{{ route('metrics.index') }}">
            <div class="card">
                <div class="card-body text-center">
                    <h1 class="text-info"><i class="fas fa-question"></i></h1>
                    <h5 class="text-primary">Exam Metrics</h5>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-3" style="margin-bottom: 20px;">
        <a href="{{ route('measures.index') }}">
            <div class="card">
                <div class="card-body text-center">
                    <h1 class="text-info"><i class="fas fa-thumbs-up"></i></h1>
                    <h5 class="text-primary">Quality Measures</h5>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-3" style="margin-bottom: 20px;">
        <a href="{{ route('bands.index') }}">
            <div class="card">
                <div class="card-body text-center">
                    <h1 class="text-info"><i class="fas fa-star"></i></h1>
                    <h5 class="text-primary">Quality Bands</h5>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-3" style="margin-bottom: 20px;">
        <a href="{{ route('assessments.index') }}">
            <div class="card">
                <div class="card-body text-center">
                    <h1 class="text-info"><i class="fas fa-check"></i></h1>
                    <h5 class="text-primary">Assessments</h5>
                </div>
            </div>
        </a>
    </div>
    <div class="col-md-3" style="margin-bottom: 20px;">
        <a href="{{ route('instructor_details.index') }}">
            <div class="card">
                <div class="card-body text-center">
                    <h1 class="text-info"><i class="fas fa-id-card"></i></h1>
                    <h5 class="text-primary">Instructors</h5>
                </div>
            </div>
        </a>
    </div>
    @endif
</div>
@endsection