!function(){"use strict";var e,t={136:function(e,t,r){function n(e){return n="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(e){return typeof e}:function(e){return e&&"function"==typeof Symbol&&e.constructor===Symbol&&e!==Symbol.prototype?"symbol":typeof e},n(e)}function a(e,t,r){return(t=function(e){var t=function(e){if("object"!=n(e)||!e)return e;var t=e[Symbol.toPrimitive];if(void 0!==t){var r=t.call(e,"string");if("object"!=n(r))return r;throw new TypeError("@@toPrimitive must return a primitive value.")}return String(e)}(e);return"symbol"==n(t)?t:t+""}(t))in e?Object.defineProperty(e,t,{value:r,enumerable:!0,configurable:!0,writable:!0}):e[t]=r,e}function o(e,t){(null==t||t>e.length)&&(t=e.length);for(var r=0,n=Array(t);r<t;r++)n[r]=e[r];return n}function s(e,t){return function(e){if(Array.isArray(e))return e}(e)||function(e,t){var r=null==e?null:"undefined"!=typeof Symbol&&e[Symbol.iterator]||e["@@iterator"];if(null!=r){var n,a,o,s,i=[],l=!0,c=!1;try{if(o=(r=r.call(e)).next,0===t){if(Object(r)!==r)return;l=!1}else for(;!(l=(n=o.call(r)).done)&&(i.push(n.value),i.length!==t);l=!0);}catch(e){c=!0,a=e}finally{try{if(!l&&null!=r.return&&(s=r.return(),Object(s)!==s))return}finally{if(c)throw a}}return i}}(e,t)||function(e,t){if(e){if("string"==typeof e)return o(e,t);var r={}.toString.call(e).slice(8,-1);return"Object"===r&&e.constructor&&(r=e.constructor.name),"Map"===r||"Set"===r?Array.from(e):"Arguments"===r||/^(?:Ui|I)nt(?:8|16|32)(?:Clamped)?Array$/.test(r)?o(e,t):void 0}}(e,t)||function(){throw new TypeError("Invalid attempt to destructure non-iterable instance.\nIn order to be iterable, non-array objects must have a [Symbol.iterator]() method.")}()}var i=window.React,l=window.wp.element;function c(e,t){void 0!==l.createRoot?(0,l.createRoot)(t).render(e):(0,l.render)(e,t)}var u=window.wp.i18n,p=window.wp.components,m=window.wp.hooks,d={siteIdentity:{title:(0,u.__)("Site Identity","generatepress"),description:(0,u.__)("Set options like your site title, description, logo, logo width, and more.","generatepress"),icon:(0,i.createElement)("svg",{xmlns:"http://www.w3.org/2000/svg",width:"24",height:"24",fill:"none",stroke:"currentColor",strokeWidth:"2",strokeLinecap:"round",strokeLinejoin:"round"},(0,i.createElement)("circle",{cx:"12",cy:"12",r:"3"}),(0,i.createElement)("path",{d:"M19.4 15a1.65 1.65 0 00.33 1.82l.06.06a2 2 0 010 2.83 2 2 0 01-2.83 0l-.06-.06a1.65 1.65 0 00-1.82-.33 1.65 1.65 0 00-1 1.51V21a2 2 0 01-2 2 2 2 0 01-2-2v-.09A1.65 1.65 0 009 19.4a1.65 1.65 0 00-1.82.33l-.06.06a2 2 0 01-2.83 0 2 2 0 010-2.83l.06-.06a1.65 1.65 0 00.33-1.82 1.65 1.65 0 00-1.51-1H3a2 2 0 01-2-2 2 2 0 012-2h.09A1.65 1.65 0 004.6 9a1.65 1.65 0 00-.33-1.82l-.06-.06a2 2 0 010-2.83 2 2 0 012.83 0l.06.06a1.65 1.65 0 001.82.33H9a1.65 1.65 0 001-1.51V3a2 2 0 012-2 2 2 0 012 2v.09a1.65 1.65 0 001 1.51 1.65 1.65 0 001.82-.33l.06-.06a2 2 0 012.83 0 2 2 0 010 2.83l-.06.06a1.65 1.65 0 00-.33 1.82V9a1.65 1.65 0 001.51 1H21a2 2 0 012 2 2 2 0 01-2 2h-.09a1.65 1.65 0 00-1.51 1z"})),action:{url:generateDashboard.customizeSectionUrls.siteIdentitySection}},colors:{title:(0,u.__)("Color Options","generatepress"),description:(0,u.__)("Set up your global colors and stylize your site to match your brand.","generatepress"),icon:(0,i.createElement)("svg",{xmlns:"http://www.w3.org/2000/svg",width:"24",height:"24",fill:"none",stroke:"currentColor",strokeWidth:"2",strokeLinecap:"round",strokeLinejoin:"round"},(0,i.createElement)("path",{d:"M12 2.69l5.66 5.66a8 8 0 11-11.31 0z"})),action:{url:generateDashboard.customizeSectionUrls.colorsSection}},typography:{title:(0,u.__)("Typography System","generatepress"),description:(0,u.__)("Set up your site typography by using our dynamic typography system.","generatepress"),icon:(0,i.createElement)("svg",{viewBox:"0 0 16 16",fill:"currentColor",height:"16",width:"16",xmlns:"http://www.w3.org/2000/svg"},(0,i.createElement)("path",{d:"m2.244 13.081.943-2.803H6.66l.944 2.803H8.86L5.54 3.75H4.322L1 13.081h1.244zm2.7-7.923L6.34 9.314H3.51l1.4-4.156h.034zm9.146 7.027h.035v.896h1.128V8.125c0-1.51-1.114-2.345-2.646-2.345-1.736 0-2.59.916-2.666 2.174h1.108c.068-.718.595-1.19 1.517-1.19.971 0 1.518.52 1.518 1.464v.731H12.19c-1.647.007-2.522.8-2.522 2.058 0 1.319.957 2.18 2.345 2.18 1.06 0 1.716-.43 2.078-1.011zm-1.763.035c-.752 0-1.456-.397-1.456-1.244 0-.65.424-1.115 1.408-1.115h1.805v.834c0 .896-.752 1.525-1.757 1.525z"})),action:{url:generateDashboard.customizeSectionUrls.typographySection}},layout:{title:(0,u.__)("Layout Options","generatepress"),description:(0,u.__)("Set up the layout of your overall site elements.","generatepress"),icon:(0,i.createElement)("svg",{xmlns:"http://www.w3.org/2000/svg",width:"24",height:"24",fill:"none",stroke:"currentColor",strokeWidth:"2",strokeLinecap:"round",strokeLinejoin:"round"},(0,i.createElement)("path",{d:"M12 3h7a2 2 0 012 2v14a2 2 0 01-2 2h-7m0-18H5a2 2 0 00-2 2v14a2 2 0 002 2h7m0-18v18"})),action:{url:generateDashboard.customizeSectionUrls.layoutSection}}};function g(e,t){var r=Object.keys(e);if(Object.getOwnPropertySymbols){var n=Object.getOwnPropertySymbols(e);t&&(n=n.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),r.push.apply(r,n)}return r}var h=function(){var e=s((0,l.useState)(!1),2),t=e[0],r=e[1];if((0,l.useEffect)((function(){t||r(!0)})),!t)return(0,i.createElement)(p.Placeholder,{className:"generatepress-dashboard__placeholder"},(0,i.createElement)(p.Spinner,null));var n=(0,m.applyFilters)("generate_dashboard_customize_items",d);return(0,i.createElement)(i.Fragment,null,!!n>0&&(0,i.createElement)(i.Fragment,null,(0,i.createElement)("div",{className:"generatepress-dashboard__section-title"},(0,i.createElement)("h2",null,(0,u.__)("Start Customizing","generatepress"))),(0,i.createElement)("div",{className:"generatepress-dashboard__section"},Object.keys(n).map((function(e,t){return(0,i.createElement)("div",{className:"generatepress-dashboard__section-item",key:t},(0,i.createElement)("div",{className:"generatepress-dashboard__section-item-content"},!!n[e].title&&(0,i.createElement)("div",{className:"generatepress-dashboard__section-item-title"},n[e].title),!!n[e].description&&(0,i.createElement)("div",{className:"generatepress-dashboard__section-item-description"},n[e].description)),(0,i.createElement)("div",{className:"generatepress-dashboard__section-item-action"},(0,m.applyFilters)("generate_dashboard_customize_item_action",function(e){var t={className:"components-button is-primary",href:n[e].action.url,target:n[e].action.external?"_blank":null,rel:n[e].action.external?"noreferrer noopener":null};return(0,i.createElement)(i.Fragment,null,!!n[e].action&&(0,i.createElement)("a",function(e){for(var t=1;t<arguments.length;t++){var r=null!=arguments[t]?arguments[t]:{};t%2?g(Object(r),!0).forEach((function(t){a(e,t,r[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(r)):g(Object(r)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(r,t))}))}return e}({},t),n[e].action.label||(0,u.__)("Open options","generatepress")))}(e),n[e])))})),(0,m.applyFilters)("generate_dashboard_inside_start_customizing"))))};window.addEventListener("DOMContentLoaded",(function(){c((0,i.createElement)(h,null),document.getElementById("generatepress-dashboard-app"))}));var f={themeBuilder:{title:(0,u.__)("Theme Builder","generatepress"),description:(0,u.__)("Design and build your theme elements in the block editor.","generatepress"),icon:(0,i.createElement)("svg",{xmlns:"http://www.w3.org/2000/svg",fill:"none",stroke:"currentColor",strokeWidth:"2",strokeLinecap:"round",strokeLinejoin:"round",viewBox:"0 0 24 24"},(0,i.createElement)("path",{d:"M3 3h7v7H3zM14 3h7v7h-7zM14 14h7v7h-7zM3 14h7v7H3z"})),action:{label:(0,u.__)("Explore our theme builder","generatepress"),url:"https://generatepress.com/premium#theme-builder",external:!0}},siteLibrary:{title:(0,u.__)("Site Library","generatepress"),description:(0,u.__)("Start your site with a professionally-built starter site.","generatepress"),icon:(0,i.createElement)("svg",{xmlns:"http://www.w3.org/2000/svg",fill:"none",stroke:"currentColor",strokeWidth:"2",strokeLinecap:"round",strokeLinejoin:"round",viewBox:"0 0 24 24"},(0,i.createElement)("path",{d:"M2 3h6a4 4 0 014 4v14a3 3 0 00-3-3H2zM22 3h-6a4 4 0 00-4 4v14a3 3 0 013-3h7z"})),action:{label:(0,u.__)("Explore starter sites","generatepress"),url:"https://generatepress.com/premium#site-library",external:!0}},moreOptions:{title:(0,u.__)("More Options","generatepress"),description:(0,u.__)("Add more options like our advanced hook system, mobile header, sticky navigation, infinite scroll, masonry and much more.","generatepress"),icon:(0,i.createElement)("svg",{xmlns:"http://www.w3.org/2000/svg",fill:"none",stroke:"currentColor",strokeWidth:"2",strokeLinecap:"round",strokeLinejoin:"round",viewBox:"0 0 24 24"},(0,i.createElement)("path",{d:"M4 21v-7M4 10V3M12 21v-9M12 8V3M20 21v-5M20 12V3M1 14h6M9 8h6M17 16h6"})),action:{label:(0,u.__)("Explore more options","generatepress"),url:"https://generatepress.com/premium",external:!0}},support:{title:(0,u.__)("Premium Support","generatepress"),description:(0,u.__)("We take support seriously. Gain access to our premium support forums and take advantage of our industry-leading support.","generatepress"),icon:(0,i.createElement)("svg",{xmlns:"http://www.w3.org/2000/svg",fill:"none",stroke:"currentColor",strokeWidth:"2",strokeLinecap:"round",strokeLinejoin:"round",viewBox:"0 0 24 24"},(0,i.createElement)("circle",{cx:"12",cy:"12",r:"10"}),(0,i.createElement)("circle",{cx:"12",cy:"12",r:"4"}),(0,i.createElement)("path",{d:"M4.93 4.93l4.24 4.24M14.83 14.83l4.24 4.24M14.83 9.17l4.24-4.24M14.83 9.17l3.53-3.53M4.93 19.07l4.24-4.24"})),action:{label:(0,u.__)("Explore our support forums","generatepress"),url:"https://generatepress.com/support",external:!0}}};function _(e,t){var r=Object.keys(e);if(Object.getOwnPropertySymbols){var n=Object.getOwnPropertySymbols(e);t&&(n=n.filter((function(t){return Object.getOwnPropertyDescriptor(e,t).enumerable}))),r.push.apply(r,n)}return r}var b=function(){var e=s((0,l.useState)(!1),2),t=e[0],r=e[1];return(0,l.useEffect)((function(){t||r(!0)})),generateDashboard.hasPremium?null:t?(0,i.createElement)(i.Fragment,null,!!f>0&&(0,i.createElement)(i.Fragment,null,(0,i.createElement)("div",{className:"generatepress-dashboard__section-title"},(0,i.createElement)("h2",null,(0,u.__)("GeneratePress Premium","generatepress"))),(0,i.createElement)("div",{className:"generatepress-dashboard__section-description"},(0,i.createElement)("p",null,(0,u.__)("Take GeneratePress to the next level with more options, professionally designed starter sites, and block-based theme building.","generatepress"))),(0,i.createElement)("div",{className:"generatepress-dashboard__section generatepress-dashboard__premium"},Object.keys(f).map((function(e,t){var r={className:"components-button is-primary",href:f[e].action.url,target:f[e].action.external?"_blank":null,rel:f[e].action.external?"noreferrer noopener":null};return(0,i.createElement)("div",{className:"generatepress-dashboard__premium-item",key:t},(0,i.createElement)("div",{className:"generatepress-dashboard__premium-item-content"},!!f[e].icon&&(0,i.createElement)("div",{className:"generatepress-dashboard__premium-item-icon"},f[e].icon),!!f[e].title&&(0,i.createElement)("div",{className:"generatepress-dashboard__premium-item-title"},f[e].title),!!f[e].description&&(0,i.createElement)("div",{className:"generatepress-dashboard__premium-item-description"},f[e].description)),(0,i.createElement)("div",{className:"generatepress-dashboard__premium-item-action"},!!f[e].action&&(0,i.createElement)("a",function(e){for(var t=1;t<arguments.length;t++){var r=null!=arguments[t]?arguments[t]:{};t%2?_(Object(r),!0).forEach((function(t){a(e,t,r[t])})):Object.getOwnPropertyDescriptors?Object.defineProperties(e,Object.getOwnPropertyDescriptors(r)):_(Object(r)).forEach((function(t){Object.defineProperty(e,t,Object.getOwnPropertyDescriptor(r,t))}))}return e}({},r),f[e].action.label||(0,u.__)("Open options","generatepress"))))}))))):(0,i.createElement)(p.Placeholder,{className:"generatepress-dashboard__placeholder"},(0,i.createElement)(p.Spinner,null))};window.addEventListener("DOMContentLoaded",(function(){c((0,i.createElement)(b,null),document.getElementById("generatepress-dashboard-go-pro"))}));var v=window.wp.apiFetch,y=r.n(v),w=function(){var e=s((0,l.useState)(!1),2),t=e[0],r=e[1],a=s((0,l.useState)(!1),2),o=a[0],c=a[1];return(0,l.useEffect)((function(){t||r(!0)})),generateDashboard.hasPremium?null:t?(0,i.createElement)(i.Fragment,null,(0,i.createElement)("div",{className:"generatepress-dashboard__section"},(0,i.createElement)("div",{className:"generatepress-dashboard__section-title",style:{marginBottom:0}},(0,i.createElement)("h2",null,(0,u.__)("Reset","generatepress"))),(0,i.createElement)("div",{className:"generatepress-dashboard__section-item-description",style:{marginTop:0}},(0,u.__)("Reset your customizer settings.","generatepress")),(0,i.createElement)(p.Button,{className:"generatepress-dashboard__reset-button",style:{marginTop:"10px"},disabled:!!o,isPrimary:!0,onClick:function(e){window.confirm((0,u.__)("This will delete all of your customizer settings. It cannot be undone.","generatepress"))&&function(e){c(!0);var t=e.target.nextElementSibling;y()({path:"/generatepress/v1/reset",method:"POST",data:{}}).then((function(e){c(!1),t.classList.add("generatepress-dashboard__section-item-message__show"),"object"===n(e.response)?t.textContent=(0,u.__)("Settings reset.","generatepress"):t.textContent=e.response,e.success&&e.response?setTimeout((function(){t.classList.remove("generatepress-dashboard__section-item-message__show")}),3e3):t.classList.add("generatepress-dashboard__section-item-message__error")}))}(e)}},!!o&&(0,i.createElement)(p.Spinner,null),!o&&(0,u.__)("Reset","generatepress")),(0,i.createElement)("span",{className:"generatepress-dashboard__section-item-message",style:{marginLeft:"10px"}}))):(0,i.createElement)(p.Placeholder,{className:"generatepress-dashboard__placeholder"},(0,i.createElement)(p.Spinner,null))};window.addEventListener("DOMContentLoaded",(function(){c((0,i.createElement)(w,null),document.getElementById("generatepress-reset"))}))}},r={};function n(e){var a=r[e];if(void 0!==a)return a.exports;var o=r[e]={exports:{}};return t[e](o,o.exports,n),o.exports}n.m=t,e=[],n.O=function(t,r,a,o){if(!r){var s=1/0;for(u=0;u<e.length;u++){r=e[u][0],a=e[u][1],o=e[u][2];for(var i=!0,l=0;l<r.length;l++)(!1&o||s>=o)&&Object.keys(n.O).every((function(e){return n.O[e](r[l])}))?r.splice(l--,1):(i=!1,o<s&&(s=o));if(i){e.splice(u--,1);var c=a();void 0!==c&&(t=c)}}return t}o=o||0;for(var u=e.length;u>0&&e[u-1][2]>o;u--)e[u]=e[u-1];e[u]=[r,a,o]},n.n=function(e){var t=e&&e.__esModule?function(){return e.default}:function(){return e};return n.d(t,{a:t}),t},n.d=function(e,t){for(var r in t)n.o(t,r)&&!n.o(e,r)&&Object.defineProperty(e,r,{enumerable:!0,get:t[r]})},n.o=function(e,t){return Object.prototype.hasOwnProperty.call(e,t)},function(){var e={945:0,458:0};n.O.j=function(t){return 0===e[t]};var t=function(t,r){var a,o,s=r[0],i=r[1],l=r[2],c=0;if(s.some((function(t){return 0!==e[t]}))){for(a in i)n.o(i,a)&&(n.m[a]=i[a]);if(l)var u=l(n)}for(t&&t(r);c<s.length;c++)o=s[c],n.o(e,o)&&e[o]&&e[o][0](),e[o]=0;return n.O(u)},r=self.webpackChunkgeneratepress=self.webpackChunkgeneratepress||[];r.forEach(t.bind(null,0)),r.push=t.bind(null,r.push.bind(r))}();var a=n.O(void 0,[458],(function(){return n(136)}));a=n.O(a)}();