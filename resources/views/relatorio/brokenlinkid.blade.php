@extends('relatorio.index')
@section('title', 'ReadabilityTest')
    
@section('content')

<h3 class="page-title pb-1 mb-3 border-bottom">Broken Link Checker</h3>

        <h5 class="ribbon">Statistics</h5>
        <table class="table table-borderless w-auto mb-0">
          <tr>
            <th>Pages scanned</th>
            <td>{{$brokenlink->qtPag}}</td>
          </tr>
          <tr>
            <th>Links checked</th>
            <td>{{$brokenlink->qtItems}}</td>
          </tr>
          <tr>
            <th>Broken links found</th>
            <td>{{$brokenlink->qtBroken}}</td>
          </tr>
        </table>

        <h5 class="ribbon mt-5">Broken links</h5>
        <table class="table">
          <thead>
            <tr>
              <th title="Link text on the page where the broken link was found.">Broken domain From</th>
              <th title="Broken link URL">Domain To</th>
              <th title="Line in HTML code where the broken link was found.">Broken link From</th>
              <th title="Page where the broken link was found">link To</th>
            </tr>
          </thead>
          <tbody>
              @foreach ($brokenlinksites as $item)
              <tr>
                <td>{{$item['domain_from']}}</td>
                <td>{{$item['domain_to']}}</td>

                <td><a href="{{$item['link_from']}}" target="_blank">{{$item['link_from']}}</a></td>
                <td><a href="{{$item['link_to']}}" target="_blank">{{$item['link_to']}}</a></td>

              </tr>
              @endforeach
             
            
          </tbody>
        </table>
   
@endsection