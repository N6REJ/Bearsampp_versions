var TF_Bing_Map=function(){function t(t){if(t){if(this.ref=t,this.wrapper=null,this.map_element=null,this.map=null,this.options={},this.defaults={lat:0,long:0,zoom:5,view:"Road",scale:!1,markers:[],markerImage:""},this.ref instanceof HTMLElement)this.initWithDataAttributes();else{if(!(this.ref instanceof Object))return;this.initWithOptions(this.ref)}this.pinInfobox=null,this.pushpinLocations=[],this.defaultZoom=parseInt(this.options.zoom)||15}}var i=t.prototype;return i.initWithDataAttributes=function(){this.wrapper=this.ref,this.map_element=this.wrapper.querySelector(".map-item"),this.initWithOptions(JSON.parse(this.wrapper.dataset.options))},i.initWithOptions=function(t){void 0===t&&(t={}),this.options=Object.assign({},this.defaults,t);var i=this.options.value.split(",");this.options.lat=parseFloat(i[0])||this.options.lat,this.options.long=parseFloat(i[1])||this.options.long,this.wrapper||(this.wrapper=document.querySelector(".nrf-widget.bingmap#"+this.options.id)),this.map_element||(this.map_element=this.wrapper.querySelector(".map-item"))},i.render=function(){this.map=new Microsoft.Maps.Map(this.map_element,{showScalebar:this.options.scale,center:new Microsoft.Maps.Location(this.options.lat,this.options.long),zoom:this.defaultZoom,mapTypeId:this.getMapTypeID()}),this.wrapper.BingMap=this;var t=new CustomEvent("onTFMapWidgetRender",{detail:{map:this.wrapper,service:"bingmap"}});document.dispatchEvent(t)},i.getMapTypeID=function(){var t=Microsoft.Maps.MapTypeId.road;switch(this.options.view){case"road":t=Microsoft.Maps.MapTypeId.road;break;case"aerial":t=Microsoft.Maps.MapTypeId.aerial;break;case"birdseye":t=Microsoft.Maps.MapTypeId.birdseye;break;case"grayscale":t=Microsoft.Maps.MapTypeId.grayscale;break;case"ordnanceSurvey":t=Microsoft.Maps.MapTypeId.ordnanceSurvey;break;case"canvasDark":t=Microsoft.Maps.MapTypeId.canvasDark;break;case"canvasLight":t=Microsoft.Maps.MapTypeId.canvasLight}return t},i.renderMarkers=function(){var o=this,t=new Microsoft.Maps.EntityCollection,n=new Microsoft.Maps.EntityCollection;this.pinInfobox=new Microsoft.Maps.Infobox(new Microsoft.Maps.Location(0,0),{visible:!1}),t.push(this.pinInfobox);var a=[];this.options.markers.map(function(t,i){var e={lat:t.latitude,lng:t.longitude,title:t.label,description:t.description};a[i]=new Microsoft.Maps.Location(e.lat,e.lng);var s=new Microsoft.Maps.Pushpin(a[i],{icon:o.options.markerImage});s.Title=e.title,s.Description=e.description,o.pushpinLocations.push(a[i]),n.push(s),Microsoft.Maps.Events.addHandler(s,"click",o.displayInfobox.bind(o))}),this.map.entities.push(n),this.map.entities.push(t);var i=Microsoft.Maps.LocationRect.fromLocations(a);this.map.setView({center:i.center,zoom:this.defaultZoom})},i.displayInfobox=function(t){""===t.target.Title&&""===t.target.Description||(this.pinInfobox.setOptions({title:t.target.Title,description:t.target.Description,visible:!0,offset:new Microsoft.Maps.Point(0,25)}),this.pinInfobox.setLocation(t.target.getLocation()))},i.centerMap=function(){if(0!==this.options.markers.length&&!(this.pushpinLocations.length<=1)){var t={bounds:Microsoft.Maps.LocationRect.fromLocations(this.pushpinLocations)};this.map.setView(t)}},i.getMap=function(){return this.map},t}(),TF_Bing_Maps=function(){function t(){this.init()}return t.prototype.init=function(){if(window.IntersectionObserver){var t=document.querySelectorAll(".nrf-widget.bingmap:not(.no-map):not(.done)");if(t){var i=new IntersectionObserver(function(t,s){t.forEach(function(t){if(t.isIntersecting){t.target.classList.add("done");var i=t.target.hasAttribute("data-options")?JSON.parse(t.target.dataset.options):t.target,e=new TF_Bing_Map(i);e.render(),e.renderMarkers(),e.centerMap(),s.unobserve(t.target)}})},{rootMargin:"0px 0px 0px 0px"});t.forEach(function(t){i.observe(t)})}}},t}();function TF_Bing_Maps_Callback(){new TF_Bing_Maps}
