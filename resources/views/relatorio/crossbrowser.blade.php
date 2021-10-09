@extends('relatorio.index')
@section('title', 'CrossBrowser')
    
@section('content')
<script src="https://api.browserling.com/v1/browserling.js"></script>

<script>
var browserling = new Browserling(token);
browserling.setBrowser('ie');
browserling.setVersion('9');
browserling.setUrl('http://www.catonmat.net');

var div = document.querySelector('#browserling');
div.appendChild(browserling.iframe());
</script>
   
@endsection