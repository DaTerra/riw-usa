/**
 * Adobe Edge: symbol definitions
 */
(function($, Edge, compId){
//images folder
var im='images/';

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
            id:'bg_animation',
            type:'group',
            rect:['-7px','0','1280px','600','auto','auto'],
            c:[
            {
               id:'blue',
               type:'image',
               rect:['0px','0','1280px','530px','auto','auto'],
               fill:["rgba(0,0,0,0)",'blue.svg','0px','0px']
            },
            {
               id:'red',
               type:'image',
               rect:['0px','0','1280px','600px','auto','auto'],
               fill:["rgba(0,0,0,0)",'red.svg','0px','0px']
            }]
         }],
         symbolInstances: [

         ]
      },
   states: {
      "Base State": {
         "${_Stage}": [
            ["color", "background-color", 'rgba(255,255,255,1)'],
            ["style", "overflow", 'hidden'],
            ["style", "height", '780px'],
            ["style", "width", '960px']
         ],
         "${_red}": [
            ["style", "top", '0px'],
            ["style", "height", '600px'],
            ["style", "left", '0px'],
            ["style", "width", '1280px']
         ],
         "${_blue}": [
            ["style", "left", '0px'],
            ["style", "top", '0px']
         ]
      }
   },
   timelines: {
      "Default Timeline": {
         fromState: "Base State",
         toState: "",
         duration: 10000,
         autoPlay: true,
         timeline: [
            { id: "eid20", tween: [ "style", "${_red}", "top", '-60px', { fromValue: '0px'}], position: 0, duration: 5000 },
            { id: "eid21", tween: [ "style", "${_red}", "top", '0px', { fromValue: '-60px'}], position: 5000, duration: 5000 },
            { id: "eid24", tween: [ "style", "${_blue}", "top", '-30px', { fromValue: '0px'}], position: 0, duration: 5000 },
            { id: "eid25", tween: [ "style", "${_blue}", "top", '0px', { fromValue: '-30px'}], position: 5000, duration: 5000 },
            { id: "eid22", tween: [ "style", "${_blue}", "left", '-160px', { fromValue: '0px'}], position: 0, duration: 5000 },
            { id: "eid23", tween: [ "style", "${_blue}", "left", '0px', { fromValue: '-160px'}], position: 5000, duration: 5000 },
            { id: "eid18", tween: [ "style", "${_red}", "left", '-70px', { fromValue: '0px'}], position: 0, duration: 5000 },
            { id: "eid19", tween: [ "style", "${_red}", "left", '0px', { fromValue: '-70px'}], position: 5000, duration: 5000 }         ]
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
})(jQuery, AdobeEdge, "EDGE-58161890");
