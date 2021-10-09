@extends('relatorio.index')
@section('title', 'Broken Link Checker')
    
@section('content')
@if (session('error'))
@component('components.danger')
    {{session('error')}}
@endcomponent
@endif
<h3 class="page-title pb-1 mb-3 border-bottom">Keyword Density Analysis</h3>

        <div class="input-group mb-3">
          <form action="/backlinkanalysis" method="POST" style="display: flex; width:100%;">
            @csrf
          <input type="text" name="url" class="form-control" placeholder="Enter URL to analyze" />
          <input type="text" name="keywords" class="form-control" placeholder="Keywords (separated by comma)" />
          <button class="btn btn-primary" style="margin-left: 10px;">Analyze</button>
        </form>
        </div>

        <h5 class="ribbon">Recent analyses</h5>
        <table class="table">
          <thead>
            <tr>
              <th>Time</th>
              <th>URL</th>
              <th>Keywords</th>
              <th>Density</th>
              <th>Word count</th>
              <th width="20"></th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Jul 3, 2020 10:38</td>
              <td><i class="fas fa-fw fa-sitemap me-1" title="URL path including sub-pages"></i>https://www.keystroke.ca/en/</td>
              <td>act,crm</td>
              <td>24 (0.1%)</td>
              <td>25253143</td>
              <td class="p-0 align-middle text-nowrap">
                <a href="" title="View report" class="btn btn-secondary btn-sm px-1"><i class="fas fa-fw fa-chart-bar"></i></a>
              </td>
            </tr>
            <tr>
              <td>Jul 3, 2020 10:38</td>
              <td><i class="fas fa-fw fa-file me-1" title="Exact URL"></i>https://www.keystroke.ca/en/about/about-us.html</td>
              <td>crm</td>
              <td>10 (0.04%)</td>
              <td>22922</td>
              <td class="p-0 align-middle text-nowrap">
                <a href="" title="View report" class="btn btn-secondary btn-sm px-1"><i class="fas fa-fw fa-chart-bar"></i></a>
              </td>
            </tr>
            <tr>
              <td>Jul 3, 2020 10:38</td>
              <td><i class="fas fa-fw fa-globe me-1" title="Entire website"></i>https://www.keystroke.ca</td>
              <td>crm</td>
              <td>24 (0.1%)</td>
              <td>51368925253</td>
              <td class="p-0 align-middle text-nowrap">
                <a href="" title="View report" class="btn btn-secondary btn-sm px-1"><i class="fas fa-fw fa-chart-bar"></i></a>
              </td>
            </tr>
          </tbody>
        </table>
   
@endsection