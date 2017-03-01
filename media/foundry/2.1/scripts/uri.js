dispatch.to("Foundry/2.1 Core Plugins").at(function(e,t){e.isUrl=function(e){var t=/^(http|https):\/\/(\w+:{0,1}\w*@)?(\S+)(:[0-9]+)?(\/|\/([\w#!:.?+=&%@!\-\/]))?/;return t.test(e)};var n=function(e){"use strict";var t=function(e){var t=[],n,r,i,s,o,u;if(typeof e=="undefined"||e===null||e==="")return t;e.indexOf("?")===0&&(e=e.substring(1)),r=(e+"").split(/[&;]/);for(n=0;n<r.length;n++)i=r[n],s=i.split("="),o=s[0],u=i.indexOf("=")===-1?null:s[1]===null?"":s[1],t.push([o,u]);return t},n=t(e),r=function(){var e="",t,r;for(t=0;t<n.length;t++)r=n[t],e.length>0&&(e+="&"),r[1]===null?e+=r[0]:e+=r.join("=");return e.length>0?"?"+e:e},i=function(e){return e=decodeURIComponent(e),e=e.replace("+"," "),e},s=function(e){var t,r;for(r=0;r<n.length;r++){t=n[r];if(i(e)===i(t[0]))return t[1]}},o=function(e){var t=[],r,s;for(r=0;r<n.length;r++)s=n[r],i(e)===i(s[0])&&t.push(s[1]);return t},u=function(e,t){var r=[],s,o,u,a;for(s=0;s<n.length;s++)o=n[s],u=i(o[0])===i(e),a=i(o[1])===i(t),(arguments.length===1&&!u||arguments.length===2&&!u&&!a)&&r.push(o);return n=r,this},a=function(e,t,r){return arguments.length===3&&r!==-1?(r=Math.min(r,n.length),n.splice(r,0,[e,t])):arguments.length>0&&n.push([e,t]),this},f=function(e,t,r){var s=-1,o,f;if(arguments.length===3){for(o=0;o<n.length;o++){f=n[o];if(i(f[0])===i(e)&&decodeURIComponent(f[1])===i(r)){s=o;break}}u(e,r).addParam(e,t,s)}else{for(o=0;o<n.length;o++){f=n[o];if(i(f[0])===i(e)){s=o;break}}u(e),a(e,t,s)}return this};return{getParamValue:s,getParamValues:o,deleteParam:u,addParam:a,replaceParam:f,toString:r}},r=function(e){"use strict";var t=!1,i=function(e){var n={strict:/^(?:([^:\/?#]+):)?(?:\/\/((?:(([^:@]*)(?::([^:@]*))?)?@)?([^:\/?#]*)(?::(\d*))?))?((((?:[^?#\/]*\/)*)([^?#]*))(?:\?([^#]*))?(?:#(.*))?)/,loose:/^(?:(?![^:@]+:[^:@\/]*@)([^:\/?#.]+):)?(?:\/\/)?((?:(([^:@]*)(?::([^:@]*))?)?@)?([^:\/?#]*)(?::(\d*))?)(((\/(?:[^?#](?![^?#\/]*\.[^?#\/.]+(?:[?#]|$)))*\/?)?([^?#\/]*))(?:\?([^#]*))?(?:#(.*))?)/},r=["source","protocol","authority","userInfo","user","password","host","port","relative","path","directory","file","query","anchor"],i={name:"queryKey",parser:/(?:^|&)([^&=]*)=?([^&]*)/g},s=n[t?"strict":"loose"].exec(e),o={},u=14;while(u--)o[r[u]]=s[u]||"";return o[i.name]={},o[r[12]].replace(i.parser,function(e,t,n){t&&(o[i.name][t]=n)}),o},s=i(e||""),o=new n(s.query),u=function(e){return typeof e!="undefined"&&(s.protocol=e),s.protocol},a=null,f=function(e){return typeof e!="undefined"&&(a=e),a===null?s.source.indexOf("//")!==-1:a},l=function(e){return typeof e!="undefined"&&(s.userInfo=e),s.userInfo},c=function(e){return typeof e!="undefined"&&(s.host=e),s.host},h=function(e){return typeof e!="undefined"&&(s.port=e),s.port},p=function(e){return typeof e!="undefined"&&(s.path=e),s.path},d=function(e){return typeof e!="undefined"&&(o=new n(e)),o},v=function(e){return typeof e!="undefined"&&(s.anchor=e),s.anchor},m=function(e){return u(e),this},g=function(e){return f(e),this},y=function(e){return l(e),this},b=function(e){return c(e),this},w=function(e){return h(e),this},E=function(e){return p(e),this},S=function(e){return d(e),this},x=function(e){return v(e),this},T=function(e){return d().getParamValue(e)},N=function(e){return d().getParamValues(e)},C=function(e,t){return arguments.length===2?d().deleteParam(e,t):d().deleteParam(e),this},k=function(e,t,n){return arguments.length===3?d().addParam(e,t,n):d().addParam(e,t),this},L=function(e,t,n){return arguments.length===3?d().replaceParam(e,t,n):d().replaceParam(e,t),this},A=function(e){if(e===undefined)return s.path;if(e.substring(0,1)=="/")return s.path=e;var t=s.path.split("/"),n=e.split("/");t.slice(-1)[0]===""&&t.pop();var r;while(r=n.shift())switch(r){case"..":t.length>1&&t.pop();break;case".":break;default:t.push(r)}return s.path=t.join("/"),this},O=function(){var e="",t=function(e){return e!==null&&e!==""};return t(u())?(e+=u(),u().indexOf(":")!==u().length-1&&(e+=":"),e+="//"):f()&&t(c())&&(e+="//"),t(l())&&t(c())&&(e+=l(),l().indexOf("@")!==l().length-1&&(e+="@")),t(c())&&(e+=c(),t(h())&&(e+=":"+h())),t(p())?e+=p():t(c())&&(t(d()+"")||t(v()))&&(e+="/"),t(d()+"")&&((d()+"").indexOf("?")!==0&&(e+="?"),e+=d()+""),t(v())&&(v().indexOf("#")!==0&&(e+="#"),e+=v()),e},M=function(){return new r(O())};return{protocol:u,hasAuthorityPrefix:f,userInfo:l,host:c,port:h,path:p,query:d,anchor:v,setProtocol:m,setHasAuthorityPrefix:g,setUserInfo:y,setHost:b,setPort:w,setPath:E,setQuery:S,setAnchor:x,getQueryParamValue:T,getQueryParamValues:N,deleteQueryParam:C,addQueryParam:k,replaceQueryParam:L,toPath:A,toString:O,clone:M}};e.uri=function(e){return new r(e)}});