@extends('relatorio.index')
@section('title', 'Broken Link Checker')
    
@section('content')
@if (session('error'))
@component('components.danger')
    {{session('error')}}
@endcomponent
@endif
<style>
  .rating-score {
    position: absolute;
    top: 50%;
    left: 50%;
    width: 40px;
    height: 40px;
    margin: -20px;
    color: #6c757d;
    font-size: 24px;
    font-weight: bold;
    line-height: 40px;
    text-align: center;
  }
</style>
<h3 class="page-title pb-1 mb-3 border-bottom">Backlink Analysis</h3>

        

        <h5 class="ribbon">Statistics</h5>
        <div class="row">
          <div class="col-6">
            <table class="table table-borderless w-auto mb-0">
              <tr>
                <th>Analyzed link</th>
                <td>{{$backlink['url']}}</td>
              </tr>
              <tr>
                <th>Backlinks</th>
                <td>{{$backlink['backlinks']}}</td>
              </tr>
              <tr>
                <th>Referring domains</th>
                <td>{{$backlink['domains']}}</td>
              </tr>
            </table>
          </div>
          <div class="col-6 py-3">
            <div style="position: relative; height: 100px; width: 100px; margin-left: auto;">
              <canvas id="RatingGraph"></canvas>
              <div class="rating-score" title="Domain rating">{{rand(50, 80)}}</div>
            </div>
          </div>
        </div>

        <h5 class="ribbon mt-3">Top backlinks</h5>
        <table class="table">
          <thead>
            <tr>
              <th>Referring page</th>
              <th title="Number of domains linking to this page">Domains</th>
              <th title="Estimated monthly organic traffic to this page">Traffic</th>
              <th>Anchor snippet</th>
              <th>Tags</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($backlinkitens as $item)
            <tr>
              <td>
                <a href="{{$item->page}}">{{$item->page}}</a>
              </td>
              <td>{{$item->domains}}</td>
              <td>{{$item->traffic}}</td>
              <td>
                {{$item->anchor}}</a>
              </td>
              <td>{{$item->tags}}</td>
            </tr>
            @endforeach
          </tbody>
        </table>
        <script type="text/javascript" src="{{url('assets/js/chart.min.js')}}"></script>
  <script type="text/javascript">
    var ctx = document.getElementById('RatingGraph').getContext('2d');
    var myChart = new Chart(ctx, {
      type: 'doughnut',
      data: {
          datasets: [{
            data: [39, 61],
            backgroundColor: [
              '#f36221',
              '#eee'
            ],
            borderWidth: 0
          }]
      },
      options: {
        cutout: '75%',
        maintainAspectRatio: false,
        plugins: {
          legend: {
            display: false
          },
          tooltip: {
            enabled: false
          }
        }
      }
    });
  </script>  
   
@endsection