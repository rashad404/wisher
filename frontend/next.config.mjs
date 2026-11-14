// Metadata always in <head> for every client, not streamed into <body>.
export default { poweredByHeader: false, htmlLimitedBots: /.*/, distDir: process.env.NEXT_DIST_DIR || '.next', experimental: { cpus: 2 }, async redirects(){return [{source:'/az',destination:'/',permanent:true},{source:'/login',destination:'/user',permanent:true},{source:'/register',destination:'/user',permanent:true}]}};
