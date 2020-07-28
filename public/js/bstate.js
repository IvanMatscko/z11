
// window.onload = function () {
    //GRAPH START

    Raphael.fn.drawCustomGrid = function (x, y, w, h, wv, hv, color,totalY,height,direColor,radiantColor) {
        color = color || "#000";
        var path = [],
        path_dot100 = [],
        path_dot1000 = [],
        path_dash = [],
        marginLeftText = 6,
        marginLeftLines = 16,
        columnWidth = w / wv;
        
        path = path.concat(["M", Math.round(x), hv + .5, "H", Math.round(x + w -8)]);
        var arrowWidth = 12,
            arrowHeight = 9;
        for (var i = 1; i <= arrowHeight; i++) {
            path = path.concat(["M", Math.round(x + w -8)+arrowWidth -5 + .5, hv + .5, "L", Math.round(x + w -8) -3 + .5, hv + .5 + Math.round(arrowHeight / 2 - i)]);
        }
        // path = path.concat(["M", Math.round(x + w), hv+2 + .5, "L", Math.round(x + w)+10, hv+2 + .5+10]);
        for (i = 1; i < wv; i++) {
            path = path.concat(["M", Math.round(x + i * columnWidth) -3 + .5, hv-2, "V", hv+4]);
        }

        var count = 0;
        for (i = hv; i > 0;i=i-(totalY*100))
        {
            if (i != hv)
            {
                if (count % 100 == 0)
                    path_dash = path_dash.concat(["M", Math.round(x)+marginLeftLines, i + .5, "H", Math.round(x + w )]);
                else if (count % 10 == 0)
                    path_dot1000 = path_dot1000.concat(["M", Math.round(x)+marginLeftLines, i + .5, "H", Math.round(x + w )]);
                else
                    path_dot100 = path_dot100.concat(["M", Math.round(x)+marginLeftLines, i + .5, "H", Math.round(x + w )]);
            }
            count++;
        }
        var count = 0;
        for (i = hv; i < height;i=i+(totalY*100))
        {
            if (i != hv)
            {
                if (count % 100 == 0)
                    path_dash = path_dash.concat(["M", Math.round(x)+marginLeftLines, i + .5, "H", Math.round(x + w )]);
                else if (count % 10 == 0)
                    path_dot1000 = path_dot1000.concat(["M", Math.round(x)+marginLeftLines, i + .5, "H", Math.round(x + w )]);
                else
                    path_dot100 = path_dot100.concat(["M", Math.round(x)+marginLeftLines, i + .5, "H", Math.round(x + w )]);
            }
            count++;
        }

        if (path_dash.length > 0)
        {
            this.path(path_dash.join(",")).attr({stroke: color,"stroke-width": 0.4,});
            var count = 0;
            for (i = hv; i > 0;i=i-(totalY*100))
            {
                if (count % 100 == 0 && count > 0)
                {
                    if (Math.trunc(count/100) % 2 != 0)
                        this.text(Math.round(x)+marginLeftText, i + .5, Math.trunc(count/100)+"0k").attr({fill: radiantColor,"font-size": 9});
                }
                count++;
            }
            var count = 0;
            for (i = hv; i < height;i=i+(totalY*100))
            {
                if (count % 100 == 0 && count > 0)
                {
                    if (Math.trunc(count/100) % 2 != 0)
                        this.text(Math.round(x)+marginLeftText, i + .5, Math.trunc(count/100)+"0k").attr({fill: direColor,"font-size": 9});
                }
                count++;
            }
        }
        else if (path_dot1000.length > 0)
        {
            this.path(path_dot1000.join(",")).attr({stroke: color,"stroke-width": .4});
            var count = 0;
            for (i = hv; i > 0;i=i-(totalY*100))
            {
                if (count % 10 == 0 && count > 0)
                {
                    if (Math.trunc(count/10) % 2 != 0)
                        this.text(Math.round(x)+marginLeftText, i + .5, Math.trunc(count/10)+"k").attr({fill: radiantColor,"font-size": 9});
                }
                count++;
            }
            var count = 0;
            for (i = hv; i < height;i=i+(totalY*100))
            {
                if (count % 10 == 0 && count > 0)
                {
                    if (Math.trunc(count/10) % 2 != 0)
                        this.text(Math.round(x)+marginLeftText, i + .5, Math.trunc(count/10)+"k").attr({fill: direColor,"font-size": 9});
                }
                count++;
            }
        }
        else
        {
            this.path(path_dot100.join(",")).attr({stroke: color,"stroke-width": .4});
            var count = 0;
            for (i = hv; i > 0;i=i-(totalY*100))
            {
                if (count > 0)
                {
                    if (count % 2 != 0)
                        this.text(Math.round(x)+marginLeftText, i + .5, count+"00").attr({fill: radiantColor,"font-size": 9});
                }
                count++;
            }
            var count = 0;
            for (i = hv; i < height;i=i+(totalY*100))
            {
                if (count > 0)
                {
                    if (count % 2 != 0)
                        this.text(Math.round(x)+marginLeftText, i + .5, count+"00").attr({fill: direColor,"font-size": 9});
                }
                count++;
            }
        }

        this.path(path.join(",")).attr({stroke: color,"stroke-width": 1});
        return true;
    };

    // Draw

    function redrawGraph()
    {
        var width = 282,
        height = 192,
        leftgutter = 0,
        bottomgutter = 20,
        topgutter = 20,
        color = "#4C8EF1",
        direColor = "#FD3F38",
        radiantColor = "#6EC34A",
        rgh,
        txt = {font: '12px Helvetica, Arial', fill: "#fff"},
        // txt1 = {font: '10px Helvetica, Arial', fill: "#fff"},
        // txt2 = {font: '12px Helvetica, Arial', fill: "#000"},
        X = (width - leftgutter) / graph_labels.length,
        max = Math.max.apply(Math, graph_data),
        min = Math.min.apply(Math, graph_data),
        // Y = (height - bottomgutter - topgutter) / max;
        max = max > 0 ? max : 0;
        min = min < 0 ? min : 0;
        totalY = (height - bottomgutter - topgutter) / (min < 0 ? max-min : max);

        holder_container = window.document.querySelector('#holder');
        holder_container.innerHTML = '';
        rgh = Raphael("holder", width, height)
        rgh.drawCustomGrid(leftgutter + X * .5 + .5, topgutter + .5, width - leftgutter - X, height - topgutter - bottomgutter, 4, Math.round(height - bottomgutter + (min * totalY)), "#808080",totalY,height,direColor,radiantColor);
        var label = rgh.set(),
            lx = 0, ly = 0,
            is_label_visible = false,
            leave_timer,
            blanket = rgh.set();
        label.push(rgh.text(60, 12, "00000 golds").attr(txt));
        // label.push(rgh.text(60, 27, "00000").attr(txt1).attr({fill: color}));
        label.hide();
        var frame = rgh.popup(100, 100, label, "right").attr({fill: "#000", stroke: "#FD3F38", "stroke-width": 2, "fill-opacity": .7}).hide();
    
        var p;
        for (var i = 0, ii = graph_labels.length; i < ii; i++) {
            var y = Math.round(height - bottomgutter - totalY * graph_data[i] + (min * totalY)),
                x = Math.round(leftgutter + X * (i + .5));

            if (!i) {
                p = ["M", x, y, "L", x, y];
            } else
            {
                if (graph_data[i]==0 && ((typeof graph_data[i-1] !== 'undefined' && graph_data[i-1]==0) || typeof graph_data[i-1] === 'undefined'))
                {
                    p = ["M", prev_x, prev_y, "L", x, y];
                    pathColor = color;
                    rgh.path(p).attr({stroke: pathColor});
                }
                else if (graph_data[i]>=0 && ((typeof graph_data[i-1] !== 'undefined' && graph_data[i-1]>=0) || typeof graph_data[i-1] === 'undefined'))
                {
                    p = ["M", prev_x, prev_y, "L", x, y];
                    pathColor = radiantColor;
                    rgh.path(p).attr({stroke: pathColor});
                }
                else if (graph_data[i]<=0 && ((typeof graph_data[i-1] !== 'undefined' && graph_data[i-1]<=0) || typeof graph_data[i-1] === 'undefined'))
                {
                    p = ["M", prev_x, prev_y, "L", x, y];
                    pathColor = direColor;
                    rgh.path(p).attr({stroke: pathColor});
                }
                else
                {
                    difference = Math.abs(graph_data[i-1] - graph_data[i]);
                    abs_prev_y = Math.abs(graph_data[i-1]);
                    coefficient = difference / abs_prev_y;
                    x1 = prev_x+((x-prev_x) / coefficient);
                    y1 = prev_y+((y-prev_y) / coefficient);
                    if (graph_data[i]>0)
                    {
                        p = ["M", prev_x, prev_y, "L", x1, y1];
                        pathColor = direColor;
                        rgh.path(p).attr({stroke: direColor});
                        p = ["M", x1, y1, "L", x, y];
                        pathColor = direColor;
                        rgh.path(p).attr({stroke: radiantColor});
                    } else
                    {
                        p = ["M", prev_x, prev_y, "L", x1, y1];
                        pathColor = direColor;
                        rgh.path(p).attr({stroke: radiantColor});
                        p = ["M", x1, y1, "L", x, y];
                        pathColor = direColor;
                        rgh.path(p).attr({stroke: direColor});
                    }
                }
            }
            prev_x = x;
            prev_y = y;
    
            blanket.push(rgh.rect(leftgutter + X * i, 0, X, height - bottomgutter).attr({stroke: "none", fill: "#fff", opacity: 0}));
            var rect = blanket[blanket.length - 1];
            (function (x, y, graph_data, lbl) {
                rect.hover(function () {
                    clearTimeout(leave_timer);
                    var side = "right";
                    if (x + frame.getBBox().width > width) {
                        side = "left";
                    }
                    var ppp = rgh.popup(x, y, label, side, 1),
                        anim = Raphael.animation({
                            path: ppp.path,
                            transform: ["t", ppp.dx, ppp.dy]
                        }, 200 * is_label_visible);
                    lx = label[0].transform()[0][1] + ppp.dx;
                    ly = label[0].transform()[0][2] + ppp.dy;
                    frame.show().stop().animate(anim);
                    label[0].attr({text: graph_data + " gold" + (graph_data == 1 ? "" : "s")}).show().stop().animateWith(frame, anim, {transform: ["t", lx, ly]}, 200 * is_label_visible);
                    // label[1].attr({text: lbl}).show().stop().animateWith(frame, anim, {transform: ["t", lx, ly]}, 200 * is_label_visible);
                    // dot.attr("r", 6);
                    is_label_visible = true;
                }, function () {
                    // dot.attr("r", 4);
                    leave_timer = setTimeout(function () {
                        frame.hide();
                        label[0].hide();
                        // label[1].hide();
                        is_label_visible = false;
                    }, 1);
                });
            })(x, y, graph_data[i], graph_labels[i]);
        }
        // p = p.concat([x, y, x, y]);
        // bgpp = bgpp.concat([x, y, x, y, "L", x, height - bottomgutter, "z"]);
        // path.attr({path: p});
        // bgp.attr({path: bgpp});
        frame.toFront();
        label[0].toFront();
        // label[1].toFront();
        blanket.toFront();
    }
    redrawGraph();
    
    //GRAPH END
    
    var bstateMap = [];
    bstateMap['tower'] = [];
    bstateMap['building'] = [];
    bstateMap['tower']['dire'] = [];
    bstateMap['tower']['radiant'] = [];
    bstateMap['building']['dire'] = [];
    bstateMap['building']['radiant'] = [];
    bstateMap['tower']['dire']['top'] = [];
    bstateMap['tower']['dire']['mid'] = [];
    bstateMap['tower']['dire']['bot'] = [];
    bstateMap['tower']['dire']['base'] = [];
    bstateMap['tower']['radiant']['top'] = [];
    bstateMap['tower']['radiant']['mid'] = [];
    bstateMap['tower']['radiant']['bot'] = [];
    bstateMap['tower']['radiant']['base'] = [];
    bstateMap['building']['dire']['top'] = [];
    bstateMap['building']['dire']['mid'] = [];
    bstateMap['building']['dire']['bot'] = [];
    bstateMap['building']['radiant']['top'] = [];
    bstateMap['building']['radiant']['mid'] = [];
    bstateMap['building']['radiant']['bot'] = [];
    bstateMap_renew();



    var r = Raphael("canvas", 226, 226),
        topPadding = 14,
        bottomPadding = 0,
        leftPadding = 14,
        rightPadding = 0,
        midPadding = 4,
        buildingSize = 10,
        towerSize = 10,
        towerPadding = 8,
        tower1Modifier = 5,
        tower2Modifier = 12,
        midLineModifier = towerSize/2+towerPadding/6,
        midTowerModifier = buildingSize+towerPadding+midPadding/2,
        baseTowerModifier = towerSize,
        width = 194,
        height = 194,
        direColor = "#FD3F38",
        radiantColor = "#6EC34A",
        animateColor = "#808080",
        lineColor = "#808080",
        animationRepeat = 7,
        animationTime = 500;
    var path = [
        //top border line
        "M", Math.round(leftPadding) + .5, Math.round(topPadding) + .5, "H", Math.round(leftPadding+(width / 4)-(towerSize+towerPadding)) + .5,
        "M", Math.round(leftPadding+(width / 4)) + .5, Math.round(topPadding) + .5, "H", Math.round(leftPadding+(width / 4)*2-(towerSize+towerPadding)) + .5,
        "M", Math.round(leftPadding+(width / 4)*2) + .5, Math.round(topPadding) + .5, "H", Math.round(leftPadding+(width / 4)*3-(towerSize+towerPadding)) + .5,
        //left border line
        "M", Math.round(leftPadding) + .5, Math.round(topPadding) + .5, "V", Math.round(topPadding+(height / 4)-(towerSize+towerPadding)) + .5,
        "M", Math.round(leftPadding) + .5, Math.round(topPadding+(height / 4)) + .5, "V", Math.round(topPadding+(height / 4)*2-(towerSize+towerPadding)) + .5,
        "M", Math.round(leftPadding) + .5, Math.round(topPadding+(height / 4)*2) + .5, "V", Math.round(topPadding+(height / 4)*3-(towerSize+towerPadding)) + .5,

    ];
    r.path(path.join(" ")).attr({stroke: lineColor});

    //top
    /*t1*/tower_dire_top_1 = r.circle(Math.round(leftPadding+(width / 4)-(towerSize+towerPadding)/2) + .5, Math.round(topPadding) + .5, Math.round(towerSize / 2)).attr({stroke: direColor, fill:  direColor});
    /*t2*/tower_dire_top_2 = r.circle(Math.round(leftPadding+(width / 4)*2-(towerSize+towerPadding)/2) + .5, Math.round(topPadding) + .5, Math.round(towerSize / 2)).attr({stroke: direColor, fill:  direColor});
    /*t3*/tower_dire_top_3 = r.circle(Math.round(leftPadding+(width / 4)*3-(towerSize+towerPadding)/2) + .5, Math.round(topPadding) + .5, Math.round(towerSize / 2)).attr({stroke: direColor, fill:  direColor});

    //left
    /*t1*/tower_radiant_top_1 = r.circle(Math.round(leftPadding) + .5, Math.round(topPadding+(height / 4)-(towerSize+towerPadding)/2) + .5, Math.round(towerSize / 2)).attr({stroke: radiantColor, fill:  radiantColor});
    /*t2*/tower_radiant_top_2 = r.circle(Math.round(leftPadding) + .5, Math.round(topPadding+(height / 4)*2-(towerSize+towerPadding)/2) + .5, Math.round(towerSize / 2)).attr({stroke: radiantColor, fill:  radiantColor});
    /*t3*/tower_radiant_top_3 = r.circle(Math.round(leftPadding) + .5, Math.round(topPadding+(height / 4)*3-(towerSize+towerPadding)/2) + .5, Math.round(towerSize / 2)).attr({stroke: radiantColor, fill:  radiantColor});

    //bot left
    building_radiant_top_1 = r.rect(Math.round(leftPadding-buildingSize/2-(buildingSize+towerPadding)/2) + .5, Math.round(topPadding+(height / 4)*3+towerPadding/2-buildingSize/2) + .5, buildingSize, buildingSize).attr({stroke: radiantColor, fill:  radiantColor});
    building_radiant_top_2 = r.rect(Math.round(leftPadding-buildingSize/2+(buildingSize+towerPadding)/2) + .5, Math.round(topPadding+(height / 4)*3+towerPadding/2-buildingSize/2) + .5, buildingSize, buildingSize).attr({stroke: radiantColor, fill:  radiantColor});
    building_radiant_mid_1 = r.rect(Math.round(leftPadding-buildingSize/2+(buildingSize+towerPadding)/2+midTowerModifier)+ + .5, Math.round(topPadding+(height / 4)*3+towerPadding/2-buildingSize/2) + .5, buildingSize, buildingSize).attr({stroke: radiantColor, fill:  radiantColor});

    //top left
    building_dire_top_1 = r.rect(Math.round(leftPadding+(width / 4)*3+towerPadding/2-buildingSize/2) + .5, Math.round(topPadding-buildingSize/2-(buildingSize+towerPadding)/2) + .5, buildingSize, buildingSize).attr({stroke: direColor, fill:  direColor});
    building_dire_top_2 = r.rect(Math.round(leftPadding+(width / 4)*3+towerPadding/2-buildingSize/2) + .5, Math.round(topPadding-buildingSize/2+(buildingSize+towerPadding)/2) + .5, buildingSize, buildingSize).attr({stroke: direColor, fill:  direColor});
    building_dire_mid_1 = r.rect(Math.round(leftPadding+(width / 4)*3+towerPadding/2-buildingSize/2) + .5, Math.round(topPadding-buildingSize/2+(buildingSize+towerPadding)/2+midTowerModifier) + .5, buildingSize, buildingSize).attr({stroke: direColor, fill:  direColor});

    // -----------
    var mirrorWidth = width+leftPadding+midPadding-2,
    mirrorHeight = height+topPadding+midPadding-2;
    var path = [
        //bottom border line
        "M", Math.round(mirrorWidth) + .5, Math.round(mirrorHeight) + .5, "H", Math.round(mirrorWidth-(width / 4)+(towerSize+towerPadding)) + .5,
        "M", Math.round(mirrorWidth-(width / 4)) + .5, Math.round(mirrorHeight) + .5, "H", Math.round(mirrorWidth-(width / 4)*2+(towerSize+towerPadding)) + .5,
        "M", Math.round(mirrorWidth-(width / 4)*2) + .5, Math.round(mirrorHeight) + .5, "H", Math.round(mirrorWidth-(width / 4)*3+(towerSize+towerPadding)) + .5,
        //right border line
        "M", Math.round(mirrorWidth) + .5, Math.round(mirrorHeight) + .5, "V", Math.round(mirrorHeight-(height / 4)+(towerSize+towerPadding)) + .5,
        "M", Math.round(mirrorWidth) + .5, Math.round(mirrorHeight-(height / 4)) + .5, "V", Math.round(mirrorHeight-(height / 4)*2+(towerSize+towerPadding)) + .5,
        "M", Math.round(mirrorWidth) + .5, Math.round(mirrorHeight-(height / 4)*2) + .5, "V", Math.round(mirrorHeight-(height / 4)*3+(towerSize+towerPadding)) + .5,

    ];
    r.path(path.join(" ")).attr({stroke: lineColor});

    //bot
    /*t1*/tower_radiant_bot_1 = r.circle(Math.round(mirrorWidth-(width / 4)+(towerSize+towerPadding)/2) + .5, Math.round(mirrorHeight) + .5, Math.round(towerSize / 2)).attr({stroke: radiantColor, fill:  radiantColor});
    /*t2*/tower_radiant_bot_2 = r.circle(Math.round(mirrorWidth-(width / 4)*2+(towerSize+towerPadding)/2) + .5, Math.round(mirrorHeight) + .5, Math.round(towerSize / 2)).attr({stroke: radiantColor, fill:  radiantColor});
    /*t3*/tower_radiant_bot_3 = r.circle(Math.round(mirrorWidth-(width / 4)*3+(towerSize+towerPadding)/2) + .5, Math.round(mirrorHeight) + .5, Math.round(towerSize / 2)).attr({stroke: radiantColor, fill:  radiantColor});

    //right
    /*t1*/tower_dire_bot_1 = r.circle(Math.round(mirrorWidth) + .5, Math.round(mirrorHeight-(height / 4)+(towerSize+towerPadding)/2) + .5, Math.round(towerSize / 2)).attr({stroke: direColor, fill:  direColor});
    /*t2*/tower_dire_bot_2 = r.circle(Math.round(mirrorWidth) + .5, Math.round(mirrorHeight-(height / 4)*2+(towerSize+towerPadding)/2) + .5, Math.round(towerSize / 2)).attr({stroke: direColor, fill:  direColor});
    /*t3*/tower_dire_bot_3 = r.circle(Math.round(mirrorWidth) + .5, Math.round(mirrorHeight-(height / 4)*3+(towerSize+towerPadding)/2) + .5, Math.round(towerSize / 2)).attr({stroke: direColor, fill:  direColor});
    
    //bot right
    building_radiant_bot_1 = r.rect(Math.round(mirrorWidth-(width / 4)*3+(towerSize+towerPadding)/2-buildingSize/2-buildingSize-towerPadding/2) + .5, Math.round(mirrorHeight-buildingSize/2-(buildingSize+towerPadding)/2) + .5, buildingSize, buildingSize).attr({stroke: radiantColor, fill:  radiantColor});
    building_radiant_bot_2 = r.rect(Math.round(mirrorWidth-(width / 4)*3+(towerSize+towerPadding)/2-buildingSize/2-buildingSize-towerPadding/2) + .5, Math.round(mirrorHeight-buildingSize/2+(buildingSize+towerPadding)/2) + .5, buildingSize, buildingSize).attr({stroke: radiantColor, fill:  radiantColor});
    building_radiant_mid_2 = r.rect(Math.round(mirrorWidth-(width / 4)*3+(towerSize+towerPadding)/2-buildingSize/2-buildingSize-towerPadding/2) + .5, Math.round(mirrorHeight-buildingSize/2-(buildingSize+towerPadding)/2-midTowerModifier) + .5, buildingSize, buildingSize).attr({stroke: radiantColor, fill:  radiantColor});
    
    //top right
    building_dire_bot_1 = r.rect(Math.round(mirrorWidth-buildingSize/2-(buildingSize+towerPadding)/2) + .5, Math.round(mirrorHeight-(height / 4)*3+(towerSize+towerPadding)/2-buildingSize/2-buildingSize-towerPadding/2) + .5, buildingSize, buildingSize).attr({stroke: direColor, fill:  direColor});
    building_dire_bot_2 = r.rect(Math.round(mirrorWidth-buildingSize/2+(buildingSize+towerPadding)/2) + .5, Math.round(mirrorHeight-(height / 4)*3+(towerSize+towerPadding)/2-buildingSize/2-buildingSize-towerPadding/2) + .5, buildingSize, buildingSize).attr({stroke: direColor, fill:  direColor});
    building_dire_mid_2 = r.rect(Math.round(mirrorWidth-buildingSize/2-(buildingSize+towerPadding)/2-midTowerModifier) + .5, Math.round(mirrorHeight-(height / 4)*3+(towerSize+towerPadding)/2-buildingSize/2-buildingSize-towerPadding/2) + .5, buildingSize, buildingSize).attr({stroke: direColor, fill:  direColor});
    
    //mid left
    /*t3*/tower_radiant_mid_3 = r.circle(Math.round(mirrorWidth-(width / 4)*3+(towerSize+towerPadding)/2-buildingSize-towerPadding/2) + .5, Math.round(topPadding+(height / 4)*3+towerPadding/2) + .5, Math.round(towerSize / 2)).attr({stroke: radiantColor, fill:  radiantColor});
    /*t2*/tower_radiant_mid_2 = r.circle(Math.round(mirrorWidth-(width / 4)*3+(towerSize+towerPadding)/2-buildingSize-towerPadding/2+width/tower2Modifier) + .5, Math.round(topPadding+(height / 4)*3+towerPadding/2-height/tower2Modifier) + .5, Math.round(towerSize / 2)).attr({stroke: radiantColor, fill:  radiantColor});
    /*t1*/tower_radiant_mid_1 = r.circle(Math.round(mirrorWidth-(width / 4)*3+(towerSize+towerPadding)/2-buildingSize-towerPadding/2+width/tower1Modifier) + .5, Math.round(topPadding+(height / 4)*3+towerPadding/2-height/tower1Modifier) + .5, Math.round(towerSize / 2)).attr({stroke: radiantColor, fill:  radiantColor});

    //mid right
    /*t3*/tower_dire_mid_3 = r.circle(Math.round(leftPadding+(width / 4)*3+towerPadding/2) + .5, Math.round(mirrorHeight-(height / 4)*3+(towerSize+towerPadding)/2-buildingSize-towerPadding/2) + .5, Math.round(towerSize / 2)).attr({stroke: direColor, fill:  direColor});
    /*t2*/tower_dire_mid_2 = r.circle(Math.round(leftPadding+(width / 4)*3+towerPadding/2-width/tower2Modifier) + .5, Math.round(mirrorHeight-(height / 4)*3+(towerSize+towerPadding)/2-buildingSize-towerPadding/2+height/tower2Modifier) + .5, Math.round(towerSize / 2)).attr({stroke: direColor, fill:  direColor});
    /*t1*/tower_dire_mid_1 = r.circle(Math.round(leftPadding+(width / 4)*3+towerPadding/2-width/tower1Modifier) + .5, Math.round(mirrorHeight-(height / 4)*3+(towerSize+towerPadding)/2-buildingSize-towerPadding/2+height/tower1Modifier) + .5, Math.round(towerSize / 2)).attr({stroke: direColor, fill:  direColor});
    
    //bot base
    tower_radiant_base_1 = r.circle(Math.round(leftPadding+baseTowerModifier) + .5, Math.round(mirrorHeight) + .5, Math.round(towerSize / 2)).attr({stroke: radiantColor, fill:  radiantColor});
    tower_radiant_base_2 = r.circle(Math.round(leftPadding) + .5, Math.round(mirrorHeight-baseTowerModifier) + .5, Math.round(towerSize / 2)).attr({stroke: radiantColor, fill:  radiantColor});
    

    //top base
    tower_dire_base_1 = r.circle(Math.round(mirrorWidth-baseTowerModifier) + .5, Math.round(topPadding) + .5, Math.round(towerSize / 2)).attr({stroke: direColor, fill:  direColor});
    tower_dire_base_2 = r.circle(Math.round(mirrorWidth) + .5, Math.round(topPadding+baseTowerModifier) + .5, Math.round(towerSize / 2)).attr({stroke: direColor, fill:  direColor});
    
    //mid line
    r.path([
        "M",Math.round(mirrorWidth-(width / 4)*3+(towerSize+towerPadding)/2-buildingSize-towerPadding/2+midLineModifier) + .5,
        Math.round(topPadding+(height / 4)*3+towerPadding/2-midLineModifier) + .5,
        "L",Math.round(mirrorWidth-(width / 4)*3+(towerSize+towerPadding)/2-buildingSize-towerPadding/2+width/tower2Modifier-midLineModifier) + .5,
        Math.round(topPadding+(height / 4)*3+towerPadding/2-height/tower2Modifier+midLineModifier) + .5
        ].join(" ")).attr({stroke: lineColor});
    r.path([
        "M",Math.round(mirrorWidth-(width / 4)*3+(towerSize+towerPadding)/2-buildingSize-towerPadding/2+width/tower2Modifier+midLineModifier) + .5,
        Math.round(topPadding+(height / 4)*3+towerPadding/2-height/tower2Modifier-midLineModifier) + .5,
        "L",Math.round(mirrorWidth-(width / 4)*3+(towerSize+towerPadding)/2-buildingSize-towerPadding/2+width/tower1Modifier-midLineModifier) + .5,
        Math.round(topPadding+(height / 4)*3+towerPadding/2-height/tower1Modifier+midLineModifier) + .5
        ].join(" ")).attr({stroke: lineColor});
    r.path([
        "M",Math.round(mirrorWidth-(width / 4)*3+(towerSize+towerPadding)/2-buildingSize-towerPadding/2+width/tower1Modifier+midLineModifier) + .5,
        Math.round(topPadding+(height / 4)*3+towerPadding/2-height/tower1Modifier-midLineModifier) + .5,
        "L",Math.round(leftPadding+(width / 4)*3+towerPadding/2-width/tower1Modifier-midLineModifier) + .5,
        Math.round(mirrorHeight-(height / 4)*3+(towerSize+towerPadding)/2-buildingSize-towerPadding/2+height/tower1Modifier+midLineModifier) + .5
        ].join(" ")).attr({stroke: lineColor});
    r.path([
        "M",Math.round(leftPadding+(width / 4)*3+towerPadding/2-width/tower1Modifier+midLineModifier) + .5,
        Math.round(mirrorHeight-(height / 4)*3+(towerSize+towerPadding)/2-buildingSize-towerPadding/2+height/tower1Modifier-midLineModifier) + .5,
        "L",Math.round(leftPadding+(width / 4)*3+towerPadding/2-width/tower2Modifier-midLineModifier) + .5,
        Math.round(mirrorHeight-(height / 4)*3+(towerSize+towerPadding)/2-buildingSize-towerPadding/2+height/tower2Modifier+midLineModifier) + .5
        ].join(" ")).attr({stroke: lineColor});
    r.path([
        "M",Math.round(leftPadding+(width / 4)*3+towerPadding/2-width/tower2Modifier+midLineModifier) + .5,
        Math.round(mirrorHeight-(height / 4)*3+(towerSize+towerPadding)/2-buildingSize-towerPadding/2+height/tower2Modifier-midLineModifier) + .5,
        "L",Math.round(leftPadding+(width / 4)*3+towerPadding/2-midLineModifier) + .5,
        Math.round(mirrorHeight-(height / 4)*3+(towerSize+towerPadding)/2-buildingSize-towerPadding/2+midLineModifier) + .5
        ].join(" ")).attr({stroke: lineColor});
   
