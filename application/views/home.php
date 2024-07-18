<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Sistem Informasi Sarpras SMPN 1 Bandar</title>

    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <link rel="stylesheet" href="<?= base_url('assets') ?>/bower_components/bootstrap/dist/css/bootstrap.min.css">

    <link rel="stylesheet" href="<?= base_url('assets') ?>/bower_components/font-awesome/css/font-awesome.min.css">

    <link rel="stylesheet" href="<?= base_url('assets') ?>/bower_components/Ionicons/css/ionicons.min.css">

    <link rel="stylesheet" href="<?= base_url('assets') ?>/dist/css/AdminLTE.min.css">

    <link rel="stylesheet" href="<?= base_url('assets') ?>/dist/css/skins/_all-skins.min.css">


    <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
    <script nonce="956ad86e-78f1-4b82-b742-96b6a6c90915">
        (function(w, d) {
            ! function(bw, bx, by, bz) {
                bw[by] = bw[by] || {};
                bw[by].executed = [];
                bw.zaraz = {
                    deferred: [],
                    listeners: []
                };
                bw.zaraz.q = [];
                bw.zaraz._f = function(bA) {
                    return function() {
                        var bB = Array.prototype.slice.call(arguments);
                        bw.zaraz.q.push({
                            m: bA,
                            a: bB
                        })
                    }
                };
                for (const bC of ["track", "set", "debug"]) bw.zaraz[bC] = bw.zaraz._f(bC);
                bw.zaraz.init = () => {
                    var bD = bx.getElementsByTagName(bz)[0],
                        bE = bx.createElement(bz),
                        bF = bx.getElementsByTagName("title")[0];
                    bF && (bw[by].t = bx.getElementsByTagName("title")[0].text);
                    bw[by].x = Math.random();
                    bw[by].w = bw.screen.width;
                    bw[by].h = bw.screen.height;
                    bw[by].j = bw.innerHeight;
                    bw[by].e = bw.innerWidth;
                    bw[by].l = bw.location.href;
                    bw[by].r = bx.referrer;
                    bw[by].k = bw.screen.colorDepth;
                    bw[by].n = bx.characterSet;
                    bw[by].o = (new Date).getTimezoneOffset();
                    if (bw.dataLayer)
                        for (const bJ of Object.entries(Object.entries(dataLayer).reduce(((bK, bL) => ({
                                ...bK[1],
                                ...bL[1]
                            }))))) zaraz.set(bJ[0], bJ[1], {
                            scope: "page"
                        });
                    bw[by].q = [];
                    for (; bw.zaraz.q.length;) {
                        const bM = bw.zaraz.q.shift();
                        bw[by].q.push(bM)
                    }
                    bE.defer = !0;
                    for (const bN of [localStorage, sessionStorage]) Object.keys(bN || {}).filter((bP => bP.startsWith("_zaraz_"))).forEach((bO => {
                        try {
                            bw[by]["z_" + bO.slice(7)] = JSON.parse(bN.getItem(bO))
                        } catch {
                            bw[by]["z_" + bO.slice(7)] = bN.getItem(bO)
                        }
                    }));
                    bE.referrerPolicy = "origin";
                    bE.src = "/cdn-cgi/zaraz/s.js?z=" + btoa(encodeURIComponent(JSON.stringify(bw[by])));
                    bD.parentNode.insertBefore(bE, bD)
                };
                ["complete", "interactive"].includes(bx.readyState) ? zaraz.init() : bw.addEventListener("DOMContentLoaded", zaraz.init)
            }(w, d, "zarazData", "script");
        })(window, document);
    </script>
</head>

<body class="hold-transition skin-blue layout-top-nav">
    <div class="wrapper">
        <header class="main-header">
            <nav class="navbar navbar-static-top">
                <div class="container">
                    <div class="navbar-header">
                        <a href="../../index2.html" class="navbar-brand"><b>Sistem Informasi Sarpras SMPN 1 Bandar</a>
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                            <i class="fa fa-bars"></i>
                        </button>
                    </div>

                    <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
                        <ul class="nav navbar-nav">
                            <li class="active"><a href="<?= base_url('index.php/home/auth') ?>">Login <span class="sr-only">(current)</span></a></li>
                            <!-- <li><a href="#">Link</a></li>
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <span class="caret"></span></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="#">Action</a></li>
                                    <li><a href="#">Another action</a></li>
                                    <li><a href="#">Something else here</a></li>
                                    <li class="divider"></li>
                                    <li><a href="#">Separated link</a></li>
                                    <li class="divider"></li>
                                    <li><a href="#">One more separated link</a></li>
                                </ul>
                            </li> -->
                        </ul>
                        <!-- <form class="navbar-form navbar-left" role="search">
                            <div class="form-group">
                                <input type="text" class="form-control" id="navbar-search-input" placeholder="Search">
                            </div>
                        </form> -->
                    </div>




                </div>

            </nav>
        </header>


        <footer class="main-footer">
            <div class="container">
                <div class="pull-right hidden-xs">
                    <b>Version</b> 1.0.0
                </div>
                <strong>Copyright &copy; 2024 <a href="#">SMPN 1 Bandar</a>.</strong> All rights
                reserved.
            </div>

        </footer>
    </div>


    <script src="<?= base_url('assets') ?>/bower_components/jquery/dist/jquery.min.js"></script>

    <script src="<?= base_url('assets') ?>/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <script src="<?= base_url('assets') ?>/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>

    <script src="<?= base_url('assets') ?>/bower_components/fastclick/lib/fastclick.js"></script>

    <script src="<?= base_url('assets') ?>/dist/js/adminlte.min.js"></script>

    <script src="<?= base_url('assets') ?>/dist/js/demo.js"></script>
</body>

</html>