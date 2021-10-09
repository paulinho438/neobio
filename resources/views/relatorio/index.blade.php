<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Strict//EN"
  "http://www.w3.org/TR/xhtml1/DTD/xhtml1-strict.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="fr" lang="fr">

<head>
  <?php $page_title = "Dashboard"; $page_current = 'dashboard'; ?>
  <meta http-equiv="content-type" content="text/html;charset=utf-8" />
<meta name="viewport" content="width=device-width, initial-scale=1" />
<link type="text/css" rel="stylesheet" href="{{url('assets/css/fontawesome.min.css')}}" />
<link type="text/css" rel="stylesheet" href="{{url('assets/css/solid.min.css')}}" />
<link type="text/css" rel="stylesheet" href="{{url('assets/css/bootstrap.min.css')}}" />
<link type="text/css" rel="stylesheet" href="{{url('assets/css/main.css')}}" />
<link type="image/png" rel="shortcut icon" href="{{url('assets/img/favicon.png')}}" />
<script type="text/javascript" defer src="{{url('assets/js/bootstrap.bundle.min.js')}}"></script>
<title>@yield('title')</title>
  <style>
  </style>
</head>

<body>
  <nav id="Header" class="navbar navbar-expand-lg navbar-dark">
    <div class="container">
      <a class="navbar-brand py-0" href="{{url('/')}}"><img src="{{url('assets/img/header-logo.png')}}" width="30" height="30" /></a>
      <ul class="navbar-nav flex-grow-1">
        <li class="nav-item"><a href="#" class="nav-link">Dashboard</a></li>
        <li class="nav-item"><a href="#" class="nav-link">Domains</a></li>
      </ul>
      <ul class="navbar-nav">
        <li class="nav-item"><a href="#" class="nav-link">Settings</a></li>
        <li class="nav-item"><a href="{{url('/logout')}}" class="nav-link">Logout</a></li>
      </ul>
    </div>
  </nav>

  <div id="Body" class="container py-3">
    <div class="row">
      <div class="col-4">
        <div id="DomainSwitcher" class="dropdown mb-3">
          <button class="btn btn-secondary dropdown-toggle w-100" type="button" data-bs-toggle="dropdown">Select a domain</button>
          <ul class="dropdown-menu">
            <li><a class="dropdown-item" href="#">keystroke.ca</a></li>
            <li><a class="dropdown-item" href="#">www.handheldcontact.com</a></li>
            <li><hr class="dropdown-divider" /></li>
            <li><a class="dropdown-item" href="#">Manage domains</a></li>
          </ul>
        </div>
        <ul id="SeoMenu">
          <li>
            <a href="{{url('')}}" class="<?=$title == 'dashboard' ? 'current' : ''?>">
              <div class="img"><img src="{{url('assets/img/menu-dashboard.svg')}}" /></div>
              Dashboard
            </a>
          </li>
          <li>
            <a href="" class="<?=$title == 'keyworddensity' ? 'current' : ''?> disabled">
              <div class="img"><img src="{{url('assets/img/menu-keyword-density.svg')}}" /></div>
              Keyword Density
            </a>
          </li>
          <li>
            <a href="{{url('/readabilitytest')}}" class="<?=$title == 'ReadabilityTest' ? 'current' : ''?>">
              <div class="img"><img src="{{url('assets/img/menu-readability.svg')}}" /></div>
              Readability Test
            </a>
          </li>
          <li>
            <a href="{{url('/domainauthority')}}" class="<?=$page_current == 'DomainAuthority' ? 'current' : ''?>">
              <div class="img"><img src="{{url('assets/img/menu-domain.svg')}}" /></div>
              Domain Authority
            </a>
          </li>
          <li>
            <a href="{{url('/imageanalysis')}}" class="<?=$title == 'ImageAnalysis' ? 'current' : ''?>">
              <div class="img"><img src="{{url('assets/img/menu-image.svg')}}" /></div>
              Image Analysis
            </a>
          </li>
          <li>
            <a href="{{url('/backlinkanalysis')}}" class="<?=$title == 'BackLink' ? 'current' : ''?>">
              <div class="img"><img src="{{url('assets/img/menu-backlink.svg')}}" /></div>
              Backlink Analysis
            </a>
          </li>
          <li>
            <a href="{{url('/keywordrank')}}" class="<?=$title == 'KaywordRank' ? 'current' : ''?>">
              <div class="img"><img src="{{url('assets/img/menu-keyword-rank.svg')}}" /></div>
              Keyword Rank
            </a>
          </li>
          <li>
            <a href="" class="<?=$page_current == 'html' ? 'current' : ''?> disabled">
              <div class="img"><img src="{{url('assets/img/menu-html.svg')}}" /></div>
              HTML Validation
            </a>
          </li>
          <li>
            <a href="{{url('/cssvalidation')}}" class="<?=$page_current == 'css' ? 'current' : ''?>">
              <div class="img"><img src="{{url('assets/img/menu-css.svg')}}" /></div>
              CSS Validation
            </a>
          </li>
          <li>
            <a href="{{url('/downtimemonitor')}}" class="<?=$title == 'downtimeMonitor' ? 'current' : ''?>">
              <div class="img"><img src="{{url('assets/img/menu-downtime.svg')}}" /></div>
              Downtime Monitor
            </a>
          </li>
          <li>
            <a href="{{url('/brokenlink')}}" class="<?=$title == 'brokenlink' ? 'current' : ''?>">
              <div class="img"><img src="{{url('assets/img/menu-broken-link.svg')}}" /></div>
              Broken Link Checker
            </a>
          </li>
          <li>
            <a href="" class="<?=$title == 'CrossBrowser' ? 'current' : ''?> disabled ">
              <div class="img"><img src="{{url('assets/img/menu-browser.svg')}}" /></div>
              Cross Browser Checker
            </a>
          </li>
        </ul>
      </div>
      <div class="col-8">
      @yield('content')
      </div>
    </div>
  </div>
  
  <script type="text/javascript" src="{{url('assets/js/chart.min.js')}}"></script>
  <script type="text/javascript">
    var ctx = document.getElementById('RankGraph').getContext('2d');
    var myChart = new Chart(ctx, {
      type: 'line',
      data: {
          labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
          datasets: [{
              label: '# of Votes',
              data: [12, 19, 3, 5, 2, 3],
              backgroundColor: [
                  'rgba(255, 99, 132, 0.2)',
                  'rgba(54, 162, 235, 0.2)',
                  'rgba(255, 206, 86, 0.2)',
                  'rgba(75, 192, 192, 0.2)',
                  'rgba(153, 102, 255, 0.2)',
                  'rgba(255, 159, 64, 0.2)'
              ],
              borderColor: [
                  'rgba(255, 99, 132, 1)',
                  'rgba(54, 162, 235, 1)',
                  'rgba(255, 206, 86, 1)',
                  'rgba(75, 192, 192, 1)',
                  'rgba(153, 102, 255, 1)',
                  'rgba(255, 159, 64, 1)'
              ],
              borderWidth: 1
          }]
      },
      options: {
          scales: {
              y: {
                  beginAtZero: true
              }
          }
      }
    });
    var ctx = document.getElementById('KeywordGraph').getContext('2d');
    var myChart = new Chart(ctx, {
      type: 'line',
      data: {
          labels: ['Red', 'Blue', 'Yellow', 'Green', 'Purple', 'Orange'],
          datasets: [{
              label: '# of Votes',
              data: [12, 19, 3, 5, 2, 3],
              backgroundColor: [
                  'rgba(255, 99, 132, 0.2)',
                  'rgba(54, 162, 235, 0.2)',
                  'rgba(255, 206, 86, 0.2)',
                  'rgba(75, 192, 192, 0.2)',
                  'rgba(153, 102, 255, 0.2)',
                  'rgba(255, 159, 64, 0.2)'
              ],
              borderColor: [
                  'rgba(255, 99, 132, 1)',
                  'rgba(54, 162, 235, 1)',
                  'rgba(255, 206, 86, 1)',
                  'rgba(75, 192, 192, 1)',
                  'rgba(153, 102, 255, 1)',
                  'rgba(255, 159, 64, 1)'
              ],
              borderWidth: 1
          }]
      },
      options: {
          scales: {
              y: {
                  beginAtZero: true
              }
          }
      }
    });
  </script>  
</body>

</html>
