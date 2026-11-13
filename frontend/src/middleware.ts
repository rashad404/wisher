import {NextRequest,NextResponse} from 'next/server';
export function middleware(request:NextRequest) {
 const path=request.nextUrl.pathname;
 if(process.env.WISHER_PRODUCTION==='true'&&(path.startsWith('/az/concepts/')||/^\/concepts\/.*\.html$/i.test(path))) {
  return new NextResponse('Not found',{status:404,headers:{'X-Robots-Tag':'noindex','Content-Type':'text/plain'}});
 }
 if(path.startsWith('/user')||/\/auth\//.test(path)) {
  const response=NextResponse.next();response.headers.set('X-Robots-Tag','noindex, nofollow');return response;
 }
 return NextResponse.next();
}
export const config={matcher:['/az/concepts/:path*','/concepts/:path*','/user/:path*','/:locale/auth/:path*']};
