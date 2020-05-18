@extends('layouts.azia')
@section('content')
    <div class="row">
        <div class="col-12 col-md-3">
            <div class="card card-dashboard-twentytwo">
                <div class="media">
                  <div class="media-icon bg-purple"><i class="typcn typcn-user-outline"></i></div>
                  <div class="media-body">
                    <h6>{{ $docentes }}</h6>
                    <span>Docentes</span>
                  </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-3">
            <div class="card card-dashboard-twentytwo">
                <div class="media">
                  <div class="media-icon bg-teal"><i class="typcn typcn-calendar-outline"></i></div>
                  <div class="media-body">
                    <h6><a href="{{ route('shedules.index') }}" class="tx-black">Control de Horarios</a></h6>
                  </div>
                </div>
            </div>
        </div>
    </div>
@endsection
