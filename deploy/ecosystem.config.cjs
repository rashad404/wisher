const base='/home/wisher/v2/current';
module.exports={apps:[
 {name:'wisher-web',cwd:base+'/frontend',script:'node_modules/next/dist/bin/next',args:'start -H 127.0.0.1 -p 3022',env:{NODE_ENV:'production'},max_memory_restart:'600M'},
 {name:'wisher-php',script:'/opt/cpanel/ea-php84/root/usr/sbin/php-fpm',interpreter:'none',args:'-F -y '+base+'/deploy/php-fpm.conf',max_restarts:10},
 {name:'wisher-schedule',cwd:base+'/backend',script:'/usr/local/bin/ea-php84',interpreter:'none',args:'artisan schedule:work',max_restarts:10}
]};
