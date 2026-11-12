import {api} from './workspace';
let active:Promise<void>|null=null;
export function openKimlik(returnTo='/user'):Promise<void>{
 if(active)return active;
 if(!/^\/(?:user(?:\/[a-z]+)?|gifts(?:\/\d+)?)(?:\?[^#]*)?$/.test(returnTo))returnTo='/user';
 const popup=window.open('about:blank','wisher_kimlik',`popup=yes,width=460,height=640,left=${Math.max(0,window.screenX+(window.outerWidth-460)/2)},top=${Math.max(0,window.screenY+(window.outerHeight-640)/2)}`);
 if(!popup)return Promise.reject(new Error('Kimlik pəncərəsi açılmadı. Brauzerdə açılan pəncərələrə icazə verib yenidən yoxlayın.'));
 popup.document.title='Kimlik';popup.document.body.textContent='Kimlik açılır...';
 const task=new Promise<void>((resolve,reject)=>{
  const finish=(error?:string)=>{window.removeEventListener('message',message);clearInterval(poll);clearTimeout(timeout);popup.close();if(error)reject(new Error(error));else resolve()};
  const message=(event:MessageEvent)=>{
   if(event.origin!==location.origin||event.source!==popup)return;
   if(event.data?.type==='wisher:auth:success'){finish();location.assign(returnTo)}
   if(event.data?.type==='wisher:auth:error')finish('Daxil olmaq alınmadı. Yenidən yoxlayın.');
  };
  window.addEventListener('message',message);
  const poll=setInterval(()=>{if(popup.closed)finish('Daxil olma tamamlanmadı. Yenidən yoxlaya bilərsiniz.')},500);
  const timeout=setTimeout(()=>finish('Daxil olma vaxtı bitdi. Yenidən yoxlayın.'),600000);
  api('auth/kimlik/start','POST',{return_to:returnTo}).then(d=>{if(!popup.closed)popup.location.replace(d.url)}).catch(()=>finish('Kimlik açıla bilmədi. Bir az sonra yenidən yoxlayın.'));
 });
 active=task.finally(()=>{active=null});return active;
}
export async function completeKimlik(){
 const q=new URLSearchParams(location.search);
 try{
  if(q.get('error')||!q.get('code')||!q.get('state'))throw Error();
  const d=await api('auth/kimlik/callback','POST',{code:q.get('code'),state:q.get('state')});
  if(window.opener){window.opener.postMessage({type:'wisher:auth:success'},location.origin);window.close()}
  else location.replace(d.return_to||'/user');
 }catch{
  if(window.opener){window.opener.postMessage({type:'wisher:auth:error'},location.origin);window.close()}
  throw Error('Daxil olmaq alınmadı. Yenidən yoxlayın.');
 }
}
