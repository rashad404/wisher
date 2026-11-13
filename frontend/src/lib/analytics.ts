// Local funnel events; no external analytics script is installed by this change.
export function track(name:string, details:Record<string,string>={}) {
 const event={event:'wisher_action',action:name,...details};
 window.dispatchEvent(new CustomEvent('wisher:analytics',{detail:event}));
 const w=window as Window & {dataLayer?:unknown[]};(w.dataLayer??=[]).push(event);
}
export function trackClick(target:HTMLElement){const el=target.closest('a,button');if(el)track(el.tagName==='A'?'navigate':'button',{label:(el.getAttribute('aria-label')||el.textContent||'').trim().slice(0,100),path:el.getAttribute('href')?.split('?')[0]||location.pathname})}
