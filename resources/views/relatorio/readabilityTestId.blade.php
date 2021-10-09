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
  <h3 class="page-title pb-1 mb-3 border-bottom">READABILITY TEST {{$readability['url']}}</h3>
  <div class="input-group mb-3">
    {{-- <a href="{{url('page/image-result')}}" type="button" class="btn btn-primary">Reanalyze</a> --}}
    {{-- <button class="btn btn-primary dropdown-toggle dropdown-toggle-split" type="button" data-bs-toggle="dropdown"></button>
    <ul class="dropdown-menu">
      <li><a class="dropdown-item" href="{{url('page/image-result')}}">Scan single page</a></li>
      <li><a class="dropdown-item" href="{{url('page/image-result')}}">Scan sub-pages</a></li>
    </ul> --}}
  </div>
  @foreach ($readabilitysite as $item)
    <h5 class="ribbon">Page - {{$item['url']}}</h5>
    <div class="row" style="margin-bottom: 55px; display: flex; justify-content: space-around;">
      <div class="col-11 py-3" style="display: flex; justify-content: space-between; margin-left: 10px; margin-right: 10px;">
        <div style="position: relative; height: 100px; width: 100px; text-align: center;">
          <canvas id="ImageGraph-{{$item['id']}}-A" data-vl1="{{round($item['flesch_kincaid_readability_index'], 2)}}" data-vl2="{{70 - round($item['flesch_kincaid_readability_index'], 2)}}"></canvas>
          <div class="image-score">{{round($item['flesch_kincaid_readability_index'], 2)}}</div>
          <b>Flesch Kincaid Reading Ease</b>
        </div>
        <div style="position: relative; height: 100px; width: 100px; text-align: center;">
          <canvas id="ImageGraph-{{$item['id']}}-B" data-vl1="{{round($item['smog_readability_index'], 2)}}" data-vl2="{{50 - round($item['smog_readability_index'], 2)}}"></canvas>
          <div class="image-score">{{round($item['smog_readability_index'], 2)}}</div>
          <b>SMOG Index</b>
        </div>
        <div style="position: relative; height: 100px; width: 100px;text-align: center;">
          <canvas id="ImageGraph-{{$item['id']}}-C" data-vl1="{{round($item['coleman_liau_readability_index'], 2)}}" data-vl2="{{30 - round($item['coleman_liau_readability_index'], 2)}}"></canvas>
          <div class="image-score">{{round($item['coleman_liau_readability_index'], 2)}}</div>
          <b>Coleman Liau Index</b>
        </div>
        <div style="position: relative; height: 100px; width: 100px;text-align: center;">
          <canvas id="ImageGraph-{{$item['id']}}-D" data-vl1="{{round($item['automated_readability_index'], 2)}}" data-vl2="{{20 - round($item['automated_readability_index'], 2)}}"></canvas>
          <div class="image-score">{{round($item['automated_readability_index'], 2)}}</div>
          <b>Automated Readability Index</b>
        </div>
        <div style="position: relative; height: 100px; width: 100px; text-align: center;">
          <canvas id="ImageGraph-{{$item['id']}}-E" data-vl1="{{round($item['description_to_content_consistency'], 2)}}" data-vl2="{{1 - round($item['description_to_content_consistency'], 2)}}"></canvas>
          <div class="image-score">{{round($item['description_to_content_consistency'], 2)}}</div>
          <b>Description Content Consistency</b>
        </div>
        <div style="position: relative; height: 100px; width: 100px; text-align: center;">
          <canvas id="ImageGraph-{{$item['id']}}-F" data-vl1="{{$item['onpage_score']}}" data-vl2="{{100 - $item['onpage_score']}}"></canvas>
          <div class="image-score">{{$item['onpage_score']}}</div>
          <b>Page Score</b>
        </div>
      </div>
    </div>    
    <div class="row" style="margin-bottom: 55px;">
      <div class="col-4">
        <table class="table table-borderless w-auto mb-0">
          <tr>
            <th>Number of internal links</th>
            <td>{{$item['internal_links_count']}}</td>
          </tr>
          <tr>
            <th>Number of external links</th>
            <td>{{$item['external_links_count']}}</td>
          </tr>
          <tr>
            <th>Number of inbound links</th>
            <td>{{$item['inbound_links_count']}}</td>
          </tr>
        </table>
      </div>
      <div class="col-3">
        <table class="table table-borderless w-auto mb-0">
          <tr>
            <th>Image quantity</th>
            <td>{{$item['images_count']}}</td>
          </tr>
          <tr>
            <th>Plain text size</th>
            <td>{{$item['plain_text_size']}}</td>
          </tr>
          <tr>
            <th>Plain text word count</th>
            <td>{{$item['plain_text_word_count']}}</td>
          </tr>
        </table>
      </div>
    </div>
    
  @endforeach
  <script type="text/javascript" src="{{url('assets/js/chart.min.js')}}"></script>
  <script type="text/javascript">
    

    function createGraph(ctx, vl1, vl2){
      var myChart = new Chart(ctx, {
        type: 'doughnut',
        data: {
            labels: ['Compressed size', 'Potential optimizations'],
            datasets: [{
              data: [vl1, vl2],
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
    }
    <?php
    $js_array = json_encode($readabilitysite);
    echo "var javascript_array = ". $js_array . ";\n";
    ?>
    console.log(javascript_array.length);
    for(let q=0; q < 10; q++){
      var ctxA = document.getElementById(`ImageGraph-${javascript_array[q].id}-A`).getContext('2d');
      var elementA = document.getElementById(`ImageGraph-${javascript_array[q].id}-A`);
      var newGraphA = createGraph(ctxA, elementA.dataset.vl1, elementA.dataset.vl2);
      var ctxB = document.getElementById(`ImageGraph-${javascript_array[q].id}-B`).getContext('2d');
      var elementB = document.getElementById(`ImageGraph-${javascript_array[q].id}-B`);
      var newGraphB = createGraph(ctxB, elementB.dataset.vl1, elementB.dataset.vl2);
      var ctxC = document.getElementById(`ImageGraph-${javascript_array[q].id}-C`).getContext('2d');
      var elementC = document.getElementById(`ImageGraph-${javascript_array[q].id}-C`);
      var newGraphC = createGraph(ctxC, elementC.dataset.vl1, elementC.dataset.vl2);
      var ctxD = document.getElementById(`ImageGraph-${javascript_array[q].id}-D`).getContext('2d');
      var elementD = document.getElementById(`ImageGraph-${javascript_array[q].id}-D`);
      var newGraphD = createGraph(ctxD, elementD.dataset.vl1, elementD.dataset.vl2);
      var ctxE = document.getElementById(`ImageGraph-${javascript_array[q].id}-E`).getContext('2d');
      var elementE = document.getElementById(`ImageGraph-${javascript_array[q].id}-E`);
      var newGraphE = createGraph(ctxE, elementE.dataset.vl1, elementE.dataset.vl2);
      var ctxF = document.getElementById(`ImageGraph-${javascript_array[q].id}-F`).getContext('2d');
      var elementF = document.getElementById(`ImageGraph-${javascript_array[q].id}-F`);
      var newGraphF = createGraph(ctxF, elementF.dataset.vl1, elementF.dataset.vl2);
    }

  </script>  
   
@endsection