@extends('relatorio.index')
@section('title', 'Broken Link Checker')
    
@section('content')
@if (session('error'))
@component('components.danger')
    {{session('error')}}
@endcomponent
@endif

<h3 class="page-title pb-1 mb-3 border-bottom">CSS Validation</h3>

<div class="input-group mb-3">
  <a target="_blank" href="{{$cssvalidation['cssvalidationpadrao']['urlCompleto']}}" type="button" class="btn btn-primary">full report</a>
</div>
        @foreach ($cssvalidation['cssvalidationsites'] as $item)
        <h5 style="box-shadow: 0 1px 0 #e01010; important!" class="ribbon">{{$item['primario']['nome']}}</h5>
        @foreach ($item['secundario'] as $item2)
        <table class="table">
          <thead>
            <tr>
              <th>URL</th>
            </tr>
          </thead>
          <tbody>
            <tr>
              <th>{{$item2['primario']['url']}}</th>  
            </tr>
          </tbody>
        </table>
        <table class="table">
          <thead>
            <tr>
              <th>line</th>
              <th>code</th>
              <th>status</th>
            </tr>
          </thead>
          <tbody>
            @foreach ($item2['secundario'] as $item3)
            <tr>
              <td>
                {{$item3['line']}}
              </td>
              <td>{{$item3['code']}}</td>
              <td>{{$item3['status']}}</td>
            </tr>
            @endforeach
            
            
          </tbody>
        </table>
        @endforeach
        
        @endforeach
        
@endsection