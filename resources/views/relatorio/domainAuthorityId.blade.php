@extends('relatorio.index')
@section('title', 'ReadabilityTest')
    
@section('content')
<style>
  .image-score {
    position: absolute;
    top: 50%;
    left: 50%;
    width: 40px;
    height: 40px;
    margin: -20px;
    color: #6c757d;
    font-size: 18px;
    font-weight: bold;
    line-height: 40px;
    text-align: center;
  }

  .image-optimization .format {
    display: inline-block;
    width: 50px;
    margin-right: 0.1rem;
    border-right: 1px solid #ddd;
    text-transform: uppercase;
  }
</style>
  <h3 class="page-title pb-1 mb-3 border-bottom">DOMAIN AUTHORITY {{$domainauthority['url']}}</h3>
  <div class="input-group mb-3">
    {{-- <a href="{{url('page/image-result')}}" type="button" class="btn btn-primary">Reanalyze</a> --}}
    {{-- <button class="btn btn-primary dropdown-toggle dropdown-toggle-split" type="button" data-bs-toggle="dropdown"></button>
    <ul class="dropdown-menu">
      <li><a class="dropdown-item" href="{{url('page/image-result')}}">Scan single page</a></li>
      <li><a class="dropdown-item" href="{{url('page/image-result')}}">Scan sub-pages</a></li>
    </ul> --}}
  </div>
  
    <h5 class="ribbon">Page - {{$domainauthority['url']}}</h5>
    <div class="row" style="margin-bottom: 55px; display: flex; justify-content: space-around;">
      <div class="col-11 py-3" style="display: flex; justify-content: flex-start; margin-left: 10px; margin-right: 10px;">
        <div style="position: relative; height: 100px; width: 100px; text-align: center; margin-left: 20px; margin-right: 20px;">
          <canvas id="ImageGraph-01-A" data-vl1="{{$domainauthority['domain_authority']}}" data-vl2="{{100 - $domainauthority['domain_authority']}}"></canvas>
          <div class="image-score">{{$domainauthority['domain_authority']}}</div>
          <b>Domain Authority</b>
        </div>
        <div style="position: relative; height: 100px; width: 100px; text-align: center; margin-left: 20px; margin-right: 20px;">
          <canvas id="ImageGraph-01-B" data-vl1="{{$domainauthority['page_authority']}}" data-vl2="{{100 - $domainauthority['page_authority']}}"></canvas>
          <div class="image-score">{{$domainauthority['page_authority']}}</div>
          <b>Page Authority</b>
        </div>
        <div style="position: relative; height: 100px; width: 100px; text-align: center; margin-left: 20px; margin-right: 20px;">
          <canvas id="ImageGraph-01-C" data-vl1="{{round($domainauthority['link_propensity'], 4)}}" data-vl2="{{1 - round($domainauthority['link_propensity'], 4)}}"></canvas>
          <div class="image-score" style="left: 44%">{{round($domainauthority['link_propensity'], 4)}}</div>
          <b>Link Propensity</b>
        </div>
        <div style="position: relative; height: 100px; width: 100px; text-align: center; margin-left: 20px; margin-right: 20px;">
          <canvas id="ImageGraph-01-D" data-vl1="{{$domainauthority['spam_score']}}" data-vl2="{{1 - $domainauthority['spam_score']}}"></canvas>
          <div class="image-score">{{$domainauthority['spam_score']}}</div>
          <b>Spam Score</b>
        </div>
      </div>
    </div>    
    <div class="row" style="margin-bottom: 55px;">
      <div class="col-12">
        <table class="table table-borderless w-auto mb-0">
          <tr>
            <th>The number of unique pages currently linking to this page.</th>
            <td>{{$domainauthority['pages_to_page']}}</td>
          </tr>
        </tr>
      </table>
    </div>
    <div class="row" style="margin-bottom: 55px;">
      <div class="col-12">
        <table class="table table-borderless w-auto mb-0">
          <tr>
            <th>The number of unique pages currently linking to this page with only nofollow links.</th>
            <td>{{$domainauthority['nofollow_pages_to_page']}}</td>
          </tr>
        </tr>
      </table>
    </div>
    <div class="row" style="margin-bottom: 55px;">
      <div class="col-12">
        <table class="table table-borderless w-auto mb-0">
          <tr>
            <th>The number of unique pages currently redirecting to this page.</th>
            <td>{{$domainauthority['redirect_pages_to_page']}}</td>
          </tr>
        </tr>
      </table>
    </div>
    <div class="row" style="margin-bottom: 55px;">
      <div class="col-12">
        <table class="table table-borderless w-auto mb-0">
          <tr>
            <th>The number of unique pages from a different root domain currently linking to this page.</th>
            <td>{{$domainauthority['external_pages_to_page']}}</td>
          </tr>
        </tr>
      </table>
    </div>
    <div class="row" style="margin-bottom: 55px;">
      <div class="col-12">
        <table class="table table-borderless w-auto mb-0">
          <tr>
            <th>The number of unique pages from a different root domain currently redirecting to this page.</th>
            <td>{{$domainauthority['external_redirect_pages_to_page']}}</td>
          </tr>
        </tr>
      </table>
    </div>
    <div class="row" style="margin-bottom: 55px;">
      <div class="col-12">
        <table class="table table-borderless w-auto mb-0">
          <tr>
            <th>The number of unique pages that used to link to this page, but no longer do.</th>
            <td>{{$domainauthority['deleted_pages_to_page']}}</td>
          </tr>
        </tr>
      </table>
    </div>



          
       
    
  <script type="text/javascript" src="{{url('assets/js/chart.min.js')}}"></script>
  <script type="text/javascript">
    

    function createGraph(ctx, vl1, vl2){
      
    }
    
    var ctxA = document.getElementById(`ImageGraph-01-A`).getContext('2d');
    var elementA = document.getElementById(`ImageGraph-01-A`);
    var myChart = new Chart(ctxA, {
        type: 'doughnut',
        data: {
            labels: ['Compressed size', 'Potential optimizations'],
            datasets: [{
              data: [elementA.dataset.vl1, elementA.dataset.vl2],
              backgroundColor: [
                '#f36221',
                '#6c757d'

              ]
            }]
        },
        options: {
          cutout: '75%',
          maintainAspectRatio: false,
          plugins: {
            legend: {
              display: false
            }
          }
        }
      });

      var ctxB = document.getElementById(`ImageGraph-01-B`).getContext('2d');
      var elementB = document.getElementById(`ImageGraph-01-B`);
      var myChartB = new Chart(ctxB, {
          type: 'doughnut',
          data: {
              labels: ['Compressed size', 'Potential optimizations'],
              datasets: [{
                data: [elementB.dataset.vl1, elementB.dataset.vl2],
                backgroundColor: [
                  '#f36221',
                  '#6c757d'

                ]
              }]
          },
          options: {
            cutout: '75%',
            maintainAspectRatio: false,
            plugins: {
              legend: {
                display: false
              }
            }
          }
        });

        var ctxC = document.getElementById(`ImageGraph-01-C`).getContext('2d');
        var elementC = document.getElementById(`ImageGraph-01-C`);
        var myChartC = new Chart(ctxC, {
            type: 'doughnut',
            data: {
                labels: ['Compressed size', 'Potential optimizations'],
                datasets: [{
                  data: [elementC.dataset.vl1, elementC.dataset.vl2],
                  backgroundColor: [
                    '#f36221',
                    '#6c757d'

                  ]
                }]
            },
            options: {
              cutout: '75%',
              maintainAspectRatio: false,
              plugins: {
                legend: {
                  display: false
                }
              }
            }
          });

          var ctxD = document.getElementById(`ImageGraph-01-D`).getContext('2d');
          var elementD = document.getElementById(`ImageGraph-01-D`);
          var myChartD = new Chart(ctxD, {
              type: 'doughnut',
              data: {
                  labels: ['Compressed size', 'Potential optimizations'],
                  datasets: [{
                    data: [elementD.dataset.vl1, elementD.dataset.vl2],
                    backgroundColor: [
                      '#f36221',
                      '#6c757d'

                    ]
                  }]
              },
              options: {
                cutout: '75%',
                maintainAspectRatio: false,
                plugins: {
                  legend: {
                    display: false
                  }
                }
              }
            });

  </script>  
   
@endsection