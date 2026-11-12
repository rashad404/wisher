import HomeOpening from '@/components/HomeOpening';
import Workspace from '@/components/Workspace';
import {notFound} from 'next/navigation';
export default async function Page({params}:{params:Promise<{slug?:string[]}>}) {const path='/'+((await params).slug||[]).join('/');if(!['/','/user','/user/wishes','/user/contacts','/user/occasions','/user/saved','/user/settings','/az/auth/kimlik/callback'].includes(path))notFound();return path==='/'?<HomeOpening/>:<Workspace path={path}/>}
