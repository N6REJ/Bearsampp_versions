var TF_Justified_Gallery=function(){function t(){this.init(),this.initEvents()}var e=t.prototype;return e.init=function(){this.getGalleries().forEach(function(t){var e={itemSelector:".item",transitionDuration:0,gutter:parseInt(window.getComputedStyle(t).gap)};t.parentElement.dataset.itemHeight&&(e.rowHeight=t.parentElement.dataset.itemHeight),fjGallery(t,e)})},e.initEvents=function(){var e=this;window.addEventListener("resize",function(t){e.updateGalleriesGap()},!0)},e.updateGalleriesGap=function(){this.getGalleries().forEach(function(t){t.fjGallery&&t.fjGallery.updateOptions({gutter:parseInt(window.getComputedStyle(t).gap)})})},e.getGalleries=function(){return document.querySelectorAll(".gallery-items.justified")},t}();document.addEventListener("DOMContentLoaded",function(){new TF_Justified_Gallery});
