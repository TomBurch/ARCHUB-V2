import{S as $,i as L,s as M,c as C,m as H,t as S,k as T,p as Y,e as r,b as u,d as l,f as D,g as t,w as N,n as q}from"./main.37253da5.js";import z from"./Layout.c585f3c5.js";import"./InertiaLink.cbe299fa.js";function A(x){let e,s,a,o,n,w,d,g,v,p,i,c,b,k,f,h,m;return{c(){e=r("form"),s=r("div"),s.innerHTML=`<div class="w-full md:w-1/2 px-3 mb-6 md:mb-0"><label class="block uppercase tracking-wide text-gray-200 text-xs font-bold mb-2" for="grid-name">Your name</label> 
                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-red-500 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white" id="grid-name" type="text"/> 
                <p class="text-red-500 text-xs italic">Please fill out this field.</p></div> 
            <div class="w-full md:w-1/2 px-3"><label class="block uppercase tracking-wide text-gray-200 text-xs font-bold mb-2" for="grid-age">Your age</label> 
                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-age" type="text"/></div>`,a=u(),o=r("div"),n=r("div"),n.innerHTML=`<label class="block uppercase tracking-wide text-gray-200 text-xs font-bold mb-2" for="grid-location">Location</label> 
                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-location"/> 
                <p class="text-gray-400 text-xs italic">Make it as long and as crazy as you&#39;d like</p>`,w=u(),d=r("div"),g=r("label"),g.textContent="Are you available for weekly operations?",v=u(),p=r("div"),i=r("select"),c=r("option"),c.textContent="No",b=r("option"),b.textContent="Yes",k=u(),f=r("div"),f.innerHTML=`<div class="w-full md:w-1/2 px-3 mb-6 md:mb-0"><label class="block uppercase tracking-wide text-gray-200 text-xs font-bold mb-2" for="grid-discord">Discord account</label> 
                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-discord" type="text"/></div> 
            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0"><label class="block uppercase tracking-wide text-gray-200 text-xs font-bold mb-2" for="grid-steam">Steam account</label> 
                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-steam" type="text"/></div>`,h=u(),m=r("div"),m.innerHTML=`<div class="w-full md:w-1/2 px-3 mb-6 md:mb-0"><label class="block uppercase tracking-wide text-gray-200 text-xs font-bold mb-2" for="grid-discord">Discord account</label> 
                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-discord" type="text"/></div> 
            <div class="w-full md:w-1/2 px-3 mb-6 md:mb-0"><label class="block uppercase tracking-wide text-gray-200 text-xs font-bold mb-2" for="grid-steam">Steam account</label> 
                <input class="appearance-none block w-full bg-gray-200 text-gray-700 border border-gray-200 rounded py-3 px-4 mb-3 leading-tight focus:outline-none focus:bg-white focus:border-gray-500" id="grid-steam" type="text"/></div>`,l(s,"class","flex flex-wrap -mx-3 mb-6"),l(n,"class","w-full md:w-1/2 px-3 mb-6 md:mb-0"),l(g,"class","block uppercase tracking-wide text-gray-200 text-xs font-bold mb-2"),l(g,"for","grid-weekly"),c.__value="No",c.value=c.__value,b.__value="Yes",b.value=b.__value,l(i,"class","block appearance-none w-full bg-gray-200 border border-gray-200 text-gray-700 py-3 px-4 pr-8 rounded leading-tight focus:outline-none focus:bg-white focus:border-gray-500"),l(i,"id","grid-weekly"),l(p,"class","relative"),l(d,"class","w-full md:w-1/2 px-3 mb-6 md:mb-0"),l(o,"class","flex flex-wrap -mx-3 mb-6"),l(f,"class","flex flex-wrap -mx-3 mb-6"),l(m,"class","flex flex-wrap -mx-3 mb-6"),l(e,"class","h-screen-no-nav p-3 border border-gray-200 shadow-md bg-gray-800 border-gray-700")},m(y,_){D(y,e,_),t(e,s),t(e,a),t(e,o),t(o,n),t(o,w),t(o,d),t(d,g),t(d,v),t(d,p),t(p,i),t(i,c),t(i,b),t(e,k),t(e,f),t(e,h),t(e,m)},p:N,d(y){y&&q(e)}}}function J(x){let e,s;return e=new z({props:{$$slots:{default:[A]},$$scope:{ctx:x}}}),{c(){C(e.$$.fragment)},m(a,o){H(e,a,o),s=!0},p(a,[o]){const n={};o&1&&(n.$$scope={dirty:o,ctx:a}),e.$set(n)},i(a){s||(S(e.$$.fragment,a),s=!0)},o(a){T(e.$$.fragment,a),s=!1},d(a){Y(e,a)}}}class E extends ${constructor(e){super(),L(this,e,null,J,M,{})}}export{E as default};