function bstateMap_renew()
{
    bstateMap['tower']['dire']['top'][1] = 0;
    bstateMap['tower']['dire']['top'][2] = 0;
    bstateMap['tower']['dire']['top'][3] = 0;
    bstateMap['tower']['radiant']['top'][1] = 0;
    bstateMap['tower']['radiant']['top'][2] = 0;
    bstateMap['tower']['radiant']['top'][3] = 0;
    bstateMap['tower']['dire']['mid'][1] = 0;
    bstateMap['tower']['dire']['mid'][2] = 0;
    bstateMap['tower']['dire']['mid'][3] = 0;
    bstateMap['tower']['radiant']['mid'][1] = 0;
    bstateMap['tower']['radiant']['mid'][2] = 0;
    bstateMap['tower']['radiant']['mid'][3] = 0;
    bstateMap['tower']['dire']['bot'][1] = 0;
    bstateMap['tower']['dire']['bot'][2] = 0;
    bstateMap['tower']['dire']['bot'][3] = 0;
    bstateMap['tower']['radiant']['bot'][1] = 0;
    bstateMap['tower']['radiant']['bot'][2] = 0;
    bstateMap['tower']['radiant']['bot'][3] = 0;

    bstateMap['tower']['dire']['base'][1] = 0;
    bstateMap['tower']['dire']['base'][2] = 0;
    bstateMap['tower']['radiant']['base'][1] = 0;
    bstateMap['tower']['radiant']['base'][2] = 0;

    bstateMap['building']['dire']['top'][1] = 0;
    bstateMap['building']['dire']['top'][2] = 0;
    bstateMap['building']['radiant']['top'][1] = 0;
    bstateMap['building']['radiant']['top'][2] = 0;
    bstateMap['building']['dire']['mid'][1] = 0;
    bstateMap['building']['dire']['mid'][2] = 0;
    bstateMap['building']['radiant']['mid'][1] = 0;
    bstateMap['building']['radiant']['mid'][2] = 0;
    bstateMap['building']['dire']['bot'][1] = 0;
    bstateMap['building']['dire']['bot'][2] = 0;
    bstateMap['building']['radiant']['bot'][1] = 0;
    bstateMap['building']['radiant']['bot'][2] = 0;
}

