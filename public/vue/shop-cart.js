!function(t){var e={};function n(r){if(e[r])return e[r].exports;var o=e[r]={i:r,l:!1,exports:{}};return t[r].call(o.exports,o,o.exports,n),o.l=!0,o.exports}n.m=t,n.c=e,n.d=function(t,e,r){n.o(t,e)||Object.defineProperty(t,e,{enumerable:!0,get:r})},n.r=function(t){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(t,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(t,"__esModule",{value:!0})},n.t=function(t,e){if(1&e&&(t=n(t)),8&e)return t;if(4&e&&"object"==typeof t&&t&&t.__esModule)return t;var r=Object.create(null);if(n.r(r),Object.defineProperty(r,"default",{enumerable:!0,value:t}),2&e&&"string"!=typeof t)for(var o in t)n.d(r,o,function(e){return t[e]}.bind(null,o));return r},n.n=function(t){var e=t&&t.__esModule?function(){return t.default}:function(){return t};return n.d(e,"a",e),e},n.o=function(t,e){return Object.prototype.hasOwnProperty.call(t,e)},n.p="/",n(n.s=0)}([function(t,e,n){t.exports=n(1)},function(t,e,n){Vue.component("shop-cart",n(2).default)},function(t,e,n){"use strict";n.r(e);var r=function(t,e,n,r,o,i,a,s){var c,u="function"==typeof t?t.options:t;if(e&&(u.render=e,u.staticRenderFns=n,u._compiled=!0),r&&(u.functional=!0),i&&(u._scopeId="data-v-"+i),a?(c=function(t){(t=t||this.$vnode&&this.$vnode.ssrContext||this.parent&&this.parent.$vnode&&this.parent.$vnode.ssrContext)||"undefined"==typeof __VUE_SSR_CONTEXT__||(t=__VUE_SSR_CONTEXT__),o&&o.call(this,t),t&&t._registeredComponents&&t._registeredComponents.add(a)},u._ssrRegister=c):o&&(c=s?function(){o.call(this,this.$root.$options.shadowRoot)}:o),c)if(u.functional){u._injectStyles=c;var f=u.render;u.render=function(t,e){return c.call(e),f(t,e)}}else{var l=u.beforeCreate;u.beforeCreate=l?[].concat(l,c):[c]}return{exports:t,options:u}}({name:"ShopCart",data:function(){return{cart:[]}},created:function(){var t=this;window.addEventListener("storage",(function(){t.updateCart()})),this.updateCart()},computed:{cartCount:function(){return this.cart.reduce((function(t,e){return t+e.quantity}),0)}},methods:{push:function(t){var e=arguments.length>1&&void 0!==arguments[1]?arguments[1]:1;if(t.Id){var n=this.cart.find((function(e){return e.id==t.Id}));n?n.quantity+=e:this.cart.push({id:t.Id,seo:t.Seo,quantity:e}),localStorage.setItem("cardItem",JSON.stringify(this.cart))}},updateCart:function(){this.cart=JSON.parse(localStorage.getItem("cardItem"))||[]},onClick:function(){console.log("clicked"),this.$emit("click",this.cart)}}},(function(){var t=this.$createElement,e=this._self._c||t;return e("div",{staticStyle:{cursor:"pointer"},on:{click:this.onClick}},[this._m(0),this._v(" "),e("span",{staticClass:"quntity"},[this._v(this._s(this.cartCount))])])}),[function(){var t=this.$createElement,e=this._self._c||t;return e("span",[e("i",{staticClass:"fa fa-shopping-cart",attrs:{"aria-hidden":"true"}})])}],!1,null,null,null);e.default=r.exports}]);