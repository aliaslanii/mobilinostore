!function(e){var l={};function i(r){if(l[r])return l[r].exports;var t=l[r]={i:r,l:!1,exports:{}};return e[r].call(t.exports,t,t.exports,i),t.l=!0,t.exports}i.m=e,i.c=l,i.d=function(e,l,r){i.o(e,l)||Object.defineProperty(e,l,{enumerable:!0,get:r})},i.r=function(e){"undefined"!=typeof Symbol&&Symbol.toStringTag&&Object.defineProperty(e,Symbol.toStringTag,{value:"Module"}),Object.defineProperty(e,"__esModule",{value:!0})},i.t=function(e,l){if(1&l&&(e=i(e)),8&l)return e;if(4&l&&"object"==typeof e&&e&&e.__esModule)return e;var r=Object.create(null);if(i.r(r),Object.defineProperty(r,"default",{enumerable:!0,value:e}),2&l&&"string"!=typeof e)for(var t in e)i.d(r,t,function(l){return e[l]}.bind(null,t));return r},i.n=function(e){var l=e&&e.__esModule?function(){return e.default}:function(){return e};return i.d(l,"a",l),l},i.o=function(e,l){return Object.prototype.hasOwnProperty.call(e,l)},i.p="/",i(i.s=61)}({61:function(e,l,i){e.exports=i(62)},62:function(e,l){$((function(){"use strict";var e=Quill.import("ui/icons");e.bold='<i class="la la-bold" aria-hidden="true"></i>',e.italic='<i class="la la-italic" aria-hidden="true"></i>',e.underline='<i class="la la-underline" aria-hidden="true"></i>',e.strike='<i class="la la-strikethrough" aria-hidden="true"></i>',e.list.ordered='<i class="la la-list-ol" aria-hidden="true"></i>',e.list.bullet='<i class="la la-list-ul" aria-hidden="true"></i>',e.link='<i class="la la-link" aria-hidden="true"></i>',e.image='<i class="la la-image" aria-hidden="true"></i>',e.video='<i class="la la-film" aria-hidden="true"></i>',e["code-block"]='<i class="la la-code" aria-hidden="true"></i>';var l=[[{header:[1,2,3,4,5,6,!1]}],["bold","italic","underline","strike"],[{list:"ordered"},{list:"bullet"}],["link","image","video"]];new Quill("#quillEditor",{modules:{toolbar:l},theme:"snow"}),new Quill("#quillEditorModal2",{modules:{toolbar:l},theme:"snow"}),new Quill("#quillInline",{modules:{toolbar:[["bold","italic","underline"],[{header:1},{header:2},"blockquote"],["link","image","code-block"]]},bounds:"#quillInline",scrollingContainer:"#scrolling-container",placeholder:"Write something...",theme:"bubble"});new PerfectScrollbar("#scrolling-container",{suppressScrollX:!0}),$("#summernote").summernote({placeholder:"سلام دنیا",tabsize:3,height:300})}))}});