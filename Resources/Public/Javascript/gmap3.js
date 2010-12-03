/*
 *  GMAP3 Plugin for JQuery
 *  Version   : 1.0
 *  Date      : November 01, 2010
 *  Licence   : GPL v3 : http://www.gnu.org/licenses/gpl.html
 *  Author    : DEMONTE Jean-Baptiste
 *  Contact   : jbdemonte@gmail.com
 *  Web site  : http://night-coder.com
 *
 *  I'm waiting for your comments, appreciations, bug report ...
 *  Thanks to let me know if you use it :)
 */

$.gmap3 = {

    /***********/
   /* PRIVATE */
  /***********/
  _ids:{},

  _default:{
    init:{
      mapTypeId : google.maps.MapTypeId.ROADMAP,
      center:{
        lat: 46.593623,
        lng: 0.342922
      },
      zoom: 10
    }
  },

  _geocoder: null,

  _getGeocoder: function(){
    if (!this._geocoder) this._geocoder = new google.maps.Geocoder();
    return this._geocoder;
  },
  /**
   * @desc evaluate if the instance exist (if an id has been initialized)
   * @param id : string instance (dom id)
   * @return bool
   **/
  _exist: function(id){
    return this._ids[ id ] && this._ids[ id ].map ? true : false;
  },

  /**
   * @desc call functions associated
   * @param
   *  id      : string
   *  action  : string : function wanted
   *
   *  options : {}
   *
   *    O1    : {}
   *    O2    : {}
   *    ...
   *    On    : {}
   *      => On : option : {}
   *          action : string : function name
   *          ... (depending of functions called)
   *
   *  args    : [] : parameters for directs call to map
   *  target? : object : replace map to call function
   **/
  _proceed: function(id, params){
    var action = (params && params.action) || ':init';
    var fl = action.substr(0,1);
    if (fl == '_') return; // private function
    if ( (action != ':init') && (action != ':geoLatLng') && (action != ':destroy') && !this._exist(id) ){
      this.init(id, $.extend({}, this._default['init']));
    }
    if (fl == ':'){
      // framework functions
      action = action.substr(1);
      if (typeof(this[action]) == 'function'){
        params['out'] = this[action](id, $.extend({}, this._default[action], params['args'] && params['args'] ? params['args'] : [])); // call fnc and extends defaults params
      }
    } else {
      // target of a direct call
      if (params['target']){
        if (typeof(params['target'][action]) == 'function'){
          params['out'] = params['target'][action].apply(params['target'], params && params['args'] ? params['args'] : []);
        }
      // gm direct function :  no result so not rewrited, directly wrapped using array "args" as parameters (ie. enableScrollWheelZoom, addMapType, ...)
       } else if (typeof(this._ids[id].map[action]) == 'function'){
        params['out'] = this._ids[id].map[action].apply(this._ids[id].map, params && params['args'] ? params['args'] : [] );
      }
    }
  },

  /**
   * @desc call a function of framework or google map object of the instance
   * @param
   *  id    : string : instance
   *  name  : {} : function name
   *
   *  ... (depending of functions called)
   **/
  _call: function(/* id, fncName [, ...] */){
    if (arguments.length < 2) return;
    if (!this._exist(arguments[0])) return ;
    if (typeof(this._ids[ arguments[0] ].map[ arguments[1] ]) != 'function') return;
    var args = [];
    for(var i=2; i<arguments.length; i++){
      args.push(arguments[i]);
    }
    return this._ids[ arguments[0] ].map[ arguments[1] ].apply( this._ids[ arguments[0] ].map, args );
  },

    /**********/
   /* PUBLIC */
  /**********/

  /**
   * @desc Destroy an existing instance
   * @param
   *  (id)
   *  params : {}
   **/
  destroy: function(id, params){
    if ( (id == '') || (!this._exist(id)) ) return false;
    $('#'+id).html('');
    delete this._ids[ id ].map;
    delete this._ids[ id ];
  },

  /**
   * @desc Initialize google map object an attach it to the dom element (using id)
   * @param
   *  (id)
   *  params : {}
   **/
  init: function(id, params){
    if ( (id == '') || (this._exist(id)) ) return false;

    var opts = $.extend({}, this._default['init'], params);
    if (typeof(opts['center']['lat']) != 'function'){
      opts['center'] = new google.maps.LatLng(params["center"]["lat"], params["center"]["lng"]);
    }

    this._ids[ id ] = {
      map: new google.maps.Map(document.getElementById(id), opts),
      res: null
    };

    if (params['events']){
      this._attachEvents(id, this._ids[ id ].map, params['events']);
    }

    return true;
  },

  _subcall: function(id, params, latLng){
    if (params['map'] && params['map']['center'])
      this._call(id, "setCenter", latLng);
  },

  /**
   * @desc Returns the geographical coordinates from an address
   * @param
   *  (id)
   *  params : {}
   *    address?  : string  (opt1)
   *    lat?      : float   (opt2)
   *    lng?      : float   (opt2)
   *    latLng?   : LatLng  (opt3)
   *    callback  : function( GMarker : false )
   *   method : string
   **/
  _resolveLatLng: function(id, params, method){
    if (params['address']){
        var callback = function(results, status) {
           if (status == google.maps.GeocoderStatus.OK){
            $.gmap3[method](id, params, results[0].geometry.location);
           }
        };
        this._getGeocoder().geocode( { 'address': params['address'] }, callback );

    } else if (params['latLng']) {
      this[method](id, params, params['latLng']);
    } else if ( (typeof(params['lat']) != 'undefined') && (typeof(params['lng']) != 'undefined')){
      this[method](id, params, new google.maps.LatLng(params['lat'], params['lng']));
    } else {
      this[method](id, params, false);
    }
  },


  /**
   * @desc attach an event to a target
   **/
  _attachEvent: function(id, target, name, f){
    google.maps.event.addListener(target, name, function(event) {
      f(id, target, event);
    });
  },

  /**
   * @desc attach events to a target
   **/
  _attachEvents : function(id, target, evts){
      for(var name in evts){
        if (typeof(evts[name]) == 'function'){
          this._attachEvent(id, target, name, evts[name]);
        }
      }
  },

  /**
   * @desc Add a point to a map
   **/
  _addMarker: function(id, params, latLng ){
    var marker = false;

    if (!latLng) return;

    this._subcall(id, params, latLng);

    var opts = params['marker'] && params['marker']['options'] ? params['marker']['options'] : {};
    opts['position'] = latLng;
    opts['map'] = this._ids[ id ].map;

    var marker = new google.maps.Marker(opts);

    if ( params['marker'] ){
      if (params['marker']['events']){
        this._attachEvents(id, marker, params['marker']['events']);
      }
      if (params['marker']['methods']){
        for(var k in params['marker']['methods']){
          if (typeof(params['marker']['methods'][k]) == 'function'){
            params['marker']['methods'][k].apply(marker, params['marker']['methods'][k] ? params['marker']['methods'][k] : []);
          }
        }
      }
    }

    params['out'] = marker;
    if (typeof(params['callback']) == 'function') params['callback'](id, marker);
  },

  /**
   * @desc Add a marker
   **/
  addMarker: function(id, params){
    this._resolveLatLng(id, params, '_addMarker');
  },


  _addInfoWindow: function(id, params, latLng){
    this._subcall(id, params, latLng);
    var opts = params['infowindow'] && params['infowindow']['options'] ? params['infowindow']['options'] : {};
    if (latLng) opts['position'] = latLng;
    var infowindow = new google.maps.InfoWindow(opts);

    if ( params['infowindow'] && params['infowindow']['events'] ){
        this._attachEvents(id, infowindow, params['infowindow']['events']);
    }

    if (params['infowindow'] && params['infowindow']['apply']){
      for(var k in params['infowindow']['apply']){
        var c = params['infowindow']['apply'][k];
        if(!c['action']) continue;
        if (c['action'] == 'open'){
          var args = [this._ids[ id ].map];
          var i = 0;
          for(var k in c['args']) args[++i] = c['args'][k];
        } else {
          var args = c['args'];
        }
        infowindow[c['action']].apply(infowindow, args);
      }
    }
    params['out'] = infowindow;
    if (typeof(params['callback']) == 'function') params['callback'](id, infowindow);
  },

  addInfoWindow: function(id, params){
    this._resolveLatLng(id, params, '_addInfoWindow');
  },

  addPolyline: function(id, params){
    var opts = params['options'] ? params['options'] : {};
    if (params['path']){
      opts['path'] = [];
      var i = 0;
      for(var k in params['path']){
        opts['path'][i++] = new google.maps.LatLng(params['path'][k][0], params['path'][k][1]);
      }
    }
    var poly = new google.maps.Polyline(opts);
    if (params['events']){
      this._attachEvents(id, poly, params['events']);
    }
    poly.setMap(this._ids[ id ].map);
  },

  addPolygon: function(id, params){
    var opts = params['options'] ? params['options'] : {};
    if (params['paths']){
      opts['paths'] = [];
      var i = 0;
      for(var k in params['paths']){
        opts['paths'][i++] = new google.maps.LatLng(params['paths'][k][0], params['paths'][k][1]);
      }
    }
    var poly = new google.maps.Polygon(opts);
    if (params['events']){
      this._attachEvents(id, poly, params['events']);
    }
    poly.setMap(this._ids[ id ].map);
  },

  setStreetView: function(id, params){
    var opts = params['options'] ? params['options'] : {};
    var panorama = new  google.maps.StreetViewPanorama(document.getElementById(params['id']),opts);
    this._ids[ id ].map.setStreetView(panorama);
  },

  setKmlLayer: function(id, params){
    var opts = params['options'] ? params['options'] : {};
    opts['map'] = this._ids[ id ].map;
    var kml = new  google.maps.KmlLayer(params['url'], opts);
    if (params['events']){
      this._attachEvents(id, kml, params['events']);
    }
  },

  setTrafficLayer: function(id, params){
    var trafficLayer = new  google.maps.TrafficLayer();
    trafficLayer.setMap(this._ids[ id ].map);
  },

  setBicyclingLayer: function(id, params){
    var bikeLayer = new  google.maps.BicyclingLayer();
    bikeLayer.setMap(this._ids[ id ].map);
  },

  setGroundOverlay: function(id, params){
    if (typeof(params['bounds']['getCenter']) == 'function'){
        var bounds = params['bounds'];
    } else {
        for(var i=0; i<2; i++){
            if (typeof(params['bounds'][i]['lat']) != 'function'){
                params['bounds'][i] = new google.maps.LatLng(params['bounds'][i]['lat'],params['bounds'][i]['lng']);
            }
        }
        var bounds = new google.maps.LatLngBounds(params['bounds'][0], params['bounds'][1]);
    }
    var overlay = new  google.maps.GroundOverlay(params['url'], bounds);
    if (params['events']){
      this._attachEvents(id, overlay, params['events']);
    }
    overlay.setMap(this._ids[ id ].map);
  },

  /**
   * @desc Returns the geographical coordinates from an address
   * @param
   *  (id)
   *  params : {}
   *    address   : string
   *    callback  : function( id, GeocoderResults )
   **/
  getLatLng: function(id, params){
    if (typeof(params['callback']) != 'function') return;
    if (params['address']) {
      var callback = function(results, status) {
        params['out'] = status == google.maps.GeocoderStatus.OK ? results : false;
        params['callback'](id, params['out']);
      };
      this._getGeocoder().geocode( { 'address': params['address'] }, callback );
    } else {
        params['out'] = false;
        params['callback'](id, params['out']);
    }
  },


  /**
   * @desc Geolocalise the user and return a LatLng
   * @param
   *  (id)
   *  params : {}
   *    callback  : function( id, LatLng )
   **/
  geoLatLng: function(id, params){
    if (typeof(params['callback']) != 'function') return;
    if(navigator.geolocation) {
      browserSupportFlag = true;
      navigator.geolocation.getCurrentPosition(function(position) {
        params['callback'](id, new google.maps.LatLng(position.coords.latitude,position.coords.longitude));
      }, function() {
        params['callback'](id, false);
      });
    } else if (google.gears) {
      browserSupportFlag = true;
      var geo = google.gears.factory.create('beta.geolocation');
      geo.getCurrentPosition(function(position) {
        params['callback'](id, new google.maps.LatLng(position.latitude,position.longitude));
      }, function() {
        params['callback'](id, false);
      });
    } else {
      params['callback'](id, false);
    }
  },

  setDefault: function(d){
    for(var k in d){
      this._default[k] = $.extend({}, this._default[k], d[k]);
    }
  }
};


jQuery.fn.extend({
  gmap3: function(){
    var $this = $(this);
    if ($this.length > 0){
    var id = $this.attr('id');
    var empty = true;
    for(var i=0; i<arguments.length; i++){
      empty = false;
      $.gmap3._proceed(id, arguments[i] || {});
    }
    if (empty) $.gmap3._proceed(id, {});
    }
    return $(this);
  }
});