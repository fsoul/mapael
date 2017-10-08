<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>Map with links between the plotted cities</title>
    <style type="text/css">
        body {
            color: #5d5d5d;
            font-family: Helvetica, Arial, sans-serif;
        }

        h1 {
            font-size: 30px;
            margin: auto;
            margin-top: 50px;
        }

        #canvas_container {
            width: 200px;
            border: 1px solid #aaa;
        }

        .container {
            max-width: 800px;
            margin: auto;
        }

        /* Specific mapael css class are below
         * 'mapael' class is added by plugin
        */

        .mapael .map {
            position: relative;
        }

        .mapael .mapTooltip {
            position: absolute;
            background-color: #fff;
            moz-opacity: 0.70;
            opacity: 0.70;
            filter: alpha(opacity=70);
            border-radius: 10px;
            padding: 10px;
            z-index: 1000;
            max-width: 200px;
            display: none;
            color: #343434;
        }
    </style>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js" charset="utf-8"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-mousewheel/3.1.13/jquery.mousewheel.min.js" charset="utf-8"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.2.7/raphael.min.js" charset="utf-8"></script>
    <script src="/js/jquery.mapael.js" charset="utf-8"></script>
    <script src="/js/france_departments.js" charset="utf-8"></script>
    <script src="/js/world_countries.js" charset="utf-8"></script>
    <script src="/js/usa_states.js" charset="utf-8"></script>

    <script type="text/javascript">
//        window.onload = function() {
//            var paper = new Raphael(document.getElementById('canvas_container'), 500, 500);
//            var tetronimo = paper.path("M 250 250 l 0 -50 l -50 0 l 0 -50 l -50 0 l 0 50 l -50 0 l 0 50 z");
//            tetronimo.attr(
//                {
//                    gradient: '90-#526c7a-#64a0c1',
//                    stroke: '#3b4449',
//                    'stroke-width': 10,
//                    'stroke-linejoin': 'round',
//                    rotation: -90
//                }
//            );
//
//
//            tetronimo.animate({rotation: 360, 'stroke-width': 1}, 2000, 'bounce', function() {
//                /* callback after original animation finishes */
//                this.animate({
//                    rotation: -90,
//                    stroke: '#3b4449',
//                    'stroke-width': 10
//                }, 1000);
//            });
//        };
        window.onload = function() {
            var r = Raphael("canvas_container", 200, 200),
                p = r.path("M10,50C10,100,90,0,90,50C90,100,10,0,10,50Z").attr({stroke: "#ddd"}),
                e = r.ellipse(10, 50, 4, 4).attr({stroke: "none", fill: "#f00"});
            r.rect(0, 0, 200, 200).attr({stroke: "none", fill: "#000", opacity: 0}).click(function () {
                e.attr({rx: 5, ry: 3}).animateAlong(p, 4000, true, function () {
                    e.attr({rx: 4, ry: 4});
                });
            });
        };

        $(function () {
            $(".mapcontainer").mapael({
                map: {
                    name: "world_countries",
                    defaultArea: {
                        attrs: {
                            fill: "#f4f4e8"
                            , stroke: "#ced8d0"
                        }
                    },
                    afterInit : function($self, paper, areas, plots, options) {
                        // You are free to call all Raphael.js functions on paper object
                        console.log($self);
                        console.log(paper);
                        console.log(areas);
                        console.log(plots);
                        console.log(options);
                    }
                    // Default attributes can be set for all links
                    , defaultLink: {
                        factor: 0.4
                        , attrsHover: {
                            stroke: "#a4e100"
                        }
                    }
                    , defaultPlot: {
                        text: {
                            attrs: {
                                fill: "#000"
                            },
                            attrsHover: {
                                fill: "#000"
                            }
                        }
                    }
                },
                plots: {
                    'kiev':{
                        latitude: 50.43,
                        longitude: 30.52,
                        tooltip: {content: "Kiev<br />Population: 37000000"}
                    },
                    ottawa:{
                        latitude: 45.41,
                        longitude: -75.69,
                        tooltip: {content: "Ottawa<br />Population: 934243"}
                    }
                },
                // Links allow you to connect plots between them
                links: {}
            });

            $('#addLink').on('click', function () {

                // Update some plots and areas attributes ...
                var opt = {
                    mapOptions: {
                        'areas': {},
                        'plots': {},
                        'links': {
                            'kievottawa': {
                                factor: -0.3,
                                between: ['kiev', 'ottawa'],
                                attrs: {
                                    "stroke-width": 2
                                },
                                tooltip: {content: "Kiev - Ottawa"}
                            }
                        }
                    },

                    animDuration: 500,
                    'deleteLinkKeys': ['kievottawa'],
                    'newLinks': {
                        'kievottawa': {
                            factor: -0.3,
                            between: ['kiev', 'ottawa'],
                            attrs: {
                                "stroke-width": 2
                            },
                            tooltip: {content: "Kiev - Ottawa"}
                        }
                    }
                };

                $(".mapcontainer").trigger('update', [opt]);

//                $(".mapcontainer").mapael({
//                    map: {
//                        name: "world_countries",
//                        defaultArea: {
//                            attrs: {
//                                fill: "#f4f4e8"
//                                , stroke: "#ced8d0"
//                            }
//                        },
//                        afterInit: function($self, paper, areas, plots, options){
//                            var t = paper.path("M557.74104 105.98627");
//                            console.log(t);
//                        }
//                    }
//                });

                var arc = $('[data-id=kievottawa]').attr('d');
                var kiev = $('[data-id=kiev]').attr('cx');
                var ottawa = $('[data-id=ottawa]').attr('cx');

                var c = Raphael("canvas_container", 800, 320);
                var p = c.path("M" + kiev + " " + ottawa);

                p.animate({path: arc}, 5000);

                console.log(kiev);
                console.log(ottawa);
            });
        });
    </script>

</head>

<body>
<div id="canvas_container"></div>
<div class="container">

    <h1>Map with links between the plotted cities</h1>

    <button id="addLink">Send</button>
    <div class="mapcontainer">
        <div class="map">
            <span>Alternative content for the map</span>
        </div>
    </div>

    <p><b>All example for jQuery Mapael are available <a href="https://www.vincentbroute.fr/mapael/">here</a>.</b></p>

</div>


</body>
</html>