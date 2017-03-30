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
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.0/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"></script>
        <link rel="stylesheet" type="text/css" media="all" href="/css/lightbox.css" />
        <link rel="stylesheet" type="text/css" media="all" href="/css/style.css" />
        <link rel="stylesheet" type="text/css" media="all" href="/css/custom.css" />

        <style>
            .dropbtn {
                background-color: #00cc44;
                color: white;
                padding: 16px;
                font-size: 16px;
                border: none;
                cursor: pointer;
            }

            .dropbtn:hover, .dropbtn:focus {
                background-color: #3e8e41;
            }

            .dropdown {
                position: relative;
                display: inline-block;
            }

            .dropdown-content {
                display: none;
                position: absolute;
                background-color: #f9f9f9;
                min-width: 160px;
                overflow: auto;
                box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
                z-index: 1;
            }

            .dropdown-content a {
                color: black;
                padding: 12px 16px;
                text-decoration: none;
                display: block;
            }

            .dropdown a:hover {background-color: #f1f1f1}

            .show {display:block;}
        </style>
        <script>
            /* When the user clicks on the button,
             toggle between hiding and showing the dropdown content */
            function myFunction() {
                document.getElementById("myDropdown").classList.toggle("show");
            }

            // Close the dropdown if the user clicks outside of it
            window.onclick = function(event) {
                if (!event.target.matches('.dropbtn')) {

                    var dropdowns = document.getElementsByClassName("dropdown-content");
                    var i;
                    for (i = 0; i < dropdowns.length; i++) {
                        var openDropdown = dropdowns[i];
                        if (openDropdown.classList.contains('show')) {
                            openDropdown.classList.remove('show');
                        }
                    }
                }
            }
        </script>
    </head>
    <body>
        <div id="wrapper">
            <div id="header">
                <span class="myhead"><img width="50px" src="/img/favicon.png" />Kiwi Plant</span>
                <span class="mynav">
                    <!--<ul>-->
                        <ul class="nav nav-tabs">
                        {nav}
                        
                        <li>
                            <div class="dropdown">
                                <button onclick="myFunction()" class="btn btn-success dropbtn">Role</button>
                                <div id="myDropdown" class="dropdown-content">
                                    <a href="/roles/actor/Worker">Worker</a>
                                    <a href="/roles/actor/Supervisor">Supervisor</a>
                                    <a href="/roles/actor/Boss">Boss</a>
                                    <a href="/roles/actor/Guest">Guest</a>
                                </div>
                            </div>
                        </li>
                        </ul>
                    <!--</ul>-->
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
