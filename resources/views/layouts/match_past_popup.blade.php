<div class="match-open match-past" id="match_display_container_past">
    <div class="match-header">
        <div class="leftTeam" id="radiant_team_container">
            <span class="data">
                <div id="match_display_radiant_score_container_past"></div>
                <i id="match_display_radiant_lead_container_past">
                </i>
            </span>

            <div class="teamImg">
                <img id="match_display_radiant_team_logo_container_past" src="" alt="">
            </div>
        </div>

        <div class="centerTime"><span class="timeTeam" id="match_display_time_container_past"></span></div>

        <div class="rightTeam" id="dire_team_container">
            <span class="data">
                <div id="match_display_dire_score_container_past"></div>
                <i id="match_display_dire_lead_container_past"></i>
            </span>

            <div class="teamImg">
                <img id="match_display_dire_team_logo_container_past" src="" alt="">
            </div>
        </div>
    </div>

    <div class="match-details">
        <div class="leftTeam">
            <ul>
                @for ($i = 0; $i < 5; $i++)
                    <li>
                        <p><a href="" class="namePl" id="match_display_player_{{$i}}_name_container_past"></a></p>
                        <div class="size57 hero-avatar" id="match_display_player_{{$i}}_avatar_container_past" style="">
                            <a href=""></a>
                        </div>
                        <div class="dopInfo">
                            <ul class="listG">
                                <li class="g" id="match_display_player_{{$i}}_kill_container_past"></li>
                                <li class="r" id="match_display_player_{{$i}}_death_container_past"></li>
                                <li class="b" id="match_display_player_{{$i}}_assists_container_past"></li>
                            </ul>
                        </div>
                        <span class="ellipse" id="match_display_player_{{$i}}_level_container_past"></span>
                    </li>
                @endfor
            </ul>
        </div>

        <div  class="centerDetails">
            <div id="graphInPopup">
                <p id="graph_data" style="display: none"></p>
                <p id="graph_labels" style="display: none"></p>
                <p id="building" style="display: none"></p>
                <div class="graphDiv">

                    <div id="holderP"></div>
                </div>

                <div class="mapDiv">
                    <div id="canvasP"></div>
                </div>
                <script src="/js/bstateInpopup.js"></script>
                <script>

                    function change_past_building_state(value, force=true)
                    {
                        if (parseInt(value['R']['bot'][0]) == 1)
                        {
                            if (force)
                            {
                                bstateMap['tower']['radiant']['bot'][1] = 1;
                                tower_radiant_bot_1.attr({stroke: animateColor, fill:  animateColor});
                            } else
                            {
                                if (bstateMap['tower']['radiant']['bot'][1] == 0)
                                {
                                    bstateMap['tower']['radiant']['bot'][1] = 1;
                                    anim = Raphael.animation({stroke: radiantColor, fill:  radiantColor}, animationTime, "easeIn", function () {
                                        tower_radiant_bot_1.animate({stroke: animateColor, fill:  animateColor}, animationTime, "easeOut");
                                    }).delay(animationTime).repeat(animationRepeat);
                                    tower_radiant_bot_1.animate(anim);
                                }
                            }
                        }
                        if (parseInt(value['R']['bot'][1]) == 1)
                        {
                            if (force)
                            {
                                bstateMap['tower']['radiant']['bot'][2] = 1;
                                tower_radiant_bot_2.attr({stroke: animateColor, fill:  animateColor});
                            } else
                            {
                                if (bstateMap['tower']['radiant']['bot'][2] == 0)
                                {
                                    bstateMap['tower']['radiant']['bot'][2] = 1;
                                    anim = Raphael.animation({stroke: radiantColor, fill:  radiantColor}, animationTime, "easeIn", function () {
                                        tower_radiant_bot_2.animate({stroke: animateColor, fill:  animateColor}, animationTime, "easeOut");
                                    }).delay(animationTime).repeat(animationRepeat);
                                    tower_radiant_bot_2.animate(anim);
                                }
                            }
                        }
                        if (parseInt(value['R']['bot'][2]) == 1)
                        {
                            if (force)
                            {
                                bstateMap['tower']['radiant']['bot'][3] = 1;
                                tower_radiant_bot_3.attr({stroke: animateColor, fill:  animateColor});
                            } else
                            {
                                if (bstateMap['tower']['radiant']['bot'][3] == 0)
                                {
                                    bstateMap['tower']['radiant']['bot'][3] = 1;
                                    anim = Raphael.animation({stroke: radiantColor, fill:  radiantColor}, animationTime, "easeIn", function () {
                                        tower_radiant_bot_3.animate({stroke: animateColor, fill:  animateColor}, animationTime, "easeOut");
                                    }).delay(animationTime).repeat(animationRepeat);
                                    tower_radiant_bot_3.animate(anim);
                                }
                            }
                        }
                        if (parseInt(value['R']['bot'][3]) == 1)
                        {
                            if (force)
                            {
                                bstateMap['building']['radiant']['bot'][1] = 1;
                                building_radiant_bot_1.attr({stroke: animateColor, fill:  animateColor});
                            } else
                            {
                                if (bstateMap['building']['radiant']['bot'][1] == 0)
                                {
                                    bstateMap['building']['radiant']['bot'][1] = 1;
                                    anim = Raphael.animation({stroke: radiantColor, fill:  radiantColor}, animationTime, "easeIn", function () {
                                        building_radiant_bot_1.animate({stroke: animateColor, fill:  animateColor}, animationTime, "easeOut");
                                    }).delay(animationTime).repeat(animationRepeat);
                                    building_radiant_bot_1.animate(anim);
                                }
                            }
                        }
                        if (parseInt(value['R']['bot'][4]) == 1)
                        {
                            if (force)
                            {
                                bstateMap['building']['radiant']['bot'][2] = 1;
                                building_radiant_bot_2.attr({stroke: animateColor, fill:  animateColor});
                            } else
                            {
                                if (bstateMap['building']['radiant']['bot'][2] == 0)
                                {
                                    bstateMap['building']['radiant']['bot'][2] = 1;
                                    anim = Raphael.animation({stroke: radiantColor, fill:  radiantColor}, animationTime, "easeIn", function () {
                                        building_radiant_bot_2.animate({stroke: animateColor, fill:  animateColor}, animationTime, "easeOut");
                                    }).delay(animationTime).repeat(animationRepeat);
                                    building_radiant_bot_2.animate(anim);
                                }
                            }
                        }
                        if (parseInt(value['R']['mid'][0]) == 1)
                        {
                            if (force)
                            {
                                bstateMap['tower']['radiant']['mid'][1] = 1;
                                tower_radiant_mid_1.attr({stroke: animateColor, fill:  animateColor});
                            } else
                            {
                                if (bstateMap['tower']['radiant']['mid'][1] == 0)
                                {
                                    bstateMap['tower']['radiant']['mid'][1] = 1;
                                    anim = Raphael.animation({stroke: radiantColor, fill:  radiantColor}, animationTime, "easeIn", function () {
                                        tower_radiant_mid_1.animate({stroke: animateColor, fill:  animateColor}, animationTime, "easeOut");
                                    }).delay(animationTime).repeat(animationRepeat);
                                    tower_radiant_mid_1.animate(anim);
                                }
                            }
                        }
                        if (parseInt(value['R']['mid'][1]) == 1)
                        {
                            if (force)
                            {
                                bstateMap['tower']['radiant']['mid'][2] = 1;
                                tower_radiant_mid_2.attr({stroke: animateColor, fill:  animateColor});
                            } else
                            {
                                if (bstateMap['tower']['radiant']['mid'][2] == 0)
                                {
                                    bstateMap['tower']['radiant']['mid'][2] = 1;
                                    anim = Raphael.animation({stroke: radiantColor, fill:  radiantColor}, animationTime, "easeIn", function () {
                                        tower_radiant_mid_2.animate({stroke: animateColor, fill:  animateColor}, animationTime, "easeOut");
                                    }).delay(animationTime).repeat(animationRepeat);
                                    tower_radiant_mid_2.animate(anim);
                                }
                            }
                        }
                        if (parseInt(value['R']['mid'][2]) == 1)
                        {
                            if (force)
                            {
                                bstateMap['tower']['radiant']['mid'][3] = 1;
                                tower_radiant_mid_3.attr({stroke: animateColor, fill:  animateColor});
                            } else
                            {
                                if (bstateMap['tower']['radiant']['mid'][3] == 0)
                                {
                                    bstateMap['tower']['radiant']['mid'][3] = 1;
                                    anim = Raphael.animation({stroke: radiantColor, fill:  radiantColor}, animationTime, "easeIn", function () {
                                        tower_radiant_mid_3.animate({stroke: animateColor, fill:  animateColor}, animationTime, "easeOut");
                                    }).delay(animationTime).repeat(animationRepeat);
                                    tower_radiant_mid_3.animate(anim);
                                }
                            }
                        }
                        if (parseInt(value['R']['mid'][3]) == 1)
                        {
                            if (force)
                            {
                                bstateMap['building']['radiant']['mid'][1] = 1;
                                building_radiant_mid_1.attr({stroke: animateColor, fill:  animateColor});
                            } else
                            {
                                if (bstateMap['building']['radiant']['mid'][1] == 0)
                                {
                                    bstateMap['building']['radiant']['mid'][1] = 1;
                                    anim = Raphael.animation({stroke: radiantColor, fill:  radiantColor}, animationTime, "easeIn", function () {
                                        building_radiant_mid_1.animate({stroke: animateColor, fill:  animateColor}, animationTime, "easeOut");
                                    }).delay(animationTime).repeat(animationRepeat);
                                    building_radiant_mid_1.animate(anim);
                                }
                            }
                        }
                        if (parseInt(value['R']['mid'][4]) == 1)
                        {
                            if (force)
                            {
                                bstateMap['building']['radiant']['mid'][2] = 1;
                                building_radiant_mid_2.attr({stroke: animateColor, fill:  animateColor});
                            } else
                            {
                                if (bstateMap['building']['radiant']['mid'][2] == 0)
                                {
                                    bstateMap['building']['radiant']['mid'][2] = 1;
                                    anim = Raphael.animation({stroke: radiantColor, fill:  radiantColor}, animationTime, "easeIn", function () {
                                        building_radiant_mid_2.animate({stroke: animateColor, fill:  animateColor}, animationTime, "easeOut");
                                    }).delay(animationTime).repeat(animationRepeat);
                                    building_radiant_mid_2.animate(anim);
                                }
                            }
                        }
                        if (parseInt(value['R']['top'][0]) == 1)
                        {
                            if (force)
                            {
                                bstateMap['tower']['radiant']['top'][1] = 1;
                                tower_radiant_top_1.attr({stroke: animateColor, fill:  animateColor});
                            } else
                            {
                                if (bstateMap['tower']['radiant']['top'][1] == 0)
                                {
                                    bstateMap['tower']['radiant']['top'][1] = 1;
                                    anim = Raphael.animation({stroke: radiantColor, fill:  radiantColor}, animationTime, "easeIn", function () {
                                        tower_radiant_top_1.animate({stroke: animateColor, fill:  animateColor}, animationTime, "easeOut");
                                    }).delay(animationTime).repeat(animationRepeat);
                                    tower_radiant_top_1.animate(anim);
                                }
                            }
                        }
                        if (parseInt(value['R']['top'][1]) == 1)
                        {
                            if (force)
                            {
                                bstateMap['tower']['radiant']['top'][2] = 1;
                                tower_radiant_top_2.attr({stroke: animateColor, fill:  animateColor});
                            } else
                            {
                                if (bstateMap['tower']['radiant']['top'][2] == 0)
                                {
                                    bstateMap['tower']['radiant']['top'][2] = 1;
                                    anim = Raphael.animation({stroke: radiantColor, fill:  radiantColor}, animationTime, "easeIn", function () {
                                        tower_radiant_top_2.animate({stroke: animateColor, fill:  animateColor}, animationTime, "easeOut");
                                    }).delay(animationTime).repeat(animationRepeat);
                                    tower_radiant_top_2.animate(anim);
                                }
                            }
                        }
                        if (parseInt(value['R']['top'][2]) == 1)
                        {
                            if (force)
                            {
                                bstateMap['tower']['radiant']['top'][3] = 1;
                                tower_radiant_top_3.attr({stroke: animateColor, fill:  animateColor});
                            } else
                            {
                                if (bstateMap['tower']['radiant']['top'][3] == 0)
                                {
                                    bstateMap['tower']['radiant']['top'][3] = 1;
                                    anim = Raphael.animation({stroke: radiantColor, fill:  radiantColor}, animationTime, "easeIn", function () {
                                        tower_radiant_top_3.animate({stroke: animateColor, fill:  animateColor}, animationTime, "easeOut");
                                    }).delay(animationTime).repeat(animationRepeat);
                                    tower_radiant_top_3.animate(anim);
                                }
                            }
                        }
                        if (parseInt(value['R']['top'][3]) == 1)
                        {
                            if (force)
                            {
                                bstateMap['building']['radiant']['top'][1] = 1;
                                building_radiant_top_1.attr({stroke: animateColor, fill:  animateColor});
                            } else
                            {
                                if (bstateMap['building']['radiant']['top'][1] == 0)
                                {
                                    bstateMap['building']['radiant']['top'][1] = 1;
                                    anim = Raphael.animation({stroke: radiantColor, fill:  radiantColor}, animationTime, "easeIn", function () {
                                        building_radiant_top_1.animate({stroke: animateColor, fill:  animateColor}, animationTime, "easeOut");
                                    }).delay(animationTime).repeat(animationRepeat);
                                    building_radiant_top_1.animate(anim);
                                }
                            }
                        }
                        if (parseInt(value['R']['top'][4]) == 1)
                        {
                            if (force)
                            {
                                bstateMap['building']['radiant']['top'][2] = 1;
                                building_radiant_top_2.attr({stroke: animateColor, fill:  animateColor});
                            } else
                            {
                                if (bstateMap['building']['radiant']['top'][2] == 0)
                                {
                                    bstateMap['building']['radiant']['top'][2] = 1;
                                    anim = Raphael.animation({stroke: radiantColor, fill:  radiantColor}, animationTime, "easeIn", function () {
                                        building_radiant_top_2.animate({stroke: animateColor, fill:  animateColor}, animationTime, "easeOut");
                                    }).delay(animationTime).repeat(animationRepeat);
                                    building_radiant_top_2.animate(anim);
                                }
                            }
                        }



                        if (parseInt(value['D']['bot'][0]) == 1)
                        {
                            if (force)
                            {
                                bstateMap['tower']['dire']['bot'][1] = 1;
                                tower_dire_bot_1.attr({stroke: animateColor, fill:  animateColor});
                            } else
                            {

                                if (bstateMap['tower']['dire']['bot'][1] == 0)
                                {
                                    bstateMap['tower']['dire']['bot'][1] = 1;
                                    anim = Raphael.animation({stroke: direColor, fill:  direColor}, animationTime, "easeIn", function () {
                                        tower_dire_bot_1.animate({stroke: animateColor, fill:  animateColor}, animationTime, "easeOut");
                                    }).delay(animationTime).repeat(animationRepeat);
                                    tower_dire_bot_1.animate(anim);
                                }
                            }
                        }
                        if (parseInt(value['D']['bot'][1]) == 1)
                        {
                            if (force)
                            {
                                bstateMap['tower']['dire']['bot'][2] = 1;
                                tower_dire_bot_2.attr({stroke: animateColor, fill:  animateColor});
                            } else
                            {
                                if (bstateMap['tower']['dire']['bot'][2] == 0)
                                {
                                    bstateMap['tower']['dire']['bot'][2] = 1;
                                    anim = Raphael.animation({stroke: direColor, fill:  direColor}, animationTime, "easeIn", function () {
                                        tower_dire_bot_2.animate({stroke: animateColor, fill:  animateColor}, animationTime, "easeOut");
                                    }).delay(animationTime).repeat(animationRepeat);
                                    tower_dire_bot_2.animate(anim);
                                }
                            }
                        }
                        if (parseInt(value['D']['bot'][2]) == 1)
                        {
                            if (force)
                            {
                                bstateMap['tower']['dire']['bot'][3] = 1;
                                tower_dire_bot_3.attr({stroke: animateColor, fill:  animateColor});
                            } else
                            {
                                if (bstateMap['tower']['dire']['bot'][3] == 0)
                                {
                                    bstateMap['tower']['dire']['bot'][3] = 1;
                                    anim = Raphael.animation({stroke: direColor, fill:  direColor}, animationTime, "easeIn", function () {
                                        tower_dire_bot_3.animate({stroke: animateColor, fill:  animateColor}, animationTime, "easeOut");
                                    }).delay(animationTime).repeat(animationRepeat);
                                    tower_dire_bot_3.animate(anim);
                                }
                            }
                        }
                        if (parseInt(value['D']['bot'][3]) == 1)
                        {
                            if (force)
                            {
                                bstateMap['building']['dire']['bot'][1] = 1;
                                building_dire_bot_1.attr({stroke: animateColor, fill:  animateColor});
                            } else
                            {
                                if (bstateMap['building']['dire']['bot'][1] == 0)
                                {
                                    bstateMap['building']['dire']['bot'][1] = 1;
                                    anim = Raphael.animation({stroke: direColor, fill:  direColor}, animationTime, "easeIn", function () {
                                        building_dire_bot_1.animate({stroke: animateColor, fill:  animateColor}, animationTime, "easeOut");
                                    }).delay(animationTime).repeat(animationRepeat);
                                    building_dire_bot_1.animate(anim);
                                }
                            }
                        }
                        if (parseInt(value['D']['bot'][4]) == 1)
                        {
                            if (force)
                            {
                                bstateMap['building']['dire']['bot'][2] = 1;
                                building_dire_bot_2.attr({stroke: animateColor, fill:  animateColor});
                            } else
                            {
                                if (bstateMap['building']['dire']['bot'][2] == 0)
                                {
                                    bstateMap['building']['dire']['bot'][2] = 1;
                                    anim = Raphael.animation({stroke: direColor, fill:  direColor}, animationTime, "easeIn", function () {
                                        building_dire_bot_2.animate({stroke: animateColor, fill:  animateColor}, animationTime, "easeOut");
                                    }).delay(animationTime).repeat(animationRepeat);
                                    building_dire_bot_2.animate(anim);
                                }
                            }
                        }
                        if (parseInt(value['D']['mid'][0]) == 1)
                        {
                            if (force)
                            {
                                bstateMap['tower']['dire']['mid'][1] = 1;
                                tower_dire_mid_1.attr({stroke: animateColor, fill:  animateColor});
                            } else
                            {
                                if (bstateMap['tower']['dire']['mid'][1] == 0)
                                {
                                    bstateMap['tower']['dire']['mid'][1] = 1;
                                    anim = Raphael.animation({stroke: direColor, fill:  direColor}, animationTime, "easeIn", function () {
                                        tower_dire_mid_1.animate({stroke: animateColor, fill:  animateColor}, animationTime, "easeOut");
                                    }).delay(animationTime).repeat(animationRepeat);
                                    tower_dire_mid_1.animate(anim);
                                }
                            }
                        }
                        if (parseInt(value['D']['mid'][1]) == 1)
                        {
                            if (force)
                            {
                                bstateMap['tower']['dire']['mid'][2] = 1;
                                tower_dire_mid_2.attr({stroke: animateColor, fill:  animateColor});
                            } else
                            {
                                if (bstateMap['tower']['dire']['mid'][2] == 0)
                                {
                                    bstateMap['tower']['dire']['mid'][2] = 1;
                                    anim = Raphael.animation({stroke: direColor, fill:  direColor}, animationTime, "easeIn", function () {
                                        tower_dire_mid_2.animate({stroke: animateColor, fill:  animateColor}, animationTime, "easeOut");
                                    }).delay(animationTime).repeat(animationRepeat);
                                    tower_dire_mid_2.animate(anim);
                                }
                            }
                        }
                        if (parseInt(value['D']['mid'][2]) == 1)
                        {
                            if (force)
                            {
                                bstateMap['tower']['dire']['mid'][3] = 1;
                                tower_dire_mid_3.attr({stroke: animateColor, fill:  animateColor});
                            } else
                            {
                                if (bstateMap['tower']['dire']['mid'][3] == 0)
                                {
                                    bstateMap['tower']['dire']['mid'][3] = 1;
                                    anim = Raphael.animation({stroke: direColor, fill:  direColor}, animationTime, "easeIn", function () {
                                        tower_dire_mid_3.animate({stroke: animateColor, fill:  animateColor}, animationTime, "easeOut");
                                    }).delay(animationTime).repeat(animationRepeat);
                                    tower_dire_mid_3.animate(anim);
                                }
                            }
                        }
                        if (parseInt(value['D']['mid'][3]) == 1)
                        {
                            if (force)
                            {
                                bstateMap['building']['dire']['mid'][1] = 1;
                                building_dire_mid_1.attr({stroke: animateColor, fill:  animateColor});
                            } else
                            {
                                if (bstateMap['building']['dire']['mid'][1] == 0)
                                {
                                    bstateMap['building']['dire']['mid'][1] = 1;
                                    anim = Raphael.animation({stroke: direColor, fill:  direColor}, animationTime, "easeIn", function () {
                                        building_dire_mid_1.animate({stroke: animateColor, fill:  animateColor}, animationTime, "easeOut");
                                    }).delay(animationTime).repeat(animationRepeat);
                                    building_dire_mid_1.animate(anim);
                                }
                            }
                        }
                        if (parseInt(value['D']['mid'][4]) == 1)
                        {
                            if (force)
                            {
                                bstateMap['building']['dire']['mid'][2] = 1;
                                building_dire_mid_2.attr({stroke: animateColor, fill:  animateColor});
                            } else
                            {
                                if (bstateMap['building']['dire']['mid'][2] == 0)
                                {
                                    bstateMap['building']['dire']['mid'][2] = 1;
                                    anim = Raphael.animation({stroke: direColor, fill:  direColor}, animationTime, "easeIn", function () {
                                        building_dire_mid_2.animate({stroke: animateColor, fill:  animateColor}, animationTime, "easeOut");
                                    }).delay(animationTime).repeat(animationRepeat);
                                    building_dire_mid_2.animate(anim);
                                }
                            }
                        }
                        if (parseInt(value['D']['top'][0]) == 1)
                        {
                            if (force)
                            {
                                bstateMap['tower']['dire']['top'][1] = 1;
                                tower_dire_top_1.attr({stroke: animateColor, fill:  animateColor});
                            } else
                            {
                                if (bstateMap['tower']['dire']['top'][1] == 0)
                                {
                                    bstateMap['tower']['dire']['top'][1] = 1;
                                    anim = Raphael.animation({stroke: direColor, fill:  direColor}, animationTime, "easeIn", function () {
                                        tower_dire_top_1.animate({stroke: animateColor, fill:  animateColor}, animationTime, "easeOut");
                                    }).delay(animationTime).repeat(animationRepeat);
                                    tower_dire_top_1.animate(anim);
                                }
                            }
                        }
                        if (parseInt(value['D']['top'][1]) == 1)
                        {
                            if (force)
                            {
                                bstateMap['tower']['dire']['top'][2] = 1;
                                tower_dire_top_2.attr({stroke: animateColor, fill:  animateColor});
                            } else
                            {
                                if (bstateMap['tower']['dire']['top'][2] == 0)
                                {
                                    bstateMap['tower']['dire']['top'][2] = 1;
                                    anim = Raphael.animation({stroke: direColor, fill:  direColor}, animationTime, "easeIn", function () {
                                        tower_dire_top_2.animate({stroke: animateColor, fill:  animateColor}, animationTime, "easeOut");
                                    }).delay(animationTime).repeat(animationRepeat);
                                    tower_dire_top_2.animate(anim);
                                }
                            }
                        }
                        if (parseInt(value['D']['top'][2]) == 1)
                        {
                            if (force)
                            {
                                bstateMap['tower']['dire']['top'][3] = 1;
                                tower_dire_top_3.attr({stroke: animateColor, fill:  animateColor});
                            } else
                            {
                                if (bstateMap['tower']['dire']['top'][3] == 0)
                                {
                                    bstateMap['tower']['dire']['top'][3] = 1;
                                    anim = Raphael.animation({stroke: direColor, fill:  direColor}, animationTime, "easeIn", function () {
                                        tower_dire_top_3.animate({stroke: animateColor, fill:  animateColor}, animationTime, "easeOut");
                                    }).delay(animationTime).repeat(animationRepeat);
                                    tower_dire_top_3.animate(anim);
                                }
                            }
                        }
                        if (parseInt(value['D']['top'][3]) == 1)
                        {
                            if (force)
                            {
                                bstateMap['building']['dire']['top'][1] = 1;
                                building_dire_top_1.attr({stroke: animateColor, fill:  animateColor});
                            } else
                            {
                                if (bstateMap['building']['dire']['top'][1] == 0)
                                {
                                    bstateMap['building']['dire']['top'][1] = 1;
                                    anim = Raphael.animation({stroke: direColor, fill:  direColor}, animationTime, "easeIn", function () {
                                        building_dire_top_1.animate({stroke: animateColor, fill:  animateColor}, animationTime, "easeOut");
                                    }).delay(animationTime).repeat(animationRepeat);
                                    building_dire_top_1.animate(anim);
                                }
                            }
                        }
                        if (parseInt(value['D']['top'][4]) == 1)
                        {
                            if (force)
                            {
                                bstateMap['building']['dire']['top'][2] = 1;
                                building_dire_top_2.attr({stroke: animateColor, fill:  animateColor});
                            } else
                            {
                                if (bstateMap['building']['dire']['top'][2] == 0)
                                {
                                    bstateMap['building']['dire']['top'][2] = 1;
                                    anim = Raphael.animation({stroke: direColor, fill:  direColor}, animationTime, "easeIn", function () {
                                        building_dire_top_2.animate({stroke: animateColor, fill:  animateColor}, animationTime, "easeOut");
                                    }).delay(animationTime).repeat(animationRepeat);
                                    building_dire_top_2.animate(anim);
                                }
                            }
                        }
                    }

                    $('.match-list-info .last').click(function(e) {
                        if($('.postMenu').hasClass('active')){
                            $('.postMenu').removeClass('active');
                            $('.open').removeClass('active');

                        }else{
                            $(this).children('.postMenu').addClass('active');
                            $(this).addClass('active');
                        }
                    });

                    $('.map_number').click(function(e) {
                        $('.match-past').addClass('active');
                        $('.past-popup-back').addClass('active');
                        e.preventDefault(); // prevents page reloading
                        let target = e.target;

                        let data = {
                            'id': target.id,
                            'map_number': target.innerText.substr(target.innerText.length - 1)
                        };
                        $('#canvasP svg').remove();
                        $.ajax({
                            method: 'GET',
                            url: "{{ route('graph_popup') }}",
                            data: data,
                            success: (resp) => {

                                $('#match_display_radiant_lead_container_past').text('');
                                $('#match_display_dire_lead_container_past').text('');

                                console.log(resp[0]['id']);
                                if(resp[0]['id'][0]['radiant_lead'] < 0){
                                    $('#match_display_dire_lead_container_past').text(resp[0]['id'][0]['radiant_lead']);
                                }else{
                                    $('#match_display_radiant_lead_container_past').text(resp[0]['id'][0]['radiant_lead']);
                                }

                                let src = "/img/team/";
                                let srcLogoRadiant = resp[0]['id'][0]['team_0'];
                                let srcLogoDire = resp[0]['id'][0]['team_1'];

                                let srcEnd = ".png";
                                $('#match_display_radiant_score_container_past').text(resp[0]['id'][0]['team_1_score']);
                                $('#match_display_dire_score_container_past').text(resp[0]['id'][0]['team_0_score']);

                                $('#match_display_radiant_team_logo_container_past').prop("src", src+srcLogoRadiant+srcEnd);
                                $('#match_display_dire_team_logo_container_past').prop("src", src+srcLogoDire+srcEnd);
                                $('#match_display_player_0_name_container_past').text(resp[0]['id'][0]['0_name']);

                                //console.log(resp[0]['id'][0]['graph_data'])

                                let playersCount = resp[0]['players'].length;
                                for (i = 0; i < playersCount; i++) {
                                    $('#match_display_player_'+i+'_name_container_past').text(resp[0]['players'][i]['name']);
                                    console.log(i);
                                }

                                for (i = 0; i < 10; i++) {
                                    $('#match_display_player_'+i+'_avatar_container_past')[0].setAttribute('style', 'background-image:'+'url(/img/heroes/'+resp[0]['id'][0][i+'_heroid']+'_vertical.png');
                                    $('#match_display_player_'+i+'_kill_container_past').text(resp[0]['id'][0][i+'_kill_count']);
                                    $('#match_display_player_'+i+'_death_container_past').text(resp[0]['id'][0][i+'_death_count']);
                                    $('#match_display_player_'+i+'_assists_container_past').text(resp[0]['id'][0][i+'_assists_count']);
                                    $('#match_display_player_'+i+'_level_container_past').text(resp[0]['id'][0][i+'_level']);   //<----
                                }

                                $('#match_display_time_container_past').text("000000");

                                building_state = JSON.parse(JSON.stringify(resp[0]['building']));
                                graph_data = JSON.parse(resp[0]['id'][0]['graph_data']);
                                graph_data.push(resp[0]['id'][0]['radiant_lead']);

                                graph_labels = [];
                                for (i = 0; i < 129; i++) {
                                    graph_labels.push('0')
                                }
                                Gdata();
                                GdataL();

                                Graph();
                                change_past_building_state(building_state);

                            },
                        });

                        $('#message').val('');

                    });

                    function Gdata(){
                        let e = document.getElementById("graph_data");
                        let graph_data = e.textContent || e.innerText;
                        return graph_data;
                    }
                    function GdataL(){
                        let el = document.getElementById("graph_labels");
                        let graph_labels_take = el.textContent || el.innerText;
                        return graph_labels_take;
                    }
                    graph_labels = [GdataL()];
                    graph_data = [Gdata(),GdataL()];




                    $('.past-popup-back').click(function(e) {
                        $('.match-past').removeClass('active');
                        $('.past-popup-back').removeClass('active');
                        $('#canvasP svg').remove();

                    });

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



                    var r = Raphael("canvasP", 226, 226),
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

                </script>
            </div>
        </div>
        <div class="rightTeam">
            <ul>
                @for ($i = 5; $i < 10; $i++)
                    <li>
                        <p><a href="" class="namePl" id="match_display_player_{{$i}}_name_container_past"></a></p>
                        <div class="dopInfo">
                            <ul class="listG">
                                <li class="g" id="match_display_player_{{$i}}_kill_container_past"></li>
                                <li class="r" id="match_display_player_{{$i}}_death_container_past"></li>
                                <li class="b" id="match_display_player_{{$i}}_assists_container_past"></li>
                            </ul>
                        </div>
                        <div class="size57 hero-avatar" id="match_display_player_{{$i}}_avatar_container_past" style="">
                            <a href=""></a>
                        </div>
                        <span class="ellipse" id="match_display_player_{{$i}}_level_container_past"></span>
                    </li>
                @endfor
            </ul>
        </div>
    </div>
</div>

