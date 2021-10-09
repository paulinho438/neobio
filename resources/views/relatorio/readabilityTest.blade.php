@extends('relatorio.index')
@section('title', 'ReadabilityTest')
    
@section('content')

      <h3 class="page-title pb-1 mb-3 border-bottom">Readability Test</h3>

      <div class="input-group mb-3">
        <form action="/readabilitytest" method="POST" style="display: flex; width:100%;">
          @csrf
        <input type="text" class="form-control" placeholder="Enter URL to analyze" name="url" />
        {{-- <input type="text" class="form-control" placeholder="Keywords (separated by comma)" /> --}}
        <button class="btn btn-primary" style="margin-left: 10px;">Analyze</button>
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
            <th>DATE</th>
            <th>URL</th>
            <th>QT PAGES</th>
            <th>TOTAL ITEMS COUNT</th>
            <th width="20"></th>
          </tr>
        </thead>
        <tbody>
          @foreach ($list as $item)
            <tr>
              <td>{{date("F d, Y H:i", strtotime($item->dateCreate))}}</td>
              <td><i class="fas fa-fw fa-sitemap me-1" title="URL path including sub-pages"></i>{{$item->url}}</td>
              <td>{{$item->qtPag}}</td>
              <td>{{$item->totalItemsCount}}</td>
              <td class="p-0 align-middle text-nowrap">
                <a href="{{url('/readabilitytest')}}/{{$item->id}}" title="View report" class="btn btn-secondary btn-sm px-1"><i class="fas fa-fw fa-chart-bar"></i></a>
              </td>
            </tr>
          @endforeach
        </tbody>
      </table>
   
@endsection