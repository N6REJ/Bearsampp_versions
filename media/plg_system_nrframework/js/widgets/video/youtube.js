function _inheritsLoose(t,e){t.prototype=Object.create(e.prototype),_setPrototypeOf(t.prototype.constructor=t,e)}function _setPrototypeOf(t,e){return(_setPrototypeOf=Object.setPrototypeOf?Object.setPrototypeOf.bind():function(t,e){return t.__proto__=e,t})(t,e)}var TF_YouTube_Video=function(e){function t(t){t=e.call(this,t)||this;return t.player=null,t}_inheritsLoose(t,e);var o=t.prototype;return o.init=function(){this.maybeLoadYouTubeAPI()},o.pause=function(){this.player&&this.player.pauseVideo()},o.youTubeApiLoaded=function(){return window.YT&&window.YT.Player&&void 0!==window.YT.Player},o.maybeLoadYouTubeAPI=function(){function o(t){i.youTubeApiLoaded()?i.initYouTubeVideo():setTimeout(function(){return o(t)},350)}var t,e,i=this;document.querySelector(".tf-youtube-api-script")||this.youTubeApiLoaded()||((t=document.createElement("script")).className="tf-youtube-api-script",t.src="https://www.youtube.com/player_api",(e=document.getElementsByTagName("script")[0]).parentNode.insertBefore(t,e));return new Promise(function(t,e){o(t)})},o.initYouTubeVideo=function(){var e=this,t="https://www.youtube"+("true"===this.dataset.videoPrivacy?"-nocookie":"")+".com";this.player=new window.YT.Player(this.videoElement,{videoId:this.dataset.videoId,playerVars:{autoplay:this.setAttributeBool(this.dataset,"videoAutoplay"),controls:this.setAttributeBool(this.dataset,"videoControls"),showinfo:0,loop:this.setAttributeBool(this.dataset,"videoLoop"),playlist:this.dataset.videoId,fs:this.setAttributeBool(this.dataset,"videoFs"),cc_load_policy:this.setAttributeBool(this.dataset,"videoCc"),disablekb:this.setAttributeBool(this.dataset,"videoDisablekb"),rel:"1"==this.dataset.videoRel?1:0,iv_load_policy:3,autohide:0,color:this.dataset.videoColor,mute:this.setAttributeBool(this.dataset,"videoMute"),start:parseInt(this.dataset.videoStart,10)||void 0,end:parseInt(this.dataset.videoEnd,10)||void 0},host:t,events:{onReady:function(t){"true"!==e.video.dataset.readonly&&"true"!==e.video.dataset.disabled&&("true"===e.dataset.videoAutoplay&&e.overlay?e.video.classList.add("hiddenOverlay"):"false"===e.dataset.videoAutoplay&&e.overlay&&(e.video.classList.add("hiddenOverlay"),e.player.playVideo()))},onStateChange:function(t){t.data===window.YT.PlayerState.PLAYING&&e.video.classList.add("hiddenOverlay")}}})},t}(TF_Video);

