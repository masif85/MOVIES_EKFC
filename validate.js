(() => {
    "use strict";
    const e = writer;
    let t = 0;
    const n = function (e, t) {
            const n = Number.isFinite(e),
                a = Number.isFinite(t);
            return n && a ? (n) => n >= e && n <= t : n && !1 === a ? (t) => t >= e : !1 === n && a ? (e) => e <= t : void 0;
        },
        a = function (e, t) {
            return e
                .map((e) => {
                    const { message: a = null, minCount: r = null, maxCount: o = null } = e,
                        s = i(e, t);
                    return null === s || (null === r && null === o) ? null : { isValid: n(r, o), message: null !== a ? a : l(e), selector: s, ...e };
                })
                .filter((e) => null !== e);
        },
        i = function (e, t) {
            if (e.type) return t.map((t) => `${t} [type="${e.type}"]`).join(", ");
            if (e.tag && e.data) {
                const n = Object.keys(e.data).map((t) => `[${t}="${e.data[t]}"]`);
                return t.map((t) => `${t} ${e.tag}${n.join("")}`).join(", ");
            }
            return console.warn('WARNING: im-articlevalidation plugin contains an invalid rule, missing either "type"-, "data"/"tag"-, or "minCount" or "maxCount"properties. This rule will be ignored.', e), null;
        },
        l = function (t) {
            const { minCount: n = null, maxCount: a = null, type: i, data: l, tag: r, message: o } = t;
            let s = "";
            return (
                Number.isFinite(n) ? (s = `(${n}${Number.isFinite(a) ? `- ${a}` : ""})`) : Number.isFinite(a) && (s = `(max ${a})`),
                i
                    ? `${e.api.getLabel("Element of type")} ${i} ${e.api.getLabel("is missing")} ${s}`
                    : l && r
                    ? `${e.api.getLabel("Element")} ${r} ${e.api.getLabel("and")} ${Object.keys(l)
                          .map((e) => `${e}: ${l[e]}`)
                          .join(", ")} ${e.api.getLabel("is missing")} ${s}`
                    : o
            );
        };
    function r(t, n) {
        return class extends e.Validator {
            constructor(e) {
                var t, n, a;
                super(e), (a = void 0), (n = "newsItemArticle") in (t = this) ? Object.defineProperty(t, n, { value: a, enumerable: !0, configurable: !0, writable: !0 }) : (t[n] = a);
            }
            static get name() {
                return t;
            }
            validate() {
                var e;
				var asif;
                const t = null === (e = this.newsItem.querySelector("itemMeta > pubStatus[qcode]")) || void 0 === e ? void 0 : e.getAttribute("qcode");
				const z = null === (asif = this.newsItem.querySelector("contentMeta > links > link:last-child[title]")) || void 0 === asif ? void 0 : asif.getAttribute("title");			
				
                null !== t
                    ? n.forEach((e) => {
                          const { mandatoryFor: n = [], appliesTo: a = [], ignoredFor: i = [], message: l } = e;
                          if (i.includes(t) || z=='No') return;
                          const r = this.newsItem.querySelectorAll(e.selector),
                              o = 0 === a.length || a.includes(t) || n.includes(t),
                              s = n.includes(t);
                          o && !1 === e.isValid(r.length) && (s ? this.addError(l) : this.addWarning(l));
                      })
                    : console.warn("im-articlevalidation: Article status not found!");
            }
        };
    }
    const o = {
        name: "im-articlevalidation",
        id: "io.infomaker.articlevalidation",
        configure(e, n) {
            var i;
            n.data.meta && e.addValidator(((i = n.data.meta), t++, r(`custom-meta-validator-${t}`, a(i, ["contentMeta", "itemMeta"])))),
                n.data.content &&
                    e.addValidator(
                        (function (e) {
                            return t++, r(`custom-content-validator-${t}`, a(e, ['contentSet idf > group[type="body"]']));
                        })(n.data.content)
                    ),
                e.addLabel("Element of type", { sv: "Element av typen" }),
                e.addLabel("Element", { sv: "Element" }),
                e.addLabel("and", { sv: "och" }),
                e.addLabel("is missing", { sv: "saknas" });
        },
    };
    e.registerPlugin ? (0, e.registerPlugin)(o) : console.error("Register method not yet available");
})();
//# sourceMappingURL=index.js.map
