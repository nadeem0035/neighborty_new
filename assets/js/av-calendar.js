/*!
 * FullCalendar v3.2.0
 * Docs & License: https://fullcalendar.io/
 * (c) 2017 Adam Shaw
 */
!function(t){"function"==typeof define&&define.amd?define(["jquery","moment"],t):"object"==typeof exports?module.exports=t(require("jquery"),require("moment")):t(jQuery,moment)}(function(t,e){function n(t){return q(t,Vt)}function i(t,e){e.left&&t.css({"border-left-width":1,"margin-left":e.left-1}),e.right&&t.css({"border-right-width":1,"margin-right":e.right-1})}function r(t){t.css({"margin-left":"","margin-right":"","border-left-width":"","border-right-width":""})}function s(){t("body").addClass("fc-not-allowed")}function o(){t("body").removeClass("fc-not-allowed")}function l(e,n,i){var r=Math.floor(n/e.length),s=Math.floor(n-r*(e.length-1)),o=[],l=[],u=[],c=0;a(e),e.each(function(n,i){var a=n===e.length-1?s:r,d=t(i).outerHeight(!0);d<a?(o.push(i),l.push(d),u.push(t(i).height())):c+=d}),i&&(n-=c,r=Math.floor(n/o.length),s=Math.floor(n-r*(o.length-1))),t(o).each(function(e,n){var i=e===o.length-1?s:r,a=l[e],c=u[e],d=i-(a-c);a<i&&t(n).height(d)})}function a(t){t.height("")}function u(e){var n=0;return e.find("> *").each(function(e,i){var r=t(i).outerWidth();r>n&&(n=r)}),n++,e.width(n),n}function c(t,e){var n,i=t.add(e);return i.css({position:"relative",left:-1}),n=t.outerHeight()-e.outerHeight(),i.css({position:"",left:""}),n}function d(e){var n=e.css("position"),i=e.parents().filter(function(){var e=t(this);return/(auto|scroll)/.test(e.css("overflow")+e.css("overflow-y")+e.css("overflow-x"))}).eq(0);return"fixed"!==n&&i.length?i:t(e[0].ownerDocument||document)}function h(t,e){var n=t.offset(),i=n.left-(e?e.left:0),r=n.top-(e?e.top:0);return{left:i,right:i+t.outerWidth(),top:r,bottom:r+t.outerHeight()}}function f(t,e){var n=t.offset(),i=p(t),r=n.left+S(t,"border-left-width")+i.left-(e?e.left:0),s=n.top+S(t,"border-top-width")+i.top-(e?e.top:0);return{left:r,right:r+t[0].clientWidth,top:s,bottom:s+t[0].clientHeight}}function g(t,e){var n=t.offset(),i=n.left+S(t,"border-left-width")+S(t,"padding-left")-(e?e.left:0),r=n.top+S(t,"border-top-width")+S(t,"padding-top")-(e?e.top:0);return{left:i,right:i+t.width(),top:r,bottom:r+t.height()}}function p(t){var e,n=t.innerWidth()-t[0].clientWidth,i=t.innerHeight()-t[0].clientHeight;return n=v(n),i=v(i),e={left:0,right:0,top:0,bottom:i},m()&&"rtl"==t.css("direction")?e.left=n:e.right=n,e}function v(t){return t=Math.max(0,t),t=Math.round(t)}function m(){return null===Pt&&(Pt=y()),Pt}function y(){var e=t("<div><div/></div>").css({position:"absolute",top:-1e3,left:0,border:0,padding:0,overflow:"scroll",direction:"rtl"}).appendTo("body"),n=e.children(),i=n.offset().left>e.offset().left;return e.remove(),i}function S(t,e){return parseFloat(t.css(e))||0}function w(t){return 1==t.which&&!t.ctrlKey}function E(t){var e=t.originalEvent.touches;return e&&e.length?e[0].pageX:t.pageX}function b(t){var e=t.originalEvent.touches;return e&&e.length?e[0].pageY:t.pageY}function D(t){return/^touch/.test(t.type)}function T(t){t.addClass("fc-unselectable").on("selectstart",H)}function C(t){t.removeClass("fc-unselectable").off("selectstart",H)}function H(t){t.preventDefault()}function x(t,e){var n={left:Math.max(t.left,e.left),right:Math.min(t.right,e.right),top:Math.max(t.top,e.top),bottom:Math.min(t.bottom,e.bottom)};return n.left<n.right&&n.top<n.bottom&&n}function R(t,e){return{left:Math.min(Math.max(t.left,e.left),e.right),top:Math.min(Math.max(t.top,e.top),e.bottom)}}function I(t){return{left:(t.left+t.right)/2,top:(t.top+t.bottom)/2}}function k(t,e){return{left:t.left-e.left,top:t.top-e.top}}function L(e){var n,i,r=[],s=[];for("string"==typeof e?s=e.split(/\s*,\s*/):"function"==typeof e?s=[e]:t.isArray(e)&&(s=e),n=0;n<s.length;n++)i=s[n],"string"==typeof i?r.push("-"==i.charAt(0)?{field:i.substring(1),order:-1}:{field:i,order:1}):"function"==typeof i&&r.push({func:i});return r}function M(t,e,n){var i,r;for(i=0;i<n.length;i++)if(r=B(t,e,n[i]))return r;return 0}function B(t,e,n){return n.func?n.func(t,e):N(t[n.field],e[n.field])*(n.order||1)}function N(e,n){return e||n?null==n?-1:null==e?1:"string"===t.type(e)||"string"===t.type(n)?String(e).localeCompare(String(n)):e-n:0}function F(t,e){var n,i,r,s,o=t.start,l=t.end,a=e.start,u=e.end;if(l>a&&o<u)return o>=a?(n=o.clone(),r=!0):(n=a.clone(),r=!1),l<=u?(i=l.clone(),s=!0):(i=u.clone(),s=!1),{start:n,end:i,isStart:r,isEnd:s}}function z(t,n){return e.duration({days:t.clone().stripTime().diff(n.clone().stripTime(),"days"),ms:t.time()-n.time()})}function G(t,n){return e.duration({days:t.clone().stripTime().diff(n.clone().stripTime(),"days")})}function O(t,n,i){return e.duration(Math.round(t.diff(n,i,!0)),i)}function A(t,e){var n,i,r;for(n=0;n<Yt.length&&(i=Yt[n],r=V(i,t,e),!(r>=1&&ot(r)));n++);return i}function V(t,n,i){return null!=i?i.diff(n,t,!0):e.isDuration(n)?n.as(t):n.end.diff(n.start,t,!0)}function P(t,e,n){var i;return W(n)?(e-t)/n:(i=n.asMonths(),Math.abs(i)>=1&&ot(i)?e.diff(t,"months",!0)/i:e.diff(t,"days",!0)/n.asDays())}function _(t,e){var n,i;return W(t)||W(e)?t/e:(n=t.asMonths(),i=e.asMonths(),Math.abs(n)>=1&&ot(n)&&Math.abs(i)>=1&&ot(i)?n/i:t.asDays()/e.asDays())}function Y(t,n){var i;return W(t)?e.duration(t*n):(i=t.asMonths(),Math.abs(i)>=1&&ot(i)?e.duration({months:i*n}):e.duration({days:t.asDays()*n}))}function W(t){return Boolean(t.hours()||t.minutes()||t.seconds()||t.milliseconds())}function U(t){return"[object Date]"===Object.prototype.toString.call(t)||t instanceof Date}function j(t){return/^\d+\:\d+(?:\:\d+\.?(?:\d{3})?)?$/.test(t)}function q(t,e){var n,i,r,s,o,l,a={};if(e)for(n=0;n<e.length;n++){for(i=e[n],r=[],s=t.length-1;s>=0;s--)if(o=t[s][i],"object"==typeof o)r.unshift(o);else if(void 0!==o){a[i]=o;break}r.length&&(a[i]=q(r))}for(n=t.length-1;n>=0;n--){l=t[n];for(i in l)i in a||(a[i]=l[i])}return a}function Z(t){var e=function(){};return e.prototype=t,new e}function $(t,e){for(var n in t)Q(t,n)&&(e[n]=t[n])}function Q(t,e){return Wt.call(t,e)}function X(e){return/undefined|null|boolean|number|string/.test(t.type(e))}function K(e,n,i){if(t.isFunction(e)&&(e=[e]),e){var r,s;for(r=0;r<e.length;r++)s=e[r].apply(n,i)||s;return s}}function J(){for(var t=0;t<arguments.length;t++)if(void 0!==arguments[t])return arguments[t]}function tt(t){return(t+"").replace(/&/g,"&amp;").replace(/</g,"&lt;").replace(/>/g,"&gt;").replace(/'/g,"&#039;").replace(/"/g,"&quot;").replace(/\n/g,"<br />")}function et(t){return t.replace(/&.*?;/g,"")}function nt(e){var n=[];return t.each(e,function(t,e){null!=e&&n.push(t+":"+e)}),n.join(";")}function it(e){var n=[];return t.each(e,function(t,e){null!=e&&n.push(t+'="'+tt(e)+'"')}),n.join(" ")}function rt(t){return t.charAt(0).toUpperCase()+t.slice(1)}function st(t,e){return t-e}function ot(t){return t%1===0}function lt(t,e){var n=t[e];return function(){return n.apply(t,arguments)}}function at(t,e,n){var i,r,s,o,l,a=function(){var u=+new Date-o;u<e?i=setTimeout(a,e-u):(i=null,n||(l=t.apply(s,r),s=r=null))};return function(){s=this,r=arguments,o=+new Date;var u=n&&!i;return i||(i=setTimeout(a,e)),u&&(l=t.apply(s,r),s=r=null),l}}function ut(n,i,r){var s,o,l,a,u=n[0],c=1==n.length&&"string"==typeof u;return e.isMoment(u)||U(u)||void 0===u?a=e.apply(null,n):(s=!1,o=!1,c?Ut.test(u)?(u+="-01",n=[u],s=!0,o=!0):(l=jt.exec(u))&&(s=!l[5],o=!0):t.isArray(u)&&(o=!0),a=i||s?e.utc.apply(e,n):e.apply(null,n),s?(a._ambigTime=!0,a._ambigZone=!0):r&&(o?a._ambigZone=!0:c&&a.utcOffset(u))),a._fullCalendar=!0,a}function ct(){}function dt(t,e){var n;return Q(e,"constructor")&&(n=e.constructor),"function"!=typeof n&&(n=e.constructor=function(){t.apply(this,arguments)}),n.prototype=Z(t.prototype),$(e,n.prototype),$(t,n),n}function ht(t,e){$(e,t.prototype)}function ft(e){var n=t.Deferred(),i=n.promise();if("function"==typeof e&&e(function(t){ft.immediate&&(i._value=t),n.resolve(t)},function(){n.reject()}),ft.immediate){var r=i.then;i.then=function(t,e){var n=i.state();if("resolved"===n){if("function"==typeof t)return ft.resolve(t(i._value))}else if("rejected"===n&&"function"==typeof e)return e(),i;return r.call(i,t,e)}}return i}function gt(t){function e(t){return new ft(function(e){var i=function(){ft.resolve(t()).then(e).then(function(){n.shift(),n.length&&n[0]()})};n.push(i),1===n.length&&i()})}var n=[];this.add="number"==typeof t?at(e,t):e,this.addQuickly=e}function pt(t,e){return!t&&!e||!(!t||!e)&&(t.component===e.component&&vt(t,e)&&vt(e,t))}function vt(t,e){for(var n in t)if(!/^(component|left|right|top|bottom)$/.test(n)&&t[n]!==e[n])return!1;return!0}function mt(t){return{start:t.start.clone(),end:t.end?t.end.clone():null,allDay:t.allDay}}function yt(t){var e=wt(t);return"background"===e||"inverse-background"===e}function St(t){return"inverse-background"===wt(t)}function wt(t){return J((t.source||{}).rendering,t.rendering)}function Et(t){var e,n,i={};for(e=0;e<t.length;e++)n=t[e],(i[n._id]||(i[n._id]=[])).push(n);return i}function bt(t,e){return t.start-e.start}function Dt(n){var i,r,s,o,l=Ot.dataAttrPrefix;return l&&(l+="-"),i=n.data(l+"event")||null,i&&(i="object"==typeof i?t.extend({},i):{},r=i.start,null==r&&(r=i.time),s=i.duration,o=i.stick,delete i.start,delete i.time,delete i.duration,delete i.stick),null==r&&(r=n.data(l+"start")),null==r&&(r=n.data(l+"time")),null==s&&(s=n.data(l+"duration")),null==o&&(o=n.data(l+"stick")),r=null!=r?e.duration(r):null,s=null!=s?e.duration(s):null,o=Boolean(o),{eventProps:i,startTime:r,duration:s,stick:o}}function Tt(t,e){var n,i;for(n=0;n<e.length;n++)if(i=e[n],i.leftCol<=t.rightCol&&i.rightCol>=t.leftCol)return!0;return!1}function Ct(t,e){return t.leftCol-e.leftCol}function Ht(t){var e,n,i,r=[];for(e=0;e<t.length;e++){for(n=t[e],i=0;i<r.length&&It(n,r[i]).length;i++);n.level=i,(r[i]||(r[i]=[])).push(n)}return r}function xt(t){var e,n,i,r,s;for(e=0;e<t.length;e++)for(n=t[e],i=0;i<n.length;i++)for(r=n[i],r.forwardSegs=[],s=e+1;s<t.length;s++)It(r,t[s],r.forwardSegs)}function Rt(t){var e,n,i=t.forwardSegs,r=0;if(void 0===t.forwardPressure){for(e=0;e<i.length;e++)n=i[e],Rt(n),r=Math.max(r,1+n.forwardPressure);t.forwardPressure=r}}function It(t,e,n){n=n||[];for(var i=0;i<e.length;i++)kt(t,e[i])&&n.push(e[i]);return n}function kt(t,e){return t.bottom>e.top&&t.top<e.bottom}function Lt(t){this.items=t||[]}function Mt(e,n){function i(t){n=t}function r(){var i=n.layout;p=e.options.theme?"ui":"fc",i?(g?g.empty():g=this.el=t("<div class='fc-toolbar "+n.extraClasses+"'/>"),g.append(o("left")).append(o("right")).append(o("center")).append('<div class="fc-clear"/>')):s()}function s(){g&&(g.remove(),g=f.el=null)}function o(i){var r=t('<div class="fc-'+i+'"/>'),s=n.layout[i];return s&&t.each(s.split(" "),function(n){var i,s=t(),o=!0;t.each(this.split(","),function(n,i){var r,l,a,u,c,d,h,f,g,m;"title"==i?(s=s.add(t("<h2>&nbsp;</h2>")),o=!1):((r=(e.options.customButtons||{})[i])?(a=function(t){r.click&&r.click.call(m[0],t)},u="",c=r.text):(l=e.getViewSpec(i))?(a=function(){e.changeView(i)},v.push(i),u=l.buttonTextOverride,c=l.buttonTextDefault):e[i]&&(a=function(){e[i]()},u=(e.overrides.buttonText||{})[i],c=e.options.buttonText[i]),a&&(d=r?r.themeIcon:e.options.themeButtonIcons[i],h=r?r.icon:e.options.buttonIcons[i],f=u?tt(u):d&&e.options.theme?"<span class='ui-icon ui-icon-"+d+"'></span>":h&&!e.options.theme?"<span class='fc-icon fc-icon-"+h+"'></span>":tt(c),g=["fc-"+i+"-button",p+"-button",p+"-state-default"],m=t('<button type="button" class="'+g.join(" ")+'">'+f+"</button>").click(function(t){m.hasClass(p+"-state-disabled")||(a(t),(m.hasClass(p+"-state-active")||m.hasClass(p+"-state-disabled"))&&m.removeClass(p+"-state-hover"))}).mousedown(function(){m.not("."+p+"-state-active").not("."+p+"-state-disabled").addClass(p+"-state-down")}).mouseup(function(){m.removeClass(p+"-state-down")}).hover(function(){m.not("."+p+"-state-active").not("."+p+"-state-disabled").addClass(p+"-state-hover")},function(){m.removeClass(p+"-state-hover").removeClass(p+"-state-down")}),s=s.add(m)))}),o&&s.first().addClass(p+"-corner-left").end().last().addClass(p+"-corner-right").end(),s.length>1?(i=t("<div/>"),o&&i.addClass("fc-button-group"),i.append(s),r.append(i)):r.append(s)}),r}function l(t){g&&g.find("h2").text(t)}function a(t){g&&g.find(".fc-"+t+"-button").addClass(p+"-state-active")}function u(t){g&&g.find(".fc-"+t+"-button").removeClass(p+"-state-active")}function c(t){g&&g.find(".fc-"+t+"-button").prop("disabled",!0).addClass(p+"-state-disabled")}function d(t){g&&g.find(".fc-"+t+"-button").prop("disabled",!1).removeClass(p+"-state-disabled")}function h(){return v}var f=this;f.setToolbarOptions=i,f.render=r,f.removeElement=s,f.updateTitle=l,f.activateButton=a,f.deactivateButton=u,f.disableButton=c,f.enableButton=d,f.getViewsWithButtons=h,f.el=null;var g,p,v=[]}function Bt(n,i){function r(t){t._locale=Y}function s(){q?a()&&(f(),u()):o()}function o(){n.addClass("fc"),n.on("click.fc","a[data-goto]",function(e){var n=t(this),i=n.data("goto"),r=_.moment(i.date),s=i.type,o=Q.opt("navLink"+rt(s)+"Click");"function"==typeof o?o(r,e):("string"==typeof o&&(s=o),B(r,s))}),_.bindOption("theme",function(t){$=t?"ui":"fc",n.toggleClass("ui-widget",t),n.toggleClass("fc-unthemed",!t)}),_.bindOptions(["isRTL","locale"],function(t){n.toggleClass("fc-ltr",!t),n.toggleClass("fc-rtl",t)}),q=t("<div class='fc-view-container'/>").prependTo(n);var e=y();W=new Lt(e),U=_.header=e[0],j=_.footer=e[1],E(),b(),u(_.options.defaultView),_.options.handleWindowResize&&(K=at(v,_.options.windowResizeDelay),t(window).resize(K))}function l(){Q&&Q.removeElement(),W.proxyCall("removeElement"),q.remove(),n.removeClass("fc fc-ltr fc-rtl fc-unthemed ui-widget"),n.off(".fc"),K&&t(window).unbind("resize",K),se.unneeded()}function a(){return n.is(":visible")}function u(e,n){nt++;var i=Q&&e&&Q.type!==e;i&&(F(),c()),!Q&&e&&(Q=_.view=et[e]||(et[e]=_.instantiateView(e)),Q.setElement(t("<div class='fc-view fc-"+e+"-view' />").appendTo(q)),W.proxyCall("activateButton",e)),Q&&(J=Q.massageCurrentDate(J),Q.isDateSet&&J>=Q.intervalStart&&J<Q.intervalEnd||a()&&(n&&Q.captureInitialScroll(n),Q.setDate(J,n),n&&Q.releaseScroll(),D())),i&&z(),nt--}function c(){W.proxyCall("deactivateButton",Q.type),Q.removeElement(),Q=_.view=null}function d(){nt++,F();var t=Q.type,e=Q.queryScroll();c(),f(),u(t,e),z(),nt--}function h(t){if(a())return t&&g(),nt++,Q.updateSize(!0),nt--,!0}function f(){a()&&g()}function g(){var t=_.options.contentHeight,e=_.options.height;X="number"==typeof t?t:"function"==typeof t?t():"number"==typeof e?e-p():"function"==typeof e?e()-p():"parent"===e?n.parent().height()-p():Math.round(q.width()/Math.max(_.options.aspectRatio,.5))}function p(){return W.items.reduce(function(t,e){var n=e.el?e.el.outerHeight(!0):0;return t+n},0)}function v(t){!nt&&t.target===window&&Q.start&&h(!0)&&Q.publiclyTrigger("windowResize",tt)}function m(){a()&&_.reportEventChange()}function y(){return[new Mt(_,S()),new Mt(_,w())]}function S(){return{extraClasses:"fc-header-toolbar",layout:_.options.header}}function w(){return{extraClasses:"fc-footer-toolbar",layout:_.options.footer}}function E(){U.setToolbarOptions(S()),U.render(),U.el&&n.prepend(U.el)}function b(){j.setToolbarOptions(w()),j.render(),j.el&&n.append(j.el)}function D(){var t=_.getNow();t>=Q.intervalStart&&t<Q.intervalEnd?W.proxyCall("disableButton","today"):W.proxyCall("enableButton","today")}function T(t,e){Q.select(_.buildSelectSpan.apply(_,arguments))}function C(){Q&&Q.unselect()}function H(){J=Q.computePrevDate(J),u()}function x(){J=Q.computeNextDate(J),u()}function R(){J.add(-1,"years"),u()}function I(){J.add(1,"years"),u()}function k(){J=_.getNow(),u()}function L(t){J=_.moment(t).stripZone(),u()}function M(t){J.add(e.duration(t)),u()}function B(t,e){var n;e=e||"day",n=_.getViewSpec(e)||_.getUnitViewSpec(e),J=t.clone(),u(n?n.type:null)}function N(){return _.applyTimezone(J)}function F(){it++||q.css({width:"100%",height:q.height(),overflow:"hidden"})}function z(){--it||q.css({width:"",height:"",overflow:""})}function G(){return _}function O(){return Q}function A(t,e){var n;if("string"==typeof t){if(void 0===e)return _.options[t];n={},n[t]=e,V(n)}else"object"==typeof t&&V(t)}function V(t){var e,n=0;for(e in t)_.dynamicOverrides[e]=t[e];_.viewSpecCache={},_.populateOptionsHash();for(e in t)_.triggerOptionHandlers(e),n++;if(1===n){if("height"===e||"contentHeight"===e||"aspectRatio"===e)return void h(!0);if("defaultDate"===e)return;if("businessHours"===e)return void(Q&&(Q.unrenderBusinessHours(),Q.renderBusinessHours()));if("timezone"===e)return _.rezoneArrayEventSources(),void _.refetchEvents()}E(),b(),et={},d()}function P(t,e){var n=Array.prototype.slice.call(arguments,2);if(e=e||tt,this.triggerWith(t,e,n),_.options[t])return _.options[t].apply(e,n)}var _=this;se.needed(),_.render=s,_.destroy=l,_.rerenderEvents=m,_.changeView=u,_.select=T,_.unselect=C,_.prev=H,_.next=x,_.prevYear=R,_.nextYear=I,_.today=k,_.gotoDate=L,_.incrementDate=M,_.zoomTo=B,_.getDate=N,_.getCalendar=G,_.getView=O,_.option=A,_.publiclyTrigger=P,_.dynamicOverrides={},_.viewSpecCache={},_.optionHandlers={},_.overrides=t.extend({},i),_.populateOptionsHash();var Y;_.bindOptions(["locale","monthNames","monthNamesShort","dayNames","dayNamesShort","firstDay","weekNumberCalculation"],function(t,e,n,i,s,o,l){if("iso"===l&&(l="ISO"),Y=Z(Ft(t)),e&&(Y._months=e),n&&(Y._monthsShort=n),i&&(Y._weekdays=i),s&&(Y._weekdaysShort=s),null==o&&"ISO"===l&&(o=1),null!=o){var a=Z(Y._week);a.dow=o,Y._week=a}"ISO"!==l&&"local"!==l&&"function"!=typeof l||(Y._fullCalendar_weekCalc=l),J&&r(J)}),_.defaultAllDayEventDuration=e.duration(_.options.defaultAllDayEventDuration),_.defaultTimedEventDuration=e.duration(_.options.defaultTimedEventDuration),_.moment=function(){var t;return"local"===_.options.timezone?(t=Ot.moment.apply(null,arguments),t.hasTime()&&t.local()):t="UTC"===_.options.timezone?Ot.moment.utc.apply(null,arguments):Ot.moment.parseZone.apply(null,arguments),r(t),t},_.localizeMoment=r,_.getIsAmbigTimezone=function(){return"local"!==_.options.timezone&&"UTC"!==_.options.timezone},_.applyTimezone=function(t){if(!t.hasTime())return t.clone();var e,n=_.moment(t.toArray()),i=t.time()-n.time();return i&&(e=n.clone().add(i),t.time()-e.time()===0&&(n=e)),n},_.getNow=function(){var t=_.options.now;return"function"==typeof t&&(t=t()),_.moment(t).stripZone()},_.getEventEnd=function(t){return t.end?t.end.clone():_.getDefaultEventEnd(t.allDay,t.start)},_.getDefaultEventEnd=function(t,e){var n=e.clone();return t?n.stripTime().add(_.defaultAllDayEventDuration):n.add(_.defaultTimedEventDuration),_.getIsAmbigTimezone()&&n.stripZone(),n},_.humanizeDuration=function(t){return t.locale(_.options.locale).humanize()},zt.call(_);var W,U,j,q,$,Q,X,K,J,tt=n[0],et={},nt=0;J=null!=_.options.defaultDate?_.moment(_.options.defaultDate).stripZone():_.getNow(),_.getSuggestedViewHeight=function(){return void 0===X&&f(),X},_.isHeightAuto=function(){return"auto"===_.options.contentHeight||"auto"===_.options.height},_.setToolbarsTitle=function(t){W.proxyCall("updateTitle",t)},_.freezeContentHeight=F,_.thawContentHeight=z;var it=0;_.initialize()}function Nt(e){t.each(me,function(t,n){null==e[t]&&(e[t]=n(e))})}function Ft(t){return e.localeData(t)||e.localeData("en")}function zt(){function n(t,e){return!U.options.lazyFetching||s(t,e)?o(t,e):ft.resolve($)}function i(){$=r(nt),U.trigger("eventsReset",$)}function r(t){var e,n,i=[];for(e=0;e<t.length;e++)n=t[e],n.start.clone().stripZone()<Z&&U.getEventEnd(n).stripZone()>q&&i.push(n);return i}function s(t,e){return!q||t<q||e>Z}function o(t,e){return q=t,Z=e,l()}function l(){return u(tt,"reset")}function a(t){return u(E(t))}function u(t,e){var n,i;for("reset"===e?nt=[]:"add"!==e&&(nt=C(nt,t)),n=0;n<t.length;n++)i=t[n],"pending"!==i._status&&et++,i._fetchId=(i._fetchId||0)+1,i._status="pending";for(n=0;n<t.length;n++)i=t[n],c(i,i._fetchId);return et?new ft(function(t){U.one("eventsReceived",t)}):ft.resolve($)}function c(e,n){f(e,function(i){var r,s,o,l=t.isArray(e.events);if(n===e._fetchId&&"rejected"!==e._status){if(e._status="resolved",i)for(r=0;r<i.length;r++)s=i[r],o=l?s:F(s,e),o&&nt.push.apply(nt,_(o));h()}})}function d(t){var e="pending"===t._status;t._status="rejected",e&&h()}function h(){et--,et||(i(nt),U.trigger("eventsReceived",$))}function f(e,n){var i,r,s=Ot.sourceFetchers;for(i=0;i<s.length;i++){if(r=s[i].call(U,e,q.clone(),Z.clone(),U.options.timezone,n),r===!0)return;if("object"==typeof r)return void f(r,n)}var o=e.events;if(o)t.isFunction(o)?(U.pushLoading(),o.call(U,q.clone(),Z.clone(),U.options.timezone,function(t){n(t),U.popLoading()})):t.isArray(o)?n(o):n();else{var l=e.url;if(l){var a,u=e.success,c=e.error,d=e.complete;a=t.isFunction(e.data)?e.data():e.data;var h=t.extend({},a||{}),g=J(e.startParam,U.options.startParam),p=J(e.endParam,U.options.endParam),v=J(e.timezoneParam,U.options.timezoneParam);g&&(h[g]=q.format()),p&&(h[p]=Z.format()),U.options.timezone&&"local"!=U.options.timezone&&(h[v]=U.options.timezone),U.pushLoading(),t.ajax(t.extend({},ye,e,{data:h,success:function(e){e=e||[];var i=K(u,this,arguments);t.isArray(i)&&(e=i),n(e)},error:function(){K(c,this,arguments),n()},complete:function(){K(d,this,arguments),U.popLoading()}}))}else n()}}function g(t){var e=p(t);e&&(tt.push(e),u([e],"add"))}function p(e){var n,i,r=Ot.sourceNormalizers;if(t.isFunction(e)||t.isArray(e)?n={events:e}:"string"==typeof e?n={url:e}:"object"==typeof e&&(n=t.extend({},e)),n){for(n.className?"string"==typeof n.className&&(n.className=n.className.split(/\s+/)):n.className=[],t.isArray(n.events)&&(n.origArray=n.events,n.events=t.map(n.events,function(t){return F(t,n)})),i=0;i<r.length;i++)r[i].call(U,n);return n}}function v(t){y(b(t))}function m(t){null==t?y(tt,!0):y(E(t))}function y(e,n){var r;for(r=0;r<e.length;r++)d(e[r]);n?(tt=[],nt=[]):(tt=t.grep(tt,function(t){for(r=0;r<e.length;r++)if(t===e[r])return!1;return!0}),nt=C(nt,e)),i()}function S(){return tt.slice(1)}function w(e){return t.grep(tt,function(t){return t.id&&t.id===e})[0]}function E(e){e?t.isArray(e)||(e=[e]):e=[];var n,i=[];for(n=0;n<e.length;n++)i.push.apply(i,b(e[n]));return i}function b(e){var n,i;for(n=0;n<tt.length;n++)if(i=tt[n],i===e)return[i];return i=w(e),i?[i]:t.grep(tt,function(t){return D(e,t)})}function D(t,e){return t&&e&&T(t)==T(e)}function T(t){return("object"==typeof t?t.origArray||t.googleCalendarId||t.url||t.events:null)||t}function C(e,n){return t.grep(e,function(t){for(var e=0;e<n.length;e++)if(t.source===n[e])return!1;return!0})}function H(t){x([t])}function x(t){var e,n;for(e=0;e<t.length;e++)n=t[e],n.start=U.moment(n.start),n.end?n.end=U.moment(n.end):n.end=null,Y(n,R(n));i()}function R(e){var n={};return t.each(e,function(t,e){I(t)&&void 0!==e&&X(e)&&(n[t]=e)}),n}function I(t){return!/^_|^(id|allDay|start|end)$/.test(t)}function k(t,e){return L([t],e)}function L(t,e){var n,r,s,o,l,a=[];for(s=0;s<t.length;s++)if(r=F(t[s])){for(n=_(r),o=0;o<n.length;o++)l=n[o],l.source||(e&&(Q.events.push(l),l.source=Q),nt.push(l));a=a.concat(n)}return a.length&&i(),a}function M(e){var n,r;for(null==e?e=function(){return!0}:t.isFunction(e)||(n=e+"",e=function(t){return t._id==n}),nt=t.grep(nt,e,!0),r=0;r<tt.length;r++)t.isArray(tt[r].events)&&(tt[r].events=t.grep(tt[r].events,e,!0));i()}function B(e){return t.isFunction(e)?t.grep(nt,e):null!=e?(e+="",t.grep(nt,function(t){return t._id==e})):nt}function N(t){t.start=U.moment(t.start),t.end&&(t.end=U.moment(t.end)),Gt(t)}function F(n,i){var r,s,o,l={};if(U.options.eventDataTransform&&(n=U.options.eventDataTransform(n)),i&&i.eventDataTransform&&(n=i.eventDataTransform(n)),t.extend(l,n),i&&(l.source=i),l._id=n._id||(void 0===n.id?"_fc"+Se++:n.id+""),n.className?"string"==typeof n.className?l.className=n.className.split(/\s+/):l.className=n.className:l.className=[],r=n.start||n.date,s=n.end,j(r)&&(r=e.duration(r)),j(s)&&(s=e.duration(s)),n.dow||e.isDuration(r)||e.isDuration(s))l.start=r?e.duration(r):null,l.end=s?e.duration(s):null,l._recurring=!0;else{if(r&&(r=U.moment(r),!r.isValid()))return!1;s&&(s=U.moment(s),s.isValid()||(s=null)),o=n.allDay,void 0===o&&(o=J(i?i.allDayDefault:void 0,U.options.allDayDefault)),A(r,s,o,l)}return U.normalizeEvent(l),l}function A(t,e,n,i){i.start=t,i.end=e,i.allDay=n,V(i),Gt(i)}function V(t){P(t),t.end&&!t.end.isAfter(t.start)&&(t.end=null),t.end||(U.options.forceEventDuration?t.end=U.getDefaultEventEnd(t.allDay,t.start):t.end=null)}function P(t){null==t.allDay&&(t.allDay=!(t.start.hasTime()||t.end&&t.end.hasTime())),t.allDay?(t.start.stripTime(),t.end&&t.end.stripTime()):(t.start.hasTime()||(t.start=U.applyTimezone(t.start.time(0))),t.end&&!t.end.hasTime()&&(t.end=U.applyTimezone(t.end.time(0))))}function _(e,n,i){var r,s,o,l,a,u,c,d,h,f=[];if(n=n||q,i=i||Z,e)if(e._recurring){if(s=e.dow)for(r={},o=0;o<s.length;o++)r[s[o]]=!0;for(l=n.clone().stripTime();l.isBefore(i);)r&&!r[l.day()]||(a=e.start,u=e.end,c=l.clone(),d=null,a&&(c=c.time(a)),u&&(d=l.clone().time(u)),h=t.extend({},e),A(c,d,!a&&!u,h),f.push(h)),l.add(1,"days")}else f.push(e);return f}function Y(e,n,i){function r(t,e){return i?O(t,e,i):n.allDay?G(t,e):z(t,e)}var s,o,l,a,u,c,d={};return n=n||{},n.start||(n.start=e.start.clone()),void 0===n.end&&(n.end=e.end?e.end.clone():null),null==n.allDay&&(n.allDay=e.allDay),V(n),s={start:e._start.clone(),end:e._end?e._end.clone():U.getDefaultEventEnd(e._allDay,e._start),allDay:n.allDay},V(s),o=null!==e._end&&null===n.end,l=r(n.start,s.start),n.end?(a=r(n.end,s.end),u=a.subtract(l)):u=null,t.each(n,function(t,e){I(t)&&void 0!==e&&(d[t]=e)}),c=W(B(e._id),o,n.allDay,l,u,d),{dateDelta:l,durationDelta:u,undo:c}}function W(e,n,i,r,s,o){var l=U.getIsAmbigTimezone(),a=[];return r&&!r.valueOf()&&(r=null),s&&!s.valueOf()&&(s=null),t.each(e,function(e,u){var c,d;c={start:u.start.clone(),end:u.end?u.end.clone():null,allDay:u.allDay},t.each(o,function(t){c[t]=u[t]}),d={start:u._start,end:u._end,allDay:i},V(d),n?d.end=null:s&&!d.end&&(d.end=U.getDefaultEventEnd(d.allDay,d.start)),r&&(d.start.add(r),d.end&&d.end.add(r)),s&&d.end.add(s),l&&!d.allDay&&(r||s)&&(d.start.stripZone(),d.end&&d.end.stripZone()),t.extend(u,o,d),Gt(u),a.push(function(){t.extend(u,c),Gt(u)})}),function(){for(var t=0;t<a.length;t++)a[t]()}}var U=this;U.requestEvents=n,U.reportEventChange=i,U.isFetchNeeded=s,U.fetchEvents=o,U.fetchEventSources=u,U.refetchEvents=l,U.refetchEventSources=a,U.getEventSources=S,U.getEventSourceById=w,U.addEventSource=g,U.removeEventSource=v,U.removeEventSources=m,U.updateEvent=H,U.updateEvents=x,U.renderEvent=k,U.renderEvents=L,U.removeEvents=M,U.clientEvents=B,U.mutateEvent=Y,U.normalizeEventDates=V,U.normalizeEventTimes=P;var q,Z,$,Q={events:[]},tt=[Q],et=0,nt=[];t.each((U.options.events?[U.options.events]:[]).concat(U.options.eventSources||[]),function(t,e){var n=p(e);n&&tt.push(n)}),U.getEventCache=function(){return nt},U.getPrunedEventCache=function(){return $},U.rezoneArrayEventSources=function(){var e,n,i;for(e=0;e<tt.length;e++)if(n=tt[e].events,t.isArray(n))for(i=0;i<n.length;i++)N(n[i])},U.buildEventFromInput=F,U.expandEvent=_}function Gt(t){t._allDay=t.allDay,t._start=t.start.clone(),t._end=t.end?t.end.clone():null}var Ot=t.fullCalendar={version:"3.2.0",internalApiVersion:8},At=Ot.views={};t.fn.fullCalendar=function(e){var n=Array.prototype.slice.call(arguments,1),i=this;return this.each(function(r,s){var o,l=t(s),a=l.data("fullCalendar");"string"==typeof e?a&&t.isFunction(a[e])&&(o=a[e].apply(a,n),r||(i=o),"destroy"===e&&l.removeData("fullCalendar")):a||(a=new fe(l,e),l.data("fullCalendar",a),a.render())}),i};var Vt=["header","footer","buttonText","buttonIcons","themeButtonIcons"];Ot.intersectRanges=F,Ot.applyAll=K,Ot.debounce=at,Ot.isInt=ot,Ot.htmlEscape=tt,Ot.cssToStr=nt,Ot.proxy=lt,Ot.capitaliseFirstLetter=rt,Ot.getOuterRect=h,Ot.getClientRect=f,Ot.getContentRect=g,Ot.getScrollbarWidths=p;var Pt=null;Ot.preventDefault=H,Ot.intersectRects=x,Ot.parseFieldSpecs=L,Ot.compareByFieldSpecs=M,Ot.compareByFieldSpec=B,Ot.flexibleCompare=N,Ot.computeIntervalUnit=A,Ot.divideRangeByDuration=P,Ot.divideDurationByDuration=_,Ot.multiplyDuration=Y,Ot.durationHasTime=W;var _t=["sun","mon","tue","wed","thu","fri","sat"],Yt=["year","month","week","day","hour","minute","second","millisecond"];Ot.log=function(){var t=window.console;if(t&&t.log)return t.log.apply(t,arguments)},Ot.warn=function(){var t=window.console;return t&&t.warn?t.warn.apply(t,arguments):Ot.log.apply(Ot,arguments)};var Wt={}.hasOwnProperty;Ot.createObject=Z;var Ut=/^\s*\d{4}-\d\d$/,jt=/^\s*\d{4}-(?:(\d\d-\d\d)|(W\d\d$)|(W\d\d-\d)|(\d\d\d))((T| )(\d\d(:\d\d(:\d\d(\.\d+)?)?)?)?)?$/,qt=e.fn,Zt=t.extend({},qt),$t=e.momentProperties;$t.push("_fullCalendar"),$t.push("_ambigTime"),$t.push("_ambigZone"),Ot.moment=function(){return ut(arguments)},Ot.moment.utc=function(){var t=ut(arguments,!0);return t.hasTime()&&t.utc(),t},Ot.moment.parseZone=function(){return ut(arguments,!0,!0)},qt.week=qt.weeks=function(t){var e=this._locale._fullCalendar_weekCalc;return null==t&&"function"==typeof e?e(this):"ISO"===e?Zt.isoWeek.apply(this,arguments):Zt.week.apply(this,arguments)},qt.time=function(t){if(!this._fullCalendar)return Zt.time.apply(this,arguments);if(null==t)return e.duration({hours:this.hours(),minutes:this.minutes(),seconds:this.seconds(),milliseconds:this.milliseconds()});this._ambigTime=!1,e.isDuration(t)||e.isMoment(t)||(t=e.duration(t));var n=0;return e.isDuration(t)&&(n=24*Math.floor(t.asDays())),this.hours(n+t.hours()).minutes(t.minutes()).seconds(t.seconds()).milliseconds(t.milliseconds())},qt.stripTime=function(){return this._ambigTime||(this.utc(!0),this.set({hours:0,minutes:0,seconds:0,ms:0}),this._ambigTime=!0,this._ambigZone=!0),this},qt.hasTime=function(){return!this._ambigTime},qt.stripZone=function(){var t;return this._ambigZone||(t=this._ambigTime,this.utc(!0),this._ambigTime=t||!1,this._ambigZone=!0),this},qt.hasZone=function(){return!this._ambigZone},qt.local=function(t){return Zt.local.call(this,this._ambigZone||t),this._ambigTime=!1,this._ambigZone=!1,this},qt.utc=function(t){return Zt.utc.call(this,t),this._ambigTime=!1,this._ambigZone=!1,this},qt.utcOffset=function(t){return null!=t&&(this._ambigTime=!1,this._ambigZone=!1),Zt.utcOffset.apply(this,arguments)},qt.format=function(){return this._fullCalendar&&arguments[0]?Qt(this,arguments[0]):this._ambigTime?Kt(this,"YYYY-MM-DD"):this._ambigZone?Kt(this,"YYYY-MM-DD[T]HH:mm:ss"):Zt.format.apply(this,arguments)},qt.toISOString=function(){return this._ambigTime?Kt(this,"YYYY-MM-DD"):this._ambigZone?Kt(this,"YYYY-MM-DD[T]HH:mm:ss"):Zt.toISOString.apply(this,arguments)},function(){function t(t,e){return c(r(e).fakeFormatString,t)}function e(t,e){return Zt.format.call(t,e)}function n(t,e,n,s,o){var l;return t=Ot.moment.parseZone(t),e=Ot.moment.parseZone(e),l=t.localeData(),n=l.longDateFormat(n)||n,i(r(n),t,e,s||" - ",o)}function i(t,e,n,i,r){var s,o,l,a=t.sameUnits,u=e.clone().stripZone(),c=n.clone().stripZone(),f=d(t.fakeFormatString,e),g=d(t.fakeFormatString,n),p="",v="",m="",y="",S="";for(s=0;s<a.length&&(!a[s]||u.isSame(c,a[s]));s++)p+=f[s];for(o=a.length-1;o>s&&(!a[o]||u.isSame(c,a[o]))&&(o-1!==s||"."!==f[o]);o--)v=f[o]+v;for(l=s;l<=o;l++)m+=f[l],y+=g[l];return(m||y)&&(S=r?y+i+m:m+i+y),h(p+S+v)}function r(t){return w[t]||(w[t]=s(t))}function s(t){var e=o(t);return{fakeFormatString:a(e),sameUnits:u(e)}}function o(t){for(var e,n=[],i=/\[([^\]]*)\]|\(([^\)]*)\)|(LTS|LT|(\w)\4*o?)|([^\w\[\(]+)/g;e=i.exec(t);)e[1]?n.push.apply(n,l(e[1])):e[2]?n.push({maybe:o(e[2])}):e[3]?n.push({token:e[3]}):e[5]&&n.push.apply(n,l(e[5]));return n}function l(t){return". "===t?["."," "]:[t]}function a(t){var e,n,i=[];for(e=0;e<t.length;e++)n=t[e],"string"==typeof n?i.push("["+n+"]"):n.token?n.token in y?i.push(p+"["+n.token+"]"):i.push(n.token):n.maybe&&i.push(v+a(n.maybe)+v);return i.join(g)}function u(t){var e,n,i,r=[];for(e=0;e<t.length;e++)n=t[e],n.token?(i=S[n.token.charAt(0)],r.push(i?i.unit:"second")):n.maybe?r.push.apply(r,u(n.maybe)):r.push(null);return r}function c(t,e){return h(d(t,e).join(""))}function d(t,n){var i,r,s=[],o=e(n,t),l=o.split(g);for(i=0;i<l.length;i++)r=l[i],r.charAt(0)===p?s.push(y[r.substring(1)](n)):s.push(r);return s}function h(t){return t.replace(m,function(t,e){
return e.match(/[1-9]/)?e:""})}function f(t){var e,n,i,r,s=o(t);for(e=0;e<s.length;e++)n=s[e],n.token&&(i=S[n.token.charAt(0)],i&&(!r||i.value>r.value)&&(r=i));return r?r.unit:null}Ot.formatDate=t,Ot.formatRange=n,Ot.oldMomentFormat=e,Ot.queryMostGranularFormatUnit=f;var g="\v",p="",v="",m=new RegExp(v+"([^"+v+"]*)"+v,"g"),y={t:function(t){return e(t,"a").charAt(0)},T:function(t){return e(t,"A").charAt(0)}},S={Y:{value:1,unit:"year"},M:{value:2,unit:"month"},W:{value:3,unit:"week"},w:{value:3,unit:"week"},D:{value:4,unit:"day"},d:{value:4,unit:"day"}},w={}}();var Qt=Ot.formatDate,Xt=Ot.formatRange,Kt=Ot.oldMomentFormat;Ot.Class=ct,ct.extend=function(){var t,e,n=arguments.length;for(t=0;t<n;t++)e=arguments[t],t<n-1&&ht(this,e);return dt(this,e||{})},ct.mixin=function(t){ht(this,t)},Ot.Promise=ft,ft.immediate=!0,ft.resolve=function(e){if(e&&"function"==typeof e.resolve)return e.promise();if(e&&"function"==typeof e.then)return e;var n=t.Deferred().resolve(e),i=n.promise();if(ft.immediate){var r=i.then;i._value=e,i.then=function(t,n){return"function"==typeof t?ft.resolve(t(e)):r.call(i,t,n)}}return i},ft.reject=function(){return t.Deferred().reject().promise()},ft.all=function(e){var n,i,r,s=!1;if(ft.immediate)for(s=!0,n=[],i=0;i<e.length;i++)if(r=e[i],r&&"function"==typeof r.state&&"resolved"===r.state()&&"_value"in r)n.push(r._value);else{if(r&&"function"==typeof r.then){s=!1;break}n.push(r)}return s?ft.resolve(n):t.when.apply(t.when,e).then(function(){return t.when(t.makeArray(arguments))})},Ot.TaskQueue=gt;var Jt=Ot.EmitterMixin={on:function(e,n){return t(this).on(e,this._prepareIntercept(n)),this},one:function(e,n){return t(this).one(e,this._prepareIntercept(n)),this},_prepareIntercept:function(e){var n=function(t,n){return e.apply(n.context||this,n.args||[])};return e.guid||(e.guid=t.guid++),n.guid=e.guid,n},off:function(e,n){return t(this).off(e,n),this},trigger:function(e){var n=Array.prototype.slice.call(arguments,1);return t(this).triggerHandler(e,{args:n}),this},triggerWith:function(e,n,i){return t(this).triggerHandler(e,{context:n,args:i}),this}},te=Ot.ListenerMixin=function(){var e=0,n={listenerId:null,listenTo:function(e,n,i){if("object"==typeof n)for(var r in n)n.hasOwnProperty(r)&&this.listenTo(e,r,n[r]);else"string"==typeof n&&e.on(n+"."+this.getListenerNamespace(),t.proxy(i,this))},stopListeningTo:function(t,e){t.off((e||"")+"."+this.getListenerNamespace())},getListenerNamespace:function(){return null==this.listenerId&&(this.listenerId=e++),"_listener"+this.listenerId}};return n}(),ee=ct.extend(te,{isHidden:!0,options:null,el:null,margin:10,constructor:function(t){this.options=t||{}},show:function(){this.isHidden&&(this.el||this.render(),this.el.show(),this.position(),this.isHidden=!1,this.trigger("show"))},hide:function(){this.isHidden||(this.el.hide(),this.isHidden=!0,this.trigger("hide"))},render:function(){var e=this,n=this.options;this.el=t('<div class="fc-popover"/>').addClass(n.className||"").css({top:0,left:0}).append(n.content).appendTo(n.parentEl),this.el.on("click",".fc-close",function(){e.hide()}),n.autoHide&&this.listenTo(t(document),"mousedown",this.documentMousedown)},documentMousedown:function(e){this.el&&!t(e.target).closest(this.el).length&&this.hide()},removeElement:function(){this.hide(),this.el&&(this.el.remove(),this.el=null),this.stopListeningTo(t(document),"mousedown")},position:function(){var e,n,i,r,s,o=this.options,l=this.el.offsetParent().offset(),a=this.el.outerWidth(),u=this.el.outerHeight(),c=t(window),h=d(this.el);r=o.top||0,s=void 0!==o.left?o.left:void 0!==o.right?o.right-a:0,h.is(window)||h.is(document)?(h=c,e=0,n=0):(i=h.offset(),e=i.top,n=i.left),e+=c.scrollTop(),n+=c.scrollLeft(),o.viewportConstrain!==!1&&(r=Math.min(r,e+h.outerHeight()-u-this.margin),r=Math.max(r,e+this.margin),s=Math.min(s,n+h.outerWidth()-a-this.margin),s=Math.max(s,n+this.margin)),this.el.css({top:r-l.top,left:s-l.left})},trigger:function(t){this.options[t]&&this.options[t].apply(this,Array.prototype.slice.call(arguments,1))}}),ne=Ot.CoordCache=ct.extend({els:null,forcedOffsetParentEl:null,origin:null,boundingRect:null,isHorizontal:!1,isVertical:!1,lefts:null,rights:null,tops:null,bottoms:null,constructor:function(e){this.els=t(e.els),this.isHorizontal=e.isHorizontal,this.isVertical=e.isVertical,this.forcedOffsetParentEl=e.offsetParent?t(e.offsetParent):null},build:function(){var t=this.forcedOffsetParentEl;!t&&this.els.length>0&&(t=this.els.eq(0).offsetParent()),this.origin=t?t.offset():null,this.boundingRect=this.queryBoundingRect(),this.isHorizontal&&this.buildElHorizontals(),this.isVertical&&this.buildElVerticals()},clear:function(){this.origin=null,this.boundingRect=null,this.lefts=null,this.rights=null,this.tops=null,this.bottoms=null},ensureBuilt:function(){this.origin||this.build()},buildElHorizontals:function(){var e=[],n=[];this.els.each(function(i,r){var s=t(r),o=s.offset().left,l=s.outerWidth();e.push(o),n.push(o+l)}),this.lefts=e,this.rights=n},buildElVerticals:function(){var e=[],n=[];this.els.each(function(i,r){var s=t(r),o=s.offset().top,l=s.outerHeight();e.push(o),n.push(o+l)}),this.tops=e,this.bottoms=n},getHorizontalIndex:function(t){this.ensureBuilt();var e,n=this.lefts,i=this.rights,r=n.length;for(e=0;e<r;e++)if(t>=n[e]&&t<i[e])return e},getVerticalIndex:function(t){this.ensureBuilt();var e,n=this.tops,i=this.bottoms,r=n.length;for(e=0;e<r;e++)if(t>=n[e]&&t<i[e])return e},getLeftOffset:function(t){return this.ensureBuilt(),this.lefts[t]},getLeftPosition:function(t){return this.ensureBuilt(),this.lefts[t]-this.origin.left},getRightOffset:function(t){return this.ensureBuilt(),this.rights[t]},getRightPosition:function(t){return this.ensureBuilt(),this.rights[t]-this.origin.left},getWidth:function(t){return this.ensureBuilt(),this.rights[t]-this.lefts[t]},getTopOffset:function(t){return this.ensureBuilt(),this.tops[t]},getTopPosition:function(t){return this.ensureBuilt(),this.tops[t]-this.origin.top},getBottomOffset:function(t){return this.ensureBuilt(),this.bottoms[t]},getBottomPosition:function(t){return this.ensureBuilt(),this.bottoms[t]-this.origin.top},getHeight:function(t){return this.ensureBuilt(),this.bottoms[t]-this.tops[t]},queryBoundingRect:function(){var t;return this.els.length>0&&(t=d(this.els.eq(0)),!t.is(document))?f(t):null},isPointInBounds:function(t,e){return this.isLeftInBounds(t)&&this.isTopInBounds(e)},isLeftInBounds:function(t){return!this.boundingRect||t>=this.boundingRect.left&&t<this.boundingRect.right},isTopInBounds:function(t){return!this.boundingRect||t>=this.boundingRect.top&&t<this.boundingRect.bottom}}),ie=Ot.DragListener=ct.extend(te,{options:null,subjectEl:null,originX:null,originY:null,scrollEl:null,isInteracting:!1,isDistanceSurpassed:!1,isDelayEnded:!1,isDragging:!1,isTouch:!1,delay:null,delayTimeoutId:null,minDistance:null,shouldCancelTouchScroll:!0,scrollAlwaysKills:!1,constructor:function(t){this.options=t||{}},startInteraction:function(e,n){var i=D(e);if("mousedown"===e.type){if(se.get().shouldIgnoreMouse())return;if(!w(e))return;e.preventDefault()}this.isInteracting||(n=n||{},this.delay=J(n.delay,this.options.delay,0),this.minDistance=J(n.distance,this.options.distance,0),this.subjectEl=this.options.subjectEl,T(t("body")),this.isInteracting=!0,this.isTouch=i,this.isDelayEnded=!1,this.isDistanceSurpassed=!1,this.originX=E(e),this.originY=b(e),this.scrollEl=d(t(e.target)),this.bindHandlers(),this.initAutoScroll(),this.handleInteractionStart(e),this.startDelay(e),this.minDistance||this.handleDistanceSurpassed(e))},handleInteractionStart:function(t){this.trigger("interactionStart",t)},endInteraction:function(e,n){this.isInteracting&&(this.endDrag(e),this.delayTimeoutId&&(clearTimeout(this.delayTimeoutId),this.delayTimeoutId=null),this.destroyAutoScroll(),this.unbindHandlers(),this.isInteracting=!1,this.handleInteractionEnd(e,n),C(t("body")))},handleInteractionEnd:function(t,e){this.trigger("interactionEnd",t,e||!1)},bindHandlers:function(){var t=se.get();this.isTouch?this.listenTo(t,{touchmove:this.handleTouchMove,touchend:this.endInteraction,scroll:this.handleTouchScroll}):this.listenTo(t,{mousemove:this.handleMouseMove,mouseup:this.endInteraction}),this.listenTo(t,{selectstart:H,contextmenu:H})},unbindHandlers:function(){this.stopListeningTo(se.get())},startDrag:function(t,e){this.startInteraction(t,e),this.isDragging||(this.isDragging=!0,this.handleDragStart(t))},handleDragStart:function(t){this.trigger("dragStart",t)},handleMove:function(t){var e,n=E(t)-this.originX,i=b(t)-this.originY,r=this.minDistance;this.isDistanceSurpassed||(e=n*n+i*i,e>=r*r&&this.handleDistanceSurpassed(t)),this.isDragging&&this.handleDrag(n,i,t)},handleDrag:function(t,e,n){this.trigger("drag",t,e,n),this.updateAutoScroll(n)},endDrag:function(t){this.isDragging&&(this.isDragging=!1,this.handleDragEnd(t))},handleDragEnd:function(t){this.trigger("dragEnd",t)},startDelay:function(t){var e=this;this.delay?this.delayTimeoutId=setTimeout(function(){e.handleDelayEnd(t)},this.delay):this.handleDelayEnd(t)},handleDelayEnd:function(t){this.isDelayEnded=!0,this.isDistanceSurpassed&&this.startDrag(t)},handleDistanceSurpassed:function(t){this.isDistanceSurpassed=!0,this.isDelayEnded&&this.startDrag(t)},handleTouchMove:function(t){this.isDragging&&this.shouldCancelTouchScroll&&t.preventDefault(),this.handleMove(t)},handleMouseMove:function(t){this.handleMove(t)},handleTouchScroll:function(t){this.isDragging&&!this.scrollAlwaysKills||this.endInteraction(t,!0)},trigger:function(t){this.options[t]&&this.options[t].apply(this,Array.prototype.slice.call(arguments,1)),this["_"+t]&&this["_"+t].apply(this,Array.prototype.slice.call(arguments,1))}});ie.mixin({isAutoScroll:!1,scrollBounds:null,scrollTopVel:null,scrollLeftVel:null,scrollIntervalId:null,scrollSensitivity:30,scrollSpeed:200,scrollIntervalMs:50,initAutoScroll:function(){var t=this.scrollEl;this.isAutoScroll=this.options.scroll&&t&&!t.is(window)&&!t.is(document),this.isAutoScroll&&this.listenTo(t,"scroll",at(this.handleDebouncedScroll,100))},destroyAutoScroll:function(){this.endAutoScroll(),this.isAutoScroll&&this.stopListeningTo(this.scrollEl,"scroll")},computeScrollBounds:function(){this.isAutoScroll&&(this.scrollBounds=h(this.scrollEl))},updateAutoScroll:function(t){var e,n,i,r,s=this.scrollSensitivity,o=this.scrollBounds,l=0,a=0;o&&(e=(s-(b(t)-o.top))/s,n=(s-(o.bottom-b(t)))/s,i=(s-(E(t)-o.left))/s,r=(s-(o.right-E(t)))/s,e>=0&&e<=1?l=e*this.scrollSpeed*-1:n>=0&&n<=1&&(l=n*this.scrollSpeed),i>=0&&i<=1?a=i*this.scrollSpeed*-1:r>=0&&r<=1&&(a=r*this.scrollSpeed)),this.setScrollVel(l,a)},setScrollVel:function(t,e){this.scrollTopVel=t,this.scrollLeftVel=e,this.constrainScrollVel(),!this.scrollTopVel&&!this.scrollLeftVel||this.scrollIntervalId||(this.scrollIntervalId=setInterval(lt(this,"scrollIntervalFunc"),this.scrollIntervalMs))},constrainScrollVel:function(){var t=this.scrollEl;this.scrollTopVel<0?t.scrollTop()<=0&&(this.scrollTopVel=0):this.scrollTopVel>0&&t.scrollTop()+t[0].clientHeight>=t[0].scrollHeight&&(this.scrollTopVel=0),this.scrollLeftVel<0?t.scrollLeft()<=0&&(this.scrollLeftVel=0):this.scrollLeftVel>0&&t.scrollLeft()+t[0].clientWidth>=t[0].scrollWidth&&(this.scrollLeftVel=0)},scrollIntervalFunc:function(){var t=this.scrollEl,e=this.scrollIntervalMs/1e3;this.scrollTopVel&&t.scrollTop(t.scrollTop()+this.scrollTopVel*e),this.scrollLeftVel&&t.scrollLeft(t.scrollLeft()+this.scrollLeftVel*e),this.constrainScrollVel(),this.scrollTopVel||this.scrollLeftVel||this.endAutoScroll()},endAutoScroll:function(){this.scrollIntervalId&&(clearInterval(this.scrollIntervalId),this.scrollIntervalId=null,this.handleScrollEnd())},handleDebouncedScroll:function(){this.scrollIntervalId||this.handleScrollEnd()},handleScrollEnd:function(){}});var re=ie.extend({component:null,origHit:null,hit:null,coordAdjust:null,constructor:function(t,e){ie.call(this,e),this.component=t},handleInteractionStart:function(t){var e,n,i,r=this.subjectEl;this.component.hitsNeeded(),this.computeScrollBounds(),t?(n={left:E(t),top:b(t)},i=n,r&&(e=h(r),i=R(i,e)),this.origHit=this.queryHit(i.left,i.top),r&&this.options.subjectCenter&&(this.origHit&&(e=x(this.origHit,e)||e),i=I(e)),this.coordAdjust=k(i,n)):(this.origHit=null,this.coordAdjust=null),ie.prototype.handleInteractionStart.apply(this,arguments)},handleDragStart:function(t){var e;ie.prototype.handleDragStart.apply(this,arguments),e=this.queryHit(E(t),b(t)),e&&this.handleHitOver(e)},handleDrag:function(t,e,n){var i;ie.prototype.handleDrag.apply(this,arguments),i=this.queryHit(E(n),b(n)),pt(i,this.hit)||(this.hit&&this.handleHitOut(),i&&this.handleHitOver(i))},handleDragEnd:function(){this.handleHitDone(),ie.prototype.handleDragEnd.apply(this,arguments)},handleHitOver:function(t){var e=pt(t,this.origHit);this.hit=t,this.trigger("hitOver",this.hit,e,this.origHit)},handleHitOut:function(){this.hit&&(this.trigger("hitOut",this.hit),this.handleHitDone(),this.hit=null)},handleHitDone:function(){this.hit&&this.trigger("hitDone",this.hit)},handleInteractionEnd:function(){ie.prototype.handleInteractionEnd.apply(this,arguments),this.origHit=null,this.hit=null,this.component.hitsNotNeeded()},handleScrollEnd:function(){ie.prototype.handleScrollEnd.apply(this,arguments),this.isDragging&&(this.component.releaseHits(),this.component.prepareHits())},queryHit:function(t,e){return this.coordAdjust&&(t+=this.coordAdjust.left,e+=this.coordAdjust.top),this.component.queryHit(t,e)}});Ot.touchMouseIgnoreWait=500;var se=ct.extend(te,Jt,{isTouching:!1,mouseIgnoreDepth:0,handleScrollProxy:null,bind:function(){var e=this;this.listenTo(t(document),{touchstart:this.handleTouchStart,touchcancel:this.handleTouchCancel,touchend:this.handleTouchEnd,mousedown:this.handleMouseDown,mousemove:this.handleMouseMove,mouseup:this.handleMouseUp,click:this.handleClick,selectstart:this.handleSelectStart,contextmenu:this.handleContextMenu}),window.addEventListener("touchmove",this.handleTouchMoveProxy=function(n){e.handleTouchMove(t.Event(n))},{passive:!1}),window.addEventListener("scroll",this.handleScrollProxy=function(n){e.handleScroll(t.Event(n))},!0)},unbind:function(){this.stopListeningTo(t(document)),window.removeEventListener("touchmove",this.handleTouchMoveProxy),window.removeEventListener("scroll",this.handleScrollProxy,!0)},handleTouchStart:function(t){this.stopTouch(t,!0),this.isTouching=!0,this.trigger("touchstart",t)},handleTouchMove:function(t){this.isTouching&&this.trigger("touchmove",t)},handleTouchCancel:function(t){this.isTouching&&(this.trigger("touchcancel",t),this.stopTouch(t))},handleTouchEnd:function(t){this.stopTouch(t)},handleMouseDown:function(t){this.shouldIgnoreMouse()||this.trigger("mousedown",t)},handleMouseMove:function(t){this.shouldIgnoreMouse()||this.trigger("mousemove",t)},handleMouseUp:function(t){this.shouldIgnoreMouse()||this.trigger("mouseup",t)},handleClick:function(t){this.shouldIgnoreMouse()||this.trigger("click",t)},handleSelectStart:function(t){this.trigger("selectstart",t)},handleContextMenu:function(t){this.trigger("contextmenu",t)},handleScroll:function(t){this.trigger("scroll",t)},stopTouch:function(t,e){this.isTouching&&(this.isTouching=!1,this.trigger("touchend",t),e||this.startTouchMouseIgnore())},startTouchMouseIgnore:function(){var t=this,e=Ot.touchMouseIgnoreWait;e&&(this.mouseIgnoreDepth++,setTimeout(function(){t.mouseIgnoreDepth--},e))},shouldIgnoreMouse:function(){return this.isTouching||Boolean(this.mouseIgnoreDepth)}});!function(){var t=null,e=0;se.get=function(){return t||(t=new se,t.bind()),t},se.needed=function(){se.get(),e++},se.unneeded=function(){e--,e||(t.unbind(),t=null)}}();var oe=ct.extend(te,{options:null,sourceEl:null,el:null,parentEl:null,top0:null,left0:null,y0:null,x0:null,topDelta:null,leftDelta:null,isFollowing:!1,isHidden:!1,isAnimating:!1,constructor:function(e,n){this.options=n=n||{},this.sourceEl=e,this.parentEl=n.parentEl?t(n.parentEl):e.parent()},start:function(e){this.isFollowing||(this.isFollowing=!0,this.y0=b(e),this.x0=E(e),this.topDelta=0,this.leftDelta=0,this.isHidden||this.updatePosition(),D(e)?this.listenTo(t(document),"touchmove",this.handleMove):this.listenTo(t(document),"mousemove",this.handleMove))},stop:function(e,n){function i(){r.isAnimating=!1,r.removeElement(),r.top0=r.left0=null,n&&n()}var r=this,s=this.options.revertDuration;this.isFollowing&&!this.isAnimating&&(this.isFollowing=!1,this.stopListeningTo(t(document)),e&&s&&!this.isHidden?(this.isAnimating=!0,this.el.animate({top:this.top0,left:this.left0},{duration:s,complete:i})):i())},getEl:function(){var t=this.el;return t||(t=this.el=this.sourceEl.clone().addClass(this.options.additionalClass||"").css({position:"absolute",visibility:"",display:this.isHidden?"none":"",margin:0,right:"auto",bottom:"auto",width:this.sourceEl.width(),height:this.sourceEl.height(),opacity:this.options.opacity||"",zIndex:this.options.zIndex}),t.addClass("fc-unselectable"),t.appendTo(this.parentEl)),t},removeElement:function(){this.el&&(this.el.remove(),this.el=null)},updatePosition:function(){var t,e;this.getEl(),null===this.top0&&(t=this.sourceEl.offset(),e=this.el.offsetParent().offset(),this.top0=t.top-e.top,this.left0=t.left-e.left),this.el.css({top:this.top0+this.topDelta,left:this.left0+this.leftDelta})},handleMove:function(t){this.topDelta=b(t)-this.y0,this.leftDelta=E(t)-this.x0,this.isHidden||this.updatePosition()},hide:function(){this.isHidden||(this.isHidden=!0,this.el&&this.el.hide())},show:function(){this.isHidden&&(this.isHidden=!1,this.updatePosition(),this.getEl().show())}}),le=Ot.Grid=ct.extend(te,{hasDayInteractions:!0,view:null,isRTL:null,start:null,end:null,el:null,elsByFill:null,eventTimeFormat:null,displayEventTime:null,displayEventEnd:null,minResizeDuration:null,largeUnit:null,dayClickListener:null,daySelectListener:null,segDragListener:null,segResizeListener:null,externalDragListener:null,constructor:function(t){this.view=t,this.isRTL=t.opt("isRTL"),this.elsByFill={},this.dayClickListener=this.buildDayClickListener(),this.daySelectListener=this.buildDaySelectListener()},computeEventTimeFormat:function(){return this.view.opt("smallTimeFormat")},computeDisplayEventTime:function(){return!0},computeDisplayEventEnd:function(){return!0},setRange:function(t){this.start=t.start.clone(),this.end=t.end.clone(),this.rangeUpdated(),this.processRangeOptions()},rangeUpdated:function(){},processRangeOptions:function(){var t,e,n=this.view;this.eventTimeFormat=n.opt("eventTimeFormat")||n.opt("timeFormat")||this.computeEventTimeFormat(),t=n.opt("displayEventTime"),null==t&&(t=this.computeDisplayEventTime()),e=n.opt("displayEventEnd"),null==e&&(e=this.computeDisplayEventEnd()),this.displayEventTime=t,this.displayEventEnd=e},spanToSegs:function(t){},diffDates:function(t,e){return this.largeUnit?O(t,e,this.largeUnit):z(t,e)},hitsNeededDepth:0,hitsNeeded:function(){this.hitsNeededDepth++||this.prepareHits()},hitsNotNeeded:function(){this.hitsNeededDepth&&!--this.hitsNeededDepth&&this.releaseHits()},prepareHits:function(){},releaseHits:function(){},queryHit:function(t,e){},getHitSpan:function(t){},getHitEl:function(t){},setElement:function(t){this.el=t,this.hasDayInteractions&&(T(t),this.bindDayHandler("touchstart",this.dayTouchStart),this.bindDayHandler("mousedown",this.dayMousedown)),this.bindSegHandlers(),this.bindGlobalHandlers()},bindDayHandler:function(e,n){var i=this;this.el.on(e,function(e){if(!t(e.target).is(i.segSelector+","+i.segSelector+" *,.fc-more,a[data-goto]"))return n.call(i,e)})},removeElement:function(){this.unbindGlobalHandlers(),this.clearDragListeners(),this.el.remove()},renderSkeleton:function(){},renderDates:function(){},unrenderDates:function(){},bindGlobalHandlers:function(){this.listenTo(t(document),{dragstart:this.externalDragStart,sortstart:this.externalDragStart})},unbindGlobalHandlers:function(){this.stopListeningTo(t(document))},dayMousedown:function(t){var e=this.view;e.isSelected||e.selectedEvent||(this.dayClickListener.startInteraction(t),e.opt("selectable")&&this.daySelectListener.startInteraction(t,{distance:e.opt("selectMinDistance")}))},dayTouchStart:function(t){var e,n=this.view;n.isSelected||n.selectedEvent||(e=n.opt("selectLongPressDelay"),null==e&&(e=n.opt("longPressDelay")),this.dayClickListener.startInteraction(t),n.opt("selectable")&&this.daySelectListener.startInteraction(t,{delay:e}))},buildDayClickListener:function(){var t,e=this,n=this.view,i=new re(this,{scroll:n.opt("dragScroll"),interactionStart:function(){t=i.origHit},hitOver:function(e,n,i){n||(t=null)},hitOut:function(){t=null},interactionEnd:function(i,r){!r&&t&&n.triggerDayClick(e.getHitSpan(t),e.getHitEl(t),i)}});return i.shouldCancelTouchScroll=!1,i.scrollAlwaysKills=!0,i},buildDaySelectListener:function(){var t,e=this,n=this.view,i=new re(this,{scroll:n.opt("dragScroll"),interactionStart:function(){t=null},dragStart:function(){n.unselect()},hitOver:function(n,i,r){r&&(t=e.computeSelection(e.getHitSpan(r),e.getHitSpan(n)),t?e.renderSelection(t):t===!1&&s())},hitOut:function(){t=null,e.unrenderSelection()},hitDone:function(){o()},interactionEnd:function(e,i){!i&&t&&n.reportSelection(t,e)}});return i},clearDragListeners:function(){this.dayClickListener.endInteraction(),this.daySelectListener.endInteraction(),this.segDragListener&&this.segDragListener.endInteraction(),this.segResizeListener&&this.segResizeListener.endInteraction(),this.externalDragListener&&this.externalDragListener.endInteraction()},renderEventLocationHelper:function(t,e){var n=this.fabricateHelperEvent(t,e);return this.renderHelper(n,e)},fabricateHelperEvent:function(t,e){var n=e?Z(e.event):{};return n.start=t.start.clone(),n.end=t.end?t.end.clone():null,n.allDay=null,this.view.calendar.normalizeEventDates(n),n.className=(n.className||[]).concat("fc-helper"),e||(n.editable=!1),n},renderHelper:function(t,e){},unrenderHelper:function(){},renderSelection:function(t){this.renderHighlight(t)},unrenderSelection:function(){this.unrenderHighlight()},computeSelection:function(t,e){var n=this.computeSelectionSpan(t,e);return!(n&&!this.view.calendar.isSelectionSpanAllowed(n))&&n},computeSelectionSpan:function(t,e){var n=[t.start,t.end,e.start,e.end];return n.sort(st),{start:n[0].clone(),end:n[3].clone()}},renderHighlight:function(t){this.renderFill("highlight",this.spanToSegs(t))},unrenderHighlight:function(){this.unrenderFill("highlight")},highlightSegClasses:function(){return["fc-highlight"]},renderBusinessHours:function(){},unrenderBusinessHours:function(){},getNowIndicatorUnit:function(){},renderNowIndicator:function(t){},unrenderNowIndicator:function(){},renderFill:function(t,e){},unrenderFill:function(t){var e=this.elsByFill[t];e&&(e.remove(),delete this.elsByFill[t])},renderFillSegEls:function(e,n){var i,r=this,s=this[e+"SegEl"],o="",l=[];if(n.length){for(i=0;i<n.length;i++)o+=this.fillSegHtml(e,n[i]);t(o).each(function(e,i){var o=n[e],a=t(i);s&&(a=s.call(r,o,a)),a&&(a=t(a),a.is(r.fillSegTag)&&(o.el=a,l.push(o)))})}return l},fillSegTag:"div",fillSegHtml:function(t,e){var n=this[t+"SegClasses"],i=this[t+"SegCss"],r=n?n.call(this,e):[],s=nt(i?i.call(this,e):{});return"<"+this.fillSegTag+(r.length?' class="'+r.join(" ")+'"':"")+(s?' style="'+s+'"':"")+" />"},getDayClasses:function(t,e){var n=this.view,i=n.calendar.getNow(),r=["fc-"+_t[t.day()]];return 1==n.intervalDuration.as("months")&&t.month()!=n.intervalStart.month()&&r.push("fc-other-month"),t.isSame(i,"day")?(r.push("fc-today"),e!==!0&&r.push(n.highlightStateClass)):t<i?r.push("fc-past"):r.push("fc-future"),r}});le.mixin({segSelector:".fc-event-container > *",mousedOverSeg:null,isDraggingSeg:!1,isResizingSeg:!1,isDraggingExternal:!1,segs:null,renderEvents:function(t){var e,n=[],i=[];for(e=0;e<t.length;e++)(yt(t[e])?n:i).push(t[e]);this.segs=[].concat(this.renderBgEvents(n),this.renderFgEvents(i))},renderBgEvents:function(t){var e=this.eventsToSegs(t);return this.renderBgSegs(e)||e},renderFgEvents:function(t){var e=this.eventsToSegs(t);return this.renderFgSegs(e)||e},unrenderEvents:function(){this.handleSegMouseout(),this.clearDragListeners(),this.unrenderFgSegs(),this.unrenderBgSegs(),this.segs=null},getEventSegs:function(){return this.segs||[]},renderFgSegs:function(t){},unrenderFgSegs:function(){},renderFgSegEls:function(e,n){var i,r=this.view,s="",o=[];if(e.length){for(i=0;i<e.length;i++)s+=this.fgSegHtml(e[i],n);t(s).each(function(n,i){var s=e[n],l=r.resolveEventEl(s.event,t(i));l&&(l.data("fc-seg",s),s.el=l,o.push(s))})}return o},fgSegHtml:function(t,e){},renderBgSegs:function(t){return this.renderFill("bgEvent",t)},unrenderBgSegs:function(){this.unrenderFill("bgEvent")},bgEventSegEl:function(t,e){return this.view.resolveEventEl(t.event,e)},bgEventSegClasses:function(t){var e=t.event,n=e.source||{};return["fc-bgevent"].concat(e.className,n.className||[])},bgEventSegCss:function(t){return{"background-color":this.getSegSkinCss(t)["background-color"]}},businessHoursSegClasses:function(t){return["fc-nonbusiness","fc-bgevent"]},buildBusinessHourSegs:function(t,e){return this.eventsToSegs(this.buildBusinessHourEvents(t,e))},buildBusinessHourEvents:function(e,n){var i,r=this.view.calendar;return null==n&&(n=r.options.businessHours),i=r.computeBusinessHourEvents(e,n),!i.length&&n&&(i=[t.extend({},we,{start:this.view.end,end:this.view.end,dow:null})]),i},bindSegHandlers:function(){this.bindSegHandlersToEl(this.el)},bindSegHandlersToEl:function(t){this.bindSegHandlerToEl(t,"touchstart",this.handleSegTouchStart),this.bindSegHandlerToEl(t,"mouseenter",this.handleSegMouseover),this.bindSegHandlerToEl(t,"mouseleave",this.handleSegMouseout),this.bindSegHandlerToEl(t,"mousedown",this.handleSegMousedown),this.bindSegHandlerToEl(t,"click",this.handleSegClick)},bindSegHandlerToEl:function(e,n,i){var r=this;e.on(n,this.segSelector,function(e){var n=t(this).data("fc-seg");if(n&&!r.isDraggingSeg&&!r.isResizingSeg)return i.call(r,n,e)})},handleSegClick:function(t,e){var n=this.view.publiclyTrigger("eventClick",t.el[0],t.event,e);n===!1&&e.preventDefault()},handleSegMouseover:function(t,e){se.get().shouldIgnoreMouse()||this.mousedOverSeg||(this.mousedOverSeg=t,this.view.isEventResizable(t.event)&&t.el.addClass("fc-allow-mouse-resize"),this.view.publiclyTrigger("eventMouseover",t.el[0],t.event,e))},handleSegMouseout:function(t,e){e=e||{},this.mousedOverSeg&&(t=t||this.mousedOverSeg,this.mousedOverSeg=null,this.view.isEventResizable(t.event)&&t.el.removeClass("fc-allow-mouse-resize"),this.view.publiclyTrigger("eventMouseout",t.el[0],t.event,e))},handleSegMousedown:function(t,e){var n=this.startSegResize(t,e,{distance:5});!n&&this.view.isEventDraggable(t.event)&&this.buildSegDragListener(t).startInteraction(e,{distance:5})},handleSegTouchStart:function(t,e){var n,i,r=this.view,s=t.event,o=r.isEventSelected(s),l=r.isEventDraggable(s),a=r.isEventResizable(s),u=!1;o&&a&&(u=this.startSegResize(t,e)),u||!l&&!a||(i=r.opt("eventLongPressDelay"),null==i&&(i=r.opt("longPressDelay")),n=l?this.buildSegDragListener(t):this.buildSegSelectListener(t),n.startInteraction(e,{delay:o?0:i}))},startSegResize:function(e,n,i){return!!t(n.target).is(".fc-resizer")&&(this.buildSegResizeListener(e,t(n.target).is(".fc-start-resizer")).startInteraction(n,i),!0)},buildSegDragListener:function(t){var e,n,i,r=this,l=this.view,a=l.calendar,u=t.el,c=t.event;if(this.segDragListener)return this.segDragListener;var d=this.segDragListener=new re(l,{scroll:l.opt("dragScroll"),subjectEl:u,subjectCenter:!0,interactionStart:function(i){t.component=r,e=!1,n=new oe(t.el,{additionalClass:"fc-dragging",parentEl:l.el,opacity:d.isTouch?null:l.opt("dragOpacity"),revertDuration:l.opt("dragRevertDuration"),zIndex:2}),n.hide(),n.start(i)},dragStart:function(n){d.isTouch&&!l.isEventSelected(c)&&l.selectEvent(c),e=!0,r.handleSegMouseout(t,n),r.segDragStart(t,n),l.hideEvent(c)},hitOver:function(e,o,u){var h;t.hit&&(u=t.hit),i=r.computeEventDrop(u.component.getHitSpan(u),e.component.getHitSpan(e),c),i&&!a.isEventSpanAllowed(r.eventToSpan(i),c)&&(s(),i=null),i&&(h=l.renderDrag(i,t))?(h.addClass("fc-dragging"),d.isTouch||r.applyDragOpacity(h),n.hide()):n.show(),o&&(i=null)},hitOut:function(){l.unrenderDrag(),n.show(),i=null},hitDone:function(){o()},interactionEnd:function(s){delete t.component,n.stop(!i,function(){e&&(l.unrenderDrag(),r.segDragStop(t,s)),i?l.reportSegDrop(t,i,r.largeUnit,u,s):l.showEvent(c)}),r.segDragListener=null}});return d},buildSegSelectListener:function(t){var e=this,n=this.view,i=t.event;if(this.segDragListener)return this.segDragListener;var r=this.segDragListener=new ie({dragStart:function(t){r.isTouch&&!n.isEventSelected(i)&&n.selectEvent(i)},interactionEnd:function(t){e.segDragListener=null}});return r},segDragStart:function(t,e){this.isDraggingSeg=!0,this.view.publiclyTrigger("eventDragStart",t.el[0],t.event,e,{})},segDragStop:function(t,e){this.isDraggingSeg=!1,this.view.publiclyTrigger("eventDragStop",t.el[0],t.event,e,{})},computeEventDrop:function(t,e,n){var i,r,s=this.view.calendar,o=t.start,l=e.start;return o.hasTime()===l.hasTime()?(i=this.diffDates(l,o),n.allDay&&W(i)?(r={start:n.start.clone(),end:s.getEventEnd(n),allDay:!1},s.normalizeEventTimes(r)):r=mt(n),r.start.add(i),r.end&&r.end.add(i)):r={start:l.clone(),end:null,allDay:!l.hasTime()},r},applyDragOpacity:function(t){var e=this.view.opt("dragOpacity");null!=e&&t.css("opacity",e)},externalDragStart:function(e,n){var i,r,s=this.view;s.opt("droppable")&&(i=t((n?n.item:null)||e.target),r=s.opt("dropAccept"),(t.isFunction(r)?r.call(i[0],i):i.is(r))&&(this.isDraggingExternal||this.listenToExternalDrag(i,e,n)))},listenToExternalDrag:function(t,e,n){var i,r=this,l=this.view.calendar,a=Dt(t),u=r.externalDragListener=new re(this,{interactionStart:function(){r.isDraggingExternal=!0},hitOver:function(t){i=r.computeExternalDrop(t.component.getHitSpan(t),a),i&&!l.isExternalSpanAllowed(r.eventToSpan(i),i,a.eventProps)&&(s(),i=null),i&&r.renderDrag(i)},hitOut:function(){i=null},hitDone:function(){o(),r.unrenderDrag()},interactionEnd:function(e){i&&r.view.reportExternalDrop(a,i,t,e,n),r.isDraggingExternal=!1,r.externalDragListener=null}});u.startDrag(e)},computeExternalDrop:function(t,e){var n=this.view.calendar,i={start:n.applyTimezone(t.start),end:null};return e.startTime&&!i.start.hasTime()&&i.start.time(e.startTime),e.duration&&(i.end=i.start.clone().add(e.duration)),i},renderDrag:function(t,e){},unrenderDrag:function(){},buildSegResizeListener:function(t,e){var n,i,r=this,l=this.view,a=l.calendar,u=t.el,c=t.event,d=a.getEventEnd(c),h=this.segResizeListener=new re(this,{scroll:l.opt("dragScroll"),subjectEl:u,interactionStart:function(){n=!1},dragStart:function(e){n=!0,r.handleSegMouseout(t,e),r.segResizeStart(t,e)},hitOver:function(n,o,u){var h=r.getHitSpan(u),f=r.getHitSpan(n);i=e?r.computeEventStartResize(h,f,c):r.computeEventEndResize(h,f,c),i&&(a.isEventSpanAllowed(r.eventToSpan(i),c)?i.start.isSame(c.start.clone().stripZone())&&i.end.isSame(d.clone().stripZone())&&(i=null):(s(),i=null)),i&&(l.hideEvent(c),r.renderEventResize(i,t))},hitOut:function(){i=null,l.showEvent(c)},hitDone:function(){r.unrenderEventResize(),o()},interactionEnd:function(e){n&&r.segResizeStop(t,e),i?l.reportSegResize(t,i,r.largeUnit,u,e):l.showEvent(c),r.segResizeListener=null}});return h},segResizeStart:function(t,e){this.isResizingSeg=!0,this.view.publiclyTrigger("eventResizeStart",t.el[0],t.event,e,{})},segResizeStop:function(t,e){this.isResizingSeg=!1,this.view.publiclyTrigger("eventResizeStop",t.el[0],t.event,e,{})},computeEventStartResize:function(t,e,n){return this.computeEventResize("start",t,e,n)},computeEventEndResize:function(t,e,n){return this.computeEventResize("end",t,e,n)},computeEventResize:function(t,e,n,i){var r,s,o=this.view.calendar,l=this.diffDates(n[t],e[t]);return r={start:i.start.clone(),end:o.getEventEnd(i),allDay:i.allDay},r.allDay&&W(l)&&(r.allDay=!1,o.normalizeEventTimes(r)),r[t].add(l),r.start.isBefore(r.end)||(s=this.minResizeDuration||(i.allDay?o.defaultAllDayEventDuration:o.defaultTimedEventDuration),"start"==t?r.start=r.end.clone().subtract(s):r.end=r.start.clone().add(s)),
r},renderEventResize:function(t,e){},unrenderEventResize:function(){},getEventTimeText:function(t,e,n){return null==e&&(e=this.eventTimeFormat),null==n&&(n=this.displayEventEnd),this.displayEventTime&&t.start.hasTime()?n&&t.end?this.view.formatRange(t,e):t.start.format(e):""},getSegClasses:function(t,e,n){var i=this.view,r=["fc-event",t.isStart?"fc-start":"fc-not-start",t.isEnd?"fc-end":"fc-not-end"].concat(this.getSegCustomClasses(t));return e&&r.push("fc-draggable"),n&&r.push("fc-resizable"),i.isEventSelected(t.event)&&r.push("fc-selected"),r},getSegCustomClasses:function(t){var e=t.event;return[].concat(e.className,e.source?e.source.className:[])},getSegSkinCss:function(t){return{"background-color":this.getSegBackgroundColor(t),"border-color":this.getSegBorderColor(t),color:this.getSegTextColor(t)}},getSegBackgroundColor:function(t){return t.event.backgroundColor||t.event.color||this.getSegDefaultBackgroundColor(t)},getSegDefaultBackgroundColor:function(t){var e=t.event.source||{};return e.backgroundColor||e.color||this.view.opt("eventBackgroundColor")||this.view.opt("eventColor")},getSegBorderColor:function(t){return t.event.borderColor||t.event.color||this.getSegDefaultBorderColor(t)},getSegDefaultBorderColor:function(t){var e=t.event.source||{};return e.borderColor||e.color||this.view.opt("eventBorderColor")||this.view.opt("eventColor")},getSegTextColor:function(t){return t.event.textColor||this.getSegDefaultTextColor(t)},getSegDefaultTextColor:function(t){var e=t.event.source||{};return e.textColor||this.view.opt("eventTextColor")},eventToSegs:function(t){return this.eventsToSegs([t])},eventToSpan:function(t){return this.eventToSpans(t)[0]},eventToSpans:function(t){var e=this.eventToRange(t);return this.eventRangeToSpans(e,t)},eventsToSegs:function(e,n){var i=this,r=Et(e),s=[];return t.each(r,function(t,e){var r,o=[];for(r=0;r<e.length;r++)o.push(i.eventToRange(e[r]));if(St(e[0]))for(o=i.invertRanges(o),r=0;r<o.length;r++)s.push.apply(s,i.eventRangeToSegs(o[r],e[0],n));else for(r=0;r<o.length;r++)s.push.apply(s,i.eventRangeToSegs(o[r],e[r],n))}),s},eventToRange:function(t){var e=this.view.calendar,n=t.start.clone().stripZone(),i=(t.end?t.end.clone():e.getDefaultEventEnd(null!=t.allDay?t.allDay:!t.start.hasTime(),t.start)).stripZone();return e.localizeMoment(n),e.localizeMoment(i),{start:n,end:i}},eventRangeToSegs:function(t,e,n){var i,r=this.eventRangeToSpans(t,e),s=[];for(i=0;i<r.length;i++)s.push.apply(s,this.eventSpanToSegs(r[i],e,n));return s},eventRangeToSpans:function(e,n){return[t.extend({},e)]},eventSpanToSegs:function(t,e,n){var i,r,s=n?n(t):this.spanToSegs(t);for(i=0;i<s.length;i++)r=s[i],r.event=e,r.eventStartMS=+t.start,r.eventDurationMS=t.end-t.start;return s},invertRanges:function(t){var e,n,i=this.view,r=i.start.clone(),s=i.end.clone(),o=[],l=r;for(t.sort(bt),e=0;e<t.length;e++)n=t[e],n.start>l&&o.push({start:l,end:n.start}),l=n.end;return l<s&&o.push({start:l,end:s}),o},sortEventSegs:function(t){t.sort(lt(this,"compareEventSegs"))},compareEventSegs:function(t,e){return t.eventStartMS-e.eventStartMS||e.eventDurationMS-t.eventDurationMS||e.event.allDay-t.event.allDay||M(t.event,e.event,this.view.eventOrderSpecs)}}),Ot.pluckEventDateProps=mt,Ot.isBgEvent=yt,Ot.dataAttrPrefix="";var ae=Ot.DayTableMixin={breakOnWeeks:!1,dayDates:null,dayIndices:null,daysPerRow:null,rowCnt:null,colCnt:null,colHeadFormat:null,updateDayTable:function(){for(var t,e,n,i=this.view,r=this.start.clone(),s=-1,o=[],l=[];r.isBefore(this.end);)i.isHiddenDay(r)?o.push(s+.5):(s++,o.push(s),l.push(r.clone())),r.add(1,"days");if(this.breakOnWeeks){for(e=l[0].day(),t=1;t<l.length&&l[t].day()!=e;t++);n=Math.ceil(l.length/t)}else n=1,t=l.length;this.dayDates=l,this.dayIndices=o,this.daysPerRow=t,this.rowCnt=n,this.updateDayTableCols()},updateDayTableCols:function(){this.colCnt=this.computeColCnt(),this.colHeadFormat=this.view.opt("columnFormat")||this.computeColHeadFormat()},computeColCnt:function(){return this.daysPerRow},getCellDate:function(t,e){return this.dayDates[this.getCellDayIndex(t,e)].clone()},getCellRange:function(t,e){var n=this.getCellDate(t,e),i=n.clone().add(1,"days");return{start:n,end:i}},getCellDayIndex:function(t,e){return t*this.daysPerRow+this.getColDayIndex(e)},getColDayIndex:function(t){return this.isRTL?this.colCnt-1-t:t},getDateDayIndex:function(t){var e=this.dayIndices,n=t.diff(this.start,"days");return n<0?e[0]-1:n>=e.length?e[e.length-1]+1:e[n]},computeColHeadFormat:function(){return this.rowCnt>1||this.colCnt>10?"ddd":this.colCnt>1?this.view.opt("dayOfMonthFormat"):"dddd"},sliceRangeByRow:function(t){var e,n,i,r,s,o=this.daysPerRow,l=this.view.computeDayRange(t),a=this.getDateDayIndex(l.start),u=this.getDateDayIndex(l.end.clone().subtract(1,"days")),c=[];for(e=0;e<this.rowCnt;e++)n=e*o,i=n+o-1,r=Math.max(a,n),s=Math.min(u,i),r=Math.ceil(r),s=Math.floor(s),r<=s&&c.push({row:e,firstRowDayIndex:r-n,lastRowDayIndex:s-n,isStart:r===a,isEnd:s===u});return c},sliceRangeByDay:function(t){var e,n,i,r,s,o,l=this.daysPerRow,a=this.view.computeDayRange(t),u=this.getDateDayIndex(a.start),c=this.getDateDayIndex(a.end.clone().subtract(1,"days")),d=[];for(e=0;e<this.rowCnt;e++)for(n=e*l,i=n+l-1,r=n;r<=i;r++)s=Math.max(u,r),o=Math.min(c,r),s=Math.ceil(s),o=Math.floor(o),s<=o&&d.push({row:e,firstRowDayIndex:s-n,lastRowDayIndex:o-n,isStart:s===u,isEnd:o===c});return d},renderHeadHtml:function(){var t=this.view;return'<div class="fc-row '+t.widgetHeaderClass+'"><table><thead>'+this.renderHeadTrHtml()+"</thead></table></div>"},renderHeadIntroHtml:function(){return this.renderIntroHtml()},renderHeadTrHtml:function(){return"<tr>"+(this.isRTL?"":this.renderHeadIntroHtml())+this.renderHeadDateCellsHtml()+(this.isRTL?this.renderHeadIntroHtml():"")+"</tr>"},renderHeadDateCellsHtml:function(){var t,e,n=[];for(t=0;t<this.colCnt;t++)e=this.getCellDate(0,t),n.push(this.renderHeadDateCellHtml(e));return n.join("")},renderHeadDateCellHtml:function(t,e,n){var i=this.view,r=["fc-day-header",i.widgetHeaderClass];return 1===this.rowCnt?r=r.concat(this.getDayClasses(t,!0)):r.push("fc-"+_t[t.day()]),'<th class="'+r.join(" ")+'"'+(1===this.rowCnt?' data-date="'+t.format("YYYY-MM-DD")+'"':"")+(e>1?' colspan="'+e+'"':"")+(n?" "+n:"")+">"+i.buildGotoAnchorHtml({date:t,forceOff:this.rowCnt>1||1===this.colCnt},tt(t.format(this.colHeadFormat)))+"</th>"},renderBgTrHtml:function(t){return"<tr>"+(this.isRTL?"":this.renderBgIntroHtml(t))+this.renderBgCellsHtml(t)+(this.isRTL?this.renderBgIntroHtml(t):"")+"</tr>"},renderBgIntroHtml:function(t){return this.renderIntroHtml()},renderBgCellsHtml:function(t){var e,n,i=[];for(e=0;e<this.colCnt;e++)n=this.getCellDate(t,e),i.push(this.renderBgCellHtml(n));return i.join("")},renderBgCellHtml:function(t,e){var n=this.view,i=this.getDayClasses(t);return i.unshift("fc-day",n.widgetContentClass),'<td class="'+i.join(" ")+'" data-date="'+t.format("YYYY-MM-DD")+'"'+(e?" "+e:"")+"></td>"},renderIntroHtml:function(){},bookendCells:function(t){var e=this.renderIntroHtml();e&&(this.isRTL?t.append(e):t.prepend(e))}},ue=Ot.DayGrid=le.extend(ae,{numbersVisible:!1,bottomCoordPadding:0,rowEls:null,cellEls:null,helperEls:null,rowCoordCache:null,colCoordCache:null,renderDates:function(t){var e,n,i=this.view,r=this.rowCnt,s=this.colCnt,o="";for(e=0;e<r;e++)o+=this.renderDayRowHtml(e,t);for(this.el.html(o),this.rowEls=this.el.find(".fc-row"),this.cellEls=this.el.find(".fc-day"),this.rowCoordCache=new ne({els:this.rowEls,isVertical:!0}),this.colCoordCache=new ne({els:this.cellEls.slice(0,this.colCnt),isHorizontal:!0}),e=0;e<r;e++)for(n=0;n<s;n++)i.publiclyTrigger("dayRender",null,this.getCellDate(e,n),this.getCellEl(e,n))},unrenderDates:function(){this.removeSegPopover()},renderBusinessHours:function(){var t=this.buildBusinessHourSegs(!0);this.renderFill("businessHours",t,"bgevent")},unrenderBusinessHours:function(){this.unrenderFill("businessHours")},renderDayRowHtml:function(t,e){var n=this.view,i=["fc-row","fc-week",n.widgetContentClass];return e&&i.push("fc-rigid"),'<div class="'+i.join(" ")+'"><div class="fc-bg"><table>'+this.renderBgTrHtml(t)+'</table></div><div class="fc-content-skeleton"><table>'+(this.numbersVisible?"<thead>"+this.renderNumberTrHtml(t)+"</thead>":"")+"</table></div></div>"},renderNumberTrHtml:function(t){return"<tr>"+(this.isRTL?"":this.renderNumberIntroHtml(t))+this.renderNumberCellsHtml(t)+(this.isRTL?this.renderNumberIntroHtml(t):"")+"</tr>"},renderNumberIntroHtml:function(t){return this.renderIntroHtml()},renderNumberCellsHtml:function(t){var e,n,i=[];for(e=0;e<this.colCnt;e++)n=this.getCellDate(t,e),i.push(this.renderNumberCellHtml(n));return i.join("")},renderNumberCellHtml:function(t){var e,n,i="";return this.view.dayNumbersVisible||this.view.cellWeekNumbersVisible?(e=this.getDayClasses(t),e.unshift("fc-day-top"),this.view.cellWeekNumbersVisible&&(n="ISO"===t._locale._fullCalendar_weekCalc?1:t._locale.firstDayOfWeek()),i+='<td class="'+e.join(" ")+'" data-date="'+t.format()+'">',this.view.cellWeekNumbersVisible&&t.day()==n&&(i+=this.view.buildGotoAnchorHtml({date:t,type:"week"},{class:"fc-week-number"},t.format("w"))),this.view.dayNumbersVisible&&(i+=this.view.buildGotoAnchorHtml(t,{class:"fc-day-number"},t.date())),i+="</td>"):"<td/>"},computeEventTimeFormat:function(){return this.view.opt("extraSmallTimeFormat")},computeDisplayEventEnd:function(){return 1==this.colCnt},rangeUpdated:function(){this.updateDayTable()},spanToSegs:function(t){var e,n,i=this.sliceRangeByRow(t);for(e=0;e<i.length;e++)n=i[e],this.isRTL?(n.leftCol=this.daysPerRow-1-n.lastRowDayIndex,n.rightCol=this.daysPerRow-1-n.firstRowDayIndex):(n.leftCol=n.firstRowDayIndex,n.rightCol=n.lastRowDayIndex);return i},prepareHits:function(){this.colCoordCache.build(),this.rowCoordCache.build(),this.rowCoordCache.bottoms[this.rowCnt-1]+=this.bottomCoordPadding},releaseHits:function(){this.colCoordCache.clear(),this.rowCoordCache.clear()},queryHit:function(t,e){if(this.colCoordCache.isLeftInBounds(t)&&this.rowCoordCache.isTopInBounds(e)){var n=this.colCoordCache.getHorizontalIndex(t),i=this.rowCoordCache.getVerticalIndex(e);if(null!=i&&null!=n)return this.getCellHit(i,n)}},getHitSpan:function(t){return this.getCellRange(t.row,t.col)},getHitEl:function(t){return this.getCellEl(t.row,t.col)},getCellHit:function(t,e){return{row:t,col:e,component:this,left:this.colCoordCache.getLeftOffset(e),right:this.colCoordCache.getRightOffset(e),top:this.rowCoordCache.getTopOffset(t),bottom:this.rowCoordCache.getBottomOffset(t)}},getCellEl:function(t,e){return this.cellEls.eq(t*this.colCnt+e)},renderDrag:function(t,e){if(this.renderHighlight(this.eventToSpan(t)),e&&e.component!==this)return this.renderEventLocationHelper(t,e)},unrenderDrag:function(){this.unrenderHighlight(),this.unrenderHelper()},renderEventResize:function(t,e){return this.renderHighlight(this.eventToSpan(t)),this.renderEventLocationHelper(t,e)},unrenderEventResize:function(){this.unrenderHighlight(),this.unrenderHelper()},renderHelper:function(e,n){var i,r=[],s=this.eventToSegs(e);return s=this.renderFgSegEls(s),i=this.renderSegRows(s),this.rowEls.each(function(e,s){var o,l=t(s),a=t('<div class="fc-helper-skeleton"><table/></div>');o=n&&n.row===e?n.el.position().top:l.find(".fc-content-skeleton tbody").position().top,a.css("top",o).find("table").append(i[e].tbodyEl),l.append(a),r.push(a[0])}),this.helperEls=t(r)},unrenderHelper:function(){this.helperEls&&(this.helperEls.remove(),this.helperEls=null)},fillSegTag:"td",renderFill:function(e,n,i){var r,s,o,l=[];for(n=this.renderFillSegEls(e,n),r=0;r<n.length;r++)s=n[r],o=this.renderFillRow(e,s,i),this.rowEls.eq(s.row).append(o),l.push(o[0]);return this.elsByFill[e]=t(l),n},renderFillRow:function(e,n,i){var r,s,o=this.colCnt,l=n.leftCol,a=n.rightCol+1;return i=i||e.toLowerCase(),r=t('<div class="fc-'+i+'-skeleton"><table><tr/></table></div>'),s=r.find("tr"),l>0&&s.append('<td colspan="'+l+'"/>'),s.append(n.el.attr("colspan",a-l)),a<o&&s.append('<td colspan="'+(o-a)+'"/>'),this.bookendCells(s),r}});ue.mixin({rowStructs:null,unrenderEvents:function(){this.removeSegPopover(),le.prototype.unrenderEvents.apply(this,arguments)},getEventSegs:function(){return le.prototype.getEventSegs.call(this).concat(this.popoverSegs||[])},renderBgSegs:function(e){var n=t.grep(e,function(t){return t.event.allDay});return le.prototype.renderBgSegs.call(this,n)},renderFgSegs:function(e){var n;return e=this.renderFgSegEls(e),n=this.rowStructs=this.renderSegRows(e),this.rowEls.each(function(e,i){t(i).find(".fc-content-skeleton > table").append(n[e].tbodyEl)}),e},unrenderFgSegs:function(){for(var t,e=this.rowStructs||[];t=e.pop();)t.tbodyEl.remove();this.rowStructs=null},renderSegRows:function(t){var e,n,i=[];for(e=this.groupSegRows(t),n=0;n<e.length;n++)i.push(this.renderSegRow(n,e[n]));return i},fgSegHtml:function(t,e){var n,i,r=this.view,s=t.event,o=r.isEventDraggable(s),l=!e&&s.allDay&&t.isStart&&r.isEventResizableFromStart(s),a=!e&&s.allDay&&t.isEnd&&r.isEventResizableFromEnd(s),u=this.getSegClasses(t,o,l||a),c=nt(this.getSegSkinCss(t)),d="";return u.unshift("fc-day-grid-event","fc-h-event"),t.isStart&&(n=this.getEventTimeText(s),n&&(d='<span class="fc-time">'+tt(n)+"</span>")),i='<span class="fc-title">'+(tt(s.title||"")||"&nbsp;")+"</span>",'<a class="'+u.join(" ")+'"'+(s.url?' href="'+tt(s.url)+'"':"")+(c?' style="'+c+'"':"")+'><div class="fc-content">'+(this.isRTL?i+" "+d:d+" "+i)+"</div>"+(l?'<div class="fc-resizer fc-start-resizer" />':"")+(a?'<div class="fc-resizer fc-end-resizer" />':"")+"</a>"},renderSegRow:function(e,n){function i(e){for(;o<e;)c=(m[r-1]||[])[o],c?c.attr("rowspan",parseInt(c.attr("rowspan")||1,10)+1):(c=t("<td/>"),l.append(c)),v[r][o]=c,m[r][o]=c,o++}var r,s,o,l,a,u,c,d=this.colCnt,h=this.buildSegLevels(n),f=Math.max(1,h.length),g=t("<tbody/>"),p=[],v=[],m=[];for(r=0;r<f;r++){if(s=h[r],o=0,l=t("<tr/>"),p.push([]),v.push([]),m.push([]),s)for(a=0;a<s.length;a++){for(u=s[a],i(u.leftCol),c=t('<td class="fc-event-container"/>').append(u.el),u.leftCol!=u.rightCol?c.attr("colspan",u.rightCol-u.leftCol+1):m[r][o]=c;o<=u.rightCol;)v[r][o]=c,p[r][o]=u,o++;l.append(c)}i(d),this.bookendCells(l),g.append(l)}return{row:e,tbodyEl:g,cellMatrix:v,segMatrix:p,segLevels:h,segs:n}},buildSegLevels:function(t){var e,n,i,r=[];for(this.sortEventSegs(t),e=0;e<t.length;e++){for(n=t[e],i=0;i<r.length&&Tt(n,r[i]);i++);n.level=i,(r[i]||(r[i]=[])).push(n)}for(i=0;i<r.length;i++)r[i].sort(Ct);return r},groupSegRows:function(t){var e,n=[];for(e=0;e<this.rowCnt;e++)n.push([]);for(e=0;e<t.length;e++)n[t[e].row].push(t[e]);return n}}),ue.mixin({segPopover:null,popoverSegs:null,removeSegPopover:function(){this.segPopover&&this.segPopover.hide()},limitRows:function(t){var e,n,i=this.rowStructs||[];for(e=0;e<i.length;e++)this.unlimitRow(e),n=!!t&&("number"==typeof t?t:this.computeRowLevelLimit(e)),n!==!1&&this.limitRow(e,n)},computeRowLevelLimit:function(e){function n(e,n){s=Math.max(s,t(n).outerHeight())}var i,r,s,o=this.rowEls.eq(e),l=o.height(),a=this.rowStructs[e].tbodyEl.children();for(i=0;i<a.length;i++)if(r=a.eq(i).removeClass("fc-limited"),s=0,r.find("> td > :first-child").each(n),r.position().top+s>l)return i;return!1},limitRow:function(e,n){function i(i){for(;b<i;)u=S.getCellSegs(e,b,n),u.length&&(h=s[n-1][b],y=S.renderMoreLink(e,b,u),m=t("<div/>").append(y),h.append(m),E.push(m[0])),b++}var r,s,o,l,a,u,c,d,h,f,g,p,v,m,y,S=this,w=this.rowStructs[e],E=[],b=0;if(n&&n<w.segLevels.length){for(r=w.segLevels[n-1],s=w.cellMatrix,o=w.tbodyEl.children().slice(n).addClass("fc-limited").get(),l=0;l<r.length;l++){for(a=r[l],i(a.leftCol),d=[],c=0;b<=a.rightCol;)u=this.getCellSegs(e,b,n),d.push(u),c+=u.length,b++;if(c){for(h=s[n-1][a.leftCol],f=h.attr("rowspan")||1,g=[],p=0;p<d.length;p++)v=t('<td class="fc-more-cell"/>').attr("rowspan",f),u=d[p],y=this.renderMoreLink(e,a.leftCol+p,[a].concat(u)),m=t("<div/>").append(y),v.append(m),g.push(v[0]),E.push(v[0]);h.addClass("fc-limited").after(t(g)),o.push(h[0])}}i(this.colCnt),w.moreEls=t(E),w.limitedEls=t(o)}},unlimitRow:function(t){var e=this.rowStructs[t];e.moreEls&&(e.moreEls.remove(),e.moreEls=null),e.limitedEls&&(e.limitedEls.removeClass("fc-limited"),e.limitedEls=null)},renderMoreLink:function(e,n,i){var r=this,s=this.view;return t('<a class="fc-more"/>').text(this.getMoreLinkText(i.length)).on("click",function(o){var l=s.opt("eventLimitClick"),a=r.getCellDate(e,n),u=t(this),c=r.getCellEl(e,n),d=r.getCellSegs(e,n),h=r.resliceDaySegs(d,a),f=r.resliceDaySegs(i,a);"function"==typeof l&&(l=s.publiclyTrigger("eventLimitClick",null,{date:a,dayEl:c,moreEl:u,segs:h,hiddenSegs:f},o)),"popover"===l?r.showSegPopover(e,n,u,h):"string"==typeof l&&s.calendar.zoomTo(a,l)})},showSegPopover:function(t,e,n,i){var r,s,o=this,l=this.view,a=n.parent();r=1==this.rowCnt?l.el:this.rowEls.eq(t),s={className:"fc-more-popover",content:this.renderSegPopoverContent(t,e,i),parentEl:this.view.el,top:r.offset().top,autoHide:!0,viewportConstrain:l.opt("popoverViewportConstrain"),hide:function(){if(o.popoverSegs)for(var t,e=0;e<o.popoverSegs.length;++e)t=o.popoverSegs[e],l.publiclyTrigger("eventDestroy",t.event,t.event,t.el);o.segPopover.removeElement(),o.segPopover=null,o.popoverSegs=null}},this.isRTL?s.right=a.offset().left+a.outerWidth()+1:s.left=a.offset().left-1,this.segPopover=new ee(s),this.segPopover.show(),this.bindSegHandlersToEl(this.segPopover.el)},renderSegPopoverContent:function(e,n,i){var r,s=this.view,o=s.opt("theme"),l=this.getCellDate(e,n).format(s.opt("dayPopoverFormat")),a=t('<div class="fc-header '+s.widgetHeaderClass+'"><span class="fc-close '+(o?"ui-icon ui-icon-closethick":"fc-icon fc-icon-x")+'"></span><span class="fc-title">'+tt(l)+'</span><div class="fc-clear"/></div><div class="fc-body '+s.widgetContentClass+'"><div class="fc-event-container"></div></div>'),u=a.find(".fc-event-container");for(i=this.renderFgSegEls(i,!0),this.popoverSegs=i,r=0;r<i.length;r++)this.hitsNeeded(),i[r].hit=this.getCellHit(e,n),this.hitsNotNeeded(),u.append(i[r].el);return a},resliceDaySegs:function(e,n){var i=t.map(e,function(t){return t.event}),r=n.clone(),s=r.clone().add(1,"days"),o={start:r,end:s};return e=this.eventsToSegs(i,function(t){var e=F(t,o);return e?[e]:[]}),this.sortEventSegs(e),e},getMoreLinkText:function(t){var e=this.view.opt("eventLimitText");return"function"==typeof e?e(t):"+"+t+" "+e},getCellSegs:function(t,e,n){for(var i,r=this.rowStructs[t].segMatrix,s=n||0,o=[];s<r.length;)i=r[s][e],i&&o.push(i),s++;return o}});var ce=Ot.TimeGrid=le.extend(ae,{slotDuration:null,snapDuration:null,snapsPerSlot:null,minTime:null,maxTime:null,labelFormat:null,labelInterval:null,colEls:null,slatContainerEl:null,slatEls:null,nowIndicatorEls:null,colCoordCache:null,slatCoordCache:null,constructor:function(){le.apply(this,arguments),this.processOptions()},renderDates:function(){this.el.html(this.renderHtml()),this.colEls=this.el.find(".fc-day"),this.slatContainerEl=this.el.find(".fc-slats"),this.slatEls=this.slatContainerEl.find("tr"),this.colCoordCache=new ne({els:this.colEls,isHorizontal:!0}),this.slatCoordCache=new ne({els:this.slatEls,isVertical:!0}),this.renderContentSkeleton()},renderHtml:function(){return'<div class="fc-bg"><table>'+this.renderBgTrHtml(0)+'</table></div><div class="fc-slats"><table>'+this.renderSlatRowHtml()+"</table></div>"},renderSlatRowHtml:function(){for(var t,n,i,r=this.view,s=this.isRTL,o="",l=e.duration(+this.minTime);l<this.maxTime;)t=this.start.clone().time(l),n=ot(_(l,this.labelInterval)),i='<td class="fc-axis fc-time '+r.widgetContentClass+'" '+r.axisStyleAttr()+">"+(n?"<span>"+tt(t.format(this.labelFormat))+"</span>":"")+"</td>",o+='<tr data-time="'+t.format("HH:mm:ss")+'"'+(n?"":' class="fc-minor"')+">"+(s?"":i)+'<td class="'+r.widgetContentClass+'"/>'+(s?i:"")+"</tr>",l.add(this.slotDuration);return o},processOptions:function(){var n,i=this.view,r=i.opt("slotDuration"),s=i.opt("snapDuration");r=e.duration(r),s=s?e.duration(s):r,this.slotDuration=r,this.snapDuration=s,this.snapsPerSlot=r/s,this.minResizeDuration=s,this.minTime=e.duration(i.opt("minTime")),this.maxTime=e.duration(i.opt("maxTime")),n=i.opt("slotLabelFormat"),t.isArray(n)&&(n=n[n.length-1]),this.labelFormat=n||i.opt("smallTimeFormat"),n=i.opt("slotLabelInterval"),this.labelInterval=n?e.duration(n):this.computeLabelInterval(r)},computeLabelInterval:function(t){var n,i,r;for(n=Re.length-1;n>=0;n--)if(i=e.duration(Re[n]),r=_(i,t),ot(r)&&r>1)return i;return e.duration(t)},computeEventTimeFormat:function(){return this.view.opt("noMeridiemTimeFormat")},computeDisplayEventEnd:function(){return!0},prepareHits:function(){this.colCoordCache.build(),this.slatCoordCache.build()},releaseHits:function(){this.colCoordCache.clear()},queryHit:function(t,e){var n=this.snapsPerSlot,i=this.colCoordCache,r=this.slatCoordCache;if(i.isLeftInBounds(t)&&r.isTopInBounds(e)){var s=i.getHorizontalIndex(t),o=r.getVerticalIndex(e);if(null!=s&&null!=o){var l=r.getTopOffset(o),a=r.getHeight(o),u=(e-l)/a,c=Math.floor(u*n),d=o*n+c,h=l+c/n*a,f=l+(c+1)/n*a;return{col:s,snap:d,component:this,left:i.getLeftOffset(s),right:i.getRightOffset(s),top:h,bottom:f}}}},getHitSpan:function(t){var e,n=this.getCellDate(0,t.col),i=this.computeSnapTime(t.snap);return n.time(i),e=n.clone().add(this.snapDuration),{start:n,end:e}},getHitEl:function(t){return this.colEls.eq(t.col)},rangeUpdated:function(){this.updateDayTable()},computeSnapTime:function(t){return e.duration(this.minTime+this.snapDuration*t)},spanToSegs:function(t){var e,n=this.sliceRangeByTimes(t);for(e=0;e<n.length;e++)this.isRTL?n[e].col=this.daysPerRow-1-n[e].dayIndex:n[e].col=n[e].dayIndex;return n},sliceRangeByTimes:function(t){var e,n,i,r,s=[];for(n=0;n<this.daysPerRow;n++)i=this.dayDates[n].clone(),r={start:i.clone().time(this.minTime),end:i.clone().time(this.maxTime)},e=F(t,r),e&&(e.dayIndex=n,s.push(e));return s},updateSize:function(t){this.slatCoordCache.build(),t&&this.updateSegVerticals([].concat(this.fgSegs||[],this.bgSegs||[],this.businessSegs||[]))},getTotalSlatHeight:function(){return this.slatContainerEl.outerHeight()},computeDateTop:function(t,n){return this.computeTimeTop(e.duration(t-n.clone().stripTime()))},computeTimeTop:function(t){var e,n,i=this.slatEls.length,r=(t-this.minTime)/this.slotDuration;return r=Math.max(0,r),r=Math.min(i,r),e=Math.floor(r),e=Math.min(e,i-1),n=r-e,this.slatCoordCache.getTopPosition(e)+this.slatCoordCache.getHeight(e)*n},renderDrag:function(t,e){return e?this.renderEventLocationHelper(t,e):void this.renderHighlight(this.eventToSpan(t))},unrenderDrag:function(){this.unrenderHelper(),this.unrenderHighlight()},renderEventResize:function(t,e){return this.renderEventLocationHelper(t,e)},unrenderEventResize:function(){this.unrenderHelper()},renderHelper:function(t,e){return this.renderHelperSegs(this.eventToSegs(t),e)},unrenderHelper:function(){this.unrenderHelperSegs()},renderBusinessHours:function(){this.renderBusinessSegs(this.buildBusinessHourSegs())},unrenderBusinessHours:function(){this.unrenderBusinessSegs()},getNowIndicatorUnit:function(){return"minute"},renderNowIndicator:function(e){var n,i=this.spanToSegs({start:e,end:e}),r=this.computeDateTop(e,e),s=[];for(n=0;n<i.length;n++)s.push(t('<div class="fc-now-indicator fc-now-indicator-line"></div>').css("top",r).appendTo(this.colContainerEls.eq(i[n].col))[0]);i.length>0&&s.push(t('<div class="fc-now-indicator fc-now-indicator-arrow"></div>').css("top",r).appendTo(this.el.find(".fc-content-skeleton"))[0]),this.nowIndicatorEls=t(s)},unrenderNowIndicator:function(){this.nowIndicatorEls&&(this.nowIndicatorEls.remove(),this.nowIndicatorEls=null)},renderSelection:function(t){this.view.opt("selectHelper")?this.renderEventLocationHelper(t):this.renderHighlight(t)},unrenderSelection:function(){this.unrenderHelper(),this.unrenderHighlight()},renderHighlight:function(t){this.renderHighlightSegs(this.spanToSegs(t))},unrenderHighlight:function(){this.unrenderHighlightSegs()}});ce.mixin({colContainerEls:null,fgContainerEls:null,bgContainerEls:null,helperContainerEls:null,highlightContainerEls:null,businessContainerEls:null,fgSegs:null,bgSegs:null,helperSegs:null,highlightSegs:null,businessSegs:null,renderContentSkeleton:function(){var e,n,i="";for(e=0;e<this.colCnt;e++)i+='<td><div class="fc-content-col"><div class="fc-event-container fc-helper-container"></div><div class="fc-event-container"></div><div class="fc-highlight-container"></div><div class="fc-bgevent-container"></div><div class="fc-business-container"></div></div></td>';n=t('<div class="fc-content-skeleton"><table><tr>'+i+"</tr></table></div>"),this.colContainerEls=n.find(".fc-content-col"),this.helperContainerEls=n.find(".fc-helper-container"),this.fgContainerEls=n.find(".fc-event-container:not(.fc-helper-container)"),this.bgContainerEls=n.find(".fc-bgevent-container"),this.highlightContainerEls=n.find(".fc-highlight-container"),this.businessContainerEls=n.find(".fc-business-container"),this.bookendCells(n.find("tr")),this.el.append(n)},renderFgSegs:function(t){return t=this.renderFgSegsIntoContainers(t,this.fgContainerEls),this.fgSegs=t,t},unrenderFgSegs:function(){this.unrenderNamedSegs("fgSegs")},renderHelperSegs:function(e,n){var i,r,s,o=[];for(e=this.renderFgSegsIntoContainers(e,this.helperContainerEls),i=0;i<e.length;i++)r=e[i],n&&n.col===r.col&&(s=n.el,r.el.css({left:s.css("left"),right:s.css("right"),"margin-left":s.css("margin-left"),"margin-right":s.css("margin-right")})),o.push(r.el[0]);return this.helperSegs=e,t(o)},unrenderHelperSegs:function(){this.unrenderNamedSegs("helperSegs")},renderBgSegs:function(t){return t=this.renderFillSegEls("bgEvent",t),this.updateSegVerticals(t),this.attachSegsByCol(this.groupSegsByCol(t),this.bgContainerEls),this.bgSegs=t,t},unrenderBgSegs:function(){this.unrenderNamedSegs("bgSegs")},renderHighlightSegs:function(t){t=this.renderFillSegEls("highlight",t),this.updateSegVerticals(t),this.attachSegsByCol(this.groupSegsByCol(t),this.highlightContainerEls),this.highlightSegs=t},unrenderHighlightSegs:function(){this.unrenderNamedSegs("highlightSegs")},renderBusinessSegs:function(t){t=this.renderFillSegEls("businessHours",t),this.updateSegVerticals(t),this.attachSegsByCol(this.groupSegsByCol(t),this.businessContainerEls),this.businessSegs=t},unrenderBusinessSegs:function(){this.unrenderNamedSegs("businessSegs")},groupSegsByCol:function(t){var e,n=[];for(e=0;e<this.colCnt;e++)n.push([]);for(e=0;e<t.length;e++)n[t[e].col].push(t[e]);return n},attachSegsByCol:function(t,e){var n,i,r;for(n=0;n<this.colCnt;n++)for(i=t[n],r=0;r<i.length;r++)e.eq(n).append(i[r].el)},unrenderNamedSegs:function(t){var e,n=this[t];if(n){for(e=0;e<n.length;e++)n[e].el.remove();this[t]=null}},renderFgSegsIntoContainers:function(t,e){var n,i;for(t=this.renderFgSegEls(t),n=this.groupSegsByCol(t),i=0;i<this.colCnt;i++)this.updateFgSegCoords(n[i]);return this.attachSegsByCol(n,e),t},fgSegHtml:function(t,e){var n,i,r,s=this.view,o=t.event,l=s.isEventDraggable(o),a=!e&&t.isStart&&s.isEventResizableFromStart(o),u=!e&&t.isEnd&&s.isEventResizableFromEnd(o),c=this.getSegClasses(t,l,a||u),d=nt(this.getSegSkinCss(t));return c.unshift("fc-time-grid-event","fc-v-event"),s.isMultiDayEvent(o)?(t.isStart||t.isEnd)&&(n=this.getEventTimeText(t),i=this.getEventTimeText(t,"LT"),r=this.getEventTimeText(t,null,!1)):(n=this.getEventTimeText(o),i=this.getEventTimeText(o,"LT"),r=this.getEventTimeText(o,null,!1)),'<a class="'+c.join(" ")+'"'+(o.url?' href="'+tt(o.url)+'"':"")+(d?' style="'+d+'"':"")+'><div class="fc-content">'+(n?'<div class="fc-time" data-start="'+tt(r)+'" data-full="'+tt(i)+'"><span>'+tt(n)+"</span></div>":"")+(o.title?'<div class="fc-title">'+tt(o.title)+"</div>":"")+'</div><div class="fc-bg"/>'+(u?'<div class="fc-resizer fc-end-resizer" />':"")+"</a>"},updateSegVerticals:function(t){this.computeSegVerticals(t),this.assignSegVerticals(t)},computeSegVerticals:function(t){var e,n;for(e=0;e<t.length;e++)n=t[e],n.top=this.computeDateTop(n.start,n.start),n.bottom=this.computeDateTop(n.end,n.start)},assignSegVerticals:function(t){var e,n;for(e=0;e<t.length;e++)n=t[e],n.el.css(this.generateSegVerticalCss(n))},generateSegVerticalCss:function(t){return{top:t.top,bottom:-t.bottom}},updateFgSegCoords:function(t){this.computeSegVerticals(t),this.computeFgSegHorizontals(t),this.assignSegVerticals(t),this.assignFgSegHorizontals(t)},computeFgSegHorizontals:function(t){var e,n,i;if(this.sortEventSegs(t),e=Ht(t),xt(e),n=e[0]){for(i=0;i<n.length;i++)Rt(n[i]);for(i=0;i<n.length;i++)this.computeFgSegForwardBack(n[i],0,0)}},computeFgSegForwardBack:function(t,e,n){var i,r=t.forwardSegs;if(void 0===t.forwardCoord)for(r.length?(this.sortForwardSegs(r),this.computeFgSegForwardBack(r[0],e+1,n),t.forwardCoord=r[0].backwardCoord):t.forwardCoord=1,t.backwardCoord=t.forwardCoord-(t.forwardCoord-n)/(e+1),i=0;i<r.length;i++)this.computeFgSegForwardBack(r[i],0,t.forwardCoord)},sortForwardSegs:function(t){t.sort(lt(this,"compareForwardSegs"))},compareForwardSegs:function(t,e){return e.forwardPressure-t.forwardPressure||(t.backwardCoord||0)-(e.backwardCoord||0)||this.compareEventSegs(t,e)},assignFgSegHorizontals:function(t){var e,n;for(e=0;e<t.length;e++)n=t[e],n.el.css(this.generateFgSegHorizontalCss(n)),n.bottom-n.top<30&&n.el.addClass("fc-short")},generateFgSegHorizontalCss:function(t){var e,n,i=this.view.opt("slotEventOverlap"),r=t.backwardCoord,s=t.forwardCoord,o=this.generateSegVerticalCss(t);return i&&(s=Math.min(1,r+2*(s-r))),this.isRTL?(e=1-s,n=r):(e=r,n=1-s),o.zIndex=t.level+1,o.left=100*e+"%",o.right=100*n+"%",i&&t.forwardPressure&&(o[this.isRTL?"marginLeft":"marginRight"]=20),o}});var de=Ot.View=ct.extend(Jt,te,{type:null,name:null,title:null,calendar:null,options:null,el:null,isDateSet:!1,isDateRendered:!1,dateRenderQueue:null,isEventsBound:!1,isEventsSet:!1,isEventsRendered:!1,eventRenderQueue:null,start:null,end:null,intervalStart:null,intervalEnd:null,intervalDuration:null,intervalUnit:null,isRTL:!1,isSelected:!1,selectedEvent:null,eventOrderSpecs:null,widgetHeaderClass:null,widgetContentClass:null,highlightStateClass:null,nextDayThreshold:null,isHiddenDayHash:null,isNowIndicatorRendered:null,initialNowDate:null,initialNowQueriedMs:null,nowIndicatorTimeoutID:null,nowIndicatorIntervalID:null,constructor:function(t,n,i,r){this.calendar=t,this.type=this.name=n,this.options=i,this.intervalDuration=r||e.duration(1,"day"),this.nextDayThreshold=e.duration(this.opt("nextDayThreshold")),this.initThemingProps(),this.initHiddenDays(),this.isRTL=this.opt("isRTL"),this.eventOrderSpecs=L(this.opt("eventOrder")),this.dateRenderQueue=new gt,this.eventRenderQueue=new gt(this.opt("eventRenderWait")),this.initialize()},initialize:function(){},opt:function(t){return this.options[t]},publiclyTrigger:function(t,e){var n=this.calendar;return n.publiclyTrigger.apply(n,[t,e||this].concat(Array.prototype.slice.call(arguments,2),[this]))},rejectOn:function(t,e){var n=this;return new ft(function(i,r){function s(){n.off(t,r)}n.one(t,r),e.then(function(t){s(),i(t)},function(){s(),r()})})},setRange:function(e){t.extend(this,e),this.updateTitle()},computeRange:function(t){var e,n,i=A(this.intervalDuration),r=t.clone().startOf(i),s=r.clone().add(this.intervalDuration);return/year|month|week|day/.test(i)?(r.stripTime(),s.stripTime()):(r.hasTime()||(r=this.calendar.time(0)),s.hasTime()||(s=this.calendar.time(0))),e=r.clone(),e=this.skipHiddenDays(e),n=s.clone(),n=this.skipHiddenDays(n,-1,!0),{intervalUnit:i,intervalStart:r,intervalEnd:s,start:e,end:n}},computePrevDate:function(t){return this.massageCurrentDate(t.clone().startOf(this.intervalUnit).subtract(this.intervalDuration),-1)},computeNextDate:function(t){return this.massageCurrentDate(t.clone().startOf(this.intervalUnit).add(this.intervalDuration))},massageCurrentDate:function(t,e){return this.intervalDuration.as("days")<=1&&this.isHiddenDay(t)&&(t=this.skipHiddenDays(t,e),t.startOf("day")),t},updateTitle:function(){this.title=this.computeTitle(),this.calendar.setToolbarsTitle(this.title)},computeTitle:function(){var t,e;return"year"===this.intervalUnit||"month"===this.intervalUnit?(t=this.intervalStart,
e=this.intervalEnd):(t=this.start,e=this.end),this.formatRange({start:this.calendar.applyTimezone(t),end:this.calendar.applyTimezone(e)},this.opt("titleFormat")||this.computeTitleFormat(),this.opt("titleRangeSeparator"))},computeTitleFormat:function(){return"year"==this.intervalUnit?"YYYY":"month"==this.intervalUnit?this.opt("monthYearFormat"):this.intervalDuration.as("days")>1?"ll":"LL"},formatRange:function(t,e,n){var i=t.end;return i.hasTime()||(i=i.clone().subtract(1)),Xt(t.start,i,e,n,this.opt("isRTL"))},getAllDayHtml:function(){return this.opt("allDayHtml")||tt(this.opt("allDayText"))},buildGotoAnchorHtml:function(e,n,i){var r,s,o,l;return t.isPlainObject(e)?(r=e.date,s=e.type,o=e.forceOff):r=e,r=Ot.moment(r),l={date:r.format("YYYY-MM-DD"),type:s||"day"},"string"==typeof n&&(i=n,n=null),n=n?" "+it(n):"",i=i||"",!o&&this.opt("navLinks")?"<a"+n+' data-goto="'+tt(JSON.stringify(l))+'">'+i+"</a>":"<span"+n+">"+i+"</span>"},setElement:function(t){this.el=t,this.bindGlobalHandlers(),this.renderSkeleton()},removeElement:function(){this.unsetDate(),this.unrenderSkeleton(),this.unbindGlobalHandlers(),this.el.remove()},renderSkeleton:function(){},unrenderSkeleton:function(){},setDate:function(t){var e=this.isDateSet;this.isDateSet=!0,this.handleDate(t,e),this.trigger(e?"dateReset":"dateSet",t)},unsetDate:function(){this.isDateSet&&(this.isDateSet=!1,this.handleDateUnset(),this.trigger("dateUnset"))},handleDate:function(t,e){var n=this;this.unbindEvents(),this.requestDateRender(t).then(function(){n.bindEvents()})},handleDateUnset:function(){this.unbindEvents(),this.requestDateUnrender()},requestDateRender:function(t){var e=this;return this.dateRenderQueue.add(function(){return e.executeDateRender(t)})},requestDateUnrender:function(){var t=this;return this.dateRenderQueue.add(function(){return t.executeDateUnrender()})},executeDateRender:function(t){var e=this;return t?this.captureInitialScroll():this.captureScroll(),this.freezeHeight(),this.executeDateUnrender().then(function(){t&&e.setRange(e.computeRange(t)),e.render&&e.render(),e.renderDates(),e.updateSize(),e.renderBusinessHours(),e.startNowIndicator(),e.thawHeight(),e.releaseScroll(),e.isDateRendered=!0,e.onDateRender(),e.trigger("dateRender")})},executeDateUnrender:function(){var t=this;return t.isDateRendered?this.requestEventsUnrender().then(function(){t.unselect(),t.stopNowIndicator(),t.triggerUnrender(),t.unrenderBusinessHours(),t.unrenderDates(),t.destroy&&t.destroy(),t.isDateRendered=!1,t.trigger("dateUnrender")}):ft.resolve()},onDateRender:function(){this.triggerRender()},renderDates:function(){},unrenderDates:function(){},triggerRender:function(){this.publiclyTrigger("viewRender",this,this,this.el)},triggerUnrender:function(){this.publiclyTrigger("viewDestroy",this,this,this.el)},bindGlobalHandlers:function(){this.listenTo(se.get(),{touchstart:this.processUnselect,mousedown:this.handleDocumentMousedown})},unbindGlobalHandlers:function(){this.stopListeningTo(se.get())},initThemingProps:function(){var t=this.opt("theme")?"ui":"fc";this.widgetHeaderClass=t+"-widget-header",this.widgetContentClass=t+"-widget-content",this.highlightStateClass=t+"-state-highlight"},renderBusinessHours:function(){},unrenderBusinessHours:function(){},startNowIndicator:function(){var t,n,i,r=this;this.opt("nowIndicator")&&(t=this.getNowIndicatorUnit(),t&&(n=lt(this,"updateNowIndicator"),this.initialNowDate=this.calendar.getNow(),this.initialNowQueriedMs=+new Date,this.renderNowIndicator(this.initialNowDate),this.isNowIndicatorRendered=!0,i=this.initialNowDate.clone().startOf(t).add(1,t)-this.initialNowDate,this.nowIndicatorTimeoutID=setTimeout(function(){r.nowIndicatorTimeoutID=null,n(),i=+e.duration(1,t),i=Math.max(100,i),r.nowIndicatorIntervalID=setInterval(n,i)},i)))},updateNowIndicator:function(){this.isNowIndicatorRendered&&(this.unrenderNowIndicator(),this.renderNowIndicator(this.initialNowDate.clone().add(new Date-this.initialNowQueriedMs)))},stopNowIndicator:function(){this.isNowIndicatorRendered&&(this.nowIndicatorTimeoutID&&(clearTimeout(this.nowIndicatorTimeoutID),this.nowIndicatorTimeoutID=null),this.nowIndicatorIntervalID&&(clearTimeout(this.nowIndicatorIntervalID),this.nowIndicatorIntervalID=null),this.unrenderNowIndicator(),this.isNowIndicatorRendered=!1)},getNowIndicatorUnit:function(){},renderNowIndicator:function(t){},unrenderNowIndicator:function(){},updateSize:function(t){t&&this.captureScroll(),this.updateHeight(t),this.updateWidth(t),this.updateNowIndicator(),t&&this.releaseScroll()},updateWidth:function(t){},updateHeight:function(t){var e=this.calendar;this.setHeight(e.getSuggestedViewHeight(),e.isHeightAuto())},setHeight:function(t,e){},capturedScroll:null,capturedScrollDepth:0,captureScroll:function(){return!this.capturedScrollDepth++&&(this.capturedScroll=this.isDateRendered?this.queryScroll():{},!0)},captureInitialScroll:function(e){this.captureScroll()&&(this.capturedScroll.isInitial=!0,e?t.extend(this.capturedScroll,e):this.capturedScroll.isComputed=!0)},releaseScroll:function(){var e=this.capturedScroll,n=this.discardScroll();e.isComputed&&(n?t.extend(e,this.computeInitialScroll()):e=null),e&&(e.isInitial?this.hardSetScroll(e):this.setScroll(e))},discardScroll:function(){return!--this.capturedScrollDepth&&(this.capturedScroll=null,!0)},computeInitialScroll:function(){return{}},queryScroll:function(){return{}},hardSetScroll:function(t){var e=this,n=function(){e.setScroll(t)};n(),setTimeout(n,0)},setScroll:function(t){},freezeHeight:function(){this.calendar.freezeContentHeight()},thawHeight:function(){this.calendar.thawContentHeight()},bindEvents:function(){var t=this;this.isEventsBound||(this.isEventsBound=!0,this.rejectOn("eventsUnbind",this.requestEvents()).then(function(e){t.listenTo(t.calendar,"eventsReset",t.setEvents),t.setEvents(e)}))},unbindEvents:function(){this.isEventsBound&&(this.isEventsBound=!1,this.stopListeningTo(this.calendar,"eventsReset"),this.unsetEvents(),this.trigger("eventsUnbind"))},setEvents:function(t){var e=this.isEventSet;this.isEventsSet=!0,this.handleEvents(t,e),this.trigger(e?"eventsReset":"eventsSet",t)},unsetEvents:function(){this.isEventsSet&&(this.isEventsSet=!1,this.handleEventsUnset(),this.trigger("eventsUnset"))},whenEventsSet:function(){var t=this;return this.isEventsSet?ft.resolve(this.getCurrentEvents()):new ft(function(e){t.one("eventsSet",e)})},handleEvents:function(t,e){this.requestEventsRender(t)},handleEventsUnset:function(){this.requestEventsUnrender()},requestEventsRender:function(t){var e=this;return this.eventRenderQueue.add(function(){return e.executeEventsRender(t)})},requestEventsUnrender:function(){var t=this;return this.isEventsRendered?this.eventRenderQueue.addQuickly(function(){return t.executeEventsUnrender()}):ft.resolve()},requestCurrentEventsRender:function(){return this.isEventsSet?void this.requestEventsRender(this.getCurrentEvents()):ft.reject()},executeEventsRender:function(t){var e=this;return this.captureScroll(),this.freezeHeight(),this.executeEventsUnrender().then(function(){e.renderEvents(t),e.thawHeight(),e.releaseScroll(),e.isEventsRendered=!0,e.onEventsRender(),e.trigger("eventsRender")})},executeEventsUnrender:function(){return this.isEventsRendered&&(this.onBeforeEventsUnrender(),this.captureScroll(),this.freezeHeight(),this.destroyEvents&&this.destroyEvents(),this.unrenderEvents(),this.thawHeight(),this.releaseScroll(),this.isEventsRendered=!1,this.trigger("eventsUnrender")),ft.resolve()},onEventsRender:function(){this.renderedEventSegEach(function(t){this.publiclyTrigger("eventAfterRender",t.event,t.event,t.el)}),this.publiclyTrigger("eventAfterAllRender")},onBeforeEventsUnrender:function(){this.renderedEventSegEach(function(t){this.publiclyTrigger("eventDestroy",t.event,t.event,t.el)})},renderEvents:function(t){},unrenderEvents:function(){},requestEvents:function(){return this.calendar.requestEvents(this.start,this.end)},getCurrentEvents:function(){return this.calendar.getPrunedEventCache()},resolveEventEl:function(e,n){var i=this.publiclyTrigger("eventRender",e,e,n);return i===!1?n=null:i&&i!==!0&&(n=t(i)),n},showEvent:function(t){this.renderedEventSegEach(function(t){t.el.css("visibility","")},t)},hideEvent:function(t){this.renderedEventSegEach(function(t){t.el.css("visibility","hidden")},t)},renderedEventSegEach:function(t,e){var n,i=this.getEventSegs();for(n=0;n<i.length;n++)e&&i[n].event._id!==e._id||i[n].el&&t.call(this,i[n])},getEventSegs:function(){return[]},isEventDraggable:function(t){return this.isEventStartEditable(t)},isEventStartEditable:function(t){return J(t.startEditable,(t.source||{}).startEditable,this.opt("eventStartEditable"),this.isEventGenerallyEditable(t))},isEventGenerallyEditable:function(t){return J(t.editable,(t.source||{}).editable,this.opt("editable"))},reportSegDrop:function(t,e,n,i,r){var s=this.calendar,o=s.mutateSeg(t,e,n),l=function(){o.undo(),s.reportEventChange()};this.triggerEventDrop(t.event,o.dateDelta,l,i,r),s.reportEventChange()},triggerEventDrop:function(t,e,n,i,r){this.publiclyTrigger("eventDrop",i[0],t,e,n,r,{})},reportExternalDrop:function(e,n,i,r,s){var o,l,a=e.eventProps;a&&(o=t.extend({},a,n),l=this.calendar.renderEvent(o,e.stick)[0]),this.triggerExternalDrop(l,n,i,r,s)},triggerExternalDrop:function(t,e,n,i,r){this.publiclyTrigger("drop",n[0],e.start,i,r),t&&this.publiclyTrigger("eventReceive",null,t)},renderDrag:function(t,e){},unrenderDrag:function(){},isEventResizableFromStart:function(t){return this.opt("eventResizableFromStart")&&this.isEventResizable(t)},isEventResizableFromEnd:function(t){return this.isEventResizable(t)},isEventResizable:function(t){var e=t.source||{};return J(t.durationEditable,e.durationEditable,this.opt("eventDurationEditable"),t.editable,e.editable,this.opt("editable"))},reportSegResize:function(t,e,n,i,r){var s=this.calendar,o=s.mutateSeg(t,e,n),l=function(){o.undo(),s.reportEventChange()};this.triggerEventResize(t.event,o.durationDelta,l,i,r),s.reportEventChange()},triggerEventResize:function(t,e,n,i,r){this.publiclyTrigger("eventResize",i[0],t,e,n,r,{})},select:function(t,e){this.unselect(e),this.renderSelection(t),this.reportSelection(t,e)},renderSelection:function(t){},reportSelection:function(t,e){this.isSelected=!0,this.triggerSelect(t,e)},triggerSelect:function(t,e){this.publiclyTrigger("select",null,this.calendar.applyTimezone(t.start),this.calendar.applyTimezone(t.end),e)},unselect:function(t){this.isSelected&&(this.isSelected=!1,this.destroySelection&&this.destroySelection(),this.unrenderSelection(),this.publiclyTrigger("unselect",null,t))},unrenderSelection:function(){},selectEvent:function(t){this.selectedEvent&&this.selectedEvent===t||(this.unselectEvent(),this.renderedEventSegEach(function(t){t.el.addClass("fc-selected")},t),this.selectedEvent=t)},unselectEvent:function(){this.selectedEvent&&(this.renderedEventSegEach(function(t){t.el.removeClass("fc-selected")},this.selectedEvent),this.selectedEvent=null)},isEventSelected:function(t){return this.selectedEvent&&this.selectedEvent._id===t._id},handleDocumentMousedown:function(t){w(t)&&this.processUnselect(t)},processUnselect:function(t){this.processRangeUnselect(t),this.processEventUnselect(t)},processRangeUnselect:function(e){var n;this.isSelected&&this.opt("unselectAuto")&&(n=this.opt("unselectCancel"),n&&t(e.target).closest(n).length||this.unselect(e))},processEventUnselect:function(e){this.selectedEvent&&(t(e.target).closest(".fc-selected").length||this.unselectEvent())},triggerDayClick:function(t,e,n){this.publiclyTrigger("dayClick",e,this.calendar.applyTimezone(t.start),n)},initHiddenDays:function(){var e,n=this.opt("hiddenDays")||[],i=[],r=0;for(this.opt("weekends")===!1&&n.push(0,6),e=0;e<7;e++)(i[e]=t.inArray(e,n)!==-1)||r++;if(!r)throw"invalid hiddenDays";this.isHiddenDayHash=i},isHiddenDay:function(t){return e.isMoment(t)&&(t=t.day()),this.isHiddenDayHash[t]},skipHiddenDays:function(t,e,n){var i=t.clone();for(e=e||1;this.isHiddenDayHash[(i.day()+(n?e:0)+7)%7];)i.add(e,"days");return i},computeDayRange:function(t){var e,n=t.start.clone().stripTime(),i=t.end,r=null;return i&&(r=i.clone().stripTime(),e=+i.time(),e&&e>=this.nextDayThreshold&&r.add(1,"days")),(!i||r<=n)&&(r=n.clone().add(1,"days")),{start:n,end:r}},isMultiDayEvent:function(t){var e=this.computeDayRange(t);return e.end.diff(e.start,"days")>1}}),he=Ot.Scroller=ct.extend({el:null,scrollEl:null,overflowX:null,overflowY:null,constructor:function(t){t=t||{},this.overflowX=t.overflowX||t.overflow||"auto",this.overflowY=t.overflowY||t.overflow||"auto"},render:function(){this.el=this.renderEl(),this.applyOverflow()},renderEl:function(){return this.scrollEl=t('<div class="fc-scroller"></div>')},clear:function(){this.setHeight("auto"),this.applyOverflow()},destroy:function(){this.el.remove()},applyOverflow:function(){this.scrollEl.css({"overflow-x":this.overflowX,"overflow-y":this.overflowY})},lockOverflow:function(t){var e=this.overflowX,n=this.overflowY;t=t||this.getScrollbarWidths(),"auto"===e&&(e=t.top||t.bottom||this.scrollEl[0].scrollWidth-1>this.scrollEl[0].clientWidth?"scroll":"hidden"),"auto"===n&&(n=t.left||t.right||this.scrollEl[0].scrollHeight-1>this.scrollEl[0].clientHeight?"scroll":"hidden"),this.scrollEl.css({"overflow-x":e,"overflow-y":n})},setHeight:function(t){this.scrollEl.height(t)},getScrollTop:function(){return this.scrollEl.scrollTop()},setScrollTop:function(t){this.scrollEl.scrollTop(t)},getClientWidth:function(){return this.scrollEl[0].clientWidth},getClientHeight:function(){return this.scrollEl[0].clientHeight},getScrollbarWidths:function(){return p(this.scrollEl)}});Lt.prototype.proxyCall=function(t){var e=Array.prototype.slice.call(arguments,1),n=[];return this.items.forEach(function(i){n.push(i[t].apply(i,e))}),n};var fe=Ot.Calendar=ct.extend({dirDefaults:null,localeDefaults:null,overrides:null,dynamicOverrides:null,options:null,viewSpecCache:null,view:null,header:null,footer:null,loadingLevel:0,constructor:Bt,initialize:function(){},populateOptionsHash:function(){var t,e,i,r;t=J(this.dynamicOverrides.locale,this.overrides.locale),e=ge[t],e||(t=fe.defaults.locale,e=ge[t]||{}),i=J(this.dynamicOverrides.isRTL,this.overrides.isRTL,e.isRTL,fe.defaults.isRTL),r=i?fe.rtlDefaults:{},this.dirDefaults=r,this.localeDefaults=e,this.options=n([fe.defaults,r,e,this.overrides,this.dynamicOverrides]),Nt(this.options)},getViewSpec:function(t){var e=this.viewSpecCache;return e[t]||(e[t]=this.buildViewSpec(t))},getUnitViewSpec:function(e){var n,i,r;if(t.inArray(e,Yt)!=-1)for(n=this.header.getViewsWithButtons(),t.each(Ot.views,function(t){n.push(t)}),i=0;i<n.length;i++)if(r=this.getViewSpec(n[i]),r&&r.singleUnit==e)return r},buildViewSpec:function(t){for(var i,r,s,o,l=this.overrides.views||{},a=[],u=[],c=[],d=t;d;)i=At[d],r=l[d],d=null,"function"==typeof i&&(i={class:i}),i&&(a.unshift(i),u.unshift(i.defaults||{}),s=s||i.duration,d=d||i.type),r&&(c.unshift(r),s=s||r.duration,d=d||r.type);return i=q(a),i.type=t,!!i.class&&(s&&(s=e.duration(s),s.valueOf()&&(i.duration=s,o=A(s),1===s.as(o)&&(i.singleUnit=o,c.unshift(l[o]||{})))),i.defaults=n(u),i.overrides=n(c),this.buildViewSpecOptions(i),this.buildViewSpecButtonText(i,t),i)},buildViewSpecOptions:function(t){t.options=n([fe.defaults,t.defaults,this.dirDefaults,this.localeDefaults,this.overrides,t.overrides,this.dynamicOverrides]),Nt(t.options)},buildViewSpecButtonText:function(t,e){function n(n){var i=n.buttonText||{};return i[e]||(t.buttonTextKey?i[t.buttonTextKey]:null)||(t.singleUnit?i[t.singleUnit]:null)}t.buttonTextOverride=n(this.dynamicOverrides)||n(this.overrides)||t.overrides.buttonText,t.buttonTextDefault=n(this.localeDefaults)||n(this.dirDefaults)||t.defaults.buttonText||n(fe.defaults)||(t.duration?this.humanizeDuration(t.duration):null)||e},instantiateView:function(t){var e=this.getViewSpec(t);return new e.class(this,t,e.options,e.duration)},isValidViewType:function(t){return Boolean(this.getViewSpec(t))},pushLoading:function(){this.loadingLevel++||this.publiclyTrigger("loading",null,!0,this.view)},popLoading:function(){--this.loadingLevel||this.publiclyTrigger("loading",null,!1,this.view)},buildSelectSpan:function(t,e){var n,i=this.moment(t).stripZone();return n=e?this.moment(e).stripZone():i.hasTime()?i.clone().add(this.defaultTimedEventDuration):i.clone().add(this.defaultAllDayEventDuration),{start:i,end:n}}});fe.mixin(Jt),fe.mixin({optionHandlers:null,bindOption:function(t,e){this.bindOptions([t],e)},bindOptions:function(t,e){var n,i={func:e,names:t};for(n=0;n<t.length;n++)this.registerOptionHandlerObj(t[n],i);this.triggerOptionHandlerObj(i)},registerOptionHandlerObj:function(t,e){(this.optionHandlers[t]||(this.optionHandlers[t]=[])).push(e)},triggerOptionHandlers:function(t){var e,n=this.optionHandlers[t]||[];for(e=0;e<n.length;e++)this.triggerOptionHandlerObj(n[e])},triggerOptionHandlerObj:function(t){var e,n=t.names,i=[];for(e=0;e<n.length;e++)i.push(this.options[n[e]]);t.func.apply(this,i)}}),fe.defaults={titleRangeSeparator:" – ",monthYearFormat:"MMMM YYYY",defaultTimedEventDuration:"02:00:00",defaultAllDayEventDuration:{days:1},forceEventDuration:!1,nextDayThreshold:"09:00:00",defaultView:"month",aspectRatio:1.35,header:{left:"title",center:"",right:"today prev,next"},weekends:!0,weekNumbers:!1,weekNumberTitle:"W",weekNumberCalculation:"local",scrollTime:"06:00:00",lazyFetching:!0,startParam:"start",endParam:"end",timezoneParam:"timezone",timezone:!1,isRTL:!1,buttonText:{prev:"prev",next:"next",prevYear:"prev year",nextYear:"next year",year:"year",today:"today",month:"month",week:"week",day:"day"},buttonIcons:{prev:"left-single-arrow",next:"right-single-arrow",prevYear:"left-double-arrow",nextYear:"right-double-arrow"},allDayText:"all-day",theme:!1,themeButtonIcons:{prev:"circle-triangle-w",next:"circle-triangle-e",prevYear:"seek-prev",nextYear:"seek-next"},dragOpacity:.75,dragRevertDuration:500,dragScroll:!0,unselectAuto:!0,dropAccept:"*",eventOrder:"title",eventLimit:!1,eventLimitText:"more",eventLimitClick:"popover",dayPopoverFormat:"LL",handleWindowResize:!0,windowResizeDelay:100,longPressDelay:1e3},fe.englishDefaults={dayPopoverFormat:"dddd, MMMM D"},fe.rtlDefaults={header:{left:"next,prev today",center:"",right:"title"},buttonIcons:{prev:"right-single-arrow",next:"left-single-arrow",prevYear:"right-double-arrow",nextYear:"left-double-arrow"},themeButtonIcons:{prev:"circle-triangle-e",next:"circle-triangle-w",nextYear:"seek-prev",prevYear:"seek-next"}};var ge=Ot.locales={};Ot.datepickerLocale=function(e,n,i){var r=ge[e]||(ge[e]={});r.isRTL=i.isRTL,r.weekNumberTitle=i.weekHeader,t.each(pe,function(t,e){r[t]=e(i)}),t.datepicker&&(t.datepicker.regional[n]=t.datepicker.regional[e]=i,t.datepicker.regional.en=t.datepicker.regional[""],t.datepicker.setDefaults(i))},Ot.locale=function(e,i){var r,s;r=ge[e]||(ge[e]={}),i&&(r=ge[e]=n([r,i])),s=Ft(e),t.each(ve,function(t,e){null==r[t]&&(r[t]=e(s,r))}),fe.defaults.locale=e};var pe={buttonText:function(t){return{prev:et(t.prevText),next:et(t.nextText),today:et(t.currentText)}},monthYearFormat:function(t){return t.showMonthAfterYear?"YYYY["+t.yearSuffix+"] MMMM":"MMMM YYYY["+t.yearSuffix+"]"}},ve={dayOfMonthFormat:function(t,e){var n=t.longDateFormat("l");return n=n.replace(/^Y+[^\w\s]*|[^\w\s]*Y+$/g,""),e.isRTL?n+=" ddd":n="ddd "+n,n},mediumTimeFormat:function(t){return t.longDateFormat("LT").replace(/\s*a$/i,"a")},smallTimeFormat:function(t){return t.longDateFormat("LT").replace(":mm","(:mm)").replace(/(\Wmm)$/,"($1)").replace(/\s*a$/i,"a")},extraSmallTimeFormat:function(t){return t.longDateFormat("LT").replace(":mm","(:mm)").replace(/(\Wmm)$/,"($1)").replace(/\s*a$/i,"t")},hourFormat:function(t){return t.longDateFormat("LT").replace(":mm","").replace(/(\Wmm)$/,"").replace(/\s*a$/i,"a")},noMeridiemTimeFormat:function(t){return t.longDateFormat("LT").replace(/\s*a$/i,"")}},me={smallDayDateFormat:function(t){return t.isRTL?"D dd":"dd D"},weekFormat:function(t){return t.isRTL?"w[ "+t.weekNumberTitle+"]":"["+t.weekNumberTitle+" ]w"},smallWeekFormat:function(t){return t.isRTL?"w["+t.weekNumberTitle+"]":"["+t.weekNumberTitle+"]w"}};Ot.locale("en",fe.englishDefaults),Ot.sourceNormalizers=[],Ot.sourceFetchers=[];var ye={dataType:"json",cache:!1},Se=1;fe.prototype.mutateSeg=function(t,e){return this.mutateEvent(t.event,e)},fe.prototype.normalizeEvent=function(t){},fe.prototype.spanContainsSpan=function(t,e){var n=t.start.clone().stripZone(),i=this.getEventEnd(t).stripZone();return e.start>=n&&e.end<=i},fe.prototype.getPeerEvents=function(t,e){var n,i,r=this.getEventCache(),s=[];for(n=0;n<r.length;n++)i=r[n],e&&e._id===i._id||s.push(i);return s},fe.prototype.isEventSpanAllowed=function(t,e){var n=e.source||{},i=J(e.constraint,n.constraint,this.options.eventConstraint),r=J(e.overlap,n.overlap,this.options.eventOverlap);return this.isSpanAllowed(t,i,r,e)&&(!this.options.eventAllow||this.options.eventAllow(t,e)!==!1)},fe.prototype.isExternalSpanAllowed=function(e,n,i){var r,s;return i&&(r=t.extend({},i,n),s=this.expandEvent(this.buildEventFromInput(r))[0]),s?this.isEventSpanAllowed(e,s):this.isSelectionSpanAllowed(e)},fe.prototype.isSelectionSpanAllowed=function(t){return this.isSpanAllowed(t,this.options.selectConstraint,this.options.selectOverlap)&&(!this.options.selectAllow||this.options.selectAllow(t)!==!1)},fe.prototype.isSpanAllowed=function(t,e,n,i){var r,s,o,l,a,u;if(null!=e&&(r=this.constraintToEvents(e))){for(s=!1,l=0;l<r.length;l++)if(this.spanContainsSpan(r[l],t)){s=!0;break}if(!s)return!1}for(o=this.getPeerEvents(t,i),l=0;l<o.length;l++)if(a=o[l],this.eventIntersectsRange(a,t)){if(n===!1)return!1;if("function"==typeof n&&!n(a,i))return!1;if(i){if(u=J(a.overlap,(a.source||{}).overlap),u===!1)return!1;if("function"==typeof u&&!u(i,a))return!1}}return!0},fe.prototype.constraintToEvents=function(t){return"businessHours"===t?this.getCurrentBusinessHourEvents():"object"==typeof t?null!=t.start?this.expandEvent(this.buildEventFromInput(t)):null:this.clientEvents(t)},fe.prototype.eventIntersectsRange=function(t,e){var n=t.start.clone().stripZone(),i=this.getEventEnd(t).stripZone();return e.start<i&&e.end>n};var we={id:"_fcBusinessHours",start:"09:00",end:"17:00",dow:[1,2,3,4,5],rendering:"inverse-background"};fe.prototype.getCurrentBusinessHourEvents=function(t){return this.computeBusinessHourEvents(t,this.options.businessHours)},fe.prototype.computeBusinessHourEvents=function(e,n){return n===!0?this.expandBusinessHourEvents(e,[{}]):t.isPlainObject(n)?this.expandBusinessHourEvents(e,[n]):t.isArray(n)?this.expandBusinessHourEvents(e,n,!0):[]},fe.prototype.expandBusinessHourEvents=function(e,n,i){var r,s,o=this.getView(),l=[];for(r=0;r<n.length;r++)s=n[r],i&&!s.dow||(s=t.extend({},we,s),e&&(s.start=null,s.end=null),l.push.apply(l,this.expandEvent(this.buildEventFromInput(s),o.start,o.end)));return l};var Ee=Ot.BasicView=de.extend({scroller:null,dayGridClass:ue,dayGrid:null,dayNumbersVisible:!1,colWeekNumbersVisible:!1,cellWeekNumbersVisible:!1,weekNumberWidth:null,headContainerEl:null,headRowEl:null,initialize:function(){this.dayGrid=this.instantiateDayGrid(),this.scroller=new he({overflowX:"hidden",overflowY:"auto"})},instantiateDayGrid:function(){var t=this.dayGridClass.extend(be);return new t(this)},setRange:function(t){de.prototype.setRange.call(this,t),this.dayGrid.breakOnWeeks=/year|month|week/.test(this.intervalUnit),this.dayGrid.setRange(t)},computeRange:function(t){var e=de.prototype.computeRange.call(this,t);return/year|month/.test(e.intervalUnit)&&(e.start.startOf("week"),e.start=this.skipHiddenDays(e.start),e.end.weekday()&&(e.end.add(1,"week").startOf("week"),e.end=this.skipHiddenDays(e.end,-1,!0))),e},renderDates:function(){this.dayNumbersVisible=this.dayGrid.rowCnt>1,this.opt("weekNumbers")&&(this.opt("weekNumbersWithinDays")?(this.cellWeekNumbersVisible=!0,this.colWeekNumbersVisible=!1):(this.cellWeekNumbersVisible=!1,this.colWeekNumbersVisible=!0)),this.dayGrid.numbersVisible=this.dayNumbersVisible||this.cellWeekNumbersVisible||this.colWeekNumbersVisible,this.el.addClass("fc-basic-view").html(this.renderSkeletonHtml()),this.renderHead(),this.scroller.render();var e=this.scroller.el.addClass("fc-day-grid-container"),n=t('<div class="fc-day-grid" />').appendTo(e);this.el.find(".fc-body > tr > td").append(e),this.dayGrid.setElement(n),this.dayGrid.renderDates(this.hasRigidRows())},renderHead:function(){this.headContainerEl=this.el.find(".fc-head-container").html(this.dayGrid.renderHeadHtml()),this.headRowEl=this.headContainerEl.find(".fc-row")},unrenderDates:function(){this.dayGrid.unrenderDates(),this.dayGrid.removeElement(),this.scroller.destroy()},renderBusinessHours:function(){this.dayGrid.renderBusinessHours()},unrenderBusinessHours:function(){this.dayGrid.unrenderBusinessHours()},renderSkeletonHtml:function(){return'<table><thead class="fc-head"><tr><td class="fc-head-container '+this.widgetHeaderClass+'"></td></tr></thead><tbody class="fc-body"><tr><td class="'+this.widgetContentClass+'"></td></tr></tbody></table>'},weekNumberStyleAttr:function(){return null!==this.weekNumberWidth?'style="width:'+this.weekNumberWidth+'px"':""},hasRigidRows:function(){var t=this.opt("eventLimit");return t&&"number"!=typeof t},updateWidth:function(){this.colWeekNumbersVisible&&(this.weekNumberWidth=u(this.el.find(".fc-week-number")))},setHeight:function(t,e){var n,s,o=this.opt("eventLimit");this.scroller.clear(),r(this.headRowEl),this.dayGrid.removeSegPopover(),o&&"number"==typeof o&&this.dayGrid.limitRows(o),n=this.computeScrollerHeight(t),this.setGridHeight(n,e),o&&"number"!=typeof o&&this.dayGrid.limitRows(o),e||(this.scroller.setHeight(n),s=this.scroller.getScrollbarWidths(),(s.left||s.right)&&(i(this.headRowEl,s),n=this.computeScrollerHeight(t),this.scroller.setHeight(n)),this.scroller.lockOverflow(s))},computeScrollerHeight:function(t){return t-c(this.el,this.scroller.el)},setGridHeight:function(t,e){e?a(this.dayGrid.rowEls):l(this.dayGrid.rowEls,t,!0)},computeInitialScroll:function(){return{top:0}},queryScroll:function(){return{top:this.scroller.getScrollTop()}},setScroll:function(t){this.scroller.setScrollTop(t.top)},hitsNeeded:function(){this.dayGrid.hitsNeeded()},hitsNotNeeded:function(){this.dayGrid.hitsNotNeeded()},prepareHits:function(){this.dayGrid.prepareHits()},releaseHits:function(){this.dayGrid.releaseHits()},queryHit:function(t,e){return this.dayGrid.queryHit(t,e)},getHitSpan:function(t){return this.dayGrid.getHitSpan(t)},getHitEl:function(t){return this.dayGrid.getHitEl(t)},renderEvents:function(t){this.dayGrid.renderEvents(t),this.updateHeight()},getEventSegs:function(){return this.dayGrid.getEventSegs()},unrenderEvents:function(){this.dayGrid.unrenderEvents()},renderDrag:function(t,e){return this.dayGrid.renderDrag(t,e)},unrenderDrag:function(){this.dayGrid.unrenderDrag()},renderSelection:function(t){this.dayGrid.renderSelection(t)},unrenderSelection:function(){this.dayGrid.unrenderSelection()}}),be={renderHeadIntroHtml:function(){var t=this.view;return t.colWeekNumbersVisible?'<th class="fc-week-number '+t.widgetHeaderClass+'" '+t.weekNumberStyleAttr()+"><span>"+tt(t.opt("weekNumberTitle"))+"</span></th>":""},renderNumberIntroHtml:function(t){var e=this.view,n=this.getCellDate(t,0);return e.colWeekNumbersVisible?'<td class="fc-week-number" '+e.weekNumberStyleAttr()+">"+e.buildGotoAnchorHtml({date:n,type:"week",forceOff:1===this.colCnt},n.format("w"))+"</td>":""},renderBgIntroHtml:function(){var t=this.view;return t.colWeekNumbersVisible?'<td class="fc-week-number '+t.widgetContentClass+'" '+t.weekNumberStyleAttr()+"></td>":""},renderIntroHtml:function(){var t=this.view;return t.colWeekNumbersVisible?'<td class="fc-week-number" '+t.weekNumberStyleAttr()+"></td>":""}},De=Ot.MonthView=Ee.extend({computeRange:function(t){var e,n=Ee.prototype.computeRange.call(this,t);return this.isFixedWeeks()&&(e=Math.ceil(n.end.diff(n.start,"weeks",!0)),n.end.add(6-e,"weeks")),n},setGridHeight:function(t,e){e&&(t*=this.rowCnt/6),l(this.dayGrid.rowEls,t,!e)},isFixedWeeks:function(){return this.opt("fixedWeekCount")}});At.basic={class:Ee},At.basicDay={type:"basic",duration:{days:1}},At.basicWeek={type:"basic",duration:{weeks:1}},At.month={class:De,duration:{months:1},defaults:{fixedWeekCount:!0}};var Te=Ot.AgendaView=de.extend({scroller:null,timeGridClass:ce,timeGrid:null,dayGridClass:ue,dayGrid:null,axisWidth:null,headContainerEl:null,noScrollRowEls:null,bottomRuleEl:null,initialize:function(){this.timeGrid=this.instantiateTimeGrid(),this.opt("allDaySlot")&&(this.dayGrid=this.instantiateDayGrid()),this.scroller=new he({overflowX:"hidden",overflowY:"auto"})},instantiateTimeGrid:function(){var t=this.timeGridClass.extend(Ce);return new t(this)},instantiateDayGrid:function(){var t=this.dayGridClass.extend(He);return new t(this)},setRange:function(t){de.prototype.setRange.call(this,t),this.timeGrid.setRange(t),this.dayGrid&&this.dayGrid.setRange(t)},renderDates:function(){this.el.addClass("fc-agenda-view").html(this.renderSkeletonHtml()),this.renderHead(),this.scroller.render();var e=this.scroller.el.addClass("fc-time-grid-container"),n=t('<div class="fc-time-grid" />').appendTo(e);this.el.find(".fc-body > tr > td").append(e),this.timeGrid.setElement(n),this.timeGrid.renderDates(),this.bottomRuleEl=t('<hr class="fc-divider '+this.widgetHeaderClass+'"/>').appendTo(this.timeGrid.el),this.dayGrid&&(this.dayGrid.setElement(this.el.find(".fc-day-grid")),this.dayGrid.renderDates(),this.dayGrid.bottomCoordPadding=this.dayGrid.el.next("hr").outerHeight()),this.noScrollRowEls=this.el.find(".fc-row:not(.fc-scroller *)")},renderHead:function(){this.headContainerEl=this.el.find(".fc-head-container").html(this.timeGrid.renderHeadHtml())},unrenderDates:function(){this.timeGrid.unrenderDates(),this.timeGrid.removeElement(),this.dayGrid&&(this.dayGrid.unrenderDates(),this.dayGrid.removeElement()),this.scroller.destroy()},renderSkeletonHtml:function(){return'<table><thead class="fc-head"><tr><td class="fc-head-container '+this.widgetHeaderClass+'"></td></tr></thead><tbody class="fc-body"><tr><td class="'+this.widgetContentClass+'">'+(this.dayGrid?'<div class="fc-day-grid"/><hr class="fc-divider '+this.widgetHeaderClass+'"/>':"")+"</td></tr></tbody></table>"},axisStyleAttr:function(){return null!==this.axisWidth?'style="width:'+this.axisWidth+'px"':""},renderBusinessHours:function(){this.timeGrid.renderBusinessHours(),this.dayGrid&&this.dayGrid.renderBusinessHours()},unrenderBusinessHours:function(){this.timeGrid.unrenderBusinessHours(),this.dayGrid&&this.dayGrid.unrenderBusinessHours()},getNowIndicatorUnit:function(){return this.timeGrid.getNowIndicatorUnit()},renderNowIndicator:function(t){this.timeGrid.renderNowIndicator(t)},unrenderNowIndicator:function(){this.timeGrid.unrenderNowIndicator()},updateSize:function(t){this.timeGrid.updateSize(t),de.prototype.updateSize.call(this,t)},updateWidth:function(){this.axisWidth=u(this.el.find(".fc-axis"))},setHeight:function(t,e){var n,s,o;this.bottomRuleEl.hide(),this.scroller.clear(),r(this.noScrollRowEls),this.dayGrid&&(this.dayGrid.removeSegPopover(),n=this.opt("eventLimit"),n&&"number"!=typeof n&&(n=xe),n&&this.dayGrid.limitRows(n)),e||(s=this.computeScrollerHeight(t),this.scroller.setHeight(s),o=this.scroller.getScrollbarWidths(),(o.left||o.right)&&(i(this.noScrollRowEls,o),s=this.computeScrollerHeight(t),this.scroller.setHeight(s)),this.scroller.lockOverflow(o),this.timeGrid.getTotalSlatHeight()<s&&this.bottomRuleEl.show())},computeScrollerHeight:function(t){return t-c(this.el,this.scroller.el)},computeInitialScroll:function(){var t=e.duration(this.opt("scrollTime")),n=this.timeGrid.computeTimeTop(t);return n=Math.ceil(n),n&&n++,{top:n}},queryScroll:function(){return{top:this.scroller.getScrollTop()}},setScroll:function(t){this.scroller.setScrollTop(t.top)},hitsNeeded:function(){this.timeGrid.hitsNeeded(),this.dayGrid&&this.dayGrid.hitsNeeded()},hitsNotNeeded:function(){this.timeGrid.hitsNotNeeded(),this.dayGrid&&this.dayGrid.hitsNotNeeded()},prepareHits:function(){this.timeGrid.prepareHits(),this.dayGrid&&this.dayGrid.prepareHits();
},releaseHits:function(){this.timeGrid.releaseHits(),this.dayGrid&&this.dayGrid.releaseHits()},queryHit:function(t,e){var n=this.timeGrid.queryHit(t,e);return!n&&this.dayGrid&&(n=this.dayGrid.queryHit(t,e)),n},getHitSpan:function(t){return t.component.getHitSpan(t)},getHitEl:function(t){return t.component.getHitEl(t)},renderEvents:function(t){var e,n,i=[],r=[],s=[];for(n=0;n<t.length;n++)t[n].allDay?i.push(t[n]):r.push(t[n]);e=this.timeGrid.renderEvents(r),this.dayGrid&&(s=this.dayGrid.renderEvents(i)),this.updateHeight()},getEventSegs:function(){return this.timeGrid.getEventSegs().concat(this.dayGrid?this.dayGrid.getEventSegs():[])},unrenderEvents:function(){this.timeGrid.unrenderEvents(),this.dayGrid&&this.dayGrid.unrenderEvents()},renderDrag:function(t,e){return t.start.hasTime()?this.timeGrid.renderDrag(t,e):this.dayGrid?this.dayGrid.renderDrag(t,e):void 0},unrenderDrag:function(){this.timeGrid.unrenderDrag(),this.dayGrid&&this.dayGrid.unrenderDrag()},renderSelection:function(t){t.start.hasTime()||t.end.hasTime()?this.timeGrid.renderSelection(t):this.dayGrid&&this.dayGrid.renderSelection(t)},unrenderSelection:function(){this.timeGrid.unrenderSelection(),this.dayGrid&&this.dayGrid.unrenderSelection()}}),Ce={renderHeadIntroHtml:function(){var t,e=this.view;return e.opt("weekNumbers")?(t=this.start.format(e.opt("smallWeekFormat")),'<th class="fc-axis fc-week-number '+e.widgetHeaderClass+'" '+e.axisStyleAttr()+">"+e.buildGotoAnchorHtml({date:this.start,type:"week",forceOff:this.colCnt>1},tt(t))+"</th>"):'<th class="fc-axis '+e.widgetHeaderClass+'" '+e.axisStyleAttr()+"></th>"},renderBgIntroHtml:function(){var t=this.view;return'<td class="fc-axis '+t.widgetContentClass+'" '+t.axisStyleAttr()+"></td>"},renderIntroHtml:function(){var t=this.view;return'<td class="fc-axis" '+t.axisStyleAttr()+"></td>"}},He={renderBgIntroHtml:function(){var t=this.view;return'<td class="fc-axis '+t.widgetContentClass+'" '+t.axisStyleAttr()+"><span>"+t.getAllDayHtml()+"</span></td>"},renderIntroHtml:function(){var t=this.view;return'<td class="fc-axis" '+t.axisStyleAttr()+"></td>"}},xe=5,Re=[{hours:1},{minutes:30},{minutes:15},{seconds:30},{seconds:15}];At.agenda={class:Te,defaults:{allDaySlot:!0,slotDuration:"00:30:00",minTime:"00:00:00",maxTime:"24:00:00",slotEventOverlap:!0}},At.agendaDay={type:"agenda",duration:{days:1}},At.agendaWeek={type:"agenda",duration:{weeks:1}};var Ie=de.extend({grid:null,scroller:null,initialize:function(){this.grid=new ke(this),this.scroller=new he({overflowX:"hidden",overflowY:"auto"})},setRange:function(t){de.prototype.setRange.call(this,t),this.grid.setRange(t)},renderSkeleton:function(){this.el.addClass("fc-list-view "+this.widgetContentClass),this.scroller.render(),this.scroller.el.appendTo(this.el),this.grid.setElement(this.scroller.scrollEl)},unrenderSkeleton:function(){this.scroller.destroy()},setHeight:function(t,e){this.scroller.setHeight(this.computeScrollerHeight(t))},computeScrollerHeight:function(t){return t-c(this.el,this.scroller.el)},renderEvents:function(t){this.grid.renderEvents(t)},unrenderEvents:function(){this.grid.unrenderEvents()},isEventResizable:function(t){return!1},isEventDraggable:function(t){return!1}}),ke=le.extend({segSelector:".fc-list-item",hasDayInteractions:!1,spanToSegs:function(t){for(var e,n=this.view,i=n.start.clone().time(0),r=0,s=[];i<n.end;)if(e=F(t,{start:i,end:i.clone().add(1,"day")}),e&&(e.dayIndex=r,s.push(e)),i.add(1,"day"),r++,e&&!e.isEnd&&t.end.hasTime()&&t.end<i.clone().add(this.view.nextDayThreshold)){e.end=t.end.clone(),e.isEnd=!0;break}return s},computeEventTimeFormat:function(){return this.view.opt("mediumTimeFormat")},handleSegClick:function(e,n){var i;le.prototype.handleSegClick.apply(this,arguments),t(n.target).closest("a[href]").length||(i=e.event.url,i&&!n.isDefaultPrevented()&&(window.location.href=i))},renderFgSegs:function(t){return t=this.renderFgSegEls(t),t.length?this.renderSegList(t):this.renderEmptyMessage(),t},renderEmptyMessage:function(){this.el.html('<div class="fc-list-empty-wrap2"><div class="fc-list-empty-wrap1"><div class="fc-list-empty">'+tt(this.view.opt("noEventsMessage"))+"</div></div></div>")},renderSegList:function(e){var n,i,r,s=this.groupSegsByDay(e),o=t('<table class="fc-list-table"><tbody/></table>'),l=o.find("tbody");for(n=0;n<s.length;n++)if(i=s[n])for(l.append(this.dayHeaderHtml(this.view.start.clone().add(n,"days"))),this.sortEventSegs(i),r=0;r<i.length;r++)l.append(i[r].el);this.el.empty().append(o)},groupSegsByDay:function(t){var e,n,i=[];for(e=0;e<t.length;e++)n=t[e],(i[n.dayIndex]||(i[n.dayIndex]=[])).push(n);return i},dayHeaderHtml:function(t){var e=this.view,n=e.opt("listDayFormat"),i=e.opt("listDayAltFormat");return'<tr class="fc-list-heading" data-date="'+t.format("YYYY-MM-DD")+'"><td class="'+e.widgetHeaderClass+'" colspan="3">'+(n?e.buildGotoAnchorHtml(t,{class:"fc-list-heading-main"},tt(t.format(n))):"")+(i?e.buildGotoAnchorHtml(t,{class:"fc-list-heading-alt"},tt(t.format(i))):"")+"</td></tr>"},fgSegHtml:function(t){var e,n=this.view,i=["fc-list-item"].concat(this.getSegCustomClasses(t)),r=this.getSegBackgroundColor(t),s=t.event,o=s.url;return e=s.allDay?n.getAllDayHtml():n.isMultiDayEvent(s)?t.isStart||t.isEnd?tt(this.getEventTimeText(t)):n.getAllDayHtml():tt(this.getEventTimeText(s)),o&&i.push("fc-has-url"),'<tr class="'+i.join(" ")+'">'+(this.displayEventTime?'<td class="fc-list-item-time '+n.widgetContentClass+'">'+(e||"")+"</td>":"")+'<td class="fc-list-item-marker '+n.widgetContentClass+'"><span class="fc-event-dot"'+(r?' style="background-color:'+r+'"':"")+'></span></td><td class="fc-list-item-title '+n.widgetContentClass+'"><a'+(o?' href="'+tt(o)+'"':"")+">"+tt(t.event.title||"")+"</a></td></tr>"}});return At.list={class:Ie,buttonTextKey:"list",defaults:{buttonText:"list",listDayFormat:"LL",noEventsMessage:"No events to display"}},At.listDay={type:"list",duration:{days:1},defaults:{listDayFormat:"dddd"}},At.listWeek={type:"list",duration:{weeks:1},defaults:{listDayFormat:"dddd",listDayAltFormat:"LL"}},At.listMonth={type:"list",duration:{month:1},defaults:{listDayAltFormat:"dddd"}},At.listYear={type:"list",duration:{year:1},defaults:{listDayAltFormat:"dddd"}},Ot});
/*
 *	jQuery FullCalendar Extendable Plugin
 *	An Ajax (PHP - Mysql - jquery) script that extends the functionalities of the fullcalendar plugin
 *  Dependencies:
 *   - jquery
 *   - jquery Ui
 * 	 - jquery spectrum (since 2.0)
 *   - jquery timepicker (since 1.6.4)
 *   - jquery Fullcalendar
 *   - Twitter Bootstrap
 *  Author: Paulo Regina
 *  Website: www.pauloreg.com
 *  Contributions: Patrik Iden, Jan-Paul Kleemans, Bob Mulder
 *	Version 3.0, February - 2017
 *          3.1.2, February - 2018
 *  Fullcalendar 3.2.0
 *	Released Under Envato Regular or Extended Licenses
 */

(function($, undefined)
{
	$.fn.extend
	({
		// FullCalendar Extendable Plugin
		FullCalendarExt: function(options)
		{
			var token = 'token='+$('#cal_token').val();
            var user_id = '&user_id='+$('#agent_id').val();
			// Default Configurations (General)
			var defaults =
			{
				calendarSelector: '#calendar',
				loadingSelector: '#loading',
				lang: 'fr',
				token: '',
                //ajaxJsonFetch: site_url+'availabalities/get_calendar_json?'+token,
				ajaxJsonFetch: 'includes/cal_events.php?'+token+user_id,
				ajaxUiUpdate: 'includes/cal_update.php?'+token,
				ajaxEventQuickSave: 'includes/cal_quicksave.php?'+token,
				ajaxEventDelete: 'includes/cal_delete.php?'+token,
				ajaxEventEdit: 'includes/cal_edit_update.php?'+token,
				ajaxEventExport: 'includes/cal_export.php?'+token,
				ajaxRepeatCheck: 'includes/cal_check_rep_events.php?'+token,
				ajaxRetrieveDescription: 'includes/cal_description.php?'+token,
				ajaxImport: 'importer.php?'+token,
				jsonConfig: 'includes/form.json',

				modalSelector: '#calendarModal',
				modalPromptSelector: '#cal_prompt',
				modalEditPromptSelector: '#cal_edit_prompt_save',
				formSearchSelector:"form#search",

				formAddEventSelector: 'form#add_event',
				formFilterSelector: 'form#filter-category select',
				formEditEventSelector: 'form#edit_event', // php version
				formSearchSelector:"form#search",

				newEventText: 'Add New Availabality',
				successAddEventMessage: 'Successfully Added Availabality',
				successDeleteEventMessage: 'Successfully Deleted Availabality',
				successUpdateEventMessage: 'Successfully Updated Availabality',
				failureAddEventMessage: 'Failed To Add Availabality',
				failureDeleteEventMessage: 'Failed To Delete Availabality',
				failureUpdateEventMessage: 'Failed To Update Availabality',
				generalFailureMessage: 'Failed To Execute Action',
				ajaxError: 'Failed to load content',
				emptyForm: 'Form cannot be empty',

				eventText: 'Availabality: ',
				repetitiveEventActionText: 'This is a repetitive availabality, what do you want to do?',

				isRTL: false,
				weekNumberTitle: 'W',

				defaultColor: '#587ca3',

				weekType: 'agendaWeek', // basicWeek
				dayType: 'agendaDay', // basicDay
				listType: 'listWeek', // list, listYear, listWeek, listMonth, listDay

				editable: true,
				ignoreTimezone: true,
				lazyFetching: true,
				filter: true,
				quickSave: true,
				navLinks: true,
				firstDay: 0,

				gcal: false,
				gcalUrlText: 'View on Google',

				version: 'modal',

				defaultView: 'month', // basicWeek or basicDay or agendaWeek or any list
				aspectRatio: 1.35, // will make day boxes bigger
				weekends: true, // show (true) the weekend or not (false)
				weekNumbers: false, // show week numbers (true) or not (false)
				weekNumberCalculation: 'iso',

				hiddenDays: [], // [0,1,2,3,4,5,6] to hide days as you wish

				theme: false,
				themePrev: 'circle-triangle-w',
				themeNext: 'circle-triangle-e',

				titleFormatMonth: '',
				titleFormatWeek: '',
				titleFormatDay: '',
				columnFormatMonth: '',
				columnFormatWeek: '',
				columnFormatDay: '',
				timeFormat: 'H:mm',

				weekMode: true, // 'fixed' (true), 'liquid' (false), 'variable' (auto)

				allDaySlot: true, // true, false
				allDayText: 'all-day',
				axisFormat: 'h(:mm)a',

				slotDuration: '00:30:00',
				minTime: '00:00:00',
				maxTime: '24:00:00',

				slotEventOverlap: true,

				enableDrop: true,
				enableResize: true,

				savedRedirect: 'index.php',
				removedRedirect: 'index.php',
				updatedRedirect: 'index.php',

				ajaxLoaderMarkup: '<div class="loadingDiv"></div>',
				prev: "left-single-arrow",
				next: "right-single-arrow",
				prevYear: "left-double-arrow",
				nextYear: "right-double-arrow",

				otherSource: false,

				modalFormBody: $('#modal-form-body').html(),

				icons_title: false,

				eventLimit: true,
				eventLimitClick: 'popover', // 'popover', 'week', 'day', view name, function
				palette: [
							["#0b57a4","#8bbdeb","#000000","#2a82d7","#148aa5","#3714a4","#587ca3","#a50516"],
							["#fb3c8f","#1b4f15","#1b4f15","#686868","#3aa03a","#ff0080","#fee233","#fc1cad"],
							["#7f2b14","#000066","#2b4726","#fd7222","#fc331c","#af31f2","#fc0d1b","#2b8a6d"],
							["#ea9999","#f9cb9c","#ffe599","#b6d7a8","#a2c4c9","#9fc5e8","#b4a7d6","#d5a6bd"]
						]
            }

			var ops =  $.extend(defaults, options);

			var opt = ops;

			if(opt.gcal == true) { opt.weekType = ''; opt.dayType = ''; }

			// fullCalendar
			$(opt.calendarSelector).fullCalendar
			({
				locale: opt.lang,
				editable: opt.editable,
				eventLimit: opt.eventLimit,
				eventLimitClick: opt.eventLimitClick,
				navLinks: opt.navLinks,

				defaultView: opt.defaultView,
				aspectRatio: opt.aspectRatio,
				weekends: opt.weekends,
				weekNumbers: opt.weekNumbers,
				weekNumberCalculation: opt.weekNumberCalculation,
				weekNumberTitle: opt.weekNumberTitle,
				views: {
					month: {
						titleFormat: opt.titleFormatMonth,
						columnFormat: opt.columnFormatMonth,
					},
					week: {
						titleFormat: opt.titleFormatWeek,
						columnFormat: opt.columnFormatWeek,
					},
					day: {
						titleFormat: opt.titleFormatDay,
						columnFormat: opt.columnFormatDay,
					}
				},
				isRTL: opt.isRTL,
				hiddenDays: opt.hiddenDays,
				theme: opt.theme,
				buttonIcons: {
					prev: opt.prev,
					next: opt.next,
					prevYear: opt.prevYear,
					nextYear: opt.nextYear
				},
				themeButtonIcons: {
					prev: opt.themePrev,
					next: opt.themeNext
				},
				allDaySlot: opt.allDaySlot,
				allDayText: opt.allDayText,
				slotLabelFormat: opt.axisFormat,
				slotDuration: opt.slotDuration,
				minTime: opt.minTime,
				maxTime: opt.maxTime,
				slotEventOverlap: opt.slotEventOverlap,
				fixedWeekCount: opt.weekMode,
				timeFormat: opt.timeFormat,
				header:
				{
						left: 'prev,next',
						center: 'title',
						right: 'month,'+opt.weekType+','+opt.dayType+','+opt.listType
				},
				monthNames: opt.monthNames,
				monthNamesShort: opt.monthNamesShort,
				dayNames: opt.dayNames,
				dayNamesShort: opt.dayNamesShort,
				buttonText: {
					today: opt.today,
					month: opt.month,
					week: opt.week,
					day: opt.day
				},
				ignoreTimezone: opt.ignoreTimezone,
				firstDay: opt.firstDay,
				lazyFetching: opt.lazyFetching,
				selectable: opt.quickSave,
				selectHelper: opt.quickSave,
				eventStartEditable: opt.enableDrop,
				eventDurationEditable: opt.enableResize,
				loading: function(bool) {
					if(bool == false)
					{
						$(opt.loadingSelector).hide();
					} else if(bool == true) {
						$(opt.loadingSelector).show();
					}
				},
				select: function(start, end, allDay, view)
				{
					calendar.view = view.name;
					if(opt.version == 'modal')
					{
						calendar.quickModal(start, end, allDay);
						$(opt.calendarSelector).fullCalendar('unselect');
					}

				   if(view.name !== 'month')
				   {
					 if(moment(start._d).format('HH:mm') !== moment(end._d).format('HH:mm'))
					 {
					   $('#event-type option[value="false"]').prop('selected', true);
					   $('#event-type-select').show();
					   $('#event-type-selected').show();
					 }
				   }
				},
				eventSources: [
					opt.otherSource,
					{
						url: opt.ajaxJsonFetch
					}
				],
				eventDrop:
					function(event)
					{
						var ed_startDate = moment(event.start).format('YYYY-MM-DD');
						var ed_startTime = moment(event.start).format('HH:mm');
						var ed_endDate = moment(event.end).format('YYYY-MM-DD');
						var ed_endTime = moment(event.end).format('HH:mm');

						var e_val = moment(event.end).isValid();

						if(event.end === null || event.end === 'null' || e_val == false)
						{
							Eend = ed_startDate+' '+ed_startTime;
							EaD = event.allDay;
						} else {
							Eend = ed_endDate+' '+ed_endTime;
							EaD = event.allDay;
						}

						var theEvent = 'start=' + ed_startDate + ' ' + ed_startTime +
									   '&end=' + Eend +
									   '&id=' + event.id +
									   '&allDay=' + EaD +
									   '&original_id=' + event.original_id;

						$.post(opt.ajaxUiUpdate, theEvent, function(response) {
							$(opt.calendarSelector).fullCalendar('refetchEvents');
						});
					},
				eventResize:
					function(event)
					{
						var er_startDate = moment(event.start).format('YYYY-MM-DD');
						var er_startTime = moment(event.start).format('HH:mm');
						var er_endDate = moment(event.end).format('YYYY-MM-DD');
						var er_endTime = moment(event.end).format('HH:mm');

						var e_val = moment(event.end).isValid();

						if(event.end === null || event.end === 'null' || e_val == false)
						{
							Eend = er_startDate+' '+er_startTime;
							EaD = 'false';
						} else {
							Eend = er_endDate+' '+er_endTime;
							EaD = event.allDay;
						}

						var theEvent = 'start=' + er_startDate + ' ' + er_startTime +
									   '&end=' + Eend +
									   '&id=' + event.id +
									   '&allDay=' + EaD +
									   '&original_id=' + event.original_id;

						$.post(opt.ajaxUiUpdate, theEvent, function(response) {
							$(opt.calendarSelector).fullCalendar('refetchEvents');
						});
					},
				eventRender:
					function(event, element, view)
					{
						if(element.attr('href'))
						{
							element.attr('data-toggle', 'modal');
							element.attr('href', 'javascript:void(0)');
							element.attr('onclick', 'calendar.openModalGcal("' + event.title + '","' + event.url + '");');
						} else {
							if(opt.icons_title == true)
							{
								var currentTitle = element.find('.fc-title').text();
								var replaced = currentTitle.replace(/\[(.*?)\]/gi, '<i class="$1"></i>');
								element.find('.fc-title').html(replaced);
							}

							var d_color = event.color;
							var d_startDate = moment(event.start).format('YYYY-MM-DD');
							var d_startTime = moment(event.start).format('HH:mm');
							var d_endDate = moment(event.end).format('YYYY-MM-DD');
							var d_endTime = moment(event.end).format('HH:mm');

							var e_val = moment(event.end).isValid();
							if(e_val == false)
							{
								var d_endDate = d_startDate;
								var d_endTime = d_startTime;
							}

							if(event.end !== null && view.name == 'month')
							{
								if(opt.timeFormat == 'H:mm' || opt.timeFormat == 'h:mm')
								{
									timeformat = event.start.format('H:mm') + ' - ' + event.end.format('H:mm');
									element.find('.fc-time').html(timeformat);
								}
							}

							if(opt.version == 'modal')
							{
								// Open action (modalView Mode)
								element.attr('data-toggle', 'modal');
								element.attr('href', 'javascript:void(0)');
								element.attr('onclick', 'calendar.openModal("' + event.title + '","' + event.url + '","' + event.original_id + '","' + event.id + '","' + event.start + '","' + event.end + '","' + d_color + '","' + d_startDate + '","' + d_startTime + '","' + d_endDate + '","' + d_endTime + '");');
							}
						}
					}
				}); //fullCalendar

				 // Function to Open Modal
				calendar.openModal = function(title, url, id, rep_id, eStart, eEnd, color, startDate, startTime, endDate, endTime)
				{
					 if(opt.icons_title == true)
					 {
						title = title.replace(/\[(.*?)\]/gi, '<i class="$1"></i>');
					 }

					 $('#modal-form-body').hide();
					 $('#details-body').show();

					 calendar.title = title;
					 calendar.id = id;
					 calendar.rep_id = rep_id;

					 calendar.eventStart = eStart;
					 calendar.eventEnd = eEnd;

					 ExpS = startDate + ' ' + startTime;
					 ExpE = endDate+' '+endTime;

					  $.ajax({
						type: "POST",
						url: opt.ajaxRetrieveDescription,
						data: {id: calendar.id, mode: 'edit'},
						cache: false,
						beforeSend: function() { $('.loadingDiv').show(); $('.modal-footer').hide() },
						error: function() { $('.loadingDiv').hide(); alert(opt.ajaxError) },
						success: function(json_enc)
						{
							 $('.loadingDiv').hide();
							 var json = $.parseJSON(json_enc);
							 var dsc = json.description.replace('$null', '');
							 var color = json.color.replace('$null', '');
							 var cat = json.category.replace('$null', '');

							 calendar.description_editable = json.description_editable.replace('&amp;', '&');
							 calendar.description = dsc.replace('&amp;', '&');
							 calendar.category = cat.replace('&amp;', '&');
							 calendar.color = color;
							 calendar.data = json;
							 var thisData = JSON.parse(JSON.stringify(json));

							 $('#details-body-title').html(title);

							 calendar.removeObjProp(thisData, ['all-day','categorie','categories','category','color','description','description_editable','end','start','id','repeat_id','repeat_type','title','url','user_id']);

							 var html_pair = '';
							 $.ajax({
							    async: false,
							    url: opt.jsonConfig,
							    success: function(jsonD) {
							    	$json = jsonD;
							    }
							 });

							 if($('.custom-fields').children().length > 0)
							 {
								if(Object.keys(thisData).length > 0)
								 {
									if(!Object.keys(thisData).every(function(x) { return thisData[x] === '' || thisData[x] === null; })) { html_pair = '<hr />'; }
									for(var key in thisData)
									{
										var value = thisData[key];
										if(key == 'file')
										{
											if(value !== undefined && value !== "undefined")
											{
												value = '<a href="'+value+'">'+value+'</a>';
											} else {
												value = '';
											}
										}
										var label = JSONfindKeyByValue($json, '<'+key+'>');
										if(value.length > 0)
										{
											html_pair += '<h5><strong>'+label+'</strong></h5><p>'+value+'</p><p class="custom-field-sep" style="margin-bottom: 0; height: 2px;">&nbsp;</p>';
										}
									}

								 }
							 }

							 $('#details-body-content').html(dsc + html_pair);

							 $('#export-event, #delete-event, #edit-event').show();
							 $('#save-changes, #add-event').hide();

							 $('.modal-footer').show();
							 $(opt.modalSelector).modal('show');
						}
					  });

					// Delete button
					$('#delete-event').off().on('click', function(e)
					{
						calendar.remove(calendar.id);
						e.preventDefault();
					});

					 // Export button
					$('#export-event').off().on('click', function(e)
					{
						calendar.exportIcal(calendar.id, calendar.title, calendar.description, ExpS, ExpE);
						e.preventDefault();
					});

					 // Edit Button
					 $('#edit-event').off().on('click', function(e) {

						document.getElementById("modal-form-body").reset();
						$('#modal-form-body').html(opt.modalFormBody);

						$('#export-event, #delete-event, #edit-event, #add-event').hide();
						$('#save-changes').show().css('width', '100%');

						$('#details-body, #event-type-select').hide();
						$('#repeat-type-select, #repeat-type-selected').hide();
						$('#event-type-selected').show();
						$('#modal-form-body').show();
						$(opt.modalSelector).modal('show');

						$('#modal-form-body :input').each(function() {
							var name = $(this).attr('name');
							var tag = $(this)[0].tagName;

							switch(tag)
							{
								case "SELECT":
									var typeData = calendar.data[name];
									if(typeData !== undefined)
									{
										$('option[value="'+typeData.replace('&amp;', '&')+'"]').attr('selected', 'selected');
									}
								break;

								case "INPUT":
									var name = name.replace(/\[.*?\]/g,"");
									var typeName = $(this).attr('type');
									var typeData = calendar.data[name];

									if(typeName == 'checkbox')
									{
										if(typeData !== undefined)
										{
											var values = typeData.split(',');
											for(var i = 0; i < values.length; i++)
											{
												$('input[value="'+values[i].trim()+'"]').attr('checked', 'checked');
											}
										}
									}

									if(typeName == 'radio')
									{
										if(typeData !== undefined)
										{
											$('input[value="'+typeData+'"]').attr('checked', 'checked');
										}
									}

									if(typeName == 'file')
									{
										if(typeData !== undefined && typeData !== "undefined")
										{
											$(this).before('<p class="file-attachment"><a href="'+typeData+'">'+typeData+'</a></p>');
										}
									}

									if(typeName == 'text')
									{
										$('input[name="'+name+'"]').val(calendar.data[name]);
										$('input[name=title]').val(calendar.data['title']);
										$("#colorp").spectrum("set", calendar.data['color']);
										$('#startDate').val(startDate);
										$('input#startTime').val(startTime);
										$('#endDate').val(endDate);
										$('input#endTime').val(endTime);
									}
								break;

								case "TEXTAREA":
									var typeData = calendar.data[name];
									$('textarea[name="'+name+'"]').val(typeData);
									$('textarea[name="description"]').val( calendar.data['description_editable'] );
								break;

								default:
									$(':input[name="'+name+'"]').val(calendar.data[name]);
								break;
							}
						});

						// save action
						$('#save-changes').off().on('click', function(e) {
							if($('input[name=title]').val().length == 0)
							{
								alert(opt.emptyForm);
							} else {
								editFormData = new FormData($('#modal-form-body').get(0));
								if($('#file')[0])
								{
									editFormData.append('file', $('#file')[0].files[0]);
								}
								calendar.update(id, editFormData);
							}
							e.preventDefault();
						})

					 });

				} //-- End openModal


				// Google Calendar Open Modal
				calendar.openModalGcal = function(title, url) {
					$('#modal-form-body').hide();
					$('#details-body').show();
					$('#details-body-title').html(title);
					$('#details-body-content').html('<a target="_blank" href="'+url+'">'+opt.gcalUrlText+'</a>');
					$('#export-event, #delete-event, #edit-event').hide();
					$('#save-changes, #add-event').hide();
					$('.modal-footer').hide();
					$(opt.modalSelector).modal('show');
				} //-- End openModalGcal

				// Function to quickModal
				calendar.quickModal = function(start, end, allDay)
				{
					document.getElementById("modal-form-body").reset();
					$('#modal-form-body').html(opt.modalFormBody);

					var start_factor = moment(start).format('YYYY-MM-DD');
					var startTime_factor = moment(start).format('HH:mm');
					var end_factor = moment(end).format('YYYY-MM-DD');
					var endTime_factor = moment(end).format('HH:mm');

					var e_val = moment(end).isValid();
					if(e_val == false)
					{
						var end_factor = start_factor;
						var endTime_factor = startTime_factor;
					}

					$('#startDate').val(start_factor);
					$('#startTime').val(startTime_factor);
					$('#endDate').val(end_factor);
					$('#endTime').val(endTime_factor);

					$('#details-body').hide();

					$('#event-type-select').show();
					$('#event-type-selected').hide();

					$('#repeat-type-select').show();
					$('#repeat-type-selected').hide();

					$('#export-event, #delete-event, #edit-event, #save-changes').hide();
					$('#add-event').show().css('width', '100%');

					$('.modal-footer').show();
					$('#modal-form-body').show();

					$('#details-body-title').html(opt.newEventText);
					$(opt.modalSelector).modal('show');

					$('#event-type').on('change', function() {
						var event_type_value = $(this).val();
						if(event_type_value == 'false')
						{
							$('#event-type-select').show();
							$('#event-type-selected').show();
						} else if (event_type_value == 'true') {
							$('#event-type-select').show();
							$('#event-type-selected').hide();
						}
					})

					$('#repeat_select').on('change', function() {
						var value = $(this).val();
						if(value !== 'no')
						{
							$('#repeat-type-select').show();
							$('#repeat-type-selected').show();
						} else if (value == 'no') {
							$('#repeat-type-select').show();
							$('#repeat-type-selected').hide();
						}
					})

					// add action
					$('#add-event').off().on('click', function(e) {
						if($('input[name=title]').val().length == 0)
						{
							alert(opt.emptyForm);
						} else {
							formData = new FormData($('#modal-form-body').get(0));
							if($('#file')[0])
							{
								formData.append('file', $('#file')[0].files[0]);
							}
							calendar.quickSave(formData);
						}
						e.preventDefault();
					})

				} //-- End quickModal

				// Function quickSave
				calendar.quickSave = function(formData)
				{
					$.ajax({
						url: opt.ajaxEventQuickSave,
						data: formData,
						type: "POST",
						cache: false,
						processData: false,
						contentType: false,
						beforeSend: function() { $('.loadingDiv').show(); $('.modal-footer').hide() },
						error: function() { $('.loadingDiv').hide(); alert(opt.ajaxError); },
						success: function(res)
						{
							$('.loadingDiv').hide();
							if(res == 1)
							{
								$(opt.modalSelector).modal('hide');
								$(opt.calendarSelector).fullCalendar('refetchEvents');
							} else {
								alert(opt.failureAddEventMessage);
								$('.modal-footer').show();
							}
						}

					});
				} //-- End quickSave

				// Function to Update Event to the Database
				calendar.update = function(id, theEvent)
				{
					var construct = "id="+id;

					// First check if the event is a repetitive event
					$.ajax({
						type: "POST",
						url: opt.ajaxRepeatCheck,
						data: construct,
						cache: false,
						beforeSend: function() { $('.loadingDiv').show(); },
						error: function() { $('.loadingDiv').hide(); alert(opt.ajaxError) },
						success: function(response) {
							$('.loadingDiv').hide();
							if(response == 'REP_FOUND')
							{
								// prompt user
								$(opt.modalSelector).modal('hide');

								$(opt.modalEditPromptSelector+" .modal-header").html('<h4 class="modal-title">'+opt.eventText+calendar.title+'</h4>');
								$(opt.modalEditPromptSelector+" .modal-body-custom").css('padding', '15px').html(opt.repetitiveEventActionText);

								$(opt.modalEditPromptSelector).modal('show');

								// Action - save this
								$('[data-option="save-this"]').unbind('click').on('click', function(e)
								{
									calendar.update_this(id, theEvent);
									$(opt.modalEditPromptSelector).modal('hide');
									$(opt.modalSelector).modal('hide');
									e.preventDefault();
								 });

								// Action - save repetitives
								$('[data-option="save-repetitives"]').unbind('click').on('click', function(e)
								{
									var construct_two = 'true';

									calendar.update_this(id, theEvent, construct_two);
									$(opt.modalEditPromptSelector).modal('hide');
									$(opt.modalSelector).modal('hide');
									e.preventDefault();
								 });

							} else {
								calendar.update_this(id, theEvent);
							}
						},
						error: function(response) {
							alert(opt.generalFailureMessage);
						}
					});
				}

				// Function to update single and repetitive events
				calendar.update_this = function(id, theEvent, construct_two)
				{
					if(construct_two === undefined)
					{
						editFormData.append('id', id);
					} else {
						editFormData.append('id', id);
						editFormData.append('rep_id', calendar.rep_id);
						editFormData.append('method', 'repetitive_event');
					}

					$.ajax({
						type: "POST",
						url: opt.ajaxEventEdit,
						data: theEvent,
						cache: false,
						processData: false,
						contentType: false,
						beforeSend: function() { $('.loadingDiv').show(); },
						error: function() { $('.loadingDiv').hide(); alert(opt.ajaxError) },
						success: function(response) {
							$('.loadingDiv').hide();
							if(response == '')
							{
								$(opt.modalSelector).modal('hide');
								$(opt.calendarSelector).fullCalendar('refetchEvents');
							} else {
								alert(opt.failureUpdateEventMessage);
							}
						},
						error: function(response) {
							alert(opt.failureUpdateEventMessage);
						}
					});
				}

				// Function to Remove Event ID from the Database
				calendar.remove = function(id)
				{
					// First check if the event is a repetitive event
					var construct = 'id='+id;

					$.ajax({
						type: "POST",
						url: opt.ajaxRepeatCheck,
						data: {id: id},
						cache: false,
						beforeSend: function() { $('.loadingDiv').show(); },
						error: function() { $('.loadingDiv').hide(); alert(opt.ajaxError) },
						success: function(response)
						{
							$('.loadingDiv').hide();
							if(response == 'REP_FOUND')
							{
								// prompt user
								$(opt.modalSelector).modal('hide');

								$(opt.modalPromptSelector+" .modal-header").html('<h4 class="modal-title">'+opt.eventText+calendar.title+'</h4>');
								$(opt.modalPromptSelector+" .modal-body").html(opt.repetitiveEventActionText);

								$(opt.modalPromptSelector).modal('show');

								// Action - remove this
								$('[data-option="remove-this"]').unbind('click').on('click', function(e)
								{
									calendar.remove_this(construct);
									$(opt.modalPromptSelector).modal('hide');
									e.preventDefault();
								 });

								// Action - remove repetitive
								$('[data-option="remove-repetitives"]').unbind('click').on('click', function(e)
								{
									var construct = "id="+id+'&rep_id='+calendar.rep_id+'&method=repetitive_event';

									calendar.remove_this(construct);
									$(opt.modalPromptSelector).modal('hide');
									e.preventDefault();
								 });

							} else {
								calendar.remove_this(construct);
							}
						},
						error: function(response) {
							alert(opt.generalFailureMessage);
						}
					});
				};

				// Functo to Remove Event from the database
				calendar.remove_this = function(construct)
				{
					// just remove this
					$.ajax({
						type: "POST",
						url: opt.ajaxEventDelete,
						data: construct,
						cache: false,
						beforeSend: function() { $('.loadingDiv').show(); },
						error: function() { $('.loadingDiv').hide(); alert(opt.ajaxError) },
						success: function(response)
						{
							$('.loadingDiv').hide();
							if(response == '')
							{
								$(opt.modalSelector).modal('hide');
								$(opt.calendarSelector).fullCalendar('refetchEvents');
							} else {
								alert(opt.failureDeleteEventMessage);
							}
						}
					});
				}

				// Function to Export Calendar
				calendar.exportIcal = function(expID, expTitle, expDescription, expStart, expEnd)
				{
					var start_factor = expStart;
					var end_factor = expEnd;

					var construct = '&method=export&id='+encodeURIComponent(expID)+'&title='+encodeURIComponent(expTitle)+'&description='+encodeURIComponent(expDescription)+'&start_date='+encodeURIComponent(start_factor)+'&end_date='+encodeURIComponent(end_factor);

					window.location = opt.ajaxEventExport+construct;

				} // -- End export Calendar

				// Import
				calendar.calendarImport = function()
				{
					txt = 'import='+encodeURIComponent($('#import_content').val());
					$.post(opt.ajaxImport, txt, function(response)
					{
						alert(response);
						$(opt.calendarSelector).fullCalendar('refetchEvents');
						$('#cal_import').modal('hide');
						$('#import_content').val('');
					});
				} // -- End Import Calendar

				// Remove Obj Prop
				calendar.removeObjProp = function(obj, props)
				{
					for(var i = 0; i < props.length; i++) {
						if(obj.hasOwnProperty(props[i])) {
							delete obj[props[i]];
						}
					}
				};
				// -- End Remove of Obj Prop

			// Fiter
			if(opt.filter == true)
			{
				$(opt.formFilterSelector).on('change', function(e)
				{
					 selected_value = $(this).val();

					 construct = 'filter='+encodeURIComponent(selected_value);

					 $.post('includes/loader.php', construct, function(response)
					{
						$(opt.calendarSelector).fullCalendar('refetchEvents');
					});

					 e.preventDefault();
				});

			// Search Form
			// keypress
			$(opt.formSearchSelector).keypress(function(e)
			{
				if(e.which == 13)
				{
					search_me();
					e.preventDefault();
				}
			});

			// submit button
			$(opt.formSearchSelector+' button').on('click', function(e)
			{
				search_me();
			});

			function search_me()
			{
				 value = $(opt.formSearchSelector+' input').val();

				 construct = 'search='+encodeURIComponent(value);

				 $.post('includes/loader.php', construct, function(response)
				{
					$(opt.calendarSelector).fullCalendar('refetchEvents');
				});
			}

		 } // filter check

		 function JSONfindKeyByValue(json, searchVal)
		 {
			 var foundKey = '';
			 for (var key in json)
			 {
				 if (json.hasOwnProperty(key))
				 {
					 var filteredJson = json[key].fields;
					 for (var finalKey in filteredJson)
					 {
						 if(filteredJson.hasOwnProperty(finalKey))
						 {
							 Object.keys(filteredJson).forEach(function(key) {
								 if(filteredJson[key].includes(searchVal))
								 {
									 foundKey = key;
								 } else {
									 return false;
								 }
							 });
						 }
					 }
				 }
			 }
			 return foundKey;
		 }


		} // FullCalendar Ext

	}); // fn

})(jQuery);

// define object at end of plugin to fix ie bug
var calendar = {};

// Spectrum Colorpicker v1.8.0
// https://github.com/bgrins/spectrum
// Author: Brian Grinstead
// License: MIT

(function (factory) {
    "use strict";

    if (typeof define === 'function' && define.amd) { // AMD
        define(['jquery'], factory);
    }
    else if (typeof exports == "object" && typeof module == "object") { // CommonJS
        module.exports = factory(require('jquery'));
    }
    else { // Browser
        factory(jQuery);
    }
})(function($, undefined) {
    "use strict";

    var defaultOpts = {

        // Callbacks
        beforeShow: noop,
        move: noop,
        change: noop,
        show: noop,
        hide: noop,

        // Options
        color: false,
        flat: false,
        showInput: false,
        allowEmpty: false,
        showButtons: true,
        clickoutFiresChange: true,
        showInitial: false,
        showPalette: false,
        showPaletteOnly: false,
        hideAfterPaletteSelect: false,
        togglePaletteOnly: false,
        showSelectionPalette: true,
        localStorageKey: false,
        appendTo: "body",
        maxSelectionSize: 7,
        cancelText: "cancel",
        chooseText: "choose",
        togglePaletteMoreText: "more",
        togglePaletteLessText: "less",
        clearText: "Clear Color Selection",
        noColorSelectedText: "No Color Selected",
        preferredFormat: false,
        className: "", // Deprecated - use containerClassName and replacerClassName instead.
        containerClassName: "",
        replacerClassName: "",
        showAlpha: false,
        theme: "sp-light",
        palette: [["#ffffff", "#000000", "#ff0000", "#ff8000", "#ffff00", "#008000", "#0000ff", "#4b0082", "#9400d3"]],
        selectionPalette: [],
        disabled: false,
        offset: null
    },
    spectrums = [],
    IE = !!/msie/i.exec( window.navigator.userAgent ),
    rgbaSupport = (function() {
        function contains( str, substr ) {
            return !!~('' + str).indexOf(substr);
        }

        var elem = document.createElement('div');
        var style = elem.style;
        style.cssText = 'background-color:rgba(0,0,0,.5)';
        return contains(style.backgroundColor, 'rgba') || contains(style.backgroundColor, 'hsla');
    })(),
    replaceInput = [
        "<div class='sp-replacer'>",
            "<div class='sp-preview'><div class='sp-preview-inner'></div></div>",
            "<div class='sp-dd'>&#9660;</div>",
        "</div>"
    ].join(''),
    markup = (function () {

        // IE does not support gradients with multiple stops, so we need to simulate
        //  that for the rainbow slider with 8 divs that each have a single gradient
        var gradientFix = "";
        if (IE) {
            for (var i = 1; i <= 6; i++) {
                gradientFix += "<div class='sp-" + i + "'></div>";
            }
        }

        return [
            "<div class='sp-container sp-hidden'>",
                "<div class='sp-palette-container'>",
                    "<div class='sp-palette sp-thumb sp-cf'></div>",
                    "<div class='sp-palette-button-container sp-cf'>",
                        "<button type='button' class='sp-palette-toggle'></button>",
                    "</div>",
                "</div>",
                "<div class='sp-picker-container'>",
                    "<div class='sp-top sp-cf'>",
                        "<div class='sp-fill'></div>",
                        "<div class='sp-top-inner'>",
                            "<div class='sp-color'>",
                                "<div class='sp-sat'>",
                                    "<div class='sp-val'>",
                                        "<div class='sp-dragger'></div>",
                                    "</div>",
                                "</div>",
                            "</div>",
                            "<div class='sp-clear sp-clear-display'>",
                            "</div>",
                            "<div class='sp-hue'>",
                                "<div class='sp-slider'></div>",
                                gradientFix,
                            "</div>",
                        "</div>",
                        "<div class='sp-alpha'><div class='sp-alpha-inner'><div class='sp-alpha-handle'></div></div></div>",
                    "</div>",
                    "<div class='sp-input-container sp-cf'>",
                        "<input class='sp-input' type='text' spellcheck='false'  />",
                    "</div>",
                    "<div class='sp-initial sp-thumb sp-cf'></div>",
                    "<div class='sp-button-container sp-cf'>",
                        "<a class='sp-cancel' href='#'></a>",
                        "<button type='button' class='sp-choose'></button>",
                    "</div>",
                "</div>",
            "</div>"
        ].join("");
    })();

    function paletteTemplate (p, color, className, opts) {
        var html = [];
        for (var i = 0; i < p.length; i++) {
            var current = p[i];
            if(current) {
                var tiny = tinycolor(current);
                var c = tiny.toHsl().l < 0.5 ? "sp-thumb-el sp-thumb-dark" : "sp-thumb-el sp-thumb-light";
                c += (tinycolor.equals(color, current)) ? " sp-thumb-active" : "";
                var formattedString = tiny.toString(opts.preferredFormat || "rgb");
                var swatchStyle = rgbaSupport ? ("background-color:" + tiny.toRgbString()) : "filter:" + tiny.toFilter();
                html.push('<span title="' + formattedString + '" data-color="' + tiny.toRgbString() + '" class="' + c + '"><span class="sp-thumb-inner" style="' + swatchStyle + ';" /></span>');
            } else {
                var cls = 'sp-clear-display';
                html.push($('<div />')
                    .append($('<span data-color="" style="background-color:transparent;" class="' + cls + '"></span>')
                        .attr('title', opts.noColorSelectedText)
                    )
                    .html()
                );
            }
        }
        return "<div class='sp-cf " + className + "'>" + html.join('') + "</div>";
    }

    function hideAll() {
        for (var i = 0; i < spectrums.length; i++) {
            if (spectrums[i]) {
                spectrums[i].hide();
            }
        }
    }

    function instanceOptions(o, callbackContext) {
        var opts = $.extend({}, defaultOpts, o);
        opts.callbacks = {
            'move': bind(opts.move, callbackContext),
            'change': bind(opts.change, callbackContext),
            'show': bind(opts.show, callbackContext),
            'hide': bind(opts.hide, callbackContext),
            'beforeShow': bind(opts.beforeShow, callbackContext)
        };

        return opts;
    }

    function spectrum(element, o) {

        var opts = instanceOptions(o, element),
            flat = opts.flat,
            showSelectionPalette = opts.showSelectionPalette,
            localStorageKey = opts.localStorageKey,
            theme = opts.theme,
            callbacks = opts.callbacks,
            resize = throttle(reflow, 10),
            visible = false,
            isDragging = false,
            dragWidth = 0,
            dragHeight = 0,
            dragHelperHeight = 0,
            slideHeight = 0,
            slideWidth = 0,
            alphaWidth = 0,
            alphaSlideHelperWidth = 0,
            slideHelperHeight = 0,
            currentHue = 0,
            currentSaturation = 0,
            currentValue = 0,
            currentAlpha = 1,
            palette = [],
            paletteArray = [],
            paletteLookup = {},
            selectionPalette = opts.selectionPalette.slice(0),
            maxSelectionSize = opts.maxSelectionSize,
            draggingClass = "sp-dragging",
            shiftMovementDirection = null;

        var doc = element.ownerDocument,
            body = doc.body,
            boundElement = $(element),
            disabled = false,
            container = $(markup, doc).addClass(theme),
            pickerContainer = container.find(".sp-picker-container"),
            dragger = container.find(".sp-color"),
            dragHelper = container.find(".sp-dragger"),
            slider = container.find(".sp-hue"),
            slideHelper = container.find(".sp-slider"),
            alphaSliderInner = container.find(".sp-alpha-inner"),
            alphaSlider = container.find(".sp-alpha"),
            alphaSlideHelper = container.find(".sp-alpha-handle"),
            textInput = container.find(".sp-input"),
            paletteContainer = container.find(".sp-palette"),
            initialColorContainer = container.find(".sp-initial"),
            cancelButton = container.find(".sp-cancel"),
            clearButton = container.find(".sp-clear"),
            chooseButton = container.find(".sp-choose"),
            toggleButton = container.find(".sp-palette-toggle"),
            isInput = boundElement.is("input"),
            isInputTypeColor = isInput && boundElement.attr("type") === "color" && inputTypeColorSupport(),
            shouldReplace = isInput && !flat,
            replacer = (shouldReplace) ? $(replaceInput).addClass(theme).addClass(opts.className).addClass(opts.replacerClassName) : $([]),
            offsetElement = (shouldReplace) ? replacer : boundElement,
            previewElement = replacer.find(".sp-preview-inner"),
            initialColor = opts.color || (isInput && boundElement.val()),
            colorOnShow = false,
            currentPreferredFormat = opts.preferredFormat,
            clickoutFiresChange = !opts.showButtons || opts.clickoutFiresChange,
            isEmpty = !initialColor,
            allowEmpty = opts.allowEmpty && !isInputTypeColor;

        function applyOptions() {

            if (opts.showPaletteOnly) {
                opts.showPalette = true;
            }

            toggleButton.text(opts.showPaletteOnly ? opts.togglePaletteMoreText : opts.togglePaletteLessText);

            if (opts.palette) {
                palette = opts.palette.slice(0);
                paletteArray = $.isArray(palette[0]) ? palette : [palette];
                paletteLookup = {};
                for (var i = 0; i < paletteArray.length; i++) {
                    for (var j = 0; j < paletteArray[i].length; j++) {
                        var rgb = tinycolor(paletteArray[i][j]).toRgbString();
                        paletteLookup[rgb] = true;
                    }
                }
            }

            container.toggleClass("sp-flat", flat);
            container.toggleClass("sp-input-disabled", !opts.showInput);
            container.toggleClass("sp-alpha-enabled", opts.showAlpha);
            container.toggleClass("sp-clear-enabled", allowEmpty);
            container.toggleClass("sp-buttons-disabled", !opts.showButtons);
            container.toggleClass("sp-palette-buttons-disabled", !opts.togglePaletteOnly);
            container.toggleClass("sp-palette-disabled", !opts.showPalette);
            container.toggleClass("sp-palette-only", opts.showPaletteOnly);
            container.toggleClass("sp-initial-disabled", !opts.showInitial);
            container.addClass(opts.className).addClass(opts.containerClassName);

            reflow();
        }

        function initialize() {

            if (IE) {
                container.find("*:not(input)").attr("unselectable", "on");
            }

            applyOptions();

            if (shouldReplace) {
                boundElement.after(replacer).hide();
            }

            if (!allowEmpty) {
                clearButton.hide();
            }

            if (flat) {
                boundElement.after(container).hide();
            }
            else {

                var appendTo = opts.appendTo === "parent" ? boundElement.parent() : $(opts.appendTo);
                if (appendTo.length !== 1) {
                    appendTo = $("body");
                }

                appendTo.append(container);
            }

            updateSelectionPaletteFromStorage();

            offsetElement.bind("click.spectrum touchstart.spectrum", function (e) {
                if (!disabled) {
                    toggle();
                }

                e.stopPropagation();

                if (!$(e.target).is("input")) {
                    e.preventDefault();
                }
            });

            if(boundElement.is(":disabled") || (opts.disabled === true)) {
                disable();
            }

            // Prevent clicks from bubbling up to document.  This would cause it to be hidden.
            container.click(stopPropagation);

            // Handle user typed input
            textInput.change(setFromTextInput);
            textInput.bind("paste", function () {
                setTimeout(setFromTextInput, 1);
            });
            textInput.keydown(function (e) { if (e.keyCode == 13) { setFromTextInput(); } });

            cancelButton.text(opts.cancelText);
            cancelButton.bind("click.spectrum", function (e) {
                e.stopPropagation();
                e.preventDefault();
                revert();
                hide();
            });

            clearButton.attr("title", opts.clearText);
            clearButton.bind("click.spectrum", function (e) {
                e.stopPropagation();
                e.preventDefault();
                isEmpty = true;
                move();

                if(flat) {
                    //for the flat style, this is a change event
                    updateOriginalInput(true);
                }
            });

            chooseButton.text(opts.chooseText);
            chooseButton.bind("click.spectrum", function (e) {
                e.stopPropagation();
                e.preventDefault();

                if (IE && textInput.is(":focus")) {
                    textInput.trigger('change');
                }

                if (isValid()) {
                    updateOriginalInput(true);
                    hide();
                }
            });

            toggleButton.text(opts.showPaletteOnly ? opts.togglePaletteMoreText : opts.togglePaletteLessText);
            toggleButton.bind("click.spectrum", function (e) {
                e.stopPropagation();
                e.preventDefault();

                opts.showPaletteOnly = !opts.showPaletteOnly;

                // To make sure the Picker area is drawn on the right, next to the
                // Palette area (and not below the palette), first move the Palette
                // to the left to make space for the picker, plus 5px extra.
                // The 'applyOptions' function puts the whole container back into place
                // and takes care of the button-text and the sp-palette-only CSS class.
                if (!opts.showPaletteOnly && !flat) {
                    container.css('left', '-=' + (pickerContainer.outerWidth(true) + 5));
                }
                applyOptions();
            });

            draggable(alphaSlider, function (dragX, dragY, e) {
                currentAlpha = (dragX / alphaWidth);
                isEmpty = false;
                if (e.shiftKey) {
                    currentAlpha = Math.round(currentAlpha * 10) / 10;
                }

                move();
            }, dragStart, dragStop);

            draggable(slider, function (dragX, dragY) {
                currentHue = parseFloat(dragY / slideHeight);
                isEmpty = false;
                if (!opts.showAlpha) {
                    currentAlpha = 1;
                }
                move();
            }, dragStart, dragStop);

            draggable(dragger, function (dragX, dragY, e) {

                // shift+drag should snap the movement to either the x or y axis.
                if (!e.shiftKey) {
                    shiftMovementDirection = null;
                }
                else if (!shiftMovementDirection) {
                    var oldDragX = currentSaturation * dragWidth;
                    var oldDragY = dragHeight - (currentValue * dragHeight);
                    var furtherFromX = Math.abs(dragX - oldDragX) > Math.abs(dragY - oldDragY);

                    shiftMovementDirection = furtherFromX ? "x" : "y";
                }

                var setSaturation = !shiftMovementDirection || shiftMovementDirection === "x";
                var setValue = !shiftMovementDirection || shiftMovementDirection === "y";

                if (setSaturation) {
                    currentSaturation = parseFloat(dragX / dragWidth);
                }
                if (setValue) {
                    currentValue = parseFloat((dragHeight - dragY) / dragHeight);
                }

                isEmpty = false;
                if (!opts.showAlpha) {
                    currentAlpha = 1;
                }

                move();

            }, dragStart, dragStop);

            if (!!initialColor) {
                set(initialColor);

                // In case color was black - update the preview UI and set the format
                // since the set function will not run (default color is black).
                updateUI();
                currentPreferredFormat = opts.preferredFormat || tinycolor(initialColor).format;

                addColorToSelectionPalette(initialColor);
            }
            else {
                updateUI();
            }

            if (flat) {
                show();
            }

            function paletteElementClick(e) {
                if (e.data && e.data.ignore) {
                    set($(e.target).closest(".sp-thumb-el").data("color"));
                    move();
                }
                else {
                    set($(e.target).closest(".sp-thumb-el").data("color"));
                    move();
                    updateOriginalInput(true);
                    if (opts.hideAfterPaletteSelect) {
                      hide();
                    }
                }

                return false;
            }

            var paletteEvent = IE ? "mousedown.spectrum" : "click.spectrum touchstart.spectrum";
            paletteContainer.delegate(".sp-thumb-el", paletteEvent, paletteElementClick);
            initialColorContainer.delegate(".sp-thumb-el:nth-child(1)", paletteEvent, { ignore: true }, paletteElementClick);
        }

        function updateSelectionPaletteFromStorage() {

            if (localStorageKey && window.localStorage) {

                // Migrate old palettes over to new format.  May want to remove this eventually.
                try {
                    var oldPalette = window.localStorage[localStorageKey].split(",#");
                    if (oldPalette.length > 1) {
                        delete window.localStorage[localStorageKey];
                        $.each(oldPalette, function(i, c) {
                             addColorToSelectionPalette(c);
                        });
                    }
                }
                catch(e) { }

                try {
                    selectionPalette = window.localStorage[localStorageKey].split(";");
                }
                catch (e) { }
            }
        }

        function addColorToSelectionPalette(color) {
            if (showSelectionPalette) {
                var rgb = tinycolor(color).toRgbString();
                if (!paletteLookup[rgb] && $.inArray(rgb, selectionPalette) === -1) {
                    selectionPalette.push(rgb);
                    while(selectionPalette.length > maxSelectionSize) {
                        selectionPalette.shift();
                    }
                }

                if (localStorageKey && window.localStorage) {
                    try {
                        window.localStorage[localStorageKey] = selectionPalette.join(";");
                    }
                    catch(e) { }
                }
            }
        }

        function getUniqueSelectionPalette() {
            var unique = [];
            if (opts.showPalette) {
                for (var i = 0; i < selectionPalette.length; i++) {
                    var rgb = tinycolor(selectionPalette[i]).toRgbString();

                    if (!paletteLookup[rgb]) {
                        unique.push(selectionPalette[i]);
                    }
                }
            }

            return unique.reverse().slice(0, opts.maxSelectionSize);
        }

        function drawPalette() {

            var currentColor = get();

            var html = $.map(paletteArray, function (palette, i) {
                return paletteTemplate(palette, currentColor, "sp-palette-row sp-palette-row-" + i, opts);
            });

            updateSelectionPaletteFromStorage();

            if (selectionPalette) {
                html.push(paletteTemplate(getUniqueSelectionPalette(), currentColor, "sp-palette-row sp-palette-row-selection", opts));
            }

            paletteContainer.html(html.join(""));
        }

        function drawInitial() {
            if (opts.showInitial) {
                var initial = colorOnShow;
                var current = get();
                initialColorContainer.html(paletteTemplate([initial, current], current, "sp-palette-row-initial", opts));
            }
        }

        function dragStart() {
            if (dragHeight <= 0 || dragWidth <= 0 || slideHeight <= 0) {
                reflow();
            }
            isDragging = true;
            container.addClass(draggingClass);
            shiftMovementDirection = null;
            boundElement.trigger('dragstart.spectrum', [ get() ]);
        }

        function dragStop() {
            isDragging = false;
            container.removeClass(draggingClass);
            boundElement.trigger('dragstop.spectrum', [ get() ]);
        }

        function setFromTextInput() {

            var value = textInput.val();

            if ((value === null || value === "") && allowEmpty) {
                set(null);
                updateOriginalInput(true);
            }
            else {
                var tiny = tinycolor(value);
                if (tiny.isValid()) {
                    set(tiny);
                    updateOriginalInput(true);
                }
                else {
                    textInput.addClass("sp-validation-error");
                }
            }
        }

        function toggle() {
            if (visible) {
                hide();
            }
            else {
                show();
            }
        }

        function show() {
            var event = $.Event('beforeShow.spectrum');

            if (visible) {
                reflow();
                return;
            }

            boundElement.trigger(event, [ get() ]);

            if (callbacks.beforeShow(get()) === false || event.isDefaultPrevented()) {
                return;
            }

            hideAll();
            visible = true;

            $(doc).bind("keydown.spectrum", onkeydown);
            $(doc).bind("click.spectrum", clickout);
            $(window).bind("resize.spectrum", resize);
            replacer.addClass("sp-active");
            container.removeClass("sp-hidden");

            reflow();
            updateUI();

            colorOnShow = get();

            drawInitial();
            callbacks.show(colorOnShow);
            boundElement.trigger('show.spectrum', [ colorOnShow ]);
        }

        function onkeydown(e) {
            // Close on ESC
            if (e.keyCode === 27) {
                hide();
            }
        }

        function clickout(e) {
            // Return on right click.
            if (e.button == 2) { return; }

            // If a drag event was happening during the mouseup, don't hide
            // on click.
            if (isDragging) { return; }

            if (clickoutFiresChange) {
                updateOriginalInput(true);
            }
            else {
                revert();
            }
            hide();
        }

        function hide() {
            // Return if hiding is unnecessary
            if (!visible || flat) { return; }
            visible = false;

            $(doc).unbind("keydown.spectrum", onkeydown);
            $(doc).unbind("click.spectrum", clickout);
            $(window).unbind("resize.spectrum", resize);

            replacer.removeClass("sp-active");
            container.addClass("sp-hidden");

            callbacks.hide(get());
            boundElement.trigger('hide.spectrum', [ get() ]);
        }

        function revert() {
            set(colorOnShow, true);
        }

        function set(color, ignoreFormatChange) {
            if (tinycolor.equals(color, get())) {
                // Update UI just in case a validation error needs
                // to be cleared.
                updateUI();
                return;
            }

            var newColor, newHsv;
            if (!color && allowEmpty) {
                isEmpty = true;
            } else {
                isEmpty = false;
                newColor = tinycolor(color);
                newHsv = newColor.toHsv();

                currentHue = (newHsv.h % 360) / 360;
                currentSaturation = newHsv.s;
                currentValue = newHsv.v;
                currentAlpha = newHsv.a;
            }
            updateUI();

            if (newColor && newColor.isValid() && !ignoreFormatChange) {
                currentPreferredFormat = opts.preferredFormat || newColor.getFormat();
            }
        }

        function get(opts) {
            opts = opts || { };

            if (allowEmpty && isEmpty) {
                return null;
            }

            return tinycolor.fromRatio({
                h: currentHue,
                s: currentSaturation,
                v: currentValue,
                a: Math.round(currentAlpha * 100) / 100
            }, { format: opts.format || currentPreferredFormat });
        }

        function isValid() {
            return !textInput.hasClass("sp-validation-error");
        }

        function move() {
            updateUI();

            callbacks.move(get());
            boundElement.trigger('move.spectrum', [ get() ]);
        }

        function updateUI() {

            textInput.removeClass("sp-validation-error");

            updateHelperLocations();

            // Update dragger background color (gradients take care of saturation and value).
            var flatColor = tinycolor.fromRatio({ h: currentHue, s: 1, v: 1 });
            dragger.css("background-color", flatColor.toHexString());

            // Get a format that alpha will be included in (hex and names ignore alpha)
            var format = currentPreferredFormat;
            if (currentAlpha < 1 && !(currentAlpha === 0 && format === "name")) {
                if (format === "hex" || format === "hex3" || format === "hex6" || format === "name") {
                    format = "rgb";
                }
            }

            var realColor = get({ format: format }),
                displayColor = '';

             //reset background info for preview element
            previewElement.removeClass("sp-clear-display");
            previewElement.css('background-color', 'transparent');

            if (!realColor && allowEmpty) {
                // Update the replaced elements background with icon indicating no color selection
                previewElement.addClass("sp-clear-display");
            }
            else {
                var realHex = realColor.toHexString(),
                    realRgb = realColor.toRgbString();

                // Update the replaced elements background color (with actual selected color)
                if (rgbaSupport || realColor.alpha === 1) {
                    previewElement.css("background-color", realRgb);
                }
                else {
                    previewElement.css("background-color", "transparent");
                    previewElement.css("filter", realColor.toFilter());
                }

                if (opts.showAlpha) {
                    var rgb = realColor.toRgb();
                    rgb.a = 0;
                    var realAlpha = tinycolor(rgb).toRgbString();
                    var gradient = "linear-gradient(left, " + realAlpha + ", " + realHex + ")";

                    if (IE) {
                        alphaSliderInner.css("filter", tinycolor(realAlpha).toFilter({ gradientType: 1 }, realHex));
                    }
                    else {
                        alphaSliderInner.css("background", "-webkit-" + gradient);
                        alphaSliderInner.css("background", "-moz-" + gradient);
                        alphaSliderInner.css("background", "-ms-" + gradient);
                        // Use current syntax gradient on unprefixed property.
                        alphaSliderInner.css("background",
                            "linear-gradient(to right, " + realAlpha + ", " + realHex + ")");
                    }
                }

                displayColor = realColor.toString(format);
            }

            // Update the text entry input as it changes happen
            if (opts.showInput) {
                textInput.val(displayColor);
            }

            if (opts.showPalette) {
                drawPalette();
            }

            drawInitial();
        }

        function updateHelperLocations() {
            var s = currentSaturation;
            var v = currentValue;

            if(allowEmpty && isEmpty) {
                //if selected color is empty, hide the helpers
                alphaSlideHelper.hide();
                slideHelper.hide();
                dragHelper.hide();
            }
            else {
                //make sure helpers are visible
                alphaSlideHelper.show();
                slideHelper.show();
                dragHelper.show();

                // Where to show the little circle in that displays your current selected color
                var dragX = s * dragWidth;
                var dragY = dragHeight - (v * dragHeight);
                dragX = Math.max(
                    -dragHelperHeight,
                    Math.min(dragWidth - dragHelperHeight, dragX - dragHelperHeight)
                );
                dragY = Math.max(
                    -dragHelperHeight,
                    Math.min(dragHeight - dragHelperHeight, dragY - dragHelperHeight)
                );
                dragHelper.css({
                    "top": dragY + "px",
                    "left": dragX + "px"
                });

                var alphaX = currentAlpha * alphaWidth;
                alphaSlideHelper.css({
                    "left": (alphaX - (alphaSlideHelperWidth / 2)) + "px"
                });

                // Where to show the bar that displays your current selected hue
                var slideY = (currentHue) * slideHeight;
                slideHelper.css({
                    "top": (slideY - slideHelperHeight) + "px"
                });
            }
        }

        function updateOriginalInput(fireCallback) {
            var color = get(),
                displayColor = '',
                hasChanged = !tinycolor.equals(color, colorOnShow);

            if (color) {
                displayColor = color.toString(currentPreferredFormat);
                // Update the selection palette with the current color
                addColorToSelectionPalette(color);
            }

            if (isInput) {
                boundElement.val(displayColor);
            }

            if (fireCallback && hasChanged) {
                callbacks.change(color);
                boundElement.trigger('change', [ color ]);
            }
        }

        function reflow() {
            if (!visible) {
                return; // Calculations would be useless and wouldn't be reliable anyways
            }
            dragWidth = dragger.width();
            dragHeight = dragger.height();
            dragHelperHeight = dragHelper.height();
            slideWidth = slider.width();
            slideHeight = slider.height();
            slideHelperHeight = slideHelper.height();
            alphaWidth = alphaSlider.width();
            alphaSlideHelperWidth = alphaSlideHelper.width();

            if (!flat) {
                container.css("position", "absolute");
                if (opts.offset) {
                    container.offset(opts.offset);
                } else {
                    container.offset(getOffset(container, offsetElement));
                }
            }

            updateHelperLocations();

            if (opts.showPalette) {
                drawPalette();
            }

            boundElement.trigger('reflow.spectrum');
        }

        function destroy() {
            boundElement.show();
            offsetElement.unbind("click.spectrum touchstart.spectrum");
            container.remove();
            replacer.remove();
            spectrums[spect.id] = null;
        }

        function option(optionName, optionValue) {
            if (optionName === undefined) {
                return $.extend({}, opts);
            }
            if (optionValue === undefined) {
                return opts[optionName];
            }

            opts[optionName] = optionValue;

            if (optionName === "preferredFormat") {
                currentPreferredFormat = opts.preferredFormat;
            }
            applyOptions();
        }

        function enable() {
            disabled = false;
            boundElement.attr("disabled", false);
            offsetElement.removeClass("sp-disabled");
        }

        function disable() {
            hide();
            disabled = true;
            boundElement.attr("disabled", true);
            offsetElement.addClass("sp-disabled");
        }

        function setOffset(coord) {
            opts.offset = coord;
            reflow();
        }

        initialize();

        var spect = {
            show: show,
            hide: hide,
            toggle: toggle,
            reflow: reflow,
            option: option,
            enable: enable,
            disable: disable,
            offset: setOffset,
            set: function (c) {
                set(c);
                updateOriginalInput();
            },
            get: get,
            destroy: destroy,
            container: container
        };

        spect.id = spectrums.push(spect) - 1;

        return spect;
    }

    /**
    * checkOffset - get the offset below/above and left/right element depending on screen position
    * Thanks https://github.com/jquery/jquery-ui/blob/master/ui/jquery.ui.datepicker.js
    */
    function getOffset(picker, input) {
        var extraY = 0;
        var dpWidth = picker.outerWidth();
        var dpHeight = picker.outerHeight();
        var inputHeight = input.outerHeight();
        var doc = picker[0].ownerDocument;
        var docElem = doc.documentElement;
        var viewWidth = docElem.clientWidth + $(doc).scrollLeft();
        var viewHeight = docElem.clientHeight + $(doc).scrollTop();
        var offset = input.offset();
        offset.top += inputHeight;

        offset.left -=
            Math.min(offset.left, (offset.left + dpWidth > viewWidth && viewWidth > dpWidth) ?
            Math.abs(offset.left + dpWidth - viewWidth) : 0);

        offset.top -=
            Math.min(offset.top, ((offset.top + dpHeight > viewHeight && viewHeight > dpHeight) ?
            Math.abs(dpHeight + inputHeight - extraY) : extraY));

        return offset;
    }

    /**
    * noop - do nothing
    */
    function noop() {

    }

    /**
    * stopPropagation - makes the code only doing this a little easier to read in line
    */
    function stopPropagation(e) {
        e.stopPropagation();
    }

    /**
    * Create a function bound to a given object
    * Thanks to underscore.js
    */
    function bind(func, obj) {
        var slice = Array.prototype.slice;
        var args = slice.call(arguments, 2);
        return function () {
            return func.apply(obj, args.concat(slice.call(arguments)));
        };
    }

    /**
    * Lightweight drag helper.  Handles containment within the element, so that
    * when dragging, the x is within [0,element.width] and y is within [0,element.height]
    */
    function draggable(element, onmove, onstart, onstop) {
        onmove = onmove || function () { };
        onstart = onstart || function () { };
        onstop = onstop || function () { };
        var doc = document;
        var dragging = false;
        var offset = {};
        var maxHeight = 0;
        var maxWidth = 0;
        var hasTouch = ('ontouchstart' in window);

        var duringDragEvents = {};
        duringDragEvents["selectstart"] = prevent;
        duringDragEvents["dragstart"] = prevent;
        duringDragEvents["touchmove mousemove"] = move;
        duringDragEvents["touchend mouseup"] = stop;

        function prevent(e) {
            if (e.stopPropagation) {
                e.stopPropagation();
            }
            if (e.preventDefault) {
                e.preventDefault();
            }
            e.returnValue = false;
        }

        function move(e) {
            if (dragging) {
                // Mouseup happened outside of window
                if (IE && doc.documentMode < 9 && !e.button) {
                    return stop();
                }

                var t0 = e.originalEvent && e.originalEvent.touches && e.originalEvent.touches[0];
                var pageX = t0 && t0.pageX || e.pageX;
                var pageY = t0 && t0.pageY || e.pageY;

                var dragX = Math.max(0, Math.min(pageX - offset.left, maxWidth));
                var dragY = Math.max(0, Math.min(pageY - offset.top, maxHeight));

                if (hasTouch) {
                    // Stop scrolling in iOS
                    prevent(e);
                }

                onmove.apply(element, [dragX, dragY, e]);
            }
        }

        function start(e) {
            var rightclick = (e.which) ? (e.which == 3) : (e.button == 2);

            if (!rightclick && !dragging) {
                if (onstart.apply(element, arguments) !== false) {
                    dragging = true;
                    maxHeight = $(element).height();
                    maxWidth = $(element).width();
                    offset = $(element).offset();

                    $(doc).bind(duringDragEvents);
                    $(doc.body).addClass("sp-dragging");

                    move(e);

                    prevent(e);
                }
            }
        }

        function stop() {
            if (dragging) {
                $(doc).unbind(duringDragEvents);
                $(doc.body).removeClass("sp-dragging");

                // Wait a tick before notifying observers to allow the click event
                // to fire in Chrome.
                setTimeout(function() {
                    onstop.apply(element, arguments);
                }, 0);
            }
            dragging = false;
        }

        $(element).bind("touchstart mousedown", start);
    }

    function throttle(func, wait, debounce) {
        var timeout;
        return function () {
            var context = this, args = arguments;
            var throttler = function () {
                timeout = null;
                func.apply(context, args);
            };
            if (debounce) clearTimeout(timeout);
            if (debounce || !timeout) timeout = setTimeout(throttler, wait);
        };
    }

    function inputTypeColorSupport() {
        return $.fn.spectrum.inputTypeColorSupport();
    }

    /**
    * Define a jQuery plugin
    */
    var dataID = "spectrum.id";
    $.fn.spectrum = function (opts, extra) {

        if (typeof opts == "string") {

            var returnValue = this;
            var args = Array.prototype.slice.call( arguments, 1 );

            this.each(function () {
                var spect = spectrums[$(this).data(dataID)];
                if (spect) {
                    var method = spect[opts];
                    if (!method) {
                        throw new Error( "Spectrum: no such method: '" + opts + "'" );
                    }

                    if (opts == "get") {
                        returnValue = spect.get();
                    }
                    else if (opts == "container") {
                        returnValue = spect.container;
                    }
                    else if (opts == "option") {
                        returnValue = spect.option.apply(spect, args);
                    }
                    else if (opts == "destroy") {
                        spect.destroy();
                        $(this).removeData(dataID);
                    }
                    else {
                        method.apply(spect, args);
                    }
                }
            });

            return returnValue;
        }

        // Initializing a new instance of spectrum
        return this.spectrum("destroy").each(function () {
            var options = $.extend({}, opts, $(this).data());
            var spect = spectrum(this, options);
            $(this).data(dataID, spect.id);
        });
    };

    $.fn.spectrum.load = true;
    $.fn.spectrum.loadOpts = {};
    $.fn.spectrum.draggable = draggable;
    $.fn.spectrum.defaults = defaultOpts;
    $.fn.spectrum.inputTypeColorSupport = function inputTypeColorSupport() {
        if (typeof inputTypeColorSupport._cachedResult === "undefined") {
            var colorInput = $("<input type='color'/>")[0]; // if color element is supported, value will default to not null
            inputTypeColorSupport._cachedResult = colorInput.type === "color" && colorInput.value !== "";
        }
        return inputTypeColorSupport._cachedResult;
    };

    $.spectrum = { };
    $.spectrum.localization = { };
    $.spectrum.palettes = { };

    $.fn.spectrum.processNativeColorInputs = function () {
        var colorInputs = $("input[type=color]");
        if (colorInputs.length && !inputTypeColorSupport()) {
            colorInputs.spectrum({
                preferredFormat: "hex6"
            });
        }
    };

    // TinyColor v1.1.2
    // https://github.com/bgrins/TinyColor
    // Brian Grinstead, MIT License

    (function() {

    var trimLeft = /^[\s,#]+/,
        trimRight = /\s+$/,
        tinyCounter = 0,
        math = Math,
        mathRound = math.round,
        mathMin = math.min,
        mathMax = math.max,
        mathRandom = math.random;

    var tinycolor = function(color, opts) {

        color = (color) ? color : '';
        opts = opts || { };

        // If input is already a tinycolor, return itself
        if (color instanceof tinycolor) {
           return color;
        }
        // If we are called as a function, call using new instead
        if (!(this instanceof tinycolor)) {
            return new tinycolor(color, opts);
        }

        var rgb = inputToRGB(color);
        this._originalInput = color,
        this._r = rgb.r,
        this._g = rgb.g,
        this._b = rgb.b,
        this._a = rgb.a,
        this._roundA = mathRound(100*this._a) / 100,
        this._format = opts.format || rgb.format;
        this._gradientType = opts.gradientType;

        // Don't let the range of [0,255] come back in [0,1].
        // Potentially lose a little bit of precision here, but will fix issues where
        // .5 gets interpreted as half of the total, instead of half of 1
        // If it was supposed to be 128, this was already taken care of by `inputToRgb`
        if (this._r < 1) { this._r = mathRound(this._r); }
        if (this._g < 1) { this._g = mathRound(this._g); }
        if (this._b < 1) { this._b = mathRound(this._b); }

        this._ok = rgb.ok;
        this._tc_id = tinyCounter++;
    };

    tinycolor.prototype = {
        isDark: function() {
            return this.getBrightness() < 128;
        },
        isLight: function() {
            return !this.isDark();
        },
        isValid: function() {
            return this._ok;
        },
        getOriginalInput: function() {
          return this._originalInput;
        },
        getFormat: function() {
            return this._format;
        },
        getAlpha: function() {
            return this._a;
        },
        getBrightness: function() {
            var rgb = this.toRgb();
            return (rgb.r * 299 + rgb.g * 587 + rgb.b * 114) / 1000;
        },
        setAlpha: function(value) {
            this._a = boundAlpha(value);
            this._roundA = mathRound(100*this._a) / 100;
            return this;
        },
        toHsv: function() {
            var hsv = rgbToHsv(this._r, this._g, this._b);
            return { h: hsv.h * 360, s: hsv.s, v: hsv.v, a: this._a };
        },
        toHsvString: function() {
            var hsv = rgbToHsv(this._r, this._g, this._b);
            var h = mathRound(hsv.h * 360), s = mathRound(hsv.s * 100), v = mathRound(hsv.v * 100);
            return (this._a == 1) ?
              "hsv("  + h + ", " + s + "%, " + v + "%)" :
              "hsva(" + h + ", " + s + "%, " + v + "%, "+ this._roundA + ")";
        },
        toHsl: function() {
            var hsl = rgbToHsl(this._r, this._g, this._b);
            return { h: hsl.h * 360, s: hsl.s, l: hsl.l, a: this._a };
        },
        toHslString: function() {
            var hsl = rgbToHsl(this._r, this._g, this._b);
            var h = mathRound(hsl.h * 360), s = mathRound(hsl.s * 100), l = mathRound(hsl.l * 100);
            return (this._a == 1) ?
              "hsl("  + h + ", " + s + "%, " + l + "%)" :
              "hsla(" + h + ", " + s + "%, " + l + "%, "+ this._roundA + ")";
        },
        toHex: function(allow3Char) {
            return rgbToHex(this._r, this._g, this._b, allow3Char);
        },
        toHexString: function(allow3Char) {
            return '#' + this.toHex(allow3Char);
        },
        toHex8: function() {
            return rgbaToHex(this._r, this._g, this._b, this._a);
        },
        toHex8String: function() {
            return '#' + this.toHex8();
        },
        toRgb: function() {
            return { r: mathRound(this._r), g: mathRound(this._g), b: mathRound(this._b), a: this._a };
        },
        toRgbString: function() {
            return (this._a == 1) ?
              "rgb("  + mathRound(this._r) + ", " + mathRound(this._g) + ", " + mathRound(this._b) + ")" :
              "rgba(" + mathRound(this._r) + ", " + mathRound(this._g) + ", " + mathRound(this._b) + ", " + this._roundA + ")";
        },
        toPercentageRgb: function() {
            return { r: mathRound(bound01(this._r, 255) * 100) + "%", g: mathRound(bound01(this._g, 255) * 100) + "%", b: mathRound(bound01(this._b, 255) * 100) + "%", a: this._a };
        },
        toPercentageRgbString: function() {
            return (this._a == 1) ?
              "rgb("  + mathRound(bound01(this._r, 255) * 100) + "%, " + mathRound(bound01(this._g, 255) * 100) + "%, " + mathRound(bound01(this._b, 255) * 100) + "%)" :
              "rgba(" + mathRound(bound01(this._r, 255) * 100) + "%, " + mathRound(bound01(this._g, 255) * 100) + "%, " + mathRound(bound01(this._b, 255) * 100) + "%, " + this._roundA + ")";
        },
        toName: function() {
            if (this._a === 0) {
                return "transparent";
            }

            if (this._a < 1) {
                return false;
            }

            return hexNames[rgbToHex(this._r, this._g, this._b, true)] || false;
        },
        toFilter: function(secondColor) {
            var hex8String = '#' + rgbaToHex(this._r, this._g, this._b, this._a);
            var secondHex8String = hex8String;
            var gradientType = this._gradientType ? "GradientType = 1, " : "";

            if (secondColor) {
                var s = tinycolor(secondColor);
                secondHex8String = s.toHex8String();
            }

            return "progid:DXImageTransform.Microsoft.gradient("+gradientType+"startColorstr="+hex8String+",endColorstr="+secondHex8String+")";
        },
        toString: function(format) {
            var formatSet = !!format;
            format = format || this._format;

            var formattedString = false;
            var hasAlpha = this._a < 1 && this._a >= 0;
            var needsAlphaFormat = !formatSet && hasAlpha && (format === "hex" || format === "hex6" || format === "hex3" || format === "name");

            if (needsAlphaFormat) {
                // Special case for "transparent", all other non-alpha formats
                // will return rgba when there is transparency.
                if (format === "name" && this._a === 0) {
                    return this.toName();
                }
                return this.toRgbString();
            }
            if (format === "rgb") {
                formattedString = this.toRgbString();
            }
            if (format === "prgb") {
                formattedString = this.toPercentageRgbString();
            }
            if (format === "hex" || format === "hex6") {
                formattedString = this.toHexString();
            }
            if (format === "hex3") {
                formattedString = this.toHexString(true);
            }
            if (format === "hex8") {
                formattedString = this.toHex8String();
            }
            if (format === "name") {
                formattedString = this.toName();
            }
            if (format === "hsl") {
                formattedString = this.toHslString();
            }
            if (format === "hsv") {
                formattedString = this.toHsvString();
            }

            return formattedString || this.toHexString();
        },

        _applyModification: function(fn, args) {
            var color = fn.apply(null, [this].concat([].slice.call(args)));
            this._r = color._r;
            this._g = color._g;
            this._b = color._b;
            this.setAlpha(color._a);
            return this;
        },
        lighten: function() {
            return this._applyModification(lighten, arguments);
        },
        brighten: function() {
            return this._applyModification(brighten, arguments);
        },
        darken: function() {
            return this._applyModification(darken, arguments);
        },
        desaturate: function() {
            return this._applyModification(desaturate, arguments);
        },
        saturate: function() {
            return this._applyModification(saturate, arguments);
        },
        greyscale: function() {
            return this._applyModification(greyscale, arguments);
        },
        spin: function() {
            return this._applyModification(spin, arguments);
        },

        _applyCombination: function(fn, args) {
            return fn.apply(null, [this].concat([].slice.call(args)));
        },
        analogous: function() {
            return this._applyCombination(analogous, arguments);
        },
        complement: function() {
            return this._applyCombination(complement, arguments);
        },
        monochromatic: function() {
            return this._applyCombination(monochromatic, arguments);
        },
        splitcomplement: function() {
            return this._applyCombination(splitcomplement, arguments);
        },
        triad: function() {
            return this._applyCombination(triad, arguments);
        },
        tetrad: function() {
            return this._applyCombination(tetrad, arguments);
        }
    };

    // If input is an object, force 1 into "1.0" to handle ratios properly
    // String input requires "1.0" as input, so 1 will be treated as 1
    tinycolor.fromRatio = function(color, opts) {
        if (typeof color == "object") {
            var newColor = {};
            for (var i in color) {
                if (color.hasOwnProperty(i)) {
                    if (i === "a") {
                        newColor[i] = color[i];
                    }
                    else {
                        newColor[i] = convertToPercentage(color[i]);
                    }
                }
            }
            color = newColor;
        }

        return tinycolor(color, opts);
    };

    // Given a string or object, convert that input to RGB
    // Possible string inputs:
    //
    //     "red"
    //     "#f00" or "f00"
    //     "#ff0000" or "ff0000"
    //     "#ff000000" or "ff000000"
    //     "rgb 255 0 0" or "rgb (255, 0, 0)"
    //     "rgb 1.0 0 0" or "rgb (1, 0, 0)"
    //     "rgba (255, 0, 0, 1)" or "rgba 255, 0, 0, 1"
    //     "rgba (1.0, 0, 0, 1)" or "rgba 1.0, 0, 0, 1"
    //     "hsl(0, 100%, 50%)" or "hsl 0 100% 50%"
    //     "hsla(0, 100%, 50%, 1)" or "hsla 0 100% 50%, 1"
    //     "hsv(0, 100%, 100%)" or "hsv 0 100% 100%"
    //
    function inputToRGB(color) {

        var rgb = { r: 0, g: 0, b: 0 };
        var a = 1;
        var ok = false;
        var format = false;

        if (typeof color == "string") {
            color = stringInputToObject(color);
        }

        if (typeof color == "object") {
            if (color.hasOwnProperty("r") && color.hasOwnProperty("g") && color.hasOwnProperty("b")) {
                rgb = rgbToRgb(color.r, color.g, color.b);
                ok = true;
                format = String(color.r).substr(-1) === "%" ? "prgb" : "rgb";
            }
            else if (color.hasOwnProperty("h") && color.hasOwnProperty("s") && color.hasOwnProperty("v")) {
                color.s = convertToPercentage(color.s);
                color.v = convertToPercentage(color.v);
                rgb = hsvToRgb(color.h, color.s, color.v);
                ok = true;
                format = "hsv";
            }
            else if (color.hasOwnProperty("h") && color.hasOwnProperty("s") && color.hasOwnProperty("l")) {
                color.s = convertToPercentage(color.s);
                color.l = convertToPercentage(color.l);
                rgb = hslToRgb(color.h, color.s, color.l);
                ok = true;
                format = "hsl";
            }

            if (color.hasOwnProperty("a")) {
                a = color.a;
            }
        }

        a = boundAlpha(a);

        return {
            ok: ok,
            format: color.format || format,
            r: mathMin(255, mathMax(rgb.r, 0)),
            g: mathMin(255, mathMax(rgb.g, 0)),
            b: mathMin(255, mathMax(rgb.b, 0)),
            a: a
        };
    }


    // Conversion Functions
    // --------------------

    // `rgbToHsl`, `rgbToHsv`, `hslToRgb`, `hsvToRgb` modified from:
    // <http://mjijackson.com/2008/02/rgb-to-hsl-and-rgb-to-hsv-color-model-conversion-algorithms-in-javascript>

    // `rgbToRgb`
    // Handle bounds / percentage checking to conform to CSS color spec
    // <http://www.w3.org/TR/css3-color/>
    // *Assumes:* r, g, b in [0, 255] or [0, 1]
    // *Returns:* { r, g, b } in [0, 255]
    function rgbToRgb(r, g, b){
        return {
            r: bound01(r, 255) * 255,
            g: bound01(g, 255) * 255,
            b: bound01(b, 255) * 255
        };
    }

    // `rgbToHsl`
    // Converts an RGB color value to HSL.
    // *Assumes:* r, g, and b are contained in [0, 255] or [0, 1]
    // *Returns:* { h, s, l } in [0,1]
    function rgbToHsl(r, g, b) {

        r = bound01(r, 255);
        g = bound01(g, 255);
        b = bound01(b, 255);

        var max = mathMax(r, g, b), min = mathMin(r, g, b);
        var h, s, l = (max + min) / 2;

        if(max == min) {
            h = s = 0; // achromatic
        }
        else {
            var d = max - min;
            s = l > 0.5 ? d / (2 - max - min) : d / (max + min);
            switch(max) {
                case r: h = (g - b) / d + (g < b ? 6 : 0); break;
                case g: h = (b - r) / d + 2; break;
                case b: h = (r - g) / d + 4; break;
            }

            h /= 6;
        }

        return { h: h, s: s, l: l };
    }

    // `hslToRgb`
    // Converts an HSL color value to RGB.
    // *Assumes:* h is contained in [0, 1] or [0, 360] and s and l are contained [0, 1] or [0, 100]
    // *Returns:* { r, g, b } in the set [0, 255]
    function hslToRgb(h, s, l) {
        var r, g, b;

        h = bound01(h, 360);
        s = bound01(s, 100);
        l = bound01(l, 100);

        function hue2rgb(p, q, t) {
            if(t < 0) t += 1;
            if(t > 1) t -= 1;
            if(t < 1/6) return p + (q - p) * 6 * t;
            if(t < 1/2) return q;
            if(t < 2/3) return p + (q - p) * (2/3 - t) * 6;
            return p;
        }

        if(s === 0) {
            r = g = b = l; // achromatic
        }
        else {
            var q = l < 0.5 ? l * (1 + s) : l + s - l * s;
            var p = 2 * l - q;
            r = hue2rgb(p, q, h + 1/3);
            g = hue2rgb(p, q, h);
            b = hue2rgb(p, q, h - 1/3);
        }

        return { r: r * 255, g: g * 255, b: b * 255 };
    }

    // `rgbToHsv`
    // Converts an RGB color value to HSV
    // *Assumes:* r, g, and b are contained in the set [0, 255] or [0, 1]
    // *Returns:* { h, s, v } in [0,1]
    function rgbToHsv(r, g, b) {

        r = bound01(r, 255);
        g = bound01(g, 255);
        b = bound01(b, 255);

        var max = mathMax(r, g, b), min = mathMin(r, g, b);
        var h, s, v = max;

        var d = max - min;
        s = max === 0 ? 0 : d / max;

        if(max == min) {
            h = 0; // achromatic
        }
        else {
            switch(max) {
                case r: h = (g - b) / d + (g < b ? 6 : 0); break;
                case g: h = (b - r) / d + 2; break;
                case b: h = (r - g) / d + 4; break;
            }
            h /= 6;
        }
        return { h: h, s: s, v: v };
    }

    // `hsvToRgb`
    // Converts an HSV color value to RGB.
    // *Assumes:* h is contained in [0, 1] or [0, 360] and s and v are contained in [0, 1] or [0, 100]
    // *Returns:* { r, g, b } in the set [0, 255]
     function hsvToRgb(h, s, v) {

        h = bound01(h, 360) * 6;
        s = bound01(s, 100);
        v = bound01(v, 100);

        var i = math.floor(h),
            f = h - i,
            p = v * (1 - s),
            q = v * (1 - f * s),
            t = v * (1 - (1 - f) * s),
            mod = i % 6,
            r = [v, q, p, p, t, v][mod],
            g = [t, v, v, q, p, p][mod],
            b = [p, p, t, v, v, q][mod];

        return { r: r * 255, g: g * 255, b: b * 255 };
    }

    // `rgbToHex`
    // Converts an RGB color to hex
    // Assumes r, g, and b are contained in the set [0, 255]
    // Returns a 3 or 6 character hex
    function rgbToHex(r, g, b, allow3Char) {

        var hex = [
            pad2(mathRound(r).toString(16)),
            pad2(mathRound(g).toString(16)),
            pad2(mathRound(b).toString(16))
        ];

        // Return a 3 character hex if possible
        if (allow3Char && hex[0].charAt(0) == hex[0].charAt(1) && hex[1].charAt(0) == hex[1].charAt(1) && hex[2].charAt(0) == hex[2].charAt(1)) {
            return hex[0].charAt(0) + hex[1].charAt(0) + hex[2].charAt(0);
        }

        return hex.join("");
    }
        // `rgbaToHex`
        // Converts an RGBA color plus alpha transparency to hex
        // Assumes r, g, b and a are contained in the set [0, 255]
        // Returns an 8 character hex
        function rgbaToHex(r, g, b, a) {

            var hex = [
                pad2(convertDecimalToHex(a)),
                pad2(mathRound(r).toString(16)),
                pad2(mathRound(g).toString(16)),
                pad2(mathRound(b).toString(16))
            ];

            return hex.join("");
        }

    // `equals`
    // Can be called with any tinycolor input
    tinycolor.equals = function (color1, color2) {
        if (!color1 || !color2) { return false; }
        return tinycolor(color1).toRgbString() == tinycolor(color2).toRgbString();
    };
    tinycolor.random = function() {
        return tinycolor.fromRatio({
            r: mathRandom(),
            g: mathRandom(),
            b: mathRandom()
        });
    };


    // Modification Functions
    // ----------------------
    // Thanks to less.js for some of the basics here
    // <https://github.com/cloudhead/less.js/blob/master/lib/less/functions.js>

    function desaturate(color, amount) {
        amount = (amount === 0) ? 0 : (amount || 10);
        var hsl = tinycolor(color).toHsl();
        hsl.s -= amount / 100;
        hsl.s = clamp01(hsl.s);
        return tinycolor(hsl);
    }

    function saturate(color, amount) {
        amount = (amount === 0) ? 0 : (amount || 10);
        var hsl = tinycolor(color).toHsl();
        hsl.s += amount / 100;
        hsl.s = clamp01(hsl.s);
        return tinycolor(hsl);
    }

    function greyscale(color) {
        return tinycolor(color).desaturate(100);
    }

    function lighten (color, amount) {
        amount = (amount === 0) ? 0 : (amount || 10);
        var hsl = tinycolor(color).toHsl();
        hsl.l += amount / 100;
        hsl.l = clamp01(hsl.l);
        return tinycolor(hsl);
    }

    function brighten(color, amount) {
        amount = (amount === 0) ? 0 : (amount || 10);
        var rgb = tinycolor(color).toRgb();
        rgb.r = mathMax(0, mathMin(255, rgb.r - mathRound(255 * - (amount / 100))));
        rgb.g = mathMax(0, mathMin(255, rgb.g - mathRound(255 * - (amount / 100))));
        rgb.b = mathMax(0, mathMin(255, rgb.b - mathRound(255 * - (amount / 100))));
        return tinycolor(rgb);
    }

    function darken (color, amount) {
        amount = (amount === 0) ? 0 : (amount || 10);
        var hsl = tinycolor(color).toHsl();
        hsl.l -= amount / 100;
        hsl.l = clamp01(hsl.l);
        return tinycolor(hsl);
    }

    // Spin takes a positive or negative amount within [-360, 360] indicating the change of hue.
    // Values outside of this range will be wrapped into this range.
    function spin(color, amount) {
        var hsl = tinycolor(color).toHsl();
        var hue = (mathRound(hsl.h) + amount) % 360;
        hsl.h = hue < 0 ? 360 + hue : hue;
        return tinycolor(hsl);
    }

    // Combination Functions
    // ---------------------
    // Thanks to jQuery xColor for some of the ideas behind these
    // <https://github.com/infusion/jQuery-xcolor/blob/master/jquery.xcolor.js>

    function complement(color) {
        var hsl = tinycolor(color).toHsl();
        hsl.h = (hsl.h + 180) % 360;
        return tinycolor(hsl);
    }

    function triad(color) {
        var hsl = tinycolor(color).toHsl();
        var h = hsl.h;
        return [
            tinycolor(color),
            tinycolor({ h: (h + 120) % 360, s: hsl.s, l: hsl.l }),
            tinycolor({ h: (h + 240) % 360, s: hsl.s, l: hsl.l })
        ];
    }

    function tetrad(color) {
        var hsl = tinycolor(color).toHsl();
        var h = hsl.h;
        return [
            tinycolor(color),
            tinycolor({ h: (h + 90) % 360, s: hsl.s, l: hsl.l }),
            tinycolor({ h: (h + 180) % 360, s: hsl.s, l: hsl.l }),
            tinycolor({ h: (h + 270) % 360, s: hsl.s, l: hsl.l })
        ];
    }

    function splitcomplement(color) {
        var hsl = tinycolor(color).toHsl();
        var h = hsl.h;
        return [
            tinycolor(color),
            tinycolor({ h: (h + 72) % 360, s: hsl.s, l: hsl.l}),
            tinycolor({ h: (h + 216) % 360, s: hsl.s, l: hsl.l})
        ];
    }

    function analogous(color, results, slices) {
        results = results || 6;
        slices = slices || 30;

        var hsl = tinycolor(color).toHsl();
        var part = 360 / slices;
        var ret = [tinycolor(color)];

        for (hsl.h = ((hsl.h - (part * results >> 1)) + 720) % 360; --results; ) {
            hsl.h = (hsl.h + part) % 360;
            ret.push(tinycolor(hsl));
        }
        return ret;
    }

    function monochromatic(color, results) {
        results = results || 6;
        var hsv = tinycolor(color).toHsv();
        var h = hsv.h, s = hsv.s, v = hsv.v;
        var ret = [];
        var modification = 1 / results;

        while (results--) {
            ret.push(tinycolor({ h: h, s: s, v: v}));
            v = (v + modification) % 1;
        }

        return ret;
    }

    // Utility Functions
    // ---------------------

    tinycolor.mix = function(color1, color2, amount) {
        amount = (amount === 0) ? 0 : (amount || 50);

        var rgb1 = tinycolor(color1).toRgb();
        var rgb2 = tinycolor(color2).toRgb();

        var p = amount / 100;
        var w = p * 2 - 1;
        var a = rgb2.a - rgb1.a;

        var w1;

        if (w * a == -1) {
            w1 = w;
        } else {
            w1 = (w + a) / (1 + w * a);
        }

        w1 = (w1 + 1) / 2;

        var w2 = 1 - w1;

        var rgba = {
            r: rgb2.r * w1 + rgb1.r * w2,
            g: rgb2.g * w1 + rgb1.g * w2,
            b: rgb2.b * w1 + rgb1.b * w2,
            a: rgb2.a * p  + rgb1.a * (1 - p)
        };

        return tinycolor(rgba);
    };


    // Readability Functions
    // ---------------------
    // <http://www.w3.org/TR/AERT#color-contrast>

    // `readability`
    // Analyze the 2 colors and returns an object with the following properties:
    //    `brightness`: difference in brightness between the two colors
    //    `color`: difference in color/hue between the two colors
    tinycolor.readability = function(color1, color2) {
        var c1 = tinycolor(color1);
        var c2 = tinycolor(color2);
        var rgb1 = c1.toRgb();
        var rgb2 = c2.toRgb();
        var brightnessA = c1.getBrightness();
        var brightnessB = c2.getBrightness();
        var colorDiff = (
            Math.max(rgb1.r, rgb2.r) - Math.min(rgb1.r, rgb2.r) +
            Math.max(rgb1.g, rgb2.g) - Math.min(rgb1.g, rgb2.g) +
            Math.max(rgb1.b, rgb2.b) - Math.min(rgb1.b, rgb2.b)
        );

        return {
            brightness: Math.abs(brightnessA - brightnessB),
            color: colorDiff
        };
    };

    // `readable`
    // http://www.w3.org/TR/AERT#color-contrast
    // Ensure that foreground and background color combinations provide sufficient contrast.
    // *Example*
    //    tinycolor.isReadable("#000", "#111") => false
    tinycolor.isReadable = function(color1, color2) {
        var readability = tinycolor.readability(color1, color2);
        return readability.brightness > 125 && readability.color > 500;
    };

    // `mostReadable`
    // Given a base color and a list of possible foreground or background
    // colors for that base, returns the most readable color.
    // *Example*
    //    tinycolor.mostReadable("#123", ["#fff", "#000"]) => "#000"
    tinycolor.mostReadable = function(baseColor, colorList) {
        var bestColor = null;
        var bestScore = 0;
        var bestIsReadable = false;
        for (var i=0; i < colorList.length; i++) {

            // We normalize both around the "acceptable" breaking point,
            // but rank brightness constrast higher than hue.

            var readability = tinycolor.readability(baseColor, colorList[i]);
            var readable = readability.brightness > 125 && readability.color > 500;
            var score = 3 * (readability.brightness / 125) + (readability.color / 500);

            if ((readable && ! bestIsReadable) ||
                (readable && bestIsReadable && score > bestScore) ||
                ((! readable) && (! bestIsReadable) && score > bestScore)) {
                bestIsReadable = readable;
                bestScore = score;
                bestColor = tinycolor(colorList[i]);
            }
        }
        return bestColor;
    };


    // Big List of Colors
    // ------------------
    // <http://www.w3.org/TR/css3-color/#svg-color>
    var names = tinycolor.names = {
        aliceblue: "f0f8ff",
        antiquewhite: "faebd7",
        aqua: "0ff",
        aquamarine: "7fffd4",
        azure: "f0ffff",
        beige: "f5f5dc",
        bisque: "ffe4c4",
        black: "000",
        blanchedalmond: "ffebcd",
        blue: "00f",
        blueviolet: "8a2be2",
        brown: "a52a2a",
        burlywood: "deb887",
        burntsienna: "ea7e5d",
        cadetblue: "5f9ea0",
        chartreuse: "7fff00",
        chocolate: "d2691e",
        coral: "ff7f50",
        cornflowerblue: "6495ed",
        cornsilk: "fff8dc",
        crimson: "dc143c",
        cyan: "0ff",
        darkblue: "00008b",
        darkcyan: "008b8b",
        darkgoldenrod: "b8860b",
        darkgray: "a9a9a9",
        darkgreen: "006400",
        darkgrey: "a9a9a9",
        darkkhaki: "bdb76b",
        darkmagenta: "8b008b",
        darkolivegreen: "556b2f",
        darkorange: "ff8c00",
        darkorchid: "9932cc",
        darkred: "8b0000",
        darksalmon: "e9967a",
        darkseagreen: "8fbc8f",
        darkslateblue: "483d8b",
        darkslategray: "2f4f4f",
        darkslategrey: "2f4f4f",
        darkturquoise: "00ced1",
        darkviolet: "9400d3",
        deeppink: "ff1493",
        deepskyblue: "00bfff",
        dimgray: "696969",
        dimgrey: "696969",
        dodgerblue: "1e90ff",
        firebrick: "b22222",
        floralwhite: "fffaf0",
        forestgreen: "228b22",
        fuchsia: "f0f",
        gainsboro: "dcdcdc",
        ghostwhite: "f8f8ff",
        gold: "ffd700",
        goldenrod: "daa520",
        gray: "808080",
        green: "008000",
        greenyellow: "adff2f",
        grey: "808080",
        honeydew: "f0fff0",
        hotpink: "ff69b4",
        indianred: "cd5c5c",
        indigo: "4b0082",
        ivory: "fffff0",
        khaki: "f0e68c",
        lavender: "e6e6fa",
        lavenderblush: "fff0f5",
        lawngreen: "7cfc00",
        lemonchiffon: "fffacd",
        lightblue: "add8e6",
        lightcoral: "f08080",
        lightcyan: "e0ffff",
        lightgoldenrodyellow: "fafad2",
        lightgray: "d3d3d3",
        lightgreen: "90ee90",
        lightgrey: "d3d3d3",
        lightpink: "ffb6c1",
        lightsalmon: "ffa07a",
        lightseagreen: "20b2aa",
        lightskyblue: "87cefa",
        lightslategray: "789",
        lightslategrey: "789",
        lightsteelblue: "b0c4de",
        lightyellow: "ffffe0",
        lime: "0f0",
        limegreen: "32cd32",
        linen: "faf0e6",
        magenta: "f0f",
        maroon: "800000",
        mediumaquamarine: "66cdaa",
        mediumblue: "0000cd",
        mediumorchid: "ba55d3",
        mediumpurple: "9370db",
        mediumseagreen: "3cb371",
        mediumslateblue: "7b68ee",
        mediumspringgreen: "00fa9a",
        mediumturquoise: "48d1cc",
        mediumvioletred: "c71585",
        midnightblue: "191970",
        mintcream: "f5fffa",
        mistyrose: "ffe4e1",
        moccasin: "ffe4b5",
        navajowhite: "ffdead",
        navy: "000080",
        oldlace: "fdf5e6",
        olive: "808000",
        olivedrab: "6b8e23",
        orange: "ffa500",
        orangered: "ff4500",
        orchid: "da70d6",
        palegoldenrod: "eee8aa",
        palegreen: "98fb98",
        paleturquoise: "afeeee",
        palevioletred: "db7093",
        papayawhip: "ffefd5",
        peachpuff: "ffdab9",
        peru: "cd853f",
        pink: "ffc0cb",
        plum: "dda0dd",
        powderblue: "b0e0e6",
        purple: "800080",
        rebeccapurple: "663399",
        red: "f00",
        rosybrown: "bc8f8f",
        royalblue: "4169e1",
        saddlebrown: "8b4513",
        salmon: "fa8072",
        sandybrown: "f4a460",
        seagreen: "2e8b57",
        seashell: "fff5ee",
        sienna: "a0522d",
        silver: "c0c0c0",
        skyblue: "87ceeb",
        slateblue: "6a5acd",
        slategray: "708090",
        slategrey: "708090",
        snow: "fffafa",
        springgreen: "00ff7f",
        steelblue: "4682b4",
        tan: "d2b48c",
        teal: "008080",
        thistle: "d8bfd8",
        tomato: "ff6347",
        turquoise: "40e0d0",
        violet: "ee82ee",
        wheat: "f5deb3",
        white: "fff",
        whitesmoke: "f5f5f5",
        yellow: "ff0",
        yellowgreen: "9acd32"
    };

    // Make it easy to access colors via `hexNames[hex]`
    var hexNames = tinycolor.hexNames = flip(names);


    // Utilities
    // ---------

    // `{ 'name1': 'val1' }` becomes `{ 'val1': 'name1' }`
    function flip(o) {
        var flipped = { };
        for (var i in o) {
            if (o.hasOwnProperty(i)) {
                flipped[o[i]] = i;
            }
        }
        return flipped;
    }

    // Return a valid alpha value [0,1] with all invalid values being set to 1
    function boundAlpha(a) {
        a = parseFloat(a);

        if (isNaN(a) || a < 0 || a > 1) {
            a = 1;
        }

        return a;
    }

    // Take input from [0, n] and return it as [0, 1]
    function bound01(n, max) {
        if (isOnePointZero(n)) { n = "100%"; }

        var processPercent = isPercentage(n);
        n = mathMin(max, mathMax(0, parseFloat(n)));

        // Automatically convert percentage into number
        if (processPercent) {
            n = parseInt(n * max, 10) / 100;
        }

        // Handle floating point rounding errors
        if ((math.abs(n - max) < 0.000001)) {
            return 1;
        }

        // Convert into [0, 1] range if it isn't already
        return (n % max) / parseFloat(max);
    }

    // Force a number between 0 and 1
    function clamp01(val) {
        return mathMin(1, mathMax(0, val));
    }

    // Parse a base-16 hex value into a base-10 integer
    function parseIntFromHex(val) {
        return parseInt(val, 16);
    }

    // Need to handle 1.0 as 100%, since once it is a number, there is no difference between it and 1
    // <http://stackoverflow.com/questions/7422072/javascript-how-to-detect-number-as-a-decimal-including-1-0>
    function isOnePointZero(n) {
        return typeof n == "string" && n.indexOf('.') != -1 && parseFloat(n) === 1;
    }

    // Check to see if string passed in is a percentage
    function isPercentage(n) {
        return typeof n === "string" && n.indexOf('%') != -1;
    }

    // Force a hex value to have 2 characters
    function pad2(c) {
        return c.length == 1 ? '0' + c : '' + c;
    }

    // Replace a decimal with it's percentage value
    function convertToPercentage(n) {
        if (n <= 1) {
            n = (n * 100) + "%";
        }

        return n;
    }

    // Converts a decimal to a hex value
    function convertDecimalToHex(d) {
        return Math.round(parseFloat(d) * 255).toString(16);
    }
    // Converts a hex value to a decimal
    function convertHexToDecimal(h) {
        return (parseIntFromHex(h) / 255);
    }

    var matchers = (function() {

        // <http://www.w3.org/TR/css3-values/#integers>
        var CSS_INTEGER = "[-\\+]?\\d+%?";

        // <http://www.w3.org/TR/css3-values/#number-value>
        var CSS_NUMBER = "[-\\+]?\\d*\\.\\d+%?";

        // Allow positive/negative integer/number.  Don't capture the either/or, just the entire outcome.
        var CSS_UNIT = "(?:" + CSS_NUMBER + ")|(?:" + CSS_INTEGER + ")";

        // Actual matching.
        // Parentheses and commas are optional, but not required.
        // Whitespace can take the place of commas or opening paren
        var PERMISSIVE_MATCH3 = "[\\s|\\(]+(" + CSS_UNIT + ")[,|\\s]+(" + CSS_UNIT + ")[,|\\s]+(" + CSS_UNIT + ")\\s*\\)?";
        var PERMISSIVE_MATCH4 = "[\\s|\\(]+(" + CSS_UNIT + ")[,|\\s]+(" + CSS_UNIT + ")[,|\\s]+(" + CSS_UNIT + ")[,|\\s]+(" + CSS_UNIT + ")\\s*\\)?";

        return {
            rgb: new RegExp("rgb" + PERMISSIVE_MATCH3),
            rgba: new RegExp("rgba" + PERMISSIVE_MATCH4),
            hsl: new RegExp("hsl" + PERMISSIVE_MATCH3),
            hsla: new RegExp("hsla" + PERMISSIVE_MATCH4),
            hsv: new RegExp("hsv" + PERMISSIVE_MATCH3),
            hsva: new RegExp("hsva" + PERMISSIVE_MATCH4),
            hex3: /^([0-9a-fA-F]{1})([0-9a-fA-F]{1})([0-9a-fA-F]{1})$/,
            hex6: /^([0-9a-fA-F]{2})([0-9a-fA-F]{2})([0-9a-fA-F]{2})$/,
            hex8: /^([0-9a-fA-F]{2})([0-9a-fA-F]{2})([0-9a-fA-F]{2})([0-9a-fA-F]{2})$/
        };
    })();

    // `stringInputToObject`
    // Permissive string parsing.  Take in a number of formats, and output an object
    // based on detected format.  Returns `{ r, g, b }` or `{ h, s, l }` or `{ h, s, v}`
    function stringInputToObject(color) {

        color = color.replace(trimLeft,'').replace(trimRight, '').toLowerCase();
        var named = false;
        if (names[color]) {
            color = names[color];
            named = true;
        }
        else if (color == 'transparent') {
            return { r: 0, g: 0, b: 0, a: 0, format: "name" };
        }

        // Try to match string input using regular expressions.
        // Keep most of the number bounding out of this function - don't worry about [0,1] or [0,100] or [0,360]
        // Just return an object and let the conversion functions handle that.
        // This way the result will be the same whether the tinycolor is initialized with string or object.
        var match;
        if ((match = matchers.rgb.exec(color))) {
            return { r: match[1], g: match[2], b: match[3] };
        }
        if ((match = matchers.rgba.exec(color))) {
            return { r: match[1], g: match[2], b: match[3], a: match[4] };
        }
        if ((match = matchers.hsl.exec(color))) {
            return { h: match[1], s: match[2], l: match[3] };
        }
        if ((match = matchers.hsla.exec(color))) {
            return { h: match[1], s: match[2], l: match[3], a: match[4] };
        }
        if ((match = matchers.hsv.exec(color))) {
            return { h: match[1], s: match[2], v: match[3] };
        }
        if ((match = matchers.hsva.exec(color))) {
            return { h: match[1], s: match[2], v: match[3], a: match[4] };
        }
        if ((match = matchers.hex8.exec(color))) {
            return {
                a: convertHexToDecimal(match[1]),
                r: parseIntFromHex(match[2]),
                g: parseIntFromHex(match[3]),
                b: parseIntFromHex(match[4]),
                format: named ? "name" : "hex8"
            };
        }
        if ((match = matchers.hex6.exec(color))) {
            return {
                r: parseIntFromHex(match[1]),
                g: parseIntFromHex(match[2]),
                b: parseIntFromHex(match[3]),
                format: named ? "name" : "hex"
            };
        }
        if ((match = matchers.hex3.exec(color))) {
            return {
                r: parseIntFromHex(match[1] + '' + match[1]),
                g: parseIntFromHex(match[2] + '' + match[2]),
                b: parseIntFromHex(match[3] + '' + match[3]),
                format: named ? "name" : "hex"
            };
        }

        return false;
    }

    window.tinycolor = tinycolor;
    })();

    $(function () {
        if ($.fn.spectrum.load) {
            $.fn.spectrum.processNativeColorInputs();
        }
    });

});

/*
 * jQuery UI Slider Access
 * By: Trent Richardson [http://trentrichardson.com]
 * Version 0.3
 * Last Modified: 10/20/2012
 * 
 * Copyright 2011 Trent Richardson
 * Dual licensed under the MIT and GPL licenses.
 * http://trentrichardson.com/Impromptu/GPL-LICENSE.txt
 * http://trentrichardson.com/Impromptu/MIT-LICENSE.txt
 * 
 */
 (function($){

	$.fn.extend({
		sliderAccess: function(options){
			options = options || {};
			options.touchonly = options.touchonly !== undefined? options.touchonly : true; // by default only show it if touch device

			if(options.touchonly === true && !("ontouchend" in document)){
				return $(this);
			}
				
			return $(this).each(function(i,obj){
						var $t = $(this),
							o = $.extend({},{ 
											where: 'after',
											step: $t.slider('option','step'), 
											upIcon: 'ui-icon-plus', 
											downIcon: 'ui-icon-minus',
											text: false,
											upText: '+',
											downText: '-',
											buttonset: true,
											buttonsetTag: 'span',
											isRTL: false
										}, options),
							$buttons = $('<'+ o.buttonsetTag +' class="ui-slider-access">'+
											'<button data-icon="'+ o.downIcon +'" data-step="'+ (o.isRTL? o.step : o.step*-1) +'">'+ o.downText +'</button>'+
											'<button data-icon="'+ o.upIcon +'" data-step="'+ (o.isRTL? o.step*-1 : o.step) +'">'+ o.upText +'</button>'+
										'</'+ o.buttonsetTag +'>');

						$buttons.children('button').each(function(j, jobj){
							var $jt = $(this);
							$jt.button({ 
											text: o.text, 
											icons: { primary: $jt.data('icon') }
										})
								.click(function(e){
											var step = $jt.data('step'),
												curr = $t.slider('value'),
												newval = curr += step*1,
												minval = $t.slider('option','min'),
												maxval = $t.slider('option','max'),
												slidee = $t.slider("option", "slide") || function(){},
												stope = $t.slider("option", "stop") || function(){};

											e.preventDefault();
											
											if(newval < minval || newval > maxval){
												return;
											}
											
											$t.slider('value', newval);

											slidee.call($t, null, { value: newval });
											stope.call($t, null, { value: newval });
										});
						});
						
						// before or after					
						$t[o.where]($buttons);

						if(o.buttonset){
							$buttons.removeClass('ui-corner-right').removeClass('ui-corner-left').buttonset();
							$buttons.eq(0).addClass('ui-corner-left');
							$buttons.eq(1).addClass('ui-corner-right');
						}

						// adjust the width so we don't break the original layout
						var bOuterWidth = $buttons.css({
									marginLeft: ((o.where === 'after' && !o.isRTL) || (o.where === 'before' && o.isRTL)? 10:0), 
									marginRight: ((o.where === 'before' && !o.isRTL) || (o.where === 'after' && o.isRTL)? 10:0)
								}).outerWidth(true) + 5;
						var tOuterWidth = $t.outerWidth(true);
						$t.css('display','inline-block').width(tOuterWidth-bOuterWidth);
					});		
		}
	});

})(jQuery);
/*! jQuery Timepicker Addon - v1.6.3 - 2016-04-20
* http://trentrichardson.com/examples/timepicker
* Copyright (c) 2016 Trent Richardson; Licensed MIT */
!function(a){"function"==typeof define&&define.amd?define(["jquery","jquery-ui"],a):a(jQuery)}(function($){if($.ui.timepicker=$.ui.timepicker||{},!$.ui.timepicker.version){$.extend($.ui,{timepicker:{version:"1.6.3"}});var Timepicker=function(){this.regional=[],this.regional[""]={currentText:"Now",closeText:"Done",amNames:["AM","A"],pmNames:["PM","P"],timeFormat:"HH:mm",timeSuffix:"",timeOnlyTitle:"Choose Time",timeText:"Time",hourText:"Hour",minuteText:"Minute",secondText:"Second",millisecText:"Millisecond",microsecText:"Microsecond",timezoneText:"Time Zone",isRTL:!1},this._defaults={showButtonPanel:!0,timeOnly:!1,timeOnlyShowDate:!1,showHour:null,showMinute:null,showSecond:null,showMillisec:null,showMicrosec:null,showTimezone:null,showTime:!0,stepHour:1,stepMinute:15,stepSecond:15,stepMillisec:1,stepMicrosec:1,hour:0,minute:0,second:0,millisec:0,microsec:0,timezone:null,hourMin:0,minuteMin:0,secondMin:0,millisecMin:0,microsecMin:0,hourMax:23,minuteMax:59,secondMax:59,millisecMax:999,microsecMax:999,minDateTime:null,maxDateTime:null,maxTime:null,minTime:null,onSelect:null,hourGrid:0,minuteGrid:0,secondGrid:0,millisecGrid:0,microsecGrid:0,alwaysSetTime:!0,separator:" ",altFieldTimeOnly:!0,altTimeFormat:null,altSeparator:null,altTimeSuffix:null,altRedirectFocus:!0,pickerTimeFormat:null,pickerTimeSuffix:null,showTimepicker:!0,timezoneList:null,addSliderAccess:!1,sliderAccessArgs:null,controlType:"slider",oneLine:!1,defaultValue:null,parse:"strict",afterInject:null},$.extend(this._defaults,this.regional[""])};$.extend(Timepicker.prototype,{$input:null,$altInput:null,$timeObj:null,inst:null,hour_slider:null,minute_slider:null,second_slider:null,millisec_slider:null,microsec_slider:null,timezone_select:null,maxTime:null,minTime:null,hour:0,minute:0,second:0,millisec:0,microsec:0,timezone:null,hourMinOriginal:null,minuteMinOriginal:null,secondMinOriginal:null,millisecMinOriginal:null,microsecMinOriginal:null,hourMaxOriginal:null,minuteMaxOriginal:null,secondMaxOriginal:null,millisecMaxOriginal:null,microsecMaxOriginal:null,ampm:"",formattedDate:"",formattedTime:"",formattedDateTime:"",timezoneList:null,units:["hour","minute","second","millisec","microsec"],support:{},control:null,setDefaults:function(a){return extendRemove(this._defaults,a||{}),this},_newInst:function($input,opts){var tp_inst=new Timepicker,inlineSettings={},fns={},overrides,i;for(var attrName in this._defaults)if(this._defaults.hasOwnProperty(attrName)){var attrValue=$input.attr("time:"+attrName);if(attrValue)try{inlineSettings[attrName]=eval(attrValue)}catch(err){inlineSettings[attrName]=attrValue}}overrides={beforeShow:function(a,b){return $.isFunction(tp_inst._defaults.evnts.beforeShow)?tp_inst._defaults.evnts.beforeShow.call($input[0],a,b,tp_inst):void 0},onChangeMonthYear:function(a,b,c){$.isFunction(tp_inst._defaults.evnts.onChangeMonthYear)&&tp_inst._defaults.evnts.onChangeMonthYear.call($input[0],a,b,c,tp_inst)},onClose:function(a,b){tp_inst.timeDefined===!0&&""!==$input.val()&&tp_inst._updateDateTime(b),$.isFunction(tp_inst._defaults.evnts.onClose)&&tp_inst._defaults.evnts.onClose.call($input[0],a,b,tp_inst)}};for(i in overrides)overrides.hasOwnProperty(i)&&(fns[i]=opts[i]||this._defaults[i]||null);tp_inst._defaults=$.extend({},this._defaults,inlineSettings,opts,overrides,{evnts:fns,timepicker:tp_inst}),tp_inst.amNames=$.map(tp_inst._defaults.amNames,function(a){return a.toUpperCase()}),tp_inst.pmNames=$.map(tp_inst._defaults.pmNames,function(a){return a.toUpperCase()}),tp_inst.support=detectSupport(tp_inst._defaults.timeFormat+(tp_inst._defaults.pickerTimeFormat?tp_inst._defaults.pickerTimeFormat:"")+(tp_inst._defaults.altTimeFormat?tp_inst._defaults.altTimeFormat:"")),"string"==typeof tp_inst._defaults.controlType?("slider"===tp_inst._defaults.controlType&&"undefined"==typeof $.ui.slider&&(tp_inst._defaults.controlType="select"),tp_inst.control=tp_inst._controls[tp_inst._defaults.controlType]):tp_inst.control=tp_inst._defaults.controlType;var timezoneList=[-720,-660,-600,-570,-540,-480,-420,-360,-300,-270,-240,-210,-180,-120,-60,0,60,120,180,210,240,270,300,330,345,360,390,420,480,525,540,570,600,630,660,690,720,765,780,840];null!==tp_inst._defaults.timezoneList&&(timezoneList=tp_inst._defaults.timezoneList);var tzl=timezoneList.length,tzi=0,tzv=null;if(tzl>0&&"object"!=typeof timezoneList[0])for(;tzl>tzi;tzi++)tzv=timezoneList[tzi],timezoneList[tzi]={value:tzv,label:$.timepicker.timezoneOffsetString(tzv,tp_inst.support.iso8601)};return tp_inst._defaults.timezoneList=timezoneList,tp_inst.timezone=null!==tp_inst._defaults.timezone?$.timepicker.timezoneOffsetNumber(tp_inst._defaults.timezone):-1*(new Date).getTimezoneOffset(),tp_inst.hour=tp_inst._defaults.hour<tp_inst._defaults.hourMin?tp_inst._defaults.hourMin:tp_inst._defaults.hour>tp_inst._defaults.hourMax?tp_inst._defaults.hourMax:tp_inst._defaults.hour,tp_inst.minute=tp_inst._defaults.minute<tp_inst._defaults.minuteMin?tp_inst._defaults.minuteMin:tp_inst._defaults.minute>tp_inst._defaults.minuteMax?tp_inst._defaults.minuteMax:tp_inst._defaults.minute,tp_inst.second=tp_inst._defaults.second<tp_inst._defaults.secondMin?tp_inst._defaults.secondMin:tp_inst._defaults.second>tp_inst._defaults.secondMax?tp_inst._defaults.secondMax:tp_inst._defaults.second,tp_inst.millisec=tp_inst._defaults.millisec<tp_inst._defaults.millisecMin?tp_inst._defaults.millisecMin:tp_inst._defaults.millisec>tp_inst._defaults.millisecMax?tp_inst._defaults.millisecMax:tp_inst._defaults.millisec,tp_inst.microsec=tp_inst._defaults.microsec<tp_inst._defaults.microsecMin?tp_inst._defaults.microsecMin:tp_inst._defaults.microsec>tp_inst._defaults.microsecMax?tp_inst._defaults.microsecMax:tp_inst._defaults.microsec,tp_inst.ampm="",tp_inst.$input=$input,tp_inst._defaults.altField&&(tp_inst.$altInput=$(tp_inst._defaults.altField),tp_inst._defaults.altRedirectFocus===!0&&tp_inst.$altInput.css({cursor:"pointer"}).focus(function(){$input.trigger("focus")})),(0===tp_inst._defaults.minDate||0===tp_inst._defaults.minDateTime)&&(tp_inst._defaults.minDate=new Date),(0===tp_inst._defaults.maxDate||0===tp_inst._defaults.maxDateTime)&&(tp_inst._defaults.maxDate=new Date),void 0!==tp_inst._defaults.minDate&&tp_inst._defaults.minDate instanceof Date&&(tp_inst._defaults.minDateTime=new Date(tp_inst._defaults.minDate.getTime())),void 0!==tp_inst._defaults.minDateTime&&tp_inst._defaults.minDateTime instanceof Date&&(tp_inst._defaults.minDate=new Date(tp_inst._defaults.minDateTime.getTime())),void 0!==tp_inst._defaults.maxDate&&tp_inst._defaults.maxDate instanceof Date&&(tp_inst._defaults.maxDateTime=new Date(tp_inst._defaults.maxDate.getTime())),void 0!==tp_inst._defaults.maxDateTime&&tp_inst._defaults.maxDateTime instanceof Date&&(tp_inst._defaults.maxDate=new Date(tp_inst._defaults.maxDateTime.getTime())),tp_inst.$input.bind("focus",function(){tp_inst._onFocus()}),tp_inst},_addTimePicker:function(a){var b=$.trim(this.$altInput&&this._defaults.altFieldTimeOnly?this.$input.val()+" "+this.$altInput.val():this.$input.val());this.timeDefined=this._parseTime(b),this._limitMinMaxDateTime(a,!1),this._injectTimePicker(),this._afterInject()},_parseTime:function(a,b){if(this.inst||(this.inst=$.datepicker._getInst(this.$input[0])),b||!this._defaults.timeOnly){var c=$.datepicker._get(this.inst,"dateFormat");try{var d=parseDateTimeInternal(c,this._defaults.timeFormat,a,$.datepicker._getFormatConfig(this.inst),this._defaults);if(!d.timeObj)return!1;$.extend(this,d.timeObj)}catch(e){return $.timepicker.log("Error parsing the date/time string: "+e+"\ndate/time string = "+a+"\ntimeFormat = "+this._defaults.timeFormat+"\ndateFormat = "+c),!1}return!0}var f=$.datepicker.parseTime(this._defaults.timeFormat,a,this._defaults);return f?($.extend(this,f),!0):!1},_afterInject:function(){var a=this.inst.settings;$.isFunction(a.afterInject)&&a.afterInject.call(this)},_injectTimePicker:function(){var a=this.inst.dpDiv,b=this.inst.settings,c=this,d="",e="",f=null,g={},h={},i=null,j=0,k=0;if(0===a.find("div.ui-timepicker-div").length&&b.showTimepicker){var l=" ui_tpicker_unit_hide",m='<div class="ui-timepicker-div'+(b.isRTL?" ui-timepicker-rtl":"")+(b.oneLine&&"select"===b.controlType?" ui-timepicker-oneLine":"")+'"><dl><dt class="ui_tpicker_time_label'+(b.showTime?"":l)+'">'+b.timeText+'</dt><dd class="ui_tpicker_time '+(b.showTime?"":l)+'"><input class="ui_tpicker_time_input" '+(b.timeInput?"":"disabled")+"/></dd>";for(j=0,k=this.units.length;k>j;j++){if(d=this.units[j],e=d.substr(0,1).toUpperCase()+d.substr(1),f=null!==b["show"+e]?b["show"+e]:this.support[d],g[d]=parseInt(b[d+"Max"]-(b[d+"Max"]-b[d+"Min"])%b["step"+e],10),h[d]=0,m+='<dt class="ui_tpicker_'+d+"_label"+(f?"":l)+'">'+b[d+"Text"]+'</dt><dd class="ui_tpicker_'+d+(f?"":l)+'"><div class="ui_tpicker_'+d+"_slider"+(f?"":l)+'"></div>',f&&b[d+"Grid"]>0){if(m+='<div style="padding-left: 1px"><table class="ui-tpicker-grid-label"><tr>',"hour"===d)for(var n=b[d+"Min"];n<=g[d];n+=parseInt(b[d+"Grid"],10)){h[d]++;var o=$.datepicker.formatTime(this.support.ampm?"hht":"HH",{hour:n},b);m+='<td data-for="'+d+'">'+o+"</td>"}else for(var p=b[d+"Min"];p<=g[d];p+=parseInt(b[d+"Grid"],10))h[d]++,m+='<td data-for="'+d+'">'+(10>p?"0":"")+p+"</td>";m+="</tr></table></div>"}m+="</dd>"}var q=null!==b.showTimezone?b.showTimezone:this.support.timezone;m+='<dt class="ui_tpicker_timezone_label'+(q?"":l)+'">'+b.timezoneText+"</dt>",m+='<dd class="ui_tpicker_timezone'+(q?"":l)+'"></dd>',m+="</dl></div>";var r=$(m);for(b.timeOnly===!0&&(r.prepend('<div class="ui-widget-header ui-helper-clearfix ui-corner-all"><div class="ui-datepicker-title">'+b.timeOnlyTitle+"</div></div>"),a.find(".ui-datepicker-header, .ui-datepicker-calendar").hide()),j=0,k=c.units.length;k>j;j++)d=c.units[j],e=d.substr(0,1).toUpperCase()+d.substr(1),f=null!==b["show"+e]?b["show"+e]:this.support[d],c[d+"_slider"]=c.control.create(c,r.find(".ui_tpicker_"+d+"_slider"),d,c[d],b[d+"Min"],g[d],b["step"+e]),f&&b[d+"Grid"]>0&&(i=100*h[d]*b[d+"Grid"]/(g[d]-b[d+"Min"]),r.find(".ui_tpicker_"+d+" table").css({width:i+"%",marginLeft:b.isRTL?"0":i/(-2*h[d])+"%",marginRight:b.isRTL?i/(-2*h[d])+"%":"0",borderCollapse:"collapse"}).find("td").click(function(a){var b=$(this),e=b.html(),f=parseInt(e.replace(/[^0-9]/g),10),g=e.replace(/[^apm]/gi),h=b.data("for");"hour"===h&&(-1!==g.indexOf("p")&&12>f?f+=12:-1!==g.indexOf("a")&&12===f&&(f=0)),c.control.value(c,c[h+"_slider"],d,f),c._onTimeChange(),c._onSelectHandler()}).css({cursor:"pointer",width:100/h[d]+"%",textAlign:"center",overflow:"hidden"}));if(this.timezone_select=r.find(".ui_tpicker_timezone").append("<select></select>").find("select"),$.fn.append.apply(this.timezone_select,$.map(b.timezoneList,function(a,b){return $("<option />").val("object"==typeof a?a.value:a).text("object"==typeof a?a.label:a)})),"undefined"!=typeof this.timezone&&null!==this.timezone&&""!==this.timezone){var s=-1*new Date(this.inst.selectedYear,this.inst.selectedMonth,this.inst.selectedDay,12).getTimezoneOffset();s===this.timezone?selectLocalTimezone(c):this.timezone_select.val(this.timezone)}else"undefined"!=typeof this.hour&&null!==this.hour&&""!==this.hour?this.timezone_select.val(b.timezone):selectLocalTimezone(c);this.timezone_select.change(function(){c._onTimeChange(),c._onSelectHandler(),c._afterInject()});var t=a.find(".ui-datepicker-buttonpane");if(t.length?t.before(r):a.append(r),this.$timeObj=r.find(".ui_tpicker_time_input"),this.$timeObj.change(function(){var a=c.inst.settings.timeFormat,b=$.datepicker.parseTime(a,this.value),d=new Date;b?(d.setHours(b.hour),d.setMinutes(b.minute),d.setSeconds(b.second),$.datepicker._setTime(c.inst,d)):(this.value=c.formattedTime,this.blur())}),null!==this.inst){var u=this.timeDefined;this._onTimeChange(),this.timeDefined=u}if(this._defaults.addSliderAccess){var v=this._defaults.sliderAccessArgs,w=this._defaults.isRTL;v.isRTL=w,setTimeout(function(){if(0===r.find(".ui-slider-access").length){r.find(".ui-slider:visible").sliderAccess(v);var a=r.find(".ui-slider-access:eq(0)").outerWidth(!0);a&&r.find("table:visible").each(function(){var b=$(this),c=b.outerWidth(),d=b.css(w?"marginRight":"marginLeft").toString().replace("%",""),e=c-a,f=d*e/c+"%",g={width:e,marginRight:0,marginLeft:0};g[w?"marginRight":"marginLeft"]=f,b.css(g)})}},10)}c._limitMinMaxDateTime(this.inst,!0)}},_limitMinMaxDateTime:function(a,b){var c=this._defaults,d=new Date(a.selectedYear,a.selectedMonth,a.selectedDay);if(this._defaults.showTimepicker){if(null!==$.datepicker._get(a,"minDateTime")&&void 0!==$.datepicker._get(a,"minDateTime")&&d){var e=$.datepicker._get(a,"minDateTime"),f=new Date(e.getFullYear(),e.getMonth(),e.getDate(),0,0,0,0);(null===this.hourMinOriginal||null===this.minuteMinOriginal||null===this.secondMinOriginal||null===this.millisecMinOriginal||null===this.microsecMinOriginal)&&(this.hourMinOriginal=c.hourMin,this.minuteMinOriginal=c.minuteMin,this.secondMinOriginal=c.secondMin,this.millisecMinOriginal=c.millisecMin,this.microsecMinOriginal=c.microsecMin),a.settings.timeOnly||f.getTime()===d.getTime()?(this._defaults.hourMin=e.getHours(),this.hour<=this._defaults.hourMin?(this.hour=this._defaults.hourMin,this._defaults.minuteMin=e.getMinutes(),this.minute<=this._defaults.minuteMin?(this.minute=this._defaults.minuteMin,this._defaults.secondMin=e.getSeconds(),this.second<=this._defaults.secondMin?(this.second=this._defaults.secondMin,this._defaults.millisecMin=e.getMilliseconds(),this.millisec<=this._defaults.millisecMin?(this.millisec=this._defaults.millisecMin,this._defaults.microsecMin=e.getMicroseconds()):(this.microsec<this._defaults.microsecMin&&(this.microsec=this._defaults.microsecMin),this._defaults.microsecMin=this.microsecMinOriginal)):(this._defaults.millisecMin=this.millisecMinOriginal,this._defaults.microsecMin=this.microsecMinOriginal)):(this._defaults.secondMin=this.secondMinOriginal,this._defaults.millisecMin=this.millisecMinOriginal,this._defaults.microsecMin=this.microsecMinOriginal)):(this._defaults.minuteMin=this.minuteMinOriginal,this._defaults.secondMin=this.secondMinOriginal,this._defaults.millisecMin=this.millisecMinOriginal,this._defaults.microsecMin=this.microsecMinOriginal)):(this._defaults.hourMin=this.hourMinOriginal,this._defaults.minuteMin=this.minuteMinOriginal,this._defaults.secondMin=this.secondMinOriginal,this._defaults.millisecMin=this.millisecMinOriginal,this._defaults.microsecMin=this.microsecMinOriginal)}if(null!==$.datepicker._get(a,"maxDateTime")&&void 0!==$.datepicker._get(a,"maxDateTime")&&d){var g=$.datepicker._get(a,"maxDateTime"),h=new Date(g.getFullYear(),g.getMonth(),g.getDate(),0,0,0,0);(null===this.hourMaxOriginal||null===this.minuteMaxOriginal||null===this.secondMaxOriginal||null===this.millisecMaxOriginal)&&(this.hourMaxOriginal=c.hourMax,this.minuteMaxOriginal=c.minuteMax,this.secondMaxOriginal=c.secondMax,this.millisecMaxOriginal=c.millisecMax,this.microsecMaxOriginal=c.microsecMax),a.settings.timeOnly||h.getTime()===d.getTime()?(this._defaults.hourMax=g.getHours(),this.hour>=this._defaults.hourMax?(this.hour=this._defaults.hourMax,this._defaults.minuteMax=g.getMinutes(),this.minute>=this._defaults.minuteMax?(this.minute=this._defaults.minuteMax,this._defaults.secondMax=g.getSeconds(),this.second>=this._defaults.secondMax?(this.second=this._defaults.secondMax,this._defaults.millisecMax=g.getMilliseconds(),this.millisec>=this._defaults.millisecMax?(this.millisec=this._defaults.millisecMax,this._defaults.microsecMax=g.getMicroseconds()):(this.microsec>this._defaults.microsecMax&&(this.microsec=this._defaults.microsecMax),this._defaults.microsecMax=this.microsecMaxOriginal)):(this._defaults.millisecMax=this.millisecMaxOriginal,this._defaults.microsecMax=this.microsecMaxOriginal)):(this._defaults.secondMax=this.secondMaxOriginal,this._defaults.millisecMax=this.millisecMaxOriginal,this._defaults.microsecMax=this.microsecMaxOriginal)):(this._defaults.minuteMax=this.minuteMaxOriginal,this._defaults.secondMax=this.secondMaxOriginal,this._defaults.millisecMax=this.millisecMaxOriginal,this._defaults.microsecMax=this.microsecMaxOriginal)):(this._defaults.hourMax=this.hourMaxOriginal,this._defaults.minuteMax=this.minuteMaxOriginal,this._defaults.secondMax=this.secondMaxOriginal,this._defaults.millisecMax=this.millisecMaxOriginal,this._defaults.microsecMax=this.microsecMaxOriginal)}if(null!==a.settings.minTime){var i=new Date("01/01/1970 "+a.settings.minTime);this.hour<i.getHours()?(this.hour=this._defaults.hourMin=i.getHours(),this.minute=this._defaults.minuteMin=i.getMinutes()):this.hour===i.getHours()&&this.minute<i.getMinutes()?this.minute=this._defaults.minuteMin=i.getMinutes():this._defaults.hourMin<i.getHours()?(this._defaults.hourMin=i.getHours(),this._defaults.minuteMin=i.getMinutes()):this._defaults.hourMin===i.getHours()===this.hour&&this._defaults.minuteMin<i.getMinutes()?this._defaults.minuteMin=i.getMinutes():this._defaults.minuteMin=0}if(null!==a.settings.maxTime){var j=new Date("01/01/1970 "+a.settings.maxTime);this.hour>j.getHours()?(this.hour=this._defaults.hourMax=j.getHours(),this.minute=this._defaults.minuteMax=j.getMinutes()):this.hour===j.getHours()&&this.minute>j.getMinutes()?this.minute=this._defaults.minuteMax=j.getMinutes():this._defaults.hourMax>j.getHours()?(this._defaults.hourMax=j.getHours(),this._defaults.minuteMax=j.getMinutes()):this._defaults.hourMax===j.getHours()===this.hour&&this._defaults.minuteMax>j.getMinutes()?this._defaults.minuteMax=j.getMinutes():this._defaults.minuteMax=59}if(void 0!==b&&b===!0){var k=parseInt(this._defaults.hourMax-(this._defaults.hourMax-this._defaults.hourMin)%this._defaults.stepHour,10),l=parseInt(this._defaults.minuteMax-(this._defaults.minuteMax-this._defaults.minuteMin)%this._defaults.stepMinute,10),m=parseInt(this._defaults.secondMax-(this._defaults.secondMax-this._defaults.secondMin)%this._defaults.stepSecond,10),n=parseInt(this._defaults.millisecMax-(this._defaults.millisecMax-this._defaults.millisecMin)%this._defaults.stepMillisec,10),o=parseInt(this._defaults.microsecMax-(this._defaults.microsecMax-this._defaults.microsecMin)%this._defaults.stepMicrosec,10);this.hour_slider&&(this.control.options(this,this.hour_slider,"hour",{min:this._defaults.hourMin,max:k,step:this._defaults.stepHour}),this.control.value(this,this.hour_slider,"hour",this.hour-this.hour%this._defaults.stepHour)),this.minute_slider&&(this.control.options(this,this.minute_slider,"minute",{min:this._defaults.minuteMin,max:l,step:this._defaults.stepMinute}),this.control.value(this,this.minute_slider,"minute",this.minute-this.minute%this._defaults.stepMinute)),this.second_slider&&(this.control.options(this,this.second_slider,"second",{min:this._defaults.secondMin,max:m,step:this._defaults.stepSecond}),this.control.value(this,this.second_slider,"second",this.second-this.second%this._defaults.stepSecond)),this.millisec_slider&&(this.control.options(this,this.millisec_slider,"millisec",{min:this._defaults.millisecMin,max:n,step:this._defaults.stepMillisec}),this.control.value(this,this.millisec_slider,"millisec",this.millisec-this.millisec%this._defaults.stepMillisec)),this.microsec_slider&&(this.control.options(this,this.microsec_slider,"microsec",{min:this._defaults.microsecMin,max:o,step:this._defaults.stepMicrosec}),this.control.value(this,this.microsec_slider,"microsec",this.microsec-this.microsec%this._defaults.stepMicrosec))}}},_onTimeChange:function(){if(this._defaults.showTimepicker){var a=this.hour_slider?this.control.value(this,this.hour_slider,"hour"):!1,b=this.minute_slider?this.control.value(this,this.minute_slider,"minute"):!1,c=this.second_slider?this.control.value(this,this.second_slider,"second"):!1,d=this.millisec_slider?this.control.value(this,this.millisec_slider,"millisec"):!1,e=this.microsec_slider?this.control.value(this,this.microsec_slider,"microsec"):!1,f=this.timezone_select?this.timezone_select.val():!1,g=this._defaults,h=g.pickerTimeFormat||g.timeFormat,i=g.pickerTimeSuffix||g.timeSuffix;"object"==typeof a&&(a=!1),"object"==typeof b&&(b=!1),"object"==typeof c&&(c=!1),"object"==typeof d&&(d=!1),"object"==typeof e&&(e=!1),"object"==typeof f&&(f=!1),a!==!1&&(a=parseInt(a,10)),b!==!1&&(b=parseInt(b,10)),c!==!1&&(c=parseInt(c,10)),d!==!1&&(d=parseInt(d,10)),e!==!1&&(e=parseInt(e,10)),f!==!1&&(f=f.toString());var j=g[12>a?"amNames":"pmNames"][0],k=a!==parseInt(this.hour,10)||b!==parseInt(this.minute,10)||c!==parseInt(this.second,10)||d!==parseInt(this.millisec,10)||e!==parseInt(this.microsec,10)||this.ampm.length>0&&12>a!=(-1!==$.inArray(this.ampm.toUpperCase(),this.amNames))||null!==this.timezone&&f!==this.timezone.toString();if(k&&(a!==!1&&(this.hour=a),b!==!1&&(this.minute=b),c!==!1&&(this.second=c),d!==!1&&(this.millisec=d),e!==!1&&(this.microsec=e),f!==!1&&(this.timezone=f),this.inst||(this.inst=$.datepicker._getInst(this.$input[0])),this._limitMinMaxDateTime(this.inst,!0)),this.support.ampm&&(this.ampm=j),this.formattedTime=$.datepicker.formatTime(g.timeFormat,this,g),this.$timeObj&&(this.$timeObj.val(h===g.timeFormat?this.formattedTime+i:$.datepicker.formatTime(h,this,g)+i),this.$timeObj[0].setSelectionRange)){var l=this.$timeObj[0].selectionStart,m=this.$timeObj[0].selectionEnd;this.$timeObj[0].setSelectionRange(l,m)}this.timeDefined=!0,k&&this._updateDateTime()}},_onSelectHandler:function(){var a=this._defaults.onSelect||this.inst.settings.onSelect,b=this.$input?this.$input[0]:null;a&&b&&a.apply(b,[this.formattedDateTime,this])},_updateDateTime:function(a){a=this.inst||a;var b=a.currentYear>0?new Date(a.currentYear,a.currentMonth,a.currentDay):new Date(a.selectedYear,a.selectedMonth,a.selectedDay),c=$.datepicker._daylightSavingAdjust(b),d=$.datepicker._get(a,"dateFormat"),e=$.datepicker._getFormatConfig(a),f=null!==c&&this.timeDefined;this.formattedDate=$.datepicker.formatDate(d,null===c?new Date:c,e);var g=this.formattedDate;if(""===a.lastVal&&(a.currentYear=a.selectedYear,a.currentMonth=a.selectedMonth,a.currentDay=a.selectedDay),this._defaults.timeOnly===!0&&this._defaults.timeOnlyShowDate===!1?g=this.formattedTime:(this._defaults.timeOnly!==!0&&(this._defaults.alwaysSetTime||f)||this._defaults.timeOnly===!0&&this._defaults.timeOnlyShowDate===!0)&&(g+=this._defaults.separator+this.formattedTime+this._defaults.timeSuffix),this.formattedDateTime=g,this._defaults.showTimepicker)if(this.$altInput&&this._defaults.timeOnly===!1&&this._defaults.altFieldTimeOnly===!0)this.$altInput.val(this.formattedTime),this.$input.val(this.formattedDate);else if(this.$altInput){this.$input.val(g);var h="",i=null!==this._defaults.altSeparator?this._defaults.altSeparator:this._defaults.separator,j=null!==this._defaults.altTimeSuffix?this._defaults.altTimeSuffix:this._defaults.timeSuffix;this._defaults.timeOnly||(h=this._defaults.altFormat?$.datepicker.formatDate(this._defaults.altFormat,null===c?new Date:c,e):this.formattedDate,h&&(h+=i)),h+=null!==this._defaults.altTimeFormat?$.datepicker.formatTime(this._defaults.altTimeFormat,this,this._defaults)+j:this.formattedTime+j,this.$altInput.val(h)}else this.$input.val(g);else this.$input.val(this.formattedDate);this.$input.trigger("change")},_onFocus:function(){if(!this.$input.val()&&this._defaults.defaultValue){this.$input.val(this._defaults.defaultValue);var a=$.datepicker._getInst(this.$input.get(0)),b=$.datepicker._get(a,"timepicker");if(b&&b._defaults.timeOnly&&a.input.val()!==a.lastVal)try{$.datepicker._updateDatepicker(a)}catch(c){$.timepicker.log(c)}}},_controls:{slider:{create:function(a,b,c,d,e,f,g){var h=a._defaults.isRTL;return b.prop("slide",null).slider({orientation:"horizontal",value:h?-1*d:d,min:h?-1*f:e,max:h?-1*e:f,step:g,slide:function(b,d){a.control.value(a,$(this),c,h?-1*d.value:d.value),a._onTimeChange()},stop:function(b,c){a._onSelectHandler()}})},options:function(a,b,c,d,e){if(a._defaults.isRTL){if("string"==typeof d)return"min"===d||"max"===d?void 0!==e?b.slider(d,-1*e):Math.abs(b.slider(d)):b.slider(d);var f=d.min,g=d.max;return d.min=d.max=null,void 0!==f&&(d.max=-1*f),void 0!==g&&(d.min=-1*g),b.slider(d)}return"string"==typeof d&&void 0!==e?b.slider(d,e):b.slider(d)},value:function(a,b,c,d){return a._defaults.isRTL?void 0!==d?b.slider("value",-1*d):Math.abs(b.slider("value")):void 0!==d?b.slider("value",d):b.slider("value")}},select:{create:function(a,b,c,d,e,f,g){for(var h='<select class="ui-timepicker-select ui-state-default ui-corner-all" data-unit="'+c+'" data-min="'+e+'" data-max="'+f+'" data-step="'+g+'">',i=a._defaults.pickerTimeFormat||a._defaults.timeFormat,j=e;f>=j;j+=g)h+='<option value="'+j+'"'+(j===d?" selected":"")+">",h+="hour"===c?$.datepicker.formatTime($.trim(i.replace(/[^ht ]/gi,"")),{hour:j},a._defaults):"millisec"===c||"microsec"===c||j>=10?j:"0"+j.toString(),h+="</option>";return h+="</select>",b.children("select").remove(),$(h).appendTo(b).change(function(b){a._onTimeChange(),a._onSelectHandler(),a._afterInject()}),b},options:function(a,b,c,d,e){var f={},g=b.children("select");if("string"==typeof d){if(void 0===e)return g.data(d);f[d]=e}else f=d;return a.control.create(a,b,g.data("unit"),g.val(),f.min>=0?f.min:g.data("min"),f.max||g.data("max"),f.step||g.data("step"))},value:function(a,b,c,d){var e=b.children("select");return void 0!==d?e.val(d):e.val()}}}}),$.fn.extend({timepicker:function(a){a=a||{};var b=Array.prototype.slice.call(arguments);return"object"==typeof a&&(b[0]=$.extend(a,{timeOnly:!0})),$(this).each(function(){$.fn.datetimepicker.apply($(this),b)})},datetimepicker:function(a){a=a||{};var b=arguments;return"string"==typeof a?"getDate"===a||"option"===a&&2===b.length&&"string"==typeof b[1]?$.fn.datepicker.apply($(this[0]),b):this.each(function(){var a=$(this);a.datepicker.apply(a,b)}):this.each(function(){var b=$(this);b.datepicker($.timepicker._newInst(b,a)._defaults)})}}),$.datepicker.parseDateTime=function(a,b,c,d,e){var f=parseDateTimeInternal(a,b,c,d,e);if(f.timeObj){var g=f.timeObj;f.date.setHours(g.hour,g.minute,g.second,g.millisec),f.date.setMicroseconds(g.microsec)}return f.date},$.datepicker.parseTime=function(a,b,c){var d=extendRemove(extendRemove({},$.timepicker._defaults),c||{}),e=(-1!==a.replace(/\'.*?\'/g,"").indexOf("Z"),function(a,b,c){var d,e=function(a,b){var c=[];return a&&$.merge(c,a),b&&$.merge(c,b),c=$.map(c,function(a){return a.replace(/[.*+?|()\[\]{}\\]/g,"\\$&")}),"("+c.join("|")+")?"},f=function(a){var b=a.toLowerCase().match(/(h{1,2}|m{1,2}|s{1,2}|l{1}|c{1}|t{1,2}|z|'.*?')/g),c={h:-1,m:-1,s:-1,l:-1,c:-1,t:-1,z:-1};if(b)for(var d=0;d<b.length;d++)-1===c[b[d].toString().charAt(0)]&&(c[b[d].toString().charAt(0)]=d+1);return c},g="^"+a.toString().replace(/([hH]{1,2}|mm?|ss?|[tT]{1,2}|[zZ]|[lc]|'.*?')/g,function(a){var b=a.length;switch(a.charAt(0).toLowerCase()){case"h":return 1===b?"(\\d?\\d)":"(\\d{"+b+"})";case"m":return 1===b?"(\\d?\\d)":"(\\d{"+b+"})";case"s":return 1===b?"(\\d?\\d)":"(\\d{"+b+"})";case"l":return"(\\d?\\d?\\d)";case"c":return"(\\d?\\d?\\d)";case"z":return"(z|[-+]\\d\\d:?\\d\\d|\\S+)?";case"t":return e(c.amNames,c.pmNames);default:return"("+a.replace(/\'/g,"").replace(/(\.|\$|\^|\\|\/|\(|\)|\[|\]|\?|\+|\*)/g,function(a){return"\\"+a})+")?"}}).replace(/\s/g,"\\s?")+c.timeSuffix+"$",h=f(a),i="";d=b.match(new RegExp(g,"i"));var j={hour:0,minute:0,second:0,millisec:0,microsec:0};return d?(-1!==h.t&&(void 0===d[h.t]||0===d[h.t].length?(i="",j.ampm=""):(i=-1!==$.inArray(d[h.t].toUpperCase(),$.map(c.amNames,function(a,b){return a.toUpperCase()}))?"AM":"PM",j.ampm=c["AM"===i?"amNames":"pmNames"][0])),-1!==h.h&&("AM"===i&&"12"===d[h.h]?j.hour=0:"PM"===i&&"12"!==d[h.h]?j.hour=parseInt(d[h.h],10)+12:j.hour=Number(d[h.h])),-1!==h.m&&(j.minute=Number(d[h.m])),-1!==h.s&&(j.second=Number(d[h.s])),-1!==h.l&&(j.millisec=Number(d[h.l])),-1!==h.c&&(j.microsec=Number(d[h.c])),-1!==h.z&&void 0!==d[h.z]&&(j.timezone=$.timepicker.timezoneOffsetNumber(d[h.z])),j):!1}),f=function(a,b,c){try{var d=new Date("2012-01-01 "+b);if(isNaN(d.getTime())&&(d=new Date("2012-01-01T"+b),isNaN(d.getTime())&&(d=new Date("01/01/2012 "+b),isNaN(d.getTime()))))throw"Unable to parse time with native Date: "+b;return{hour:d.getHours(),minute:d.getMinutes(),second:d.getSeconds(),millisec:d.getMilliseconds(),microsec:d.getMicroseconds(),timezone:-1*d.getTimezoneOffset()}}catch(f){try{return e(a,b,c)}catch(g){$.timepicker.log("Unable to parse \ntimeString: "+b+"\ntimeFormat: "+a)}}return!1};return"function"==typeof d.parse?d.parse(a,b,d):"loose"===d.parse?f(a,b,d):e(a,b,d)},$.datepicker.formatTime=function(a,b,c){c=c||{},c=$.extend({},$.timepicker._defaults,c),b=$.extend({hour:0,minute:0,second:0,millisec:0,microsec:0,timezone:null},b);var d=a,e=c.amNames[0],f=parseInt(b.hour,10);return f>11&&(e=c.pmNames[0]),d=d.replace(/(?:HH?|hh?|mm?|ss?|[tT]{1,2}|[zZ]|[lc]|'.*?')/g,function(a){switch(a){case"HH":return("0"+f).slice(-2);case"H":return f;case"hh":return("0"+convert24to12(f)).slice(-2);case"h":return convert24to12(f);case"mm":return("0"+b.minute).slice(-2);case"m":return b.minute;case"ss":return("0"+b.second).slice(-2);case"s":return b.second;case"l":return("00"+b.millisec).slice(-3);case"c":return("00"+b.microsec).slice(-3);case"z":return $.timepicker.timezoneOffsetString(null===b.timezone?c.timezone:b.timezone,!1);case"Z":return $.timepicker.timezoneOffsetString(null===b.timezone?c.timezone:b.timezone,!0);case"T":return e.charAt(0).toUpperCase();case"TT":return e.toUpperCase();case"t":return e.charAt(0).toLowerCase();case"tt":return e.toLowerCase();default:return a.replace(/'/g,"")}})},$.datepicker._base_selectDate=$.datepicker._selectDate,$.datepicker._selectDate=function(a,b){var c,d=this._getInst($(a)[0]),e=this._get(d,"timepicker");e&&d.settings.showTimepicker?(e._limitMinMaxDateTime(d,!0),c=d.inline,d.inline=d.stay_open=!0,this._base_selectDate(a,b),d.inline=c,d.stay_open=!1,this._notifyChange(d),this._updateDatepicker(d)):this._base_selectDate(a,b)},$.datepicker._base_updateDatepicker=$.datepicker._updateDatepicker,$.datepicker._updateDatepicker=function(a){var b=a.input[0];if(!($.datepicker._curInst&&$.datepicker._curInst!==a&&$.datepicker._datepickerShowing&&$.datepicker._lastInput!==b||"boolean"==typeof a.stay_open&&a.stay_open!==!1)){this._base_updateDatepicker(a);var c=this._get(a,"timepicker");c&&c._addTimePicker(a)}},$.datepicker._base_doKeyPress=$.datepicker._doKeyPress,$.datepicker._doKeyPress=function(a){var b=$.datepicker._getInst(a.target),c=$.datepicker._get(b,"timepicker");if(c&&$.datepicker._get(b,"constrainInput")){var d=c.support.ampm,e=null!==c._defaults.showTimezone?c._defaults.showTimezone:c.support.timezone,f=$.datepicker._possibleChars($.datepicker._get(b,"dateFormat")),g=c._defaults.timeFormat.toString().replace(/[hms]/g,"").replace(/TT/g,d?"APM":"").replace(/Tt/g,d?"AaPpMm":"").replace(/tT/g,d?"AaPpMm":"").replace(/T/g,d?"AP":"").replace(/tt/g,d?"apm":"").replace(/t/g,d?"ap":"")+" "+c._defaults.separator+c._defaults.timeSuffix+(e?c._defaults.timezoneList.join(""):"")+c._defaults.amNames.join("")+c._defaults.pmNames.join("")+f,h=String.fromCharCode(void 0===a.charCode?a.keyCode:a.charCode);return a.ctrlKey||" ">h||!f||g.indexOf(h)>-1}return $.datepicker._base_doKeyPress(a)},$.datepicker._base_updateAlternate=$.datepicker._updateAlternate,$.datepicker._updateAlternate=function(a){var b=this._get(a,"timepicker");if(b){var c=b._defaults.altField;if(c){var d=(b._defaults.altFormat||b._defaults.dateFormat,this._getDate(a)),e=$.datepicker._getFormatConfig(a),f="",g=b._defaults.altSeparator?b._defaults.altSeparator:b._defaults.separator,h=b._defaults.altTimeSuffix?b._defaults.altTimeSuffix:b._defaults.timeSuffix,i=null!==b._defaults.altTimeFormat?b._defaults.altTimeFormat:b._defaults.timeFormat;f+=$.datepicker.formatTime(i,b,b._defaults)+h,b._defaults.timeOnly||b._defaults.altFieldTimeOnly||null===d||(f=b._defaults.altFormat?$.datepicker.formatDate(b._defaults.altFormat,d,e)+g+f:b.formattedDate+g+f),$(c).val(a.input.val()?f:"")}}else $.datepicker._base_updateAlternate(a)},$.datepicker._base_doKeyUp=$.datepicker._doKeyUp,$.datepicker._doKeyUp=function(a){var b=$.datepicker._getInst(a.target),c=$.datepicker._get(b,"timepicker");
if(c&&c._defaults.timeOnly&&b.input.val()!==b.lastVal)try{$.datepicker._updateDatepicker(b)}catch(d){$.timepicker.log(d)}return $.datepicker._base_doKeyUp(a)},$.datepicker._base_gotoToday=$.datepicker._gotoToday,$.datepicker._gotoToday=function(a){var b=this._getInst($(a)[0]);this._base_gotoToday(a);var c=this._get(b,"timepicker");if(c){var d=$.timepicker.timezoneOffsetNumber(c.timezone),e=new Date;e.setMinutes(e.getMinutes()+e.getTimezoneOffset()+parseInt(d,10)),this._setTime(b,e),this._setDate(b,e),c._onSelectHandler()}},$.datepicker._disableTimepickerDatepicker=function(a){var b=this._getInst(a);if(b){var c=this._get(b,"timepicker");$(a).datepicker("getDate"),c&&(b.settings.showTimepicker=!1,c._defaults.showTimepicker=!1,c._updateDateTime(b))}},$.datepicker._enableTimepickerDatepicker=function(a){var b=this._getInst(a);if(b){var c=this._get(b,"timepicker");$(a).datepicker("getDate"),c&&(b.settings.showTimepicker=!0,c._defaults.showTimepicker=!0,c._addTimePicker(b),c._updateDateTime(b))}},$.datepicker._setTime=function(a,b){var c=this._get(a,"timepicker");if(c){var d=c._defaults;c.hour=b?b.getHours():d.hour,c.minute=b?b.getMinutes():d.minute,c.second=b?b.getSeconds():d.second,c.millisec=b?b.getMilliseconds():d.millisec,c.microsec=b?b.getMicroseconds():d.microsec,c._limitMinMaxDateTime(a,!0),c._onTimeChange(),c._updateDateTime(a)}},$.datepicker._setTimeDatepicker=function(a,b,c){var d=this._getInst(a);if(d){var e=this._get(d,"timepicker");if(e){this._setDateFromField(d);var f;b&&("string"==typeof b?(e._parseTime(b,c),f=new Date,f.setHours(e.hour,e.minute,e.second,e.millisec),f.setMicroseconds(e.microsec)):(f=new Date(b.getTime()),f.setMicroseconds(b.getMicroseconds())),"Invalid Date"===f.toString()&&(f=void 0),this._setTime(d,f))}}},$.datepicker._base_setDateDatepicker=$.datepicker._setDateDatepicker,$.datepicker._setDateDatepicker=function(a,b){var c=this._getInst(a),d=b;if(c){"string"==typeof b&&(d=new Date(b),d.getTime()||(this._base_setDateDatepicker.apply(this,arguments),d=$(a).datepicker("getDate")));var e,f=this._get(c,"timepicker");d instanceof Date?(e=new Date(d.getTime()),e.setMicroseconds(d.getMicroseconds())):e=d,f&&e&&(f.support.timezone||null!==f._defaults.timezone||(f.timezone=-1*e.getTimezoneOffset()),d=$.timepicker.timezoneAdjust(d,$.timepicker.timezoneOffsetString(-d.getTimezoneOffset()),f.timezone),e=$.timepicker.timezoneAdjust(e,$.timepicker.timezoneOffsetString(-e.getTimezoneOffset()),f.timezone)),this._updateDatepicker(c),this._base_setDateDatepicker.apply(this,arguments),this._setTimeDatepicker(a,e,!0)}},$.datepicker._base_getDateDatepicker=$.datepicker._getDateDatepicker,$.datepicker._getDateDatepicker=function(a,b){var c=this._getInst(a);if(c){var d=this._get(c,"timepicker");if(d){void 0===c.lastVal&&this._setDateFromField(c,b);var e=this._getDate(c),f=null;return f=d.$altInput&&d._defaults.altFieldTimeOnly?d.$input.val()+" "+d.$altInput.val():"INPUT"!==d.$input.get(0).tagName&&d.$altInput?d.$altInput.val():d.$input.val(),e&&d._parseTime(f,!c.settings.timeOnly)&&(e.setHours(d.hour,d.minute,d.second,d.millisec),e.setMicroseconds(d.microsec),null!=d.timezone&&(d.support.timezone||null!==d._defaults.timezone||(d.timezone=-1*e.getTimezoneOffset()),e=$.timepicker.timezoneAdjust(e,d.timezone,$.timepicker.timezoneOffsetString(-e.getTimezoneOffset())))),e}return this._base_getDateDatepicker(a,b)}},$.datepicker._base_parseDate=$.datepicker.parseDate,$.datepicker.parseDate=function(a,b,c){var d;try{d=this._base_parseDate(a,b,c)}catch(e){if(!(e.indexOf(":")>=0))throw e;d=this._base_parseDate(a,b.substring(0,b.length-(e.length-e.indexOf(":")-2)),c),$.timepicker.log("Error parsing the date string: "+e+"\ndate string = "+b+"\ndate format = "+a)}return d},$.datepicker._base_formatDate=$.datepicker._formatDate,$.datepicker._formatDate=function(a,b,c,d){var e=this._get(a,"timepicker");return e?(e._updateDateTime(a),e.$input.val()):this._base_formatDate(a)},$.datepicker._base_optionDatepicker=$.datepicker._optionDatepicker,$.datepicker._optionDatepicker=function(a,b,c){var d,e=this._getInst(a);if(!e)return null;var f=this._get(e,"timepicker");if(f){var g,h,i,j,k=null,l=null,m=null,n=f._defaults.evnts,o={};if("string"==typeof b){if("minDate"===b||"minDateTime"===b)k=c;else if("maxDate"===b||"maxDateTime"===b)l=c;else if("onSelect"===b)m=c;else if(n.hasOwnProperty(b)){if("undefined"==typeof c)return n[b];o[b]=c,d={}}}else if("object"==typeof b){b.minDate?k=b.minDate:b.minDateTime?k=b.minDateTime:b.maxDate?l=b.maxDate:b.maxDateTime&&(l=b.maxDateTime);for(g in n)n.hasOwnProperty(g)&&b[g]&&(o[g]=b[g])}for(g in o)o.hasOwnProperty(g)&&(n[g]=o[g],d||(d=$.extend({},b)),delete d[g]);if(d&&isEmptyObject(d))return;if(k?(k=0===k?new Date:new Date(k),f._defaults.minDate=k,f._defaults.minDateTime=k):l?(l=0===l?new Date:new Date(l),f._defaults.maxDate=l,f._defaults.maxDateTime=l):m&&(f._defaults.onSelect=m),k||l)return j=$(a),i=j.datetimepicker("getDate"),h=this._base_optionDatepicker.call($.datepicker,a,d||b,c),j.datetimepicker("setDate",i),h}return void 0===c?this._base_optionDatepicker.call($.datepicker,a,b):this._base_optionDatepicker.call($.datepicker,a,d||b,c)};var isEmptyObject=function(a){var b;for(b in a)if(a.hasOwnProperty(b))return!1;return!0},extendRemove=function(a,b){$.extend(a,b);for(var c in b)(null===b[c]||void 0===b[c])&&(a[c]=b[c]);return a},detectSupport=function(a){var b=a.replace(/'.*?'/g,"").toLowerCase(),c=function(a,b){return-1!==a.indexOf(b)?!0:!1};return{hour:c(b,"h"),minute:c(b,"m"),second:c(b,"s"),millisec:c(b,"l"),microsec:c(b,"c"),timezone:c(b,"z"),ampm:c(b,"t")&&c(a,"h"),iso8601:c(a,"Z")}},convert24to12=function(a){return a%=12,0===a&&(a=12),String(a)},computeEffectiveSetting=function(a,b){return a&&a[b]?a[b]:$.timepicker._defaults[b]},splitDateTime=function(a,b){var c=computeEffectiveSetting(b,"separator"),d=computeEffectiveSetting(b,"timeFormat"),e=d.split(c),f=e.length,g=a.split(c),h=g.length;return h>1?{dateString:g.splice(0,h-f).join(c),timeString:g.splice(0,f).join(c)}:{dateString:a,timeString:""}},parseDateTimeInternal=function(a,b,c,d,e){var f,g,h;if(g=splitDateTime(c,e),f=$.datepicker._base_parseDate(a,g.dateString,d),""===g.timeString)return{date:f};if(h=$.datepicker.parseTime(b,g.timeString,e),!h)throw"Wrong time format";return{date:f,timeObj:h}},selectLocalTimezone=function(a,b){if(a&&a.timezone_select){var c=b||new Date;a.timezone_select.val(-c.getTimezoneOffset())}};$.timepicker=new Timepicker,$.timepicker.timezoneOffsetString=function(a,b){if(isNaN(a)||a>840||-720>a)return a;var c=a,d=c%60,e=(c-d)/60,f=b?":":"",g=(c>=0?"+":"-")+("0"+Math.abs(e)).slice(-2)+f+("0"+Math.abs(d)).slice(-2);return"+00:00"===g?"Z":g},$.timepicker.timezoneOffsetNumber=function(a){var b=a.toString().replace(":","");return"Z"===b.toUpperCase()?0:/^(\-|\+)\d{4}$/.test(b)?("-"===b.substr(0,1)?-1:1)*(60*parseInt(b.substr(1,2),10)+parseInt(b.substr(3,2),10)):parseInt(a,10)},$.timepicker.timezoneAdjust=function(a,b,c){var d=$.timepicker.timezoneOffsetNumber(b),e=$.timepicker.timezoneOffsetNumber(c);return isNaN(e)||a.setMinutes(a.getMinutes()+-d- -e),a},$.timepicker.timeRange=function(a,b,c){return $.timepicker.handleRange("timepicker",a,b,c)},$.timepicker.datetimeRange=function(a,b,c){$.timepicker.handleRange("datetimepicker",a,b,c)},$.timepicker.dateRange=function(a,b,c){$.timepicker.handleRange("datepicker",a,b,c)},$.timepicker.handleRange=function(a,b,c,d){function e(e,f){var g=b[a]("getDate"),h=c[a]("getDate"),i=e[a]("getDate");if(null!==g){var j=new Date(g.getTime()),k=new Date(g.getTime());j.setMilliseconds(j.getMilliseconds()+d.minInterval),k.setMilliseconds(k.getMilliseconds()+d.maxInterval),d.minInterval>0&&j>h?c[a]("setDate",j):d.maxInterval>0&&h>k?c[a]("setDate",k):g>h&&f[a]("setDate",i)}}function f(b,c,e){if(b.val()){var f=b[a].call(b,"getDate");null!==f&&d.minInterval>0&&("minDate"===e&&f.setMilliseconds(f.getMilliseconds()+d.minInterval),"maxDate"===e&&f.setMilliseconds(f.getMilliseconds()-d.minInterval)),f.getTime&&c[a].call(c,"option",e,f)}}d=$.extend({},{minInterval:0,maxInterval:0,start:{},end:{}},d);var g=!1;return"timepicker"===a&&(g=!0,a="datetimepicker"),$.fn[a].call(b,$.extend({timeOnly:g,onClose:function(a,b){e($(this),c)},onSelect:function(a){f($(this),c,"minDate")}},d,d.start)),$.fn[a].call(c,$.extend({timeOnly:g,onClose:function(a,c){e($(this),b)},onSelect:function(a){f($(this),b,"maxDate")}},d,d.end)),e(b,c),f(b,c,"minDate"),f(c,b,"maxDate"),$([b.get(0),c.get(0)])},$.timepicker.log=function(){window.console&&window.console.log&&window.console.log.apply&&window.console.log.apply(window.console,Array.prototype.slice.call(arguments))},$.timepicker._util={_extendRemove:extendRemove,_isEmptyObject:isEmptyObject,_convert24to12:convert24to12,_detectSupport:detectSupport,_selectLocalTimezone:selectLocalTimezone,_computeEffectiveSetting:computeEffectiveSetting,_splitDateTime:splitDateTime,_parseDateTimeInternal:parseDateTimeInternal},Date.prototype.getMicroseconds||(Date.prototype.microseconds=0,Date.prototype.getMicroseconds=function(){return this.microseconds},Date.prototype.setMicroseconds=function(a){return this.setMilliseconds(this.getMilliseconds()+Math.floor(a/1e3)),this.microseconds=a%1e3,this}),$.timepicker.version="1.6.3"}});
/*! jQuery Validation Plugin - v1.14.0 - 6/30/2015
 * http://jqueryvalidation.org/
 * Copyright (c) 2015 Jörn Zaefferer; Licensed MIT */
!function(a){"function"==typeof define&&define.amd?define(["jquery"],a):a(jQuery)}(function(a){a.extend(a.fn,{validate:function(b){if(!this.length)return void(b&&b.debug&&window.console&&console.warn("Nothing selected, can't validate, returning nothing."));var c=a.data(this[0],"validator");return c?c:(this.attr("novalidate","novalidate"),c=new a.validator(b,this[0]),a.data(this[0],"validator",c),c.settings.onsubmit&&(this.on("click.validate",":submit",function(b){c.settings.submitHandler&&(c.submitButton=b.target),a(this).hasClass("cancel")&&(c.cancelSubmit=!0),void 0!==a(this).attr("formnovalidate")&&(c.cancelSubmit=!0)}),this.on("submit.validate",function(b){function d(){var d,e;return c.settings.submitHandler?(c.submitButton&&(d=a("<input type='hidden'/>").attr("name",c.submitButton.name).val(a(c.submitButton).val()).appendTo(c.currentForm)),e=c.settings.submitHandler.call(c,c.currentForm,b),c.submitButton&&d.remove(),void 0!==e?e:!1):!0}return c.settings.debug&&b.preventDefault(),c.cancelSubmit?(c.cancelSubmit=!1,d()):c.form()?c.pendingRequest?(c.formSubmitted=!0,!1):d():(c.focusInvalid(),!1)})),c)},valid:function(){var b,c,d;return a(this[0]).is("form")?b=this.validate().form():(d=[],b=!0,c=a(this[0].form).validate(),this.each(function(){b=c.element(this)&&b,d=d.concat(c.errorList)}),c.errorList=d),b},rules:function(b,c){var d,e,f,g,h,i,j=this[0];if(b)switch(d=a.data(j.form,"validator").settings,e=d.rules,f=a.validator.staticRules(j),b){case"add":a.extend(f,a.validator.normalizeRule(c)),delete f.messages,e[j.name]=f,c.messages&&(d.messages[j.name]=a.extend(d.messages[j.name],c.messages));break;case"remove":return c?(i={},a.each(c.split(/\s/),function(b,c){i[c]=f[c],delete f[c],"required"===c&&a(j).removeAttr("aria-required")}),i):(delete e[j.name],f)}return g=a.validator.normalizeRules(a.extend({},a.validator.classRules(j),a.validator.attributeRules(j),a.validator.dataRules(j),a.validator.staticRules(j)),j),g.required&&(h=g.required,delete g.required,g=a.extend({required:h},g),a(j).attr("aria-required","true")),g.remote&&(h=g.remote,delete g.remote,g=a.extend(g,{remote:h})),g}}),a.extend(a.expr[":"],{blank:function(b){return!a.trim(""+a(b).val())},filled:function(b){return!!a.trim(""+a(b).val())},unchecked:function(b){return!a(b).prop("checked")}}),a.validator=function(b,c){this.settings=a.extend(!0,{},a.validator.defaults,b),this.currentForm=c,this.init()},a.validator.format=function(b,c){return 1===arguments.length?function(){var c=a.makeArray(arguments);return c.unshift(b),a.validator.format.apply(this,c)}:(arguments.length>2&&c.constructor!==Array&&(c=a.makeArray(arguments).slice(1)),c.constructor!==Array&&(c=[c]),a.each(c,function(a,c){b=b.replace(new RegExp("\\{"+a+"\\}","g"),function(){return c})}),b)},a.extend(a.validator,{defaults:{messages:{},groups:{},rules:{},errorClass:"error",validClass:"valid",errorElement:"label",focusCleanup:!1,focusInvalid:!0,errorContainer:a([]),errorLabelContainer:a([]),onsubmit:!0,ignore:":hidden",ignoreTitle:!1,onfocusin:function(a){this.lastActive=a,this.settings.focusCleanup&&(this.settings.unhighlight&&this.settings.unhighlight.call(this,a,this.settings.errorClass,this.settings.validClass),this.hideThese(this.errorsFor(a)))},onfocusout:function(a){this.checkable(a)||!(a.name in this.submitted)&&this.optional(a)||this.element(a)},onkeyup:function(b,c){var d=[16,17,18,20,35,36,37,38,39,40,45,144,225];9===c.which&&""===this.elementValue(b)||-1!==a.inArray(c.keyCode,d)||(b.name in this.submitted||b===this.lastElement)&&this.element(b)},onclick:function(a){a.name in this.submitted?this.element(a):a.parentNode.name in this.submitted&&this.element(a.parentNode)},highlight:function(b,c,d){"radio"===b.type?this.findByName(b.name).addClass(c).removeClass(d):a(b).addClass(c).removeClass(d)},unhighlight:function(b,c,d){"radio"===b.type?this.findByName(b.name).removeClass(c).addClass(d):a(b).removeClass(c).addClass(d)}},setDefaults:function(b){a.extend(a.validator.defaults,b)},messages:{required:"This field is required.",remote:"Please fix this field.",email:"S'il vous plaît, mettez une adresse email valide.",url:"Please enter a valid URL.",date:"Please enter a valid date.",dateISO:"Please enter a valid date ( ISO ).",number:"Please enter a valid number.",digits:"Please enter only digits.",creditcard:"Please enter a valid credit card number.",equalTo:"Please enter the same value again.",maxlength:a.validator.format("Please enter no more than {0} characters."),minlength:a.validator.format("Please enter at least {0} characters."),rangelength:a.validator.format("Please enter a value between {0} and {1} characters long."),range:a.validator.format("Please enter a value between {0} and {1}."),max:a.validator.format("Please enter a value less than or equal to {0}."),min:a.validator.format("Please enter a value greater than or equal to {0}.")},autoCreateRanges:!1,prototype:{init:function(){function b(b){var c=a.data(this.form,"validator"),d="on"+b.type.replace(/^validate/,""),e=c.settings;e[d]&&!a(this).is(e.ignore)&&e[d].call(c,this,b)}this.labelContainer=a(this.settings.errorLabelContainer),this.errorContext=this.labelContainer.length&&this.labelContainer||a(this.currentForm),this.containers=a(this.settings.errorContainer).add(this.settings.errorLabelContainer),this.submitted={},this.valueCache={},this.pendingRequest=0,this.pending={},this.invalid={},this.reset();var c,d=this.groups={};a.each(this.settings.groups,function(b,c){"string"==typeof c&&(c=c.split(/\s/)),a.each(c,function(a,c){d[c]=b})}),c=this.settings.rules,a.each(c,function(b,d){c[b]=a.validator.normalizeRule(d)}),a(this.currentForm).on("focusin.validate focusout.validate keyup.validate",":text, [type='password'], [type='file'], select, textarea, [type='number'], [type='search'], [type='tel'], [type='url'], [type='email'], [type='datetime'], [type='date'], [type='month'], [type='week'], [type='time'], [type='datetime-local'], [type='range'], [type='color'], [type='radio'], [type='checkbox']",b).on("click.validate","select, option, [type='radio'], [type='checkbox']",b),this.settings.invalidHandler&&a(this.currentForm).on("invalid-form.validate",this.settings.invalidHandler),a(this.currentForm).find("[required], [data-rule-required], .required").attr("aria-required","true")},form:function(){return this.checkForm(),a.extend(this.submitted,this.errorMap),this.invalid=a.extend({},this.errorMap),this.valid()||a(this.currentForm).triggerHandler("invalid-form",[this]),this.showErrors(),this.valid()},checkForm:function(){this.prepareForm();for(var a=0,b=this.currentElements=this.elements();b[a];a++)this.check(b[a]);return this.valid()},element:function(b){var c=this.clean(b),d=this.validationTargetFor(c),e=!0;return this.lastElement=d,void 0===d?delete this.invalid[c.name]:(this.prepareElement(d),this.currentElements=a(d),e=this.check(d)!==!1,e?delete this.invalid[d.name]:this.invalid[d.name]=!0),a(b).attr("aria-invalid",!e),this.numberOfInvalids()||(this.toHide=this.toHide.add(this.containers)),this.showErrors(),e},showErrors:function(b){if(b){a.extend(this.errorMap,b),this.errorList=[];for(var c in b)this.errorList.push({message:b[c],element:this.findByName(c)[0]});this.successList=a.grep(this.successList,function(a){return!(a.name in b)})}this.settings.showErrors?this.settings.showErrors.call(this,this.errorMap,this.errorList):this.defaultShowErrors()},resetForm:function(){a.fn.resetForm&&a(this.currentForm).resetForm(),this.submitted={},this.lastElement=null,this.prepareForm(),this.hideErrors();var b,c=this.elements().removeData("previousValue").removeAttr("aria-invalid");if(this.settings.unhighlight)for(b=0;c[b];b++)this.settings.unhighlight.call(this,c[b],this.settings.errorClass,"");else c.removeClass(this.settings.errorClass)},numberOfInvalids:function(){return this.objectLength(this.invalid)},objectLength:function(a){var b,c=0;for(b in a)c++;return c},hideErrors:function(){this.hideThese(this.toHide)},hideThese:function(a){a.not(this.containers).text(""),this.addWrapper(a).hide()},valid:function(){return 0===this.size()},size:function(){return this.errorList.length},focusInvalid:function(){if(this.settings.focusInvalid)try{a(this.findLastActive()||this.errorList.length&&this.errorList[0].element||[]).filter(":visible").focus().trigger("focusin")}catch(b){}},findLastActive:function(){var b=this.lastActive;return b&&1===a.grep(this.errorList,function(a){return a.element.name===b.name}).length&&b},elements:function(){var b=this,c={};return a(this.currentForm).find("input, select, textarea").not(":submit, :reset, :image, :disabled").not(this.settings.ignore).filter(function(){return!this.name&&b.settings.debug&&window.console&&console.error("%o has no name assigned",this),this.name in c||!b.objectLength(a(this).rules())?!1:(c[this.name]=!0,!0)})},clean:function(b){return a(b)[0]},errors:function(){var b=this.settings.errorClass.split(" ").join(".");return a(this.settings.errorElement+"."+b,this.errorContext)},reset:function(){this.successList=[],this.errorList=[],this.errorMap={},this.toShow=a([]),this.toHide=a([]),this.currentElements=a([])},prepareForm:function(){this.reset(),this.toHide=this.errors().add(this.containers)},prepareElement:function(a){this.reset(),this.toHide=this.errorsFor(a)},elementValue:function(b){var c,d=a(b),e=b.type;return"radio"===e||"checkbox"===e?this.findByName(b.name).filter(":checked").val():"number"===e&&"undefined"!=typeof b.validity?b.validity.badInput?!1:d.val():(c=d.val(),"string"==typeof c?c.replace(/\r/g,""):c)},check:function(b){b=this.validationTargetFor(this.clean(b));var c,d,e,f=a(b).rules(),g=a.map(f,function(a,b){return b}).length,h=!1,i=this.elementValue(b);for(d in f){e={method:d,parameters:f[d]};try{if(c=a.validator.methods[d].call(this,i,b,e.parameters),"dependency-mismatch"===c&&1===g){h=!0;continue}if(h=!1,"pending"===c)return void(this.toHide=this.toHide.not(this.errorsFor(b)));if(!c)return this.formatAndAdd(b,e),!1}catch(j){throw this.settings.debug&&window.console&&console.log("Exception occurred when checking element "+b.id+", check the '"+e.method+"' method.",j),j instanceof TypeError&&(j.message+=".  Exception occurred when checking element "+b.id+", check the '"+e.method+"' method."),j}}if(!h)return this.objectLength(f)&&this.successList.push(b),!0},customDataMessage:function(b,c){return a(b).data("msg"+c.charAt(0).toUpperCase()+c.substring(1).toLowerCase())||a(b).data("msg")},customMessage:function(a,b){var c=this.settings.messages[a];return c&&(c.constructor===String?c:c[b])},findDefined:function(){for(var a=0;a<arguments.length;a++)if(void 0!==arguments[a])return arguments[a];return void 0},defaultMessage:function(b,c){return this.findDefined(this.customMessage(b.name,c),this.customDataMessage(b,c),!this.settings.ignoreTitle&&b.title||void 0,a.validator.messages[c],"<strong>Warning: No message defined for "+b.name+"</strong>")},formatAndAdd:function(b,c){var d=this.defaultMessage(b,c.method),e=/\$?\{(\d+)\}/g;"function"==typeof d?d=d.call(this,c.parameters,b):e.test(d)&&(d=a.validator.format(d.replace(e,"{$1}"),c.parameters)),this.errorList.push({message:d,element:b,method:c.method}),this.errorMap[b.name]=d,this.submitted[b.name]=d},addWrapper:function(a){return this.settings.wrapper&&(a=a.add(a.parent(this.settings.wrapper))),a},defaultShowErrors:function(){var a,b,c;for(a=0;this.errorList[a];a++)c=this.errorList[a],this.settings.highlight&&this.settings.highlight.call(this,c.element,this.settings.errorClass,this.settings.validClass),this.showLabel(c.element,c.message);if(this.errorList.length&&(this.toShow=this.toShow.add(this.containers)),this.settings.success)for(a=0;this.successList[a];a++)this.showLabel(this.successList[a]);if(this.settings.unhighlight)for(a=0,b=this.validElements();b[a];a++)this.settings.unhighlight.call(this,b[a],this.settings.errorClass,this.settings.validClass);this.toHide=this.toHide.not(this.toShow),this.hideErrors(),this.addWrapper(this.toShow).show()},validElements:function(){return this.currentElements.not(this.invalidElements())},invalidElements:function(){return a(this.errorList).map(function(){return this.element})},showLabel:function(b,c){var d,e,f,g=this.errorsFor(b),h=this.idOrName(b),i=a(b).attr("aria-describedby");g.length?(g.removeClass(this.settings.validClass).addClass(this.settings.errorClass),g.html(c)):(g=a("<"+this.settings.errorElement+">").attr("id",h+"-error").addClass(this.settings.errorClass).html(c||""),d=g,this.settings.wrapper&&(d=g.hide().show().wrap("<"+this.settings.wrapper+"/>").parent()),this.labelContainer.length?this.labelContainer.append(d):this.settings.errorPlacement?this.settings.errorPlacement(d,a(b)):d.insertAfter(b),g.is("label")?g.attr("for",h):0===g.parents("label[for='"+h+"']").length&&(f=g.attr("id").replace(/(:|\.|\[|\]|\$)/g,"\\$1"),i?i.match(new RegExp("\\b"+f+"\\b"))||(i+=" "+f):i=f,a(b).attr("aria-describedby",i),e=this.groups[b.name],e&&a.each(this.groups,function(b,c){c===e&&a("[name='"+b+"']",this.currentForm).attr("aria-describedby",g.attr("id"))}))),!c&&this.settings.success&&(g.text(""),"string"==typeof this.settings.success?g.addClass(this.settings.success):this.settings.success(g,b)),this.toShow=this.toShow.add(g)},errorsFor:function(b){var c=this.idOrName(b),d=a(b).attr("aria-describedby"),e="label[for='"+c+"'], label[for='"+c+"'] *";return d&&(e=e+", #"+d.replace(/\s+/g,", #")),this.errors().filter(e)},idOrName:function(a){return this.groups[a.name]||(this.checkable(a)?a.name:a.id||a.name)},validationTargetFor:function(b){return this.checkable(b)&&(b=this.findByName(b.name)),a(b).not(this.settings.ignore)[0]},checkable:function(a){return/radio|checkbox/i.test(a.type)},findByName:function(b){return a(this.currentForm).find("[name='"+b+"']")},getLength:function(b,c){switch(c.nodeName.toLowerCase()){case"select":return a("option:selected",c).length;case"input":if(this.checkable(c))return this.findByName(c.name).filter(":checked").length}return b.length},depend:function(a,b){return this.dependTypes[typeof a]?this.dependTypes[typeof a](a,b):!0},dependTypes:{"boolean":function(a){return a},string:function(b,c){return!!a(b,c.form).length},"function":function(a,b){return a(b)}},optional:function(b){var c=this.elementValue(b);return!a.validator.methods.required.call(this,c,b)&&"dependency-mismatch"},startRequest:function(a){this.pending[a.name]||(this.pendingRequest++,this.pending[a.name]=!0)},stopRequest:function(b,c){this.pendingRequest--,this.pendingRequest<0&&(this.pendingRequest=0),delete this.pending[b.name],c&&0===this.pendingRequest&&this.formSubmitted&&this.form()?(a(this.currentForm).submit(),this.formSubmitted=!1):!c&&0===this.pendingRequest&&this.formSubmitted&&(a(this.currentForm).triggerHandler("invalid-form",[this]),this.formSubmitted=!1)},previousValue:function(b){return a.data(b,"previousValue")||a.data(b,"previousValue",{old:null,valid:!0,message:this.defaultMessage(b,"remote")})},destroy:function(){this.resetForm(),a(this.currentForm).off(".validate").removeData("validator")}},classRuleSettings:{required:{required:!0},email:{email:!0},url:{url:!0},date:{date:!0},dateISO:{dateISO:!0},number:{number:!0},digits:{digits:!0},creditcard:{creditcard:!0}},addClassRules:function(b,c){b.constructor===String?this.classRuleSettings[b]=c:a.extend(this.classRuleSettings,b)},classRules:function(b){var c={},d=a(b).attr("class");return d&&a.each(d.split(" "),function(){this in a.validator.classRuleSettings&&a.extend(c,a.validator.classRuleSettings[this])}),c},normalizeAttributeRule:function(a,b,c,d){/min|max/.test(c)&&(null===b||/number|range|text/.test(b))&&(d=Number(d),isNaN(d)&&(d=void 0)),d||0===d?a[c]=d:b===c&&"range"!==b&&(a[c]=!0)},attributeRules:function(b){var c,d,e={},f=a(b),g=b.getAttribute("type");for(c in a.validator.methods)"required"===c?(d=b.getAttribute(c),""===d&&(d=!0),d=!!d):d=f.attr(c),this.normalizeAttributeRule(e,g,c,d);return e.maxlength&&/-1|2147483647|524288/.test(e.maxlength)&&delete e.maxlength,e},dataRules:function(b){var c,d,e={},f=a(b),g=b.getAttribute("type");for(c in a.validator.methods)d=f.data("rule"+c.charAt(0).toUpperCase()+c.substring(1).toLowerCase()),this.normalizeAttributeRule(e,g,c,d);return e},staticRules:function(b){var c={},d=a.data(b.form,"validator");return d.settings.rules&&(c=a.validator.normalizeRule(d.settings.rules[b.name])||{}),c},normalizeRules:function(b,c){return a.each(b,function(d,e){if(e===!1)return void delete b[d];if(e.param||e.depends){var f=!0;switch(typeof e.depends){case"string":f=!!a(e.depends,c.form).length;break;case"function":f=e.depends.call(c,c)}f?b[d]=void 0!==e.param?e.param:!0:delete b[d]}}),a.each(b,function(d,e){b[d]=a.isFunction(e)?e(c):e}),a.each(["minlength","maxlength"],function(){b[this]&&(b[this]=Number(b[this]))}),a.each(["rangelength","range"],function(){var c;b[this]&&(a.isArray(b[this])?b[this]=[Number(b[this][0]),Number(b[this][1])]:"string"==typeof b[this]&&(c=b[this].replace(/[\[\]]/g,"").split(/[\s,]+/),b[this]=[Number(c[0]),Number(c[1])]))}),a.validator.autoCreateRanges&&(null!=b.min&&null!=b.max&&(b.range=[b.min,b.max],delete b.min,delete b.max),null!=b.minlength&&null!=b.maxlength&&(b.rangelength=[b.minlength,b.maxlength],delete b.minlength,delete b.maxlength)),b},normalizeRule:function(b){if("string"==typeof b){var c={};a.each(b.split(/\s/),function(){c[this]=!0}),b=c}return b},addMethod:function(b,c,d){a.validator.methods[b]=c,a.validator.messages[b]=void 0!==d?d:a.validator.messages[b],c.length<3&&a.validator.addClassRules(b,a.validator.normalizeRule(b))},methods:{required:function(b,c,d){if(!this.depend(d,c))return"dependency-mismatch";if("select"===c.nodeName.toLowerCase()){var e=a(c).val();return e&&e.length>0}return this.checkable(c)?this.getLength(b,c)>0:b.length>0},email:function(a,b){return this.optional(b)||/^[a-zA-Z0-9.!#$%&'*+\/=?^_`{|}~-]+@[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?(?:\.[a-zA-Z0-9](?:[a-zA-Z0-9-]{0,61}[a-zA-Z0-9])?)*$/.test(a)},url:function(a,b){return this.optional(b)||/^(?:(?:(?:https?|ftp):)?\/\/)(?:\S+(?::\S*)?@)?(?:(?!(?:10|127)(?:\.\d{1,3}){3})(?!(?:169\.254|192\.168)(?:\.\d{1,3}){2})(?!172\.(?:1[6-9]|2\d|3[0-1])(?:\.\d{1,3}){2})(?:[1-9]\d?|1\d\d|2[01]\d|22[0-3])(?:\.(?:1?\d{1,2}|2[0-4]\d|25[0-5])){2}(?:\.(?:[1-9]\d?|1\d\d|2[0-4]\d|25[0-4]))|(?:(?:[a-z\u00a1-\uffff0-9]-*)*[a-z\u00a1-\uffff0-9]+)(?:\.(?:[a-z\u00a1-\uffff0-9]-*)*[a-z\u00a1-\uffff0-9]+)*(?:\.(?:[a-z\u00a1-\uffff]{2,})).?)(?::\d{2,5})?(?:[/?#]\S*)?$/i.test(a)},date:function(a,b){return this.optional(b)||!/Invalid|NaN/.test(new Date(a).toString())},dateISO:function(a,b){return this.optional(b)||/^\d{4}[\/\-](0?[1-9]|1[012])[\/\-](0?[1-9]|[12][0-9]|3[01])$/.test(a)},number:function(a,b){return this.optional(b)||/^(?:-?\d+|-?\d{1,3}(?:,\d{3})+)?(?:\.\d+)?$/.test(a)},digits:function(a,b){return this.optional(b)||/^\d+$/.test(a)},creditcard:function(a,b){if(this.optional(b))return"dependency-mismatch";if(/[^0-9 \-]+/.test(a))return!1;var c,d,e=0,f=0,g=!1;if(a=a.replace(/\D/g,""),a.length<13||a.length>19)return!1;for(c=a.length-1;c>=0;c--)d=a.charAt(c),f=parseInt(d,10),g&&(f*=2)>9&&(f-=9),e+=f,g=!g;return e%10===0},minlength:function(b,c,d){var e=a.isArray(b)?b.length:this.getLength(b,c);return this.optional(c)||e>=d},maxlength:function(b,c,d){var e=a.isArray(b)?b.length:this.getLength(b,c);return this.optional(c)||d>=e},rangelength:function(b,c,d){var e=a.isArray(b)?b.length:this.getLength(b,c);return this.optional(c)||e>=d[0]&&e<=d[1]},min:function(a,b,c){return this.optional(b)||a>=c},max:function(a,b,c){return this.optional(b)||c>=a},range:function(a,b,c){return this.optional(b)||a>=c[0]&&a<=c[1]},equalTo:function(b,c,d){var e=a(d);return this.settings.onfocusout&&e.off(".validate-equalTo").on("blur.validate-equalTo",function(){a(c).valid()}),b===e.val()},remote:function(b,c,d){if(this.optional(c))return"dependency-mismatch";var e,f,g=this.previousValue(c);return this.settings.messages[c.name]||(this.settings.messages[c.name]={}),g.originalMessage=this.settings.messages[c.name].remote,this.settings.messages[c.name].remote=g.message,d="string"==typeof d&&{url:d}||d,g.old===b?g.valid:(g.old=b,e=this,this.startRequest(c),f={},f[c.name]=b,a.ajax(a.extend(!0,{mode:"abort",port:"validate"+c.name,dataType:"json",data:f,context:e.currentForm,success:function(d){var f,h,i,j=d===!0||"true"===d;e.settings.messages[c.name].remote=g.originalMessage,j?(i=e.formSubmitted,e.prepareElement(c),e.formSubmitted=i,e.successList.push(c),delete e.invalid[c.name],e.showErrors()):(f={},h=d||e.defaultMessage(c,"remote"),f[c.name]=g.message=a.isFunction(h)?h(b):h,e.invalid[c.name]=!0,e.showErrors(f)),g.valid=j,e.stopRequest(c,j)}},d)),"pending")}}});var b,c={};a.ajaxPrefilter?a.ajaxPrefilter(function(a,b,d){var e=a.port;"abort"===a.mode&&(c[e]&&c[e].abort(),c[e]=d)}):(b=a.ajax,a.ajax=function(d){var e=("mode"in d?d:a.ajaxSettings).mode,f=("port"in d?d:a.ajaxSettings).port;return"abort"===e?(c[f]&&c[f].abort(),c[f]=b.apply(this,arguments),c[f]):b.apply(this,arguments)})});
// JavaScript Document
jQuery(document).ready(function($) {
    showMore();
    var w, mHeight, tests = $("#testimonials");
    w = tests.outerWidth();
    mHeight = 0;
    tests.find(".testimonial").each(function(index) {
        $("#t_pagers").find(".pager:eq(0)").addClass("active"); //make the first pager active initially
        if (index == 0)
            $(this).addClass("active"); //make the first slide active initially
        if ($(this).height() > mHeight) //just finding the max height of the slides
            mHeight = $(this).height();
        var l = index * w; //find the left position of each slide
        $(this).css("left", l); //set the left position
        tests.find("#test_container").height(mHeight); //make the height of the slider equal to the max height of the slides
    });
    $(".pager").on("click", function(e) { //clicking action for pagination
        e.preventDefault();
        next = $(this).index(".pager");
        clearInterval(t_int); //clicking stops the autoplay we will define later
        moveIt(next);
    });
    var t_int = setInterval(function() { //for autoplay
        var i = $(".testimonial.active").index(".testimonial");
        if (i == $(".testimonial").length - 1)
            next = 0;
        else
            next = i + 1;
        moveIt(next);
    }, 6000);
});
function moveIt(next) { //the main sliding function
    var c = parseInt($(".testimonial.active").removeClass("active").css("left")); //current position
    var n = parseInt($(".testimonial").eq(next).addClass("active").css("left")); //new position
    $(".testimonial").each(function() { //shift each slide
        if (n > c)
            $(this).animate({
                'left': '-=' + (n - c) + 'px'
            });
        else
            $(this).animate({
                'left': '+=' + Math.abs(n - c) + 'px'
            });
    });
    $(".pager.active").removeClass("active"); //very basic
    $("#t_pagers").find(".pager").eq(next).addClass("active"); //very basic
}
// For Demo purposes only (show hover effect on mobile devices)
//[].slice.call(document.querySelectorAll('a[href="#"')).forEach(function(el) {
//    el.addEventListener('click', function(ev) {
//        ev.preventDefault();
//    });
//});
$('a[href^="#!"]').on('click', function(e) {
    e.preventDefault();
    $(document).off("scroll");
    $('a').each(function() {
        $(this).removeClass('activeurl');
    })
    $(this).addClass('activeurl');
    var target = this.hash,
    menu = target;
    $target = $(target);
    $('html, body').stop().animate({
        'scrollTop': $target.offset().top + 2
    }, 600, 'swing', function() {
        window.location.hash = target;
        $(document).on("scroll", onScroll);
    });
});

function onScroll(event) {
    var scrollPos = $(document).scrollTop();
    $('#menu-center a').each(function() {
        var currLink = $(this);
        var refElement = $(currLink.attr("href"));
        if (refElement.position().top <= scrollPos && refElement.position().top + refElement.height() > scrollPos) {
            $('#menu-center ul li a').removeClass("active");
            currLink.addClass("active");
        } else {
            currLink.removeClass("active");
        }
    });
}

$(window).scroll(function() {
    if ($(this).scrollTop() > 300) {
        $('#single-fix-menu-desktop').fadeIn();
    } else {
        $('#single-fix-menu-desktop').fadeOut();
    }
});




$(window).scroll(function() {
    if ($(this).scrollTop() > 200) {
        $('#sidebar-fixed').fadeIn();
    } else if ($(this).scrollTop() < 20) {
        $("#sidebar-fixed").css("margin-top", "130px");
    } else {
        $("#sidebar-fixed").css("margin-top", "-20px");
    }
});

$(window).scroll(function() {
    if ($(document).height() <= ($(window).height() + $(window).scrollTop())) {
        //Bottom Reached
        $('#sidebar-fixed').hide();
    }
});


$(document).ready(function(){

    $(".search_results").click(function(){
        $("#mapHide").hide();
        $("#search_results").show();
        $(this).addClass("active");
        $('.search_listing_map').removeClass("active");
    });

    $(".search_listing_map").click(function(){
        $("#search_results").hide();
        $("#mapHide").show();
        $(this).addClass("active");
        $('.search_results').removeClass("active");
    });

});

$(document).ready(function() {

    // $("#search_form").validate({
    //     submitHandler: function(e) {
    //         e.preventDefault();
    //         var $form = $(form);
    //         $form.submit();
    //     },
    //     rules: {
    //         location: {
    //             required: true,
    //         },
    //     },
    //     messages: {
    //         location: {
    //             required: "Please enter location"
    //         },
    //     },
    //     errorPlacement: function(error, element) {
    //         $(element).closest('div').find('.help-block').html(error.html());
    //         $('#shakemediv').addClass('animated shake');
    //         $('#location').val("Los Angeles");
    //     },
    //     highlight: function(element) {
    //         $(element).closest('div').removeClass('has-success').addClass('has-error');
    //     },
    //     unhighlight: function(element, errorClass, validClass) {
    //         $(element).closest('div').removeClass('has-error').addClass('has-success');
    //         $(element).closest('div').find('.help-block').html('');
    //     }
    // });

    $("#search_form_adv").validate({
        rules: {
            location: {
                required: true,
            },
        },
        messages: {
            location: {
                required: "Please enter location"
            },
        },
        errorPlacement: function(error, element) {
            $(element).closest('div').find('.help-block').html(error.html());
            $('#shakemediv').addClass('animated shake');
            $('#location').val("Los Angeles");
        },
        highlight: function(element) {
            $(element).closest('div').removeClass('has-success').addClass('has-error');
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).closest('div').removeClass('has-error').addClass('has-success');
            $(element).closest('div').find('.help-block').html('');
        },
        submitHandler: function(e) {
            //  e.preventDefault();
             //console.log($("#search_form_adv").serialize());
             $.ajax({
                url: site_url + "search/results",
                type: "GET",
                data: $("#search_form_adv").serialize() + "&ajax=1",
                dataType: "html",
                success: function(data) {
                    //alert(data);
                    // console.log(data);
                    //ScrollMe('search_results');
                    $('#sorted_listings').html(data);
                    //applyPagination();
                    //loadSearchMap();
                    //applyHovers();
                }
            });
             return false;
         },
     });
    $(".effect-goliath figcaption").click(function() {
        var url = $(this).attr("data-href");
           //alert(url);
           window.location.href = url;
       });
    //applyHovers();
    applyPagination();


    function getData(page){

        alert('getdata');

        var url = $(this).attr("data-href");
        var page = $(this).attr("pagination-page");
        var ajax = $(this).attr("ajax-page");
        var data = $("#form_for_ajax").serialize() + "&page=" + page + "&ajax=" + ajax;

        $.ajax({
            method: "POST",
            url: url,
            data: { page: page,ajax:1 },
            beforeSend: function(){
                //$('<?php echo $this->loading; ?>').show();
               // $("#filtered_search_results").html('')

            },
            success: function(data){

                alert(data);
                $("#filtered_search_results").html(data)
              //  $('<?php echo $this->loading; ?>').hide();
               // $('<?php echo $this->target; ?>').html(data);
            }
        });
    }


function applyPagination() {


    $(document).on("click", ".ajax_pagingsearc a", function(e) {

        e.preventDefault();

            console.log('pagination activated');

            var url = $(this).attr("data-href");
            var page = $(this).attr("pagination-page");
            var ajax = $(this).attr("ajax-page");

            //alert(page);

            //alert(url + '{}' +   page +'{}'+ ajax);
            //return;
            if (url != "current") {

                var data = $("#search_form").serialize() + "&page=" + page + "&ajax=" + ajax;

                $.ajax({
                    type: "GET",
                    data: data,
                    url: url,

                    beforeSend:function() {
                        $('#search_loader').show();
                    },

                    success: function(msg) {
                        console.log("=======================================================================================");
                       // history.pushState(undefined, '', data);
                        $("#sorted_listings").html(msg);
                        $('.map-list-loader-container').hide();
                    },

                    complete:function(){
                        $('#search_loader').hide();
                    },
                    error: function (jqXHR, exception) {

                        alert(jqXHR.status);

                        var msg = '';
                        if (jqXHR.status === 0) {
                            msg = 'Not connect.\n Verify Network.';
                        } else if (jqXHR.status == 404) {
                            msg = 'Requested page not found. [404]';
                        } else if (jqXHR.status == 500) {
                            msg = 'Internal Server Error [500].';
                        } else if (exception === 'parsererror') {
                            msg = 'Requested JSON parse failed.';
                        } else if (exception === 'timeout') {
                            msg = 'Time out error.';
                        } else if (exception === 'abort') {
                            msg = 'Ajax request aborted.';
                        } else {
                            msg = 'Uncaught Error.\n' + jqXHR.responseText;
                        }
                    },
                    timeout: 5000
                });


            }
            return false;
        });
}


    $("#more_link").click(function() {
        $("#more_filters").toggle("slow");
    });
    jQuery.ajaxSetup({
        beforeSend: function() {
            $("#search_results").addClass("loading");
        },
        complete: function() {
            $("#search_results").removeClass("loading");
        }
    });


/*    $("#contacthostform").submit(function() {
        alert('test')
        var data = $('#contacthostform').serialize();
        var url = site_url + 'Inbox/contact_agent/';
        $.ajax({
            type: "POST",
            url: url,
            data: data
        }).done(function( result) {
            if (result) {
                $("#contacthostform")[0].reset();
                $("#contact_response").html('<div class="alert alert-success"><button class="close" data-dismiss="alert"></button>You successfully messaged your selected agent. Expect a response soon!</div>');
            } else {
                $("#contact_response").html('<div class="alert alert-danger"><button class="close" data-dismiss="alert"></button> Something wrong.Please try again.</div>');
            }
        });
        return false;
    });*/
});

function ratingsPlus()
{
    $(".colaprating").toggle();
}
$('.close').on('click', function () {
    $(".form").validate().resetForm();
   // $("#contacthostform")[0].reset.click();
});
function validateQuickContactForm(id) {
       $("#contacthostform_"+id).validate({
        ignore: "input[type='text']:hidden",
        rules: {
            'fullname': {required: true},
            'email': {required: true},
            'phone': {required: true},
            'message': {required: true},

        },
        errorPlacement: function(error, element){}
    });

    if ($("#contacthostform_"+id).valid() == true) {
        console.log('valid');

        var data = $('#contacthostform_'+id).serialize();
        var url = site_url + 'Inbox/quick_contact/';

        console.log(url);

        $.ajax({
            type: "POST",
            url: url,
            data: data
        }).done(function (result) {
            if (result) {
                $("#contacthostform_"+id)[0].reset();
                $("#contact_response_"+id).html('<div class="alert alert-success"><button class="close" data-dismiss="alert"></button>You successfully messaged your selected agent. Expect a response soon!</div>');
            } else {
                $("#contact_response_"+id).html('<div class="alert alert-danger"><button class="close" data-dismiss="alert"></button> Something wrong.Please try again.</div>');
            }
        });
        return false;
    }
}



function validateHostForm() {

    var $this = $(this);

    $("#contacthostform").validate({
        ignore: "input[type='text']:hidden",
        rules: {
            'fullname': {required: true},
            'email': {required: true},
            'phone': {required: true},
            'message': {required: true},
        },
        errorPlacement: function(error, element){}
    });

    if ($("#contacthostform").valid() == true) {

        console.log('valid');

        var data = $('#contacthostform').serialize();
        var url = site_url + 'Inbox/contact_agent/';

        console.log(url);

        $.ajax({
            url: url,
            type: "POST",
            data: data,
            dataType: "html",

            beforeSend: function() {

                $(".email_to_agent").button('loading');

            },
            success: function(result) {
                if (result) {
                    $("#contacthostform")[0].reset();
                    $("#contact_response").html('<div class="alert alert-success"><button class="close" data-dismiss="alert"></button>You successfully messaged your selected agent. Expect a response soon!</div>');
                } else {
                    $("#contact_response").html('<div class="alert alert-danger"><button class="close" data-dismiss="alert"></button> Something wrong.Please try again.</div>');
                }
            },
            complete:function()
            {
                $('.email_to_agent').button('reset');
                $(".email_to_agent").prop('onclick', null);
            },
            error: function(xhr) {

                // btn.prop('disabled',false);
                alert("Error occured.please try again");
            }
        });
    }
}






function ScrollMe(id) {
    var offset = $("#" + id).offset().top - 50;
    $('html,body').animate({
        scrollTop: offset
    }, 'slow');
}

function explode(delimiter, string, limit) {
    //  discuss at: http://phpjs.org/functions/explode/
    // original by: Kevin van Zonneveld (http://kevin.vanzonneveld.net)
    //   example 1: explode(' ', 'Kevin van Zonneveld');
    //   returns 1: {0: 'Kevin', 1: 'van', 2: 'Zonneveld'}
    if (arguments.length < 2 || typeof delimiter === 'undefined' || typeof string === 'undefined') return null;
    if (delimiter === '' || delimiter === false || delimiter === null) return false;
    if (typeof delimiter === 'function' || typeof delimiter === 'object' || typeof string === 'function' || typeof string ===
        'object') {
        return {
            0: ''
        };
    }
    if (delimiter === true) delimiter = '1';
    // Here we go...
    delimiter += '';
    string += '';
    var s = string.split(delimiter);
    if (typeof limit === 'undefined') return s;
    // Support for limit
    if (limit === 0) limit = 1;
    // Positive limit
    if (limit > 0) {
        if (limit >= s.length) return s;
        return s.slice(0, limit - 1)
        .concat([s.slice(limit - 1)
            .join(delimiter)
            ]);
    }
    // Negative limit
    if (-limit >= s.length) return [];
    s.splice(s.length + limit);
    return s;
}

/** Wishlists*/
function loadWishtlistModel(listing_id){

    var url = site_url + 'wishlist/';
    var data = {
        listing_id   :listing_id
    };
    $.ajax({
     type: "POST",
     cache: false,
     url: url,
     data: data,
     async: false,
     success: function(result) {
        $("#wishlistContent").html(result);
        $('#wishlistModal').modal('show');
    },
});
}

// New Wishlist
function showfields(){
 $(".create_new").hide();
 $('.new_wishlist .form').show();
}


// Add Wishlist Category
function addWishlistCategory(){
        $("#category").validate({
            rules: {
                wishlist_name: {required: true},
            },
            errorPlacement: function(error, element) {
                $('#wishlist_name').css("border"," 1px solid red");
            },
        });
        if($("#category").valid()==true){
            var url  = site_url+'wishlist/addWishlistCategories/';
            var name = $('#wishlist_name').val();
            var visibility = $('#visibility').val();
            var data = {
                name   :name,
                visibility:visibility
            };
            $.ajax({
                type: "POST",
                cache: false,
                url: url,
                data: data,
                async: false,
                success: function(result) {
                    if(result){

                        var url = site_url + 'wishlist/wishlistCategories/';
                        $.ajax({
                            type: "POST",
                            cache: false,
                            url: url,
                            data: data,
                            async: false,
                            success: function(result) {
                                $(".form").hide();
                                $('#wishlist_name').val("");
                                $("#wishlist_dropdown").html(result);
                            }
                        });
                    }
                },
            });
        }
    }

// Add Wishlist
function addWishlist(){
    $(".form").hide();
    $("#wishlistForm").validate({

       // ignore: [],
        rules: {
            note_text: {required: true},
            create: {
                    required: $('.checkbox').not(':checked')
                },
            'wishlist_category[]': { required: true},
        },
        errorPlacement: function(error, element) {
            $('#note_text').css("border"," 1px solid red");
            if($("#create").val() == ''){
                $('.error_msgs').show();
            } else{
                $('.error_msg').show();
            }

        },

    });
    if($("#wishlistForm").valid()==true){
        var data = $('#wishlistForm').serialize();
        var url = site_url + 'wishlist/createWishlist/';
        $.ajax({
            type: "POST",
            cache: false,
            url: url,
            data: data,
            async:false,
            success: function(result) {
                if (result) {

                    if(result) {

                        $('.notice').html('<div  class="alert alert-success"> <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>Your wishlist has been saved successfully </div>');
                        window.setTimeout(function () {
                            location.reload()
                        }, 3000)
                    }else{
                        $('.notice').html('<div  class="alert alert-danger"> <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>Sorry ! something went wrong,try again </div>');
                    }


                    //$('#wishlistModal').modal('hide');
                }
            },
        });
    }
}

function addNewCategory(){
    var data = $('#newWishList').serialize();
    var url = site_url + 'wishlist/addWishlistCategories/';
    $("#newWishList").validate({
        rules: {
            name: {required: true},
        },
        errorPlacement: function(error, element) {
            $('#name').css("border"," 1px solid red");
        },
    });
    if($("#newWishList").valid()==true){
        $.ajax({
            type: "POST",
            cache: false,
            url: url,
            data: data,
            success: function(result) {
                if (result) {
                    $('#newWishlist').modal('hide');
                    location.reload()
                }
            }
        });
    }
}
// Delete Wishlist Listing

function removeWishList(listing_id){
        var url = site_url + 'wishlist/remove_wishlist/';
        var data = { listing_id:listing_id };
        $.ajax({
            type: "POST",
            cache: false,
            url: url,
            data: data,
            async: false,
            success: function(result) {
                $("#wishListsRow_"+listing_id).remove();
                $('.wishlist_notice').show();
                window.setTimeout(function(){location.reload()},3000)
            }
        });
    }
//update user Wishlist Category

function updateWishCat(id){
        var data  = { id: id };
        $(".info").hide();
        var url  = site_url + 'wishlist/category_details/';
        $.ajax({
            type: "POST",
            cache: false,
            url: url,
            data: data,
            async: false,
            success: function(result) {
             $('#wishlist_container').html(result);
         }
     });
    }
// Update Wishlist Cateogry

function updateWishlistCat(){
        $("#updateCat").validate({
            rules: {
                name: {required: true},
            },
            errorPlacement: function(error, element) {
                $('#name').css("border"," 1px solid red");
            },
        });
        if($("#updateCat").valid()==true){
            var data = $('#updateCat').serialize();
            var url = site_url + 'wishlist/update_Wishlist_category/';
            $.ajax({
                type: "POST",
                cache: false,
                url: url,
                data: data,
                async:false,
                beforeSend: function() {
                 $(".loader").show();
                 $("#wishlistrow").hide();
             },
             success: function(result) {
                if (result) {
                    $('#name').css("border"," 1px solid #e5e5e5");
                    $('#wishlistModal').modal('hide');
                    $('#name').val(result);
                    $('.ListName').text(result);
                }
            },
            complete:function(){
              $(".loader").hide();
              $("#wishlistrow").show();
          }
      });
        }
    }

// Delete Wishlist Category
function deleteWishlistCategory(id){
        var url = site_url + 'wishlist/remove_wishlist_category/';
        var data = { id:id };
        $.ajax({
            type: "POST",
            cache: false,
            url: url,
            data: data,
            async: false,
            success: function(result) {
                if(result) {
                    $("#wishlists_category_" + id).remove();
                    $('#display_notices').html('<div  class="alert alert-success"> <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>Your wishlist category has been deleted successfully </div>');
                    window.setTimeout(function () {
                        location.reload()
                    }, 3000)
                }else{
                    $('#display_notices').html('<div  class="alert alert-danger"> <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>Sorry ! something went wrong,try again </div>');
                }
            }
        });
    }
   // update User Note
function updateUserNote(id){
    var note = $('#message_note_'+id).val();
    var url = site_url + 'wishlist/update_note/';
    $.ajax({
        type: "POST",
        cache: false,
        url: url,
        data: { id : id ,note : note },
        async:false,
        beforeSend: function() {
         $(".loader").show();
         $('#message_note_'+id).css("display","none");
     },
     success: function(result) {
        if (result) {
            var url = site_url + 'wishlist/get_updated_note/';
            $.ajax({
                type: "POST",
                cache: false,
                url: url,
                data: {id:id},
                async:false,
                success: function(result) {
                    if (result) {
                        $('#message_note_'+id).html(result);
                    }
                },
            });
        }
    },
    complete: function() {
        $(".loader").hide();
        $('#message_note_'+id).css("display","block");
    }
});
}

function navigateLink(id){
  window.open(id, '_blank');
}

function getTrasnactions(id){
    var url = site_url + 'users/get_tranactions_by_date/';
    $.ajax({
        type: "POST",
        cache: false,
        url: url,
        data: {id:id},
        async:false,
        success: function(result) {
            if (result) {
                $("#transcation_div").html(result);
            }
        }
    });
}



$(document).ready(function() {

    // $(window).keydown(function(event){
    //     if(event.keyCode == 13) {
    //         $(".search_submit").attr("disabled", true);
    //         event.preventDefault();
    //         return false;
    //     }
    // });
});

function if_value_is_changed() {
    var city = ($('#city').val());
    console.log(city);
    if(city != ''){
        //$('.search_form')[0].reset();

        $('#city').attr('value', '');
        $('#state').attr('value', '');
        $('#country').attr('value', '');
        $('#street').attr('value', '');
        $('#zipcode').attr('value', '');
        $('#city').attr('value', '');
        //$('#location').attr('value', '');

        $('#search_form').find('input[type=hidden]').each(function(){
            this.value='';
        });

        $(".search_submit").attr("disabled", true);
    }
}


function getProperty(anchorLink,ptype,id){

    $(".navTabs li").removeClass("active");
    //$(anchorLink).addClass("active");
    $(anchorLink).closest('li').addClass('active');

    if(ptype == 'sale'){

        $('#search_map').hide();
        $('#sold_map').hide();
        $('#rent_map').hide();
        $('#sale_map').show();
        $('#select_sale').show();
        $('#select_rent').hide();
        $('#select_sold').hide();
        $('#select_all').hide();

    }


    if(ptype == 'rent'){

        $('#search_map').hide();
        $('#sold_map').hide();
        $('#rent_map').show();
        $('#select_rent').show();
        $('#sale_map').hide();
        $('#select_sale').hide();
        $('#select_sold').hide();
        $('#select_all').hide();
    }

    if(ptype == 'sold'){

        $('#search_map').hide();
        $('#sold_map').show();
        $('#rent_map').hide();
        $('#select_rent').hide();
        $('#sale_map').hide();
        $('#select_sale').hide();
        $('#select_sold').show();
        $('#select_all').hide();
    }


    if(ptype == 'all'){

        $('#search_map').show();
        $('#select_all').show();
        $('#sold_map').hide();
        $('#rent_map').hide();
        $('#sale_map').hide();
        $('#select_sale').hide();
        $('#select_rent').hide();
        $('#select_sold').hide();

    }

}


// Search Properties Tabs

function getSearchProperty(anchorLink,ptype){

        var view_type = $('.page_view').val();

        if(view_type == 'list')
        {

            $(".btn-grid").removeClass('active');
            $(".btn-list").addClass('active');

        }else{


            $(".btn-grid").addClass('active');
            $(".btn-list").removeClass('active');
        }

        $(".property_tabs li a").removeClass("active");
        $(anchorLink).addClass("active");

        if(ptype =='all'){
            $('#sort_list_type').val('');
            $("#sort_lisitng_type").val('any');
            $('#list_type').val('any');
            var data = $('#all_properties').serialize() + "&ajax=" + 1 + "&type=" + 'any';
        }
        else if(ptype =='rent'){
            $('#sort_list_type').val('rent');
            $("#sort_lisitng_type").val('rent');
            $('#list_type').val('rent');
            var data = $('#rent_properties').serialize()+ "&ajax=" + 1 + "&type=" + 'rent';
        }
        else{
            $('#sort_list_type').val('sale');
            $("#sort_lisitng_type").val('sale');
            $('#list_type').val('sale');
            var data = $('#sale_properties').serialize()+ "&ajax=" + 1 + "&type=" + 'sale';
        }
        var url = site_url + 'search/index/';

        $.ajax({
            type: "POST",
            cache: false,
            url: url,
            data:data,
            //async:true,
            beforeSend: function(){
                $("#search_loader").show();
            },
            success: function(result) {
                $("#search_loader").hide();
                if (result) {



                    $('#sorted_listings').html(result);
                }

            },
            complete:function () {

                $('#total_count').html( $('#count_records').text());

                loadListingMap();
            }
        });
    }

/** Load Page Date */

$(function(){
        $('#sidebar_nav li a').on('click', function(){
            var url = site_url + 'pages/load_page_data/';
            var slug = $(this).attr("id");
            console.log(slug);
            $(this).parent().addClass('selected').siblings().removeClass('selected');
            if(slug =="add-listing"){window.location = site_url + 'listings/add-listing'}
                else if(slug=="contact") {window.location = site_url + 'contact' } else{
                    $.ajax({
                        type: "POST",
                        cache: false,
                        url: url,
                        data: {slug:slug},
                        async:false,
                        success: function(result) {
                            if (result) {
                                $('.my-profile').html(result);
                                if(slug=="press"){  showMore()}
                            }
                    },
                });
                }
            });
        // Sort By Agents Properties
        $('#sort_agents').change(function () {
            var sorttype =$(this).val();
            var agent_id = $('#agent_id').val();
            var type = $('#type').val();
            var url = site_url + 'agents/detail/';
            $.ajax({
                type: "POST",
                cache: false,
                url: url,
                data: {sorttype:sorttype,agent_id:agent_id,type:type},
                async:false,
                success: function(result) {
                    if (result) {
                        $('.property-listing').html(result);
                        $('[data-toggle="tooltip"]').tooltip();
                        var tip_action = $('.actions li');
                        tip_action.on('click',function(){
                            var tip_this = $(this);
                            if(tip_this.children('.share_tooltip').hasClass('in')){
                                tip_this.children('.share_tooltip').removeClass('in');
                            }else{
                                tip_action.children('.share_tooltip').removeClass('in');
                                tip_this.children('.share_tooltip').addClass('in');
                            }
                        });
                    }
                },
            });
        });
        //Sort Search Results
    $(document).on("change", "#sort_properties", function(e) {
       // $('#sort_properties').change(function () {
            e.preventDefault();
            // alert('sort');
           // return;
            var data = $('#sortForm').serialize();
            var url = site_url + 'search/index/';
            $.ajax({
                type: "POST",
                cache: false,
                url: url,
                data: data,
                async:false,
                beforeSend: function(){
                    $("#search_loader").show();
                },
                complete: function(){
                    $("#search_loader").hide();
                },
                success: function(result) {

                    if (result) {
                        $('#sorted_listings').html(result);
                        $('[data-toggle="tooltip"]').tooltip();
                        var tip_action = $('.actions li');
                        tip_action.on('click',function(){
                            var tip_this = $(this);
                            if(tip_this.children('.share_tooltip').hasClass('in')){
                                tip_this.children('.share_tooltip').removeClass('in');
                            }else{
                                tip_action.children('.share_tooltip').removeClass('in');
                                tip_this.children('.share_tooltip').addClass('in');
                            }
                        });
                    }
                }
            });

        });
        //Sort Agent Properties
        $('#sort_agent_properties').change(function () {
            var sorttype =$(this).val();
            var agent_id = $('#agent_id').val();
            var ptype = $(".property_tabs li a.active").attr('id');
            var url = site_url + 'agents/detail/';
            $.ajax({
                type: "POST",
                cache: false,
                url: url,
                data: {sorttype:sorttype,agent_id:agent_id,ptype:ptype},
                async:false,
                beforeSend: function(){
                    $("#loading").show();
                },
                complete: function(){
                    $("#loading").hide();
                },
                success: function(result) {
                    $('#search_partial').html(result);
                    if (result) {
                        $('#agent_properties').html(result);
                      //  $('.property-listing').html(result);
                      $('[data-toggle="tooltip"]').tooltip();
                      var tip_action = $('.actions li');
                      tip_action.on('click',function(){
                        var tip_this = $(this);
                        if(tip_this.children('.share_tooltip').hasClass('in')){
                            tip_this.children('.share_tooltip').removeClass('in');
                        }else{
                            tip_action.children('.share_tooltip').removeClass('in');
                            tip_this.children('.share_tooltip').addClass('in');
                        }
                    });
                  }
              },
          });
        });
    });


function applyProperty() {

    $("#apply_property").validate({
        rules: {
            note_text: {
                required: true
            }
        },
        messages: {
            note_text: {
                required: "Please enter your note"
            }
        },
        errorPlacement: function(error, element) {
            $(element).closest('div').find('.help-block').html(error.html());
            $('.submit-host-textbar').addClass('animated shake');

        },
        highlight: function(element) {
            $(element).closest('div').removeClass('has-success').addClass('has-error');
        },
        unhighlight: function(element, errorClass, validClass) {
            $(element).closest('div').removeClass('has-error').addClass('has-success');
            $(element).closest('div').find('.help-block').html('');
        },
        submitHandler: function(e) {

             var url = site_url + 'agents/ApplyProperty/';
             var data = $('#apply_property').serialize();

                $.ajax({
                    type: "POST",
                   // cache: false,
                    url: url,
                    data: data,
                  //  async: false,

                   beforeSend: function() {

                      $(".apply_property_class").button('loading');

                   },

                   success: function (result) {

                        if (result ==1 )
                        {
                           $('#apply_property')[0].reset();
                           $(".alert").html('<p>Application sent successfully</p>');
                           $('.alert').show();

                            $(".apply_property_class").prop('onclick', null);
                            $(".apply_property_class").html('Applied');

                        }
                        else if(result == 0){
                            $(".alert").html('<p>Youy have already applied this listing</p>');
                        }
                        else{
                            $(".alert").html('<p>Something wrong! Please try again</p>');

                        }

                   },
                   error: function(xhr) {

                         alert("Error occured.please try again");
                   }


                });

         }
    });
}

function view_phone(id) {

    console.log(id);
    var $this = $(this);

    $.ajax({
        url: site_url + "agents/showPhoneNumber",
        type: "POST",
        data: {id:id},
        dataType: "html",

        beforeSend: function() {

            $(".view_phone").button('loading');

            //  btn.prop('disabled', true);

        },
        success: function(result) {
            //  $this.button('reset');
            $('.view_phone').fadeOut(1000);
            $(".view_phone").button('reset');
            $(".phoneno").html(result);
            $(".view_phone").prop('onclick', null);

        },
        error: function(xhr) {

            // btn.prop('disabled',false);
            alert("Error occured.please try again");
        }
    });
}

function add_reviews() {

    $("#AddReviews").validate({
        ignore: "input[type='text']:hidden",
        rules: {
            'reviews[review]': {required: true},
            'reviews[service_provided]': {required: true},
            'reviews[service_years]': {required: true},
            'reviews[address]': {required: true},
            'chkb': {
                required: true
            }
        },

        messages: {

            'chkb': {
                required: "Please certify the truth of this review."
            }

        },
        errorPlacement: function (error, element) {
            $('.rateCat').css("border", " 1px solid red");
            if (element.attr("name") == "chkb") {
                error.insertAfter($('#register_chkb_error'));
            }
        },




    });

    if ($("#AddReviews").valid() == true) {
        $('.rateCat').css("border", "none");
        var url = site_url + 'agents/AddReviews/';
        var data = $('#AddReviews').serialize();
        console.log(data);
        $.ajax({
            type: "POST",
            cache: false,
            url: url,
            data: data,
            async: false,
            success: function (result) {
                if (result) {
                    $("#AddReviews").html('Reviews Added successfully');
                } else {
                    $("#AddReviews").html('<h3>Some thing wrong! Please try again</h3>');
                }
            }
        });
    }
}

function sendCountryToAjax(country) {
    var url = site_url + 'listings/detect_listing_location/';

    var price;
    var mnt;
    $.ajax({
        type: "POST",
        cache: false,
        data:{ country:country},
        url: url,
        async:false,
        success: function(result) {

             price = result.split(',')[0];
             mnt = result.split(',')[1];

            $('#price').attr("placeholder", "Price");
            $('#sqrft').attr("placeholder", "Area");

            $("#currency_type").val(price);
            $("#measurement_type").val(mnt);

           console.log(price + mnt);
        }
    });


}


function withdraw_amount(){
    $("#widthdraw_form").validate({
        rules: {
            withdraw_amount: {required: true,number: true},
            recipient_email: {required: true,email: true},
        },
        errorPlacement: function(error, element) {
            $('#withdraw_amount').css("border"," 1px solid red");
            $('#recipient_email').css("border"," 1px solid red");
        },
    });
    if($("#widthdraw_form").valid()==true){
       $('#withdraw_amount').css("border"," none");
       $('#recipient_email').css("border"," none");
       var url = site_url + 'users/verify_funds_amount/';
       var requested_amount = $('#withdraw_amount').val();
       $.ajax({
        type: "POST",
        cache: false,
        url: url,
        async:false,
        success: function(result) {
            var available_amount = parseInt(result);
            if(requested_amount <= available_amount){
                var data = $('#widthdraw_form').serialize();
                var url = site_url + 'users/widthdraw_funds/';
                $.ajax({
                    type: "POST",
                    cache: false,
                    url: url,
                    data: data,
                    async:true,
                    dataType: 'html',
                    success: function(result) {
                        if (result) {
                            setTimeout(function(){
                                $('#widthdraw').modal('hide');
                            }, 3000);
                            $('#widthdraw_success').show();
                            window.setTimeout(function(){location.reload()},4000)
                        }
                    },
                });
            }else {
                $('#widthdraw_notice').show();
                window.setTimeout(function(){location.reload()},4000)
            }
        },
    });
   }
}

function showMore() {
  var showChar = 90;
  var ellipsestext = "...";
  var moretext = "Show more >";
  var lesstext = "Show less";
  $('.more').each(function () {
      var content = $(this).html();
      if (content.length > showChar) {
              //console.log('test');
              var c = content.substr(0, showChar);
              var h = content.substr(showChar, content.length - showChar);
              console.log(h);
              var html = c + '<span class="moreellipses">' + ellipsestext + '&nbsp;</span><span class="morecontent"><span>' + h + '</span>&nbsp;&nbsp;<a href="" class="morelink">' + moretext + '</a></span>';
              //alert(html);
              //console.log(html);
              $(this).html(html);
          }
      });
  $(".morelink").click(function () {
      if ($(this).hasClass("less")) {
          $(this).removeClass("less");
          $(this).html(moretext);
      } else {
          $(this).addClass("less");
          $(this).html(lesstext);
      }
      $(this).parent().prev().toggle();
      $(this).prev().toggle();
      return false;
  });
}
  // Share posts on social media popup
var popupSize = {
    width: 780,
    height: 550
};


/* ------------------------------------------------------------------------ */


/** Add Appointments **/

$("#add_appointment").submit(function() {
    var time_to = jQuery('input[name="time_to"]').val();
    var time_from = jQuery('input[name="time_from"]').val();
    var currentDate = new Date();
    var theDate = (currentDate.getMonth() + 1) + '/' + currentDate.getDate() + '/' + currentDate.getFullYear();
    var timeStart = new Date(theDate + ' ' + time_from).getHours();
    var timeEnd = new Date(theDate  + ' ' + time_to).getHours();
    //Calulate the time difference
    var hourDiff = timeEnd - timeStart;
    if (hourDiff > 1) {
        var data = $('#add_appointment').serialize();
        var url = site_url + 'appointments/add_availability/';
        $.ajax({
            type: "POST",
            url: url,
            data: data
        }).done(function (result) {
            if (result) {
                $(".availability_form")[0].reset();
                $("#response").html('<div class="alert alert-success"><button class="close" data-dismiss="alert"></button> Your appointments has been added successfully!</div>');
                setTimeout(function () {
                    location.reload();
                }, 3000);
            } else {
                $("#response").html('<div class="alert alert-danger"><button class="close" data-dismiss="alert"></button> Whoops! something wrong,try again later.</div>');
            }
        });

     }else{
         $("#timeres").html('<div class="alert alert-danger"><button class="close" data-dismiss="alert"></button>minimum time should be One hour</div>');
         $("#timeres").fadeOut(2000);
     }
     return false;

});

/** Set Appointment **/

$("#set_appointment").submit(function() {

    var data = $('#set_appointment').serialize();
    var url = site_url + 'appointments/set_appointment/';
    $.ajax({
        type: "POST",
        url: url,
        data: data
    }).done(function( result) {
        if (result) {
            $("#set_appointment")[0].reset();
            $("#responsemessage").html('<div class="alert alert-success"><button class="close" data-dismiss="alert"></button> Your appointments has been set successfully!</div>');
        } else {
            $("#responsemessage").html('<div class="alert alert-danger"><button class="close" data-dismiss="alert"></button> Whoops! something wrong,try again later.</div>');
        }
    });
    return false;
});

$(document).ready(function(){


    $('#current_living').change(function(){
        if(this.checked)
            $('#prev_res').show();
        else
            $('#prev_res').hide();

    });

    $('#location').blur(function () {
        $(this).val(
            $.trim($(this).val())
        );
    });

});


function validate_search_form() {

    $("#search_form").validate({
        submitHandler: function (e) {

            $("input").each(function(index, obj){
                if($(obj).val() == "") {
                    $(obj).remove();
                }
            });


          //  e.preventDefault();
            var $form = $(form);
            $form.submit();
        },
        rules: {
            location: {
                required: {
                    depends:function(){
                        $(this).val($.trim($(this).val()));
                        return true;
                    }
                },
                location: true
            }

        },
        messages: {
            location: {
                required: "Merci de sélectionner une adresse valide d’après nos suggestions"
            }
        },
        errorPlacement: function (error, element) {
            $(element).closest('div').find('.help-block').html(error.html());
            $('#shakemediv').addClass('animated shake');
           // $('#location').val("Los Angeles, CA, United States");
        },
        highlight: function (element) {
            $(element).closest('div').removeClass('has-success').addClass('has-error');
        },
        unhighlight: function (element, errorClass, validClass) {
            $(element).closest('div').removeClass('has-error').addClass('has-success');
            $(element).closest('div').find('.help-block').html('');
        }
    });
}


$('#agent_search').click(function(e) {

        e.preventDefault();
        var btn = $(this);
        $.ajax({
            url: site_url + "agents/searchByFilters",
            type: "POST",
            data: $("#agent_search_form").serialize(),
            dataType: "html",

            beforeSend: function() {
                $('.ajax-loader_icon').show();
                btn.prop('disabled', true);

            },
            success: function(result) {
                $('.ajax-loader_icon').hide();
                $('#content-area').html(result);
                btn.prop('disabled',false);

            },
            error: function(xhr) {

                btn.prop('disabled',false);
                alert("Error occured.please try again");
            }
        });
});


$('.agent_contact_info').click(function(e) {

    console.log('agent_info');

    e.preventDefault();

    var btn = $(this);
    var id = btn.attr('id');

    $.ajax({
        url: site_url + "agents/update_topup_balance",
        type: "POST",
        data: {id:id},
        dataType: "html",

        beforeSend: function() {

            btn.prop('disabled', true);

        },
        success: function(result) {
            if(result < 5){
                $("#agentInfo").modal('show');
            }
            else{
                $("#companyInfo").modal('show');
            }

            btn.prop('disabled',false);

        },
        error: function(xhr) {

            btn.prop('disabled',false);
            alert("Error occured.please try again");
        }
    });
});


function view_phone(id) {

    console.log(id);
    var $this = $(this);

    $.ajax({
        url: site_url + "agents/showPhoneNumber",
        type: "POST",
        data: {id:id},
        dataType: "html",

        beforeSend: function() {

            $(".view_phone").button('loading');

          //  btn.prop('disabled', true);

        },
        success: function(result) {
         //  $this.button('reset');
            $('.view_phone').fadeOut(1000);
            $(".view_phone").button('reset');
            $(".phoneno").html(result);
            $(".view_phone").prop('onclick', null);

        },
        error: function(xhr) {

           // btn.prop('disabled',false);
            alert("Error occured.please try again");
        }
    });
}


// ======================== START TAB FUNCTION LISTS =========================//



$(document).ready(function(){
    setTimeout(function() {

        $(".som-cl").trigger('click');
        $('#search_form').attr('action', site_url+'agents/searchByFilters');
    },5);

});


var count = 0;


$('li').click(function(e){


    $('input[placeholder], textarea[placeholder]').blur();
    var k = $(this).attr('id');
    $('#looking_for').attr('value', k);

    if (k == 'rent') {
        $("#location").attr("placeholder", "Localisation").blur();
    }
    else if (k == 'sell') {
        $("#location").attr("placeholder", "Localisation").blur();
    }
    else if (k == 'any') {
        $("#location").attr("placeholder", "Localisation").blur();

    }
});

$('.agent_tab_swticher').click(function(e){

    var search_type = $(this).attr('id');
    console.log(search_type);

    e.preventDefault();
    e.stopPropagation();
    $('.za-track-event').removeClass('za-track-event').addClass('search-tab');
    $(this).addClass('za-track-event').removeClass('search-tab');


});

$('.tab_swticher').click(function(e){

    count += 1;

    var search_type = $(this).attr('id');
    console.log(search_type);

    if(count > 1){

        if(search_type == 'property'){
            $('.splash-inner-media').css("background-image", "url("+site_url+"assets/img/landing-bedroom.jpg)");

            $('#search_form').attr('action', site_url+'search');
        }else{
            $('.splash-inner-media').css("background-image", "url("+site_url+"assets/img/landing-img.jpg)");
            $('#search_form').attr('action', site_url+'agents/searchByFilters');
        }



    }

    e.preventDefault();
    e.stopPropagation();
    $('.za-track-event').removeClass('za-track-event').addClass('search-tab');
    $(this).addClass('za-track-event').removeClass('search-tab');


});

// ========================== END TAB FUNCTION LISTS =========================//

function IfQuickContactForm() {
    $('#msg_responce')
        .show()
        .html('<div  class="alert alert-danger"> <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>Your account is not activated yet,Please confirm your email address before using this feature.</div>');
    // $('#msg_responce').fadeOut(2000);


}

function validatelatlon() {


    setTimeout(function(){

        var latitude = document.getElementById("lat").value;
        var longitude = document.getElementById('lng').value;

        console.log(latitude + longitude);

        //var regex = new RegExp("^-?([1-8]?[1-9]|[1-9]0)\\.{1}\\d{1,6}");
     //   var regex = new RegExp("^(\\+|-)?(?:90(?:(?:\\.0{1,6})?)|(?:[0-9]|[1-8][0-9])(?:(?:\\.[0-9]{1,6})?))$\");
       // var regex = new RegExp("^([-+]?\d{1,2}[.]\d+),\s*([-+]?\d{1,3}[.]\d+)$");
        var regex = new RegExp("^(\()([-+]?)([\d]{1,2})(((\.)(\d+)(,)))(\s*)(([-+]?)([\d]{1,3})((\.)(\d+))?(\)))$");


        if( regex.exec(latitude) ) {
            console.log('lat _success');
        } else {
            console.log('lat _error');
        }

        if( regex.exec(longitude) ) {
            console.log('long _success');
        } else {
            console.log('long _error');
        }

    },1000);




}

function view_application(title,dataURL) {

        $("#model_title").empty();
        $("#model_title").html(title);
        $("#pop-viewApp").modal({show:true});
        $("#loaded_data").load( dataURL );
        $("div.apply_tab").each(function()
        {
            $(this).removeClass("in");
            $(this).removeClass("active");
        });
        $(".login-tabs li").each(function()
        {
            $(this).removeClass("active");
            $(".login-tabs li#about_me").addClass("active");
        });


}










/*
* iziToast | v1.2.0
* http://izitoast.marcelodolce.com
* by Marcelo Dolce.
*/
!function(t,e){"function"==typeof define&&define.amd?define([],e(t)):"object"==typeof exports?module.exports=e(t):t.iziToast=e(t)}("undefined"!=typeof global?global:window||this.window||this.global,function(t){"use strict";var e={},o="iziToast",n=(document.querySelector("body"),!!/Mobi/.test(navigator.userAgent)),s=/Chrome/.test(navigator.userAgent)&&/Google Inc/.test(navigator.vendor),i="undefined"!=typeof InstallTrigger,a="ontouchstart"in document.documentElement,r=["bottomRight","bottomLeft","bottomCenter","topRight","topLeft","topCenter","center"],l={info:{color:"blue",icon:"ico-info"},success:{color:"green",icon:"ico-success"},warning:{color:"orange",icon:"ico-warning"},error:{color:"red",icon:"ico-error"},question:{color:"yellow",icon:"ico-question"}},d=568,c={},u={id:null,"class":"",title:"",titleColor:"",titleSize:"",titleLineHeight:"",message:"",messageColor:"",messageSize:"",messageLineHeight:"",backgroundColor:"",theme:"light",color:"",icon:"",iconText:"",iconColor:"",image:"",imageWidth:50,maxWidth:null,zindex:null,layout:1,balloon:!1,close:!0,closeOnEscape:!1,rtl:!1,position:"bottomRight",target:"",targetFirst:!0,toastOnce:!1,timeout:5e3,animateInside:!0,drag:!0,pauseOnHover:!0,resetOnHover:!1,progressBar:!0,progressBarColor:"",progressBarEasing:"linear",overlay:!1,overlayClose:!1,overlayColor:"rgba(0, 0, 0, 0.6)",transitionIn:"fadeInUp",transitionOut:"fadeOut",transitionInMobile:"fadeInUp",transitionOutMobile:"fadeOutDown",buttons:{},onOpening:function(){},onOpened:function(){},onClosing:function(){},onClosed:function(){}};if("remove"in Element.prototype||(Element.prototype.remove=function(){this.parentNode&&this.parentNode.removeChild(this)}),"function"!=typeof window.CustomEvent){var p=function(t,e){e=e||{bubbles:!1,cancelable:!1,detail:void 0};var o=document.createEvent("CustomEvent");return o.initCustomEvent(t,e.bubbles,e.cancelable,e.detail),o};p.prototype=window.Event.prototype,window.CustomEvent=p}var m=function(t,e,o){if("[object Object]"===Object.prototype.toString.call(t))for(var n in t)Object.prototype.hasOwnProperty.call(t,n)&&e.call(o,t[n],n,t);else if(t)for(var s=0,i=t.length;i>s;s++)e.call(o,t[s],s,t)},g=function(t,e){var o={};return m(t,function(e,n){o[n]=t[n]}),m(e,function(t,n){o[n]=e[n]}),o},f=function(t){var e=document.createDocumentFragment(),o=document.createElement("div");for(o.innerHTML=t;o.firstChild;)e.appendChild(o.firstChild);return e},v=function(t){return"#"==t.substring(0,1)||"rgb"==t.substring(0,3)||"hsl"==t.substring(0,3)},y=function(t){try{return btoa(atob(t))==t}catch(e){return!1}},h=function(){return{move:function(t,e,n,a){var r,l=.3,d=180;0!==a&&(t.classList.add(o+"-dragged"),t.style.transform="translateX("+a+"px)",a>0?(r=(d-a)/d,l>r&&e.hide(t,g(n,{transitionOut:"fadeOutRight",transitionOutMobile:"fadeOutRight"}),"drag")):(r=(d+a)/d,l>r&&e.hide(t,g(n,{transitionOut:"fadeOutLeft",transitionOutMobile:"fadeOutLeft"}),"drag")),t.style.opacity=r,l>r&&((s||i)&&(t.style.left=a+"px"),t.parentNode.style.opacity=l,this.stopMoving(t,null)))},startMoving:function(t,e,o,n){n=n||window.event;var s=a?n.touches[0].clientX:n.clientX,i=t.style.transform.replace("px)","");i=i.replace("translateX(","");var r=s-i;t.classList.remove(o.transitionIn),t.classList.remove(o.transitionInMobile),t.style.transition="",a?document.ontouchmove=function(n){n.preventDefault(),n=n||window.event;var s=n.touches[0].clientX,i=s-r;h.move(t,e,o,i)}:document.onmousemove=function(n){n.preventDefault(),n=n||window.event;var s=n.clientX,i=s-r;h.move(t,e,o,i)}},stopMoving:function(t,e){a?document.ontouchmove=function(){}:document.onmousemove=function(){},t.style.opacity="",t.style.transform="",t.classList.contains(o+"-dragged")&&(t.classList.remove(o+"-dragged"),t.style.transition="transform 0.4s ease, opacity 0.4s ease",setTimeout(function(){t.style.transition=""},400))}}}();return e.destroy=function(){m(document.querySelectorAll("."+o+"-wrapper"),function(t,e){t.remove()}),m(document.querySelectorAll("."+o),function(t,e){t.remove()}),document.removeEventListener(o+"-opened",{},!1),document.removeEventListener(o+"-opening",{},!1),document.removeEventListener(o+"-closing",{},!1),document.removeEventListener(o+"-closed",{},!1),document.removeEventListener("keyup",{},!1),c={}},e.settings=function(t){e.destroy(),c=t,u=g(u,t||{})},m(l,function(t,o){e[o]=function(e){var o=g(c,e||{});o=g(t,o||{}),this.show(o)}}),e.progress=function(t,e,n){var s=this,i=g(s.settings,e||{}),a=t.querySelector("."+o+"-progressbar div");return{start:function(){null!==a&&(a.style.transition="width "+i.timeout+"ms "+i.progressBarEasing,a.style.width="0%"),i.TIME.START=(new Date).getTime(),i.TIME.END=i.TIME.START+i.timeout,i.TIME.TIMER=setTimeout(function(){clearTimeout(i.TIME.TIMER),t.classList.contains(o+"-closing")||(s.hide(t,i,"timeout"),"function"==typeof n&&n.apply(s))},i.timeout)},pause:function(){if(i.TIME.REMAINING=i.TIME.END-(new Date).getTime(),clearTimeout(i.TIME.TIMER),null!==a){var t=window.getComputedStyle(a),e=t.getPropertyValue("width");a.style.transition="none",a.style.width=e}"function"==typeof n&&setTimeout(function(){n.apply(s)},10)},resume:function(){null!==a&&(a.style.transition="width "+i.TIME.REMAINING+"ms "+i.progressBarEasing,a.style.width="0%"),i.TIME.END=(new Date).getTime()+i.TIME.REMAINING,i.TIME.TIMER=setTimeout(function(){clearTimeout(i.TIME.TIMER),t.classList.contains(o+"-closing")||(s.hide(t,i,"timeout"),"function"==typeof n&&n.apply(s))},i.TIME.REMAINING)},reset:function(){clearTimeout(i.TIME.TIMER),null!==a&&(a.style.transition="none",a.style.width="100%"),"function"==typeof n&&setTimeout(function(){n.apply(s)},10)}}},e.hide=function(t,e,s){var i=g(this.settings,e||{});s=s||null,"object"!=typeof t&&(t=document.querySelector(t)),t.classList.add(o+"-closing"),i.closedBy=s,i.REF=t.getAttribute("data-iziToast-ref"),function(){var t=document.querySelector("."+o+"-overlay");if(null!==t){var e=t.getAttribute("data-iziToast-ref");e=e.split(",");var n=e.indexOf(i.REF);-1!==n&&e.splice(n,1),t.setAttribute("data-iziToast-ref",e.join()),0===e.length&&(t.classList.remove("fadeIn"),t.classList.add("fadeOut"),setTimeout(function(){t.remove()},700))}}(),(i.transitionIn||i.transitionInMobile)&&(t.classList.remove(i.transitionIn),t.classList.remove(i.transitionInMobile)),n||window.innerWidth<=d?i.transitionOutMobile&&t.classList.add(i.transitionOutMobile):i.transitionOut&&t.classList.add(i.transitionOut);var a=t.parentNode.offsetHeight;t.parentNode.style.height=a+"px",t.style.pointerEvents="none",(!n||window.innerWidth>d)&&(t.parentNode.style.transitionDelay="0.2s");try{i.closedBy=s;var r=new CustomEvent(o+"-closing",{detail:i,bubbles:!0,cancelable:!0});document.dispatchEvent(r)}catch(l){console.warn(l)}setTimeout(function(){t.parentNode.style.height="0px",t.parentNode.style.overflow="",setTimeout(function(){t.parentNode.remove();try{i.closedBy=s;var e=new CustomEvent(o+"-closed",{detail:i,bubbles:!0,cancelable:!0});document.dispatchEvent(e)}catch(n){console.warn(n)}"undefined"!=typeof i.onClosed&&i.onClosed.apply(null,[i,t,s])},1e3)},200),"undefined"!=typeof i.onClosing&&i.onClosing.apply(null,[i,t,s])},e.show=function(t){var e=this,s=g(c,t||{});if(s=g(u,s),s.TIME={},s.toastOnce&&s.id&&document.querySelectorAll("."+o+"#"+s.id).length>0)return!1;s.REF=(new Date).getTime()+Math.floor(1e7*Math.random()+1);var i={body:document.querySelector("body"),overlay:document.createElement("div"),toast:document.createElement("div"),toastBody:document.createElement("div"),toastTexts:document.createElement("div"),toastCapsule:document.createElement("div"),icon:document.createElement("i"),cover:document.createElement("div"),buttons:document.createElement("div"),wrapper:null};i.toast.setAttribute("data-iziToast-ref",s.REF),i.toast.appendChild(i.toastBody),i.toastCapsule.appendChild(i.toast),function(){if(i.toast.classList.add(o),i.toast.classList.add(o+"-opening"),i.toastCapsule.classList.add(o+"-capsule"),i.toastBody.classList.add(o+"-body"),i.toastTexts.classList.add(o+"-texts"),n||window.innerWidth<=d?s.transitionInMobile&&i.toast.classList.add(s.transitionInMobile):s.transitionIn&&i.toast.classList.add(s.transitionIn),s["class"]){var t=s["class"].split(" ");m(t,function(t,e){i.toast.classList.add(t)})}s.id&&(i.toast.id=s.id),s.rtl&&i.toast.classList.add(o+"-rtl"),s.layout>1&&i.toast.classList.add(o+"-layout"+s.layout),s.balloon&&i.toast.classList.add(o+"-balloon"),s.maxWidth&&(isNaN(s.maxWidth)?i.toast.style.maxWidth=s.maxWidth:i.toast.style.maxWidth=s.maxWidth+"px"),""===s.theme&&"light"===s.theme||i.toast.classList.add(o+"-theme-"+s.theme),s.color&&(v(s.color)?i.toast.style.background=s.color:i.toast.classList.add(o+"-color-"+s.color)),s.backgroundColor&&(i.toast.style.background=s.backgroundColor,s.balloon&&(i.toast.style.borderColor=s.backgroundColor))}(),function(){s.image&&(i.cover.classList.add(o+"-cover"),i.cover.style.width=s.imageWidth+"px",y(s.image.replace(/ /g,""))?i.cover.style.backgroundImage="url(data:image/png;base64,"+s.image.replace(/ /g,"")+")":i.cover.style.backgroundImage="url("+s.image+")",s.rtl?i.toastBody.style.marginRight=s.imageWidth+10+"px":i.toastBody.style.marginLeft=s.imageWidth+10+"px",i.toast.appendChild(i.cover))}(),function(){s.close?(i.buttonClose=document.createElement("button"),i.buttonClose.classList.add(o+"-close"),i.buttonClose.addEventListener("click",function(t){t.target;e.hide(i.toast,s,"button")}),i.toast.appendChild(i.buttonClose)):s.rtl?i.toast.style.paddingLeft="20px":i.toast.style.paddingRight="20px"}(),function(){s.timeout&&(s.progressBar&&(i.progressBar=document.createElement("div"),i.progressBarDiv=document.createElement("div"),i.progressBar.classList.add(o+"-progressbar"),i.progressBarDiv.style.background=s.progressBarColor,i.progressBar.appendChild(i.progressBarDiv),i.toast.appendChild(i.progressBar)),s.pauseOnHover&&!s.resetOnHover&&(i.toast.addEventListener("mouseenter",function(t){this.classList.add(o+"-paused"),e.progress(i.toast,s).pause()}),i.toast.addEventListener("mouseleave",function(t){this.classList.remove(o+"-paused"),e.progress(i.toast,s).resume()})),s.resetOnHover&&(i.toast.addEventListener("mouseenter",function(t){this.classList.add(o+"-reseted"),e.progress(i.toast,s).reset()}),i.toast.addEventListener("mouseleave",function(t){this.classList.remove(o+"-reseted"),e.progress(i.toast,s).start()})))}(),function(){s.icon&&(i.icon.setAttribute("class",o+"-icon "+s.icon),s.iconText&&i.icon.appendChild(document.createTextNode(s.iconText)),s.rtl?i.toastBody.style.paddingRight="33px":i.toastBody.style.paddingLeft="33px",s.iconColor&&(i.icon.style.color=s.iconColor),i.toastBody.appendChild(i.icon))}(),function(){s.title.length>0&&(i.strong=document.createElement("strong"),i.strong.classList.add(o+"-title"),i.strong.appendChild(f(s.title)),i.toastTexts.appendChild(i.strong),s.titleColor&&(i.strong.style.color=s.titleColor),s.titleSize&&(isNaN(s.titleSize)?i.strong.style.fontSize=s.titleSize:i.strong.style.fontSize=s.titleSize+"px"),s.titleLineHeight&&(isNaN(s.titleSize)?i.strong.style.lineHeight=s.titleLineHeight:i.strong.style.lineHeight=s.titleLineHeight+"px"))}(),function(){s.message.length>0&&(i.p=document.createElement("p"),i.p.classList.add(o+"-message"),i.p.appendChild(f(s.message)),i.toastTexts.appendChild(i.p),s.messageColor&&(i.p.style.color=s.messageColor),s.messageSize&&(isNaN(s.titleSize)?i.p.style.fontSize=s.messageSize:i.p.style.fontSize=s.messageSize+"px"),s.messageLineHeight&&(isNaN(s.titleSize)?i.p.style.lineHeight=s.messageLineHeight:i.p.style.lineHeight=s.messageLineHeight+"px"))}(),s.title.length>0&&s.message.length>0&&(s.rtl?i.strong.style.marginLeft="10px":2===s.layout||s.rtl||(i.strong.style.marginRight="10px")),i.toastBody.appendChild(i.toastTexts),function(){s.buttons.length>0&&(i.buttons.classList.add(o+"-buttons"),s.title.length>0&&0===s.message.length&&(s.rtl?i.strong.style.marginLeft="15px":i.strong.style.marginRight="15px"),s.message.length>0&&(s.rtl?i.p.style.marginLeft="15px":i.p.style.marginRight="15px",i.p.style.marginBottom="0"),m(s.buttons,function(t,n){i.buttons.appendChild(f(t[0]));var s=i.buttons.childNodes;s[n].classList.add(o+"-buttons-child"),t[2]&&setTimeout(function(){s[n].focus()},300),s[n].addEventListener("click",function(o){o.preventDefault();var n=t[1];return n(e,i.toast)})})),i.toastBody.appendChild(i.buttons)}(),function(){i.toastCapsule.style.visibility="hidden",setTimeout(function(){var t=i.toast.offsetHeight,o=i.toast.currentStyle||window.getComputedStyle(i.toast),n=o.marginTop;n=n.split("px"),n=parseInt(n[0]);var a=o.marginBottom;a=a.split("px"),a=parseInt(a[0]),i.toastCapsule.style.visibility="",i.toastCapsule.style.height=t+a+n+"px",setTimeout(function(){i.toastCapsule.style.height="auto",s.target&&(i.toastCapsule.style.overflow="visible")},500),s.timeout&&e.progress(i.toast,s).start()},100)}(),function(){var t=s.position;if(s.target)i.wrapper=document.querySelector(s.target),i.wrapper.classList.add(o+"-target"),s.targetFirst?i.wrapper.insertBefore(i.toastCapsule,i.wrapper.firstChild):i.wrapper.appendChild(i.toastCapsule);else{if(-1==r.indexOf(s.position))return void console.warn("["+o+"] Incorrect position.\nIt can be › "+r);t=n||window.innerWidth<=d?"bottomLeft"==s.position||"bottomRight"==s.position||"bottomCenter"==s.position?o+"-wrapper-bottomCenter":"topLeft"==s.position||"topRight"==s.position||"topCenter"==s.position?o+"-wrapper-topCenter":o+"-wrapper-center":o+"-wrapper-"+t,i.wrapper=document.querySelector("."+o+"-wrapper."+t),i.wrapper||(i.wrapper=document.createElement("div"),i.wrapper.classList.add(o+"-wrapper"),i.wrapper.classList.add(t),document.body.appendChild(i.wrapper)),"topLeft"==s.position||"topCenter"==s.position||"topRight"==s.position?i.wrapper.insertBefore(i.toastCapsule,i.wrapper.firstChild):i.wrapper.appendChild(i.toastCapsule)}isNaN(s.zindex)?console.warn("["+o+"] Invalid zIndex."):i.wrapper.style.zIndex=s.zindex}(),function(){s.overlay&&(null!==document.querySelector("."+o+"-overlay.fadeIn")?(i.overlay=document.querySelector("."+o+"-overlay"),i.overlay.setAttribute("data-iziToast-ref",i.overlay.getAttribute("data-iziToast-ref")+","+s.REF),isNaN(s.zindex)||null===s.zindex||(i.overlay.style.zIndex=s.zindex-1)):(i.overlay.classList.add(o+"-overlay"),i.overlay.classList.add("fadeIn"),i.overlay.style.background=s.overlayColor,i.overlay.setAttribute("data-iziToast-ref",s.REF),isNaN(s.zindex)||null===s.zindex||(i.overlay.style.zIndex=s.zindex-1),document.querySelector("body").appendChild(i.overlay)),s.overlayClose?(i.overlay.removeEventListener("click",{}),i.overlay.addEventListener("click",function(t){e.hide(i.toast,s,"overlay")})):i.overlay.removeEventListener("click",{}))}(),function(){if(s.animateInside){i.toast.classList.add(o+"-animateInside");var t=[200,100,300];if("bounceInLeft"==s.transitionIn&&(t=[400,200,400]),s.title.length>0&&setTimeout(function(){i.strong.classList.add("slideIn")},t[0]),s.message.length>0&&setTimeout(function(){i.p.classList.add("slideIn")},t[1]),s.icon&&setTimeout(function(){i.icon.classList.add("revealIn")},t[2]),s.buttons.length>0&&i.buttons){var e=150;m(i.buttons.childNodes,function(t,o){setTimeout(function(){t.classList.add("revealIn")},e),e+=150})}}}(),s.onOpening.apply(null,[s,i.toast]);try{var l=new CustomEvent(o+"-opening",{detail:s,bubbles:!0,cancelable:!0});document.dispatchEvent(l)}catch(p){console.warn(p)}setTimeout(function(){i.toast.classList.remove(o+"-opening"),i.toast.classList.add(o+"-opened");try{var t=new CustomEvent(o+"-opened",{detail:s,bubbles:!0,cancelable:!0});document.dispatchEvent(t)}catch(e){console.warn(e)}s.onOpened.apply(null,[s,i.toast])},1e3),s.drag&&(a?(i.toast.addEventListener("touchstart",function(t){h.startMoving(this,e,s,t)},!1),i.toast.addEventListener("touchend",function(t){h.stopMoving(this,t)},!1)):(i.toast.addEventListener("mousedown",function(t){t.preventDefault(),h.startMoving(this,e,s,t)},!1),i.toast.addEventListener("mouseup",function(t){t.preventDefault(),h.stopMoving(this,t)},!1))),s.closeOnEscape&&document.addEventListener("keyup",function(t){t=t||window.event,27==t.keyCode&&e.hide(i.toast,s,"esc")}),e.toast=i.toast},e});
jQuery(document).ready(function ($)
{
    $("#file").change(function ()
    {
        var file = this.files[0];
        var imagefile = file.type;
        var match = ["image/jpeg", "image/png", "image/jpg"];
        if (!((imagefile == match[0]) || (imagefile == match[1]) || (imagefile == match[2])))
        {
            alert("Please Select A valid Image File.Only jpeg, jpg and png Images type allowed");
            return false;
        }
        else
        {
            var reader = new FileReader();
            reader.onload = imageIsLoaded;
            reader.readAsDataURL(this.files[0]);
        }
    });

    $("#listing_file").change(function ()
    {
        var file = this.files[0];
        var imagefile = file.type;
        var match = ["image/jpeg", "image/png", "image/jpg"];
        if (!((imagefile == match[0]) || (imagefile == match[1]) || (imagefile == match[2])))
        {
            alert("Please Select A valid Image File.Only jpeg, jpg and png Images type allowed");
            return false;
        }
        else
        {
            var reader = new FileReader();
            reader.onload = listingimageIsLoaded;
            reader.readAsDataURL(this.files[0]);
        }
    });

});

function imageIsLoaded(e)
{
    $('#previewing').attr('src', e.target.result);
    $('#previewing').attr('width', '150px');
    $('#previewing').attr('height', '150px');
}

function listingimageIsLoaded(e)
{
    $('#previewing').attr('src', e.target.result);
    $('#previewing').attr('width', '220px');
    $('#previewing').attr('height', '200px');
}



function UpcomingTripsMaps(id, lati, longi) {
    var map; // Global declaration of the map
    var lat_longs_map = new Array();
    var markers_map = new Array();
    var placesService;
    var placesAutocomplete;

    var iw_map = new google.maps.InfoWindow();


    var myLatlng = new google.maps.LatLng(lati, longi);
    var myOptions = {
        scrollwheel: false,
        zoom: 14,
        center: myLatlng,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    }
    map = new google.maps.Map(document.getElementById("map_" + id), myOptions);

    var cityCircle = new google.maps.Circle({
        strokeColor: '#9D7F48',
        strokeOpacity: 0.8,
        strokeWeight: 2,
        fillColor: '#9D7F48',
        fillOpacity: 0.35,
        map: map,
        center: map.center,
        radius: 250
    });

}

function TripsMaps(id, lat, long) {
    google.maps.event.addDomListener(window, 'load', UpcomingTripsMaps(id, lat, long));
}

function ApproveModel(bid){
    var url = site_url + 'booking/ApproveModel/';
    var data = {
        bid   :bid
    };
    $.ajax({
        type: "POST",
        cache: false,
        url: url,
        data: data,
        async: false,
        success: function(result) {

            $("#ApprovemodelWrap").html(result);
            $('#approvemodel'+bid).modal('show');

        },
    });
}

function ContactHostDashboard(bid){
    var url = site_url + 'dashboard/contactHost/';
    var data = {
        bid   :bid
    };
    $.ajax({
        type: "POST",
        cache: false,
        url: url,
        data: data,
        async: false,
        success: function(result) {

            $("#ContactHostDashboardWrap").html(result);
            $('#ContactHostDashboard'+bid).modal('show');

        },
    });
}

$(document).on('click', '#contacthost', function (e) {
    e.preventDefault();
    var data = $('#contacthostform').serialize();
    var url = site_url + 'Inbox/contact_host/';
    $.ajax({
        type: "POST",
        cache: false,
        url: url,
        data: data,
        success: function (result) {
            if (result) {
                $("#contact_response").html('<div class="alert alert-success"><button class="close" data-dismiss="alert"></button>You successfully messaged your selected agents. Expect a response soon!</div>');
            } else {
                $("#contact_response").html('<div class="alert alert-danger"><button class="close" data-dismiss="alert"></button> Whoops! something wrong,try again later.</div>');
            }

        },
        async: false
    });
    return false;
});


$(function () {
    $('#Manual').hide();
    $('#Calendar').hide();
    $('#availability_through').change(function () {
        if ($('#availability_through').val() == 'Calendar') {
            $('#Calendar').show();
            $('#Manual').hide();
        } else {
            $('#Calendar').hide();
            $('#Manual').show();
        }
    });
});


var room = 1;
function addFloor() {
    room++;
    var objTo = document.getElementById('plan_box');
    var divtest = document.createElement("tr");
    divtest.setAttribute("class", "removeclass"+room);
    var rdiv = 'removeclass'+room;
    divtest.innerHTML = '<td class="row-sort"></td><td class="sort-middle"><div class="sort-inner-block"><div class="row"><div class="col-sm-4 col-xs-6"><div class="form-group"><label for="planTitle">Plan Title</label><input name="title[]" type="text" id="planTitle" class="form-control"></div></div><div class="col-sm-4 col-xs-6"><div class="form-group"><label for="planSize">Plan Size</label><input name="size[]" type="number" id="planSize" class="form-control"></div></div><div class="col-sm-4 col-xs-6"><div class="form-group"><label for="planBedrooms">Plan Bedrooms</label><input name="beds[]" type="number" id="planBedrooms" class="form-control"></div></div><div class="col-sm-4 col-xs-6"> <div class="form-group"><label for="planBathrooms">Plan Bathrooms</label><input name="bath[]" type="number" id="planBathrooms" class="form-control"></div></div><div class="col-sm-4 col-xs-6"><div class="form-group"><label for="planPrice">Plan Price</label><input name="price[]" type="number" step="any" id="planPrice" class="form-control"></div></div><div class="col-sm-4 col-xs-6"><div class="form-group"><label for="planImage">Plan Image</label><input type="file" name="userFile[]" class="file"><div class="file-upload-block"><input name="" type="text" id="planImage" class="form-control" disabled placeholder="Upload Image"><button class="browse btn btn-primary" type="button">Select</button></div></div></div><div class="col-sm-12 col-xs-12"><label for="planDescription">Plan Description</label><textarea name="description[]" rows="4" id="planDescription" class="form-control"></textarea></div></div></div></td><td class="row-remove"><span onclick="remove_floor_plan('+ room +');" class="remove"><i class="fa fa-remove"></i></span></td>';
    objTo.prepend(divtest);
}

function remove_floor_plan(rid) {
    $('.removeclass'+rid).remove();
}

/** Add Document **/
function addDocument() {
    room++;
    var objTo = document.getElementById('add-attachment');
    var divtest = document.createElement("tr");
    divtest.setAttribute("class", "removedoc"+room);
    var rdiv = 'removedoc'+room;
    divtest.innerHTML = '<td class="row-sort"></td><td class="sort-middle"><div class="sort-inner-block"><div class="row"><div class="col-sm-6 col-xs-6"><div class="form-group"><label for="planTitle">Title</label><input name="doc_title[]" type="text" id="" class="form-control"></div></div><div class="col-sm-6 col-xs-6"><div class="form-group"><label for="planImage">Image</label><input type="file" name="docFile[]" class="file"><div class="file-upload-block"><input name="" type="text" id="planImage" class="form-control" disabled placeholder="Upload Image"><button class="browse btn btn-primary" type="button">Select</button></div></div></div></div></div></td><td class="row-remove"><span onclick="remove_more_media('+ room +');" class="remove"><i class="fa fa-remove"></i></span></td>';
    objTo.prepend(divtest);
}

function remove_more_media(rid) {
    $('.removedoc'+rid).remove();
}

$(document).on('click', '.browse', function(){
    var file = $(this).parent().parent().parent().find('.file');
    file.trigger('click');
});


$(document).on('change', '.file', function(){
    $(this).parent().find('.form-control').val($(this).val().replace(/C:\\fakepath\\/i, ''));
});


$(document).ready(function() {
    var showChar = 150;
    var ellipsestext = "...";
    var moretext = "more >";
    var lesstext = "less";


    $('.viewmore').each(function() {
        var content = $(this).html();

        if(content.length > showChar) {

            var c = content.substr(0, showChar);
            var h = content.substr(showChar, content.length - showChar);

            var html = c + '<span class="moreellipses">' + ellipsestext+ '&nbsp;</span><span class="morecontent"><span>' + h + '</span>&nbsp;&nbsp;<a href="" class="morelink">' + moretext + '</a></span>';

            $(this).html(html);
        }

    });

    $(".morelink").click(function(){
        if($(this).hasClass("less")) {
            $(this).removeClass("less");
            $(this).html(moretext);
        } else {
            $(this).addClass("less");
            $(this).html(lesstext);
        }
        $(this).parent().prev().toggle();
        $(this).prev().toggle();
        return false;
    });
});

/* ------------------------------------------------------------------------ */
/*  Date Time picker
 /* ------------------------------------------------------------------------ */
// var date_ele = $('.date_time');
// if(date_ele.length > 0) {
//     date_ele.datetimepicker({
//         format: 'YYYY-MM-DD HH:mm:ss',
//         icons: {
//             time: "fa fa-clock-o",
//             date: "fa fa-calendar",
//             up: "fa fa-arrow-up",
//             down: "fa fa-arrow-down",
//             left: "fa fa-arrow-left"
//         }
//     });
// }
//
//
// var date_ele = $('.date');
// if(date_ele.length > 0) {
//     date_ele.datetimepicker({
//         format: 'YYYY-MM-DD',
//         icons: {
//             time: "fa fa-clock-o",
//             date: "fa fa-calendar",
//             up: "fa fa-arrow-up",
//             down: "fa fa-arrow-down",
//             left: "fa fa-arrow-left"
//         }
//     });
// }
//
//
// var date_ele = $('.time');
// if(date_ele.length > 0) {
//     date_ele.datetimepicker({
//         format: 'HH:mm:ss',
//         icons: {
//             time: "fa fa-clock-o",
//             date: "fa fa-calendar",
//             up: "fa fa-arrow-up",
//             down: "fa fa-arrow-down",
//             left: "fa fa-arrow-left"
//         }
//     });
// }


function toggleThis()
{
    $('.addMember-block').slideToggle('2000',"swing", function () {});

}


/** Delete Appointments **/

function deleteAppointment(id){

    if(confirm('Are you sure your want to delete?'))
    {
        var url = site_url + 'listings/delete_floor_plan/';

        $.ajax({
            type: "POST",
            url: url,
            data: {id:id}
        }).done(function( result) {

            if (result) {

                $('.row_'+id).hide();

                $("#response").html('<div class="alert alert-success"><button class="close" data-dismiss="alert"></button> Floor has been deleted successfully!</div>');

            } else {

                $("#response").html('<div class="alert alert-danger"><button class="close" data-dismiss="alert"></button> Whoops! something wrong,try again later.</div>');

            }
        });
        return false;



    }


}


/** Validate Agents Creation **/


$('#agent_registration').validate({
    errorElement: 'span',
    errorClass: 'help-block',
    focusInvalid: false,
    ignore: ":not(:visible)",
    rules: {

        first_name: {
            required: true
        },
        last_name: {
            required: true
        },
        email: {
            required: true,
            email: true
        },
        phone:{
            required: true,
        },
        designation:{
            required: true,
        },
        location:{
            required: true,
        },
        password: {
            required: true,
            minlength: 8,
            maxlength: 15,

        }
    },

    messages: {

        first_name:"Le pré nom est requis",
        last_name: "Le nom est requis",
        email: "Veuillez entrer un valide email adresse",
        phone: "Veuillez entrer un numéro de téléphone",
        designation:"Veuillez entrer la désignation",
        location: "Veuillez entrer un lieu",
        password: {
            required: "Mot de passe requis."
        }

    },

    invalidHandler: function (event, validator) {

    },

    highlight: function (element) {
        $(element)
            .closest('.form-group').addClass('has-error');
    },

    success: function (label) {
        label.closest('.form-group').removeClass('has-error');
        label.remove();
    },

    errorPlacement: function (error, element) {

        if (element.closest('.input-icon').size() === 1) {
            error.insertAfter(element.closest('.input-icon'));
        } else {
            error.insertAfter(element);
        }
    },

    submitHandler: function (form) {
        var data = $('#agent_registration').serialize();
        var url = site_url + 'agents/postAgents/';

        $.ajax({
            type: "POST",
            cache: false,
            url: url,
            data: data,
            dataType:'html',
            success: function (result) {

                console.log(result);

                if (result == 'success') {
                    console.log('success');

                    $("#response").html('<div class="alert alert-success"><button class="close" data-dismiss="alert"></button>Membre de l’équipe ajouter avec succès!</div>');
                    $('#agent_registration').trigger("reset");
                    getAllMembers();

                } else if(result == 'error') {

                    console.log('errrrrrr');

                    $("#response").html('<div class="alert alert-danger"><button class="close" data-dismiss="alert"></button> Whoops! something wrong,try again later.</div>');
                }
                else{

                    console.log('resssssst');
                    $("#response").html('<div class="alert alert-danger"><button class="close" data-dismiss="alert"></button>'+result+'</div>');

                }
            },
            async: true
        });
    }
});
function AddExistingMember() {
    var data = $('#agent_exist').serialize();
    var url = site_url + 'agents/AddExistingTeamMember/';
    $.ajax({
        type: "POST",
        cache: false,
        url: url,
        data: data,
        dataType:'html',
        success: function (result) {
            if (result == 'success') {

                $("#response").html('<div class="alert alert-success"><button class="close" data-dismiss="alert"></button>Membre de l’équipe ajouter avec succès!</div>');
                $('#agent_exist').trigger("reset");
                getAllMembers();
            } else if(result == 'error') {
                $("#response").html('<div class="alert alert-danger"><button class="close" data-dismiss="alert"></button> Whoops! something wrong,try again later.</div>');
            }
            else{
                $("#response").html('<div class="alert alert-danger"><button class="close" data-dismiss="alert"></button>'+result+'</div>');
            }
        },
        async: true
    });


}

function getAllMembers() {
    var url = site_url + 'agents/getAgentMembers/';
    $.ajax({
        type: "POST",
        cache: false,
        url: url,
        dataType:'html',
        beforeSend: function(){
            $("#loading").show();
        },
        success: function (result) {
            if (result) {
              $("#loading").hide();
              $('.team_members').html(result);

            } else {

                $(".team_members").html('<div class="alert alert-danger"><button class="close" data-dismiss="alert"></button> Whoops! something wrong,try again later.</div>');
            }
        },
        async: true
    });
}


/** Alert **/

$(document).on("click", ".delete_agent", function(){
//$('.delete_agent').click(function () {


    var id  = this.id;


    iziToast.show({
        color: 'light',
        icon: 'iziToast-icon ico-question revealIn',
        overlay: true,
        close: false,
        closeOnEscape: true,
        title: 'Hey',
        message: 'Voulez-vous confirmer cette action?',
        position: 'center',
        backgroundColor: 'rgba(255,249,178,0.9)',
        progressBarColor: 'rgba(255,249,178,0.9)',
        buttons: [
            ['<button><b>Oui</b></button>', function (instance, toast) {

                instance.hide(toast, { transitionOut: 'fadeOut' }, 'button');

                var url = site_url + 'agents/deleteAgent/';
                $.ajax({
                    type: "POST",
                    cache: false,
                    url: url,
                    data: {id:id},
                    dataType:'html',
                    beforeSend: function(){

                        //alert(id)
                        //$("#loading").show();
                    },
                    success: function (result) {
                        if (result) {

                            $("#member_"+id).hide(1000);

                        } else {

                           alert('Whoops! something wrong,try again later');
                        }
                    },
                    async: true
                });




            }, true],
            ['<button>NOn</button>', function (instance, toast) {

                instance.hide(toast, { transitionOut: 'fadeOut' }, 'button');

            }]
        ],
    });

}); // ! .click()


//$('.agent_status').click(function () {
$(document).on("click", ".agent_status", function(){



    var id  = this.id;
    var status = $(this).attr('status');


    iziToast.show({
        color: 'light',
        icon: 'iziToast-icon ico-question revealIn',
        overlay: true,
        close: false,
        closeOnEscape: true,
        title: 'Hey',
        message: 'voulez-vous confirmer cette action?',
        position: 'center',
        backgroundColor: 'rgba(255,249,178,0.9)',
        progressBarColor: 'rgba(255,249,178,0.9)',
        buttons: [
            ['<button><b>Oui</b></button>', function (instance, toast) {

                instance.hide(toast, { transitionOut: 'fadeOut' }, 'button');

                var url = site_url + 'agents/updateAgentStatus/';
                $.ajax({
                    type: "POST",
                    cache: false,
                    url: url,
                    data: {id:id,status:status},
                    // dataType:'html',
                    beforeSend: function(){

                        //alert(id)
                        //$("#loading").show();
                    },
                    success: function (result) {

                        if (result == 'success') {

                            if(status == 1){
                                $(".status_icon_"+id).html('<i class="fa fa-times-circle-o" aria-hidden="true"></i>');
                                $(".status_icon_"+id).parents('a').css("background-color", "#f0ad4e");
                                $('#'+id).attr('status','0');
                            }


                            else{

                                $(".status_icon_"+id).html('<i class="fa fa-check-circle-o" aria-hidden="true"></i>');
                                $(".status_icon_"+id).parents('a').css("background-color", "#71c514");
                                $('#'+id).attr('status','1');
                            }



                        } else {

                            alert('Whoops! something wrong,try again later');
                        }
                    },
                    //async: true
                });




            }, true],
            ['<button>Non</button>', function (instance, toast) {

                instance.hide(toast, { transitionOut: 'fadeOut' }, 'button');

            }]
        ],
    });

});


function addRecommendation() {
    $("#user_recommendation").validate({
            ignore: "input[type='text']:hidden",
            rules: {
                'poster_name': {required: true},
                'poster_email': {required: true},
                'recommendation': {required: true},

            }
        }
    );

    var url = site_url + 'agents/userRecommendation/';
    var data = $('#user_recommendation').serialize();
    $.ajax({
        type: "POST",
        cache: false,
        url: url,
        data: data,
        dataType:'html',
        beforeSend: function(){
            $("#loading").show();
        },
        success: function (result) {

            if (result == 1) {
                $("#loading").hide();
                $('#user_recommendation').trigger("reset");
                $('#response_suc').html("You successfully submitted your recommendation.");
                setTimeout(function(){
                    window.location.reload(1);
                }, 2000);

            }
            else if (result == 0) {

                $("#response_suc").html('<div class="alert alert-danger"><button class="close" data-dismiss="alert"></button> Whoops! something wrong,try again later.</div>');

            }

            else {

                $("#response").html(result);
            }
        },
        async: true
    });

}

$(document).on("click", ".liststatusupdate", function(){
    var id  = this.id;
    iziToast.show({
        color: 'light',
        icon: 'iziToast-icon ico-question revealIn',
        overlay: true,
        close: false,
        closeOnEscape: true,
        title: 'Hey',
        message: 'Voulez-vous confirmer cette action?',
        position: 'center',
        backgroundColor: 'rgba(255,249,178,0.9)',
        progressBarColor: 'rgba(255,249,178,0.9)',
        buttons: [
            ['<button><b>Oui</b></button>', function (instance, toast) {
                instance.hide(toast, { transitionOut: 'fadeOut' }, 'button');
                var url = site_url + 'index.php/listings/delete_listing_status/';
                $.ajax({
                    type: "POST",
                    cache: false,
                    url: url,
                    data: {id:id},
                    dataType:'html',
                    success: function (result) {
                        if(result == 1) {
                            console.log('called');
                            $("#booking_row_"+id).hide();
                            $('#response')
                            .show()
                            .html('<div  class="alert alert-success"> <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>Your listing has been deleted successfully </div>');
                             $('#response').fadeOut(3000);

                        }else {

                            $('#response').html('<div  class="alert alert-danger"> <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>Something went wrong,please try agian later! </div>');
                        }
                    },

                });


            }, true],
            ['<button>NOn</button>', function (instance, toast) {

                instance.hide(toast, { transitionOut: 'fadeOut' }, 'button');

            }]
        ],
    });

});

$(document).on("click", ".soldStatusUpdate", function(){
    var id  = this.id;
    iziToast.show({
        color: 'light',
        icon: 'iziToast-icon ico-question revealIn',
        overlay: true,
        close: false,
        closeOnEscape: true,
        title: 'Hey',
        message: 'Voulez-vous confirmer cette action?',
        position: 'center',
        backgroundColor: 'rgba(255,249,178,0.9)',
        progressBarColor: 'rgba(255,249,178,0.9)',
        buttons: [
            ['<button><b>Oui</b></button>', function (instance, toast) {
                instance.hide(toast, { transitionOut: 'fadeOut' }, 'button');
                var url = site_url + 'index.php/listings/sold_listing_status/';
                $.ajax({
                    type: "POST",
                    cache: false,
                    url: url,
                    data: {id:id},
                    dataType:'html',
                    success: function (result) {
                        if(result == 1) {
                          console.log('called');
                            $("#booking_row_"+id).hide();
                            $('#response')
                                .show()
                                .html('<div  class="alert alert-success"> <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>Your listing has been mark as sold </div>');
                            $('#response').fadeOut(1000);
                           setTimeout(function(){
                                window.location.reload(1);
                            }, 3000);


                        }else {

                            $('#response').html('<div  class="alert alert-danger"> <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>Something went wrong,please try agian later! </div>');
                        }
                    },

                });


            }, true],
            ['<button>NOn</button>', function (instance, toast) {

                instance.hide(toast, { transitionOut: 'fadeOut' }, 'button');

            }]
        ],
    });

});

function appStatusCancel(id,ualid,usid) {
    iziToast.show({
        color: 'light',
        icon: 'iziToast-icon ico-question revealIn',
        overlay: true,
        close: false,
        closeOnEscape: true,
        title: 'Hey',
        message: 'Voulez-vous confirmer cette action?',
        position: 'center',
        backgroundColor: 'rgba(255,249,178,0.9)',
        progressBarColor: 'rgba(255,249,178,0.9)',
        buttons: [
            ['<button><b>Oui</b></button>', function (instance, toast) {
                instance.hide(toast, {transitionOut: 'fadeOut'}, 'button');
                var url = site_url + 'index.php/appointments/app_status_cancel/';
                $.ajax({
                    type: "POST",
                    cache: false,
                    url: url,
                    data: {id: id, ualid: ualid , usid: usid},
                    dataType: 'html',
                    success: function (result) {
                        if (result == 1) {
                            console.log('called');
                            // $("#booking_row_"+id).hide();
                            $('#response')
                                .show()
                                .html('<div  class="alert alert-success"> <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>Your Appointment has been mark as cancel</div>');
                            $('#response').fadeOut(1000);
                            setTimeout(function(){
                                window.location.reload(1);
                            }, 3000);
                        } else {

                            $('#response').html('<div  class="alert alert-danger"> <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>Something went wrong,please try agian later! </div>');
                        }
                    },

                });
            }, true],
            ['<button>NOn</button>', function (instance, toast) {

                instance.hide(toast, {transitionOut: 'fadeOut'}, 'button');

            }]
        ],
    });

}

function userStatusCancel(id,listing_id) {
    iziToast.show({
        color: 'light',
        icon: 'iziToast-icon ico-question revealIn',
        overlay: true,
        close: false,
        closeOnEscape: true,
        title: 'Hey',
        message: 'Voulez-vous confirmer cette action?',
        position: 'center',
        backgroundColor: 'rgba(255,249,178,0.9)',
        progressBarColor: 'rgba(255,249,178,0.9)',
        buttons: [
            ['<button><b>Oui</b></button>', function (instance, toast) {
                instance.hide(toast, {transitionOut: 'fadeOut'}, 'button');
                var url = site_url + 'index.php/appointments/app_userstatus_cancel/';
                $.ajax({
                    type: "POST",
                    cache: false,
                    url: url,
                    data: {id: id, listing_id: listing_id},
                    dataType: 'html',
                    success: function (result) {
                        if (result == 1) {
                            console.log('called');
                            // $("#booking_row_"+id).hide();
                            $('#response')
                                .show()
                                .html('<div  class="alert alert-success"> <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>Your Appointment has been mark as cancel</div>');
                            $('#response').fadeOut(1000);
                            setTimeout(function(){
                                window.location.reload(1);
                            }, 3000);


                        } else {

                            $('#response').html('<div  class="alert alert-danger"> <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>Something went wrong,please try agian later! </div>');
                        }
                    },

                });
            }, true],
            ['<button>NOn</button>', function (instance, toast) {

                instance.hide(toast, {transitionOut: 'fadeOut'}, 'button');

            }]
        ],
    });

}


function appStatusConfirm(id,ualid,usid,appointment_time) {
    iziToast.show({
        color: 'light',
        icon: 'iziToast-icon ico-question revealIn',
        overlay: true,
        close: false,
        closeOnEscape: true,
        title: 'Hey',
        message: 'Voulez-vous confirmer cette action?',
        position: 'center',
        backgroundColor: 'rgba(255,249,178,0.9)',
        progressBarColor: 'rgba(255,249,178,0.9)',
        buttons: [
            ['<button><b>Oui</b></button>', function (instance, toast) {
                instance.hide(toast, {transitionOut: 'fadeOut'}, 'button');
                var url = site_url + 'index.php/appointments/app_status_confirm/';
                $.ajax({
                    type: "POST",
                    cache: false,
                    url: url,
                    data: {id: id, ualid: ualid , usid: usid, appointment_time: appointment_time},
                    dataType: 'html',
                    success: function (result) {
                        if (result == 1) {
                            console.log('called');
                            // $("#booking_row_"+id).hide();
                            $('#response')
                                .show()
                                .html('<div  class="alert alert-success"> <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>Your Appointment has been mark as confirm</div>');
                            $('#response').fadeOut(1000);
                            setTimeout(function(){
                            window.location.reload(1);
                             }, 3000);


                        } else {

                            $('#response').html('<div  class="alert alert-danger"> <button type="button" class="close" data-dismiss="alert" aria-hidden="true"></button>Something went wrong,please try agian later! </div>');
                        }
                    },

                });
            }, true],
            ['<button>NOn</button>', function (instance, toast) {

                instance.hide(toast, {transitionOut: 'fadeOut'}, 'button');

            }]
        ],
    });

}

function existing_member() {
    $("#agent_exist").toggle();
    $("#agent_registration").hide();

}
function new_member() {
    $("#agent_registration").toggle();
    $("#agent_exist").hide();

}


/************************
 Pickers
 *************************/
$('#calendarModal').on('show.bs.modal', function() {

    $("#startDate").datepicker({dateFormat: "yy-mm-dd", minDate: new Date()});
    $("#endDate").datepicker({dateFormat: "yy-mm-dd", minDate: new Date()});

    $("#colorp").spectrum({
        preferredFormat: "hex",
        showPaletteOnly: true,
        togglePaletteOnly: true,
        togglePaletteMoreText: 'more',
        togglePaletteLessText: 'less',
        color: '#587ca3',
        palette: [
            ["#000","#444","#666","#999","#ccc","#eee","#f3f3f3","#fff"],
            ["#f00","#f90","#ff0","#0f0","#0ff","#00f","#90f","#f0f"],
            ["#f4cccc","#fce5cd","#fff2cc","#d9ead3","#d0e0e3","#cfe2f3","#d9d2e9","#ead1dc"],
            ["#ea9999","#f9cb9c","#ffe599","#b6d7a8","#a2c4c9","#9fc5e8","#b4a7d6","#d5a6bd"],
            ["#e06666","#f6b26b","#ffd966","#93c47d","#76a5af","#6fa8dc","#8e7cc3","#c27ba0"],
            ["#c00","#e69138","#f1c232","#6aa84f","#45818e","#3d85c6","#674ea7","#a64d79"],
            ["#900","#b45f06","#bf9000","#38761d","#134f5c","#0b5394","#351c75","#741b47"],
            ["#600","#783f04","#7f6000","#274e13","#0c343d","#073763","#20124d","#4c1130"]
        ]
    });

    $('#startTime, #endTime').timepicker();

});


function initMap() {
    var myLatLng = {
        lat: -25.363,
        lng: 131.044
    };
    var map = new google.maps.Map(document.getElementById('map'), {
        zoom: 4,
        center: myLatLng
    });
    var marker = new google.maps.Marker({
        position: myLatLng,
        map: map,
        title: 'Hello World!'
    });
}




function applyHovers(){


    $('#agent_properties .item-wrap').hover(


        // mouse in
        function () {

            var listid = $(this).attr("data_id");
        //    console.log(listid);

            $(this).css({background: ""});
            var listid = $(this).attr("data_id");


            // var div = overlayMarkers[listid].div;
            // div.style.background = '#ff6e00';
            // div.style.width = '51px';
            // div.style.height = '24px';
            // div.style.border='2px solid #fff';
            // div.style.fontSize='14px';
        },
        // mouse out
        function () {

            var listid = $(this).attr("data_id");
           // console.log(listid);

            //  console.log('out');
            // first we need to know which <div class="marker"></div> we hovered
            /* $(this).css({background: ""});
             var listid = $(this).attr("data_id");
             var div=overlayMarkers[listid].div;
             //   console.log(div);
             div.style.background = '';
             div.style.width = '';
             div.style.height = '';
             div.style.border='';
             div.style.fontSize='';*/
        }


    );


    //console.log(overlayMarkers);
}


// Add a Home control that returns the user to London
function HomeControl(controlDiv, map) {
    controlDiv.style.padding = '5px';
    var controlUI = document.createElement('div');
    controlUI.className = "toggle_mapsearch";
    controlDiv.appendChild(controlUI);
    // var controlLabel = document.createElement('label');
    // controlLabel.innerHTML = 'Search as I move the Map here';
    // var input = document.createElement("input");
    //input.type = "checkbox";
    //input.className = "mapsearch_checkbox";
    //input.id = "search_with_map"; // set the CSS class
    //  controlLabel.appendChild(input); // put it into the DOM
    // controlUI.appendChild(controlLabel);
}


var overlayMarkers = [];
var markersArray = [];
var map;
var listing_map;
var load_map=0;




function clearOverlays() {
    for (var i = 0; i < markersArray.length; i++ ) {
        markersArray[i].setMap(null);
    }
    markersArray.length = 0;
}

function loadSearchMap() {

    console.log('loadSearchMap');
    map = new google.maps.Map(document.getElementById('search_map'), {
        //zoom: 4,
        scrollwheel: false,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
        draggable: false
    });
    var homeControlDiv = document.createElement('div');
    map.controls[google.maps.ControlPosition.TOP_RIGHT].push(homeControlDiv);
    setMarkers(map, locations);
    var infowindow = null;
    google.maps.event.addListener(infowindow, 'domready', function() {
        $('.gm-style-iw').hide();
    });


    //mapMoveSearch();
}

function loadSaleMap() {

    //alert('called');
    map = new google.maps.Map(document.getElementById('sale_map'), {
        zoom: 16,
        scrollwheel: false,
        // center: new google.maps.LatLng(-39.92, 151.25),
        // disableDefaultUI: true,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    });


    // Create a DIV to hold the control and call HomeControl()
    var homeControlDiv = document.createElement('div');
    var homeControl = new HomeControl(homeControlDiv, map);
    //  homeControlDiv.index = 1;
    map.controls[google.maps.ControlPosition.TOP_RIGHT].push(homeControlDiv);
    setMarkers(map, sales);
    applyHovers();
    //  $("#search_map").sticky({ topSpacing:20, bottomSpacing:400, center:true, className:"hey" });
    mapMoveSearch();
}

function loadRentMap() {


    //alert('called');
    map = new google.maps.Map(document.getElementById('rent_map'), {
        zoom: 16,
        scrollwheel: false,
        // center: new google.maps.LatLng(-39.92, 151.25),
        // disableDefaultUI: true,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    });


    // Create a DIV to hold the control and call HomeControl()
    var homeControlDiv = document.createElement('div');
    // var homeControl = new HomeControl(homeControlDiv, map);
    //  homeControlDiv.index = 1;
    map.controls[google.maps.ControlPosition.TOP_RIGHT].push(homeControlDiv);
    setMarkers(map, rent);
    //  $("#search_map").sticky({ topSpacing:20, bottomSpacing:400, center:true, className:"hey" });
    mapMoveSearch();
}

function loadSoldMap() {

    //alert('called');
    map = new google.maps.Map(document.getElementById('sold_map'), {
        zoom: 7,
        scrollwheel: false,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    });
    var homeControlDiv = document.createElement('div');
    var homeControl = new HomeControl(homeControlDiv, map);
    //  homeControlDiv.index = 1;
    map.controls[google.maps.ControlPosition.TOP_RIGHT].push(homeControlDiv);
    setMarkers(map, sold);
    //  $("#search_map").sticky({ topSpacing:20, bottomSpacing:400, center:true, className:"hey" });
    $('#sold_map').parent().parent().parent().siblings().addClass("class_name");

    mapMoveSearch();
}



function loadListingMap() {


    console.log('loadlistingmap');
   // alert('dd');
    var bounds= new google.maps.LatLngBounds();

    map = new google.maps.Map(document.getElementById('search_listing_map'), {
        zoom: 12,
        scrollwheel: false,
        // draggable: false,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
    });
    var infoWindow = new google.maps.InfoWindow(), marker, i;

    for( i = 0; i < locations.length; i++ ) {

        var arr = explode(",", locations[i]);
        var position = new google.maps.LatLng(arr[1], arr[2]);
        if(arr[4] == 'rent'){

            var list_icon = new google.maps.MarkerImage(site_url +"/assets/img/marker_rent.png");
        }
        else {

            var list_icon = new google.maps.MarkerImage(site_url+ "/assets/img/marker_sale.png");
        }
        //map.setCenter(position);
        bounds.extend(position);
        marker = new google.maps.Marker({
            position: position,
           // label: ''+i,
            icon: list_icon,
           // title:'asim',
            map: map
        });
        markersArray.push(marker);

        // Add info window to marker
        var content = arr_info[arr[0]];

        google.maps.event.addListener(marker,'mouseover', (function(marker,content,infoWindow){
            return function() {
                infoWindow.setContent(content);
                infoWindow.open(map,marker);
            };
        })(marker,content,infoWindow));



        map.fitBounds(bounds);
    }
    var boundsListener = google.maps.event.addListener((map), 'bounds_changed', function(event) {
        this.setZoom(12);
        google.maps.event.removeListener(boundsListener);
    });

    // applyHovers();

    google.maps.event.addListenerOnce(map, 'dragend', function() {
        mapMoveSearch();

    });

}

function loadListingMapNoBounds(bounds) {



    map = new google.maps.Map(document.getElementById('search_listing_map'), {
        zoom: 12,
        scrollwheel: false,
        // draggable: false,
        mapTypeId: google.maps.MapTypeId.ROADMAP,
    });
    var infoWindow = new google.maps.InfoWindow(), marker, i;

    for( i = 0; i < locations.length; i++ ) {

        var arr = explode(",", locations[i]);
        var position = new google.maps.LatLng(arr[1], arr[2]);
        if(arr[4] == 'rent'){ var list_icon = new google.maps.MarkerImage(site_url +"/assets/img/marker_rent.png");}
        else{ var list_icon = new google.maps.MarkerImage(site_url+ "/assets/img/marker_sale.png");}
        //map.setCenter(position);
        bounds.extend(position);
        marker = new google.maps.Marker({
            position: position,
            icon: list_icon,
            map: map,
        });
        markersArray.push(marker);
        var content = arr_info[arr[0]];
        google.maps.event.addListener(marker,'mouseover', (function(marker,content,infoWindow){
            return function() {
                infoWindow.setContent(content);
                infoWindow.open(map,marker);
            };
        })(marker,content,infoWindow));



        map.fitBounds(bounds);
    }
    var boundsListener = google.maps.event.addListener((map), 'bounds_changed', function(event) {
        this.setZoom(12);
        google.maps.event.removeListener(boundsListener);
    });


    google.maps.event.addListener(map, 'dragend', function() {
        mapMoveSearch();

    });
}




function mapMoveSearch() {

    var bounds =  map.getBounds();
    var sw = bounds.getSouthWest();
    var ne = bounds.getNorthEast();

    $("#sw_lat").val(sw.lat());
    $("#sw_lng").val(sw.lng());
    $("#ne_lat").val(ne.lat());
    $("#ne_lng").val(ne.lng());
    $("#search_by_map").val("true");


    $.ajax({
        url: site_url + "search/results",
        type: "GET",
        data: $(".search_form").serialize() + "&ajax=1",
        dataType: "html",
        beforeSend: function() {
            $('#search_loader').show();
        },

        success: function(data) {
            $('#filtered_search_results').html(data);
            $('#search_loader').hide();
            loadListingMapNoBounds(bounds);
            //applyHovers();

        }, done: function(data){

            $("#sw_lat").val("");
            $("#sw_lng").val("");
            $("#ne_lat").val("");
            $("#ne_lng").val("");
            $("#search_by_map").val("");
            $('#search_loader').hide();
        }



    });

}



function setMarkers(map, locations) {
   // alert('set listing markers');
    var marker, i
    var infowindow = null;
    var bounds = new google.maps.LatLngBounds();
    var infoWindows = [];
    var NewarkHighlight;
    var mNewarkCoords = new Array;
    var triangleCoords = [
        new google.maps.LatLng(48.85332310, 2.28137680),
        new google.maps.LatLng(48.81364040, 2.27231030),
        new google.maps.LatLng(48.85668390, 2.23062600),
        new google.maps.LatLng(48.85333400, 2.36951110),
        new google.maps.LatLng(48.90587850, 2.26839970),
        new google.maps.LatLng(48.85775900, 2.38005360),
        new google.maps.LatLng(48.87413090, 2.26762860),
    ];



    for (i = 0; i < locations.length; i++) {

        var arr = explode(",", locations[i]);
        var myLatlng = new google.maps.LatLng(arr[1], arr[2]);
        //  mNewarkCoords[i] = new google.maps.LatLng(arr[1], arr[2]);

        var content = arr_info[arr[0]];

        overlay = new CustomMarker(
            myLatlng,
            map, {
                marker_id: arr[0],
                price: arr[3],
                type:arr[4],
                status:arr[5]
            }

        );
        map.setCenter(overlay.getPosition());
        bounds.extend(overlay.getPosition());
        google.maps.event.addListener(overlay, "click", (function(overlay, content, infowindow) {
            return function() {

                if (infowindow) {
                    infowindow.close();
                }
                if (infoWindows) {
                    for (var i = 0; i < infoWindows.length; i++) {
                        infoWindows[i].close();
                    }
                }
                infowindow = new google.maps.InfoWindow({
                    content: content,
                    pixelOffset: new google.maps.Size(0, 5)
                });
                infoWindows.push(infowindow);
                google.maps.event.addListener(infowindow, 'domready', function() {
                    var iwOuter = $('.gm-style-iw');
                    var iwBackground = iwOuter.prev();
                    iwBackground.children(':nth-child(2)').css({'display' : 'none'});
                    iwBackground.children(':nth-child(4)').css({'display' : 'none'});
                    iwOuter.parent().parent().css({left: '30px', top:'10px'});
                    iwBackground.children(':nth-child(1)').hide();
                    iwBackground.children(':nth-child(3)').hide();
                    iwBackground.children(':nth-child(3)').find('div').children().css({'box-shadow': 'rgba(72, 181, 233, 0.6) 0px 1px 6px', 'z-index' : '1'});
                    var iwCloseBtn = iwOuter.next();
                    iwCloseBtn.css({opacity: '1', right: '52px', top: '0px'});
                    if($('.iw-content').height() < 140){
                        $('.iw-bottom-gradient').css({display: 'none'});
                    }
                    iwCloseBtn.mouseout(function(){
                        $(this).css({opacity: '1'});
                    });
                });

                infowindow.open(map, overlay);
            };
        })(overlay, content, infowindow));
        overlayMarkers[arr[0]]=overlay;
    }


    /*  bermudaTriangle = new google.maps.Polygon({
          paths: mNewarkCoords,
          strokeColor: '#FF0000',
          strokeOpacity: 0.8,
          strokeWeight: 2,
          fillColor: '#FF0000',
          fillOpacity: 0.35
      });

      bermudaTriangle.setMap(map);*/


    /*
        var fenway = new google.maps.LatLng(48.8491237,2.3435389);
        var myCity = new google.maps.Circle({
            center: fenway,
            // radius: Math.sqrt(fenway) * 10,
            radius: 1500,
            strokeColor: "#00aeef",
            strokeOpacity: 0.9,
            strokeWeight: 2,
            fillColor: "#00aeef",
            fillOpacity: 0.2
        });
        myCity.setMap(map);*/


    map.fitBounds(bounds);
    var listener = google.maps.event.addListener(map, "idle", function () {
        map.setZoom(10);
        google.maps.event.removeListener(listener);
    });

}







function loadAgentMap() {
    var map;
    var lat_longs_map = new Array();
    var markers_map = new Array();
    var placesService;
    var placesAutocomplete;
    var iw_map = new google.maps.InfoWindow();
    var myLatlng = new google.maps.LatLng(37.4419, -122.1419);
    var myOptions = {
        zoom: 13,
        scrollwheel: false,
        center: myLatlng,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    }
    map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
    var autocompleteOptions = {}
    var autocompleteInput = document.getElementById('agent_location');
    autocomplete = new google.maps.places.Autocomplete(autocompleteInput, autocompleteOptions);
    autocomplete.bindTo('bounds', map);
    autocomplete.addListener('place_changed', fillInAgentAddress);
}



function fillInAgentAddress() {

    var place = autocomplete.getPlace();
    for (var i = 0; i < place.address_components.length; i++) {
        var addressType = place.address_components[i].types[0];
        //  console.log(addressType);
        if (addressType == "street_number") {
            var val = place.address_components[i]['short_name'];
            console.log(val);
            document.getElementById('agent_street').value = val;
        }
        if (addressType == "locality") {
            var val = place.address_components[i]['long_name'];
            console.log(val);
            document.getElementById('agent_city').value = val;
        }
        if (addressType == "administrative_area_level_1") {
            var val = place.address_components[i]['long_name'];
            console.log(val);
            document.getElementById('agent_state').value = val;
        }
        if (addressType == "administrative_area_level_1") {
            var val = place.address_components[i]['short_name'];
            console.log(val);
            document.getElementById('agent_state_code').value = val;
        }
        if (addressType == "country") {
            var val = place.address_components[i]['long_name'];
            console.log(val);
            document.getElementById('agent_country').value = val;
        }
        if (addressType == "postal_code") {
            var val = place.address_components[i]['short_name'];
            console.log(val);
            document.getElementById('agent_zipcode').value = val;
        }

    }
}
function loadPlacesMap() {

    var map; // Global declaration of the map
    var lat_longs_map = new Array();
    var markers_map = new Array();
    var placesService;
    var placesAutocomplete;
    var iw_map = new google.maps.InfoWindow();
    var myLatlng = new google.maps.LatLng(37.4419, -122.1419);
    var myOptions = {
        zoom: 13,
        scrollwheel: false,
        center: myLatlng,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    }
    map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
    var autocompleteOptions = {}
    var autocompleteInput = document.getElementById('location');
    var agent_input = document.getElementById('agent_location');
    autocomplete = new google.maps.places.Autocomplete(autocompleteInput, autocompleteOptions);
    autocomplete_agent = new google.maps.places.Autocomplete(agent_input, autocompleteOptions);
    autocomplete.bindTo('bounds', map);
    autocomplete_agent.bindTo('bounds', map);
    autocomplete.addListener('place_changed', fillInAddress);
}
function fillInAddress() {

    $('.search_submit').prop('disabled', false);
    var place = autocomplete.getPlace();
    $("#sw_lat").val("");
    $("#sw_lng").val("");
    $("#ne_lat").val("");
    $("#ne_lng").val("");
    $("#search_by_map").val("");
    for (var i = 0; i < place.address_components.length; i++) {
        var addressType = place.address_components[i].types[0];
        console.log(addressType);
        if (addressType == "street_number") {
            var val = place.address_components[i]['short_name'];
            document.getElementById('street').value = val;
        }
        if (addressType == "locality") {
            var val = place.address_components[i]['long_name'];
            document.getElementById('city').value = val;
        }
        if (addressType == "administrative_area_level_1") {
            var val = place.address_components[i]['long_name'];
            document.getElementById('state').value = val;
        }
        if (addressType == "country") {
            var val = place.address_components[i]['long_name'];
            document.getElementById('country').value = val;
        }
        if (addressType == "postal_code") {
            var val = place.address_components[i]['short_name'];
            document.getElementById('zipcode').value = val;
        }

    }
}

function loadAgentMap() {
    var map;
    var lat_longs_map = new Array();
    var markers_map = new Array();
    var placesService;
    var placesAutocomplete;
    var iw_map = new google.maps.InfoWindow();
    var myLatlng = new google.maps.LatLng(37.4419, -122.1419);
    var myOptions = {
        zoom: 13,
        scrollwheel: false,
        center: myLatlng,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    }
    map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);
    var autocompleteOptions = {}
    var autocompleteInput = document.getElementById('agent_location');
    autocomplete = new google.maps.places.Autocomplete(autocompleteInput, autocompleteOptions);
    autocomplete.bindTo('bounds', map);
    autocomplete.addListener('place_changed', fillInAgentAddress);
}


function fillInAgentAddress() {

    var place = autocomplete.getPlace();
    for (var i = 0; i < place.address_components.length; i++) {
        var addressType = place.address_components[i].types[0];
        console.log(addressType);
        if (addressType == "street_number") {
            var val = place.address_components[i]['short_name'];
            console.log(val);
            document.getElementById('agent_street').value = val;
        }
        if (addressType == "locality") {
            var val = place.address_components[i]['long_name'];
            console.log(val);
            document.getElementById('agent_city').value = val;
        }
        if (addressType == "administrative_area_level_1") {
            var val = place.address_components[i]['long_name'];
            console.log(val);
            document.getElementById('agent_state').value = val;
        }
        if (addressType == "administrative_area_level_1") {
            var val = place.address_components[i]['short_name'];
            console.log(val);
            document.getElementById('agent_state_code').value = val;
        }
        if (addressType == "country") {
            var val = place.address_components[i]['long_name'];
            console.log(val);
            document.getElementById('agent_country').value = val;
        }
        if (addressType == "postal_code") {
            var val = place.address_components[i]['short_name'];
            console.log(val);
            document.getElementById('agent_zipcode').value = val;
        }

    }
}


function LoadUserLocationMap() {
    var map; // Global declaration of the map
    var lat_longs_map = new Array();
    var markers_map = new Array();
    var placesService;
    var placesAutocomplete;
    var iw_map = new google.maps.InfoWindow();
    var myLatlng = new google.maps.LatLng(37.4419, -122.1419);
    var myOptions = {
        zoom: 13,
        scrollwheel: false,
        center: myLatlng,
        mapTypeId: google.maps.MapTypeId.ROADMAP
    }
    map = new google.maps.Map(document.getElementById("map_canvas"), myOptions);

    var autocompleteOptions = {}
    var autocompleteInput = document.getElementById('user_location');


    autocomplete = new google.maps.places.Autocomplete(autocompleteInput, autocompleteOptions);

    autocomplete.bindTo('bounds', map);
    autocomplete.addListener('place_changed', fillInUserAddress);
}

// [START region_fillform]
function fillInUserAddress() {

    // Get the place details from the autocomplete object.
    var place = autocomplete.getPlace();
    //console.log(place.address_components);
    $("#sw_lat").val("");
    $("#sw_lng").val("");
    $("#ne_lat").val("");
    $("#ne_lng").val("");
    $("#search_by_map").val("");
    // Get each component of the address from the place details
    // and fill the corresponding field on the form.
    for (var i = 0; i < place.address_components.length; i++) {
        var addressType = place.address_components[i].types[0];
        console.log(addressType);
        if (addressType == "street_number") {
            var val = place.address_components[i]['short_name'];
            console.log(val);
            document.getElementById('user_street').value = val;
        }
        if (addressType == "locality") {
            var val = place.address_components[i]['long_name'];
            console.log(val);
            document.getElementById('user_city').value = val;
        }
        if (addressType == "administrative_area_level_1") {
            var val = place.address_components[i]['long_name'];
            console.log(val);
            document.getElementById('user_state').value = val;
        }
        if (addressType == "administrative_area_level_1") {
            var val = place.address_components[i]['short_name'];
            console.log(val);
            document.getElementById('user_state_code').value = val;
        }
        if (addressType == "country") {
            var val = place.address_components[i]['long_name'];
            console.log(val);
            document.getElementById('user_country').value = val;
        }
        if (addressType == "postal_code") {
            var val = place.address_components[i]['short_name'];
            console.log(val);
            document.getElementById('user_zipcode').value = val;
        }

    }
}


