var TF_Accordion=function(){function t(){this.initEvents()}var e=t.prototype;return e.initEvents=function(){document.addEventListener("click",function(t){this.onItemToggle(t)}.bind(this))},e.onItemToggle=function(t){t=t.target.closest(".tf-accordion-widget--item--title");t&&this.toggleItem(t.closest(".tf-accordion-widget--item"))},e.toggleItem=function(t){var e=this,n=t.closest(".tf-accordion-widget"),i="true"===t.dataset.expanded||!1;n.classList.contains("only-one-panel-expanded")&&(n=n.querySelectorAll('.tf-accordion-widget--item[data-expanded="true"]'))&&n.forEach(function(t){e.collapseItem(t)}),i?this.collapseItem(t):this.expandItem(t)},e.collapseItem=function(t){var e=t.querySelector(".tf-accordion-widget--item--content"),n=e.scrollHeight,i=e.style.transition;e.style.transition="",requestAnimationFrame(function(){e.style.height=n+"px",e.style.transition=i,requestAnimationFrame(function(){e.style.height="0px"})}),t.setAttribute("data-expanded","false")},e.expandItem=function(t){var e=t.querySelector(".tf-accordion-widget--item--content"),n=e.scrollHeight;e.style.height=n+"px",e.addEventListener("transitionend",function(t){e.removeEventListener("transitionend",arguments.callee),e.style.height=null}),t.setAttribute("data-expanded","true")},t}();document.addEventListener("DOMContentLoaded",function(){new TF_Accordion});
