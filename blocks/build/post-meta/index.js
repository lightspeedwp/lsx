!function(){"use strict";var e=window.wp.blocks,t=window.wp.element,s=window.wp.components,o=window.wp.blockEditor,r=window.wp.data,n=window.wp.coreData,i=JSON.parse('{"u2":"lsx/lsx-post-meta-basic"}');(0,e.registerBlockType)(i.u2,{example:{attributes:{message:"LSX Post Meta"}},edit:function(e){let{attributes:i,setAttributes:a}=e;const c=(0,o.useBlockProps)(),p=(0,r.useSelect)((e=>e("core/editor").getCurrentPostType()),[]),[l,u]=(0,n.useEntityProp)("postType",p,"meta");let w=i.message;return void 0!==l.price&&(w=l.price),(0,t.createElement)("div",c,(0,t.createElement)(s.TextControl,{value:w,onChange:e=>{u({...l,price:e}),a({message:e})}}))},save:function(e){let{attributes:s}=e;const r=o.useBlockProps.save();return(0,t.createElement)("div",r,s.message)}})}();