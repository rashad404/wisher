from pathlib import Path
from fontTools.ttLib import TTFont
from fontTools.varLib.instancer import instantiateVariableFont
from fontTools.pens.svgPathPen import SVGPathPen
from fontTools.pens.transformPen import TransformPen
import json
out=Path('frontend/public/concepts/candle-logo');out.mkdir(parents=True,exist_ok=True)
base=Path('frontend/public/concepts/logo-ideas')
def font(name,weight):
 f=TTFont(base/(name+'.woff2'));axes={a.axisTag:({'wght':weight,'opsz':48,'SOFT':30,'WONK':1}.get(a.axisTag,a.defaultValue)) for a in f['fvar'].axes};return instantiateVariableFont(f,axes,inplace=True)
f=font('fraunces',700);m=font('manrope',600)
def glyph(f,c,x,y,scale):
 gs=f.getGlyphSet();n=f.getBestCmap()[ord(c)];pen=SVGPathPen(gs);gs[n].draw(TransformPen(pen,(scale,0,0,-scale,x,y)));return pen.getCommands(),gs[n].width*scale
variants=[('Quiet serif','A compact serif candle stays close to the original i; a single-color flame replaces its dot.',48,21,17,42,False,False),('Birthday candle','A slightly taller wax stem and broad amber flame make the candle easier to see.',43,23,9,36,True,False),('Fine wick','A narrower stem, tiny wick and leaning amber flame give the mark a handwritten warmth.',46,20,13,37,True,True),('Soft wax','A broader, taller stem with a shallow wax dip supports a compact white flame and visible wick.',40,24,8,31,False,True)]
def candle(cx,top,bottom,width,ft,fb,amber,wick,idx,color,light=False,small=False):
 l=cx-width/2;r=cx+width/2;flamecolor=('#ffbd52' if light else '#b96508') if amber else color
 if idx==1:
  stem=f'M{l-4} {bottom}V{bottom-4}Q{l} {bottom-4} {l} {bottom-9}V{top+6}L{l-3} {top+6}V{top+2}L{r} {top-1}V{bottom-9}Q{r} {bottom-4} {r+4} {bottom-4}V{bottom}Z'
 else:
  dip=3 if idx==4 else 1
  stem=f'M{l} {top+3}Q{l} {top-1} {cx-3} {top+dip}Q{cx+2} {top+dip+2} {r} {top}V{bottom-3}Q{r} {bottom} {r-3} {bottom}H{l+3}Q{l} {bottom} {l} {bottom-3}Z'
 fw=width*.52;mid=ft+(fb-ft)*.7;tip=cx+(4 if idx in [3,4] else 0)
 flame=f'M{tip} {ft}C{cx-2} {ft+8} {cx-fw} {mid-5} {cx-fw} {mid}C{cx-fw} {fb+2} {cx+fw} {fb+2} {cx+fw} {mid}C{cx+fw} {mid-6} {tip+2} {ft+5} {tip} {ft}Z'
 parts=f'<path fill="{color}" d="{stem}"/>'
 if wick and not small:parts+=f'<path fill="{color}" d="M{cx-1.4} {top+1}L{cx-2} {fb+4}H{cx+.5}L{cx+1} {top+1}Z"/>'
 parts+=f'<path fill="{flamecolor}" d="{flame}"/>'
 return parts
for idx,(name,desc,top,width,ft,fb,amber,wick) in enumerate(variants,1):
 d=out/f'v{idx}';d.mkdir(exist_ok=True)
 for light in [False,True]:
  color='#ffffff' if light else '#a3122f';x=8;parts=[]
  path,adv=glyph(f,'w',x,108,.06);parts.append(f'<path fill="{color}" d="{path}"/>');x+=adv-1.5
  cx=x+17;parts.append(candle(cx,top,108,width,ft,fb,amber,wick,idx,color,light));x+=37
  for ch in 'sher':
   path,adv=glyph(f,ch,x,108,.06);parts.append(f'<path fill="{color}" d="{path}"/>');x+=adv-1.4
  x+=6
  for ch in '.az':
   path,adv=glyph(m,ch,x,108,.025);parts.append(f'<path fill="{color}" d="{path}"/>');x+=adv
  viewwidth=round(x+8,2)
  (d/('wordmark-white.svg' if light else 'wordmark-red.svg')).write_text(f'<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 {viewwidth} 122" role="img"><title>Wisher.az - {name}</title>'+''.join(parts)+'</svg>\n')
 # The icon keeps exactly the same candle geometry, optically enlarged in its square.
 shape=candle(32,top,108,width,ft,fb,amber,wick,idx,'#ffffff',True)
 icon=f'<svg xmlns="http://www.w3.org/2000/svg" width="1024" height="1024" viewBox="0 0 128 128"><title>Wisher candle - {name}</title><path fill="#a3122f" d="M0 0H128V128H0Z"/><g transform="translate(32 5)">{shape}</g></svg>\n'
 (d/'app-icon.svg').write_text(icon)
 # Pixel-scale artwork: no wick, enlarged flame gap and 4px stem, independent of large artwork.
 fc='#ffbd52' if amber else '#fff'
 small=f'<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 16 16"><title>Wisher candle</title><path fill="#a3122f" d="M0 0H16V16H0Z"/><path fill="#fff" d="M6 8H10V14H6Z"/><path fill="{fc}" d="M8 1C7 3 5.8 4 6 5.5 6.2 7.5 9.8 7.5 10 5.5 10.2 4 9 2.5 8 1Z"/></svg>\n'
 (d/'favicon.svg').write_text(small)
 # A 32/48px optical intermediate keeps the stem and flame simple, without a wick.
 medium=candle(32,top,108,width,ft,fb,amber,False,idx,'#ffffff',True)
 (d/'favicon-detail.svg').write_text(icon.replace(shape,medium))
Path('docs/evidence/candle-logo/variants.json').write_text(json.dumps([{'number':i,'name':v[0],'rationale':v[1]} for i,v in enumerate(variants,1)],indent=2)+'\n')
print('Vector masters written. Wordmark width:',viewwidth)
