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
<h3 class="page-title pb-1 mb-3 border-bottom">Downtime Monitor</h3>

<h5 class="ribbon">Incidents in the past week</h5>
<table class="table w-100 mb-5 downtime-calendar">
  <thead>
    <tr>
      <th></th>
      <?php for ($i = 0; $i <= 31; $i++) : ?>
        <th><?=$i?></th>
      <?php endfor; ?>
    </tr>
  </thead>
  <tbody>
    <?php for ($i = time(); $i > time() - 24 * 7 * 3600; $i -= 24 * 3600) : ?>
      <tr>
        <th class="<?=date('N', $i) >= 6 ? 'text-primary' : ''?>"><?=date('j', $i)?></th>
        <?php for ($j = 0; $j <= 31; $j++) {
            $has = false;
            foreach ($downtimemonitor as $item) {
              if (date('Y-m-d H',strtotime(date('Y-m-d', $i)) + $j * 3600) == date('Y-m-d H', strtotime($item->dataEvent))) {
                $has = true;
              }
            }
            if($has){
              echo '<td><a href="#" class="down"></a></td>';
            }else{
              echo '<td></td>';

            }
        }
        
        ?>
      </tr>
    <?php endfor; ?>
  </tbody>
</table>

<h5 class="ribbon mt-5">Recent incidents</h5>
<table class="table w-100">
  <thead>
    <tr>
      <th>Time</th>
      <th>Website</th>
      <th>Status</th>
    </tr>
  </thead>
  <tbody>
    @foreach ($downtimemonitor as $item)
      <tr>
        <td>{{date("F d, Y H:i:s", strtotime($item->dataEvent))}}</td>
        <td>{{$downtime['url']}}</td>
        <td>Offline</td>
      </tr>
    @endforeach
    
  </tbody>
</table>
   
@endsection