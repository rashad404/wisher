import type {MetadataRoute} from 'next';
export default function manifest():MetadataRoute.Manifest {
 return {name:'Wisher.az',short_name:'Wisher',description:'Hədiyyə fikirləri, şəxsi təbriklər və özəl günlərin xatırlatması.',start_url:'/',display:'standalone',background_color:'#ffffff',theme_color:'#a3122f',lang:'az',icons:[{src:'/icon-192.png',sizes:'192x192',type:'image/png'},{src:'/icon-512.png',sizes:'512x512',type:'image/png'},{src:'/icon.svg',sizes:'any',type:'image/svg+xml'}]};
}
