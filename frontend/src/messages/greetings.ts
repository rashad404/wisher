// Greeting landing pages. Azerbaijani copy is draft pending owner review.
// Every text is an example written for Wisher; names are placeholders.
export type Greeting={to:string;body:string;tone:'Səmimi'|'Zarafatcıl'|'Rəsmi'|'Duyğulu'};
export type GreetingGroup={id:string;title:string;items:Greeting[]};
export type GreetingPage={
 slug:string;name:string;img:string;bg:string;
 title:string;description:string;h1:string;intro:string;
 wish:Record<string,string>;wishPicks:[string,string][];gifts:string;giftLabel:string;
 groups:GreetingGroup[];faq:[string,string][];
};

const howFaq:[string,string]=['Wisher ilə təbrik necə hazırlanır?','Kimə yazdığınızı, münasibəti, tonu və bir xatirəni seçin. kimlik.az ilə daxil olduqdan sonra Wisher üç variant hazırlayır. Bəyəndiyinizi düzəldir, köçürür və ya kart kimi endirirsiniz. Gündəlik pulsuz limit var.'];
const freeFaq:[string,string]=['Bu nümunələrdən pulsuz istifadə edə bilərəm?','Bəli. Mətni köçürün, adı dəyişin və WhatsApp-da, Instagram-da və ya kartda istifadə edin. Qeydiyyat lazım deyil.'];
const langFaq:[string,string]=['Təbriki rus və ya ingilis dilində hazırlamaq olar?','Bəli. Wisher-in təbrik formasında dil seçimi var: Azərbaycan, rus və ingilis dili.'];
const remindFaq:[string,string]=['Özəl günü unutmamaq üçün nə edim?','Adı və tarixi Wisher hesabınıza əlavə edin. Yaxınlaşan günlər hesabınızdakı xatırlatmalarda görünür. Hazırda SMS və e-poçt göndərilmir.'];

