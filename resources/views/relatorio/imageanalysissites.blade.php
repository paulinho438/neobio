@extends('relatorio.index')
@section('title', 'Broken Link Checker')
    
@section('content')
@if (session('error'))
@component('components.danger')
    {{session('error')}}
@endcomponent
@endif
<style>
  .image-score {
    position: absolute;
    top: 50%;
    left: 50%;
    width: 40px;
    height: 40px;
    margin: -20px;
    color: #6c757d;
    font-size: 32px;
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
<h3 class="page-title pb-1 mb-3 border-bottom">Image Analysis</h3>

        

        <h5 class="ribbon">Statistics</h5>
        <div class="row">
          <div class="col-6">
            <table class="table table-borderless w-auto mb-0">
              <tr>
                <th>Images analyzed</th>
                <td>{{$ImageAnalysis['total_images_analyzed']}}</td>
              </tr>
              <tr>
                <th>Total image size</th>
                <td>{{$ImageAnalysis['total_image_weight']}}</td>
              </tr>
              <tr>
                <th>Potential optimized size</th>
                <td>{{$ImageAnalysis['potential_compressed_weight']}}</td>
              </tr>
            </table>
          </div>
          <div class="col-6 py-3">
            <div style="position: relative; height: 100px; width: 100px; margin-left: auto;">
              <canvas id="ImageGraph"></canvas>
              <div class="image-score">{{$ImageAnalysis['score']}}</div>
            </div>
          </div>
        </div>

        <h5 class="ribbon mt-3">Optimizations</h5>
        {{-- <div class="alert alert-secondary">
          <a href="#">Configure FTP account</a> to enable 1-click optimization.
        </div> --}}
        <table class="table">
          <thead>
            <tr>
              <th width="100">Image</th>
              <th>Details</th>
              <th>Resolution</th>
              <th>Optimizations</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($ImageAnalysissites as $item)
            <tr>
              <td>
                <img src="{{$item['url_image']}}" class="w-100" />
              </td>
              <td>
                {{$item['name_image']}}<br />
                {{$item['extension']}} - {{$item['size']}}<br />
              </td>
              <td>
                <div title="Actual image resolution"><i class="fas fa-fw fa-image"></i> {{substr($item['final_pixel'], (strlen($item['final_pixel']) / 2))}}</div>
                <div title="Rendered resolution"><i class="fas fa-fw fa-desktop"></i> {{substr($item['final_pixel'], (strlen($item['final_pixel']) / 2), strlen($item['final_pixel']))}}</div>
              </td>
              <td class="image-optimization py-0">
                <div class="d-flex align-items-center">
                  <div class="flex-grow-1 py-2">
                    {{$item['porcentage']}}
                  </div>
                  <div class="">
                    <a href="{{$item['url_download']}}" class="btn btn-secondary btn-sm">Download</a>
                  </div>
                </div>

                
              </td>
            </tr>
                
            @endforeach
            
           
          </tbody>
        </table>
        <script type="text/javascript" src="{{url('assets/js/chart.min.js')}}"></script>
  <script type="text/javascript">
    var ctx = document.getElementById('ImageGraph').getContext('2d');
    var myChart = new Chart(ctx, {
      type: 'doughnut',
      data: {
          labels: ['Compressed size', 'Potential optimizations'],
          datasets: [{
            data: [133, 51],
            backgroundColor: [
              '#6c757d',
              '#f36221'
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