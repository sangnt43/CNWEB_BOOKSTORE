!function(t){var e={};function n(r){if(e[r])return e[r].exports;var o=e[r]={i:r,l:!1,exports:{}};return t[r].call(o.exports,o,o.exports,n),o.l=!0,o.exports}n.m=t,n.c=e,n.d=function(t,e,r){n.o(t,e)||Object.defineProperty(t,e,{enumerable:!0,get:r})},n.r=function(t){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(t,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(t,"__esModule",{value:!0})},n.t=function(t,e){if(1&e&&(t=n(t)),8&e)return t;if(4&e&&"object"==typeof t&&t&&t.__esModule)return t;var r=Object.create(null);if(n.r(r),Object.defineProperty(r,"default",{enumerable:!0,value:t}),2&e&&"string"!=typeof t)for(var o in t)n.d(r,o,function(e){return t[e]}.bind(null,o));return r},n.n=function(t){var e=t&&t.__esModule?function(){return t.default}:function(){return t};return n.d(e,"a",e),e},n.o=function(t,e){return Object.prototype.hasOwnProperty.call(t,e)},n.p="/",n(n.s=7)}({0:function(t,e,n){"use strict";function r(t,e,n,r,o,i,a,u){var s,c="function"==typeof t?t.options:t;if(e&&(c.render=e,c.staticRenderFns=n,c._compiled=!0),r&&(c.functional=!0),i&&(c._scopeId="data-v-"+i),a?(s=function(t){(t=t||this.$vnode&&this.$vnode.ssrContext||this.parent&&this.parent.$vnode&&this.parent.$vnode.ssrContext)||"undefined"==typeof __VUE_SSR_CONTEXT__||(t=__VUE_SSR_CONTEXT__),o&&o.call(this,t),t&&t._registeredComponents&&t._registeredComponents.add(a)},c._ssrRegister=s):o&&(s=u?function(){o.call(this,this.$root.$options.shadowRoot)}:o),s)if(c.functional){c._injectStyles=s;var f=c.render;c.render=function(t,e){return s.call(e),f(t,e)}}else{var d=c.beforeCreate;c.beforeCreate=d?[].concat(d,s):[s]}return{exports:t,options:c}}n.d(e,"a",(function(){return r}))},12:function(t,e,n){"use strict";n.r(e);var r={name:"ShopCart",data:function(){return{cart:[]}},created:function(){var t=this;window.addEventListener("storage",(function(){t.updateCart()})),this.updateCart()},computed:{cartCount:function(){return this.cart.reduce((function(t,e){return t+e.quantity}),0)}},methods:{push:function(t){var e=arguments.length>1&&void 0!==arguments[1]?arguments[1]:1;if(t.id){var n=this.cart.find((function(e){return e.id==t.id}));n?n.quantity+=e:this.cart.push({id:t.id,seo:t.seo,quantity:e}),localStorage.setItem("cardItem",JSON.stringify(this.cart))}},updateCart:function(){this.cart=JSON.parse(localStorage.getItem("cardItem"))||[]}}},o=n(0),i=Object(o.a)(r,(function(){var t=this.$createElement,e=this._self._c||t;return e("div",{staticStyle:{cursor:"pointer"}},[this._m(0),this._v(" "),e("span",{staticClass:"quntity"},[this._v(this._s(this.cartCount))])])}),[function(){var t=this.$createElement,e=this._self._c||t;return e("span",[e("i",{staticClass:"fa fa-shopping-cart",attrs:{"aria-hidden":"true"}})])}],!1,null,null,null);e.default=i.exports},7:function(t,e,n){t.exports=n(8)},8:function(t,e,n){Vue.component("shop-cart",n(12).default)}});