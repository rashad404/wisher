import {NextRequest, NextResponse} from 'next/server';
import {cookies} from 'next/headers';
import {randomBytes, createHash} from 'node:crypto';
export const dynamic='force-dynamic';
const base=process.env.API_URL || 'http://127.0.0.1:8022';
const options={httpOnly:true,secure:process.env.COOKIE_SECURE==='true',sameSite:'lax' as const,path:'/'};
async function proxy(req:NextRequest,{params}:{params:Promise<{path:string[]}>}) {
 const path=(await params).path.join('/');
 if(!/^(catalog(?:\/\d+)?|wishlist(?:\/\d+)?|company(?:\/(?:people|campaigns)(?:\/\d+)?)?|reminders(?:\/\d+)?|calendar|config|dashboard|settings|contacts(?:\/\d+)?|occasions(?:\/\d+)?|wishes(?:\/(?:generate|\d+))?|auth\/(?:me|logout|demo|kimlik\/(?:start|callback)))$/.test(path)) return NextResponse.json({error:'not_found'},{status:404});
 const origins=(process.env.SITE_ORIGINS||'http://localhost:3022').split(',');
 const origin=req.headers.get('origin');
 if(req.method!=='GET' && (!origin || !origins.includes(origin))) return NextResponse.json({error:'origin'},{status:403});
 if(Number(req.headers.get('content-length')||0)>16000) return NextResponse.json({error:'too_large'},{status:413});
 const jar=await cookies();let body:Record<string,unknown>|undefined;
 try {if(req.method!=='GET') { const raw=await req.text();if(raw.length>16000)throw Error();body=raw?JSON.parse(raw):{}; }} catch {return NextResponse.json({error:'invalid'},{status:422});}
 let oauth:Record<string,string>|undefined;
 if(path==='auth/kimlik/start') {
  if(!process.env.KIMLIK_CLIENT_ID) return NextResponse.json({error:'kimlik_unconfigured'},{status:503});
  const verifier=randomBytes(32).toString('base64url'),state=randomBytes(32).toString('base64url');
  const redirect=origin+'/az/auth/kimlik/callback';const requested=String(body?.return_to||'/user');
  const return_to=/^\/(?:user(?:\/[a-z]+)?|gifts(?:\/\d+)?)(?:\?[^#]*)?$/.test(requested)?requested:'/user';
  oauth={verifier,state,redirect,return_to};
  body={state,code_challenge:createHash('sha256').update(verifier).digest('base64url'),redirect_uri:redirect};
 }
 if(path==='auth/kimlik/callback') {
  try {oauth=JSON.parse(jar.get('wisher-oauth')?.value||'');} catch {return NextResponse.json({error:'expired'},{status:422});}
  if(!oauth || body?.state!==oauth.state) return NextResponse.json({error:'state'},{status:422});
  body={code:body?.code,state:oauth.state,code_verifier:oauth.verifier,redirect_uri:oauth.redirect,transaction:oauth.transaction};
 }
 try {
  const token=jar.get('wisher-session')?.value;
  const upstream=await fetch(`${base}/api/${path}${req.nextUrl.search}`,{method:req.method,headers:{Accept:'application/json','Content-Type':'application/json',...(token?{Authorization:`Bearer ${token}`}:{})},body:body?JSON.stringify(body):undefined,cache:'no-store',signal:AbortSignal.timeout(30000)});
  const data=upstream.status===204?{}:await upstream.json();
  const safe:Record<string,unknown>=upstream.ok?Object.fromEntries(Object.entries(data).filter(([k])=>!['token','transaction'].includes(k))):{error:upstream.status===429?'limit':(data.error||'request_failed'),...(upstream.status===422?{errors:data.errors}:{})};
  if(upstream.ok&&path==='auth/kimlik/callback'&&oauth)safe.return_to=oauth.return_to||'/user';
  const response=NextResponse.json(safe,{status:upstream.status===204?200:upstream.status,headers:{'Cache-Control':'private, no-store'}});
  if(upstream.ok && path==='auth/kimlik/start' && oauth) {
   response.cookies.set('wisher-oauth',JSON.stringify({...oauth,transaction:data.transaction}),{...options,maxAge:600});
   const query=new URLSearchParams({client_id:process.env.KIMLIK_CLIENT_ID!,redirect_uri:oauth.redirect,state:oauth.state,response_type:'code',scope:'profile:name profile:email verification:read',code_challenge:String(body?.code_challenge),code_challenge_method:'S256'});
   const out=NextResponse.json({url:`${process.env.KIMLIK_URL||'https://kimlik.az'}/az/oauth/authorize?${query}`});out.cookies.set('wisher-oauth',JSON.stringify({...oauth,transaction:data.transaction}),{...options,maxAge:600});return out;
  }
  if(upstream.ok && ['auth/demo','auth/kimlik/callback'].includes(path))response.cookies.set('wisher-session',data.token,{...options,maxAge:path==='auth/demo'?86400:2592000});
  if(path==='auth/kimlik/callback')response.cookies.set('wisher-oauth','',{...options,maxAge:0});
  if(path==='auth/logout')response.cookies.set('wisher-session','',{...options,maxAge:0});
  return response;
 } catch { return NextResponse.json({error:'unavailable'},{status:503}); }
}
export {proxy as GET,proxy as POST,proxy as PUT,proxy as DELETE};