export const greetingPages:GreetingPage[]=[
 {slug:'ad-gunu',name:'Ad günü',img:'birthday_cake',bg:'#fde8ec',
  title:'Ad günü təbrikləri: ad günün mübarək sözləri - Wisher',
  description:'Dosta, bacıya, qızıma, oğluma və iş yoldaşına ad günü təbrikləri. Hazır nümunəni köçürün və ya Wisher ilə öz təbrikinizi yazın.',
  h1:'Ad günü təbrikləri',
  intro:'"Ad günün mübarək" demək asandır, yadda qalan sözü tapmaq çətin. Nümunəni köçürüb adı dəyişin və ya bir xatirə yazın, Wisher sizə uyğun üç variant hazırlasın.',
  wish:{occasion:'birthday'},wishPicks:[['Kimə','Dostuma'],['Münasibət','Ad günü'],['Xatirə','Məktəbdən dostuq']],gifts:'occasion=birthday',giftLabel:'Ad günü hədiyyələri',
  groups:[
   {id:'dosta',title:'Dosta ad günü təbriki',items:[
    {to:'Əziz dostum,',body:'ad günün mübarək! Uşaqlıqdan bu günə qədər hər sevincimi səninlə bölüşmüşəm. Yeni yaşın sənə cansağlığı, uğur və bol gülüş gətirsin.',tone:'Səmimi'},
    {to:'Rəfiqəm,',body:'ad günün mübarək! Yaxşı ki, həyatımda varsan. Bu il bütün arzuların bir-bir çin olsun, mən də yanında olub sevinim.',tone:'Duyğulu'},
    {to:'Qardaşım,',body:'yaşın mübarək! Tortdakı şamlar artır, amma zarafatlarımız heç köhnəlmir. Yeni yaşında cibin dolu, ürəyin rahat olsun.',tone:'Zarafatcıl'},
   ]},
   {id:'aileye',title:'Bacıya, qızıma və oğluma',items:[
    {to:'Bacım,',body:'ad günün mübarək! Ən yaxın sirdaşım, ən böyük dəstəyim sənsən. Həmişə belə gülərüz və xoşbəxt qal.',tone:'Səmimi'},
    {to:'Qızım,',body:'ad günün mübarək! Sən dünyaya gələndən evimiz daha işıqlıdır. Böyü, sevin, arzuladığın hər yolu cəsarətlə keç. Biz həmişə yanındayıq.',tone:'Duyğulu'},
    {to:'Oğlum,',body:'ad günün mübarək! Hər il bir az da böyüyürsən, biz də səninlə fəxr edirik. Yeni yaşın sağlıq, dostluq və yeni kəşflərlə dolu olsun.',tone:'Səmimi'},
   ]},
   {id:'is-yoldasina',title:'İş yoldaşına rəsmi təbrik',items:[
    {to:'Hörmətli Elçin müəllim,',body:'ad gününüz münasibətilə sizi səmimi qəlbdən təbrik edirəm. Sizə möhkəm cansağlığı, işinizdə yeni uğurlar və ailənizlə xoş günlər arzulayıram.',tone:'Rəsmi'},
    {to:'Hörmətli Səbinə xanım,',body:'doğum gününüz mübarək! Sizə cansağlığı, xoşbəxtlik və ürəyinizcə olan bir il arzulayıram.',tone:'Rəsmi'},
    {to:'Əziz həmkarım,',body:'ad günün mübarək! Səninlə işləmək həmişə xoşdur. Yeni yaşın uğurlu layihələr və rahat günlərlə keçsin.',tone:'Səmimi'},
   ]},
  ],
  faq:[['Ad günü təbrikini necə şəxsi etmək olar?','Ortaq bir xatirə, onun sevdiyi bir şey və ya bu il baş verən bir yenilik əlavə edin. Wisher formasına bu detalı yazanda variantlar həmin detala uyğun hazırlanır.'],freeFaq,howFaq,remindFaq]},

 {slug:'anaya',name:'Anaya',img:'tulip',bg:'#fff0e6',
  title:'Anaya təbrik: ad günü və 8 Mart təbrikləri - Wisher',
  description:'Anaya ad günü təbriki, 8 Mart təbriki və hər gün üçün səmimi sözlər. Hazır nümunələri köçürün və ya öz təbrikinizi yazın.',
  h1:'Anaya təbrik',
  intro:'Ana üçün söz seçəndə hər cümlə az görünür. Burada ad günü, 8 Mart və sadəcə "sağ ol" demək üçün nümunələr var. Bir xatirə əlavə edin, təbrik sizin olsun.',
  wish:{occasion:'birthday',relationship:'Anam',recipient:'Anam'},wishPicks:[['Kimə','Anama'],['Münasibət','Ad günü'],['Xatirə','Hər səhər çay hazırlayır']],gifts:'recipient=family',giftLabel:'Anaya hədiyyə',
  groups:[
   {id:'ad-gunu',title:'Anaya ad günü təbriki',items:[
    {to:'Əziz anam,',body:'ad günün mübarək! Mənə ilk sözü, ilk addımı öyrədən sənsən. Allah səni başımızın üstündən əskik etməsin, həmişə sağ və gülərüz ol.',tone:'Duyğulu'},
    {to:'Anacan,',body:'ad günün mübarək! Sənin çayın, sənin sözün, sənin duan olmasa, heç bir günüm tam olmur. Yaxşı ki varsan.',tone:'Səmimi'},
    {to:'Canım anam,',body:'yaşın mübarək! Bu gün evdə hər iş məndən, dincəlmək səndən. Söz verirəm, qabları da özüm yuyacağam.',tone:'Zarafatcıl'},
   ]},
   {id:'8-mart',title:'Anaya 8 Mart təbriki',items:[
    {to:'Əziz anam,',body:'8 Mart bayramın mübarək! Ən gözəl gül də sənin təbəssümünün yanında solğun qalır. Hər günün bahar kimi olsun.',tone:'Duyğulu'},
    {to:'Anam,',body:'Qadınlar günün mübarək! Bizim üçün etdiyin hər şeyə görə sağ ol. Səni çox sevirəm.',tone:'Səmimi'},
    {to:'Əziz qaynanam,',body:'8 Mart bayramınız mübarək! Ailəmizə göstərdiyiniz qayğı üçün təşəkkür edirəm. Sizə cansağlığı və uzun ömür arzulayıram.',tone:'Rəsmi'},
   ]},
   {id:'her-gun',title:'Hər gün üçün',items:[
    {to:'Anam,',body:'bu gün heç bir bayram deyil, sadəcə sənə təşəkkür etmək istədim. Hər şey üçün sağ ol.',tone:'Səmimi'},
    {to:'Anacan,',body:'uzaqda olsam da, ürəyim həmişə səninlədir. Özündən muğayat ol, tezliklə görüşəcəyik.',tone:'Duyğulu'},
    {to:'Ana,',body:'bu gün sadəcə səni gülümsətmək üçün yazıram. Yemək bişirməyi səndən öyrəndim, amma heç vaxt sənin kimi dadlı olmur.',tone:'Zarafatcıl'},
   ]},
  ],
  faq:[['Anaya təbrikdə nə yazmaq olar?','Onun sizin üçün etdiyi konkret bir şeyi xatırladın: hər səhər hazırladığı çay, imtahan günü verdiyi dəstək. Konkret xatirə ümumi sözlərdən daha təsirlidir.'],['Anaya hansı hədiyyəni almaq olar?','Wisher-in hədiyyələr bölməsində ailə üçün seçimlərə baxın. Bəyəndiyinizi mağazanın öz saytında alırsınız.'],freeFaq,howFaq]},

 {slug:'sevgiliye',name:'Sevgiliyə',img:'heart',bg:'#fbe9f3',
  title:'Sevgiliyə təbrik: ad günü və romantik sözlər - Wisher',
  description:'Sevgiliyə ad günü təbriki, ildönümü və bayram üçün romantik sözlər. Nümunəni köçürün və ya Wisher ilə özünüzə uyğun təbrik yazın.',
  h1:'Sevgiliyə təbrik',
  intro:'Sevdiyiniz insana yazanda ən yaxşı söz sizin öz sözünüzdür. Nümunələrdən ilham alın, aranızdakı bir xatirəni əlavə edin.',
  wish:{occasion:'birthday',relationship:'Sevgilim'},wishPicks:[['Kimə','Sevgilimə'],['Münasibət','Ad günü'],['Xatirə','İlk görüşümüz dənizkənarında']],gifts:'occasion=birthday',giftLabel:'Sevgiliyə hədiyyə',
  groups:[
   {id:'ad-gunu',title:'Sevgiliyə ad günü təbriki',items:[
    {to:'Canım,',body:'ad günün mübarək! Səninlə tanış olduğum gün həyatımın ən şanslı günü idi. Bu yeni yaşında da hər sevincini mənimlə bölüşməyini istəyirəm.',tone:'Duyğulu'},
    {to:'Əzizim,',body:'ad günün mübarək! Dünyada ən çox sevdiyim təbəssüm sənindir. Qoy o təbəssüm heç vaxt üzündən getməsin.',tone:'Səmimi'},
    {to:'Sevgilim,',body:'yaşın mübarək! Bir yaş da böyüdün, amma mənim üçün hələ də kinoda popkornunu bölüşmək istəməyən o insansan. Səni sevirəm.',tone:'Zarafatcıl'},
   ]},
   {id:'ildonumu',title:'İldönümü təbriki',items:[
    {to:'Canım,',body:'ildönümümüz mübarək! Bir il əvvəl başlayan bu yolda hər gün səni bir az da çox sevdim. Qarşıda daha çox birgə səyahət, daha çox gülüş var.',tone:'Duyğulu'},
    {to:'Həyat yoldaşım,',body:'ildönümümüz mübarək! Evimizi isti, günlərimi mənalı edən sənsən. Yaxşı ki, bir-birimizi tapdıq.',tone:'Səmimi'},
    {to:'Əzizim,',body:'ildönümümüz mübarək! Bir il keçdi, sən hələ də mənim zarafatlarıma gülürsən. Bu, əsl sevgidir.',tone:'Zarafatcıl'},
   ]},
   {id:'bayram',title:'Yeni il və 8 Mart',items:[
    {to:'Əzizim,',body:'Yeni ilin mübarək! Bu il nə arzulasan, birlikdə gerçəkləşdirək. Saat on ikini vuranda ilk sözüm sənə olacaq.',tone:'Səmimi'},
    {to:'Gözəlim,',body:'Qadınlar günün mübarək! Səninlə hər gün bahardır. Bu gün bütün diqqət də, bütün güllər də sənindir.',tone:'Duyğulu'},
    {to:'Canım,',body:'bayramın mübarək! Hər bayramı səninlə qarşılamaq ən böyük hədiyyəmdir. Qoy bu gün də ürəyin sevinclə dolsun.',tone:'Səmimi'},
   ]},
  ],
  faq:[['Sevgiliyə uzun və səmimi təbrik necə yazılır?','Tanışlığınızı, birlikdə keçirdiyiniz bir anı və gələcək üçün bir arzunu yazın. Daha uzun mətn üçün Wisher-də "Nitq" formatını seçə bilərsiniz.'],freeFaq,howFaq,langFaq]},

 {slug:'toy',name:'Toy və nişan',img:'ring',bg:'#f3ecfb',
  title:'Toy təbrikləri: toyunuz mübarək sözləri - Wisher',
  description:'Dosta, qardaşa və bacıya toy təbriki, nişan və rəsmi toy təbrikləri. Hazır nümunəni köçürün və ya Wisher ilə öz təbrikinizi yazın.',
  h1:'Toy təbrikləri',
  intro:'Toy günü deyilən söz illərlə xatırlanır. Qardaşınız, rəfiqəniz və ya həmkarınız üçün nümunələrə baxın, adları dəyişin, bir xatirə əlavə edin.',
  wish:{occasion:'wedding'},wishPicks:[['Kimə','Qardaşıma'],['Münasibət','Toy'],['Xatirə','Uşaqlıqdan bir otaqda böyümüşük']],gifts:'occasion=wedding',giftLabel:'Toy hədiyyələri',
  groups:[
   {id:'dosta',title:'Dosta və ailəyə toy təbriki',items:[
    {to:'Qardaşım,',body:'toyun mübarək! Bu gün səni bəy kimi görmək hamımızı xoşbəxt etdi. Bir yastıqda qocalasınız, evinizdən gülüş əskik olmasın.',tone:'Duyğulu'},
    {to:'Bacım,',body:'toyun mübarək! Gəlinlikdə səndən gözəli yox idi. Yeni evində səni sevgi, hörmət və bol bərəkət gözləsin.',tone:'Səmimi'},
    {to:'Əziz dostlar,',body:'toyunuz mübarək! Artıq bir komandasınız: pultu kimin saxlayacağına da birlikdə qərar verəcəksiniz. Xoşbəxt olun!',tone:'Zarafatcıl'},
   ]},
   {id:'resmi',title:'Rəsmi toy təbriki',items:[
    {to:'Hörmətli Kamran və Nigar,',body:'izdivacınız münasibətilə sizi səmimi qəlbdən təbrik edirəm. Ailənizə xoşbəxtlik, anlaşma və uzun illər arzulayıram.',tone:'Rəsmi'},
    {to:'Hörmətli həmkarım,',body:'toyunuz mübarək! Yeni həyatınızda sizə sevgi dolu, sakit və firavan günlər arzulayıram.',tone:'Rəsmi'},
    {to:'Hörmətli Vüqar müəllim,',body:'oğlunuzun toyu mübarək! Gənclərə xoşbəxtlik, ailənizə isə bol sevinc və nəvə sevinci arzulayıram.',tone:'Rəsmi'},
   ]},
   {id:'nisan',title:'Nişan təbriki',items:[
    {to:'Əzizlərim,',body:'nişanınız mübarək! Bu gün taxılan üzük sizə xoşbəxtlik gətirsin. Tezliklə toyunuzda oynamaq arzusundayıq.',tone:'Səmimi'},
    {to:'Rəfiqəm,',body:'nişanın mübarək! Ürəyinin seçdiyi insanla xoşbəxt ol. Toy hazırlığında nə lazım olsa, yanındayam.',tone:'Səmimi'},
    {to:'Qardaşım,',body:'nişanın mübarək! Artıq rəsmi olaraq bir nəfərə hesabat verirsən. Xoşbəxt ol, toyda da birinci sən oynayacaqsan.',tone:'Zarafatcıl'},
   ]},
  ],
  faq:[['Toy təbrikində nə arzulanır?','Ən çox "Bir yastıqda qocalasınız", "Xoşbəxt olun" kimi arzular deyilir. Bəy və ya gəlinlə bağlı səmimi bir xatirə təbriki daha yadda qalan edir.'],['Toya nə hədiyyə almaq olar?','Wisher-in hədiyyələr bölməsində toy və nişan üçün seçimlərə baxın. Bəyəndiyinizi mağazanın öz saytında alırsınız.'],freeFaq,howFaq]},

 {slug:'novruz',name:'Novruz',img:'seedling',bg:'#e6f4ea',
  title:'Novruz təbrikləri: Novruz bayramınız mübarək - Wisher',
  description:'Ailəyə, dostlara və həmkarlara Novruz bayramı təbrikləri. Rəsmi və səmimi nümunələri köçürün və ya öz təbrikinizi hazırlayın.',
  h1:'Novruz bayramı təbrikləri',
  intro:'Novruz bahar, süfrə və ailə bayramıdır. Yaxınlarınıza, dostlarınıza və iş yoldaşlarınıza göndərmək üçün nümunələr. Hazır mətni köçürün və ya Wisher ilə özünüzə uyğun yazın.',
  wish:{occasion:'novruz'},wishPicks:[['Kimə','Ailəmə'],['Münasibət','Novruz'],['Xatirə','Nənəmin şəkərburası']],gifts:'occasion=novruz',giftLabel:'Novruz hədiyyələri',
  groups:[
   {id:'aileye',title:'Ailəyə Novruz təbriki',items:[
    {to:'Əziz ailəm,',body:'Novruz bayramınız mübarək! Süfrəniz bol, eviniz işıqlı, ürəyiniz bahar kimi təzə olsun. Bayram tonqalı bütün qayğıları özü ilə aparsın.',tone:'Duyğulu'},
    {to:'Anacan,',body:'bayramın mübarək! Sənin bişirdiyin şəkərbura kimisi heç yerdə yoxdur. Bu bahar evimizə sağlıq və bərəkət gətirsin.',tone:'Səmimi'},
    {to:'Əziz nənəm,',body:'Novruz bayramın mübarək! Səməni göyərdəndə, xonça bəzəyəndə həmişə səni xatırlayıram. Sağ ol, bayramlarımızın başında ol.',tone:'Duyğulu'},
   ]},
   {id:'dostlara',title:'Dostlara Novruz təbriki',items:[
    {to:'Dostum,',body:'Novruzun mübarək! Bu il sənə səməni kimi yaşıl, tonqal kimi isti günlər arzulayıram.',tone:'Səmimi'},
    {to:'Əzizim,',body:'bayramın mübarək! Bu il şəkərbura mənə də çatsın, yoxsa küsəcəyəm. Baharın gözəl keçsin!',tone:'Zarafatcıl'},
    {to:'Rəfiqəm,',body:'Novruzun mübarək! Bahar sənə yeni başlanğıclar, təzə arzular və bol sevinc gətirsin. Tonqal üstündən birlikdə tullanmağı unutma.',tone:'Səmimi'},
   ]},
   {id:'resmi',title:'Rəsmi Novruz təbriki',items:[
    {to:'Hörmətli həmkarlar,',body:'Novruz bayramı münasibətilə sizi və ailənizi səmimi qəlbdən təbrik edirəm. Bahar evinizə sağlıq, işinizə uğur gətirsin.',tone:'Rəsmi'},
    {to:'Hörmətli müştərimiz,',body:'Novruz bayramınız mübarək! Bizimlə olduğunuz üçün təşəkkür edirik. Sizə və ailənizə firavan bahar arzulayırıq.',tone:'Rəsmi'},
    {to:'Hörmətli Nərgiz xanım,',body:'Novruz bayramı münasibətilə sizi təbrik edirəm. Bahar süfrənizə bərəkət, evinizə sağlıq və xoş əhval gətirsin.',tone:'Rəsmi'},
   ]},
  ],
  faq:[['Novruz bayramı nə vaxt qeyd olunur?','Novruz yaz gecə-gündüz bərabərliyi günü, adətən 20-21 martda qeyd olunur. Bayramdan əvvəlki dörd çərşənbə də Novruz ənənəsinin bir hissəsidir.'],['Novruz təbrikində nə arzulanır?','Adətən süfrənin bərəkəti, evin işığı, sağlıq və bahar təzəliyi arzulanır. Rəsmi təbrikdə "sizi və ailənizi təbrik edirəm" ifadəsi uyğundur.'],freeFaq,howFaq]},

 {slug:'yeni-il',name:'Yeni il',img:'christmas_tree',bg:'#e8f0fb',
  title:'Yeni il təbrikləri 2027: yeni iliniz mübarək - Wisher',
  description:'Ailəyə, dostlara, sevgiliyə, müəllimə və həmkarlara Yeni il təbrikləri. 31 dekabr Həmrəylik günü ilə birlikdə rəsmi nümunələr.',
  h1:'Yeni il təbrikləri',
  intro:'31 dekabr həm Dünya Azərbaycanlılarının Həmrəyliyi Günü, həm də Yeni il gecəsidir. Yaxınlarınıza, müəllimlərinizə və həmkarlarınıza göndərmək üçün nümunələr.',
  wish:{occasion:'newyear'},wishPicks:[['Kimə','Dostlarıma'],['Münasibət','Yeni il'],['Xatirə','Hər il birlikdə qarşılayırıq']],gifts:'occasion=newyear',giftLabel:'Yeni il hədiyyələri',
  groups:[
   {id:'aileye',title:'Ailəyə və dostlara',items:[
    {to:'Əzizlərim,',body:'Yeni iliniz mübarək! Qarşıdakı il sizə arzuladığınız hər şeyi, bir az da artığını gətirsin. Süfrəniz bol, eviniz şən olsun.',tone:'Səmimi'},
    {to:'Dostum,',body:'Yeni ilin mübarək! Bu il verdiyin vədlərin heç olmasa yarısını tutmağı arzulayıram. Mən də öz vədlərimi unutmuşam, narahat olma.',tone:'Zarafatcıl'},
    {to:'Anam, atam,',body:'Yeni iliniz mübarək! Bu il də sağ olun, yanımızda olun. Sizin duanız bizim ən böyük xoşbəxtliyimizdir.',tone:'Duyğulu'},
   ]},
   {id:'sevgiliye',title:'Sevgiliyə Yeni il təbriki',items:[
    {to:'Canım,',body:'Yeni ilin mübarək! Keçən il ən gözəl hədiyyəm sən idin. Yeni ildə də hər səhəri səninlə qarşılamaq istəyirəm.',tone:'Duyğulu'},
    {to:'Əzizim,',body:'Yeni ilin mübarək! Bu il də arzu tutanda yenə səni arzulayacağam, çünki ən gözəl arzum artıq çin olub.',tone:'Səmimi'},
    {to:'Sevgilim,',body:'Yeni ilin mübarək! Bu il söz verirəm: hədiyyəni son günə saxlamayacağam. Yaxşı, heç olmasa çalışacağam.',tone:'Zarafatcıl'},
   ]},
   {id:'resmi',title:'Rəsmi Yeni il təbriki',items:[
    {to:'Hörmətli həmkarlar,',body:'Dünya Azərbaycanlılarının Həmrəyliyi Günü və Yeni il münasibətilə sizi təbrik edirəm. Yeni il hamımıza sağlıq, uğur və sülh gətirsin.',tone:'Rəsmi'},
    {to:'Hörmətli müəllimim,',body:'Yeni iliniz mübarək! Bizə verdiyiniz bilik və səbir üçün təşəkkür edirəm. Sizə cansağlığı və xoş bir il arzulayıram.',tone:'Rəsmi'},
    {to:'Hörmətli müştərilərimiz,',body:'Yeni iliniz mübarək! Bu il bizimlə olduğunuz üçün təşəkkür edirik. Sizə uğurlu və bərəkətli il arzulayırıq.',tone:'Rəsmi'},
   ]},
  ],
  faq:[['31 dekabrda necə təbrik edirlər?','Azərbaycanda 31 dekabr Dünya Azərbaycanlılarının Həmrəyliyi Günüdür. Buna görə rəsmi təbriklərdə iki bayram çox vaxt birlikdə qeyd olunur: "Həmrəylik günü və Yeni iliniz mübarək".'],langFaq,['Yeni il hədiyyəsini haradan seçim?','Wisher-in hədiyyələr bölməsində Yeni il üçün seçimlərə baxın. Bəyəndiyinizi mağazanın öz saytında alırsınız.'],howFaq]},

 {slug:'8-mart',name:'8 Mart',img:'bouquet',bg:'#fdf6dd',
  title:'8 Mart təbrikləri: Qadınlar günü təbriki - Wisher',
  description:'Anaya, bacıya, sevgiliyə, müəlliməyə və həmkarlara 8 Mart təbrikləri. Səmimi və rəsmi nümunələr, öz təbrikinizi də hazırlayın.',
  h1:'8 Mart təbrikləri',
  intro:'8 Mart Beynəlxalq Qadınlar Günüdür. Ananıza, bacınıza, sevdiyinizə, müəlliminizə və iş yoldaşlarınıza deyə biləcəyiniz sözlər.',
  wish:{occasion:'thanks',details:'8 Mart, Qadınlar günü təbriki'},wishPicks:[['Kimə','Bacıma'],['Münasibət','8 Mart'],['Xatirə','Ən yaxın sirdaşımdır']],gifts:'occasion=womens_day',giftLabel:'8 Mart hədiyyələri',
  groups:[
   {id:'aileye',title:'Anaya və bacıya',items:[
    {to:'Əziz anam,',body:'8 Mart bayramın mübarək! Hər səhər çayımı hazırlayan, hər imtahanda yanımda olan sənsən. Yaxşı ki varsan.',tone:'Duyğulu'},
    {to:'Bacım,',body:'Qadınlar günün mübarək! Ən yaxşı dostum və ən böyük dəstəyim sənsən. Həmişə belə güclü və gözəl qal.',tone:'Səmimi'},
    {to:'Qızım,',body:'8 Mart mübarək! Sən evimizin gülüsən. Böyüdükcə daha da güclü, daha da xoşbəxt ol.',tone:'Duyğulu'},
   ]},
   {id:'sevgiliye',title:'Sevgiliyə 8 Mart təbriki',items:[
    {to:'Gözəlim,',body:'8 Mart mübarək! Sən hər gün bayramıma səbəbsən. Bu gün də, hər gün də ən gözəl güllər sənin olsun.',tone:'Duyğulu'},
    {to:'Həyat yoldaşım,',body:'Qadınlar günün mübarək! Evimizi isti, ailəmizi bir yerdə saxlayan sənsən. Bu gün mətbəx də, qab-qacaq da məndədir.',tone:'Səmimi'},
    {to:'Canım,',body:'bayramın mübarək! Gül aldım, şokolad aldım, amma ən böyük sürpriz odur ki, bu dəfə tarixi unutmadım.',tone:'Zarafatcıl'},
   ]},
   {id:'resmi',title:'Müəlliməyə və həmkarlara',items:[
    {to:'Hörmətli müəllimim,',body:'8 Mart bayramınız mübarək! Bizə verdiyiniz hər dərs, hər məsləhət üçün təşəkkür edirik. Sizə cansağlığı və xoş günlər arzulayırıq.',tone:'Rəsmi'},
    {to:'Hörmətli xanımlar,',body:'Beynəlxalq Qadınlar Günü münasibətilə sizi səmimi qəlbdən təbrik edirəm. İşinizdə uğur, ailənizdə səadət arzulayıram.',tone:'Rəsmi'},
    {to:'Əziz həmkarım,',body:'bayramın mübarək! Ofisimizin ən gülərüz insanı olduğun üçün sağ ol. Bu gün çay növbəsi məndədir.',tone:'Zarafatcıl'},
   ]},
  ],
  faq:[['8 Mart nə bayramıdır?','8 Mart Beynəlxalq Qadınlar Günüdür. Azərbaycanda bu gün qeyri-iş günüdür və analara, bacılara, həmkarlara təbrik və hədiyyə vermək ənənədir.'],['8 Marta nə hədiyyə almaq olar?','Wisher-in hədiyyələr bölməsində 8 Mart üçün seçimlərə baxın. Bəyəndiyinizi mağazanın öz saytında alırsınız.'],freeFaq,howFaq]},

 {slug:'muellime',name:'Müəllimə',img:'graduation_cap',bg:'#e6f6f8',
  title:'Müəllimə təbrik: Müəllimlər günü təbrikləri - Wisher',
  description:'Müəllimlər günü, ad günü və məzuniyyət üçün müəllimə təbrik mesajları. Hörmətli və səmimi nümunələr, öz təbrikinizi də yazın.',
  h1:'Müəllimə təbrik',
  intro:'Müəllimə deyilən təşəkkür illərlə yadda qalır. 5 oktyabr Müəllimlər günü, ad günü və məzuniyyət üçün nümunələr. Şagird və ya valideyn adından istifadə edin.',
  wish:{occasion:'thanks',relationship:'Müəllimim',tone:'formal'},wishPicks:[['Kimə','Müəllimimə'],['Münasibət','Müəllimlər günü'],['Xatirə','Riyaziyyatı sevdirdi']],gifts:'occasion=teachers_day',giftLabel:'Müəllimə hədiyyə',
  groups:[
   {id:'muellimler-gunu',title:'Müəllimlər günü təbriki',items:[
    {to:'Hörmətli müəllimim,',body:'Müəllimlər gününüz mübarək! Bizə təkcə dərs deyil, öyrənməyi sevməyi də öyrətdiniz. Sizə cansağlığı və səbir arzulayırıq.',tone:'Rəsmi'},
    {to:'Əziz Gülnarə müəllimə,',body:'bayramınız mübarək! Övladımıza göstərdiyiniz diqqət və qayğı üçün ailəmiz adından təşəkkür edirik.',tone:'Səmimi'},
    {to:'Hörmətli müəllimimiz,',body:'5 oktyabr Müəllimlər günü münasibətilə sizi təbrik edirik. Hər şagirdinizin uğuru sizin zəhmətinizin bəhrəsidir.',tone:'Rəsmi'},
   ]},
   {id:'ad-gunu',title:'Müəllimə ad günü təbriki',items:[
    {to:'Hörmətli müəllimim,',body:'ad gününüz mübarək! Sizə möhkəm cansağlığı, uzun ömür və hər gün şagirdlərinizin təbəssümünü arzulayıram.',tone:'Rəsmi'},
    {to:'Əziz müəlliməm,',body:'ad gününüz mübarək! Sinfimiz adından sizə ən gözəl arzularımızı göndəririk. Yaxşı ki, bizim müəllimimizsiniz.',tone:'Səmimi'},
    {to:'Hörmətli Kamal müəllim,',body:'ad gününüz münasibətilə sizi valideynlər adından təbrik edirik. Övladlarımıza verdiyiniz zəhmət üçün minnətdarıq.',tone:'Rəsmi'},
   ]},
   {id:'mezuniyyet',title:'Məzuniyyətdə təşəkkür',items:[
    {to:'Hörmətli müəllimim,',body:'illər boyu verdiyiniz bilik və dəstək üçün təşəkkür edirəm. Hər uğurumda sizin də payınız olacaq. Sizi heç vaxt unutmayacağam.',tone:'Duyğulu'},
    {to:'Əziz müəllimlərimiz,',body:'məktəbi bitiririk, amma sizin öyrətdikləriniz bizimlə qalır. Səbriniz və qayğınız üçün sağ olun.',tone:'Səmimi'},
    {to:'Hörmətli müəllimimiz,',body:'övladımızın məzuniyyəti münasibətilə sizə ailəmiz adından təşəkkür edirik. Bu uğurda sizin böyük əməyiniz var.',tone:'Rəsmi'},
   ]},
  ],
  faq:[['Müəllimlər günü nə vaxtdır?','Azərbaycanda Müəllimlər günü hər il 5 oktyabrda qeyd olunur.'],['Müəllimə təbrik necə yazılır?','Hörmətlə müraciət edin ("Hörmətli müəllimim", "Əziz ... müəllimə"), müəllimin konkret köməyini xatırladın və cansağlığı arzulayın. Rəsmi ton üçün Wisher-də "Rəsmi" seçin.'],freeFaq,howFaq]},
];

export const greetingsHub={
 title:'Təbriklər: ad günü, toy və bayram təbrikləri - Wisher',
 description:'Ad günü, toy, Novruz, Yeni il və 8 Mart təbrikləri, anaya, sevgiliyə və müəllimə təbrik mesajları. Nümunəni köçürün və ya öz təbrikinizi yazın.',
 h1:'Təbrik mesajları və nümunələri',
 intro:'Ad günü, toy və bayramlar üçün hazır təbrik nümunələri. Münasibəti seçin, bəyəndiyinizi köçürün və ya Wisher ilə özünüzə uyğun təbrik hazırlayın.',
 faq:[freeFaq,howFaq,langFaq,remindFaq] as [string,string][],
};
export const greetingBySlug=(slug:string)=>greetingPages.find(p=>p.slug===slug);
export const wishHref=(w:Record<string,string>)=>'/wishes'+(Object.keys(w).length?'?'+new URLSearchParams(w):'');
