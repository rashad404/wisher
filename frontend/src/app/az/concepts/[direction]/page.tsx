import {notFound} from 'next/navigation';
import Concept from '../Concept';
export default async function Page({params}:{params:Promise<{direction:string}>}) {
  const {direction}=await params;
  if(direction!=='a' && direction!=='b' && direction!=='c') notFound();
  return <Concept direction={direction}/>;
}
