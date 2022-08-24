import{S as te,i as le,s as se,e as p,a as R,b as C,c as T,d as a,f as H,g as d,m as D,l as oe,t as _,h as U,j as V,k as v,n as I,o as W,p as E,q as ie,r as ce,u as ue,v as G,w as ne,x as fe,y as me,z as he,A as de}from"./main.a48cb407.js";import{I as J}from"./InertiaLink.82fca93a.js";function X(n,t,l){const e=n.slice();return e[4]=t[l],e}function Y(n,t,l){const e=n.slice();return e[4]=t[l],e}function ge(n){let t=n[4].name+"",l;return{c(){l=ne(t)},m(e,r){H(e,l,r)},p:G,d(e){e&&I(l)}}}function Z(n){let t,l;return t=new J({props:{href:n[4].href,class:(n[1].url==n[4].href?"bg-gray-900 text-white":"text-gray-300 hover:bg-gray-700 hover:text-white")+" px-3 py-2 rounded-md text-md font-medium",$$slots:{default:[ge]},$$scope:{ctx:n}}}),{c(){T(t.$$.fragment)},m(e,r){D(t,e,r),l=!0},p(e,r){const i={};r&2&&(i.class=(e[1].url==e[4].href?"bg-gray-900 text-white":"text-gray-300 hover:bg-gray-700 hover:text-white")+" px-3 py-2 rounded-md text-md font-medium"),r&512&&(i.$$scope={dirty:r,ctx:e}),t.$set(i)},i(e){l||(_(t.$$.fragment,e),l=!0)},o(e){v(t.$$.fragment,e),l=!1},d(e){E(t,e)}}}function pe(n){let t,l;return{c(){t=p("img"),a(t,"class","h-10 w-10 rounded-full"),ue(t.src,l="/images/arcomm-placeholder.jpg")||a(t,"src",l),a(t,"alt","")},m(e,r){H(e,t,r)},p:G,d(e){e&&I(t)}}}function _e(n){let t=n[4].name+"",l;return{c(){l=ne(t)},m(e,r){H(e,l,r)},p:G,d(e){e&&I(l)}}}function ee(n){let t,l;return t=new J({props:{href:n[4].href,class:(n[1].url==n[4].href?"bg-gray-900 text-white":"text-gray-300 hover:bg-gray-700 hover:text-white")+" block px-3 py-2 rounded-md text-md font-medium",$$slots:{default:[_e]},$$scope:{ctx:n}}}),{c(){T(t.$$.fragment)},m(e,r){D(t,e,r),l=!0},p(e,r){const i={};r&2&&(i.class=(e[1].url==e[4].href?"bg-gray-900 text-white":"text-gray-300 hover:bg-gray-700 hover:text-white")+" block px-3 py-2 rounded-md text-md font-medium"),r&512&&(i.$$scope={dirty:r,ctx:e}),t.$set(i)},i(e){l||(_(t.$$.fragment,e),l=!0)},o(e){v(t.$$.fragment,e),l=!1},d(e){E(t,e)}}}function $e(n){let t,l,e,r,i,g,m,h,b,y,S,K,z,L,O,A,k,P,q,M,N,j,F,Q,w=n[2],u=[];for(let s=0;s<w.length;s+=1)u[s]=Z(Y(n,w,s));const re=s=>v(u[s],1,1,()=>{u[s]=null});k=new J({props:{href:"/hub/settings",$$slots:{default:[pe]},$$scope:{ctx:n}}});let x=n[2],f=[];for(let s=0;s<x.length;s+=1)f[s]=ee(X(n,x,s));const ae=s=>v(f[s],1,1,()=>{f[s]=null});return{c(){t=p("nav"),l=p("div"),e=p("div"),r=p("div"),i=p("button"),g=R("svg"),m=R("path"),b=C(),y=p("div"),S=p("div"),S.innerHTML='<img class="hidden sm:block h-8 w-auto" src="/images/logo.png" alt="Logo"/>',K=C(),z=p("div"),L=p("div");for(let s=0;s<u.length;s+=1)u[s].c();O=C(),A=p("div"),T(k.$$.fragment),P=C(),q=p("div"),M=p("div");for(let s=0;s<f.length;s+=1)f[s].c();a(m,"stroke-linecap","round"),a(m,"stroke-linejoin","round"),a(m,"d",h=n[0]?"M4 6h16M4 12h16M4 18h16":"M6 18L18 6M6 6l12 12"),a(g,"class","block h-6 w-6"),a(g,"xmlns","http://www.w3.org/2000/svg"),a(g,"fill","none"),a(g,"viewBox","0 0 24 24"),a(g,"stroke-width","2"),a(g,"stroke","currentColor"),a(g,"aria-hidden","true"),a(i,"type","button"),a(i,"class","inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white"),a(i,"aria-controls","mobile-menu"),a(i,"aria-expanded","false"),a(r,"class","absolute inset-y-0 left-0 flex items-center sm:hidden"),a(S,"class","flex-shrink-0 flex items-center"),a(L,"class","flex space-x-4"),a(z,"class","hidden sm:block sm:ml-6"),a(y,"class","flex-1 flex items-center justify-center sm:items-stretch sm:justify-start"),a(A,"class","block ml-6 justify-end"),a(e,"class","relative flex items-center justify-between h-16"),a(l,"class","px-2 sm:px-6 lg:px-8"),a(M,"class",N=(n[0]?"hidden":"")+" px-2 pt-2 pb-3 space-y-1"),a(q,"class","sm:hidden"),a(q,"id","mobile-menu"),a(t,"class","bg-gray-800")},m(s,c){H(s,t,c),d(t,l),d(l,e),d(e,r),d(r,i),d(i,g),d(g,m),d(e,b),d(e,y),d(y,S),d(y,K),d(y,z),d(z,L);for(let $=0;$<u.length;$+=1)u[$].m(L,null);d(e,O),d(e,A),D(k,A,null),d(t,P),d(t,q),d(q,M);for(let $=0;$<f.length;$+=1)f[$].m(M,null);j=!0,F||(Q=oe(i,"click",n[3]),F=!0)},p(s,[c]){if((!j||c&1&&h!==(h=s[0]?"M4 6h16M4 12h16M4 18h16":"M6 18L18 6M6 6l12 12"))&&a(m,"d",h),c&6){w=s[2];let o;for(o=0;o<w.length;o+=1){const B=Y(s,w,o);u[o]?(u[o].p(B,c),_(u[o],1)):(u[o]=Z(B),u[o].c(),_(u[o],1),u[o].m(L,null))}for(U(),o=w.length;o<u.length;o+=1)re(o);V()}const $={};if(c&512&&($.$$scope={dirty:c,ctx:s}),k.$set($),c&6){x=s[2];let o;for(o=0;o<x.length;o+=1){const B=X(s,x,o);f[o]?(f[o].p(B,c),_(f[o],1)):(f[o]=ee(B),f[o].c(),_(f[o],1),f[o].m(M,null))}for(U(),o=x.length;o<f.length;o+=1)ae(o);V()}(!j||c&1&&N!==(N=(s[0]?"hidden":"")+" px-2 pt-2 pb-3 space-y-1"))&&a(M,"class",N)},i(s){if(!j){for(let c=0;c<w.length;c+=1)_(u[c]);_(k.$$.fragment,s);for(let c=0;c<x.length;c+=1)_(f[c]);j=!0}},o(s){u=u.filter(Boolean);for(let c=0;c<u.length;c+=1)v(u[c]);v(k.$$.fragment,s),f=f.filter(Boolean);for(let c=0;c<f.length;c+=1)v(f[c]);j=!1},d(s){s&&I(t),W(u,s),E(k),W(f,s),F=!1,Q()}}}function ve(n,t,l){let e;ie(n,ce,m=>l(1,e=m));const r=[{name:"Home",href:"/",inert:!0},{name:"Missions",href:"/hub/missions",inert:!0}];let i=!1;return[i,e,r,()=>l(0,i=!i)]}class be extends te{constructor(t){super(),le(this,t,ve,$e,se,{})}}function ke(n){let t,l,e,r,i;l=new be({});const g=n[1].default,m=fe(g,n,n[0],null);return{c(){t=p("main"),T(l.$$.fragment),e=C(),r=p("article"),m&&m.c(),a(r,"class","m-10")},m(h,b){H(h,t,b),D(l,t,null),d(t,e),d(t,r),m&&m.m(r,null),i=!0},p(h,[b]){m&&m.p&&(!i||b&1)&&me(m,g,h,h[0],i?de(g,h[0],b,null):he(h[0]),null)},i(h){i||(_(l.$$.fragment,h),_(m,h),i=!0)},o(h){v(l.$$.fragment,h),v(m,h),i=!1},d(h){h&&I(t),E(l),m&&m.d(h)}}}function we(n,t,l){let{$$slots:e={},$$scope:r}=t;return n.$$set=i=>{"$$scope"in i&&l(0,r=i.$$scope)},[r,e]}class Me extends te{constructor(t){super(),le(this,t,we,ke,se,{})}}export{Me as default};