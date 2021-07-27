function confirm_modal(t, e, a) {
    $("#modal_delete").appendTo("body").modal(), document.getElementById("delete_link").setAttribute("href", t), document.getElementById("delete_link").setAttribute("data-id", e), document.getElementById("delete_link").setAttribute("data-parent", a)
}
var fail_alert ="can not upload Please try again later"
var loggedIn="1";
function readPhoto(t, e) {
    if (t.files && t.files[0]) {
		if(e =='userfile_preview'){
		var loader =  $(".loader.cover_loader");
		}else{
			var loader =  $(".loader.profile_loader");
		}
        loader.show();
        var a = new FileReader;
        a.onload = function(t) {
            $("#" + e).attr("src", t.target.result)
        }, a.readAsDataURL(t.files[0]), $(document).on("submit", "#photoUpload", function(t) {
            t.preventDefault(), $.ajax({
                type: "POST",
                url: $(this).attr("action"),
                data: new FormData(this),
                contentType: !1,
                cache: !1,
                processData: !1,
                success: function(t) {
					loader.hide();
                    try {
                        var e = $.parseJSON(t);
						if(e.status  ==1024){
							$("#modal_alert .modal-body").html(e.messages), $("#modal_alert").appendTo("body").modal()
						}else{
						
                        403 == e.status ? ($(".modal").modal("hide"), $("#login").modal()) : 200 == e.status ? ($("*").modal("hide"), $("#modal_success .modal-body").removeClass("preloader").html(e.messages), $("#modal_success").modal()) : $("#modal_alert .modal-body").removeClass("preloader").html(e.messages)
						}
						
                    } catch (a) {
					
                        $("#modal_alert .modal-body").removeClass("preloader").html(t)
                    }
                }
            }).fail(function() {
				loader.hide();
                $("#modal_alert .modal-body").html(fail_alert), $("#modal_alert").appendTo("body").modal()
            })
        }), $("#photoUpload").submit()
    }
}

function readCover(t, e) {
    if (t.files && t.files[0]) {
        $("#modal_ajax_sm .modal-body").addClass("preloader"), $("#modal_ajax_sm").modal({
            backdrop: "static",
            keyboard: !1
        });
        var a = new FileReader;
        a.onload = function(t) {
            $("#" + e).css({
                background: "url(" + t.target.result + ") center center no-repeat",
                "background-size": "cover",
                "-webkit-background-size": "cover",
                "background-position": "fixed",
                "padding-top": "240px",
                "padding-bottom": "0",
                width: "100%"
            })
        }, a.readAsDataURL(t.files[0]), $(document).on("submit", "#coverUpload", function(t) {
            t.preventDefault(), $.ajax({
                type: "POST",
                url: $(this).attr("action"),
                data: new FormData(this),
                contentType: !1,
                cache: !1,
                processData: !1,
                success: function(t) {
                    try {
                        var e = $.parseJSON(t);
                        403 == e.status ? ($(".modal").modal("hide"), $("#login").modal()) : 200 == e.status ? ($("*").modal("hide"), $("#modal_success .modal-body").removeClass("preloader").html(e.messages), $("#modal_success").modal()) : $("#modal_alert .modal-body").removeClass("preloader").html(e.messages)
                    } catch (a) {
                        $("#modal_alert .modal-body").removeClass("preloader").html(t)
                    }
                }
            }).fail(function() {
                $("#modal_alert .modal-body").html(fail_alert), $("#modal_alert").appendTo("body").modal()
            })
        }), $("#coverUpload").submit()
    }
}

