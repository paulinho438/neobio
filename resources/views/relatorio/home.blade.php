@extends('relatorio.index')
@section('title', 'Seotools')
    
@section('content')
<input type="text" class="form-control" placeholder="Enter URL to analyze" />

<h3 class="mt-3">Keystroke.ca</h3>

<div class="row my-3">
  <div class="col-6">
    <canvas id="KeywordGraph"></canvas>
  </div>
  <div class="col-6">
    <canvas id="RankGraph"></canvas>
  </div>
</div>

<div class="mt-3">
  <h3>External Tools</h3>
  <p>Click to analyze the above URL with the following tools</p>
  <a class="btn btn-primary" href="https://search.google.com/test/rich-results?url=https%3A%2F%2Fwww.keystroke.ca%2Fen%2F&user_agent=1">Rich Results Test (Google)</a>
  <a class="btn btn-primary" href="https://developers.google.com/speed/pagespeed/insights/?url=http%3A%2F%2Fkeystroke.ca%2F">Page Speed Insight (Google)</a>
  <a class="btn btn-primary" href="https://search.google.com/test/mobile-friendly?utm_source=mft&utm_medium=redirect&utm_campaign=mft-redirect&url=http%3A%2F%2Fkeystroke.ca%2F">Mobile Friendly Test (Google)</a>
</div>
@endsection