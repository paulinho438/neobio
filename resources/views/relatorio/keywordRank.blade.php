@extends('relatorio.index')
@section('title', 'ReadabilityTest')
    
@section('content')
<style>
  .downtime-calendar {
    table-layout: fixed;
  }
  .downtime-calendar td {
    padding: 0;
  }
  .downtime-calendar th {
    text-align: center;
  }
  .downtime-calendar tbody th {
    padding: 0;
    line-height: 20px;
  }
  .downtime-calendar .down {
    background: #f36221;
    display: block;
    width: 100%;
    height: 20px;
  }
  .downtime-calendar .disabled {
    background: #eee;
  }
</style>
<h3 class="page-title pb-1 mb-3 border-bottom">Keyword Rank Checker</h3>

        <div class="input-group mb-3">
          <form action="/keywordrank" method="POST" style="display: flex; width:100%;">
            @csrf
          <input type="text" name="url" class="form-control" placeholder="Enter domain" />
          <input type="text" class="form-control" name="keyword" placeholder="Enter keyword" />
          <select class="form-control" name="country">
            <option value="">Select a country</option>
            <option value="us">United States</option>
            @foreach ($country as $item)
            <option value="us">{{$item['location_name']}}</option>
                
            @endforeach
          </select>
          <button class="btn btn-primary" style="margin-left: 10px;">Analyze</button>
          </form>
          </ul>
        </div>

        <h5 class="ribbon">Monitored keywords</h5>
        <table class="table">
          <thead>
            <tr>
              <th>Domain</th>
              <th>Keyword</th>
              <th>Rank</th>
              <th>Region</th>
              <th>Updated</th>
              <th width="50"></th>
            </tr>
          </thead>
          <tbody>
            @foreach ($list as $item)
              <tr>
                <td>{{$item->domain}}</td>
                <td>{{$item->keyword}}</td>
                <td>{{$item->rank}}</td>
                {{-- <td>{{$item->rank}} <i class="fas fa-caret-up" title="Rank raised since your last check"></i></td> --}}
                <td>{{$item->region}}</td>
                <td>{{date("F d, Y H:i", strtotime($item->updated))}}</td>
                <td class="p-0 align-middle text-nowrap">
                  <div class="btn-group">
                    <a href="{{url('/keywordrank')}}/{{$item->id}}" title="View report" class="btn btn-secondary btn-sm px-1"><i class="fas fa-fw fa-chart-bar"></i></a>
                    {{-- <a href="#" title="Remove" class="btn btn-secondary btn-sm px-1"><i class="fas fa-fw fa-trash"></i></a> --}}
                  </div>
                </td>
              </tr>
            @endforeach
          </tbody>
        </table>

        {{-- <h5 class="ribbon mt-5">Recent analyses</h5>
        <table class="table">
          <thead>
            <tr>
              <th>Time</th>
              <th>Domain</th>
              <th>Keyword</th>
              <th>Rank</th>
              <th>Region</th>
              <th width="20"></th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <td>Jul 3, 2020 10:38</td>
              <td>keystroke.ca</td>
              <td>act crm</td>
              <td>13</td>
              <td>Canada</td>
              <td class="p-0 align-middle text-nowrap">
                <a href="" title="View report" class="btn btn-secondary btn-sm px-1"><i class="fas fa-fw fa-chart-bar"></i></a>
              </td>
            </tr>
            <tr>
              <td>Jul 3, 2020 10:38</td>
              <td>keystroke.ca</td>
              <td>crm</td>
              <td>-</td>
              <td>United States</td>
              <td class="p-0 align-middle text-nowrap">
                <a href="" title="View report" class="btn btn-secondary btn-sm px-1"><i class="fas fa-fw fa-chart-bar"></i></a>
              </td>
            </tr>
            <tr>
              <td>Jul 3, 2020 10:38</td>
              <td>handheldcontact.com</td>
              <td>handheld contact</td>
              <td>1</td>
              <td>Canada</td>
              <td class="p-0 align-middle text-nowrap">
                <a href="" title="View report" class="btn btn-secondary btn-sm px-1"><i class="fas fa-fw fa-chart-bar"></i></a>
              </td>
            </tr>
          </tbody>
        </table> --}}
   
@endsection