function carouselNormalization() {
    function t() {
        a.each(function() {
            o.push($(this).height())
        }), e = Math.max.apply(null, o), a.each(function() {
            $(this).css("min-height", e + "px")
        })
    }
    var e, a = $("#carousel .item"),
        o = [];
    a.length && (t(), $(window).on("resize orientationchange", function() {
        e = 0, o.length = 0, a.each(function() {
            $(this).css("min-height", "0")
        }), t()
    }))
}(function() {
    var t, e, a, o, n, s, i, r, l, d, c, u, m, h, f, p, $, g, v, y, b, w, C, _, k, x, S, T, D, j, F, P, A, N, L, I, O, q, R, E, U, M, z, B, H, J, W, X, G, K = [].slice,
        Q = {}.hasOwnProperty,
        V = function(t, e) {
            function a() {
                this.constructor = t
            }
            for (var o in e) Q.call(e, o) && (t[o] = e[o]);
            return a.prototype = e.prototype, t.prototype = new a, t.__super__ = e.prototype, t
        },
        Y = [].indexOf || function(t) {
            for (var e = 0, a = this.length; a > e; e++)
                if (e in this && this[e] === t) return e;
            return -1
        };
    for (b = {
            catchupTime: 100,
            initialRate: .03,
            minTime: 250,
            ghostTime: 100,
            maxProgressPerFrame: 20,
            easeFactor: 1.25,
            startOnPageLoad: !0,
            restartOnPushState: !0,
            restartOnRequestAfter: 500,
            target: "body",
            elements: {
                checkInterval: 100,
                selectors: ["body"]
            },
            eventLag: {
                minSamples: 10,
                sampleCount: 3,
                lagThreshold: 3
            },
            ajax: {
                trackMethods: ["GET"],
                trackWebSockets: !0,
                ignoreURLs: []
            }
        }, D = function() {
            var t;
            return null != (t = "undefined" != typeof performance && null !== performance && "function" == typeof performance.now ? performance.now() : void 0) ? t : +new Date
        }, F = window.requestAnimationFrame || window.mozRequestAnimationFrame || window.webkitRequestAnimationFrame || window.msRequestAnimationFrame, y = window.cancelAnimationFrame || window.mozCancelAnimationFrame, null == F && (F = function(t) {
            return setTimeout(t, 50)
        }, y = function(t) {
            return clearTimeout(t)
        }), A = function(t) {
            var e, a;
            return e = D(), (a = function() {
                var o;
                return o = D() - e, o >= 33 ? (e = D(), t(o, function() {
                    return F(a)
                })) : setTimeout(a, 33 - o)
            })()
        }, P = function() {
            var t, e, a;
            return a = arguments[0], e = arguments[1], t = 3 <= arguments.length ? K.call(arguments, 2) : [], "function" == typeof a[e] ? a[e].apply(a, t) : a[e]
        }, w = function() {
            var t, e, a, o, n, s, i;
            for (e = arguments[0], o = 2 <= arguments.length ? K.call(arguments, 1) : [], s = 0, i = o.length; i > s; s++)
                if (a = o[s])
                    for (t in a) Q.call(a, t) && (n = a[t], null != e[t] && "object" == typeof e[t] && null != n && "object" == typeof n ? w(e[t], n) : e[t] = n);
            return e
        }, $ = function(t) {
            var e, a, o, n, s;
            for (a = e = 0, n = 0, s = t.length; s > n; n++) o = t[n], a += Math.abs(o), e++;
            return a / e
        }, _ = function(t, e) {
            var a, o, n;
            if (null == t && (t = "options"), null == e && (e = !0), n = document.querySelector("[data-pace-" + t + "]")) {
                if (a = n.getAttribute("data-pace-" + t), !e) return a;
                try {
                    return JSON.parse(a)
                } catch (s) {
                    return o = s, "undefined" != typeof console && null !== console ? console.error("Error parsing inline pace options", o) : void 0
                }
            }
        }, i = function() {
            function t() {}
            return t.prototype.on = function(t, e, a, o) {
                var n;
                return null == o && (o = !1), null == this.bindings && (this.bindings = {}), null == (n = this.bindings)[t] && (n[t] = []), this.bindings[t].push({
                    handler: e,
                    ctx: a,
                    once: o
                })
            }, t.prototype.once = function(t, e, a) {
                return this.on(t, e, a, !0)
            }, t.prototype.off = function(t, e) {
                var a, o, n;
                if (null != (null != (o = this.bindings) ? o[t] : void 0)) {
                    if (null == e) return delete this.bindings[t];
                    for (a = 0, n = []; a < this.bindings[t].length;) n.push(this.bindings[t][a].handler === e ? this.bindings[t].splice(a, 1) : a++);
                    return n
                }
            }, t.prototype.trigger = function() {
                var t, e, a, o, n, s, i, r, l;
                if (a = arguments[0], t = 2 <= arguments.length ? K.call(arguments, 1) : [], null != (i = this.bindings) ? i[a] : void 0) {
                    for (n = 0, l = []; n < this.bindings[a].length;) r = this.bindings[a][n], o = r.handler, e = r.ctx, s = r.once, o.apply(null != e ? e : this, t), l.push(s ? this.bindings[a].splice(n, 1) : n++);
                    return l
                }
            }, t
        }(), d = window.Pace || {}, window.Pace = d, w(d, i.prototype), j = d.options = w({}, b, window.paceOptions, _()), W = ["ajax", "document", "eventLag", "elements"], z = 0, H = W.length; H > z; z++) O = W[z], j[O] === !0 && (j[O] = b[O]);
    l = function(t) {
        function e() {
            return X = e.__super__.constructor.apply(this, arguments)
        }
        return V(e, t), e
    }(Error), e = function() {
        function t() {
            this.progress = 0
        }
        return t.prototype.getElement = function() {
            var t;
            if (null == this.el) {
                if (t = document.querySelector(j.target), !t) throw new l;
                this.el = document.createElement("div"), this.el.className = "pace pace-active", document.body.className = document.body.className.replace(/pace-done/g, ""), document.body.className += " pace-running", this.el.innerHTML = '<div class="pace-progress">\n  <div class="pace-progress-inner"></div>\n</div>\n<div class="pace-activity"></div>', null != t.firstChild ? t.insertBefore(this.el, t.firstChild) : t.appendChild(this.el)
            }
            return this.el
        }, t.prototype.finish = function() {
            var t;
            return t = this.getElement(), t.className = t.className.replace("pace-active", ""), t.className += " pace-inactive", document.body.className = document.body.className.replace("pace-running", ""), document.body.className += " pace-done"
        }, t.prototype.update = function(t) {
            return this.progress = t, this.render()
        }, t.prototype.destroy = function() {
            try {
                this.getElement().parentNode.removeChild(this.getElement())
            } catch (t) {
                l = t
            }
            return this.el = void 0
        }, t.prototype.render = function() {
            var t, e, a, o, n, s, i;
            if (null == document.querySelector(j.target)) return !1;
            for (t = this.getElement(), o = "translate3d(" + this.progress + "%, 0, 0)", i = ["webkitTransform", "msTransform", "transform"], n = 0, s = i.length; s > n; n++) e = i[n], t.children[0].style[e] = o;
            return (!this.lastRenderedProgress || this.lastRenderedProgress | 0 !== this.progress | 0) && (t.children[0].setAttribute("data-progress-text", "" + (0 | this.progress) + "%"), this.progress >= 100 ? a = "99" : (a = this.progress < 10 ? "0" : "", a += 0 | this.progress), t.children[0].setAttribute("data-progress", "" + a)), this.lastRenderedProgress = this.progress
        }, t.prototype.done = function() {
            return this.progress >= 100
        }, t
    }(), r = function() {
        function t() {
            this.bindings = {}
        }
        return t.prototype.trigger = function(t, e) {
            var a, o, n, s, i;
            if (null != this.bindings[t]) {
                for (s = this.bindings[t], i = [], o = 0, n = s.length; n > o; o++) a = s[o], i.push(a.call(this, e));
                return i
            }
        }, t.prototype.on = function(t, e) {
            var a;
            return null == (a = this.bindings)[t] && (a[t] = []), this.bindings[t].push(e)
        }, t
    }(), M = window.XMLHttpRequest, U = window.XDomainRequest, E = window.WebSocket, C = function(t, e) {
        var a, o, n, s;
        s = [];
        for (o in e.prototype) try {
            n = e.prototype[o], s.push(null == t[o] && "function" != typeof n ? t[o] = n : void 0)
        } catch (i) {
            a = i
        }
        return s
    }, S = [], d.ignore = function() {
        var t, e, a;
        return e = arguments[0], t = 2 <= arguments.length ? K.call(arguments, 1) : [], S.unshift("ignore"), a = e.apply(null, t), S.shift(), a
    }, d.track = function() {
        var t, e, a;
        return e = arguments[0], t = 2 <= arguments.length ? K.call(arguments, 1) : [], S.unshift("track"), a = e.apply(null, t), S.shift(), a
    }, I = function(t) {
        var e;
        if (null == t && (t = "GET"), "track" === S[0]) return "force";
        if (!S.length && j.ajax) {
            if ("socket" === t && j.ajax.trackWebSockets) return !0;
            if (e = t.toUpperCase(), Y.call(j.ajax.trackMethods, e) >= 0) return !0
        }
        return !1
    }, c = function(t) {
        function e() {
            var t, a = this;
            e.__super__.constructor.apply(this, arguments), t = function(t) {
                var e;
                return e = t.open, t.open = function(o, n) {
                    return I(o) && a.trigger("request", {
                        type: o,
                        url: n,
                        request: t
                    }), e.apply(t, arguments)
                }
            }, window.XMLHttpRequest = function(e) {
                var a;
                return a = new M(e), t(a), a
            };
            try {
                C(window.XMLHttpRequest, M)
            } catch (o) {}
            if (null != U) {
                window.XDomainRequest = function() {
                    var e;
                    return e = new U, t(e), e
                };
                try {
                    C(window.XDomainRequest, U)
                } catch (o) {}
            }
            if (null != E && j.ajax.trackWebSockets) {
                window.WebSocket = function(t, e) {
                    var o;
                    return o = null != e ? new E(t, e) : new E(t), I("socket") && a.trigger("request", {
                        type: "socket",
                        url: t,
                        protocols: e,
                        request: o
                    }), o
                };
                try {
                    C(window.WebSocket, E)
                } catch (o) {}
            }
        }
        return V(e, t), e
    }(r), B = null, k = function() {
        return null == B && (B = new c), B
    }, L = function(t) {
        var e, a, o, n;
        for (n = j.ajax.ignoreURLs, a = 0, o = n.length; o > a; a++)
            if (e = n[a], "string" == typeof e) {
                if (-1 !== t.indexOf(e)) return !0
            } else if (e.test(t)) return !0;
        return !1
    }, k().on("request", function(e) {
        var a, o, n, s, i;
        return s = e.type, n = e.request, i = e.url, L(i) ? void 0 : d.running || j.restartOnRequestAfter === !1 && "force" !== I(s) ? void 0 : (o = arguments, a = j.restartOnRequestAfter || 0, "boolean" == typeof a && (a = 0), setTimeout(function() {
            var e, a, i, r, l, c;
            if (e = "socket" === s ? n.readyState < 2 : 0 < (r = n.readyState) && 4 > r) {
                for (d.restart(), l = d.sources, c = [], a = 0, i = l.length; i > a; a++) {
                    if (O = l[a], O instanceof t) {
                        O.watch.apply(O, o);
                        break
                    }
                    c.push(void 0)
                }
                return c
            }
        }, a))
    }), t = function() {
        function t() {
            var t = this;
            this.elements = [], k().on("request", function() {
                return t.watch.apply(t, arguments)
            })
        }
        return t.prototype.watch = function(t) {
            var e, a, o, n;
            return o = t.type, e = t.request, n = t.url, L(n) ? void 0 : (a = "socket" === o ? new h(e) : new f(e), this.elements.push(a))
        }, t
    }(), f = function() {
        function t(t) {
            var e, a, o, n, s, i, r = this;
            if (this.progress = 0, null != window.ProgressEvent)
                for (a = null, t.addEventListener("progress", function(t) {
                        return r.progress = t.lengthComputable ? 100 * t.loaded / t.total : r.progress + (100 - r.progress) / 2
                    }, !1), i = ["load", "abort", "timeout", "error"], o = 0, n = i.length; n > o; o++) e = i[o], t.addEventListener(e, function() {
                    return r.progress = 100
                }, !1);
            else s = t.onreadystatechange, t.onreadystatechange = function() {
                var e;
                return 0 === (e = t.readyState) || 4 === e ? r.progress = 100 : 3 === t.readyState && (r.progress = 50), "function" == typeof s ? s.apply(null, arguments) : void 0
            }
        }
        return t
    }(), h = function() {
        function t(t) {
            var e, a, o, n, s = this;
            for (this.progress = 0, n = ["error", "open"], a = 0, o = n.length; o > a; a++) e = n[a], t.addEventListener(e, function() {
                return s.progress = 100
            }, !1)
        }
        return t
    }(), o = function() {
        function t(t) {
            var e, a, o, s;
            for (null == t && (t = {}), this.elements = [], null == t.selectors && (t.selectors = []), s = t.selectors, a = 0, o = s.length; o > a; a++) e = s[a], this.elements.push(new n(e))
        }
        return t
    }(), n = function() {
        function t(t) {
            this.selector = t, this.progress = 0, this.check()
        }
        return t.prototype.check = function() {
            var t = this;
            return document.querySelector(this.selector) ? this.done() : setTimeout(function() {
                return t.check()
            }, j.elements.checkInterval)
        }, t.prototype.done = function() {
            return this.progress = 100
        }, t
    }(), a = function() {
        function t() {
            var t, e, a = this;
            this.progress = null != (e = this.states[document.readyState]) ? e : 100, t = document.onreadystatechange, document.onreadystatechange = function() {
                return null != a.states[document.readyState] && (a.progress = a.states[document.readyState]), "function" == typeof t ? t.apply(null, arguments) : void 0
            }
        }
        return t.prototype.states = {
            loading: 0,
            interactive: 50,
            complete: 100
        }, t
    }(), s = function() {
        function t() {
            var t, e, a, o, n, s = this;
            this.progress = 0, t = 0, n = [], o = 0, a = D(), e = setInterval(function() {
                var i;
                return i = D() - a - 50, a = D(), n.push(i), n.length > j.eventLag.sampleCount && n.shift(), t = $(n), ++o >= j.eventLag.minSamples && t < j.eventLag.lagThreshold ? (s.progress = 100, clearInterval(e)) : s.progress = 100 * (3 / (t + 3))
            }, 50)
        }
        return t
    }(), m = function() {
        function t(t) {
            this.source = t, this.last = this.sinceLastUpdate = 0, this.rate = j.initialRate, this.catchup = 0, this.progress = this.lastProgress = 0, null != this.source && (this.progress = P(this.source, "progress"))
        }
        return t.prototype.tick = function(t, e) {
            var a;
            return null == e && (e = P(this.source, "progress")), e >= 100 && (this.done = !0), e === this.last ? this.sinceLastUpdate += t : (this.sinceLastUpdate && (this.rate = (e - this.last) / this.sinceLastUpdate), this.catchup = (e - this.progress) / j.catchupTime, this.sinceLastUpdate = 0, this.last = e), e > this.progress && (this.progress += this.catchup * t), a = 1 - Math.pow(this.progress / 100, j.easeFactor), this.progress += a * this.rate * t, this.progress = Math.min(this.lastProgress + j.maxProgressPerFrame, this.progress), this.progress = Math.max(0, this.progress), this.progress = Math.min(100, this.progress), this.lastProgress = this.progress, this.progress
        }, t
    }(), q = null, N = null, g = null, R = null, p = null, v = null, d.running = !1, x = function() {
        return j.restartOnPushState ? d.restart() : void 0
    }, null != window.history.pushState && (J = window.history.pushState, window.history.pushState = function() {
        return x(), J.apply(window.history, arguments)
    }), null != window.history.replaceState && (G = window.history.replaceState, window.history.replaceState = function() {
        return x(), G.apply(window.history, arguments)
    }), u = {
        ajax: t,
        elements: o,
        document: a,
        eventLag: s
    }, (T = function() {
        var t, a, o, n, s, i, r, l;
        for (d.sources = q = [], i = ["ajax", "elements", "document", "eventLag"], a = 0, n = i.length; n > a; a++) t = i[a], j[t] !== !1 && q.push(new u[t](j[t]));
        for (l = null != (r = j.extraSources) ? r : [], o = 0, s = l.length; s > o; o++) O = l[o], q.push(new O(j));
        return d.bar = g = new e, N = [], R = new m
    })(), d.stop = function() {
        return d.trigger("stop"), d.running = !1, g.destroy(), v = !0, null != p && ("function" == typeof y && y(p), p = null), T()
    }, d.restart = function() {
        return d.trigger("restart"), d.stop(), d.start()
    }, d.go = function() {
        var t;
        return d.running = !0, g.render(), t = D(), v = !1, p = A(function(e, a) {
            var o, n, s, i, r, l, c, u, h, f, p, $, y, b, w, C;
            for (u = 100 - g.progress, n = p = 0, s = !0, l = $ = 0, b = q.length; b > $; l = ++$)
                for (O = q[l], f = null != N[l] ? N[l] : N[l] = [], r = null != (C = O.elements) ? C : [O], c = y = 0, w = r.length; w > y; c = ++y) i = r[c], h = null != f[c] ? f[c] : f[c] = new m(i), s &= h.done, h.done || (n++, p += h.tick(e));
            return o = p / n, g.update(R.tick(e, o)), g.done() || s || v ? (g.update(100), d.trigger("done"), setTimeout(function() {
                return g.finish(), d.running = !1, d.trigger("hide")
            }, Math.max(j.ghostTime, Math.max(j.minTime - (D() - t), 0)))) : a()
        })
    }, d.start = function(t) {
        w(j, t), d.running = !0;
        try {
            g.render()
        } catch (e) {
            l = e
        }
        return document.querySelector(".pace") ? (d.trigger("start"), d.go()) : setTimeout(d.start, 50)
    }, "function" == typeof define && define.amd ? define(function() {
        return d
    }) : "object" == typeof exports ? module.exports = d : j.startOnPageLoad && d.start()
}).call(this), loggedIn && $(function() {
    function t() {
        Pace.ignore(function() {
            var t = document.title,
                e = 0;
            $.ajax({
                url: base_url + "user/alerts",
                success: function(a) {
                    var o = $.parseJSON(a);
                    if (200 == o.status) {
                        if (/\([\d]+\)/.test(t)) {
                            if (t = t.split(") "), e = t[0].substring(1), e == o.count) return;
                            document.title = "(" + o.count + ") " + t[1]
                        } else document.title = "(" + o.count + ") " + t;
                        $(".countAlert").addClass("badge bg-red").html('<i class="fa fa-bell hidden-xs"></i> ' + o.count)
                    } else $(".countAlert").removeClass("badge bg-red").html('<i class="fa fa-bell hidden-xs"></i> '), /\([\d]+\)/.test(t) && (document.title = t.replace(/\([\d]+\)/, ""))
                }
            }).fail(function() {
                $("#modal_alert .modal-body").html(dc_alert), $("#modal_alert").appendTo("body").modal()
            })
        })
    }
    $("body").on("click", ".load-notifications", function(t) {
        t.preventDefault(), $(".notifications").height(60).addClass("loading"), $(".notifications .slimScrollDiv, .notifications-area#slimScroll").height(60), $(".notifications-area").html(""), $.ajax({
            url: base_url + "user/load_alerts",
            success: function(t) {
                var e = $.parseJSON(t);
                x = document.title, 200 == e.status && /\([\d]+\)/.test(x) && (document.title = x.replace(/\([\d]+\)/, "")), 200 == e.status ? ($(".notifications").height($(window).height() / 1.5).removeClass("loading"), $(".notifications .slimScrollDiv, .notifications-area#slimScroll").height($(window).height() / 1.5), $(".notifications-area").html(e.html), $.fn.slimScroll && $("#slimScroll").length && $("#slimScroll").slimScroll({
                    height: $(window).height() / 1.5
                }), $(".notifications-footer").css("display", "block")) : ($(".notifications").height("auto").removeClass("loading"), $(".notifications .slimScrollDiv, .notifications-area#slimScroll").height("auto"), $(".notifications-area").html('<div class="col-sm-12 text-center"><br /><i class="fa fa-info-circle"></i> ' + e.html + "<br /><br /></div>"), $(".notifications-footer").css("display", "none"))
            }
        }).fail(function() {
            $("#modal_alert .modal-body").html(dc_alert), $("#modal_alert").appendTo("body").modal()
        })
    })/*, setInterval(function() {
        t()
    }, 3e3)*/
}), $(document).ready(function() {
    var e = !1;
    if ($(document).on("keypress keyup keydown paste cut", "input, textarea, select", function() {
            e = "" != $(this).val() ? !0 : !1
        }), $(window).on("popstate", function(t) {
            null !== t.state ? (Pace.restart(), $.get(location.href, function(t) {
                document.title = t.meta.title + " | " + siteName, $(".navbar").find("li.active").removeClass("active"), $(".navbar a[href='" + location.href + "']").parents().addClass("active"), window.history.pushState("string", t.meta.title + " | " + siteName, location.href), $(".pushTitle").text(t.meta.title), $("#page-content").html(t.html), $.isFunction($.fn.slimScroll) && $(window).width() > 768 && $("#slimScroll").length && $("#slimScroll").slimScroll({
                    height: "500px"
                }), $.isFunction($.fn.sticky) && $(window).width() > 768 && $(".sticky").length && $(".sticky").sticky(), $.isFunction($.fn.masonry) && $(window).width() > 768 && $(".grid").length && $(".grid").imagesLoaded(function() {
                    $(".grid").masonry({
                        itemSelector: ".grid-item"
                    })
                })
            }).fail(function() {
                $("#modal_alert .modal-body").html(fail_alert), $("#modal_alert").appendTo("body").modal()
            })) : window.location.href = location.href
        }), $(document).on("click", ".ajaxLoad", function(t) {
            t.preventDefault(), Pace.restart();
            var a = $(this).attr("href");
            return e ? (Pace.stop(), document.getElementById("confirm_link").setAttribute("href", a), $("#modal_confirm").modal()) : ($("*").modal("hide"), void $.get(a, function(t) {
                t.redirect ? window.location.href = t.url : (document.title = t.meta.title + " | " + siteName, $(".navbar").find("li.active").removeClass("active"), $(".navbar a[href='" + a + "']").parents().addClass("active"), window.history.pushState("string", t.meta.title + " | " + siteName, a), $(".pushTitle").text(t.meta.title), $("#page-content").html(t.html), $.isFunction($.fn.carousel) && $(".carousel").length && $(".carousel").carousel({
                    interval: 5e3
                }), $.isFunction($.fn.slimScroll) && $(window).width() > 768 && $("#slimScroll").length && $("#slimScroll").slimScroll({
                    height: "500px"
                }), $.isFunction($.fn.sticky) && $(window).width() > 768 && $(".sticky").length && $(".sticky").sticky(), $.isFunction($.fn.masonry) && $(window).width() > 768 && $(".grid").length && $(".grid").imagesLoaded(function() {
                    $(".grid").masonry({
                        itemSelector: ".grid-item"
                    })
                }))
            }).done(function() {
                $("html,body").animate({
                    scrollTop: 0
                }, "slow")
            }).fail(function() {
                $("#modal_alert .modal-body").html(fail_alert), $("#modal_alert").appendTo("body").modal()
            }))
        }), $(document).on("click", ".ajax", function(t) {
            if (t.preventDefault(), !($(window).width() > 768)) {
                Pace.restart();
                var a = $(this).attr("href");
                return e ? (Pace.stop(), document.getElementById("confirm_link").setAttribute("href", a), $("#modal_confirm").modal()) : ($("*").modal("hide"), void $.get(a, function(t) {
                    t.redirect ? window.location.href = t.url : (document.title = t.meta.title + " | " + siteName, $(".navbar").find("li.active").removeClass("active"), $(".navbar a[href='" + a + "']").parents().addClass("active"), window.history.pushState("string", t.meta.title + " | " + siteName, a), $(".pushTitle").text(t.meta.title), $("#page-content").html(t.html), $.isFunction($.fn.slimScroll) && $(window).width() > 768 && $("#slimScroll").length && $("#slimScroll").slimScroll({
                        height: "500px"
                    }), $.isFunction($.fn.sticky) && $(window).width() > 768 && $(".sticky").length && $(".sticky").sticky(), $.isFunction($.fn.masonry) && $(window).width() > 768 && $(".grid").length && $(".grid").imagesLoaded(function() {
                        $(".grid").masonry({
                            itemSelector: ".grid-item"
                        })
                    }))
                }).done(function() {
                    $("html,body").animate({
                        scrollTop: 0
                    }, "slow")
                }).fail(function() {
                    $("#modal_alert .modal-body").html(fail_alert), $("#modal_alert").appendTo("body").modal()
                }))
            }
            $("#modal_ajax .modal-body").html("").addClass("preloader"), $("#modal_ajax").modal(), $.ajax({
                url: $(this).attr("href"),
                data: {
                    modal: !0
                },
                method: "POST",
                success: function(t) {
                    $("#modal_ajax .modal-body").removeClass("preloader").html(t), $.isFunction($.fn.slimScroll) && $("#slimScroll, #slimScroll_b").slimScroll({
                        height: "600px"
                    })
                }
            }).fail(function() {
                $("#modal_alert .modal-body").html(fail_alert), $("#modal_alert").appendTo("body").modal()
            })
        }), $(document).on("submit", "form", function(t) {
            $(window).off("beforeunload")
        }), $(document).on("submit", ".submitForm", function(t) {
            t.preventDefault();
            var a = $(this),
                o = $(this).attr("data-saving"),
                n = $(this).attr("data-save"),
                s = $(this).attr("data-alert"),
                i = $(this).is("[data-id]") ? $(this).attr("data-id") : "";
            a.find(".submitBtn").addClass("disabled").html('<i class="fa fa-circle-o-notch fa-spin"></i> ' + o), a.find(".error").remove(), $.ajax({
                url: $(this).attr("action"),
                type: "POST",
                data: new FormData(this),
                contentType: !1,
                cache: !1,
                processData: !1,
                success: function(t) {
                    var t = $.parseJSON(t);
                    a.find(".submitBtn").removeClass("disabled").html('<i class="fa fa-check-circle"></i> ' + n), 406 == t.status ? a.find(".statusHolder").fadeIn().html('<div class="error"><div class="animated fadeIn alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' + t.messages + "</div></div>") : 200 == t.status ? t.redirect ? window.location.href = t.redirect : t.repost && ($("#reposts-count" + i).length && $("#reposts-count" + i).text(t.count), $(".modal").modal("hide"), $("#modal_success .modal-body").html(t.messages), $("#modal_success").appendTo("body").modal()) : 204 == t.status ? $.each(t.messages, function(t, e) {
                        a.find(".statusHolder").fadeIn().html('<div class="error"><div class="animated fadeIn alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' + e + "</div></div>")
                    }) : 403 == t.status ? ($(".modal").modal("hide"), $("#login").modal()) : ($("#modal_alert .modal-body").html(t.messages), $("#modal_alert").appendTo("body").modal()), e = !1
                },
                error: function(t, e, o) {
                    a.find(".submitBtn").removeClass("disabled").html('<i class="fa fa-check-circle"></i> ' + n), $("#modal_alert .modal-body").html(s), $("#modal_alert").appendTo("body").modal()
                }
            }).fail(function() {
                a.find(".submitBtn").removeClass("disabled").html('<i class="fa fa-check-circle"></i> ' + n), $("#modal_alert .modal-body").html(fail_alert), $("#modal_alert").appendTo("body").modal()
            })
        }), $(document).on("submit", "#addUpdateForm", function(t) {
            t.preventDefault();
            var a = $(this);
            $("#updateInput").attr("readonly", !0), $(".error").remove(), $("#update-icon").removeClass("fa-edit").addClass("fa-circle-o-notch fa-spin"), $.post(a.attr("action"), a.serialize(), function(t) {
                200 == t.status ? ($("#updateInput").css("height", "auto").val(""), $(t.html).hide().insertAfter("#fetch_new_update").slideDown()) : 204 == t.status ? $.each(t.messages, function(t, e) {
                    a.find(".statusHolder").prepend('<div class="error"><div class="animated fadeIn alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' + e + "</div></div>").slideDown()
                }) : 403 == t.status ? ($(".modal").modal("hide"), $("#login").modal()) : ($("#modal_alert .modal-body").html(t.messages), $("#modal_alert").appendTo("body").modal()), $("#update-icon").removeClass("fa-circle-o-notch fa-spin").addClass("fa-edit"), $("#updateInput").removeAttr("readonly"), e = !1
            }, "json")
        }), $(document).on("submit", "#addCommentForm", function(t) {
            t.preventDefault();
            var a = $(this),
                o = $(this).attr("data-id");
            a.find($(".hitAction")).addClass("preloader").attr("readonly", !0), $(".error").remove(), $.post(a.attr("action"), a.serialize(), function(t) {
                200 == t.status ? ($(".comments-count-" + o).text(t.count), $(".comments_holder-" + o).find(".fetch_new_comment").after(t.html).hide().slideDown(), a.find("#commentInput").css("height", "auto").val(""), a.find(".hitAction").removeClass("preloader").removeAttr("readonly").val("")) : 204 == t.status ? $.each(t.messages, function(t, e) {
                    a.find(".statusHolder").prepend('<div class="error"><div class="animated fadeIn alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' + e + "</div></div>")
                }) : 403 == t.status ? ($(".modal").modal("hide"), $("#login").modal()) : ($("#modal_alert .modal-body").html(t.messages), $("#modal_alert").appendTo("body").modal()), a.find(".hitAction").removeClass("preloader").removeAttr("readonly").val(""), e = !1
            }, "json")
        }), $(document).on("click", ".reply-comment", function(t) {
            t.preventDefault();
            var e = $(this).attr("data-reply"),
                a = $(this).attr("data-summon");
            $("html, body").animate({
                scrollTop: $(this).parent($("#addCommentForm")).offset().top - 100
            }, 300), $("#commentInput").focus().val("@" + a + " " + $("#rcomment" + e).text() + "\n")
        }), $(document).on("click", ".commentBtn", function(t) {
            t.preventDefault(), $(this).parent($("#addCommentForm")).submit()
        }), $(document).on("click", ".like", function(t) {
            t.preventDefault();
            var e = $(this).attr("data-id");
            $(".like-" + e).hasClass("active") ? $(".like-" + e).removeClass("active") : $(".like-" + e).addClass("active"), $(".like-icon", $(".like-" + e)).removeClass("fa-thumbs-up").addClass("fa-circle-o-notch fa-spin"), $.ajax({
                url: $(this).attr("href"),
                context: this,
                success: function(t) {
                    var a = $.parseJSON(t);
                    $(".like-icon", $(".like-" + e)).removeClass("fa-circle-o-notch fa-spin"), "liked" == a.status ? ($(".like-icon", $(".like-" + e)).addClass("fa-thumbs-up"), $(".like-" + e).addClass("active"), $(".likes-count", $(".like-" + e)).text(a.count)) : "disliked" == a.status ? ($(".like-icon", $(".like-" + e)).addClass("fa-thumbs-up"), $(".like-" + e).removeClass("active"), $(".likes-count", $(".like-" + e)).text(a.count)) : 403 == a.status ? ($(".like-" + e).hasClass("active") ? $(".like-" + e).removeClass("active") : $(".like-" + e).addClass("active"), $(".like-icon", $(".like-" + e)).addClass("fa-thumbs-up"), $(".modal").modal("hide"), $("#login").modal()) : ($(".like-" + e).hasClass("active") ? $(".like-" + e).removeClass("active") : $(".like-" + e).addClass("active"), $(".like-icon", $(".like-" + e)).addClass("fa-thumbs-up"), $("#modal_alert .modal-body").html(a.messages), $("#modal_alert").appendTo("body").modal())
                }
            }).fail(function() {
                $("#modal_alert .modal-body").html(fail_alert), $("#modal_alert").appendTo("body").modal()
            })
        }), $(document).on("click", "#follow", function(t) {
            t.preventDefault(), $(this).hasClass("active") ? $(this).removeClass("active") : $(this).addClass("active"), $("#follow-icon", $(this)).removeClass("fa-refresh").addClass("fa-circle-o-notch fa-spin"), $.ajax({
                url: $(this).attr("href"),
                context: this,
                success: function(t) {
                    var e = $.parseJSON(t);
                    $("#follow-icon", $(this)).removeClass("fa-circle-o-notch fa-spin"), "followed" == e.status ? ($("#follow-icon", $(this)).addClass("fa-times"), $(this).removeClass("btn-info").addClass("btn-warning active"), $(".follow-text", $(this)).text("Unfollow"), $("#followers-count").text(e.count)) : "unfollowed" == e.status ? ($("#follow-icon", $(this)).addClass("fa-refresh"), $(this).removeClass("btn-info").addClass("btn-warning"), $(".follow-text", $(this)).text("Follow"), $(this).removeClass("btn-warning active").addClass("btn-info"), $("#followers-count").text(e.count)) : 403 == e.status ? ($("#follow-icon", $(this)).addClass("fa-refresh"), $(this).hasClass("active") ? $(this).removeClass("active") : $(this).addClass("active"), $(".modal").modal("hide"), $("#login").modal()) : ($("#follow-icon", $(this)).hashClass("fa-refresh") ? $("#follow-icon", $(this)).removeClass("fa-refresh").addClass("fa-times") : $("#follow-icon", $(this)).addClass("fa-refresh"), $(this).hasClass("active") ? $(this).removeClass("active") : $(this).addClass("active"), $("#modal_alert .modal-body").html(e.messages), $("#modal_alert").appendTo("body").modal())
                }
            }).fail(function() {
                $("#follow-icon", $(this)).removeClass("fa-circle-o-notch fa-spin"), $("#modal_alert .modal-body").html(fail_alert), $("#modal_alert").appendTo("body").modal()
            })
        }), $(document).on("click", "#friendship", function(t) {
            t.preventDefault(), $(this).hasClass("active") ? $(this).removeClass("active") : $(this).addClass("active"), $("#friend-icon", $(this)).removeClass("fa-user").addClass("fa-circle-o-notch fa-spin"), $.ajax({
                url: $(this).attr("href"),
                context: this,
                success: function(t) {
                    var e = $.parseJSON(t);
                    $("#friend-icon", $(this)).removeClass("fa-circle-o-notch fa-spin"), "added" == e.status ? ($("#friend-icon", $(this)).addClass("fa-user"), $(".friend-text", $(this)).text("Cancel"), $(this).hasClass("active") ? $(this).removeClass("active") : $(this).addClass("active"), $(this).removeClass("btn-success").addClass("btn-warning")) : "confirmed" == e.status ? ($("#friend-icon", $(this)).addClass("fa-check-circle"), $(".friend-text", $(this)).text("Remove"), $(this).hasClass("active") ? $(this).removeClass("active") : $(this).addClass("active"), $(this).removeClass("btn-info").addClass("btn-danger"), $("#friends-count", $(this)).text(e.count)) : "removed" == e.status || "canceled" == e.status ? ($("#friend-icon", $(this)).addClass("fa-user"), $(".friend-text", $(this)).text("Add Friend"), $(this).hasClass("active") ? $(this).removeClass("active") : $(this).addClass("active"), $(this).removeClass("btn-danger btn-warning").addClass("btn-success"), $("#friends-count", $(this)).text(e.count)) : 403 == e.status ? ($("#friend-icon", $(this)).addClass("fa-user"), $(this).hasClass("active") ? $(this).removeClass("active") : $(this).addClass("active"), $(".modal").modal("hide"), $("#login").modal()) : ($("#friend-icon", $(this)).addClass("fa-user"), $(this).hasClass("active") ? $(this).removeClass("active") : $(this).addClass("active"), $("#modal_alert .modal-body").html(e.messages), $("#modal_alert").appendTo("body").modal())
                }
            }).fail(function() {
                $("#friend-icon", $(this)).removeClass("fa-circle-o-notch fa-spin"), $("#modal_alert .modal-body").html(fail_alert), $("#modal_alert").appendTo("body").modal()
            })
        }), $(document).on("click", "#delete_link", function(t) {
            t.preventDefault();
            var t = $(this).attr("data-id"),
                e = $(this).attr("data-parent");
            $("#delete-icon").removeClass("fa-check").addClass("fa-circle-o-notch fa-spin"), $.ajax({
                url: $(this).attr("href"),
                context: this,
                success: function(a) {
                    var o = $.parseJSON(a);
                    $("#delete-icon").removeClass("fa-circle-o-notch fa-spin").addClass("fa-check"), 200 == o.status ? ($(".comments-count-" + e).text(o.count), $("#modal_delete").modal("hide"), "all" == t ? $(".listHolder").remove() : $("." + t).remove()) : 403 == o.status ? ($(".modal").modal("hide"), $("#login").modal()) : "not_null" == o.status ? ($("#modal_alert .modal-body").html(o.messages), $("#modal_alert").appendTo("body").modal()) : ($("#modal_alert .modal-body").html(o.messages), $("#modal_alert").appendTo("body").modal())
                }
            }).fail(function() {
                $("#delete-icon").removeClass("fa-circle-o-notch fa-spin").addClass("fa-check"), $("#modal_alert .modal-body").html(fail_alert), $("#modal_alert").appendTo("body").modal()
            })
        }), $(document).on("click", ".newPost", function(e) {
            e.preventDefault();
            var a = $(this).attr("href");
            return $(window).width() > 768 ? ($("#modal_ajax_dn .modal-content").html("").addClass("preloader"), $("#modal_ajax_dn").modal({
                backdrop: "static",
                keyboard: !1
            }), void $.ajax({
                url: a,
                data: {
                    modal: !0
                },
                method: "POST",
                success: function(t) {
                    $("#modal_ajax_dn .modal-content").removeClass("preloader").html(t)
                }
            }).fail(function() {
                $("#modal_alert .modal-body").html(fail_alert),
                    $("#modal_alert").appendTo("body").modal()
            })) : (Pace.restart(), t ? (Pace.stop(), document.getElementById("confirm_link").setAttribute("href", a), $("#modal_confirm").modal()) : ($("*").modal("hide"), void $.get(a, function(t) {
                t.redirect ? window.location.href = t.url : (document.title = t.meta.title + " | " + siteName, $(".navbar").find("li.active").removeClass("active"), $(".navbar a[href='" + a + "']").parents().addClass("active"), window.history.pushState("string", t.meta.title + " | " + siteName, a), $(".pushTitle").text(t.meta.title), $("#page-content").html(t.html), $.isFunction($.fn.slimScroll) && $(window).width() > 768 && $("#slimScroll").length && $("#slimScroll").slimScroll({
                    height: "500px"
                }), $.isFunction($.fn.sticky) && $(window).width() > 768 && $(".sticky").length && $(".sticky").sticky(), $.isFunction($.fn.masonry) && $(window).width() > 768 && $(".grid").length && $(".grid").imagesLoaded(function() {
                    $(".grid").masonry({
                        itemSelector: ".grid-item"
                    })
                }))
            }).done(function() {
                $("html,body").animate({
                    scrollTop: 0
                }, "slow")
            }).fail(function() {
                $("#modal_alert .modal-body").html(fail_alert), $("#modal_alert").appendTo("body").modal()
            })))
        }), $(document).on("click", ".repost", function(t) {
            t.preventDefault(), $("#modal_ajax_sm .modal-body").addClass("preloader"), $("#modal_ajax_sm").modal(), $.ajax({
                url: $(this).attr("href"),
                success: function(t) {
                    try {
                        var e = $.parseJSON(t);
                        403 == e.status && ($(".modal").modal("hide"), $("#login").modal())
                    } catch (a) {
                        $("#modal_ajax_sm .modal-body").removeClass("preloader").html(t)
                    }
                }
            })
        }), $(document).on("submit", "#repostForm", function(t) {
            t.preventDefault();
            var a = $(this).attr("data-id");
            $(".error").remove(), $.post($(this).attr("action"), $(this).serialize(), function(t) {
                200 == t.status ? ($("#modal_ajax_sm").modal("hide"), $("#reposts-count" + a).text(t.count)) : 403 == t.status ? ($(".modal").modal("hide"), $("#login").modal()) : ($("#modal_alert .modal-body").html(t.messages), $("#modal_alert").appendTo("body").modal()), e = !1
            }, "json")
        }), $(document).on("click", ".datepicker", function() {
            $(this).datepicker({
                format: "dd/mm/yyyy",
                keyboardNavigation: !1,
                forceParse: !1,
                daysOfWeekDisabled: "5,6",
                autoclose: !0,
                todayHighlight: !0,
                startDate: new Date,
                endDate: "+1m"
            }).datepicker("show")
        }), $(document).on("click", ".payment-datepicker", function() {
            $(this).datepicker({
                format: "dd/mm/yyyy",
                keyboardNavigation: !1,
                forceParse: !1,
                daysOfWeekDisabled: "5,6",
                autoclose: !0,
                todayHighlight: !0,
                startDate: "-1w",
                endDate: "0d"
            }).datepicker("show")
        }), $(document).on("keydown", ".hitAction", function(t) {
            var e = $(this).val();
            13 != t.keyCode || t.shiftKey || ("" == e ? $(this).find(".error").remove().prepend('<div class="error"><div class="animated fadeIn alert alert-danger alert-dismissible" role="alert"><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>' + empty_alert + "</div></div>").slideDown() : ($(this).addClass("preloader").attr("readonly", !0), $(this).parent($("#addCommentForm")).submit()))
        }), $(".carousel").carousel({
            interval: 5e3
        }).on("slide.bs.carousel", function(t) {
            var e = $(t.relatedTarget).height();
            $(this).find(".active.item").parent().animate({
                height: e
            }, 200)
        }), window.location.hash && "#_=_" != window.location.hash && "#menu" != window.location.hash && "#menu-right" != window.location.hash) {
        var a = window.location.hash.substring(1);
        "addCommentForm" != a && $("#" + a).addClass("animated fadeIn bg-warning")
    }
}), $("body").on("click change propertychange keyup keydown paste cut", "textarea", function() {
    $(this).height(0).height(this.scrollHeight)
}), $(window).scroll(function() {
    $(".navbar").offset().top > 60 ? $(".navbar-fixed-top").addClass("top-nav-collapse") : $(".navbar-fixed-top").removeClass("top-nav-collapse")
}), $(document).ready(function() {
    $("body").tooltip({
        selector: "[data-push=tooltip]"
    }), $("body").popover({
        selector: "[data-push=popover]"
    }), $(".modal").on("hidden.bs.modal", function(t) {
        $(".modal:visible").length && $("body").addClass("modal-open")
    }), $(document).on("scroll", function() {
        $("body")[0].offsetTop < $(document).scrollTop() - $(".navbar-fixed-top").height() ? $(".navbar-fixed-top").css({
            opacity: .95
        }) : $(".navbar-fixed-top").css({
            opacity: 1
        })
    })
})