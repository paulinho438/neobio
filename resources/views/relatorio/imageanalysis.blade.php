@extends('relatorio.index')
@section('title', 'Broken Link Checker')
    
@section('content')
@if (session('error'))
@component('components.danger')
    {{session('error')}}
@endcomponent
@endif
<h3 class="page-title pb-1 mb-3 border-bottom">Image Analysis</h3>

        <div class="input-group mb-3">
          <form action="/imageanalysis" method="POST" style="display: flex; width:100%;">
            @csrf
          <input type="text" class="form-control" placeholder="Enter URL to analyze" name="url" />
          {{-- <input type="text" class="form-control" placeholder="Keywords (separated by comma)" /> --}}
          <button class="btn btn-primary" id="buttonimageanalysis" style="margin-left: 10px; weight: auto">Analyze</button>
          </form>
          {{-- <button class="btn btn-primary dropdown-toggle dropdown-toggle-split" type="button" data-bs-toggle="dropdown"></button> --}}
          {{-- <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="">
              Analyze URL
              <div class="small text-secondary">Exact URL only</div>
            </a></li>
            <li><a class="dropdown-item" href="">
              Analyze Path
              <div class="small text-secondary">Specified URL and its sub-pages</div>
            </a></li>
            <li><a class="dropdown-item" href="">
              Analyze Domain
              <div class="small text-secondary">All pages under specified domain</div>
            </a></li>
          </ul> --}}
        </div>

        <h5 class="ribbon">Recent analyses</h5>
        <table class="table">
          <thead>
            <tr>
              <th>Time</th>
              <th>URL</th>
              <th>Size</th>
              <th>Score</th>
              <th width="20"></th>
            </tr>
          </thead>
          <tbody>
            @foreach ($imageanalysis as $item)
            <tr>
              <td>{{date("F d, Y H:i", strtotime($item->dateCreate))}}</td>
              <td><i class="fas fa-fw fa-file me-1" title="Exact URL"></i>{{$item->url}}</td>
              <td>{{$item->size}}</td>
              <td><b>{{$item->score}}</b></td>
              <td class="p-0 align-middle text-nowrap">
                <a href="{{url('/imageanalysis')}}/{{$item->id}}" title="View report" class="btn btn-secondary btn-sm px-1"><i class="fas fa-fw fa-chart-bar"></i></a>
              </td>
            </tr>
            @endforeach
          </tbody>
        </table>
        <script type="text/javascript" src="{{url('assets/js/jquery.js')}}"></script>

        <script type="text/javascript">
          
          $( document ).ready(function() {
            var count = 0;
                $('#buttonimageanalysis').bind('click', function(e){
                  setTimeout(temporizador,1000);
                });
                var contador = 0;
                function temporizador() {
                  if(contador < 4){
                    $('#buttonimageanalysis').html('Loading');
                    setTimeout(temporizador,1000);
                  } else if(contador < 10) {
                    setTimeout(temporizador,1000);
                    $('#buttonimageanalysis').html('Analyzing URL');
                  } else if(contador < 24) {
                    setTimeout(temporizador,1000);
                    $('#buttonimageanalysis').html('Evaluating optimization');
                  }else if(contador < 38) {
                    setTimeout(temporizador,1000);
                    $('#buttonimageanalysis').html('Analyzing images');
                  }else if(contador < 56) {
                    setTimeout(temporizador,1000);
                    $('#buttonimageanalysis').html('Optimizing images');
                  }
                  contador++;
                }

          });
          
        </script>  
   
@endsection