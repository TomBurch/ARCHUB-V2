import{S as F,i as K,s as P,e as p,a as se,b as L,d as f,f as S,g,l as E,w as W,n as B,o as G,v as T,J as R,K as I,L as U,c as Q,m as z,M as V,t as C,k as H,p as D,u as ie,N as ve,O as X,P as be,h as Z,j as ee,Q as xe,q as we}from"./main.07754558.js";import Me from"./Layout.d2ea9fc1.js";import{u as ye}from"./useForm.b18000cd.js";import"./InertiaLink.420e1732.js";function re(n,e,l){const t=n.slice();return t[6]=e[l],t}function oe(n,e,l){const t=n.slice();return t[6]=e[l],t}function ae(n){let e,l=n[6].name+"",t,s,a,o;function _(){return n[4](n[6])}return{c(){e=p("button"),t=T(l),f(e,"class",s=(n[0].name==n[6].name?"border-b-4 border-b-indigo-900 text-white":"text-gray-300 hover:bg-gray-700 hover:text-white")+" px-3 py-2 rounded-t-md text-md font-medium")},m(r,c){S(r,e,c),g(e,t),a||(o=E(e,"click",_),a=!0)},p(r,c){n=r,c&2&&l!==(l=n[6].name+"")&&R(t,l),c&3&&s!==(s=(n[0].name==n[6].name?"border-b-4 border-b-indigo-900 text-white":"text-gray-300 hover:bg-gray-700 hover:text-white")+" px-3 py-2 rounded-t-md text-md font-medium")&&f(e,"class",s)},d(r){r&&B(e),a=!1,o()}}}function ce(n){let e,l=n[6].name+"",t,s,a,o;function _(){return n[5](n[6])}return{c(){e=p("button"),t=T(l),f(e,"class",s=(n[0].name==n[6].name?"border-b-4 border-b-indigo-900 text-white":"text-gray-300 hover:bg-gray-700 hover:text-white")+" block px-3 py-2 rounded-t-md text-md font-medium w-full text-left")},m(r,c){S(r,e,c),g(e,t),a||(o=E(e,"click",_),a=!0)},p(r,c){n=r,c&2&&l!==(l=n[6].name+"")&&R(t,l),c&3&&s!==(s=(n[0].name==n[6].name?"border-b-4 border-b-indigo-900 text-white":"text-gray-300 hover:bg-gray-700 hover:text-white")+" block px-3 py-2 rounded-t-md text-md font-medium w-full text-left")&&f(e,"class",s)},d(r){r&&B(e),a=!1,o()}}}function je(n){let e,l,t,s,a,o,_,r,c,y,b,d,u,$,i,m,h,q,O=n[1],j=[];for(let x=0;x<O.length;x+=1)j[x]=ae(oe(n,O,x));let w=n[1],M=[];for(let x=0;x<w.length;x+=1)M[x]=ce(re(n,w,x));return{c(){e=p("nav"),l=p("div"),t=p("div"),s=p("div"),a=p("button"),o=se("svg"),_=se("path"),c=L(),y=p("div"),b=p("div"),d=p("div");for(let x=0;x<j.length;x+=1)j[x].c();u=L(),$=p("div"),i=p("div");for(let x=0;x<M.length;x+=1)M[x].c();f(_,"stroke-linecap","round"),f(_,"stroke-linejoin","round"),f(_,"d",r=n[2]?"M6 18L18 6M6 6l12 12":"M4 6h16M4 12h16M4 18h16"),f(o,"class","block h-6 w-6"),f(o,"xmlns","http://www.w3.org/2000/svg"),f(o,"fill","none"),f(o,"viewBox","0 0 24 24"),f(o,"stroke-width","2"),f(o,"stroke","currentColor"),f(o,"aria-hidden","true"),f(a,"type","button"),f(a,"class","inline-flex items-center justify-center p-2 rounded-md text-gray-400 hover:text-white hover:bg-gray-700 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-white"),f(a,"aria-controls","mobile-menu"),f(a,"aria-expanded","false"),f(s,"class","absolute inset-y-0 left-0 flex items-center sm:hidden"),f(d,"class","flex space-x-4"),f(b,"class","hidden sm:block sm:ml-6"),f(y,"class","flex-1 flex items-center justify-center sm:items-stretch sm:justify-start"),f(t,"class","relative flex items-center justify-between h-16"),f(l,"class","px-2 sm:px-6 lg:px-8"),f(i,"class",m=(n[2]?"":"hidden")+" px-2 pt-2 pb-3 space-y-1"),f($,"class","sm:hidden"),f($,"id","mobile-menu"),f(e,"class","bg-gray-900 rounded-lg")},m(x,A){S(x,e,A),g(e,l),g(l,t),g(t,s),g(s,a),g(a,o),g(o,_),g(t,c),g(t,y),g(y,b),g(b,d);for(let v=0;v<j.length;v+=1)j[v].m(d,null);g(e,u),g(e,$),g($,i);for(let v=0;v<M.length;v+=1)M[v].m(i,null);h||(q=E(a,"click",n[3]),h=!0)},p(x,[A]){if(A&4&&r!==(r=x[2]?"M6 18L18 6M6 6l12 12":"M4 6h16M4 12h16M4 18h16")&&f(_,"d",r),A&3){O=x[1];let v;for(v=0;v<O.length;v+=1){const N=oe(x,O,v);j[v]?j[v].p(N,A):(j[v]=ae(N),j[v].c(),j[v].m(d,null))}for(;v<j.length;v+=1)j[v].d(1);j.length=O.length}if(A&3){w=x[1];let v;for(v=0;v<w.length;v+=1){const N=re(x,w,v);M[v]?M[v].p(N,A):(M[v]=ce(N),M[v].c(),M[v].m(i,null))}for(;v<M.length;v+=1)M[v].d(1);M.length=w.length}A&4&&m!==(m=(x[2]?"":"hidden")+" px-2 pt-2 pb-3 space-y-1")&&f(i,"class",m)},i:W,o:W,d(x){x&&B(e),G(j,x),G(M,x),h=!1,q()}}}function Le(n,e,l){let{navigation:t}=e,{selected:s}=e,a=!1;const o=()=>l(2,a=!a),_=c=>l(0,s=c),r=c=>l(0,s=c);return n.$$set=c=>{"navigation"in c&&l(1,t=c.navigation),"selected"in c&&l(0,s=c.selected)},[s,t,a,o,_,r]}class ke extends F{constructor(e){super(),K(this,e,Le,je,P,{navigation:1,selected:0})}}function ue(n,e,l){const t=n.slice();return t[6]=e[l],t}function fe(n,e,l){const t=n.slice();return t[9]=e[l][0],t[10]=e[l][1],t}function me(n){let e,l,t=n[9]+"",s,a,o,_=n[10]+"";return{c(){e=p("div"),l=p("h5"),s=T(t),a=L(),o=p("p"),f(l,"class","pt-8 text-center text-gray-200 text-3xl text-bold tracking-wide"),f(o,"class","text-gray-200")},m(r,c){S(r,e,c),g(e,l),g(l,s),g(e,a),g(e,o),o.innerHTML=_},p(r,c){c&1&&t!==(t=r[9]+"")&&R(s,t),c&1&&_!==(_=r[10]+"")&&(o.innerHTML=_)},d(r){r&&B(e)}}}function de(n){let e,l,t,s=Object.entries(n[6].content[3]),a=[];for(let o=0;o<s.length;o+=1)a[o]=me(fe(n,s,o));return{c(){e=p("div");for(let o=0;o<a.length;o+=1)a[o].c();l=L(),f(e,"class",t=n[1]==n[6]?"hidden":"")},m(o,_){S(o,e,_);for(let r=0;r<a.length;r+=1)a[r].m(e,null);g(e,l)},p(o,_){if(_&1){s=Object.entries(o[6].content[3]);let r;for(r=0;r<s.length;r+=1){const c=fe(o,s,r);a[r]?a[r].p(c,_):(a[r]=me(c),a[r].c(),a[r].m(e,l))}for(;r<a.length;r+=1)a[r].d(1);a.length=s.length}_&3&&t!==(t=o[1]==o[6]?"hidden":"")&&f(e,"class",t)},d(o){o&&B(e),G(a,o)}}}function Se(n){let e,l,t,s,a,o;function _(d){n[3](d)}function r(d){n[4](d)}let c={};n[0]!==void 0&&(c.navigation=n[0]),n[1]!==void 0&&(c.selected=n[1]),l=new ke({props:c}),I.push(()=>U(l,"navigation",_)),I.push(()=>U(l,"selected",r));let y=n[0],b=[];for(let d=0;d<y.length;d+=1)b[d]=de(ue(n,y,d));return{c(){e=p("div"),Q(l.$$.fragment),a=L();for(let d=0;d<b.length;d+=1)b[d].c()},m(d,u){S(d,e,u),z(l,e,null),g(e,a);for(let $=0;$<b.length;$+=1)b[$].m(e,null);o=!0},p(d,[u]){const $={};if(!t&&u&1&&(t=!0,$.navigation=d[0],V(()=>t=!1)),!s&&u&2&&(s=!0,$.selected=d[1],V(()=>s=!1)),l.$set($),u&3){y=d[0];let i;for(i=0;i<y.length;i+=1){const m=ue(d,y,i);b[i]?b[i].p(m,u):(b[i]=de(m),b[i].c(),b[i].m(e,null))}for(;i<b.length;i+=1)b[i].d(1);b.length=y.length}},i(d){o||(C(l.$$.fragment,d),o=!0)},o(d){H(l.$$.fragment,d),o=!1},d(d){d&&B(e),D(l),G(b,d)}}}function Be(n,e,l){let{mission:t}=e,s=JSON.parse(t.briefings),a=[];s.forEach(function(c){a.push({name:c[0],content:c})});let o=a[0];function _(c){a=c,l(0,a)}function r(c){o=c,l(1,o)}return n.$$set=c=>{"mission"in c&&l(2,t=c.mission)},[a,o,t,_,r]}class Ne extends F{constructor(e){super(),K(this,e,Be,Se,P,{mission:2})}}function qe(n){let e,l,t,s,a,o,_,r=n[0].user.username+"",c,y,b,d=n[0].text+"",u,$,i;return{c(){e=p("div"),l=p("img"),s=L(),a=p("div"),o=p("div"),_=p("div"),c=T(r),y=L(),b=p("div"),u=T(d),$=L(),i=p("div"),i.textContent="14 w",f(l,"class","rounded-full h-8 w-8 mr-2 mt-1 "),ie(l.src,t=n[0].user.avatar)||f(l,"src",t),f(l,"alt",""),f(_,"class","font-semibold text-sm leading-relaxed"),f(b,"class","text-normal leading-snug md:leading-normal"),f(o,"class","bg-gray-700 rounded-3xl px-4 py-2"),f(i,"class","text-sm ml-4 mt-0.5 text-gray-400"),f(e,"class","text-gray-200 py-4 flex")},m(m,h){S(m,e,h),g(e,l),g(e,s),g(e,a),g(a,o),g(o,_),g(_,c),g(o,y),g(o,b),g(b,u),g(a,$),g(a,i)},p(m,[h]){h&1&&!ie(l.src,t=m[0].user.avatar)&&f(l,"src",t),h&1&&r!==(r=m[0].user.username+"")&&R(c,r),h&1&&d!==(d=m[0].text+"")&&R(u,d)},i:W,o:W,d(m){m&&B(e)}}}function Ce(n,e,l){let{comment:t}=e;return n.$$set=s=>{"comment"in s&&l(0,t=s.comment)},[t]}class $e extends F{constructor(e){super(),K(this,e,Ce,qe,P,{comment:0})}}function ge(n,e,l){const t=n.slice();return t[5]=e[l],t}function he(n){let e,l;return e=new $e({props:{comment:n[5]}}),{c(){Q(e.$$.fragment)},m(t,s){z(e,t,s),l=!0},p(t,s){const a={};s&1&&(a.comment=t[5]),e.$set(a)},i(t){l||(C(e.$$.fragment,t),l=!0)},o(t){H(e.$$.fragment,t),l=!1},d(t){D(e,t)}}}function Ae(n){let e,l,t,s,a,o,_,r,c,y,b,d=n[0].comments.reverse(),u=[];for(let i=0;i<d.length;i+=1)u[i]=he(ge(n,d,i));const $=i=>H(u[i],1,1,()=>{u[i]=null});return{c(){e=p("form"),l=p("div"),t=p("div"),s=p("textarea"),a=L(),o=p("div"),o.innerHTML='<button type="submit" class="inline-flex items-center py-2.5 px-4 text-xs text-white font-medium rounded-lg bg-blue-700 hover:bg-blue-800">Submit</button>',_=L();for(let i=0;i<u.length;i+=1)u[i].c();r=ve(),f(s,"rows","4"),f(s,"class","px-0 w-full text-sm text-white border-0 bg-gray-800 focus:ring-0 placeholder-gray-400"),f(s,"placeholder","Write a comment..."),s.required=!0,f(t,"class","py-2 px-4 rounded-t-lg bg-gray-800"),f(o,"class","flex justify-between items-center py-2 px-3 border-t border-gray-600"),f(l,"class","mb-4 w-full rounded-lg bg-gray-700 border border-gray-600")},m(i,m){S(i,e,m),g(e,l),g(l,t),g(t,s),X(s,n[1].text),g(l,a),g(l,o),S(i,_,m);for(let h=0;h<u.length;h+=1)u[h].m(i,m);S(i,r,m),c=!0,y||(b=[E(s,"input",n[4]),E(e,"submit",be(n[3]))],y=!0)},p(i,[m]){if(m&2&&X(s,i[1].text),m&1){d=i[0].comments.reverse();let h;for(h=0;h<d.length;h+=1){const q=ge(i,d,h);u[h]?(u[h].p(q,m),C(u[h],1)):(u[h]=he(q),u[h].c(),C(u[h],1),u[h].m(r.parentNode,r))}for(Z(),h=d.length;h<u.length;h+=1)$(h);ee()}},i(i){if(!c){for(let m=0;m<d.length;m+=1)C(u[m]);c=!0}},o(i){u=u.filter(Boolean);for(let m=0;m<u.length;m+=1)H(u[m]);c=!1},d(i){i&&B(e),i&&B(_),G(u,i),i&&B(r),y=!1,xe(b)}}}function He(n,e,l){let t,{mission:s}=e,a=ye({text:null});we(n,a,r=>l(1,t=r));function o(){t.post(`/hub/missions/${s.id}/comments`,{onSuccess:()=>t.reset()})}function _(){t.text=this.value,a.set(t)}return n.$$set=r=>{"mission"in r&&l(0,s=r.mission)},[s,t,a,o,_]}class Oe extends F{constructor(e){super(),K(this,e,He,Ae,P,{mission:0})}}function _e(n,e,l){const t=n.slice();return t[5]=e[l],t}function pe(n){let e,l;return e=new $e({props:{comment:n[5]}}),{c(){Q(e.$$.fragment)},m(t,s){z(e,t,s),l=!0},p(t,s){const a={};s&1&&(a.comment=t[5]),e.$set(a)},i(t){l||(C(e.$$.fragment,t),l=!0)},o(t){H(e.$$.fragment,t),l=!1},d(t){D(e,t)}}}function Te(n){let e,l,t,s,a,o,_,r,c,y,b,d=n[0].notes.reverse(),u=[];for(let i=0;i<d.length;i+=1)u[i]=pe(_e(n,d,i));const $=i=>H(u[i],1,1,()=>{u[i]=null});return{c(){e=p("form"),l=p("div"),t=p("div"),s=p("textarea"),a=L(),o=p("div"),o.innerHTML='<button type="submit" class="inline-flex items-center py-2.5 px-4 text-xs text-white font-medium rounded-lg bg-blue-700 hover:bg-blue-800">Submit</button>',_=L();for(let i=0;i<u.length;i+=1)u[i].c();r=ve(),f(s,"rows","4"),f(s,"class","px-0 w-full text-sm text-white border-0 bg-gray-800 focus:ring-0 placeholder-gray-400"),f(s,"placeholder","Write a comment..."),s.required=!0,f(t,"class","py-2 px-4 rounded-t-lg bg-gray-800"),f(o,"class","flex justify-between items-center py-2 px-3 border-t border-gray-600"),f(l,"class","mb-4 w-full rounded-lg bg-gray-700 border border-gray-600")},m(i,m){S(i,e,m),g(e,l),g(l,t),g(t,s),X(s,n[1].text),g(l,a),g(l,o),S(i,_,m);for(let h=0;h<u.length;h+=1)u[h].m(i,m);S(i,r,m),c=!0,y||(b=[E(s,"input",n[4]),E(e,"submit",be(n[3]))],y=!0)},p(i,[m]){if(m&2&&X(s,i[1].text),m&1){d=i[0].notes.reverse();let h;for(h=0;h<d.length;h+=1){const q=_e(i,d,h);u[h]?(u[h].p(q,m),C(u[h],1)):(u[h]=pe(q),u[h].c(),C(u[h],1),u[h].m(r.parentNode,r))}for(Z(),h=d.length;h<u.length;h+=1)$(h);ee()}},i(i){if(!c){for(let m=0;m<d.length;m+=1)C(u[m]);c=!0}},o(i){u=u.filter(Boolean);for(let m=0;m<u.length;m+=1)H(u[m]);c=!1},d(i){i&&B(e),i&&B(_),G(u,i),i&&B(r),y=!1,xe(b)}}}function Je(n,e,l){let t,{mission:s}=e,a=ye({text:null});we(n,a,r=>l(1,t=r));function o(){t.post(`/hub/missions/${s.id}/notes`,{onSuccess:()=>t.reset()})}function _(){t.text=this.value,a.set(t)}return n.$$set=r=>{"mission"in r&&l(0,s=r.mission)},[s,t,a,o,_]}class Re extends F{constructor(e){super(),K(this,e,Je,Te,P,{mission:0})}}function We(n){let e;return{c(){e=p("p"),e.textContent="Media"},m(l,t){S(l,e,t)},p:W,i:W,o:W,d(l){l&&B(e)}}}class Ee extends F{constructor(e){super(),K(this,e,null,We,P,{})}}function Fe(n){let e,l,t=n[0].display_name+"",s,a,o,_,r=n[0].user.username+"",c,y,b,d=n[0].summary+"",u,$,i,m,h,q,O,j,w,M;function x(k){n[3](k)}function A(k){n[4](k)}let v={};n[1]!==void 0&&(v.navigation=n[1]),n[2]!==void 0&&(v.selected=n[2]),m=new ke({props:v}),I.push(()=>U(m,"navigation",x)),I.push(()=>U(m,"selected",A));var N=n[2].component;function te(k){return{props:{mission:k[0]}}}return N&&(w=new N(te(n))),{c(){e=p("div"),l=p("h5"),s=T(t),a=L(),o=p("p"),_=T("By "),c=T(r),y=L(),b=p("p"),u=T(d),$=L(),i=p("div"),Q(m.$$.fragment),O=L(),j=p("div"),w&&Q(w.$$.fragment),f(l,"class","truncate text-center text-3xl font-bold text-white tracking-tight"),f(o,"class","truncate text-center text-sm font-bold text-gray-300"),f(b,"class","pt-2 truncate text-center text-sm font-normal text-gray-300"),f(j,"class","my-5 mx-20"),f(i,"class","pt-5"),f(e,"class","min-h-screen-no-nav lg:w-4/5 mx-auto p-3 shadow-md border border-gray-700 bg-gray-800")},m(k,J){S(k,e,J),g(e,l),g(l,s),g(e,a),g(e,o),g(o,_),g(o,c),g(e,y),g(e,b),g(b,u),g(e,$),g(e,i),z(m,i,null),g(i,O),g(i,j),w&&z(w,j,null),M=!0},p(k,[J]){(!M||J&1)&&t!==(t=k[0].display_name+"")&&R(s,t),(!M||J&1)&&r!==(r=k[0].user.username+"")&&R(c,r),(!M||J&1)&&d!==(d=k[0].summary+"")&&R(u,d);const Y={};!h&&J&2&&(h=!0,Y.navigation=k[1],V(()=>h=!1)),!q&&J&4&&(q=!0,Y.selected=k[2],V(()=>q=!1)),m.$set(Y);const ne={};if(J&1&&(ne.mission=k[0]),N!==(N=k[2].component)){if(w){Z();const le=w;H(le.$$.fragment,1,0,()=>{D(le,1)}),ee()}N?(w=new N(te(k)),Q(w.$$.fragment),C(w.$$.fragment,1),z(w,j,null)):w=null}else N&&w.$set(ne)},i(k){M||(C(m.$$.fragment,k),w&&C(w.$$.fragment,k),M=!0)},o(k){H(m.$$.fragment,k),w&&H(w.$$.fragment,k),M=!1},d(k){k&&B(e),D(m),w&&D(w)}}}const Ge=Me;function Ke(n,e,l){let{mission:t}=e,s=[{name:"Briefing",component:Ne},{name:"AARs",component:Oe},{name:"Notes",component:Re},{name:"Media",component:Ee}],a=s[0];function o(r){s=r,l(1,s)}function _(r){a=r,l(2,a)}return n.$$set=r=>{"mission"in r&&l(0,t=r.mission)},[t,s,a,o,_]}class Ie extends F{constructor(e){super(),K(this,e,Ke,Fe,P,{mission:0})}}export{Ie as default,Ge as layout};