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
<h3 class="page-title pb-1 mb-3 border-bottom">Keyword Rank Checker</h3>
<h5 class="ribbon">Search result rank</h5>
<div class="row">
  <div class="col-12">
    <table class="table table-borderless w-auto mb-0">
      <tr>
        <th>Updated</th>
        <td>{{date("F d, Y H:i", strtotime($keywordrank->updated))}}</td>
      </tr>
      <tr>
        <th>Domain</th>
        <td>{{$keywordrank->domain}}</td>
      </tr>
      <tr>
        <th>Rank</th>
        <td>{{$keywordrank->rank}}</td>
      </tr>
      <tr>
        <th>Region</th>
        <td>{{$keywordrank->region}}</td>
      </tr>
      <tr>
        <th>Search result</th>
        <td>
          <a href="{{$keywordrank->check_url}}">{{$keywordrank->check_url}}</a>
        </td>
      </tr>
    </table>
  </div>
  
</div>

<h5 class="ribbon mt-5">Top ranking pages</h5>
<table class="table">
  <thead>
    <tr>
      <th>Rank</th>
      <th>Page</th>
      <th title="Number of domains linking to this page">Domains</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($keywordranksite as $item)
    <tr>
      <td>{{$item->rank_group}}</td>
      <td>	
        {{$item->title}}
        <br /><a href="{{$item->url}}">{{$item->url}}</a>
      </td>
      <td>{{$item->domain}}</td>
    </tr>
    @endforeach
  </tbody>
</table>
   
 
   
@endsection