function building_state_renew()
{
    bstateMap_renew();
    //top
    /*t1*/tower_dire_top_1.attr({stroke: direColor, fill:  direColor});
    /*t2*/tower_dire_top_2.attr({stroke: direColor, fill:  direColor});
    /*t3*/tower_dire_top_3.attr({stroke: direColor, fill:  direColor});

    //left
    /*t1*/tower_radiant_top_1.attr({stroke: radiantColor, fill:  radiantColor});
    /*t2*/tower_radiant_top_2.attr({stroke: radiantColor, fill:  radiantColor});
    /*t3*/tower_radiant_top_3.attr({stroke: radiantColor, fill:  radiantColor});

    //bot left
    building_radiant_top_1.attr({stroke: radiantColor, fill:  radiantColor});
    building_radiant_top_2.attr({stroke: radiantColor, fill:  radiantColor});
    building_radiant_mid_1.attr({stroke: radiantColor, fill:  radiantColor});

    //top left
    building_dire_top_1.attr({stroke: direColor, fill:  direColor});
    building_dire_top_2.attr({stroke: direColor, fill:  direColor});
    building_dire_mid_1.attr({stroke: direColor, fill:  direColor});

    //bot
    /*t1*/tower_radiant_bot_1.attr({stroke: radiantColor, fill:  radiantColor});
    /*t2*/tower_radiant_bot_2.attr({stroke: radiantColor, fill:  radiantColor});
    /*t3*/tower_radiant_bot_3.attr({stroke: radiantColor, fill:  radiantColor});

    //right
    /*t1*/tower_dire_bot_1.attr({stroke: direColor, fill:  direColor});
    /*t2*/tower_dire_bot_2.attr({stroke: direColor, fill:  direColor});
    /*t3*/tower_dire_bot_3.attr({stroke: direColor, fill:  direColor});
    
    //bot right
    building_radiant_bot_1.attr({stroke: radiantColor, fill:  radiantColor});
    building_radiant_bot_2.attr({stroke: radiantColor, fill:  radiantColor});
    building_radiant_mid_2.attr({stroke: radiantColor, fill:  radiantColor});
    
    //top right
    building_dire_bot_1.attr({stroke: direColor, fill:  direColor});
    building_dire_bot_2.attr({stroke: direColor, fill:  direColor});
    building_dire_mid_2.attr({stroke: direColor, fill:  direColor});
    
    //mid left
    /*t3*/tower_radiant_mid_3.attr({stroke: radiantColor, fill:  radiantColor});
    /*t2*/tower_radiant_mid_2.attr({stroke: radiantColor, fill:  radiantColor});
    /*t1*/tower_radiant_mid_1.attr({stroke: radiantColor, fill:  radiantColor});

    //mid right
    /*t3*/tower_dire_mid_3.attr({stroke: direColor, fill:  direColor});
    /*t2*/tower_dire_mid_2.attr({stroke: direColor, fill:  direColor});
    /*t1*/tower_dire_mid_1.attr({stroke: direColor, fill:  direColor});
    
    //bot base
    tower_radiant_base_1.attr({stroke: radiantColor, fill:  radiantColor});
    tower_radiant_base_2.attr({stroke: radiantColor, fill:  radiantColor});
    
    //top base
    tower_dire_base_1.attr({stroke: direColor, fill:  direColor});
    tower_dire_base_2.attr({stroke: direColor, fill:  direColor});                
}
