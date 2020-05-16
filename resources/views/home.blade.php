@extends('layouts.azia')
@section('content')
    <div class="row row-sm mg-b-15 mg-sm-b-20">
        <div class="col-lg-6 col-xl-7">
            <div class="card card-dashboard-six">
                <div class="card-header">
                    <div>
                        <label class="az-content-label">This Year's Total Revenue</label>
                        <span class="d-block">Sales Performance for Online and Offline Revenue</span>
                    </div>
                    <div class="chart-legend">
                        <div><span>Online Revenue</span> <span class="bg-indigo"></span></div>
                        <div><span>Offline Revenue</span> <span class="bg-teal"></span></div>
                    </div>
                </div><!-- card-header -->
                <div id="morrisBar1" class="ht-200 ht-lg-250 wd-100p"></div>
            </div><!-- card -->
        </div><!-- col -->
        <div class="col-lg-6 col-xl-5 mg-t-20 mg-lg-t-0">
            <div class="card card-dashboard-map-one">
                <label class="az-content-label">Sales Revenue by Customers in USA</label>
                <span class="d-block mg-b-20">Sales Performance of all states in the United States</span>
                <div id="vmap2" class="vmap-wrapper"></div>
            </div><!-- card -->
        </div><!-- col -->
    </div><!-- row -->
@endsection
