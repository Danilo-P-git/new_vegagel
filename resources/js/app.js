require('./bootstrap');

$(document).ready(function() {
    // var AppQuagga = {
    //     init: function() {
    //         var self = this;
     
    //         Quagga.init(this.state, function(err) {
    //             if (err) {
    //                 return self.handleError(err);
    //             }
    //             //Quagga.registerResultCollector(resultCollector);
    //             Quagga.start();
     
    //             Quagga.onProcessed(function(result) {
    //                 var drawingCtx = Quagga.canvas.ctx.overlay,
    //                     drawingCanvas = Quagga.canvas.dom.overlay;
     
    //                 if (result) {
    //                     if (result.boxes) {
    //                         drawingCtx.clearRect(0, 0, parseInt(drawingCanvas.getAttribute("width")), parseInt(drawingCanvas.getAttribute("height")));
    //                         result.boxes.filter(function (box) {
    //                             return box !== result.box;
    //                         }).forEach(function (box) {
    //                             Quagga.ImageDebug.drawPath(box, {x: 0, y: 1}, drawingCtx, {color: "green", lineWidth: 2});
    //                         });
    //                     }
     
    //                     if (result.box) {
    //                         Quagga.ImageDebug.drawPath(result.box, {x: 0, y: 1}, drawingCtx, {color: "#00F", lineWidth: 2});
    //                     }
     
    //                     if (result.codeResult && result.codeResult.code) {
    //                         Quagga.ImageDebug.drawPath(result.line, {x: 'x', y: 'y'}, drawingCtx, {color: 'red', lineWidth: 3});
    //                     }
    //                 }
    //             });
     
    //             setTimeout(function() {
    //               var track = Quagga.CameraAccess.getActiveTrack();
    //               var capabilities = {};
    //               if (typeof track.getCapabilities === 'function') {
    //                 try
    //                   {
    //                  capabilities = track.getCapabilities();
    //                  track.applyConstraints({advanced: [{zoom: 2.5}]});
    //                   } catch(e) {}
    //               }
    //             }, 500);
    //         });
    //     },
    //     handleError: function(err) {
    //         console.log(err);
    //     },
    //     state: {
    //         inputStream: {
    //             type : "LiveStream",
    //             constraints: {
    //                 facingMode: "environment"
    //             }
    //         },
    //         locator: {
    //             patchSize: "medium",
    //             halfSample: true
    //         },
    //         numOfWorkers: (navigator.hardwareConcurrency ? navigator.hardwareConcurrency : 4),
    //         frequency: 20,
    //         decoder: {
    //             readers : [{
    //                 format: "code_128_reader",
    //                 config: {}
    //             }, {
    //                 format: "ean_reader",
    //                 config: {
    //                 }
    //             }, {
    //                 format: "code_39_reader",
    //                 config: {}
    //             }, {
    //                 format: "code_93_reader",
    //                 config: {}
    //             }]
    //         },
    //         locate: true
    //     },
    //     lastResult : null
    // };
     
     
     
    // AppQuagga.init();
           
    // Quagga.onDetected(function(result) {
    //     var code = result.codeResult.code;
        
    //     if(code != null) {
    //         if (AppQuagga.lastResult !== code) {
    //             AppQuagga.lastResult = code;
    //             console.log(code);
                
    //             $( ".test" ).val( function( index, val ) {
    //                 return val + "more text";
    //             });;
    //         }
            
    //     }
    // });
    

    
});
