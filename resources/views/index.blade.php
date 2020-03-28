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
    @endif
</div>
@endsection