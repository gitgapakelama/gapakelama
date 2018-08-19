<!DOCTYPE html>
<html lang="en" class="no-js">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Unity - Scripting API: AudioImporterSampleSettings.loadType</title>
    <meta name="description" content="Unity is the ultimate game development platform. Use Unity to build high-quality 3D and 2D games, deploy them across mobile, desktop, VR/AR, consoles or the Web, and connect with loyal and enthusiastic players and customers." />
    <meta name="author" content="Unity Technologies" />
    <link rel="shortcut icon" href="../StaticFiles/images/favicons/favicon.ico" />
    <link rel="icon" type="image/png" href="../StaticFiles/images/favicons/favicon.png" />
    <link rel="apple-touch-icon-precomposed" sizes="152x152" href="../StaticFiles/images/favicons/apple-touch-icon-152x152.png" />
    <link rel="apple-touch-icon-precomposed" sizes="144x144" href="../StaticFiles/images/favicons/apple-touch-icon-144x144.png" />
    <link rel="apple-touch-icon-precomposed" sizes="120x120" href="../StaticFiles/images/favicons/apple-touch-icon-120x120.png" />
    <link rel="apple-touch-icon-precomposed" sizes="114x114" href="../StaticFiles/images/favicons/apple-touch-icon-114x114.png" />
    <link rel="apple-touch-icon-precomposed" sizes="72x72" href="../StaticFiles/images/favicons/apple-touch-icon-72x72.png" />
    <link rel="apple-touch-icon-precomposed" href="../StaticFiles/images/favicons/apple-touch-icon.png" />
    <meta name="msapplication-TileColor" content="#222c37" />
    <meta name="msapplication-TileImage" content="../StaticFiles/images/favicons/tileicon-144x144.png" />
    <script type="text/javascript">
  var _gaq = _gaq || [];
  _gaq.push(['_setAccount', 'UA-2854981-1']);
  _gaq.push(['_setDomainName', 'unity3d.com']);
  _gaq.push(['_trackPageview']);
  (function() {
    var ga = document.createElement('script'); ga.type = 'text/javascript'; ga.async = true;
    ga.src = ('https:' == document.location.protocol ? 'https://ssl' : 'http://www') + '.google-analytics.com/ga.js';
    var s = document.getElementsByTagName('script')[0]; s.parentNode.insertBefore(ga, s);
  })();
  </script>
    <script type="text/javascript" src="../StaticFiles/js/jquery.js">
    </script>
    <script type="text/javascript" src="docdata/toc.js">//toc</script>
    <!--local TOC-->
    <script type="text/javascript" src="docdata/global_toc.js">//toc</script>
    <!--global TOC, including other platforms-->
    <script type="text/javascript" src="../StaticFiles/js/core.js">
    </script>
    <link href="https://fonts.googleapis.com/css?family=Open+Sans:400,700,400italic" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="../StaticFiles/css/core.css" />
  </head>
  <body>
    <div class="header-wrapper">
      <div id="header" class="header">
        <div class="content">
          <div class="spacer">
            <div class="menu">
              <div class="logo">
                <a href="">
                </a>
              </div>
              <div class="search-form">
                <form action="30_search.html" method="get" class="apisearch">
                  <input type="text" name="q" placeholder="Search scripting..." autosave="Unity Reference" results="5" class="sbox field" id="q">
                  </input>
                  <input type="submit" class="submit">
                  </input>
                </form>
              </div>
              <ul>
                <li>
                  <a href="../Manual/index.html">Manual</a>
                </li>
                <li>
                  <a href="../ScriptReference/index.html" class="selected">Scripting API</a>
                </li>
              </ul>
            </div>
          </div>
          <div class="more">
            <div class="filler">
            </div>
            <ul>
              <li>
                <a href="http://unity3d.com/">unity3d.com</a>
              </li>
            </ul>
          </div>
        </div>
      </div>
      <div class="toolbar">
        <div class="content clear">
          <div class="version-number">Version: <b>5.5</b> (<a href="http://docs.unity3d.com/540/Documentation/ScriptReference">switch to 5.4</a>)</div>
          <div class="lang-switcher hide">
            <div class="current toggle" data-target=".lang-list">
              <div class="lbl">Language<span class="b">English</span></div>
              <div class="arrow">
              </div>
            </div>
            <div class="lang-list" style="display:none;">
              <ul>
                <li>
                  <a href="">English</a>
                </li>
              </ul>
            </div>
          </div>
          <div class="script-lang">
            <ul>
              <li class="selected" data-lang="CS">C#</li>
              <li data-lang="JS">JS</li>
            </ul>
            <div id="script-lang-dialog" class="dialog hide">
              <div class="dialog-content clear">
                <h2>Script language</h2>
                <div class="close">
                </div>
                <p class="clear">Select your preferred scripting language. All code snippets will be displayed in this language.</p>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div id="master-wrapper" class="master-wrapper clear">
      <div id="sidebar" class="sidebar">
        <div class="sidebar-wrap">
          <div class="content">
            <div class="sidebar-menu">
              <div class="toc">
                <h2>Scripting API</h2>
              </div>
            </div>
            <p>
              <a href="40_history.html" class="cw">History</a>
            </p>
          </div>
        </div>
      </div>
      <div id="content-wrap" class="content-wrap">
        <div class="content-block">
          <div class="content">
            <div class="section">
              <div class="mb20 clear" id="">
                <h1 class="heading inherit">
                  <a href="AudioImporterSampleSettings.html">AudioImporterSampleSettings</a>.loadType</h1>
                <div class="clear">
                </div>
                <div class="clear">
                </div>
                <div class="suggest">
                  <a class="blue-btn sbtn">Suggest a change</a>
                  <div class="suggest-wrap rel hide">
                    <div class="loading hide">
                      <div>
                      </div>
                      <div>
                      </div>
                      <div>
                      </div>
                    </div>
                    <div class="suggest-success hide">
                      <h2>Success!</h2>
                      <p>Thank you for helping us improve the quality of Unity Documentation. Although we cannot accept all submissions, we do read each suggested change from our users and will make updates where applicable.</p>
                      <a class="gray-btn sbtn close">Close</a>
                    </div>
                    <div class="suggest-failed hide">
                      <h2>Submission failed</h2>
                      <p>For some reason your suggested change could not be submitted. Please &lt;a&gt;try again&lt;/a&gt; in a few minutes. And thank you for taking the time to help us improve the quality of Unity Documentation.</p>
                      <a class="gray-btn sbtn close">Close</a>
                    </div>
                    <div class="suggest-form clear">
                      <label for="suggest_name">Your name</label>
                      <input id="suggest_name" type="text">
                      </input>
                      <label for="suggest_email">Your email</label>
                      <input id="suggest_email" type="email">
                      </input>
                      <label for="suggest_body" class="clear">Suggestion<span class="r">*</span></label>
                      <textarea id="suggest_body" class="req">
                      </textarea>
                      <button id="suggest_submit" class="blue-btn mr10">Submit suggestion</button>
                      <p class="mb0">
                        <a class="cancel left lh42 cn">Cancel</a>
                      </p>
                    </div>
                  </div>
                </div>
                <a href="" class="switch-link gray-btn sbtn left hide">
                </a>
                <div class="clear">
                </div>
              </div>
              <div class="subsection">
                <div class="signature">
                  <div class="signature-JS sig-block">
                    <span style="color:red;">
                    </span>public
      var <span class="sig-kw">loadType</span>: <a href="AudioClipLoadType.html">AudioClipLoadType</a>;
    </div>
                  <div class="signature-CS sig-block">
                    <span style="color:red;">
                    </span>public <a href="AudioClipLoadType.html">AudioClipLoadType</a> <span class="sig-kw">loadType</span>;
    </div>
                </div>
              </div>
              <div class="subsection">
                <h2>Description</h2>
                <p>LoadType defines how the imported AudioClip data should be loaded.</p>
              </div>
            </div>
            <div class="footer-wrapper">
              <div class="footer clear">
                <div class="copy">Copyright © 2016 Unity Technologies. Publication 5.5-Z</div>
                <div class="menu">
                  <a hre