/**
 *
 * jQuery plugin to impliment local storage with optional AES
 * encryption support via the Gibberish-AES libraries
 *
 * Fork me @ https://www.github.com/jas-/jQuery.handleStorage
 *
 * FEATURES:
 * - HTML5 localStorage support
 * - HTML5 sessionStorage support
 * - Cookie support
 * - AES encryption support
 *
 * REQUIREMENTS:
 * - jQuery libraries (required - http://www.jquery.com)
 * - jQuery cookie plugin (optional - http://plugins.jquery.com/files/jquery.cookie.js.txt)
 * - Gibberish-AES libraries (optional - https://github.com/mdp/gibberish-aes)
 *
 * OPTIONS:
 * - appID:    Unique identifier used as storage object key
 * - interval: Amount of time betwen auto-saves (default 5sec)
 * - storage:  HTML5 localStorage, sessionStorage and cookies supported
 * - aes:      Use AES encryption for local storage
 * - uuid:     Random RFC-4122 string used as AES password
 *
 * Author: Jason Gerfen
 * Email: jason.gerfen@gmail.com
 * Copyright: Jason Gerfen
 *
 * License: GPL
 *
 */

(function($){

 /**
  * @function jQuery.handleStorage
  * @abstract Plug-in used to assist in client storage items
  * @param method string Method to employ for form ID DOM object
  *                      init (transparent getting and setting of
  *                      form elements)
  * @param options object options object for specific operations
  *                       appID, storage, aes
  */

 $.fn.handleStorage = function(method){

  /**
   * @object defaults
   * @abstract Default set of options for plug-in
   */
  var defaults = {
   appID:       'jQuery.handleStorage',  // Application ID, used as index
   storage:     'localStorage',          // Storage type localStorage || sessionStorage || cookie (cookie storage requires jQuery cookie plugin)
   interval:    5000,                    // Amount of time between auto-saves (default is 5sec)
   aes:         false,                   // Use AES encryption? (true or false)
   uuid:        '',                      // Random RFC-4122 string
   form:        '',                      // Place holder for form ID
   data:        {},                      // Place holder for storage objects
   callback:    function(){},            // An on save callback
   preCallback: function(){},            // Process callback prior to save
   errCallback: function(){}             // Callback to execute on error
  };

  /**
   * @object methods
   * @abstract Plug-in methods
   */
  var methods = {

   /**
    * @method init
    * @abstract Default plug-in method. Provides transparent client storage
    *           of form data using HTML5 client storage or cookies with
    *           optional AES encryption support
    */
   init: function(o){
    var opts = $.extend({}, defaults, o);
    opts.form = $(this).attr('id');
    if (vO(opts)){
     opts.data[opts.appID] = (_e(opts)) ? _e(opts) : {};
     var orig = gStore(opts);
     if ((typeof orig==='object')&&(sChk(orig)>0)){
      sF(opts, orig);
     }
     ((opts.preCallback)&&($.isFunction(opts.preCallback))) ? opts.preCallback($(this)) : false;
     $('#'+opts.form).delegate('input, input:radio:selected, input:checkbox:checked, select, textarea', 'change keyup blur submit', function(){
      svF(opts);
     });
     setInterval(function(){svF(opts);}, opts.interval);
     return true;
    } else {
     return false;
    }
   }

  };

  /**
   * @function sChk
   * @abstract Performs a check on object sizes
   */
  var sChk = function(obj) {
   var n = 0;
   $.each(obj, function(k, v){
    if (obj.hasOwnProperty(k)) n++;
   });
   return n;
  }

  /**
   * @function _l
   * @abstract Performs check on current value of local storage objects
   *           Uses 5mb for HTML5 local/session storage & 4k for cookies
   */
  var _l = function(type) {
   var lim = /local|session/.test(type) ? 1024 * 1025 * 5 : 1024 * 4;
   if (lim - unescape(encodeURIComponent(JSON.stringify(type))).length <= 0) {
    console.log('Maximum quota has been met using '+type);
    return false;
   }
   return true;
  }

  /**
   * @function sI
   * @abstract Proxy function for setting data with specified client storage
   *           option
   */
  var sI = function(type, k, v) {
   var x = false;
   type = (vStore(type)) ? type : 'cookie';
   if (_l(type)) {
    switch(type) {
     case 'localStorage':
      x = sL(k, v);
      break;
     case 'sessionStorage':
      x = sS(k, v);
      break;
     case 'cookie':
      x = sC(k, v);
      break;
     default:
      x = sL(k, v);
      break;
    }
   }
   return x;
  }

  /**
   * @function gI
   * @abstract Proxy function for getting data with specified client storage
   *           option
   */
  var gI = function(type, k) {
   var x = false;
   type = (vStore(type)) ? type : 'cookie';
   switch(type) {
    case 'localStorage':
     x = gL(k);
     break;
    case 'sessionStorage':
     x = gS(k);
     break;
    case 'cookie':
     x = gC(k);
     break;
    default:
     x = gL(k);
     break;
   }
   return x;
  }

  /**
   * @function sL
   * @abstract Function used to set localStorage items
   */
  var sL = function(k, v) {
   return (localStorage.setItem(k, v)) ? false : true;
  }

  /**
   * @function sS
   * @abstract Function used to set sessionStorage items
   */
  var sS = function(k, v) {
   return (sessionStorage.setItem(k, v)) ? false : true;
  }

  /**
   * @function sC
   * @abstract Function used to set cookie items
   */
  var sC = function(k, v) {
   if (typeof $.cookie === 'function') {
    return ($.cookie(k, v, {expires: 7})) ? true : false;
   } else {
    return false;
   }
  }

  /**
   * @function gL
   * @abstract Function used to get localStorage items
   */
  var gL = function(k) {
   return (localStorage.getItem(k)) ? localStorage.getItem(k) : false;
  }

  /**
   * @function gS
   * @abstract Function used to get sessionStorage items
   */
  var gS = function(k) {
   return (sessionStorage.getItem(k)) ? sessionStorage.getItem(k) : false;
  }

  /**
   * @function sC
   * @abstract Function used to get cookie items
   */
  var gC = function(name) {
   if (typeof $.cookie === 'function') {
    return ($.cookie(name)) ? $.cookie(name) : false;
   } else {
    return false;
   }
  }

  /**
   * @function _e
   * @abstract Function used to return configured storage items
   *           as JSON object
   */
  var _e = function(o) {
   return (gI(o.storage, o.appID)) ? JSON.parse(gI(o.storage, o.appID)) : false;
  }

  /**
   * @function gStore
   * @abstract Function to compare and decrypt if necessary, existing
   *           storage items to configured form input elements
   */
  var gStore = function(o) {
   var ret={}, x;
   if (typeof o.data[o.appID][o.form]==='object'){
    $.each($('#'+o.form+' > :input'), function(k, v){
     if ((vStr(v.name)!==false)&&(vStr(o.data[o.appID][o.form][v.name])!==false)){
      if (typeof(o.data[o.appID][o.form][v.name])=='object') {
       var _x = []; var _i = 0;
       $.each(o.data[o.appID][o.form][v.name], function(a, b){
        _x[_i] = ((o.aes)&&(o.data[o.appID][o.form]['uuid'])&&(x!==false)) ? GibberishAES.dec(b, _s(uid(), __strIV(o.data[o.appID][o.form]['uuid']))) : b;
       });
       ret[v.name] = _x;
       __r(ret[v.name]);
      } else {
       ret[v.name] = ((o.aes)&&(o.data[o.appID][o.form]['uuid'])&&(x!==false)) ? GibberishAES.dec(o.data[o.appID][o.form][v.name], _s(uid(), __strIV(o.data[o.appID][o.form]['uuid']))) : o.data[o.appID][o.form][v.name];
      }
     }
    });
   }
   return ret;
  }

  /**
   * @function sF
   * @abstract Sets input values within configured form
   */
  var sF = function(o, arg){
   if (sChk(arg)>0){
    $.each(arg, function(a, b){
     if (($('#'+o.form+' > input[name='+a+']').attr('name')===a)||($('#'+o.form+' > select[name='+a+']').attr('name')===a)||($('#'+o.form+' > textarea[name='+a+']').attr('name')===a)&&(vStr(b)!==false)){
      if ((/checkbox|radio/.test($('#'+o.form+' > input[name='+a+']').attr('type')))&&($('#'+o.form+' > input[name='+a+']').attr('value')==b)) {
       $('#'+o.form+' > input[name='+a+']').attr('checked', true);
      } else {
       $('#'+o.form+' > input[name='+a+'], #'+o.form+' > select[name='+a+'], #'+o.form+' > textarea[name='+a+']').val(b);
      }
     }
    });
   }
  }

  /**
   * @function svF
   * @abstract Saves non-null form elements to configured client storage
   *           mechanism, encrypting if configured as a nested JSON object
   */
  var svF = function(o){
   var x={}; x[o.form]={};
   x[o.form]['uuid'] = ((o.aes)&&(!o.uuid)) ? hK(o) : o.uuid;
   $.each($('#'+o.form+' > :input'), function(k, v){
    if ((vStr(v.value)!==false)&&(vStr(v.name)!==false)){
     if (/checkbox|radio/.test(v.type)){
      x[o.form][v.name]=gG(o,v,v.type,x[o.form]['uuid']);
     } else {
      x[o.form][v.name] = ((o.aes)&&(x[o.form]['uuid'])) ? GibberishAES.enc(v.value, _s(uid(), __strIV(x[o.form]['uuid']))) : v.value;
     }
    }
   });
   o.data[o.appID] = (sChk(o.data[o.appID])>0) ?
    $.extend({}, o.data[o.appID], x) : x;
   if (sI(o.storage, o.appID, JSON.stringify(o.data[o.appID]))){
    ((o.callback)&&($.isFunction(o.callback))) ? o.callback.call($(this)) : false;
   } else {
    ((o.errCallback)&&($.isFunction(o.errCallback))) ? o.errCallback.call($(this)) : false;
   }
  }

  /**
   * @function gG
   * @abstract Return array of checked checkboxes or selected radio elements
   */
  var gG = function(o, obj, t, key){
   return $('#'+o.form+' > input:'+t+':checked').map(function(){
    return ((o.aes)&&(key)) ? GibberishAES.enc(this.value, _s(uid(), __strIV(key))) : this.value;
   }).get();
  }
  
  /**
   * @function vStr
   * @abstract Verifies string integrity
   */
  var vStr = function(string){
   if (string){
    return ((string===false)||(string.length===0)||(!string)||(string===null)||(string==='')||(typeof string==='undefined')) ? false : true;
   } else {
    return false;
   }
  }

  /**
   * @function vStore
   * @abstract Ensures configured storage mechanism is available for the
   *           browser engine
   */
  var vStore = function(type){
   try {
    return ((type in window)&&(window[type])) ? true : false;
   } catch (e) {
    console.log('The '+type+' storage mechanism does not exist, please upgrade your browser');
    return false;
   }
  }

  /**
   * @function vO
   * @abstract Tests configured o vs. available functionality
   */
  var vO = function(opts){
   var ret = true;
   if (opts.aes){
    if (!$.isFunction(GibberishAES.enc)){
     console.log('AES use specified but required libraries not available. Please include the Gibberish-AES libs...');
     ret = false;
    }
   }
   if (opts.storage==='cookie'){
    if (!$.isFunction($.cookie)){
     console.log('Cookie use specified but required libraries not available. Please include the jQuery cookie plugin...');
     ret = false;
    }
   }
   return ret;
  }

  /**
   * @function gUUID
   * @abstract Generates a valid RFC-4122 UUID
   */
  var gUUID = function(len){
   var chars = '0123456789abcdef'.split('');
   var uuid = [], rnd = Math.random, r;
   uuid[8] = uuid[13] = uuid[18] = uuid[23] = '-';
   uuid[14] = '4';
   for (var i = 0; i < 36; i++){
    if (!uuid[i]){
     r = 0 | rnd()*16;
     uuid[i] = chars[(i == 19) ? (r & 0x3) | 0x8 : r & 0xf];
    }
   }
   return (len!==null) ?
    uuid.join('').replace(/-/g, '').split('',len).join('') : uuid.join('');
  }

  /**
   * @function uid
   * @abstract Generate uid
   */
   var uid = function(){
		return window.navigator.appName+
				window.navigator.appCodeName+
				window.navigator.product+
				window.navigator.productSub+
				window.navigator.appVersion+
				window.navigator.buildID+
				window.navigator.userAgent+
				window.navigator.language+
				window.navigator.platform+
				window.navigator.oscpu;
	}

  /**
   * @function _s
   * @abstract Strengthen key
   */
  var _s = function(str, slt){
    var _h = []; _h[0] = GibberishAES.Hash.MD5(str);
    var _r = []; _r = _h[0]; var _d;
    for (i = 1; i < 3; i++){
        _h[i] = GibberishAES.Hash.MD5(_h[i - 1].concat(slt));
        _d = _r.concat(_h[i]);
    }
    return JSON.stringify(_d);
  }
  
  /**
   * @function hK
   * @abstract Performs key generation or retrieval
   */
  var hK = function(o) {
   if (o.aes){
    var x = (_e(o)) ? _e(o) : {};
    x[o.form] = (x[o.form]) ? x[o.form] : {};
    var y = (vStr(x[o.form]['uuid'])) ?
     x[o.form]['uuid'] : gUUID(null);
    return y;
   }
   return false;
  }

  /**
   * @function strIV
   * @abstract Generate IV from string
   */
  var __strIV = function(s){
   return (s) ?
    encodeURI(s.replace(/-/gi, '').substring(16,Math.ceil(16*s.length)%s.length)) :
    false;
  }

  /**
   * @function __r
   * @abstract Function used help debug objects recursively
   */
  var __r = function(obj){
   $.each(obj, function(x,y){
    if (typeof y==='object'){
     __r(y);
    } else {
     console.log(x+' => '+y);
    }
   });
  }

  /* robot, do something */
  if (methods[method]){
   return methods[method].apply(this, Array.prototype.slice.call(arguments, 1));
  } else if ((typeof method==='object')||(!method)){
   return methods.init.apply(this, arguments);
  } else {
   $.error('Method '+method+' does not exist on '+opts.name);
  }
 };
})(jQuery);
