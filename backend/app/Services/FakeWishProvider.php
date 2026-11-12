<?php
namespace App\Services;
class FakeWishProvider implements WishProvider {
 public function generate(array $b): array {
  $name=$b['recipient'];
  if ($b['language']==='en') return ["Dear $name, wishing you joy on this special day. Thank you for being part of my life.","$name, may this occasion bring new memories and many reasons to smile.","Thinking of you today, $name. Wishing you happiness, good health and wonderful days ahead."];
  if ($b['language']==='ru') return ["$name, желаю радости, здоровья и счастливых дней рядом с близкими!","Пусть этот день принесёт тебе добрые встречи и новые воспоминания, $name!","От всей души желаю тебе счастья и исполнения желаний, $name!"];
  return ["Əziz $name, bu özəl günündə sənə can sağlığı, rahatlıq və sevdiklərinlə gözəl anlar arzulayıram. Yaxşı ki, varsan!","$name, qoy bu gün yaddaşında xoş bir xatirə kimi qalsın. Üzündən təbəssüm, evindən sevinc əskik olmasın!","Bu gün ən xoş arzularım səninlədir, $name. Qarşıdakı günlər sənə yeni sevinclər və gözlədiyin gözəl xəbərləri gətirsin!"];
 }
}
