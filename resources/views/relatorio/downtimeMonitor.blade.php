@extends('relatorio.index')
@section('title', 'ReadabilityTest')
    
@section('content')

  <h3 class="page-title pb-1 mb-3 border-bottom">Downtime Monitor</h3>

  <div class="input-group mb-3">
    
    <form action="/downtimemonitor" method="POST" style="display: flex; width:100%;">
      @csrf
    <input type="text" class="form-control" placeholder="Enter website to monitor" name="url" />
    {{-- <input type="text" class="form-control" placeholder="Keywords (separated by comma)" /> --}}
    <button class="btn btn-primary" style="margin-left: 10px;">Monitor</button>
    </form>
  </div>

  <h5 class="ribbon">Settings</h5>
  <table class="table table-borderless w-auto mb-0">
    <tr>
      <th>Send alerts to</th>
      <td>tiagoassuncao@keystroke.ca</td>
    </tr>
  </table>

  <h5 class="ribbon mt-5">Monitored websites</h5>
  <table class="table w-100 mb-5">
    <thead>
      <tr>
        <th>Website</th>
        <th>Status</th>
        <th class="text-center">Last 24h</th>
        <th width="50"></th>
      </tr>
    </thead>
    <tbody>
      @foreach ($list as $item)
      <tr>
        <td>{{$item['url']}}</td>
        <td>{{$item['status']}}</td>
        @if ($item['status'] != 'Online')
        <td class="text-center"><i class="fas fa-exclamation-circle" title="Website unavailable in the past 24 hours."></i></td>
        @else
        <td class="text-center"><i class="fas fa-check"></i></td>
        @endif
        <td class="p-0 align-middle text-nowrap">
          <div class="btn-group">
            <a href="{{url('/downtimemonitor')}}/{{$item['id']}}" title="View report" class="btn btn-secondary btn-sm px-1"><i class="fas fa-fw fa-chart-bar"></i></a>
            <a href="{{url('/downtimemonitordel')}}/{{$item['id']}}" title="Remove" class="btn btn-secondary btn-sm px-1"><i class="fas fa-fw fa-trash"></i></a>
          </div>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>

  {{-- <h5 class="ribbon">Recent incidents</h5>
  <table class="table w-100">
    <thead>
      <tr>
        <th>Time</th>
        <th>Website</th>
        <th>Downtime</th>
      </tr>
    </thead>
    <tbody>
      <tr>
        <td>Jul 3, 2020 10:38</td>
        <td>https://www.keystroke.ca/</td>
        <td>1m 30s</td>
      </tr>
      <tr>
        <td>Jul 3, 2020 10:38</td>
        <td>https://www.keystroke.ca/</td>
        <td>30d 3h 20m 33s</td>
      </tr>
    </tbody>
  </table> --}}
   
@endsection