CRC = CRC || {};
CRC.util = CRC.util || {};
CRC.util.Observable = Class.extend({

	addListener: function(type, handler, scope) {
		this.$__handlers = this.$__handlers||{};
		this.$__handlers[type] = this.$__handlers[type]||$([]);
		this.$__handlers[type].push({
			fn: handler,
			scope: scope||this
		});
	},

	removeListener: function(type, handler) {

		var handlers = this.$__handlers[type];
		if (handlers && handler) {
			for (var i = 0; i < handlers.length; i++) {
				if (handlers[i].fn == handler) {
					delete this.$__handlers[type][i];
					break;
				}
			}
		} else {
			delete this.$__handlers[type];
		}
	},

	getListeners: function(type) {
		if (this.$__handlers && this.$__handlers[type]) {
			return this.$__handlers[type];
		}

		return null;
	},

	hasListener: function(type) {
		return (this.$__handlers && this.$__handlers[type] && this.$__handlers[type].length);
	},

	purgeListeners: function() {
		if (this._purgeAll) {
			this._purgeAll();
		}
		delete this.$__handlers;
	},

	suspendEvents: function() {
		this._eventsSuspended = true;
	},

	resumeEvents: function() {
		this._eventsSuspended = false;
	},

	fireEvent: function(type, args) {
		if (this._eventsSuspended) return;
		var handlers = this.getListeners(type);
		if (handlers) {
			var result = true;
			handlers.each($.proxy(function(i, v) {
				if (v && v.fn) {
					var scope = v.scope||this;
					result = v.fn.apply(v.scope, args);
					if (result === false) {
						return false;
					}
				}
			}, this));
			if (result === false) {
				return false;
			}
		}

		return true;
	}
});