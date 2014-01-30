<!DOCTYPE html>
<html>
<head>
<title>Break In | Threads</title>
<?php include_once 'includer.php'; ?>
<style>
.loginbox {z-index:9999;}
.table{width:100%;margin-bottom:20px}
.table th,.table td{padding:8px;line-height:20px;text-align:left;vertical-align:top;border-top:1px solid #222}
.table th{font-weight:bold}
.table thead th{vertical-align:bottom}
.table caption+thead tr:first-child th,.table caption+thead tr:first-child td,.table colgroup+thead tr:first-child th,.table colgroup+thead tr:first-child td,.table thead:first-child tr:first-child th,.table thead:first-child tr:first-child td{border-top:0}
.table tbody+tbody{border-top:2px solid #222}
.table .table{background-color:#060606}
.table-condensed th,.table-condensed td{padding:4px 5px}
.table-bordered{border:1px solid #222;border-collapse:separate;*border-collapse:collapse;border-left:0;-webkit-border-radius:4px;-moz-border-radius:4px;border-radius:4px}
.table-bordered th,.table-bordered td{border-left:1px solid #222}
.table-bordered caption+thead tr:first-child th,.table-bordered caption+tbody tr:first-child th,.table-bordered caption+tbody tr:first-child td,.table-bordered colgroup+thead tr:first-child th,.table-bordered colgroup+tbody tr:first-child th,.table-bordered colgroup+tbody tr:first-child td,.table-bordered thead:first-child tr:first-child th,.table-bordered tbody:first-child tr:first-child th,.table-bordered tbody:first-child tr:first-child td{border-top:0}
.table-bordered thead:first-child tr:first-child>th:first-child,.table-bordered tbody:first-child tr:first-child>td:first-child,.table-bordered tbody:first-child tr:first-child>th:first-child{-webkit-border-top-left-radius:4px;border-top-left-radius:4px;-moz-border-radius-topleft:4px}
.table-bordered thead:first-child tr:first-child>th:last-child,.table-bordered tbody:first-child tr:first-child>td:last-child,.table-bordered tbody:first-child tr:first-child>th:last-child{-webkit-border-top-right-radius:4px;border-top-right-radius:4px;-moz-border-radius-topright:4px}
.table-bordered thead:last-child tr:last-child>th:first-child,.table-bordered tbody:last-child tr:last-child>td:first-child,.table-bordered tbody:last-child tr:last-child>th:first-child,.table-bordered tfoot:last-child tr:last-child>td:first-child,.table-bordered tfoot:last-child tr:last-child>th:first-child{-webkit-border-bottom-left-radius:4px;border-bottom-left-radius:4px;-moz-border-radius-bottomleft:4px}
.table-bordered thead:last-child tr:last-child>th:last-child,.table-bordered tbody:last-child tr:last-child>td:last-child,.table-bordered tbody:last-child tr:last-child>th:last-child,.table-bordered tfoot:last-child tr:last-child>td:last-child,.table-bordered tfoot:last-child tr:last-child>th:last-child{-webkit-border-bottom-right-radius:4px;border-bottom-right-radius:4px;-moz-border-radius-bottomright:4px}
.table-bordered tfoot+tbody:last-child tr:last-child td:first-child{-webkit-border-bottom-left-radius:0;border-bottom-left-radius:0;-moz-border-radius-bottomleft:0}
.table-bordered tfoot+tbody:last-child tr:last-child td:last-child{-webkit-border-bottom-right-radius:0;border-bottom-right-radius:0;-moz-border-radius-bottomright:0}
.table-bordered caption+thead tr:first-child th:first-child,.table-bordered caption+tbody tr:first-child td:first-child,.table-bordered colgroup+thead tr:first-child th:first-child,.table-bordered colgroup+tbody tr:first-child td:first-child{-webkit-border-top-left-radius:4px;border-top-left-radius:4px;-moz-border-radius-topleft:4px}
.table-bordered caption+thead tr:first-child th:last-child,.table-bordered caption+tbody tr:first-child td:last-child,.table-bordered colgroup+thead tr:first-child th:last-child,.table-bordered colgroup+tbody tr:first-child td:last-child{-webkit-border-top-right-radius:4px;border-top-right-radius:4px;-moz-border-radius-topright:4px}
.table-striped tbody>tr:nth-child(odd)>td,.table-striped tbody>tr:nth-child(odd)>th{background-color:rgba(100,100,100,0.1)}
.table-hover tbody tr:hover>td,.table-hover tbody tr:hover>th{background-color:#222}
.table td.span1,.table th.span1{float:none;width:44px;margin-left:0}
.table td.span2,.table th.span2{float:none;width:124px;margin-left:0}
.table td.span3,.table th.span3{float:none;width:204px;margin-left:0}
.table td.span4,.table th.span4{float:none;width:284px;margin-left:0}
.table td.span5,.table th.span5{float:none;width:364px;margin-left:0}
.table td.span6,.table th.span6{float:none;width:444px;margin-left:0}
.table td.span7,.table th.span7{float:none;width:524px;margin-left:0}
.table td.span8,.table th.span8{float:none;width:604px;margin-left:0}
.table td.span9,.table th.span9{float:none;width:684px;margin-left:0}
.table td.span10,.table th.span10{float:none;width:764px;margin-left:0}
.table td.span11,.table th.span11{float:none;width:844px;margin-left:0}
.table td.span12,.table th.span12{float:none;width:924px;margin-left:0}
.table tbody tr.success>td{background-color:#eee}
.table tbody tr.error>td{background-color:#eee}
.table tbody tr.warning>td{background-color:#eee}
.table tbody tr.info>td{background-color:#eee}
.table-hover tbody tr.success:hover>td{background-color:#e1e1e1}
.table-hover tbody tr.error:hover>td{background-color:#e1e1e1}
.table-hover tbody tr.warning:hover>td{background-color:#e1e1e1}
.table-hover tbody tr.info:hover>td{background-color:#e1e1e1}
.table{-webkit-border-radius:1px;-moz-border-radius:1px;border-radius:1px}
.table tbody tr.success td{color:#fff;background-color:#690}
.table tbody tr.error td{color:#fff;background-color:#c00}
.table tbody tr.info td{color:#fff;background-color:#33b5e5}
.table tbody tr.warning td{color:#fff;background-color:#f80}
body {
	background: rgb(2,22,35);
}
h1, h2, h3{
	text-align: center;
	font-family: Electrolize, sans-serif;
	color: #ddd;
}
h4{
	font-family: Electrolize, sans-serif;
	color: #ddd;
}
h1 {
	font-weight: bold;
	font-size: 5em;
	line-height: 1.25em;
	color: #f5f5f5;
	margin-top: 0.6em;
}
h2 {
	font-weight: lighter;
	font-size: 2.2em;
	line-height: 1.5em;
}
#notice{
	padding-top: 2em;
}
#timer {
	line-height: 1.5em;
}
.content {
	width: 80%;
	margin: auto;
}
.clearfix:after {
    content: ".";
    display: block;
    clear: both;
    visibility: hidden;
    line-height: 0;
    height: 0;
}

#counter {
	font-size: 1.3em;
	line-height: 1.2em;
}
#gotoarena:hover {
	color: #057cb8;
	text-decoration: underline;
}

#rules
{
	padding-bottom: 5%;
}

.rules-section {
}
h2#fold-rule {
        margin: 0;
        line-height: 1;
        display: inline-block;
    }
    #fold-rule {
    }
    #fold-arrow {
        float: right;
        margin: 0;
        line-height: 1;
        font-family: sans-serif;
        font-weight: light;
    }
    #fold-clicker {
       cursor: pointer;
    } 
    #fold-arrow img {
        height: 50px;
        width: 50px;
    }
    #rules {
        display: none;
	color: #ddd;      
  }
    #rules ol {
        padding: 10px 0 5px 0;
	font-family: 'Rokkitt', serif;
	font-size: 1.5em;
    }
    #rules li {
	margin: 5px;
	padding-bottom: 5px;
    }
     
.table-hover tbody tr:hover>td,.table-hover tbody tr:hover>th{background-color:#153943;}
</style>
<link href='http://fonts.googleapis.com/css?family=Rokkitt' rel='stylesheet' type='text/css'>
<script type="text/javascript">
    $(document).ready(function() {
        $('#fold-clicker').click(function() {
           $('#rules').stop().slideToggle(); 
            if($('#fold-arrow img').attr('src') == 'http://felicity.iiit.ac.in/threads/images/down-arrow.png')
                $('#fold-arrow img').attr('src','http://felicity.iiit.ac.in/threads/images/up-arrow.png');
            else
                $('#fold-arrow img').attr('src', 'http://felicity.iiit.ac.in/threads/images/down-arrow.png');
           });
    });
  </script>

</head>
<body>
<div class="content-wrapper">
<?php
include 'masthead.php';
?>
<div class="content">
<div id="notice">
<div style="float:right;" class="clearfix">
<?php include_once 'addevent.php'; ?>
</div>
<h1>Break In</h1>
<h2 id='timer'></h2>
</div>

<div class="unit single span-grid rules-section">
                    <div id="fold-clicker">
                    <h2 id="fold-rule">Rules</h2>
                    <h2 class="down-arrow" id="fold-arrow"><a href="javascript:void(0)"><img alt="Down arrow" src="http://felicity.iiit.ac.in/threads/images/down-arrow.png"></a></h2>
                       <hr>
                    </div>
                        <div id="rules">
			  <ol>

          <li> Contest starts on 11th Jan, 2014 at 1800 hours IST. Contest will be of 36 hours.
          <li> This is a Team event. There are no restrictions on team size. Instructions to form teams will be provided once the portal is open. </li>
          <li> All problems will require extraction of some key, which will be available once the challenge is solved. </li>
          <li> You need to submit the md5 hash of the key as the answer, i.e. if the answer is "key", submit md5(key). </li>
          <li> Answers to all the problems will necessarily be ASCII strings. </li>
          <li> There will be 6 categories of challenges: Trivia, Reverse Engineering, Forensics, Web Security, Cryptanalysis, and Reconnaissance.  </li>
          <li> The score of each challenge will be indicated against it. Ranking will be based on score achieved. Though there is no time penalty, tie-breaking will be done by total time taken to solve the challenges. </li>
          <li> For any doubts/queries you can join IRC channel for this event: <a href='irc://irc.freenode.net/#breakin-iiith'>#breakin-iiith</a>  </li>
          <li> If you are facing any issues, you can contact us at breakin@felicity.iiit.ac.in. </li>
          <li> Various types of casisngs followed in questions. For Trivia, its type 1. For Web Security, types 1 &amp; 2. For Miscellaneous, types 1, 2, 3 &amp; 4.
<ul>
  <li>lowercase, underscore separated
 eg. - this_is_the_key</li>
 <li>Camel case
 eg. - ThisIsTheKey</li>
 <li>Normal
 eg. This is the key
 or This is The Key in case of proper nouns</li>
 <li>All caps and no spaces.
 eg. THISISTHEKEY</li>
</ul>
 </li>

			  </ol>
                        </div>
                </div>

<div class="img-wrapper" style="text-align:right">
    <h4>Sponsored by </h4>
    <a href="http://qualcomm.co.in"> <img alt="Qualcomm" src="http://felicity.iiit.ac.in/threads/images/qualcomm.jpg" height="75px"> </a>
</div>
<!--
<div>
<div class="img-wrapper">
  <a href="http://qualcomm.co.in"> <img alt="Qualcomm" src="http://felicity.iiit.ac.in/threads/images/qualcomm.jpg" height="100px"> </a>
</div>
</div>
-->
</div>
</div>
<?
include("../footer.php");
?>

<script>
$(document).ready(function() {
  updateTime();
  setInterval(updateTime, 1000);
  if (window.location.hash == '#rules')
     $('#rules').show(); 
});

function updateTime()
{
  var d = new Date;

  var utc = d.getTime() + (d.getTimezoneOffset() * 60000);

  // create new Date object for different city
  // using supplied offset
  var nd = new Date(utc + (3600000*5.5));

  var now = nd;


  var start = new Date(2014,0,11,18,0,0);
  var end = new Date(2014,0,13,6,0,0);
  var state = '';
  var delta;
  var start_or_end;
  if(now <= end)
  {
    if(now < start)
    {
      state = 'Event starts on 11th Jan \'14 at 1800 hours (IST).<br><a  target="_blank" id="gotoarena" href="http://www.timeanddate.com/worldclock/fixedtime.html?msg=Break+In&iso=20140111T18&p1=505">Check in your time zone.</a><br>';
      delta = start - now;
      start_or_end = 'start';
    }
    else
    {
      state = 'Contest has started.</br>Please login to enter the arena.</br><a id="gotoarena" href="http://felicity.iiit.ac.in/threads/breakin/">Go to Arena!</a><br>Event ends on 13th Jan \'14 0600 hours (IST).<br> ';
      delta = end - now;
      start_or_end = 'end';
    }
    delta=Math.floor(delta/1000);
    var days = Math.floor(delta / 86400);
    var hours = Math.floor(delta / 3600) % 24;
    var minutes = Math.floor(delta / 60) % 60;
    var seconds = delta % 60;
    var display = (state + '<div id="counter">' + days + ((days == 1) ? ' day ' : ' days ') + hours + ((hours == 1) ?  ' hour, ' : ' hours, ') + minutes + ((minutes == 1) ? ' minute ' : ' minutes ') + 'and ' + seconds + ((seconds == 1) ? ' second' : ' seconds'));
    $('#timer').html(display + '<br>remaining for '+start_or_end+' of event.</div><br />Please refresh the page once you login/logout.');
  }
  else
  {
    var display = "Contest has Ended.<br />Thank you all for making this event a success.<br /><a href='http://felicity.iiit.ac.in/threads/breakin/scoreboard.php'>View Final Scoreboard.</a><br />We'll contact the winners shortly. Stay in touch!";
    $('#timer').html(display);
  }
}
</script>
</body>
</html>
