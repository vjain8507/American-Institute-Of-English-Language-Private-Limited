( function($) {
	$.a = function(name, prototype) {
		var namespace = name.split('.')[0];
        name = name.split('.')[1];
		$[namespace] = $[namespace] || {};
		$[namespace][name] = function(options, element) {
			if ( arguments.length ) {
				this._setup(options, element);
			}
		};
		$[namespace][name].prototype = $.extend({
			'namespace': namespace,
			'pluginName': name
        }, prototype);
		$.fn[name] = function(options) {
			var isMethodCall = typeof options === "string",
				args = Array.prototype.slice.call(arguments, 1),
				returnValue = this;
			if ( isMethodCall && options.substring(0, 1) === '_' ) { 
				return returnValue; 
			}
			this.each(function() {
				var instance = $.data(this, name);
				if (!instance) {
					instance = $.data(this, name, new $[namespace][name](options, this));
				}
				if (isMethodCall) {
					returnValue = instance[options].apply(instance, args);
				}
			});
			return returnValue; 
		};
	};
	$.a('ui.gmap', {
		options: {
			mapTypeId: 'roadmap',
			zoom: 5	
		},
		option: function(key, options) {
			if (options) {
				this.options[key] = options;
				this.get('map').set(key, options);
				return this;
			}
			return this.options[key];
		},
		_setup: function(options, element) {
			this.el = element;
			options = options || {};
			jQuery.extend(this.options, options, { 'center': this._latLng(options.center) });
			this._create();
			if ( this._init ) { this._init(); }
		},
		_create: function() {
			var self = this;
			this.instance = { 'map': new google.maps.Map(self.el, self.options), 'markers': [], 'overlays': [], 'services': [] };
			google.maps.event.addListenerOnce(self.instance.map, 'bounds_changed', function() { $(self.el).trigger('init', self.instance.map); });
			self._call(self.options.callback, self.instance.map);
		},
		addBounds: function(position) {
			var bounds = this.get('bounds', new google.maps.LatLngBounds());
			bounds.extend(this._latLng(position));
			this.get('map').fitBounds(bounds);
			return this;
		},
		inViewport: function(marker) {
			var bounds = this.get('map').getBounds();
			return (bounds) ? bounds.contains(marker.getPosition()) : false;
		},
		addControl: function(panel, position) {
			this.get('map').controls[position].push(this._unwrap(panel));
			return this;
		},
		addMarker: function(markerOptions, callback) {
			markerOptions.map = this.get('map');
			markerOptions.position = this._latLng(markerOptions.position);
			var marker = new (markerOptions.marker || google.maps.Marker)(markerOptions);
			var markers = this.get('markers');
			if ( marker.id ) {
				markers[marker.id] = marker;
			} else {
				markers.push(marker);
			}
			if ( marker.bounds ) {
				this.addBounds(marker.getPosition());
			}
			this._call(callback, markerOptions.map, marker);
			return $(marker);
		},
		clear: function(ctx) {
			this._c(this.get(ctx));
			this.set(ctx, []);
			return this;
		},
		_c: function(obj) {
			for ( var property in obj ) {
				if ( obj.hasOwnProperty(property) ) {
					if ( obj[property] instanceof google.maps.MVCObject ) {
						google.maps.event.clearInstanceListeners(obj[property]);
						if ( obj[property].setMap ) {
							obj[property].setMap(null);
						}
					} else if ( obj[property] instanceof Array ) {
						this._c(obj[property]);
					}
					obj[property] = null;
				}
			}
		},
		find: function(ctx, options, callback) {
			var obj = this.get(ctx);
			options.value = $.isArray(options.value) ? options.value : [options.value];
			for ( var property in obj ) {
				if ( obj.hasOwnProperty(property) ) {
					var isFound = false;
					for ( var value in options.value ) {
						if ( $.inArray(options.value[value], obj[property][options.property]) > -1 ) {
							isFound = true;
						} else {
							if ( options.operator && options.operator === 'AND' ) {
								isFound = false;
								break;
							}
						}
					}
					callback(obj[property], isFound);
				}
			}
			return this;
		},
		get: function(key, value) {
			var instance = this.instance;
			if ( !instance[key] ) {
				if ( key.indexOf('>') > -1 ) {
					var e = key.replace(/ /g, '').split('>');
					for ( var i = 0; i < e.length; i++ ) {
						if ( !instance[e[i]] ) {
							if (value) {
								instance[e[i]] = ( (i + 1) < e.length ) ? [] : value;
							} else {
								return null;
							}
						}
						instance = instance[e[i]];
					}
					return instance;
				} else if ( value && !instance[key] ) {
					this.set(key, value);
				}
			}
			return instance[key];
		},
		openInfoWindow: function(infoWindowOptions, marker, callback) {
			var iw = this.get('iw', infoWindowOptions.infoWindow || new google.maps.InfoWindow);
			iw.setOptions(infoWindowOptions);
			iw.open(this.get('map'), this._unwrap(marker)); 
			this._call(callback, iw);
			return this;
		},
		closeInfoWindow: function() {
			if ( this.get('iw') != null ) {
				this.get('iw').close();
			}
			return this;
		},
		set: function(key, value) {
			this.instance[key] = value;
			return this;
		},
		refresh: function() {
			var map = this.get('map');
			var latLng = map.getCenter();
			$(map).triggerEvent('resize');
			map.setCenter(latLng);
			return this;
		},
		destroy: function() {
			this.clear('markers').clear('services').clear('overlays')._c(this.instance);
			jQuery.removeData(this.el, this.name);
		},
		_call: function(callback) {
			if ( callback && $.isFunction(callback) ) {
				callback.apply(this, Array.prototype.slice.call(arguments, 1));
			}
		},
		_latLng: function(latLng) {
			if ( !latLng ) {
				return new google.maps.LatLng(0.0, 0.0);
			}
			if ( latLng instanceof google.maps.LatLng ) {
				return latLng;
			} else {
				latLng = latLng.replace(/ /g,'').split(',');
				return new google.maps.LatLng(latLng[0], latLng[1]);
			}
		},
		_unwrap: function(obj) {
			return (!obj) ? null : ( (obj instanceof jQuery) ? obj[0] : ((obj instanceof Object) ? obj : $('#'+obj)[0]) )
		}
	});
	jQuery.fn.extend( {
		triggerEvent: function(eventType) {
			google.maps.event.trigger(this[0], eventType);
			return this;
		},
		addEventListener: function(eventType, eventDataOrCallback, eventCallback) {
			if ( google.maps && this[0] instanceof google.maps.MVCObject ) {
				google.maps.event.addListener(this[0], eventType, eventDataOrCallback);
			} else {
				if (eventCallback) {
					this.bind(eventType, eventDataOrCallback, eventCallback);
				} else {
					this.bind(eventType, eventDataOrCallback);
				} 
			}
			return this;
		}
	});
	jQuery.each(('click rightclick dblclick mouseover mouseout drag dragend').split(' '), function(i, name) {
		jQuery.fn[name] = function(a, b) {
			return this.addEventListener(name, a, b);
		}
	});
} (jQuery) );