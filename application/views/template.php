<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.1//EN" "http://www.w3.org/TR/xhtml11/DTD/xhtml11.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
    <head>
        <title>{pagetitle}</title>
        <meta HTTP-EQUIV="Content-Type" CONTENT="text/html; charset=UTF-8"/>
        <link rel="shortcut icon" href="/img/favicon.png" />
        <link rel="stylesheet" type="text/css" media="all" href="/css/reset.css" />
        <link rel="stylesheet" type="text/css" media="all" href="/css/text.css" />
        <link rel="stylesheet" type="text/css" media="all" href="/css/bootstrap-3.3.7-dist/css/bootstrap.min.css" />
        <link rel="stylesheet" type="text/css" media="all" href="/css/bootstrap-3.3.7-dist/css/bootstrap.css" />
        <link rel="stylesheet" type="text/css" media="all" href="/css/lightbox.css" />
        <link rel="stylesheet" type="text/css" media="all" href="/css/style.css" />
    </head>
    <body>
        <div id="wrapper">
            <div id="header">
                <span class="myhead"><img width="50px" src="/img/favicon.png" />Kiwi Plant</span>
                <span class="mynav">
                    <ul>
                        <li><a href="/">Home</a></li>
                        <li><a href="/parts">Parts</a></li>
                        <li><a href="/assembly">Assembly</a></li>
                        <li><a href="/history">History</a></li>
                        <ul class="dropdown-menu" role="menu" aria-labelledby="dLabel">
                          <li><a href="/roles/actor/Guest">Guest</a></li>
                          <li><a href="/roles/actor/Owner">Owner</a></li>
                        </ul>
                    </ul>
                </span>
            </div>
            <div class="alone"></div>
            <div id="content">
            	<!-- injection here -->
                <h1 class="text-center">{pagetitle}</h1>
            	{content}
            </div>
            <div id="footer" class="span12">
                Copyright &copy; 2014,  <a href="mailto:rachel@shellborn.com">Team NGU</a>.
            </div>
        </div>
        <script type="text/javascript" src="js/jquery-1.11.0.min.js"></script>
        <script type="text/javascript" src="js/lightbox.min.js"></script>
    </body>
</html>
