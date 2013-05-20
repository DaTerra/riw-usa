/**
 * Adobe Edge: symbol definitions
 */
(function($, Edge, compId){
//images folder
var im='/images/';

var fonts = {};


var resources = [
];
var symbols = {
"stage": {
   version: "0.1.7",
   minimumCompatibleVersion: "0.1.7",
   build: "0.11.0.164",
   baseState: "Base State",
   initialState: "Base State",
   gpuAccelerate: false,
   resizeInstances: false,
   content: {
         dom: [
         {
            id:'blue_lines_full',
            type:'image',
            rect:['0','0','2556px','100%','auto','auto'],
            fill:["rgba(0,0,0,0)",im+"blue_lines_full.svg",'0px','0px']
         },
         {
            id:'red_lines_full',
            type:'image',
            rect:['0','0','2526px','507px','auto','auto'],
            fill:["rgba(0,0,0,0)",im+"red_lines_full.svg",'0px','0px']
         }],
         symbolInstances: [

         ]
      },
   states: {
      "Base State": {
         "${_Stage}": [
            ["color", "background-color", 'rgba(255,255,255,0.00)'],
            ["style", "min-width", '408px'],
            ["style", "overflow", 'hidden'],
            ["style", "height", '620px'],
            ["style", "width", '100%']
         ],
         "${_blue_lines_full}": [
            ["style", "top", '6px'],
            ["style", "opacity", '0.25'],
            ["style", "left", '-100px'],
            ["style", "-webkit-transform-origin", [50,50], {valueTemplate:'@@0@@% @@1@@%'} ],
            ["style", "-moz-transform-origin", [50,50],{valueTemplate:'@@0@@% @@1@@%'}],
            ["style", "-ms-transform-origin", [50,50],{valueTemplate:'@@0@@% @@1@@%'}],
            ["style", "msTransformOrigin", [50,50],{valueTemplate:'@@0@@% @@1@@%'}],
            ["style", "-o-transform-origin", [50,50],{valueTemplate:'@@0@@% @@1@@%'}]
         ],
         "${_red_lines_full}": [
            ["style", "-webkit-transform-origin", [50,50], {valueTemplate:'@@0@@% @@1@@%'} ],
            ["style", "-moz-transform-origin", [50,50],{valueTemplate:'@@0@@% @@1@@%'}],
            ["style", "-ms-transform-origin", [50,50],{valueTemplate:'@@0@@% @@1@@%'}],
            ["style", "msTransformOrigin", [50,50],{valueTemplate:'@@0@@% @@1@@%'}],
            ["style", "-o-transform-origin", [50,50],{valueTemplate:'@@0@@% @@1@@%'}],
            ["style", "opacity", '0.25'],
            ["style", "left", '0px'],
            ["style", "top", '0px']
         ]
      }
   },
   timelines: {
      "Default Timeline": {
         fromState: "Base State",
         toState: "",
         duration: 60000,
         autoPlay: true,
         timeline: [
            { id: "eid9", tween: [ "style", "${_red_lines_full}", "left", '-554px', { fromValue: '0px'}], position: 0, duration: 60000 },
            { id: "eid12", tween: [ "style", "${_blue_lines_full}", "top", '4px', { fromValue: '6px'}], position: 0, duration: 30000 },
            { id: "eid41", tween: [ "style", "${_blue_lines_full}", "top", '-127px', { fromValue: '4px'}], position: 30000, duration: 29983 },
            { id: "eid42", tween: [ "style", "${_blue_lines_full}", "top", '4px', { fromValue: '-127px'}], position: 59983, duration: 17 },
            { id: "eid11", tween: [ "style", "${_blue_lines_full}", "left", '-358px', { fromValue: '-100px'}], position: 0, duration: 30000 },
            { id: "eid27", tween: [ "style", "${_blue_lines_full}", "left", '-100px', { fromValue: '-358px'}], position: 30000, duration: 29983 },
            { id: "eid14", tween: [ "style", "${_blue_lines_full}", "left", '-499px', { fromValue: '-100px'}], position: 59983, duration: 17 },
            { id: "eid20", tween: [ "style", "${_red_lines_full}", "opacity", '0.25', { fromValue: '0.25'}], position: 0, duration: 0, easing: "easeInQuad" },
            { id: "eid46", tween: [ "style", "${_red_lines_full}", "opacity", '0.16', { fromValue: '0.25'}], position: 4000, duration: 5000 },
            { id: "eid45", tween: [ "style", "${_red_lines_full}", "opacity", '0.25', { fromValue: '0.16'}], position: 9000, duration: 5000 },
            { id: "eid38", tween: [ "style", "${_red_lines_full}", "opacity", '0.45', { fromValue: '0.25'}], position: 36000, duration: 4000 },
            { id: "eid39", tween: [ "style", "${_red_lines_full}", "opacity", '0.25', { fromValue: '0.44999998807907104'}], position: 40000, duration: 5000 },
            { id: "eid10", tween: [ "style", "${_red_lines_full}", "top", '-40px', { fromValue: '0px'}], position: 0, duration: 60000 },
            { id: "eid19", tween: [ "style", "${_blue_lines_full}", "opacity", '0.25', { fromValue: '0.25'}], position: 0, duration: 0, easing: "easeInQuad" },
            { id: "eid33", tween: [ "style", "${_blue_lines_full}", "opacity", '0.45', { fromValue: '0.25'}], position: 5000, duration: 5000 },
            { id: "eid37", tween: [ "style", "${_blue_lines_full}", "opacity", '0.25', { fromValue: '0.44999998807907104'}], position: 10000, duration: 5000 }         ]
      }
   }
}
};


Edge.registerCompositionDefn(compId, symbols, fonts, resources);

/**
 * Adobe Edge DOM Ready Event Handler
 */
$(window).ready(function() {
     Edge.launchComposition(compId);
});
})(jQuery, AdobeEdge, "EDGE-156337445");
