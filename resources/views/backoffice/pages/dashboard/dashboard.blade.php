@extends('adminlte::page')

@section('title', 'AdminLTE')

@section('content_header')
    <h1>Dashboard</h1>
@stop

@section('content')
    <!--
    <section class="content">
        <div class="row">
            <div class="col-md-3">
                <div class="small-box bg-aqua">
                    <div class="inner">
                         <h3>{{-- $pageViews --}}</h3>
                        <p>Page views</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-eye"></i>
                    </div>
                    <a href="https://analytics.google.com/analytics/web/" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-md-3">
                <div class="small-box bg-green">
                    <div class="inner">
                        <h3>{{-- $users --}}</h3>
                        <p>New Users</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-person-stalker"></i>
                    </div>
                    <a href="https://analytics.google.com/analytics/web/" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-md-3">
                <div class="small-box bg-yellow">
                    <div class="inner">
                        <h3>{{-- $visitors --}}</h3>
                        <p>Visitors</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-pie-graph"></i>
                    </div>
                    <a href="https://analytics.google.com/analytics/web/" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>

            <div class="col-md-3">
                <div class="small-box bg-red">
                    <div class="inner">
                        <h3>{{-- $time --}}</h3>
                        <p>Time</p>
                    </div>
                    <div class="icon">
                        <i class="ion ion-clock"></i>
                    </div>
                    <a href="https://analytics.google.com/analytics/web/" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
                </div>
            </div>
        </div>  

        <div class="row">
            <div class="col-md-12">
                <div id="world-map" style="height: 400px"></div>
            </div>
        </div>
    </section>
    -->
{!! Toastr::message() !!}


<script>
    /*
    var count = <?php //echo json_encode($countries[0]); ?>;
    var visitorsData = {};


    for(var i=0; i<count.length; i++){
        var countryTag = count[0];
        var countryNumber = count[1];
        visitorsData[countryTag] = countryNumber;
    }

    jQuery('#world-map').vectorMap({
        map: 'world_mill',
    series: {
        regions: [{
        values: visitorsData,
        scale: ['#C8EEFF', '#0071A4'],
        normalizeFunction: 'polynomial'
        }]
    },
    onRegionTipShow: function(e, el, code){
        el.html(el.html()+' (GDP - '+visitorsData[code]+')');
    }
    });
    */
</script>
@stop